<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'size',
        'available_sizes',
        'available_lengths',
        'category',
        'price',
        'image_url',
        'stock',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'available_sizes' => 'array',
        'available_lengths' => 'array',
        'stock' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Scope to filter products by size
     */
    public function scopeBySize($query, $size)
    {
        return $query->where('size', $size)->where('is_active', true);
    }

    /**
     * Scope to get only active products
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Check if product is in stock
     */
    public function inStock()
    {
        return $this->stock > 0;
    }

    public function availableSizes(): array
    {
        return $this->available_sizes ?: [$this->size];
    }

    public function availableLengths(): array
    {
        return $this->available_lengths ?: ['Short', 'Medium', 'Long'];
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    /**
     * Get formatted price
     */
    public function getFormattedPriceAttribute()
    {
        return 'Rp '.number_format($this->price, 0, ',', '.');
    }
}
