<?php

namespace Tests\Unit;

use App\Services\NailSizeConverter;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class NailSizeConverterTest extends TestCase
{
    #[DataProvider('knownMeasurements')]
    public function test_it_maps_known_millimeter_measurements_to_tip_numbers(float $mm, int $expected): void
    {
        $this->assertSame($expected, (new NailSizeConverter)->toTipNumber($mm));
    }

    public function test_it_returns_the_nearest_tip_number_and_prefers_the_smaller_number_on_a_tie(): void
    {
        $converter = new NailSizeConverter;

        $this->assertSame(5, $converter->toTipNumber(13.25));
    }

    public function test_it_clamps_measurements_outside_the_lookup_range_to_the_nearest_endpoint(): void
    {
        $converter = new NailSizeConverter;

        $this->assertSame(0, $converter->toTipNumber(20.0));
        $this->assertSame(14, $converter->toTipNumber(7.0));
    }

    public static function knownMeasurements(): array
    {
        return [
            '18mm maps to zero' => [18.0, 0],
            '17mm maps to one' => [17.0, 1],
            '16mm maps to two' => [16.0, 2],
            '15mm maps to three' => [15.0, 3],
            '14mm maps to four' => [14.0, 4],
            '13.5mm maps to five' => [13.5, 5],
            '13mm maps to six' => [13.0, 6],
            '12.5mm maps to seven' => [12.5, 7],
            '12mm maps to eight' => [12.0, 8],
            '11.5mm maps to nine' => [11.5, 9],
            '11mm maps to ten' => [11.0, 10],
            '10mm maps to eleven' => [10.0, 11],
            '9.5mm maps to twelve' => [9.5, 12],
            '9mm maps to thirteen' => [9.0, 13],
            '8mm maps to fourteen' => [8.0, 14],
        ];
    }
}
