@extends('layouts.app')

@section('title', 'Detail Pengukuran - Nail Measurement System')

@section('content')
@include('components.navbar')

<div class="min-h-screen bg-gradient-to-br from-pink-50 via-purple-50 to-blue-50 py-12">
    <div class="max-w-6xl mx-auto px-4">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="font-display text-5xl font-bold bg-gradient-to-r from-pink-600 to-purple-600 bg-clip-text text-transparent mb-4">
                Detail Pengukuran
            </h1>
            <p class="text-gray-600 text-lg">
                <svg class="inline-block w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                {{ $measurement->formatted_date }}
            </p>
        </div>

        <!-- Overall Results Card -->
        <div class="bg-white rounded-3xl shadow-2xl p-8 mb-8">
            <h2 class="font-display text-2xl font-bold text-gray-800 mb-6 flex items-center">
                <svg class="w-7 h-7 mr-3 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Hasil Klasifikasi
            </h2>

            <div class="grid md:grid-cols-2 gap-6">
                <!-- Right Hand Result -->
                <div class="bg-gradient-to-br from-pink-50 to-rose-50 rounded-2xl p-6">
                    <h3 class="font-bold text-lg text-gray-700 mb-4 flex items-center">
                        <span class="inline-block w-3 h-3 bg-pink-500 rounded-full mr-2"></span>
                        Tangan Kanan
                    </h3>
                    <div class="text-center mb-4">
                        <div class="inline-block bg-white rounded-full px-8 py-3 shadow-lg">
                            <span class="text-4xl font-bold text-pink-600">{{ $measurement->classified_size_right }}</span>
                        </div>
                    </div>
                    <div class="space-y-2 text-sm">
                        <p class="flex justify-between">
                            <span class="text-gray-600">Rata-rata:</span>
                            <span class="font-bold text-gray-800">{{ $measurement->right_hand_average }} mm</span>
                        </p>
                        <p class="flex justify-between">
                            <span class="text-gray-600">Confidence:</span>
                            <span class="font-bold text-pink-600">{{ number_format($measurement->confidence_score, 1) }}%</span>
                        </p>
                    </div>
                </div>

                <!-- Left Hand Result (if exists) -->
                @if($measurement->left_hand_data)
                <div class="bg-gradient-to-br from-purple-50 to-indigo-50 rounded-2xl p-6">
                    <h3 class="font-bold text-lg text-gray-700 mb-4 flex items-center">
                        <span class="inline-block w-3 h-3 bg-purple-500 rounded-full mr-2"></span>
                        Tangan Kiri
                    </h3>
                    <div class="text-center mb-4">
                        <div class="inline-block bg-white rounded-full px-8 py-3 shadow-lg">
                            <span class="text-4xl font-bold text-purple-600">{{ $measurement->classified_size_left }}</span>
                        </div>
                    </div>
                    <div class="space-y-2 text-sm">
                        <p class="flex justify-between">
                            <span class="text-gray-600">Rata-rata:</span>
                            <span class="font-bold text-gray-800">{{ $measurement->left_hand_average }} mm</span>
                        </p>
                        <p class="flex justify-between">
                            <span class="text-gray-600">Confidence:</span>
                            <span class="font-bold text-purple-600">{{ number_format($measurement->confidence_score, 1) }}%</span>
                        </p>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Detailed Measurements -->
        <div class="grid md:grid-cols-2 gap-8 mb-8">
            <!-- Right Hand Details -->
            <div class="bg-white rounded-3xl shadow-xl p-8">
                <h3 class="font-display text-xl font-bold text-gray-800 mb-6 flex items-center">
                    <span class="inline-block w-3 h-3 bg-pink-500 rounded-full mr-2"></span>
                    Detail Tangan Kanan
                </h3>
                <div class="space-y-4">
                    @foreach(['jempol' => 'Jempol', 'telunjuk' => 'Telunjuk', 'tengah' => 'Tengah', 'manis' => 'Manis', 'kelingking' => 'Kelingking'] as $key => $label)
                    <div class="flex items-center justify-between p-4 bg-gradient-to-r from-pink-50 to-rose-50 rounded-xl hover:shadow-md transition-shadow">
                        <span class="text-gray-700 font-medium">{{ $label }}</span>
                        <div class="flex items-center gap-3">
                            <span class="text-2xl font-bold text-pink-600">{{ $measurement->right_hand_data[$key] ?? 'N/A' }}</span>
                            <span class="text-sm text-gray-500">mm</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Left Hand Details (if exists) -->
            @if($measurement->left_hand_data)
            <div class="bg-white rounded-3xl shadow-xl p-8">
                <h3 class="font-display text-xl font-bold text-gray-800 mb-6 flex items-center">
                    <span class="inline-block w-3 h-3 bg-purple-500 rounded-full mr-2"></span>
                    Detail Tangan Kiri
                </h3>
                <div class="space-y-4">
                    @foreach(['jempol' => 'Jempol', 'telunjuk' => 'Telunjuk', 'tengah' => 'Tengah', 'manis' => 'Manis', 'kelingking' => 'Kelingking'] as $key => $label)
                    <div class="flex items-center justify-between p-4 bg-gradient-to-r from-purple-50 to-indigo-50 rounded-xl hover:shadow-md transition-shadow">
                        <span class="text-gray-700 font-medium">{{ $label }}</span>
                        <div class="flex items-center gap-3">
                            <span class="text-2xl font-bold text-purple-600">{{ $measurement->left_hand_data[$key] ?? 'N/A' }}</span>
                            <span class="text-sm text-gray-500">mm</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Comparison with Previous Measurement -->
        @if($previousMeasurement)
        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-3xl shadow-xl p-8 mb-8">
            <h3 class="font-display text-2xl font-bold text-gray-800 mb-6 flex items-center">
                <svg class="w-7 h-7 mr-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                Perbandingan dengan Pengukuran Sebelumnya
            </h3>

            <div class="bg-white rounded-2xl p-6 mb-4">
                <p class="text-sm text-gray-600 mb-4">
                    <svg class="inline-block w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Pengukuran sebelumnya: {{ $previousMeasurement->formatted_date }}
                </p>

                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Right Hand Comparison -->
                    <div>
                        <h4 class="font-bold text-gray-700 mb-3 flex items-center">
                            <span class="inline-block w-2 h-2 bg-pink-500 rounded-full mr-2"></span>
                            Tangan Kanan
                        </h4>
                        <div class="space-y-2">
                            <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                <span class="text-sm text-gray-600">Ukuran:</span>
                                <div class="flex items-center gap-2">
                                    <span class="text-gray-500">{{ $previousMeasurement->classified_size_right }}</span>
                                    @if($measurement->classified_size_right != $previousMeasurement->classified_size_right)
                                        <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                        </svg>
                                    @else
                                        <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    @endif
                                    <span class="font-bold text-pink-600">{{ $measurement->classified_size_right }}</span>
                                </div>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                <span class="text-sm text-gray-600">Rata-rata:</span>
                                <div class="flex items-center gap-2">
                                    <span class="text-gray-500">{{ $previousMeasurement->right_hand_average }} mm</span>
                                    @php
                                        $diff = $measurement->right_hand_average - $previousMeasurement->right_hand_average;
                                    @endphp
                                    @if(abs($diff) < 0.1)
                                        <span class="text-xs text-green-600 font-medium">(sama)</span>
                                    @elseif($diff > 0)
                                        <span class="text-xs text-orange-600 font-medium">(+{{ number_format($diff, 1) }} mm)</span>
                                    @else
                                        <span class="text-xs text-blue-600 font-medium">({{ number_format($diff, 1) }} mm)</span>
                                    @endif
                                    <span class="font-bold text-pink-600">{{ $measurement->right_hand_average }} mm</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Left Hand Comparison (if both exist) -->
                    @if($measurement->left_hand_data && $previousMeasurement->left_hand_data)
                    <div>
                        <h4 class="font-bold text-gray-700 mb-3 flex items-center">
                            <span class="inline-block w-2 h-2 bg-purple-500 rounded-full mr-2"></span>
                            Tangan Kiri
                        </h4>
                        <div class="space-y-2">
                            <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                <span class="text-sm text-gray-600">Ukuran:</span>
                                <div class="flex items-center gap-2">
                                    <span class="text-gray-500">{{ $previousMeasurement->classified_size_left }}</span>
                                    @if($measurement->classified_size_left != $previousMeasurement->classified_size_left)
                                        <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                        </svg>
                                    @else
                                        <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    @endif
                                    <span class="font-bold text-purple-600">{{ $measurement->classified_size_left }}</span>
                                </div>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                <span class="text-sm text-gray-600">Rata-rata:</span>
                                <div class="flex items-center gap-2">
                                    <span class="text-gray-500">{{ $previousMeasurement->left_hand_average }} mm</span>
                                    @php
                                        $diffLeft = $measurement->left_hand_average - $previousMeasurement->left_hand_average;
                                    @endphp
                                    @if(abs($diffLeft) < 0.1)
                                        <span class="text-xs text-green-600 font-medium">(sama)</span>
                                    @elseif($diffLeft > 0)
                                        <span class="text-xs text-orange-600 font-medium">(+{{ number_format($diffLeft, 1) }} mm)</span>
                                    @else
                                        <span class="text-xs text-blue-600 font-medium">({{ number_format($diffLeft, 1) }} mm)</span>
                                    @endif
                                    <span class="font-bold text-purple-600">{{ $measurement->left_hand_average }} mm</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Insight -->
                <div class="mt-6 p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl border-l-4 border-blue-500">
                    <p class="text-sm text-gray-700">
                        <svg class="inline-block w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <strong>Insight:</strong>
                        @php
                            $sizeChanged = $measurement->classified_size_right != $previousMeasurement->classified_size_right;
                            $avgDiff = abs($measurement->right_hand_average - $previousMeasurement->right_hand_average);
                        @endphp
                        @if($sizeChanged)
                            Ukuran kuku Anda telah berubah dari <strong>{{ $previousMeasurement->classified_size_right }}</strong> ke <strong>{{ $measurement->classified_size_right }}</strong>.
                            @if($measurement->classified_size_right == 'Custom Size')
                                Kami sarankan untuk memesan Custom Size agar lebih pas.
                            @else
                                Pastikan untuk memesan ukuran yang baru!
                            @endif
                        @elseif($avgDiff > 0.5)
                            Terdapat perbedaan rata-rata ukuran sebesar <strong>{{ number_format($avgDiff, 1) }} mm</strong>, namun masih dalam kategori <strong>{{ $measurement->classified_size_right }}</strong>.
                        @else
                            Ukuran kuku Anda konsisten dengan pengukuran sebelumnya (<strong>{{ $measurement->classified_size_right }}</strong>). Pertahankan ukuran yang sama!
                        @endif
                    </p>
                </div>
            </div>
        </div>
        @else
        <div class="bg-blue-50 rounded-2xl p-6 mb-8 border-l-4 border-blue-500">
            <p class="text-gray-700 flex items-center">
                <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Ini adalah pengukuran pertama Anda. Lakukan pengukuran berikutnya untuk melihat perbandingan!
            </p>
        </div>
        @endif

        <!-- Share Section -->
        <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-3xl shadow-xl p-8 mb-8">
            <h3 class="font-display text-2xl font-bold text-gray-800 mb-6 flex items-center">
                <svg class="w-7 h-7 mr-3 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path>
                </svg>
                Bagikan Hasil Pengukuran
            </h3>

            <div class="grid md:grid-cols-3 gap-4">
                <!-- Copy Link -->
                <button onclick="copyLink()" class="bg-white hover:bg-gray-50 border-2 border-purple-300 text-gray-700 px-6 py-4 rounded-2xl font-semibold shadow-md hover:shadow-lg transition-all duration-300 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                    </svg>
                    Copy Link
                </button>

                <!-- Share to WhatsApp -->
                <a href="https://wa.me/?text={{ urlencode('Lihat hasil pengukuran kuku saya di NailPerfect! Ukuran Tangan Kanan: ' . $measurement->classified_size_right . ($measurement->classified_size_left ? ', Tangan Kiri: ' . $measurement->classified_size_left : '') . ' - ' . url()->current()) }}" target="_blank" class="bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white px-6 py-4 rounded-2xl font-semibold shadow-md hover:shadow-lg transition-all duration-300 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                    </svg>
                    Share to WhatsApp
                </a>

                <!-- Show QR Code -->
                <button onclick="toggleQR()" class="bg-gradient-to-r from-blue-500 to-indigo-500 hover:from-blue-600 hover:to-indigo-600 text-white px-6 py-4 rounded-2xl font-semibold shadow-md hover:shadow-lg transition-all duration-300 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                    </svg>
                    Show QR Code
                </button>
            </div>

            <!-- QR Code Modal (Hidden by default) -->
            <div id="qrModal" class="hidden mt-6 p-6 bg-white rounded-2xl border-2 border-purple-200 text-center">
                <h4 class="font-bold text-lg text-gray-800 mb-4">Scan QR Code untuk membuka hasil</h4>
                <div class="flex justify-center mb-4">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ urlencode(url()->current()) }}" alt="QR Code" class="border-4 border-purple-200 rounded-xl">
                </div>
                <p class="text-sm text-gray-600">Scan dengan smartphone untuk membuka halaman ini</p>
                <button onclick="toggleQR()" class="mt-4 text-purple-600 hover:text-purple-700 font-semibold">Tutup</button>
            </div>

            <!-- Copy Success Message -->
            <div id="copySuccess" class="hidden mt-4 p-4 bg-green-100 border-l-4 border-green-500 rounded-lg">
                <p class="text-green-700 font-semibold flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Link berhasil disalin ke clipboard!
                </p>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4">
            <a href="{{ route('measurements.index') }}" class="flex-1">
                <button type="button" class="w-full bg-gradient-to-r from-gray-700 to-gray-800 hover:from-gray-800 hover:to-gray-900 text-white px-8 py-4 rounded-full font-bold text-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                    <svg class="inline-block w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Riwayat
                </button>
            </a>

            <a href="{{ route('measurements.print', $measurement->id) }}" target="_blank" class="flex-1">
                <button type="button" class="w-full bg-green-600 hover:bg-green-700 text-white px-8 py-4 rounded-full font-bold text-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                    <svg class="inline-block w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                    </svg>
                    Print / Download
                </button>
            </a>

            <a href="{{ route('input-data') }}" class="flex-1">
                <button type="button" class="w-full bg-gradient-to-r from-pink-500 to-rose-500 hover:from-pink-600 hover:to-rose-600 text-white px-8 py-4 rounded-full font-bold text-lg shadow-2xl hover:shadow-3xl transform hover:scale-105 hover:-translate-y-1 transition-all duration-300">
                    <svg class="inline-block w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    Ukur Ulang
                </button>
            </a>

            <form action="{{ route('measurements.destroy', $measurement->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pengukuran ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full bg-gradient-to-r from-red-500 to-rose-600 hover:from-red-600 hover:to-rose-700 text-white px-8 py-4 rounded-full font-bold text-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                    <svg class="inline-block w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    Hapus
                </button>
            </form>
        </div>
    </div>
</div>

<script>
// Copy link to clipboard
function copyLink() {
    const url = window.location.href;

    // Modern clipboard API
    if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(url).then(function() {
            showCopySuccess();
        }).catch(function(err) {
            // Fallback for older browsers
            fallbackCopyLink(url);
        });
    } else {
        fallbackCopyLink(url);
    }
}

// Fallback copy method
function fallbackCopyLink(text) {
    const textArea = document.createElement("textarea");
    textArea.value = text;
    textArea.style.position = "fixed";
    textArea.style.top = "0";
    textArea.style.left = "0";
    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();

    try {
        document.execCommand('copy');
        showCopySuccess();
    } catch (err) {
        alert('Gagal menyalin link. Silakan copy manual: ' + text);
    }

    document.body.removeChild(textArea);
}

// Show copy success message
function showCopySuccess() {
    const successMsg = document.getElementById('copySuccess');
    successMsg.classList.remove('hidden');

    setTimeout(function() {
        successMsg.classList.add('hidden');
    }, 3000);
}

// Toggle QR Code modal
function toggleQR() {
    const qrModal = document.getElementById('qrModal');
    qrModal.classList.toggle('hidden');
}
</script>

@include('components.footer')
@endsection
