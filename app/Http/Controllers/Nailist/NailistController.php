<?php

namespace App\Http\Controllers\Nailist;

use App\Http\Controllers\Controller;
use App\Models\NailCatalog;
use App\Models\CatalogView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NailistController extends Controller
{
    public function dashboard()
    {
        $nailist = auth()->user();

        // Check if user is approved nailist
        if (!$nailist->hasRole('nailist') || !$nailist->is_nailist_approved) {
            return redirect()->route('home')->with('error', 'You need to be an approved nailist to access this panel.');
        }

        // Statistics
        $totalCatalogs = NailCatalog::where('nailist_id', $nailist->id)->count();
        $activeCatalogs = NailCatalog::where('nailist_id', $nailist->id)
            ->where('is_active', true)
            ->count();
        $totalViews = NailCatalog::where('nailist_id', $nailist->id)->sum('view_count');
        $totalReviews = NailCatalog::where('nailist_id', $nailist->id)->sum('review_count');
        $averageRating = NailCatalog::where('nailist_id', $nailist->id)
            ->where('review_count', '>', 0)
            ->avg('average_rating');

        // Recent catalogs
        $recentCatalogs = NailCatalog::where('nailist_id', $nailist->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Top performing catalogs
        $topCatalogs = NailCatalog::where('nailist_id', $nailist->id)
            ->where('is_active', true)
            ->orderBy('view_count', 'desc')
            ->take(5)
            ->get();

        // Category distribution
        $categoryDistribution = NailCatalog::where('nailist_id', $nailist->id)
            ->select('category', DB::raw('count(*) as count'))
            ->groupBy('category')
            ->get();

        // Monthly views (last 6 months)
        $monthlyViews = CatalogView::whereIn('catalog_id', function($query) use ($nailist) {
                $query->select('id')
                    ->from('nail_catalogs')
                    ->where('nailist_id', $nailist->id);
            })
            ->select(
                DB::raw('strftime("%Y-%m", viewed_at) as month'),
                DB::raw('count(*) as count')
            )
            ->groupBy('month')
            ->orderBy('month', 'desc')
            ->take(6)
            ->get();

        return view('nailist.dashboard', compact(
            'nailist',
            'totalCatalogs',
            'activeCatalogs',
            'totalViews',
            'totalReviews',
            'averageRating',
            'recentCatalogs',
            'topCatalogs',
            'categoryDistribution',
            'monthlyViews'
        ));
    }

    public function profile()
    {
        $nailist = auth()->user();
        return view('nailist.profile', compact('nailist'));
    }

    public function updateProfile(Request $request)
    {
        $nailist = auth()->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'salon_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'instagram' => 'nullable|string|max:100',
            'bio' => 'nullable|string|max:1000',
            'address' => 'nullable|string|max:500',
            'profile_photo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $validated['profile_photo'] = $path;
        }

        $nailist->update($validated);

        return back()->with('success', 'Profile updated successfully!');
    }
}
