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
        Schema::create('nail_catalogs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nailist_id')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->json('images'); // Array of image paths
            $table->decimal('price', 10, 2);
            $table->string('category'); // french, ombre, glitter, 3d, minimalist, etc
            $table->string('difficulty')->default('medium'); // easy, medium, hard
            $table->integer('duration_minutes')->default(60);
            $table->boolean('is_active')->default(true); // Admin can takedown
            $table->integer('view_count')->default(0);
            $table->integer('like_count')->default(0);
            $table->decimal('average_rating', 3, 2)->default(0);
            $table->integer('review_count')->default(0);
            $table->timestamps();

            // Indexes for better performance
            $table->index('nailist_id');
            $table->index('category');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nail_catalogs');
    }
};
