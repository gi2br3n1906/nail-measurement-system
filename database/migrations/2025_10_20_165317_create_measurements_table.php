<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('measurements', function (Blueprint $table) {
            $table->id();
            $table->json('right_hand_data'); // Store all 5 finger measurements for right hand
            $table->json('left_hand_data')->nullable(); // Store all 5 finger measurements for left hand (optional)
            $table->string('classified_size_right'); // XS, S, M, XL, or Custom
            $table->string('classified_size_left')->nullable(); // For left hand if different
            $table->decimal('confidence_score', 5, 2)->nullable(); // How close the match is (0-100%)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('measurements');
    }
};
