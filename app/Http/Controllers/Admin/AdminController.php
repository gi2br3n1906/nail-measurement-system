<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Measurement;
use App\Models\Product;
use App\Models\SizeStandard;
use App\Models\User;
use App\Models\NailCatalog;
use App\Models\CatalogReview;
use App\Models\CatalogView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Original Statistics (Measurements)
        $totalMeasurements = Measurement::count();
        $totalProducts = Product::count();
        $totalSizeStandards = SizeStandard::where('is_active', true)->count();

        // Recent measurements
        $recentMeasurements = Measurement::orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        // Size distribution
        $sizeDistribution = Measurement::select('classified_size_right', DB::raw('count(*) as count'))
            ->groupBy('classified_size_right')
            ->get();

        // Monthly measurements
        $monthlyMeasurements = Measurement::select(
            DB::raw('strftime("%Y-%m", created_at) as month'),
            DB::raw('count(*) as count')
        )
            ->groupBy('month')
            ->orderBy('month', 'desc')
            ->take(6)
            ->get();

        // NEW: Nailist Management Statistics
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
        $averageRating = round(CatalogReview::avg('rating') ?? 0, 1);
        $newReviewsThisMonth = CatalogReview::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // View Statistics
        $totalViews = CatalogView::count();
        $viewsThisMonth = CatalogView::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Recent Nailist Registrations
        $recentNailists = User::whereJsonContains('roles', 'nailist')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Popular Catalogs - Top 5 by views
        $popularCatalogs = NailCatalog::with('nailist')
            ->where('is_active', true)
            ->orderBy('view_count', 'desc')
            ->limit(5)
            ->get();

        // Category Distribution
        $categoryStats = NailCatalog::select('category', DB::raw('count(*) as total'))
            ->where('is_active', true)
            ->groupBy('category')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            // Original variables
            'totalMeasurements',
            'totalProducts',
            'totalSizeStandards',
            'recentMeasurements',
            'sizeDistribution',
            'monthlyMeasurements',
            // New nailist management variables
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
            'categoryStats'
        ));
    }

    public function login()
    {
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt($credentials)) {
            $user = auth()->user();

            // Check if user has admin or nailist role
            if ($user->hasAnyRole(['admin', 'nailist'])) {
                $request->session()->regenerate();

                // Redirect to role selection if multiple roles, otherwise direct to dashboard
                if (count($user->roles) > 1) {
                    return redirect()->route('role.selection');
                }

                // Single role - redirect directly
                session(['active_role' => $user->roles[0]]);
                return redirect()->route($user->roles[0] . '.dashboard');
            }

            auth()->logout();
            return back()->withErrors([
                'email' => 'You do not have admin or nailist access.',
            ]);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
