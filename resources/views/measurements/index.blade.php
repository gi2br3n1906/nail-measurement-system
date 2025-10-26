@extends('layouts.app')

@section('title', 'Riwayat Pengukuran - Nail Measurement System')

@section('content')
@include('components.navbar')

<!-- Hero Section -->
<section class="bg-gradient-to-br from-pink-50 via-rose-50 to-pink-100 py-16">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl lg:text-5xl font-['Playfair_Display'] font-bold text-gray-800 mb-4">
            Riwayat Pengukuran
        </h1>
        <p class="text-lg lg:text-xl text-gray-600 max-w-2xl mx-auto">
            Lihat semua riwayat pengukuran kuku Anda
        </p>
    </div>
</section>

<!-- History List Section -->
<section class="py-16 lg:py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-5xl mx-auto">

            @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-8">
                <p class="font-semibold">{{ session('success') }}</p>
            </div>
            @endif

            @if($measurements->count() > 0)
                <!-- Measurements List -->
                <div class="space-y-6">
                    @foreach($measurements as $measurement)
                    <div class="bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden">
                        <div class="p-6 lg:p-8">
                            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                                <!-- Left Side: Info -->
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-3">
                                        <svg class="w-6 h-6 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <span class="text-gray-600">{{ $measurement->formatted_date }}</span>
                                    </div>

                                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-4">
                                        <!-- Right Hand Size -->
                                        <div class="bg-gradient-to-br from-pink-50 to-rose-50 rounded-xl p-4">
                                            <p class="text-xs text-gray-600 mb-1">Tangan Kanan</p>
                                            <p class="text-2xl font-bold text-pink-600">{{ $measurement->classified_size_right }}</p>
                                        </div>

                                        <!-- Left Hand Size (if exists) -->
                                        @if($measurement->left_hand_data)
                                        <div class="bg-gradient-to-br from-rose-50 to-pink-50 rounded-xl p-4">
                                            <p class="text-xs text-gray-600 mb-1">Tangan Kiri</p>
                                            <p class="text-2xl font-bold text-rose-600">{{ $measurement->classified_size_left }}</p>
                                        </div>
                                        @endif

                                        <!-- Average -->
                                        <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-4">
                                            <p class="text-xs text-gray-600 mb-1">Rata-rata</p>
                                            <p class="text-2xl font-bold text-gray-700">{{ $measurement->right_hand_average }} mm</p>
                                        </div>

                                        <!-- Confidence -->
                                        <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl p-4">
                                            <p class="text-xs text-gray-600 mb-1">Confidence</p>
                                            <p class="text-2xl font-bold text-green-600">{{ $measurement->confidence_score }}%</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Right Side: Actions -->
                                <div class="flex flex-col gap-3">
                                    <a href="{{ route('measurements.show', $measurement->id) }}"
                                       class="px-6 py-3 bg-gradient-to-r from-pink-500 to-rose-500 hover:from-pink-600 hover:to-rose-600 text-white rounded-full font-semibold text-center shadow-md hover:shadow-lg transition-all duration-300">
                                        Lihat Detail
                                    </a>

                                    <form action="{{ route('measurements.destroy', $measurement->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus riwayat ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-full font-semibold shadow-md transition-all duration-300">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12">
                    {{ $measurements->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-16">
                    <svg class="w-32 h-32 mx-auto text-gray-300 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <h3 class="text-3xl font-bold text-gray-600 mb-4">Belum Ada Riwayat</h3>
                    <p class="text-gray-500 mb-6">Anda belum pernah melakukan pengukuran</p>
                    <a href="{{ route('input-data') }}" class="inline-block px-8 py-3 bg-gradient-to-r from-pink-500 to-rose-500 hover:from-pink-600 hover:to-rose-600 text-white rounded-full font-semibold shadow-md hover:shadow-lg transition-all duration-300">
                        Mulai Pengukuran
                    </a>
                </div>
            @endif

        </div>
    </div>
</section>

@include('components.footer')
@endsection
