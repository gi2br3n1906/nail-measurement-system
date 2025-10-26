<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NailCatalog;
use App\Models\CatalogView;
use App\Models\CatalogReview;

class CatalogController extends Controller
{
    /**
     * Display a listing of all catalogs
     */
    public function index(Request $request)
    {
        $query = NailCatalog::active()->with('nailist:id,name,salon_name');

        // Filter by category
        if ($request->has('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        // Filter by difficulty
        if ($request->has('difficulty') && $request->difficulty !== 'all') {
            $query->where('difficulty', $request->difficulty);
        }

        // Search by title or description
        if ($request->has('search') && $request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // Sort
        $sort = $request->get('sort', 'popular');
        switch ($sort) {
            case 'latest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'rating':
                $query->orderBy('average_rating', 'desc');
                break;
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            default: // popular
                $query->orderBy('view_count', 'desc');
        }

        $catalogs = $query->paginate(12);

        return view('catalogs.index', compact('catalogs'));
    }

    /**
     * Display the specified catalog
     */
    public function show($id)
    {
        $catalog = NailCatalog::with([
            'nailist:id,name,salon_name,bio,phone,whatsapp,instagram,address',
            'reviews' => function ($query) {
                $query->with('user:id,name')->latest()->limit(10);
            }
        ])->findOrFail($id);

        // Check if catalog is active
        if (!$catalog->is_active) {
            abort(404, 'Catalog not found or has been removed.');
        }

        // Track view (only once per user per catalog per session)
        $sessionKey = 'viewed_catalog_' . $id;
        if (!session()->has($sessionKey)) {
            $catalog->incrementViews();

            // Record view for statistics
            CatalogView::create([
                'catalog_id' => $id,
                'user_id' => auth()->id(),
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'viewed_at' => now(),
            ]);

            session()->put($sessionKey, true);
        }

        // Get other catalogs from same nailist
        $otherCatalogs = NailCatalog::active()
            ->where('nailist_id', $catalog->nailist_id)
            ->where('id', '!=', $id)
            ->orderBy('view_count', 'desc')
            ->limit(4)
            ->get();

        // Check if user has already reviewed this catalog
        $userReview = CatalogReview::where('catalog_id', $id)
            ->where('user_id', auth()->id())
            ->first();

        return view('catalogs.show', compact('catalog', 'otherCatalogs', 'userReview'));
    }

    /**
     * Display nailist public profile
     */
    public function nailistProfile($nailistId)
    {
        $nailist = \App\Models\User::whereJsonContains('roles', 'nailist')
            ->findOrFail($nailistId);

        // Get all catalogs from this nailist
        $catalogs = NailCatalog::active()
            ->where('nailist_id', $nailistId)
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        // Calculate statistics
        $totalViews = NailCatalog::where('nailist_id', $nailistId)
            ->where('is_active', true)
            ->sum('view_count');

        $totalReviews = NailCatalog::where('nailist_id', $nailistId)
            ->where('is_active', true)
            ->sum('review_count');

        $averageRating = NailCatalog::where('nailist_id', $nailistId)
            ->where('is_active', true)
            ->where('review_count', '>', 0)
            ->avg('average_rating');

        $totalDesigns = NailCatalog::where('nailist_id', $nailistId)
            ->where('is_active', true)
            ->count();

        // Get popular categories
        $popularCategories = NailCatalog::where('nailist_id', $nailistId)
            ->where('is_active', true)
            ->select('category', \DB::raw('count(*) as total'))
            ->groupBy('category')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();

        return view('catalogs.nailist-profile', compact(
            'nailist',
            'catalogs',
            'totalViews',
            'totalReviews',
            'averageRating',
            'totalDesigns',
            'popularCategories'
        ));
    }
}
