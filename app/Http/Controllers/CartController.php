<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CartController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        return response()->json($this->cartPayload($request));
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'size' => ['required', 'string', 'max:20'],
            'length' => ['nullable', 'string', 'max:40'],
            'quantity' => ['required', 'integer', 'min:1', 'max:100'],
        ]);

        $product = Product::active()->findOrFail($validated['product_id']);
        $sizes = $product->availableSizes();
        $lengths = $product->availableLengths();

        validator($validated, [
            'size' => ['required', Rule::in($sizes)],
            'length' => ['nullable', Rule::in($lengths)],
        ])->validate();

        if ($product->stock < $validated['quantity']) {
            return response()->json(['message' => 'Jumlah melebihi stok yang tersedia.'], 422);
        }

        $cartItem = CartItem::firstOrNew([
            'session_id' => $request->session()->getId(),
            'product_id' => $product->id,
            'size' => $validated['size'],
            'length' => $validated['length'] ?? null,
        ]);
        $cartItem->quantity = min($product->stock, ($cartItem->quantity ?? 0) + $validated['quantity']);
        $cartItem->is_selected = true;
        $cartItem->save();

        return response()->json($this->cartPayload($request));
    }

    public function update(Request $request, CartItem $cartItem): JsonResponse
    {
        $this->assertCartOwner($request, $cartItem);
        $validated = $request->validate([
            'quantity' => ['sometimes', 'integer', 'min:1', 'max:100'],
            'is_selected' => ['sometimes', 'boolean'],
        ]);

        if (isset($validated['quantity']) && $validated['quantity'] > $cartItem->product->stock) {
            return response()->json(['message' => 'Jumlah melebihi stok yang tersedia.'], 422);
        }

        $cartItem->update($validated);

        return response()->json($this->cartPayload($request));
    }

    public function destroy(Request $request, CartItem $cartItem): JsonResponse
    {
        $this->assertCartOwner($request, $cartItem);
        $cartItem->delete();

        return response()->json($this->cartPayload($request));
    }

    public function applyCoupon(Request $request): JsonResponse
    {
        $validated = $request->validate(['code' => ['required', 'string', 'max:50']]);
        $coupon = Coupon::where('code', strtoupper(trim($validated['code'])))
            ->where('is_active', true)
            ->first();

        if (! $coupon) {
            return response()->json(['message' => 'Kode diskon tidak valid atau sudah tidak aktif.'], 422);
        }

        $request->session()->put('cart_coupon', $coupon->code);

        return response()->json($this->cartPayload($request));
    }

    public function saveNotes(Request $request): JsonResponse
    {
        $validated = $request->validate(['notes' => ['nullable', 'string', 'max:1000']]);
        $request->session()->put('cart_notes', $validated['notes'] ?? '');

        return response()->json($this->cartPayload($request));
    }

    private function assertCartOwner(Request $request, CartItem $cartItem): void
    {
        abort_unless(hash_equals($request->session()->getId(), $cartItem->session_id), 404);
    }

    private function cartPayload(Request $request): array
    {
        $items = CartItem::with('product')
            ->where('session_id', $request->session()->getId())
            ->orderBy('created_at')
            ->get();
        $subtotal = $items->where('is_selected', true)->sum(fn (CartItem $item) => (float) $item->product->price * $item->quantity);
        $coupon = Coupon::where('code', $request->session()->get('cart_coupon'))
            ->where('is_active', true)
            ->first();
        $discount = $coupon ? round($subtotal * $coupon->discount_percentage / 100, 2) : 0;

        return [
            'items' => $items->map(fn (CartItem $item) => [
                'id' => $item->id,
                'product_id' => $item->product_id,
                'name' => $item->product->name,
                'image_url' => $item->product->image_url,
                'price' => (float) $item->product->price,
                'size' => $item->size,
                'length' => $item->length,
                'quantity' => $item->quantity,
                'is_selected' => $item->is_selected,
                'update_url' => route('cart.items.update', $item),
                'delete_url' => route('cart.items.destroy', $item),
            ])->values(),
            'count' => $items->sum('quantity'),
            'subtotal' => $subtotal,
            'discount' => $discount,
            'total' => max(0, $subtotal - $discount),
            'coupon' => $coupon ? ['code' => $coupon->code, 'percentage' => $coupon->discount_percentage] : null,
            'notes' => $request->session()->get('cart_notes', ''),
        ];
    }
}
