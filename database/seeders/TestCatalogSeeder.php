<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\NailCatalog;

class TestCatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get approved nailist (Jessica)
        $jessica = User::where('email', 'jessica@nailpro.com')->first();

        if ($jessica) {
            // Create 5 sample catalogs for Jessica
            $designs = [
                ['title' => 'Elegant French Tips', 'description' => 'Classic french manicure with a modern twist', 'category' => 'classic'],
                ['title' => 'Minimalist Nude', 'description' => 'Simple and elegant nude nail design', 'category' => 'minimalist'],
                ['title' => 'Floral Garden', 'description' => 'Beautiful floral patterns perfect for spring', 'category' => 'floral'],
                ['title' => 'Glitter Glam', 'description' => 'Sparkling glitter nails for special occasions', 'category' => 'glitter'],
                ['title' => 'Geometric Art', 'description' => 'Modern geometric patterns in pastel colors', 'category' => 'geometric'],
            ];

            foreach ($designs as $design) {
                NailCatalog::create([
                    'nailist_id' => $jessica->id,
                    'title' => $design['title'],
                    'description' => $design['description'],
                    'category' => $design['category'],
                    'images' => json_encode([
                        'https://placehold.co/400x300/pink/white?text=' . urlencode($design['title'])
                    ]),
                    'price' => rand(50000, 200000),
                    'is_active' => true,
                ]);
            }

            echo "✅ Created 5 catalogs for Jessica (approved nailist)\n";
        }

        // Get pending nailist (Sarah) - add 2 catalogs
        $sarah = User::where('email', 'sarah@nailstudio.com')->first();

        if ($sarah) {
            $designs = [
                ['title' => 'Sarah Sample Design 1', 'description' => 'Sample portfolio item', 'category' => 'minimalist'],
                ['title' => 'Sarah Sample Design 2', 'description' => 'Another sample work', 'category' => 'classic'],
            ];

            foreach ($designs as $design) {
                NailCatalog::create([
                    'nailist_id' => $sarah->id,
                    'title' => $design['title'],
                    'description' => $design['description'],
                    'category' => $design['category'],
                    'images' => json_encode([
                        'https://placehold.co/400x300/purple/white?text=' . urlencode($design['title'])
                    ]),
                    'price' => rand(75000, 150000),
                    'is_active' => true,
                ]);
            }

            echo "✅ Created 2 catalogs for Sarah (pending nailist)\n";
        }
    }
}
