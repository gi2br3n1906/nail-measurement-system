<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\NailCatalog;

class HomeController extends Controller
{
    public function index()
    {
        // Get 8 active products for the catalog section
        $products = Product::active()
            ->orderBy('created_at', 'desc')
            ->limit(8)
            ->get();

        // Get 8 featured nail catalogs (active, sorted by views)
        $catalogs = NailCatalog::active()
            ->with('nailist:id,name,salon_name')
            ->orderBy('view_count', 'desc')
            ->limit(8)
            ->get();

        return view('home', compact('products', 'catalogs'));
    }
}
