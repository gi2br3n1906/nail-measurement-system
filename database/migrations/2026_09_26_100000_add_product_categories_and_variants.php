<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('category')->default('Classy');
            $table->json('available_sizes')->nullable();
            $table->json('available_lengths')->nullable();
        });

        DB::table('products')->select('id', 'name', 'size')->orderBy('id')->get()->each(function ($product): void {
            $size = $product->size === 'XL' ? 'L' : $product->size;
            $name = strtolower($product->name);
            $category = match (true) {
                str_contains($name, 'tool'), str_contains($name, 'file') => 'Tools',
                str_contains($name, 'floral'), str_contains($name, 'flower') => 'Floral',
                str_contains($name, 'black'), str_contains($name, 'grunge') => 'Grunge',
                str_contains($name, 'y2k'), str_contains($name, 'ombre') => 'Y2K',
                str_contains($name, 'glitter'), str_contains($name, 'sparkle'), str_contains($name, 'crystal') => 'Coquette',
                default => 'Classy',
            };

            DB::table('products')->where('id', $product->id)->update([
                'size' => $size,
                'category' => $category,
                'available_sizes' => json_encode([$size]),
                'available_lengths' => json_encode(['Short', 'Medium', 'Long']),
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['category', 'available_sizes', 'available_lengths']);
        });
    }
};
