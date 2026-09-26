<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    private const WHATSAPP_NUMBER = '6281234567890';

    public function index(Request $request)
    {
        $cart = $this->selectedCart($request);

        if ($cart['items']->isEmpty()) {
            return redirect()->route('products.index');
        }

        return view('checkout.index', $cart);
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => ['required', 'string', 'max:100'],
            'customer_phone' => ['required', 'string', 'max:25'],
            'customer_address' => ['nullable', 'string', 'max:1000'],
        ]);

        $cart = $this->selectedCart($request);

        if ($cart['items']->isEmpty()) {
            return redirect()->route('products.index');
        }

        $whatsappUrl = $this->buildWhatsappUrl($cart, $validated);

        CartItem::whereIn('id', $cart['items']->pluck('id'))->delete();
        $request->session()->forget(['cart_coupon', 'cart_notes']);

        return view('checkout.success', [
            'whatsappUrl' => $whatsappUrl,
            'customerName' => $validated['customer_name'],
            'total' => $cart['total'],
        ]);
    }

    private function selectedCart(Request $request): array
    {
        $items = CartItem::with('product')
            ->where('session_id', $request->session()->getId())
            ->where('is_selected', true)
            ->orderBy('created_at')
            ->get();

        $subtotal = $items->sum(fn (CartItem $item) => (float) $item->product->price * $item->quantity);

        $coupon = Coupon::where('code', $request->session()->get('cart_coupon'))
            ->where('is_active', true)
            ->first();

        $discount = $coupon ? round($subtotal * $coupon->discount_percentage / 100, 2) : 0;

        return [
            'items' => $items,
            'subtotal' => $subtotal,
            'discount' => $discount,
            'total' => max(0, $subtotal - $discount),
            'coupon' => $coupon,
            'notes' => $request->session()->get('cart_notes', ''),
        ];
    }

    private function buildWhatsappUrl(array $cart, array $customer): string
    {
        $lines = [
            'Halo, saya ingin memesan:',
            '',
        ];

        foreach ($cart['items'] as $index => $item) {
            $line = ($index + 1).'. '.$item->product->name
                .' (Size '.$item->size.($item->length ? ', '.$item->length : '').')'
                .' x'.$item->quantity
                .' - Rp '.number_format((float) $item->product->price * $item->quantity, 0, ',', '.');
            $lines[] = $line;
        }

        $lines[] = '';
        $lines[] = 'Subtotal: Rp '.number_format($cart['subtotal'], 0, ',', '.');

        if ($cart['coupon']) {
            $lines[] = 'Diskon ('.$cart['coupon']->code.'): -Rp '.number_format($cart['discount'], 0, ',', '.');
        }

        $lines[] = 'Total: Rp '.number_format($cart['total'], 0, ',', '.');
        $lines[] = '';
        $lines[] = 'Nama: '.$customer['customer_name'];
        $lines[] = 'No. HP: '.$customer['customer_phone'];

        if (! empty($customer['customer_address'])) {
            $lines[] = 'Alamat: '.$customer['customer_address'];
        }

        if ($cart['notes'] !== '') {
            $lines[] = 'Catatan: '.$cart['notes'];
        }

        return 'https://wa.me/'.self::WHATSAPP_NUMBER.'?text='.urlencode(implode("\n", $lines));
    }
}
