<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'product_id',
        'size',
        'length',
        'quantity',
        'is_selected',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'is_selected' => 'boolean',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
