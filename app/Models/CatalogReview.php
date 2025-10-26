<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CatalogReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'catalog_id',
        'user_id',
        'rating',
        'comment',
        'images',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    /**
     * Get the catalog this review belongs to
     */
    public function catalog()
    {
        return $this->belongsTo(NailCatalog::class, 'catalog_id');
    }

    /**
     * Get the user who wrote this review
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Update catalog rating after save
     */
    protected static function booted()
    {
        static::saved(function ($review) {
            $review->catalog->updateRating();
        });

        static::deleted(function ($review) {
            $review->catalog->updateRating();
        });
    }
}
