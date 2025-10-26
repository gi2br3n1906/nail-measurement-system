<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestNailistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create test nailists with different approval statuses

        // 1. Pending nailist (needs approval)
        \App\Models\User::create([
            'name' => 'Sarah Beautynails',
            'email' => 'sarah@nailstudio.com',
            'password' => bcrypt('password123'),
            'roles' => ['nailist'],
            'salon_name' => 'Sarah Nail Studio',
            'phone' => '081234567890',
            'whatsapp' => '081234567890',
            'instagram' => '@sarahnails',
            'address' => 'Jakarta Selatan',
            'bio' => 'Professional nail artist dengan pengalaman 5 tahun. Spesialisasi nail art minimalis dan elegant.',
            'is_nailist_approved' => null, // PENDING
        ]);

        // 2. Another pending nailist
        \App\Models\User::create([
            'name' => 'Linda Nail Art',
            'email' => 'linda@nailart.com',
            'password' => bcrypt('password123'),
            'roles' => ['nailist'],
            'salon_name' => 'Linda Creative Nails',
            'phone' => '082345678901',
            'whatsapp' => '082345678901',
            'instagram' => '@lindanails',
            'address' => 'Bandung',
            'bio' => 'Nail artist kreatif dengan style modern dan trendy. Suka eksperimen dengan warna-warna bold!',
            'is_nailist_approved' => null, // PENDING
        ]);

        // 3. Approved nailist
        \App\Models\User::create([
            'name' => 'Jessica Nails',
            'email' => 'jessica@nailpro.com',
            'password' => bcrypt('password123'),
            'roles' => ['nailist'],
            'salon_name' => 'Jessica Professional Nails',
            'phone' => '083456789012',
            'whatsapp' => '083456789012',
            'instagram' => '@jessicanails',
            'address' => 'Surabaya',
            'bio' => 'Certified nail technician. Mengutamakan kualitas dan kepuasan pelanggan.',
            'is_nailist_approved' => true,
            'approved_at' => now(),
        ]);

        // 4. Rejected nailist
        \App\Models\User::create([
            'name' => 'Tina Nails',
            'email' => 'tina@nailshop.com',
            'password' => bcrypt('password123'),
            'roles' => ['nailist'],
            'salon_name' => 'Tina Nail Shop',
            'phone' => '084567890123',
            'whatsapp' => '084567890123',
            'instagram' => '@tinanails',
            'address' => 'Yogyakarta',
            'bio' => 'Nail artist pemula yang masih belajar.',
            'is_nailist_approved' => false,
            'rejection_reason' => 'Profil belum lengkap dan portfolio masih terbatas. Silakan upload lebih banyak karya dan lengkapi informasi kontak.',
        ]);

        echo "✅ Created 4 test nailists:\n";
        echo "   - 2 PENDING (Sarah, Linda)\n";
        echo "   - 1 APPROVED (Jessica)\n";
        echo "   - 1 REJECTED (Tina)\n";
    }
}
