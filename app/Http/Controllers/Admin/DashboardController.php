<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\NailCatalog;
use App\Models\CatalogReview;
use App\Models\CatalogView;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Nailist Statistics
        $totalNailists = User::whereJsonContains('roles', 'nailist')->count();
        $pendingNailists = User::whereJsonContains('roles', 'nailist')
            ->whereNull('is_nailist_approved')
            ->count();
        $approvedNailists = User::whereJsonContains('roles', 'nailist')
            ->where('is_nailist_approved', true)
            ->count();
        $rejectedNailists = User::whereJsonContains('roles', 'nailist')
            ->where('is_nailist_approved', false)
            ->count();

        // User Statistics
        $totalUsers = User::whereJsonContains('roles', 'user')->count();
        $newUsersThisMonth = User::whereJsonContains('roles', 'user')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Catalog Statistics
        $totalCatalogs = NailCatalog::count();
        $activeCatalogs = NailCatalog::where('is_active', true)->count();
        $inactiveCatalogs = NailCatalog::where('is_active', false)->count();
        $newCatalogsThisMonth = NailCatalog::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Review Statistics
        $totalReviews = CatalogReview::count();
        $averageRating = CatalogReview::avg('rating') ?? 0;
        $newReviewsThisMonth = CatalogReview::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // View Statistics
        $totalViews = CatalogView::count();
        $viewsThisMonth = CatalogView::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Recent Activities - Latest 10 nailists registered
        $recentNailists = User::whereJsonContains('roles', 'nailist')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Popular Catalogs - Top 5 by views
        $popularCatalogs = NailCatalog::with('nailist')
            ->where('is_active', true)
            ->orderBy('view_count', 'desc')
            ->limit(5)
            ->get();

        // Top Rated Catalogs - Top 5 by rating
        $topRatedCatalogs = NailCatalog::with('nailist')
            ->where('is_active', true)
            ->where('review_count', '>', 0)
            ->orderBy('average_rating', 'desc')
            ->limit(5)
            ->get();

        // Category Distribution
        $categoryStats = NailCatalog::select('category', DB::raw('count(*) as total'))
            ->groupBy('category')
            ->orderBy('total', 'desc')
            ->get();

        return view('admin.dashboard', compact(
            'totalNailists',
            'pendingNailists',
            'approvedNailists',
            'rejectedNailists',
            'totalUsers',
            'newUsersThisMonth',
            'totalCatalogs',
            'activeCatalogs',
            'inactiveCatalogs',
            'newCatalogsThisMonth',
            'totalReviews',
            'averageRating',
            'newReviewsThisMonth',
            'totalViews',
            'viewsThisMonth',
            'recentNailists',
            'popularCatalogs',
            'topRatedCatalogs',
            'categoryStats'
        ));
    }
}
