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
        Schema::create('catalog_views', function (Blueprint $table) {
            $table->id();
            $table->foreignId('catalog_id')->constrained('nail_catalogs')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamp('viewed_at');

            // Indexes for analytics
            $table->index('catalog_id');
            $table->index('user_id');
            $table->index('viewed_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalog_views');
    }
};
