<?php

namespace App\Http\Controllers\Nailist;

use App\Http\Controllers\Controller;
use App\Models\NailCatalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nailist = auth()->user();
        $catalogs = NailCatalog::where('nailist_id', $nailist->id)
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('nailist.catalogs.index', compact('catalogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('nailist.catalogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string',
            'difficulty' => 'required|in:easy,medium,hard',
            'duration_minutes' => 'required|integer|min:1',
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpeg,jpg,png,webp|max:2048',
        ]);

        // Upload images
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('catalog-images', 'public');
                $imagePaths[] = $path;
            }
        }

        // Create catalog
        NailCatalog::create([
            'nailist_id' => auth()->id(),
            'title' => $validated['title'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'category' => $validated['category'],
            'difficulty' => $validated['difficulty'],
            'duration_minutes' => $validated['duration_minutes'],
            'images' => $imagePaths,
            'is_active' => true,
        ]);

        return redirect()->route('nailist.catalogs.index')
            ->with('success', 'Catalog created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(NailCatalog $catalog)
    {
        // Ensure nailist owns this catalog
        if ($catalog->nailist_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $catalog->load('reviews.user');

        return view('nailist.catalogs.show', compact('catalog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NailCatalog $catalog)
    {
        // Ensure nailist owns this catalog
        if ($catalog->nailist_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('nailist.catalogs.edit', compact('catalog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NailCatalog $catalog)
    {
        // Ensure nailist owns this catalog
        if ($catalog->nailist_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string',
            'difficulty' => 'required|in:easy,medium,hard',
            'duration_minutes' => 'required|integer|min:1',
            'new_images' => 'nullable|array',
            'new_images.*' => 'image|mimes:jpeg,jpg,png,webp|max:2048',
            'keep_images' => 'nullable|array',
        ]);

        // Handle images
        $imagePaths = [];

        // Keep selected existing images
        if ($request->has('keep_images')) {
            foreach ($request->keep_images as $imagePath) {
                if (in_array($imagePath, $catalog->images)) {
                    $imagePaths[] = $imagePath;
                }
            }
        }

        // Upload new images
        if ($request->hasFile('new_images')) {
            foreach ($request->file('new_images') as $image) {
                $path = $image->store('catalog-images', 'public');
                $imagePaths[] = $path;
            }
        }

        // Delete removed images
        $removedImages = array_diff($catalog->images, $imagePaths);
        foreach ($removedImages as $imagePath) {
            Storage::disk('public')->delete($imagePath);
        }

        // Update catalog
        $catalog->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'category' => $validated['category'],
            'difficulty' => $validated['difficulty'],
            'duration_minutes' => $validated['duration_minutes'],
            'images' => $imagePaths,
        ]);

        return redirect()->route('nailist.catalogs.index')
            ->with('success', 'Catalog updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NailCatalog $catalog)
    {
        // Ensure nailist owns this catalog
        if ($catalog->nailist_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Delete images
        foreach ($catalog->images as $imagePath) {
            Storage::disk('public')->delete($imagePath);
        }

        $catalog->delete();

        return redirect()->route('nailist.catalogs.index')
            ->with('success', 'Catalog deleted successfully!');
    }
}
