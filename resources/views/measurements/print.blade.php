<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pengukuran - {{ $measurement->formatted_date }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            background: #fff;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
        }

        /* Header */
        .header {
            text-align: center;
            padding: 30px 0;
            border-bottom: 4px solid #ec4899;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 36px;
            color: #ec4899;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .header .tagline {
            color: #666;
            font-size: 16px;
        }

        /* Info Section */
        .info-box {
            background: #fce7f3;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
        }

        .info-box h2 {
            color: #ec4899;
            font-size: 20px;
            margin-bottom: 15px;
            border-bottom: 2px solid #ec4899;
            padding-bottom: 10px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            background: white;
            border-radius: 8px;
        }

        .info-label {
            font-weight: bold;
            color: #666;
        }

        .info-value {
            color: #ec4899;
            font-weight: bold;
        }

        /* Results Section */
        .results-section {
            margin-bottom: 30px;
        }

        .results-section h2 {
            color: #ec4899;
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }

        .hands-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        .hand-card {
            border: 2px solid #ec4899;
            border-radius: 15px;
            padding: 20px;
            background: #fce7f3;
        }

        .hand-card h3 {
            color: #ec4899;
            font-size: 20px;
            margin-bottom: 15px;
            text-align: center;
        }

        .size-badge {
            background: #ec4899;
            color: white;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        /* Measurements Table */
        .measurements-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .measurements-table th {
            background: #ec4899;
            color: white;
            padding: 12px;
            text-align: left;
            font-size: 14px;
        }

        .measurements-table td {
            padding: 12px;
            border-bottom: 1px solid #fce7f3;
            font-size: 14px;
        }

        .measurements-table tr:nth-child(even) {
            background: #fef2f8;
        }

        .measurements-table .finger-name {
            font-weight: bold;
            color: #666;
        }

        .measurements-table .measurement-value {
            color: #ec4899;
            font-weight: bold;
            font-size: 18px;
        }

        /* Stats */
        .stats-box {
            background: white;
            border: 2px solid #ec4899;
            border-radius: 10px;
            padding: 15px;
            margin-top: 15px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .stat-item {
            text-align: center;
            padding: 10px;
            background: #fce7f3;
            border-radius: 8px;
        }

        .stat-label {
            font-size: 12px;
            color: #666;
            margin-bottom: 5px;
        }

        .stat-value {
            font-size: 20px;
            font-weight: bold;
            color: #ec4899;
        }

        /* Footer */
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 2px solid #ec4899;
            text-align: center;
            color: #666;
            font-size: 14px;
        }

        .footer .website {
            color: #ec4899;
            font-weight: bold;
            margin-top: 10px;
        }

        /* Print Styles */
        @media print {
            body {
                padding: 0;
            }

            .no-print {
                display: none !important;
            }

            .container {
                max-width: 100%;
            }

            @page {
                margin: 1cm;
            }
        }

        /* Print Button */
        .print-button {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: linear-gradient(135deg, #ec4899, #f43f5e);
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 50px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 10px 30px rgba(236, 72, 153, 0.3);
            transition: all 0.3s;
        }

        .print-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(236, 72, 153, 0.4);
        }

        .back-button {
            position: fixed;
            bottom: 30px;
            left: 30px;
            background: white;
            color: #ec4899;
            padding: 15px 30px;
            border: 2px solid #ec4899;
            border-radius: 50px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
        }

        .back-button:hover {
            background: #fce7f3;
            transform: translateY(-3px);
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>NailPerfect</h1>
            <p class="tagline">Sistem Pengukuran Kuku Berbasis Web</p>
        </div>

        <!-- Info Box -->
        <div class="info-box">
            <h2>Informasi Pengukuran</h2>
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">Tanggal:</span>
                    <span class="info-value">{{ $measurement->formatted_date }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Confidence Score:</span>
                    <span class="info-value">{{ number_format($measurement->confidence_score, 1) }}%</span>
                </div>
            </div>
        </div>

        <!-- Results Section -->
        <div class="results-section">
            <h2>Hasil Klasifikasi Ukuran</h2>

            <div class="hands-container">
                <!-- Right Hand -->
                <div class="hand-card">
                    <h3>👉 Tangan Kanan</h3>
                    <div class="size-badge">{{ $measurement->classified_size_right }}</div>

                    <table class="measurements-table">
                        <thead>
                            <tr>
                                <th>Jari</th>
                                <th style="text-align: right;">Ukuran (mm)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(['jempol' => 'Jempol', 'telunjuk' => 'Telunjuk', 'tengah' => 'Tengah', 'manis' => 'Manis', 'kelingking' => 'Kelingking'] as $key => $label)
                            <tr>
                                <td class="finger-name">{{ $label }}</td>
                                <td class="measurement-value" style="text-align: right;">{{ $measurement->right_hand_data[$key] ?? 'N/A' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="stats-box">
                        <div class="stats-grid">
                            <div class="stat-item">
                                <div class="stat-label">Rata-rata</div>
                                <div class="stat-value">{{ $measurement->right_hand_average }} mm</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-label">Ukuran</div>
                                <div class="stat-value">{{ $measurement->classified_size_right }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Left Hand (if exists) -->
                @if($measurement->left_hand_data)
                <div class="hand-card">
                    <h3>👈 Tangan Kiri</h3>
                    <div class="size-badge">{{ $measurement->classified_size_left }}</div>

                    <table class="measurements-table">
                        <thead>
                            <tr>
                                <th>Jari</th>
                                <th style="text-align: right;">Ukuran (mm)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(['jempol' => 'Jempol', 'telunjuk' => 'Telunjuk', 'tengah' => 'Tengah', 'manis' => 'Manis', 'kelingking' => 'Kelingking'] as $key => $label)
                            <tr>
                                <td class="finger-name">{{ $label }}</td>
                                <td class="measurement-value" style="text-align: right;">{{ $measurement->left_hand_data[$key] ?? 'N/A' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="stats-box">
                        <div class="stats-grid">
                            <div class="stat-item">
                                <div class="stat-label">Rata-rata</div>
                                <div class="stat-value">{{ $measurement->left_hand_average }} mm</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-label">Ukuran</div>
                                <div class="stat-value">{{ $measurement->classified_size_left }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Dokumen ini dicetak dari NailPerfect - Sistem Pengukuran Kuku Berbasis Web</p>
            <p class="website">www.nailperfect.com</p>
            <p style="margin-top: 10px; font-size: 12px;">
                Simpan dokumen ini untuk referensi saat memesan produk nail art
            </p>
        </div>
    </div>

    <!-- Action Buttons (hidden when printing) -->
    <a href="{{ route('measurements.show', $measurement->id) }}" class="back-button no-print">
        ← Kembali
    </a>

    <button onclick="window.print()" class="print-button no-print">
        🖨️ Print / Download PDF
    </button>

    <script>
        // Optional: Auto-focus for better UX
        window.onload = function() {
            // Add any initialization if needed
        };
    </script>
</body>
</html>
