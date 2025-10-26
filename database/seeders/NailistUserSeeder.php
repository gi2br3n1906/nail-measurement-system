<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class NailistUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a nailist-only user
        User::create([
            'name' => 'Bella Nails',
            'email' => 'bella@nailperfect.com',
            'password' => Hash::make('nailist123'),
            'roles' => ['nailist'],
            'is_nailist_approved' => true,
            'salon_name' => 'Bella Nail Studio',
            'phone' => '081234567890',
            'bio' => 'Professional nail artist with 5+ years experience. Specialist in french manicure and nail art designs.',
            'whatsapp' => '6281234567890',
            'instagram' => '@bellanails',
            'address' => 'Jl. Sudirman No. 123, Jakarta',
        ]);

        // Create an admin+nailist user (double role)
        User::create([
            'name' => 'Sarah Admin',
            'email' => 'sarah@nailperfect.com',
            'password' => Hash::make('admin123'),
            'roles' => ['admin', 'nailist'],
            'is_nailist_approved' => true,
            'salon_name' => 'Sarah\'s Nail Boutique',
            'phone' => '082345678901',
            'bio' => 'Owner & head nail artist. Certified nail technician specializing in gel nails and nail extensions.',
            'whatsapp' => '6282345678901',
            'instagram' => '@sarahnailboutique',
            'address' => 'Jl. Gatot Subroto No. 45, Jakarta',
        ]);

        // Create a pending nailist (not approved yet)
        User::create([
            'name' => 'Cindy Nails',
            'email' => 'cindy@nailperfect.com',
            'password' => Hash::make('nailist123'),
            'roles' => ['nailist'],
            'is_nailist_approved' => false,
            'salon_name' => 'Cindy\'s Nail Corner',
            'phone' => '083456789012',
            'bio' => 'Passionate about nail art and design. New to the platform!',
            'whatsapp' => '6283456789012',
            'instagram' => '@cindynails',
            'address' => 'Jl. Thamrin No. 78, Jakarta',
        ]);
    }
}
