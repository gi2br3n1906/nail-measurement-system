<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CatalogReview;
use App\Models\NailCatalog;

class ReviewController extends Controller
{
    /**
     * Store a new review for a catalog
     */
    public function store(Request $request, $catalogId)
    {
        $catalog = NailCatalog::findOrFail($catalogId);

        // Validate input
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        // Check if user already reviewed this catalog
        $existingReview = CatalogReview::where('catalog_id', $catalogId)
            ->where('user_id', auth()->id())
            ->first();

        if ($existingReview) {
            return back()->withErrors([
                'review' => 'Anda sudah memberikan review untuk design ini.'
            ]);
        }

        // Create review
        CatalogReview::create([
            'catalog_id' => $catalogId,
            'user_id' => auth()->id(),
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        return back()->with('success', 'Terima kasih atas review Anda!');
    }

    /**
     * Update an existing review
     */
    public function update(Request $request, $catalogId, $reviewId)
    {
        $review = CatalogReview::where('id', $reviewId)
            ->where('catalog_id', $catalogId)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        // Validate input
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        // Update review
        $review->update([
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        return back()->with('success', 'Review Anda berhasil diperbarui!');
    }

    /**
     * Delete a review
     */
    public function destroy($catalogId, $reviewId)
    {
        $review = CatalogReview::where('id', $reviewId)
            ->where('catalog_id', $catalogId)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $review->delete();

        return back()->with('success', 'Review Anda berhasil dihapus.');
    }
}
