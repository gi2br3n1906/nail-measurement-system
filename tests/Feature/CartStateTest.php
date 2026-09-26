<?php

namespace Tests\Feature;

use App\Models\CartItem;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartStateTest extends TestCase
{
    use RefreshDatabase;

    public function test_cart_item_from_another_session_cannot_be_updated_or_deleted(): void
    {
        $product = $this->makeProduct();
        $cartItem = CartItem::create([
            'session_id' => 'another-browser-session',
            'product_id' => $product->id,
            'size' => 'S',
            'length' => 'Medium',
            'quantity' => 1,
            'is_selected' => true,
        ]);

        $this->patchJson(route('cart.items.update', $cartItem), ['quantity' => 2])->assertNotFound();
        $this->deleteJson(route('cart.items.destroy', $cartItem))->assertNotFound();

        $this->assertDatabaseHas('cart_items', ['id' => $cartItem->id, 'quantity' => 1]);
    }

    public function test_coupon_discount_and_notes_are_reflected_in_the_cart_payload(): void
    {
        $product = $this->makeProduct();
        Coupon::create([
            'code' => 'SAVE10',
            'discount_percentage' => 10,
            'is_active' => true,
        ]);
        $sessionId = str_repeat('a', 40);
        $this->withCredentials()->withCookie(config('session.cookie'), $sessionId);

        $this->postJson(route('cart.items.store'), [
            'product_id' => $product->id,
            'size' => 'S',
            'length' => 'Medium',
            'quantity' => 2,
        ])->assertOk()
            ->assertJsonPath('subtotal', 150000)
            ->assertJsonPath('count', 2);
        $this->assertSame($sessionId, CartItem::firstOrFail()->session_id);

        $this->postJson(route('cart.coupon'), ['code' => ' save10 '])
            ->assertOk()
            ->assertJsonPath('subtotal', 150000)
            ->assertJsonPath('discount', 15000)
            ->assertJsonPath('total', 135000)
            ->assertJsonPath('coupon.code', 'SAVE10');

        $this->postJson(route('cart.notes'), ['notes' => 'Please pack carefully'])->assertOk();

        $this->getJson(route('cart.items.index'))
            ->assertOk()
            ->assertJsonPath('notes', 'Please pack carefully');
    }

    private function makeProduct(): Product
    {
        return Product::create([
            'name' => 'Cart test set',
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
