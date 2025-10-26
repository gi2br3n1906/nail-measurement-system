<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // SVG placeholder untuk product images
        $svgPlaceholder = 'data:image/svg+xml;base64,' . base64_encode('
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 400">
                <rect width="400" height="400" fill="#fce7f3"/>
                <path d="M100 150 L140 150 L140 250 L100 250 Z M160 140 L200 140 L200 250 L160 250 Z M220 130 L260 130 L260 250 L220 250 Z M280 140 L320 140 L320 250 L280 250 Z" fill="#ec4899" opacity="0.6"/>
                <text x="200" y="320" font-family="Arial" font-size="24" text-anchor="middle" fill="#db2777">Nail Art</text>
            </svg>
        ');

        $products = [
            // XS Size Products
            [
                'name' => 'Elegant Pink Press-On Nails XS',
                'description' => 'Set kuku palsu press-on dengan desain elegant pink. Mudah dipasang, tahan lama hingga 2 minggu. Cocok untuk ukuran kuku XS.',
                'size' => 'XS',
                'price' => 85000,
                'image_url' => $svgPlaceholder,
                'stock' => 50,
                'is_active' => true,
            ],
            [
                'name' => 'French Manicure Set XS',
                'description' => 'Set kuku French manicure klasik size XS. Tampilan natural dan elegan untuk sehari-hari. Termasuk lem dan file kuku.',
                'size' => 'XS',
                'price' => 75000,
                'image_url' => $svgPlaceholder,
                'stock' => 45,
                'is_active' => true,
            ],
            [
                'name' => 'Glitter Sparkle Nails XS',
                'description' => 'Kuku press-on dengan glitter mewah size XS. Perfect untuk acara special atau pesta. Reusable dan mudah dibersihkan.',
                'size' => 'XS',
                'price' => 95000,
                'image_url' => $svgPlaceholder,
                'stock' => 30,
                'is_active' => true,
            ],

            // S Size Products
            [
                'name' => 'Rose Gold Press-On Nails S',
                'description' => 'Set kuku palsu rose gold metallic size S. Desain modern dan chic untuk tampilan glamor. Tahan air dan tidak mudah lepas.',
                'size' => 'S',
                'price' => 90000,
                'image_url' => $svgPlaceholder,
                'stock' => 60,
                'is_active' => true,
            ],
            [
                'name' => 'Pastel Dreams Collection S',
                'description' => 'Koleksi kuku press-on dengan warna pastel soft size S. Mix and match untuk tampilan unik. Termasuk 24 pcs kuku berbagai ukuran.',
                'size' => 'S',
                'price' => 85000,
                'image_url' => $svgPlaceholder,
                'stock' => 55,
                'is_active' => true,
            ],
            [
                'name' => 'Marble Elegance Nails S',
                'description' => 'Desain marble elegant size S. Cocok untuk professional look. Material premium berkualitas tinggi.',
                'size' => 'S',
                'price' => 100000,
                'image_url' => $svgPlaceholder,
                'stock' => 40,
                'is_active' => true,
            ],

            // M Size Products
            [
                'name' => 'Classic Red Press-On Nails M',
                'description' => 'Set kuku palsu merah klasik size M. Warna bold dan confident. Perfect untuk berbagai acara formal maupun casual.',
                'size' => 'M',
                'price' => 88000,
                'image_url' => $svgPlaceholder,
                'stock' => 70,
                'is_active' => true,
            ],
            [
                'name' => 'Nude Minimalist Set M',
                'description' => 'Kuku press-on nude minimalist size M. Simple yet elegant. Cocok untuk daily wear dan office look.',
                'size' => 'M',
                'price' => 80000,
                'image_url' => $svgPlaceholder,
                'stock' => 65,
                'is_active' => true,
            ],
            [
                'name' => 'Floral Art Nails M',
                'description' => 'Set kuku dengan hand-painted floral art size M. Setiap set adalah karya seni unik. Premium quality.',
                'size' => 'M',
                'price' => 120000,
                'image_url' => $svgPlaceholder,
                'stock' => 35,
                'is_active' => true,
            ],

            // XL Size Products
            [
                'name' => 'Bold Black Press-On Nails XL',
                'description' => 'Set kuku palsu hitam bold size XL. Tampilan edgy dan powerful. Matte finish dengan durabilitas tinggi.',
                'size' => 'XL',
                'price' => 92000,
                'image_url' => $svgPlaceholder,
                'stock' => 50,
                'is_active' => true,
            ],
            [
                'name' => 'Ombre Gradient Nails XL',
                'description' => 'Kuku press-on dengan efek ombre gradient size XL. Transisi warna yang smooth dan artistic.',
                'size' => 'XL',
                'price' => 95000,
                'image_url' => $svgPlaceholder,
                'stock' => 45,
                'is_active' => true,
            ],
            [
                'name' => 'Luxury Crystal Nails XL',
                'description' => 'Set kuku mewah dengan crystal Swarovski size XL. Premium luxury untuk special occasions. Limited edition.',
                'size' => 'XL',
                'price' => 150000,
                'image_url' => $svgPlaceholder,
                'stock' => 20,
                'is_active' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
