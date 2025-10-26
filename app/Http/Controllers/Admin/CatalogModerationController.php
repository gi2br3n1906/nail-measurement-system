<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NailCatalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CatalogModerationController extends Controller
{
    /**
     * Display a listing of all catalogs
     */
    public function index(Request $request)
    {
        $status = $request->get('status', 'all'); // all, active, inactive
        $category = $request->get('category');
        $search = $request->get('search');

    $query = NailCatalog::with(['nailist' => function($q) { $q->with('catalogs'); }]);

        // Filter by status
        if ($status === 'active') {
            $query->where('is_active', true);
        } elseif ($status === 'inactive') {
            $query->where('is_active', false);
        }

        // Filter by category
        if ($category) {
            $query->where('category', $category);
        }

        // Search by title or nailist name
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhereHas('nailist', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            });
        }

        $catalogs = $query->orderBy('created_at', 'desc')->paginate(15);

        // Statistics for tabs
        $totalCatalogs = NailCatalog::count();
        $activeCatalogs = NailCatalog::where('is_active', true)->count();
        $inactiveCatalogs = NailCatalog::where('is_active', false)->count();

        // Get all categories for filter
        $categories = NailCatalog::select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('admin.catalogs.index', compact(
            'catalogs',
            'totalCatalogs',
            'activeCatalogs',
            'inactiveCatalogs',
            'status',
            'category',
            'search',
            'categories'
        ));
    }

    /**
     * Display the specified catalog
     */
    public function show($id)
    {
        $catalog = NailCatalog::with(['nailist' => function($q) { $q->with('catalogs'); }, 'reviews.user'])
            ->withCount(['reviews', 'views'])
            ->findOrFail($id);

        return view('admin.catalogs.show', compact('catalog'));
    }

    /**
     * Deactivate (takedown) a catalog
     */
    public function deactivate(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string|max:500',
        ]);

        $catalog = NailCatalog::findOrFail($id);
        $catalog->is_active = false;
        $catalog->moderation_reason = $request->reason;
        $catalog->moderated_at = now();
        $catalog->moderated_by = auth()->id();
        $catalog->save();

        // TODO: Send notification to nailist

        return redirect()->back()->with('success', 'Catalog has been deactivated successfully.');
    }

    /**
     * Restore (reactivate) a catalog
     */
    public function restore($id)
    {
        $catalog = NailCatalog::findOrFail($id);
        $catalog->is_active = true;
        $catalog->moderation_reason = null;
        $catalog->moderated_at = null;
        $catalog->moderated_by = null;
        $catalog->save();

        // TODO: Send notification to nailist

        return redirect()->back()->with('success', 'Catalog has been restored successfully.');
    }

    /**
     * Delete a catalog permanently
     */
    public function destroy($id)
    {
        $catalog = NailCatalog::findOrFail($id);

        // TODO: Delete associated images from storage

        $catalog->delete();

        return redirect()->route('admin.catalogs.index')
            ->with('success', 'Catalog has been deleted permanently.');
    }

    /**
     * Remove a single image from the catalog
     */
    public function removeImage(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|string',
        ]);

        $catalog = NailCatalog::findOrFail($id);

        $images = $catalog->images ?? [];
        // images should be array via accessor, but guard anyway
        if (!is_array($images)) {
            $images = is_string($images) ? json_decode($images, true) ?? [] : [];
        }

        $imageToRemove = $request->input('image');

        // Remove matching image(s)
        $updated = array_values(array_filter($images, function ($img) use ($imageToRemove) {
            return $img !== $imageToRemove;
        }));

        // Delete file from storage if it exists and is a local path
        try {
            if (parse_url($imageToRemove, PHP_URL_SCHEME) === null) {
                // local path
                Storage::delete($imageToRemove);
            }
        } catch (\Throwable $e) {
            // ignore storage deletion errors for now
        }

        $catalog->images = $updated;
        $catalog->save();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'images' => $updated,
            ]);
        }
        return redirect()->back()->with('success', 'Image removed successfully.');
    }
}
