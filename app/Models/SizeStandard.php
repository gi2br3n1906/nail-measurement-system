<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SizeStandard extends Model
{
    protected $fillable = [
        'size_name',
        'jempol',
        'telunjuk',
        'tengah',
        'manis',
        'kelingking',
        'tolerance',
        'is_active'
    ];

    protected $casts = [
        'jempol' => 'decimal:2',
        'telunjuk' => 'decimal:2',
        'tengah' => 'decimal:2',
        'manis' => 'decimal:2',
        'kelingking' => 'decimal:2',
        'tolerance' => 'decimal:2',
        'is_active' => 'boolean',
    ];
}
