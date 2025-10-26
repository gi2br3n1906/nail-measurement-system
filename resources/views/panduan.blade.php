@extends('layouts.app')

@section('title', 'Panduan Pengukuran - Nail Measurement System')

@section('content')
@include('components.navbar')

<!-- Hero Section -->
<section class="bg-gradient-to-br from-pink-50 via-rose-50 to-pink-100 py-16">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl lg:text-5xl font-['Playfair_Display'] font-bold text-gray-800 mb-4">
            Panduan Pengukuran Kuku
        </h1>
        <p class="text-lg lg:text-xl text-gray-600 max-w-2xl mx-auto">
            Ikuti langkah-langkah berikut untuk mendapatkan ukuran kuku yang akurat
        </p>
    </div>
</section>

<!-- Langkah-langkah Panduan -->
<section class="py-16 lg:py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Langkah 1 -->
            <div class="mb-12 flex flex-col md:flex-row gap-8 items-center">
                <div class="md:w-1/2">
                    <div class="bg-gradient-to-br from-pink-200 to-rose-200 rounded-3xl h-64 lg:h-80 flex items-center justify-center shadow-xl">
                        <div class="text-center p-6">
                            <div class="bg-white rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                                <span class="text-4xl font-bold text-pink-500">1</span>
                            </div>
                            <svg class="w-24 h-24 mx-auto text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <p class="text-pink-600 text-sm mt-3 font-medium">Ilustrasi Alat Ukur</p>
                        </div>
                    </div>
                </div>
                <div class="md:w-1/2">
                    <div class="bg-white rounded-3xl p-8 shadow-lg">
                        <h3 class="text-2xl font-['Playfair_Display'] font-bold text-gray-800 mb-4">
                            Siapkan Alat Ukur
                        </h3>
                        <p class="text-gray-600 leading-relaxed mb-4">
                            Siapkan penggaris atau alat ukur dengan satuan milimeter (mm). Pastikan alat ukur Anda bersih dan dalam kondisi baik untuk hasil pengukuran yang akurat.
                        </p>
                        <ul class="list-disc list-inside text-gray-600 space-y-2">
                            <li>Penggaris transparan atau plastik (lebih mudah dibaca)</li>
                            <li>Meteran kecil atau pita ukur</li>
                            <li>Kaliper digital (opsional, untuk presisi maksimal)</li>
                            <li>Pastikan alat ukur dimulai dari angka 0 yang jelas</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Langkah 2 -->
            <div class="mb-12 flex flex-col md:flex-row-reverse gap-8 items-center">
                <div class="md:w-1/2">
                    <div class="bg-gradient-to-br from-rose-200 to-pink-300 rounded-3xl h-64 lg:h-80 flex items-center justify-center shadow-xl">
                        <div class="text-center p-6">
                            <div class="bg-white rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                                <span class="text-4xl font-bold text-rose-500">2</span>
                            </div>
                            <svg class="w-24 h-24 mx-auto text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                            </svg>
                            <p class="text-rose-600 text-sm mt-3 font-medium">Ilustrasi Membersihkan Kuku</p>
                        </div>
                    </div>
                </div>
                <div class="md:w-1/2">
                    <div class="bg-white rounded-3xl p-8 shadow-lg">
                        <h3 class="text-2xl font-['Playfair_Display'] font-bold text-gray-800 mb-4">
                            Bersihkan Kuku
                        </h3>
                        <p class="text-gray-600 leading-relaxed mb-4">
                            Pastikan kuku Anda bersih dan kering. Lepaskan cat kuku, press on nails lama, atau dekorasi nail art yang masih menempel.
                        </p>
                        <ul class="list-disc list-inside text-gray-600 space-y-2">
                            <li>Cuci tangan dengan sabun dan air hangat</li>
                            <li>Keringkan dengan handuk bersih dan lembut</li>
                            <li>Hapus sisa cat kuku dengan acetone/remover</li>
                            <li>Pastikan permukaan kuku rata dan bersih</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Langkah 3 -->
            <div class="mb-12 flex flex-col md:flex-row gap-8 items-center">
                <div class="md:w-1/2">
                    <div class="bg-gradient-to-br from-pink-300 to-rose-300 rounded-3xl h-64 lg:h-80 flex items-center justify-center shadow-xl">
                        <div class="text-center p-6">
                            <div class="bg-white rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                                <span class="text-4xl font-bold text-pink-600">3</span>
                            </div>
                            <svg class="w-24 h-24 mx-auto text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            <p class="text-pink-600 text-sm mt-3 font-medium">Ilustrasi Cara Mengukur</p>
                        </div>
                    </div>
                </div>
                <div class="md:w-1/2">
                    <div class="bg-white rounded-3xl p-8 shadow-lg">
                        <h3 class="text-2xl font-['Playfair_Display'] font-bold text-gray-800 mb-4">
                            Ukur Lebar Kuku
                        </h3>
                        <p class="text-gray-600 leading-relaxed mb-4">
                            Ukur lebar kuku dari sisi kiri ke kanan pada bagian terlebar (biasanya di tengah kuku). Posisikan penggaris horizontal melintasi kuku. Lakukan pada setiap jari dengan teliti.
                        </p>
                        <ul class="list-disc list-inside text-gray-600 space-y-2">
                            <li>Posisikan penggaris horizontal di bagian terlebar kuku</li>
                            <li>Catat ukuran dalam satuan milimeter (mm) dengan 1 desimal</li>
                            <li>Ulangi pengukuran untuk ke-5 jari tangan kanan</li>
                            <li>Ukur saat jari dalam kondisi rileks dan tidak bengkak</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Langkah 4 -->
            <div class="mb-12 flex flex-col md:flex-row-reverse gap-8 items-center">
                <div class="md:w-1/2">
                    <div class="bg-gradient-to-br from-rose-300 to-pink-400 rounded-3xl h-64 lg:h-80 flex items-center justify-center shadow-xl">
                        <div class="text-center p-6">
                            <div class="bg-white rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                                <span class="text-4xl font-bold text-rose-600">4</span>
                            </div>
                            <svg class="w-24 h-24 mx-auto text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            </svg>
                            <p class="text-rose-600 text-sm mt-3 font-medium">Ilustrasi Mencatat Hasil</p>
                        </div>
                    </div>
                </div>
                <div class="md:w-1/2">
                    <div class="bg-white rounded-3xl p-8 shadow-lg">
                        <h3 class="text-2xl font-['Playfair_Display'] font-bold text-gray-800 mb-4">
                            Catat Hasil Ukuran
                        </h3>
                        <p class="text-gray-600 leading-relaxed mb-4">
                            Catat semua hasil pengukuran dengan rapi di kertas atau catatan HP. Siapkan data untuk diinput ke sistem. Pastikan tidak ada angka yang tertukar atau salah catat.
                        </p>
                        <ul class="list-disc list-inside text-gray-600 space-y-2">
                            <li><strong>Jempol:</strong> ... mm (contoh: 14.5 mm)</li>
                            <li><strong>Telunjuk:</strong> ... mm (contoh: 12.0 mm)</li>
                            <li><strong>Jari Tengah:</strong> ... mm (contoh: 12.5 mm)</li>
                            <li><strong>Jari Manis:</strong> ... mm (contoh: 11.0 mm)</li>
                            <li><strong>Kelingking:</strong> ... mm (contoh: 9.5 mm)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Video Tutorial Section -->
<section class="py-16 bg-gradient-to-br from-pink-100 via-rose-100 to-pink-100">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl lg:text-4xl font-['Playfair_Display'] font-bold text-gray-800 mb-4">
                Video Tutorial
            </h2>
            <p class="text-lg text-gray-600 mb-10">
                Tonton video tutorial singkat untuk panduan lebih jelas dan detail cara mengukur kuku yang benar
            </p>

            <!-- Video Placeholder -->
            <div class="bg-gradient-to-br from-pink-200 to-rose-200 rounded-3xl shadow-2xl overflow-hidden">
                <div class="aspect-video flex items-center justify-center">
                    <div class="text-center p-8">
                        <svg class="w-32 h-32 mx-auto text-pink-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-pink-600 font-semibold text-xl mb-2">Video Tutorial Placeholder</p>
                        <p class="text-pink-500 text-sm">Video berkualitas tinggi akan ditambahkan di sini</p>
                        <p class="text-gray-500 text-xs mt-3 italic">
                            * Video akan menampilkan demonstrasi lengkap cara mengukur kuku<br>
                            dengan penggaris untuk hasil yang akurat
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Next Button Section -->
<section class="py-16">
    <div class="container mx-auto px-4 text-center">
        <div class="max-w-2xl mx-auto">
            <p class="text-lg text-gray-600 mb-8">
                Sudah siap dengan hasil pengukuran Anda? Mari lanjutkan ke tahap input data!
            </p>
            <a href="{{ route('input-data') }}">
                <button class="bg-gradient-to-r from-pink-500 to-rose-500 hover:from-pink-600 hover:to-rose-600 text-white px-16 py-5 rounded-full font-bold text-xl shadow-2xl hover:shadow-3xl transform hover:scale-105 hover:-translate-y-1 transition-all duration-300">
                    Lanjut ke Input Data
                    <svg class="inline-block w-6 h-6 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </button>
            </a>
        </div>
    </div>
</section>

@include('components.footer')
@endsection
