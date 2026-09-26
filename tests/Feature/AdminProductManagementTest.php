<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminProductManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_regular_customer_cannot_access_product_management(): void
    {
        $customer = User::factory()->create(['roles' => ['customer']]);

        $this->actingAs($customer)
            ->get(route('admin.products.index'))
            ->assertForbidden();
    }

    public function test_admin_can_view_product_index_and_create_and_edit_forms(): void
    {
        $admin = User::factory()->create(['roles' => ['admin']]);
        $product = Product::create([
            'name' => 'Velvet press-on set',
            'description' => 'Hand-painted velvet finish',
            'size' => 'S',
            'available_sizes' => ['S', 'M'],
            'available_lengths' => ['Short', 'Long'],
            'category' => 'Coquette',
            'price' => 125000,
            'stock' => 8,
            'is_active' => true,
        ]);

        $this->actingAs($admin)
            ->get(route('admin.products.index'))
            ->assertOk()
            ->assertSee('Velvet press-on set');

        $this->actingAs($admin)
            ->get(route('admin.products.create'))
            ->assertOk()
            ->assertSee('name="available_sizes[]"', false)
            ->assertSee('name="available_lengths[]"', false);

        $this->actingAs($admin)
            ->get(route('admin.products.edit', $product))
            ->assertOk()
            ->assertSee('Velvet press-on set');
    }

    public function test_guest_is_redirected_and_non_admin_is_forbidden_from_product_management(): void
    {
        $this->get(route('admin.products.index'))->assertRedirect();

        $customer = User::factory()->create(['roles' => ['customer']]);
        $this->actingAs($customer)
            ->get(route('admin.products.index'))
            ->assertForbidden();
    }

    public function test_admin_can_create_a_product_with_multiple_sizes_and_lengths(): void
    {
        $admin = User::factory()->create(['roles' => ['admin']]);

        $response = $this->actingAs($admin)->post(route('admin.products.store'), [
            'name' => 'Velvet press-on set',
            'description' => 'Hand-painted velvet finish',
            'available_sizes' => ['S', 'M', 'L'],
            'available_lengths' => ['Short', 'Long'],
            'category' => 'Coquette',
            'price' => 125000,
            'stock' => 8,
            'is_active' => '1',
        ]);

        $response->assertRedirect(route('admin.products.index'));

        $product = Product::where('name', 'Velvet press-on set')->firstOrFail();
        $this->assertSame(['S', 'M', 'L'], $product->availableSizes());
        $this->assertSame(['Short', 'Long'], $product->availableLengths());
        $this->assertSame('S', $product->size);
        $this->assertSame('Coquette', $product->category);
    }
}
