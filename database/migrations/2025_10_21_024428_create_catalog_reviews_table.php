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
        Schema::create('catalog_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('catalog_id')->constrained('nail_catalogs')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->integer('rating'); // 1-5 stars
            $table->text('comment')->nullable();
            $table->json('images')->nullable(); // Optional review images
            $table->timestamps();

            // Prevent duplicate reviews from same user
            $table->unique(['catalog_id', 'user_id']);

            // Indexes
            $table->index('catalog_id');
            $table->index('user_id');
            $table->index('rating');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalog_reviews');
    }
};
