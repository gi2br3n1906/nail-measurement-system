@extends('layouts.app')

@section('title', 'Hasil Klasifikasi - Nail Measurement System')

@section('content')
@include('components.navbar')

<!-- Hero Section -->
<section class="bg-gradient-to-br from-pink-50 via-rose-50 to-pink-100 py-16">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl lg:text-5xl font-['Playfair_Display'] font-bold text-gray-800 mb-4">
            Hasil Klasifikasi
        </h1>
        <p class="text-lg lg:text-xl text-gray-600 max-w-2xl mx-auto">
            Berikut adalah hasil analisis ukuran kuku Anda
        </p>
    </div>
</section>

<!-- Results Section -->
<section class="py-16 lg:py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-5xl mx-auto space-y-8">

            <!-- Right Hand Results -->
            <div class="bg-white rounded-3xl shadow-2xl p-8 lg:p-12">
                <div class="flex items-center gap-4 mb-8">
                    <svg class="w-10 h-10 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11.5V14m0-2.5v-6a1.5 1.5 0 113 0m-3 6a1.5 1.5 0 00-3 0v2a7.5 7.5 0 0015 0v-5a1.5 1.5 0 00-3 0m-6-3V11m0-5.5v-1a1.5 1.5 0 013 0v1m0 0V11m0-5.5a1.5 1.5 0 013 0v3m0 0V11"></path>
                    </svg>
                    <h2 class="text-3xl font-['Playfair_Display'] font-bold text-gray-800">
                        {{ $hasLeftHand ? 'Tangan Kanan' : 'Hasil Pengukuran' }}
                    </h2>
                </div>

                <!-- Size Badge -->
                <div class="flex items-center justify-center mb-8">
                    <div class="relative">
                        <div class="bg-gradient-to-br from-pink-500 to-rose-500 text-white px-12 py-6 rounded-3xl shadow-2xl transform hover:scale-105 transition-all duration-300">
                            <p class="text-sm font-semibold uppercase tracking-wider mb-2">Ukuran Anda</p>
                            <p class="text-6xl font-bold">{{ $rightClassification['size'] }}</p>
                        </div>

                        @if(!$rightClassification['is_custom'])
                        <div class="absolute -top-4 -right-4 bg-white rounded-full px-4 py-2 shadow-lg border-2 border-pink-500">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-sm font-bold text-gray-700">{{ $rightClassification['confidence'] }}% Match</span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Recommendation Message -->
                <div class="bg-gradient-to-br from-pink-50 to-rose-50 rounded-2xl p-6 mb-8">
                    <div class="flex items-start gap-4">
                        <svg class="w-8 h-8 text-pink-500 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                        <p class="text-gray-700">{{ $rightClassification['recommendation'] }}</p>
                    </div>
                </div>

                <!-- Measurement Details -->
                <div class="border-t-2 border-pink-100 pt-8">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Detail Pengukuran</h3>
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
                        @foreach($rightHandData as $finger => $size)
                        <div class="bg-gradient-to-br from-pink-50 to-white rounded-xl p-4 text-center border-2 border-pink-100">
                            <p class="text-sm text-gray-600 mb-2 capitalize">{{ ucfirst($finger) }}</p>
                            <p class="text-2xl font-bold text-pink-600">{{ $size }}</p>
                            <p class="text-xs text-gray-400">mm</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Left Hand Results (if provided) -->
            @if($hasLeftHand && $leftClassification)
            <div class="bg-white rounded-3xl shadow-2xl p-8 lg:p-12">
                <div class="flex items-center gap-4 mb-8">
                    <svg class="w-10 h-10 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11.5V14m0-2.5v-6a1.5 1.5 0 113 0m-3 6a1.5 1.5 0 00-3 0v2a7.5 7.5 0 0015 0v-5a1.5 1.5 0 00-3 0m-6-3V11m0-5.5v-1a1.5 1.5 0 013 0v1m0 0V11m0-5.5a1.5 1.5 0 013 0v3m0 0V11"></path>
                    </svg>
                    <h2 class="text-3xl font-['Playfair_Display'] font-bold text-gray-800">Tangan Kiri</h2>
                </div>

                <!-- Size Badge -->
                <div class="flex items-center justify-center mb-8">
                    <div class="relative">
                        <div class="bg-gradient-to-br from-rose-500 to-pink-500 text-white px-12 py-6 rounded-3xl shadow-2xl transform hover:scale-105 transition-all duration-300">
                            <p class="text-sm font-semibold uppercase tracking-wider mb-2">Ukuran Anda</p>
                            <p class="text-6xl font-bold">{{ $leftClassification['size'] }}</p>
                        </div>

                        @if(!$leftClassification['is_custom'])
                        <div class="absolute -top-4 -right-4 bg-white rounded-full px-4 py-2 shadow-lg border-2 border-rose-500">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-sm font-bold text-gray-700">{{ $leftClassification['confidence'] }}% Match</span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Recommendation Message -->
                <div class="bg-gradient-to-br from-rose-50 to-pink-50 rounded-2xl p-6 mb-8">
                    <div class="flex items-start gap-4">
                        <svg class="w-8 h-8 text-rose-500 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                        <p class="text-gray-700">{{ $leftClassification['recommendation'] }}</p>
                    </div>
                </div>

                <!-- Measurement Details -->
                <div class="border-t-2 border-rose-100 pt-8">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Detail Pengukuran</h3>
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
                        @foreach($leftHandData as $finger => $size)
                        <div class="bg-gradient-to-br from-rose-50 to-white rounded-xl p-4 text-center border-2 border-rose-100">
                            <p class="text-sm text-gray-600 mb-2 capitalize">{{ ucfirst($finger) }}</p>
                            <p class="text-2xl font-bold text-rose-600">{{ $size }}</p>
                            <p class="text-xs text-gray-400">mm</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- Share Section -->
            <div class="bg-white rounded-3xl shadow-2xl p-8 lg:p-12">
                <div class="flex items-center gap-3 mb-6">
                    <svg class="w-8 h-8 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path>
                    </svg>
                    <h2 class="text-2xl font-['Playfair_Display'] font-bold text-gray-800">Bagikan Hasil</h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <!-- Copy Link Button -->
                    <button onclick="copyLink()" class="flex items-center justify-center gap-3 bg-white border-2 border-purple-300 hover:border-purple-400 hover:bg-purple-50 text-purple-700 px-6 py-4 rounded-2xl font-semibold shadow-md hover:shadow-lg transform hover:-translate-y-1 transition-all duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path>
                        </svg>
                        <span>Copy Link</span>
                    </button>

                    <!-- WhatsApp Share Button -->
                    <a href="https://wa.me/?text=Lihat%20hasil%20pengukuran%20kuku%20saya%20di%20NailPerfect!%20%0A%0AUkuran%20Tangan%20Kanan%3A%20{{ $rightClassification['size'] }}%0A{{ $hasLeftHand && $leftClassification ? 'Ukuran%20Tangan%20Kiri%3A%20' . $leftClassification['size'] . '%0A' : '' }}%0ACek%20detail%3A%20{{ urlencode(route('measurements.show', $measurementId)) }}"
                       target="_blank"
                       class="flex items-center justify-center gap-3 bg-green-600 hover:bg-green-700 text-white px-6 py-4 rounded-2xl font-semibold shadow-md hover:shadow-lg transform hover:-translate-y-1 transition-all duration-300">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                        </svg>
                        <span>WhatsApp</span>
                    </a>

                    <!-- QR Code Button -->
                    <button onclick="toggleQR()" class="flex items-center justify-center gap-3 bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white px-6 py-4 rounded-2xl font-semibold shadow-md hover:shadow-lg transform hover:-translate-y-1 transition-all duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                        </svg>
                        <span>QR Code</span>
                    </button>
                </div>

                <!-- Success Message (Hidden by default) -->
                <div id="copySuccess" class="hidden mt-4 bg-green-100 border-2 border-green-400 text-green-700 px-4 py-3 rounded-xl flex items-center gap-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="font-semibold">Link berhasil disalin ke clipboard!</span>
                </div>

                <!-- QR Code Modal (Hidden by default) -->
                <div id="qrModal" class="hidden mt-6 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-8 text-center border-2 border-blue-200">
                    <h4 class="text-xl font-bold text-gray-800 mb-4">Scan QR Code</h4>
                    <div class="flex justify-center mb-4">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ urlencode(route('measurements.show', $measurementId)) }}"
                             alt="QR Code"
                             class="rounded-xl shadow-lg border-4 border-white">
                    </div>
                    <p class="text-gray-600 text-sm">Scan dengan kamera smartphone untuk membuka hasil pengukuran</p>
                    <button onclick="toggleQR()" class="mt-4 text-blue-600 hover:text-blue-700 font-semibold">Tutup</button>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="{{ route('input-data') }}" class="flex-1">
                    <button type="button" class="w-full bg-white text-pink-600 border-2 border-pink-500 hover:bg-pink-50 px-8 py-4 rounded-full font-bold text-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                        <svg class="inline-block w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Ukur Ulang
                    </button>
                </a>

                <a href="{{ route('measurements.print', $measurementId) }}" target="_blank" class="flex-1">
                    <button type="button" class="w-full bg-green-600 hover:bg-green-700 text-white px-8 py-4 rounded-full font-bold text-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                        <svg class="inline-block w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                        </svg>
                        Print / Download
                    </button>
                </a>

                <a href="{{ route('measurements.index') }}" class="flex-1">
                    <button type="button" class="w-full bg-gradient-to-r from-cyan-500 to-blue-500 hover:from-cyan-600 hover:to-blue-600 text-white px-8 py-4 rounded-full font-bold text-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                        <svg class="inline-block w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Lihat Riwayat
                    </button>
                </a>

                @if($rightClassification['is_custom'] || ($hasLeftHand && $leftClassification && $leftClassification['is_custom']))
                    <!-- Custom Size Button - WhatsApp Contact -->
                    <a href="https://wa.me/6281234567890?text=Halo%2C%20saya%20ingin%20memesan%20Custom%20Size%20nail%20art.%0A%0AData%20Pengukuran%3A%0AJempol%3A%20{{ $rightHandData['jempol'] }}mm%0ATelunjuk%3A%20{{ $rightHandData['telunjuk'] }}mm%0ATengah%3A%20{{ $rightHandData['tengah'] }}mm%0AManis%3A%20{{ $rightHandData['manis'] }}mm%0AKelingking%3A%20{{ $rightHandData['kelingking'] }}mm"
                       target="_blank" class="flex-1">
                        <button type="button" class="w-full bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white px-8 py-4 rounded-full font-bold text-lg shadow-2xl hover:shadow-3xl transform hover:scale-105 hover:-translate-y-1 transition-all duration-300">
                            <svg class="inline-block w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                            </svg>
                            Pesan Custom Size via WhatsApp
                        </button>
                    </a>
                @else
                    <!-- Standard Size Button - Product Catalog -->
                    <a href="{{ route('home') }}#produk" class="flex-1">
                        <button type="button" class="w-full bg-gradient-to-r from-pink-500 to-rose-500 hover:from-pink-600 hover:to-rose-600 text-white px-8 py-4 rounded-full font-bold text-lg shadow-2xl hover:shadow-3xl transform hover:scale-105 hover:-translate-y-1 transition-all duration-300">
                            Lihat Produk Rekomendasi
                            <svg class="inline-block w-6 h-6 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </button>
                    </a>
                @endif
            </div>

            @if($rightClassification['is_custom'] || ($hasLeftHand && $leftClassification && $leftClassification['is_custom']))
            <!-- Custom Size Info Banner -->
            <div class="bg-gradient-to-r from-purple-100 via-pink-100 to-rose-100 rounded-3xl p-6 shadow-lg border-2 border-purple-200">
                <div class="flex items-start gap-4">
                    <svg class="w-8 h-8 text-purple-600 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    <div>
                        <h4 class="font-bold text-gray-800 mb-2 text-lg">Layanan Custom Size Tersedia!</h4>
                        <p class="text-gray-600 text-sm mb-3">
                            Ukuran kuku Anda unik dan tidak sesuai dengan size standar. Kami menyediakan layanan custom size khusus untuk Anda!
                            Produk akan dibuat sesuai dengan ukuran kuku Anda untuk hasil yang sempurna.
                        </p>
                        <ul class="text-gray-600 text-sm space-y-1">
                            <li>✨ Dibuat khusus sesuai ukuran Anda</li>
                            <li>✨ Proses 3-5 hari kerja</li>
                            <li>✨ Konsultasi gratis via WhatsApp</li>
                            <li>✨ Garansi pas 100%</li>
                        </ul>
                    </div>
                </div>
            </div>
            @endif


            <!-- Size Chart Reference -->
            <div class="bg-gradient-to-br from-pink-50 to-rose-50 rounded-3xl p-8 shadow-lg">
                <h3 class="text-2xl font-['Playfair_Display'] font-bold text-gray-800 mb-6 text-center">Referensi Size Chart</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-center">
                        <thead>
                            <tr class="border-b-2 border-pink-200">
                                <th class="py-3 px-4 font-bold text-gray-700">Size</th>
                                <th class="py-3 px-4 font-bold text-gray-700">Jempol</th>
                                <th class="py-3 px-4 font-bold text-gray-700">Telunjuk</th>
                                <th class="py-3 px-4 font-bold text-gray-700">Tengah</th>
                                <th class="py-3 px-4 font-bold text-gray-700">Manis</th>
                                <th class="py-3 px-4 font-bold text-gray-700">Kelingking</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-pink-100 hover:bg-pink-50 transition-colors">
                                <td class="py-3 px-4 font-bold text-pink-600">XS</td>
                                <td class="py-3 px-4 text-gray-600">14 mm</td>
                                <td class="py-3 px-4 text-gray-600">11 mm</td>
                                <td class="py-3 px-4 text-gray-600">12 mm</td>
                                <td class="py-3 px-4 text-gray-600">10 mm</td>
                                <td class="py-3 px-4 text-gray-600">8 mm</td>
                            </tr>
                            <tr class="border-b border-pink-100 hover:bg-pink-50 transition-colors">
                                <td class="py-3 px-4 font-bold text-pink-600">S</td>
                                <td class="py-3 px-4 text-gray-600">15 mm</td>
                                <td class="py-3 px-4 text-gray-600">12 mm</td>
                                <td class="py-3 px-4 text-gray-600">13 mm</td>
                                <td class="py-3 px-4 text-gray-600">11 mm</td>
                                <td class="py-3 px-4 text-gray-600">8 mm</td>
                            </tr>
                            <tr class="border-b border-pink-100 hover:bg-pink-50 transition-colors">
                                <td class="py-3 px-4 font-bold text-pink-600">M</td>
                                <td class="py-3 px-4 text-gray-600">16 mm</td>
                                <td class="py-3 px-4 text-gray-600">12 mm</td>
                                <td class="py-3 px-4 text-gray-600">13 mm</td>
                                <td class="py-3 px-4 text-gray-600">11 mm</td>
                                <td class="py-3 px-4 text-gray-600">9 mm</td>
                            </tr>
                            <tr class="hover:bg-pink-50 transition-colors">
                                <td class="py-3 px-4 font-bold text-pink-600">XL</td>
                                <td class="py-3 px-4 text-gray-600">18 mm</td>
                                <td class="py-3 px-4 text-gray-600">13 mm</td>
                                <td class="py-3 px-4 text-gray-600">14 mm</td>
                                <td class="py-3 px-4 text-gray-600">12 mm</td>
                                <td class="py-3 px-4 text-gray-600">10 mm</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <p class="text-center text-sm text-gray-500 mt-4">
                    <em>Note: 10 mm = 1 cm. Jika ukuran tidak cocok dengan size chart, tersedia opsi Custom Size.</em>
                </p>
            </div>
        </div>
    </div>
</section>

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
