<?php

namespace Tests\Feature;

use Database\Seeders\SizeStandardSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NailSizingResultTest extends TestCase
{
    use RefreshDatabase;

    public function test_result_displays_converted_tip_numbers_for_both_hands_using_the_new_standards(): void
    {
        $this->seed(SizeStandardSeeder::class);

        $this->assertDatabaseHas('size_standards', [
            'size_name' => 'XS',
            'jempol' => 14,
            'telunjuk' => 9,
            'tengah' => 11,
            'manis' => 10,
            'kelingking' => 8,
        ]);
        $this->assertDatabaseHas('size_standards', [
            'size_name' => 'M',
            'jempol' => 16,
            'telunjuk' => 11.5,
            'tengah' => 13,
            'manis' => 12,
            'kelingking' => 9.5,
        ]);
        $this->assertDatabaseHas('size_standards', ['size_name' => 'L', 'jempol' => 17]);
        $this->assertDatabaseMissing('size_standards', ['size_name' => 'XL', 'is_active' => true]);

        $response = $this->post(route('hasil-klasifikasi.store'), [
            'right_jempol' => 14,
            'right_telunjuk' => 9,
            'right_jari_tengah' => 11,
            'right_jari_manis' => 10,
            'right_kelingking' => 8,
            'left_jempol' => 15,
            'left_telunjuk' => 11,
            'left_jari_tengah' => 12,
            'left_jari_manis' => 11,
            'left_kelingking' => 8,
        ]);

        $response->assertOk()
            ->assertSee('XS')
            ->assertSee('Tangan Kiri')
            ->assertSee('Tip #4')
            ->assertSee('Tip #13')
            ->assertSee('Tip #10')
            ->assertSee('Tip #11')
            ->assertSee('Tip #14')
            ->assertDontSee('text-xs text-gray-400">mm', false);
    }
}
