<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Measurement extends Model
{
    use HasFactory;

    protected $fillable = [
        'right_hand_data',
        'left_hand_data',
        'classified_size_right',
        'classified_size_left',
        'confidence_score',
    ];

    protected $casts = [
        'right_hand_data' => 'array',
        'left_hand_data' => 'array',
        'confidence_score' => 'decimal:2',
    ];

    /**
     * Get the date formatted
     */
    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('d M Y, H:i');
    }

    /**
     * Get the average measurement for right hand
     */
    public function getRightHandAverageAttribute()
    {
        if (!$this->right_hand_data) {
            return 0;
        }
        return round(array_sum($this->right_hand_data) / count($this->right_hand_data), 1);
    }

    /**
     * Get the average measurement for left hand
     */
    public function getLeftHandAverageAttribute()
    {
        if (!$this->left_hand_data) {
            return 0;
        }
        return round(array_sum($this->left_hand_data) / count($this->left_hand_data), 1);
    }
}
