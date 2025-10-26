<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\NailCatalog;

class NailistController extends Controller
{
    /**
     * Display list of nailists (pending, approved, rejected)
     */
    public function index(Request $request)
    {
        $status = $request->get('status', 'pending'); // pending, approved, rejected, all

        $query = User::whereJsonContains('roles', 'nailist')
            ->withCount(['catalogs as total_catalogs' => function($query) {
                $query->where('is_active', true);
            }]);

        // Filter by approval status
        if ($status === 'pending') {
            $query->whereNull('is_nailist_approved');
        } elseif ($status === 'approved') {
            $query->where('is_nailist_approved', true);
        } elseif ($status === 'rejected') {
            $query->where('is_nailist_approved', false);
        }
        // 'all' = no filter

        $nailists = $query->orderBy('created_at', 'desc')->paginate(15);

        // Get counts for tabs
        $pendingCount = User::whereJsonContains('roles', 'nailist')
            ->whereNull('is_nailist_approved')
            ->count();
        $approvedCount = User::whereJsonContains('roles', 'nailist')
            ->where('is_nailist_approved', true)
            ->count();
        $rejectedCount = User::whereJsonContains('roles', 'nailist')
            ->where('is_nailist_approved', false)
            ->count();

        return view('admin.nailists.index', compact(
            'nailists',
            'status',
            'pendingCount',
            'approvedCount',
            'rejectedCount'
        ));
    }

    /**
     * Show detailed view of a nailist for review
     */
    public function show($id)
    {
        $nailist = User::whereJsonContains('roles', 'nailist')
            ->with(['catalogs' => function($query) {
                $query->latest()->limit(10);
            }])
            ->findOrFail($id);

        // Get statistics
        $stats = [
            'total_catalogs' => $nailist->catalogs()->where('is_active', true)->count(),
            'total_views' => $nailist->catalogs()->where('is_active', true)->sum('view_count'),
            'total_reviews' => $nailist->catalogs()->where('is_active', true)->sum('review_count'),
            'average_rating' => $nailist->catalogs()
                ->where('is_active', true)
                ->where('review_count', '>', 0)
                ->avg('average_rating') ?? 0,
        ];

        return view('admin.nailists.show', compact('nailist', 'stats'));
    }

    /**
     * Approve a nailist
     */
    public function approve($id)
    {
        $nailist = User::whereJsonContains('roles', 'nailist')->findOrFail($id);

        $nailist->update([
            'is_nailist_approved' => true,
            'approved_at' => now(),
        ]);

        // TODO: Send email notification to nailist

        return redirect()->route('admin.nailists.index', ['status' => 'pending'])
            ->with('success', 'Nailist berhasil di-approve! ' . $nailist->name . ' sekarang dapat mempublikasikan katalog.');
    }

    /**
     * Reject a nailist with reason
     */
    public function reject(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:500',
        ]);

        $nailist = User::whereJsonContains('roles', 'nailist')->findOrFail($id);

        $nailist->update([
            'is_nailist_approved' => false,
            'rejection_reason' => $request->rejection_reason,
        ]);

        // TODO: Send email notification to nailist with reason

        return redirect()->route('admin.nailists.index', ['status' => 'pending'])
            ->with('success', 'Nailist telah ditolak. Alasan telah dikirim ke nailist.');
    }

    /**
     * Reset approval status (back to pending)
     */
    public function resetApproval($id)
    {
        $nailist = User::whereJsonContains('roles', 'nailist')->findOrFail($id);

        $nailist->update([
            'is_nailist_approved' => null,
            'approved_at' => null,
            'rejection_reason' => null,
        ]);

        return redirect()->back()
            ->with('success', 'Status approval nailist telah direset ke pending.');
    }
}
