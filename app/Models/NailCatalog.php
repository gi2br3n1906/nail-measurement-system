<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class NailCatalog extends Model
{
    use HasFactory;

    protected $fillable = [
        'nailist_id',
        'title',
        'description',
        'images',
        'price',
        'category',
        'difficulty',
        'duration_minutes',
        'is_active',
        'view_count',
        'like_count',
        'average_rating',
        'review_count',
    ];

    protected $casts = [
        'images' => 'array',
        'price' => 'decimal:2',
        'is_active' => 'boolean',
        'average_rating' => 'decimal:2',
    ];

    /**
     * Ensure images attribute is always returned as an array.
     * Accepts array, JSON encoded string, single string, or null.
     */
    public function getImagesAttribute($value)
    {
        if (is_array($value)) {
            // sanitize each entry in case values contain extra quotes/slashes
            return array_map([$this, 'normalizeImageEntry'], $value);
        }

        if (is_string($value) && $value !== '') {
            $decoded = json_decode($value, true);
            if (is_array($decoded)) {
                // sanitize each decoded entry
                return array_map([$this, 'normalizeImageEntry'], $decoded);
            }

            // treat single image string as single-element array, sanitize
            return [$this->normalizeImageEntry($value)];
        }

        return [];
    }

    /**
     * Normalize a single image entry coming from the database.
     * - strips surrounding quotes/brackets
     * - removes escape slashes
     * - if looks like a malformed URL (too many slashes), normalize it
     */
    protected function normalizeImageEntry($img)
    {
        if (!is_string($img)) return $img;

        // Trim whitespace and common surrounding characters
        $img = trim($img);
        $img = trim($img, "\"'[] ");

        // Remove escaped slashes (common when JSON is double-encoded)
        $img = str_replace('\\', '', $img);

        // If it looks like an http(s) URL but has excessive slashes, normalize it
        if (preg_match('#^https?:#i', $img)) {
            // Ensure scheme is followed by exactly two slashes
            $img = preg_replace('#^(https?:)/*#i', '\\1//', $img);
            // Normalize repeated slashes in the path portion
            $parts = parse_url($img);
            if ($parts !== false && isset($parts['path'])) {
                $path = preg_replace('#/{2,}#', '/', $parts['path']);
                $host = $parts['host'] ?? '';
                $port = isset($parts['port']) && $parts['port'] !== '' ? ':' . $parts['port'] : '';
                $img = $parts['scheme'] . '://' . $host . $port . $path;
                if (isset($parts['query'])) $img .= '?' . $parts['query'];
            }
        }

        return $img;
    }

    /**
     * Primary image for this catalog.
     * Preference order:
     * 1. this catalog's first valid image
     * 2. another catalog from the same nailist that has a valid image
     * 3. nailist's profile_photo
     * 4. null (views should fallback to placeholder)
     */
    public function getPrimaryImageAttribute()
    {
        // helper to pick first non-empty, non-placeholder-like image
        $pick = function ($images) {
            if (!is_array($images)) return null;
            foreach ($images as $img) {
                if (empty($img)) continue;
                // skip known bad tokens like 'white:1'
                if (is_string($img) && str_starts_with($img, 'white:')) continue;
                // if it's a local path (no scheme), convert to a public URL
                if (is_string($img) && parse_url($img, PHP_URL_SCHEME) === null) {
                    try {
                        return Storage::url($img);
                    } catch (\Throwable $e) {
                        // fallback to raw value
                        return $img;
                    }
                }
                return $img;
            }
            return null;
        };

        // 1) this catalog's own images
        $own = $pick($this->images ?? []);
        if ($own) return $own;

        // (Removed fallback to other catalogs to avoid showing unrelated images)

        // 3) nailist profile photo
        if ($this->relationLoaded('nailist') && $this->nailist && !empty($this->nailist->profile_photo)) {
            return $this->nailist->profile_photo;
        }

        if ($this->nailist_id) {
            $n = $this->nailist()->first(['profile_photo']);
            if ($n && !empty($n->profile_photo)) return $n->profile_photo;
        }

        return null;
    }

    /**
     * Get the nailist who owns this catalog
     */
    public function nailist()
    {
        return $this->belongsTo(User::class, 'nailist_id');
    }

    /**
     * Get all reviews for this catalog
     */
    public function reviews()
    {
        return $this->hasMany(CatalogReview::class, 'catalog_id');
    }

    /**
     * Get all views for this catalog
     */
    public function views()
    {
        return $this->hasMany(CatalogView::class, 'catalog_id');
    }

    /**
     * Increment view count
     */
    public function incrementViews()
    {
        $this->increment('view_count');
    }

    /**
     * Update average rating based on reviews
     */
    public function updateRating()
    {
        $this->average_rating = $this->reviews()->avg('rating') ?? 0;
        $this->review_count = $this->reviews()->count();
        $this->save();
    }

    /**
     * Scope for active catalogs only
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for specific category
     */
    public function scopeCategory($query, $category)
    {
        return $query->where('category', $category);
    }
}
