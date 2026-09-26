<?php

namespace Database\Seeders;

use App\Models\SizeStandard;
use Illuminate\Database\Seeder;

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
                'telunjuk' => 9,
                'tengah' => 11,
                'manis' => 10,
                'kelingking' => 8,
                'tolerance' => 1.0,
                'is_active' => true,
            ],
            [
                'size_name' => 'S',
                'jempol' => 15,
                'telunjuk' => 11,
                'tengah' => 12,
                'manis' => 11,
                'kelingking' => 8,
                'tolerance' => 1.0,
                'is_active' => true,
            ],
            [
                'size_name' => 'M',
                'jempol' => 16,
                'telunjuk' => 11.5,
                'tengah' => 13,
                'manis' => 12,
                'kelingking' => 9.5,
                'tolerance' => 1.0,
                'is_active' => true,
            ],
            [
                'size_name' => 'L',
                'jempol' => 17,
                'telunjuk' => 12.5,
                'tengah' => 14,
                'manis' => 13,
                'kelingking' => 10,
                'tolerance' => 1.0,
                'is_active' => true,
            ],
        ];

        SizeStandard::whereNotIn('size_name', ['XS', 'S', 'M', 'L'])
            ->update(['is_active' => false]);

        foreach ($standards as $standard) {
            SizeStandard::updateOrCreate(
                ['size_name' => $standard['size_name']],
                $standard
            );
        }
    }
}
