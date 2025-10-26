<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Measurement;

class HasilKlasifikasiController extends Controller
{
    // Size chart reference data (from the provided image)
    private $sizeChart = [
        'XS' => [
            'jempol' => 14,
            'telunjuk' => 11,
            'tengah' => 12,
            'manis' => 10,
            'kelingking' => 8,
        ],
        'S' => [
            'jempol' => 15,
            'telunjuk' => 12,
            'tengah' => 13,
            'manis' => 11,
            'kelingking' => 8,
        ],
        'M' => [
            'jempol' => 16,
            'telunjuk' => 12,
            'tengah' => 13,
            'manis' => 11,
            'kelingking' => 9,
        ],
        'XL' => [
            'jempol' => 18,
            'telunjuk' => 13,
            'tengah' => 14,
            'manis' => 12,
            'kelingking' => 10,
        ],
    ];

    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'right_jempol' => 'required|numeric|min:0',
            'right_telunjuk' => 'required|numeric|min:0',
            'right_jari_tengah' => 'required|numeric|min:0',
            'right_jari_manis' => 'required|numeric|min:0',
            'right_kelingking' => 'required|numeric|min:0',
            'left_jempol' => 'nullable|numeric|min:0',
            'left_telunjuk' => 'nullable|numeric|min:0',
            'left_jari_tengah' => 'nullable|numeric|min:0',
            'left_jari_manis' => 'nullable|numeric|min:0',
            'left_kelingking' => 'nullable|numeric|min:0',
        ]);

        // Prepare right hand data
        $rightHandData = [
            'jempol' => (float) $request->right_jempol,
            'telunjuk' => (float) $request->right_telunjuk,
            'tengah' => (float) $request->right_jari_tengah,
            'manis' => (float) $request->right_jari_manis,
            'kelingking' => (float) $request->right_kelingking,
        ];

        // Prepare left hand data (if provided)
        $leftHandData = null;
        $hasLeftHand = $request->filled('left_jempol');

        if ($hasLeftHand) {
            $leftHandData = [
                'jempol' => (float) $request->left_jempol,
                'telunjuk' => (float) $request->left_telunjuk,
                'tengah' => (float) $request->left_jari_tengah,
                'manis' => (float) $request->left_jari_manis,
                'kelingking' => (float) $request->left_kelingking,
            ];
        }

        // Classify right hand
        $rightClassification = $this->classifySize($rightHandData);

        // Classify left hand (if provided)
        $leftClassification = null;
        if ($leftHandData) {
            $leftClassification = $this->classifySize($leftHandData);
        }

        // Save measurement to database
        $measurement = Measurement::create([
            'right_hand_data' => $rightHandData,
            'left_hand_data' => $leftHandData,
            'classified_size_right' => $rightClassification['size'],
            'classified_size_left' => $leftClassification ? $leftClassification['size'] : null,
            'confidence_score' => $rightClassification['confidence'],
        ]);

        // Return view with results
        return view('hasil-klasifikasi', [
            'rightHandData' => $rightHandData,
            'leftHandData' => $leftHandData,
            'rightClassification' => $rightClassification,
            'leftClassification' => $leftClassification,
            'hasLeftHand' => $hasLeftHand,
            'measurementId' => $measurement->id,
        ]);
    }

    /**
     * Classify nail size based on measurements
     * Uses closest match algorithm - finds size with smallest total difference
     */
    private function classifySize($measurements)
    {
        $bestMatch = null;
        $smallestDifference = PHP_FLOAT_MAX;
        $differences = [];

        foreach ($this->sizeChart as $size => $standardMeasurements) {
            $totalDifference = 0;
            $fingerDifferences = [];

            foreach ($standardMeasurements as $finger => $standardSize) {
                $difference = abs($measurements[$finger] - $standardSize);
                $totalDifference += $difference;
                $fingerDifferences[$finger] = $difference;
            }

            $differences[$size] = [
                'total' => $totalDifference,
                'fingers' => $fingerDifferences,
                'average' => $totalDifference / 5,
            ];

            if ($totalDifference < $smallestDifference) {
                $smallestDifference = $totalDifference;
                $bestMatch = $size;
            }
        }

        // Calculate confidence score (100% = perfect match, lower % = more difference)
        $maxPossibleDifference = 20; // Assume max 4mm difference per finger * 5 fingers
        $confidence = max(0, 100 - (($smallestDifference / $maxPossibleDifference) * 100));

        // If difference is too large (>10mm total), mark as Custom
        $isCustom = $smallestDifference > 10;

        return [
            'size' => $isCustom ? 'Custom' : $bestMatch,
            'confidence' => round($confidence, 1),
            'total_difference' => round($smallestDifference, 1),
            'differences' => $differences,
            'is_custom' => $isCustom,
            'recommendation' => $this->getRecommendation($isCustom ? 'Custom' : $bestMatch, $confidence),
        ];
    }

    /**
     * Get recommendation message based on classification result
     */
    private function getRecommendation($size, $confidence)
    {
        if ($size === 'Custom') {
            return 'Ukuran kuku Anda tidak cocok dengan size standar. Kami merekomendasikan untuk memesan custom size agar lebih pas dan nyaman.';
        }

        if ($confidence >= 90) {
            return "Ukuran kuku Anda sangat cocok dengan size {$size}! Anda dapat langsung memilih produk dengan size ini.";
        } elseif ($confidence >= 70) {
            return "Ukuran kuku Anda cukup cocok dengan size {$size}. Produk dengan size ini akan pas di kuku Anda.";
        } else {
            return "Ukuran kuku Anda mendekati size {$size}, namun mungkin tidak 100% pas. Pertimbangkan custom size untuk hasil terbaik.";
        }
    }

    public function index()
    {
        return view('hasil-klasifikasi');
    }
}

