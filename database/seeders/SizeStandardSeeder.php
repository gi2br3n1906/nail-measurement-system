<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SizeStandard;

class SizeStandardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $standards = [
            [
                'size_name' => 'XS',
                'jempol' => 14,
                'telunjuk' => 11,
                'tengah' => 12,
                'manis' => 10,
                'kelingking' => 8,
                'tolerance' => 1.0,
                'is_active' => true,
            ],
            [
                'size_name' => 'S',
                'jempol' => 15,
                'telunjuk' => 12,
                'tengah' => 13,
                'manis' => 11,
                'kelingking' => 8,
                'tolerance' => 1.0,
                'is_active' => true,
            ],
            [
                'size_name' => 'M',
                'jempol' => 16,
                'telunjuk' => 12,
                'tengah' => 13,
                'manis' => 11,
                'kelingking' => 9,
                'tolerance' => 1.0,
                'is_active' => true,
            ],
            [
                'size_name' => 'XL',
                'jempol' => 18,
                'telunjuk' => 13,
                'tengah' => 14,
                'manis' => 12,
                'kelingking' => 10,
                'tolerance' => 1.0,
                'is_active' => true,
            ],
        ];

        foreach ($standards as $standard) {
            SizeStandard::create($standard);
        }
    }
}
