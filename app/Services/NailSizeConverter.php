<?php

namespace App\Services;

class NailSizeConverter
{
    private const LOOKUP = [
        [18.0, 0],
        [17.0, 1],
        [16.0, 2],
        [15.0, 3],
        [14.0, 4],
        [13.5, 5],
        [13.0, 6],
        [12.5, 7],
        [12.0, 8],
        [11.5, 9],
        [11.0, 10],
        [10.0, 11],
        [9.5, 12],
        [9.0, 13],
        [8.0, 14],
    ];

    public function toTipNumber(float $mm): int
    {
        $closestTipNumber = null;
        $smallestDifference = PHP_FLOAT_MAX;

        foreach (self::LOOKUP as [$measurement, $tipNumber]) {
            $difference = abs($mm - $measurement);

            if ($difference < $smallestDifference) {
                $smallestDifference = $difference;
                $closestTipNumber = $tipNumber;
            }
        }

        return $closestTipNumber;
    }
}
