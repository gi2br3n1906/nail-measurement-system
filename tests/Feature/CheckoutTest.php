<?php

namespace Tests\Feature;

use App\Models\CartItem;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CheckoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_checkout_page_shows_selected_items_coupon_notes_and_customer_form(): void
    {
        $product = $this->makeProduct();
        Coupon::create(['code' => 'SAVE10', 'discount_percentage' => 10, 'is_active' => true]);
        $this->withCartSession();

        $this->postJson(route('cart.items.store'), [
            'product_id' => $product->id,
            'size' => 'S',
            'length' => 'Medium',
            'quantity' => 2,
        ])->assertOk();
        $this->postJson(route('cart.coupon'), ['code' => 'SAVE10'])->assertOk();
        $this->postJson(route('cart.notes'), ['notes' => 'Please pack carefully'])->assertOk();

        $this->get(route('checkout.index'))
            ->assertOk()
            ->assertSee('Checkout')
            ->assertSee('Checkout set')
            ->assertSee('Size S')
            ->assertSee('Medium')
            ->assertSee('SAVE10')
            ->assertSee('Please pack carefully')
            ->assertSee('name="customer_name"', false)
            ->assertSee('name="customer_phone"', false)
            ->assertSee('name="customer_address"', false);
    }

    public function test_checkout_page_redirects_to_catalog_when_no_item_is_selected(): void
    {
        $this->get(route('checkout.index'))
            ->assertRedirect(route('products.index'));
    }

    public function test_checkout_page_ignores_unselected_items(): void
    {
        $product = $this->makeProduct();
        $sessionId = $this->withCartSession();

        CartItem::create([
            'session_id' => $sessionId,
            'product_id' => $product->id,
            'size' => 'S',
            'length' => 'Medium',
            'quantity' => 1,
            'is_selected' => true,
        ]);
        CartItem::create([
            'session_id' => $sessionId,
            'product_id' => $product->id,
            'size' => 'M',
            'length' => 'Short',
            'quantity' => 1,
            'is_selected' => false,
        ]);

        $response = $this->get(route('checkout.index'))->assertOk();
        $response->assertSee('Size S');
        $response->assertDontSee('Size M');
    }

    public function test_submitting_checkout_builds_a_whatsapp_order_message_and_clears_the_cart(): void
    {
        $product = $this->makeProduct();
        Coupon::create(['code' => 'SAVE10', 'discount_percentage' => 10, 'is_active' => true]);
        $this->withCartSession();

        $this->postJson(route('cart.items.store'), [
            'product_id' => $product->id,
            'size' => 'S',
            'length' => 'Medium',
            'quantity' => 2,
        ])->assertOk();
        $this->postJson(route('cart.coupon'), ['code' => 'SAVE10'])->assertOk();

        $response = $this->post(route('checkout.submit'), [
            'customer_name' => 'Gibran',
            'customer_phone' => '081234567890',
            'customer_address' => 'Jl. Melati No. 1, Jakarta',
        ]);

        $response->assertOk();
        $response->assertSee('wa.me/6281234567890', false);
        $response->assertSee(urlencode('Gibran'), false);
        $response->assertSee(urlencode('Checkout set'), false);

        $this->assertDatabaseMissing('cart_items', ['product_id' => $product->id]);
        $this->assertNull(session('cart_coupon'));
    }

    public function test_checkout_submit_validates_customer_data_and_requires_selected_items(): void
    {
        $this->post(route('checkout.submit'), [])
            ->assertSessionHasErrors(['customer_name', 'customer_phone']);

        $this->post(route('checkout.submit'), [
            'customer_name' => 'Gibran',
            'customer_phone' => '081234567890',
        ])->assertRedirect(route('products.index'));
    }

    private function withCartSession(): string
    {
        $sessionId = str_repeat('b', 40);
        $this->withCredentials()->withCookie(config('session.cookie'), $sessionId);

        return $sessionId;
    }

    private function makeProduct(): Product
    {
        return Product::create([
            'name' => 'Checkout set',
            'description' => 'Press-on nails',
            'size' => 'S',
            'category' => 'Classy',
            'available_sizes' => ['S', 'M'],
            'available_lengths' => ['Short', 'Medium'],
            'price' => 75000,
            'stock' => 5,
            'is_active' => true,
        ]);
    }
}
