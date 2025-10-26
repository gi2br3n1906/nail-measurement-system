<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NailCatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nailists = \App\Models\User::whereJsonContains('roles', 'nailist')->get();

        if ($nailists->isEmpty()) {
            $this->command->warn('No nailists found. Please run NailistUserSeeder first.');
            return;
        }

        $catalogs = [
            [
                'title' => 'Elegant French Manicure',
                'description' => 'Classic French manicure dengan sentuhan modern dan elegan. Cocok untuk acara formal dan kantor.',
                'category' => 'classic',
                'difficulty' => 'easy',
                'duration_minutes' => 45,
                'price' => 150000,
                'view_count' => 245,
                'average_rating' => 4.8,
                'review_count' => 12,
            ],
            [
                'title' => 'Glitter Ombre Design',
                'description' => 'Design ombre dengan glitter gradient yang memukau. Perfect untuk party dan acara malam.',
                'category' => 'glitter',
                'difficulty' => 'medium',
                'duration_minutes' => 60,
                'price' => 200000,
                'view_count' => 387,
                'average_rating' => 4.9,
                'review_count' => 23,
            ],
            [
                'title' => 'Minimalist Line Art',
                'description' => 'Nail art minimalis dengan line art yang simple namun tetap artistic. Cocok untuk daily look.',
                'category' => 'minimalist',
                'difficulty' => 'medium',
                'duration_minutes' => 50,
                'price' => 175000,
                'view_count' => 156,
                'average_rating' => 4.7,
                'review_count' => 8,
            ],
            [
                'title' => 'Floral Garden Design',
                'description' => 'Design bunga yang cantik dengan detail tinggi. Memberikan kesan fresh dan feminine.',
                'category' => 'floral',
                'difficulty' => 'hard',
                'duration_minutes' => 90,
                'price' => 250000,
                'view_count' => 523,
                'average_rating' => 5.0,
                'review_count' => 31,
            ],
            [
                'title' => 'Marble Effect Nails',
                'description' => 'Efek marble yang mewah dan elegan. Setiap kuku memiliki pattern yang unik.',
                'category' => 'marble',
                'difficulty' => 'medium',
                'duration_minutes' => 70,
                'price' => 225000,
                'view_count' => 412,
                'average_rating' => 4.8,
                'review_count' => 19,
            ],
            [
                'title' => 'Neon Summer Vibes',
                'description' => 'Design neon yang vibrant dan fun. Perfect untuk musim panas dan beach vibes.',
                'category' => 'neon',
                'difficulty' => 'easy',
                'duration_minutes' => 40,
                'price' => 165000,
                'view_count' => 289,
                'average_rating' => 4.6,
                'review_count' => 15,
            ],
            [
                'title' => 'Geometric Patterns',
                'description' => 'Pattern geometric yang bold dan modern. Cocok untuk yang suka tampil beda.',
                'category' => 'geometric',
                'difficulty' => 'hard',
                'duration_minutes' => 85,
                'price' => 240000,
                'view_count' => 198,
                'average_rating' => 4.9,
                'review_count' => 11,
            ],
            [
                'title' => 'Crystal Chrome Finish',
                'description' => 'Finishing chrome yang sparkling dengan crystal accent. Luxury look yang stunning.',
                'category' => 'chrome',
                'difficulty' => 'hard',
                'duration_minutes' => 80,
                'price' => 280000,
                'view_count' => 634,
                'average_rating' => 5.0,
                'review_count' => 42,
            ],
            [
                'title' => 'Pastel Rainbow',
                'description' => 'Kombinasi warna pastel yang soft dan playful. Cute dan instagram-worthy!',
                'category' => 'pastel',
                'difficulty' => 'easy',
                'duration_minutes' => 45,
                'price' => 170000,
                'view_count' => 445,
                'average_rating' => 4.7,
                'review_count' => 27,
            ],
            [
                'title' => 'Abstract Art Collection',
                'description' => 'Design abstract art yang artistic dan unique. Setiap kuku adalah karya seni.',
                'category' => 'abstract',
                'difficulty' => 'hard',
                'duration_minutes' => 95,
                'price' => 300000,
                'view_count' => 356,
                'average_rating' => 4.9,
                'review_count' => 18,
            ],
        ];

        // Distribute catalogs among nailists
        foreach ($catalogs as $index => $catalogData) {
            $nailist = $nailists[$index % $nailists->count()];

            \App\Models\NailCatalog::create([
                'nailist_id' => $nailist->id,
                'title' => $catalogData['title'],
                'description' => $catalogData['description'],
                'images' => [], // Empty for now, can be updated later
                'category' => $catalogData['category'],
                'difficulty' => $catalogData['difficulty'],
                'duration_minutes' => $catalogData['duration_minutes'],
                'price' => $catalogData['price'],
                'is_active' => true,
                'view_count' => $catalogData['view_count'],
                'average_rating' => $catalogData['average_rating'],
                'review_count' => $catalogData['review_count'],
            ]);
        }

        $this->command->info('Nail catalogs seeded successfully!');
    }
}
