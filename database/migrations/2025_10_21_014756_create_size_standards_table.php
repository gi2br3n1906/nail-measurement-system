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
        Schema::create('size_standards', function (Blueprint $table) {
            $table->id();
            $table->string('size_name'); // XS, S, M, L, XL, XXL
            $table->decimal('jempol', 5, 2);
            $table->decimal('telunjuk', 5, 2);
            $table->decimal('tengah', 5, 2);
            $table->decimal('manis', 5, 2);
            $table->decimal('kelingking', 5, 2);
            $table->decimal('tolerance', 5, 2)->default(1.0); // Tolerance in mm
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('size_standards');
    }
};
