<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private const CATEGORIES = ['Classy', 'Coquette', 'Y2K', 'Floral', 'Grunge', 'Tools'];

    /**
     * Display all products with filtering
     */
    public function index(Request $request)
    {
        $query = Product::active();

        $category = $request->input('category');
        if ($category !== 'All Styles' && in_array($category, self::CATEGORIES, true)) {
            $query->where('category', $category);
        }

        // Search by name or description
        if ($request->has('search') && $request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%'.$request->search.'%')
                    ->orWhere('description', 'like', '%'.$request->search.'%');
            });
        }

        // Sort products
        $sortBy = $request->get('sort', 'newest');
        switch ($sortBy) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        $products = $query->paginate(12);

        // If AJAX request, return only the products HTML partial
        if ($request->ajax()) {
            return view('products.partials.product-list', compact('products'))->render();
        }

        return view('products.index', [
            'products' => $products,
            'categories' => ['All Styles', ...self::CATEGORIES],
        ]);
    }

    /**
     * Display single product detail
     */
    public function show($id)
    {
        $product = Product::active()->findOrFail($id);

        // Get related products (same size, different product)
        $relatedProducts = Product::active()
            ->where('size', $product->size)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }
}
