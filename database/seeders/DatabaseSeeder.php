<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed products, admin, size standards, nailists, and catalogs
        $this->call([
            ProductSeeder::class,
            AdminUserSeeder::class,
            SizeStandardSeeder::class,
            NailistUserSeeder::class,
            NailCatalogSeeder::class,
        ]);
    }
}
