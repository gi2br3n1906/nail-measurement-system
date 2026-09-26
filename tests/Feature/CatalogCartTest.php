<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CatalogCartTest extends TestCase
{
    use RefreshDatabase;

    public function test_catalog_filters_products_by_category(): void
    {
        Product::create([
            'name' => 'Y2K shimmer',
            'description' => 'A glitter press-on set',
            'size' => 'M',
            'category' => 'Y2K',
            'available_lengths' => ['Short', 'Long'],
            'price' => 90000,
            'stock' => 5,
            'is_active' => true,
        ]);

        Product::create([
            'name' => 'Classic set',
            'description' => 'A minimal manicure set',
            'size' => 'S',
            'category' => 'Classy',
            'available_lengths' => ['Short'],
            'price' => 80000,
            'stock' => 4,
            'is_active' => true,
        ]);

        $response = $this->get(route('products.index', ['category' => 'Y2K']), [
            'X-Requested-With' => 'XMLHttpRequest',
        ]);

        $response->assertOk()
            ->assertSee('Y2K shimmer')
            ->assertDontSee('Classic set');
    }

    public function test_catalog_view_renders_category_filter_and_no_size_filter(): void
    {
        $this->get(route('products.index'))
            ->assertOk()
            ->assertSee('name="category"', false)
            ->assertSee('All Styles')
            ->assertSee('Classy')
            ->assertSee('Coquette')
            ->assertSee('Y2K')
            ->assertSee('Floral')
            ->assertSee('Grunge')
            ->assertSee('Tools')
            ->assertDontSee('name="size"', false);
    }

    public function test_product_detail_renders_available_size_length_and_add_to_cart_form(): void
    {
        $product = Product::create([
            'name' => 'Velvet press-on set',
            'description' => 'Hand-painted velvet finish',
            'size' => 'S',
            'available_sizes' => ['S', 'M', 'L'],
            'available_lengths' => ['Short', 'Long'],
            'category' => 'Coquette',
            'price' => 125000,
            'stock' => 8,
            'is_active' => true,
        ]);

        $this->get(route('products.show', $product->id))
            ->assertOk()
            ->assertSee('data-cart-add-form', false)
            ->assertSee('name="product_id"', false)
            ->assertSee('name="size"', false)
            ->assertSee('name="length"', false)
            ->assertSee('value="M"', false)
            ->assertSee('value="Long"', false)
            ->assertSee(route('cart.items.store'), false);
    }

    public function test_storefront_navbar_includes_cart_drawer_controls_and_ajax_fields(): void
    {
        $this->get(route('products.index'))
            ->assertOk()
            ->assertSee('data-cart-open', false)
            ->assertSee('data-cart-drawer', false)
            ->assertSee('Discount Code')
            ->assertSee('Add Notes')
            ->assertSee('data-cart-items', false)
            ->assertSee('name="code"', false)
            ->assertSee('name="notes"', false)
            ->assertSee(route('cart.coupon'), false)
            ->assertSee(route('cart.notes'), false);
    }

    public function test_guest_can_add_a_product_with_an_available_length_to_the_session_cart(): void
    {
        $product = Product::create([
            'name' => 'French manicure set',
            'description' => 'Classic press-on nails',
            'size' => 'S',
            'category' => 'Classy',
            'available_lengths' => ['Short', 'Medium'],
            'price' => 75000,
            'stock' => 5,
            'is_active' => true,
        ]);

        $response = $this->postJson(route('cart.items.store'), [
            'product_id' => $product->id,
            'size' => 'S',
            'length' => 'Medium',
            'quantity' => 2,
        ]);

        $response->assertOk()
            ->assertJsonPath('count', 2)
            ->assertJsonPath('items.0.name', 'French manicure set')
            ->assertJsonPath('items.0.size', 'S')
            ->assertJsonPath('items.0.length', 'Medium');

        $this->assertDatabaseHas('cart_items', [
            'product_id' => $product->id,
            'size' => 'S',
            'length' => 'Medium',
            'quantity' => 2,
        ]);
    }

    public function test_cart_rejects_a_length_not_available_for_the_product(): void
    {
        $product = Product::create([
            'name' => 'Short set',
            'description' => 'Short only',
            'size' => 'XS',
            'category' => 'Classy',
            'available_lengths' => ['Short'],
            'price' => 75000,
            'stock' => 5,
            'is_active' => true,
        ]);

        $this->postJson(route('cart.items.store'), [
            'product_id' => $product->id,
            'size' => 'XS',
            'length' => 'Long',
            'quantity' => 1,
        ])->assertUnprocessable()
            ->assertJsonValidationErrors('length');
    }
}
