<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CatalogView extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'catalog_id',
        'user_id',
        'ip_address',
        'user_agent',
        'viewed_at',
    ];

    protected $casts = [
        'viewed_at' => 'datetime',
    ];

    /**
     * Get the catalog this view belongs to
     */
    public function catalog()
    {
        return $this->belongsTo(NailCatalog::class, 'catalog_id');
    }

    /**
     * Get the user who viewed (if logged in)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
