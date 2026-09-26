<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    private const CATEGORIES = ['Classy', 'Coquette', 'Y2K', 'Floral', 'Grunge', 'Tools'];

    private const SIZES = ['XS', 'S', 'M', 'L'];

    private const LENGTHS = ['Short', 'Medium', 'Long'];

    public function index()
    {
        $products = Product::orderByDesc('created_at')->paginate(15);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create', $this->formOptions());
    }

    public function store(Request $request)
    {
        $validated = $this->validatedData($request);
        $validated['size'] = $validated['available_sizes'][0];

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dibuat.');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', array_merge($this->formOptions(), compact('product')));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $this->validatedData($request);
        $validated['size'] = $validated['available_sizes'][0];
        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }

    private function formOptions(): array
    {
        return [
            'categories' => self::CATEGORIES,
            'sizes' => self::SIZES,
            'lengths' => self::LENGTHS,
        ];
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'available_sizes' => ['required', 'array', 'min:1'],
            'available_sizes.*' => ['required', 'string', Rule::in(self::SIZES)],
            'available_lengths' => ['required', 'array', 'min:1'],
            'available_lengths.*' => ['required', 'string', Rule::in(self::LENGTHS)],
            'category' => ['required', 'string', Rule::in(self::CATEGORIES)],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'image_url' => ['nullable', 'string', 'max:2048'],
            'is_active' => ['nullable', 'boolean'],
        ]) + ['is_active' => $request->boolean('is_active')];
    }
}
