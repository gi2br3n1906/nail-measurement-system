@extends('layouts.app')

@section('title', 'Home - Nail Measurement System')

@section('content')
@include('components.navbar')

<!-- Body Section 1: Banner Utama -->
<section class="relative px-4 lg:px-8 pt-8">
    <!-- Banner Image Full Width -->
    <div class="w-full">
        <div class="bg-gradient-to-br from-pink-200 via-rose-200 to-pink-300 rounded-3xl shadow-2xl h-96 lg:h-[500px] flex items-center justify-center overflow-hidden">
            <div class="text-center p-8">
                <svg class="w-32 h-32 lg:w-48 lg:h-48 mx-auto text-pink-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <p class="text-pink-600 font-semibold text-lg lg:text-2xl">Banner Image Placeholder</p>
            </div>
        </div>
    </div>

    <!-- Text Content Below Banner -->
    <div class="container mx-auto px-4 py-12 lg:py-20">
        <div class="text-center max-w-4xl mx-auto">
            <h2 class="text-4xl lg:text-6xl font-['Playfair_Display'] font-bold text-gray-800 mb-6 leading-tight">
                Temukan Ukuran Kuku yang
                <span class="bg-gradient-to-r from-pink-500 via-rose-500 to-pink-600 bg-clip-text text-transparent">
                    Sempurna
                </span>
                untuk Anda
            </h2>
            <p class="text-lg lg:text-xl text-gray-600 mb-10 leading-relaxed">
                Sistem pengukuran kuku yang mudah dan akurat untuk hasil nail art yang sempurna
            </p>
            <div class="flex justify-center">
                <a href="#katalog" class="bg-white text-pink-500 border-2 border-pink-500 hover:bg-pink-50 px-10 py-4 rounded-full font-semibold text-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                    Lihat Katalog Desain
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Body Section 2: Call to Action -->
<section class="py-16 bg-gradient-to-r from-pink-500 via-rose-500 to-pink-600">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl lg:text-5xl font-['Playfair_Display'] font-bold text-white mb-6">
            Ukur Kuku Anda Sekarang
        </h2>
        <p class="text-lg lg:text-xl text-pink-100 mb-10 max-w-2xl mx-auto">
            Dapatkan rekomendasi produk yang sesuai dengan ukuran kuku Anda
        </p>
        <a href="{{ route('panduan') }}">
            <button class="bg-white text-pink-600 px-12 py-5 rounded-full font-bold text-lg shadow-2xl hover:shadow-3xl transform hover:scale-105 hover:-translate-y-1 transition-all duration-300">
                Mulai Pengukuran
            </button>
        </a>
    </div>
</section>

<!-- Body Section 3: Katalog Desain Nail Art -->
<section id="katalog" class="py-16 lg:py-24 bg-gradient-to-br from-purple-50 via-pink-50 to-rose-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl lg:text-5xl font-['Playfair_Display'] font-bold text-gray-800 mb-4">
                Katalog Desain Nail Art
            </h2>
            <p class="text-lg text-gray-600">Koleksi desain dari nailist profesional kami</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse($catalogs as $catalog)
            <!-- Catalog Card -->
            <div class="bg-white rounded-3xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 overflow-hidden group">
                <!-- Catalog Image -->
                <div class="relative h-64 overflow-hidden bg-gradient-to-br from-pink-200 to-purple-200">
                    @if($catalog->images && count($catalog->images) > 0)
                        <img src="{{ asset('storage/' . $catalog->images[0]) }}"
                             alt="{{ $catalog->title }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <svg class="w-20 h-20 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif

                    <!-- Badges -->
                    <div class="absolute top-3 left-3 flex gap-2">
                        <span class="bg-purple-500 text-white px-3 py-1 rounded-full text-xs font-bold">
                            {{ strtoupper($catalog->category) }}
                        </span>
                    </div>

                    <!-- Stats Overlay -->
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4">
                        <div class="flex items-center justify-between text-white text-xs">
                            <div class="flex items-center gap-3">
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    {{ number_format($catalog->view_count) }}
                                </span>
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    {{ number_format($catalog->average_rating, 1) }}
                                </span>
                            </div>
                            <span class="text-pink-200 font-semibold">{{ $catalog->formatted_price }}</span>
                        </div>
                    </div>
                </div>

                <!-- Catalog Info -->
                <div class="p-5">
                    <h3 class="text-lg font-bold text-gray-800 mb-2 line-clamp-1 group-hover:text-pink-600 transition-colors">
                        {{ $catalog->title }}
                    </h3>
                    <p class="text-sm text-gray-600 mb-3 line-clamp-2 min-h-[2.5rem]">
                        {{ $catalog->description }}
                    </p>

                    <!-- Nailist Info -->
                    @auth
                    <a href="{{ route('nailist.public.profile', $catalog->nailist->id) }}" class="flex items-center gap-2 mb-4 pb-4 border-b border-gray-200 group/nailist hover:bg-gray-50 p-2 -mx-2 rounded-lg transition-colors" onclick="event.stopPropagation()">
                        <div class="w-8 h-8 bg-gradient-to-br from-pink-400 to-purple-400 rounded-full flex items-center justify-center text-white text-sm font-bold group-hover/nailist:scale-110 transition-transform">
                            {{ substr($catalog->nailist->name, 0, 1) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-700 group-hover/nailist:text-purple-600 truncate transition-colors">{{ $catalog->nailist->salon_name ?? $catalog->nailist->name }}</p>
                            <p class="text-xs text-gray-500">Professional Nailist</p>
                        </div>
                        <svg class="w-4 h-4 text-gray-400 group-hover/nailist:text-purple-600 opacity-0 group-hover/nailist:opacity-100 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                    @else
                    <div class="flex items-center gap-2 mb-4 pb-4 border-b border-gray-200">
                        <div class="w-8 h-8 bg-gradient-to-br from-pink-400 to-purple-400 rounded-full flex items-center justify-center text-white text-sm font-bold">
                            {{ substr($catalog->nailist->name, 0, 1) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-700 truncate">{{ $catalog->nailist->salon_name ?? $catalog->nailist->name }}</p>
                            <p class="text-xs text-gray-500">Professional Nailist</p>
                        </div>
                    </div>
                    @endauth

                    <!-- Action Button -->
                    @auth
                        <a href="{{ route('catalogs.show', $catalog->id) }}" class="block w-full bg-gradient-to-r from-pink-500 to-purple-500 hover:from-pink-600 hover:to-purple-600 text-white py-3 rounded-full font-semibold shadow-md hover:shadow-lg transition-all duration-300 text-center">
                            Lihat Detail
                        </a>
                    @else
                        <button onclick="showLoginPrompt()" class="block w-full bg-gradient-to-r from-pink-500 to-purple-500 hover:from-pink-600 hover:to-purple-600 text-white py-3 rounded-full font-semibold shadow-md hover:shadow-lg transition-all duration-300 text-center">
                            Lihat Detail
                        </button>
                    @endauth
                </div>
            </div>
            @empty
            <!-- No Catalogs Message -->
            <div class="col-span-4 text-center py-16">
                <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <h3 class="text-2xl font-bold text-gray-600 mb-2">Belum Ada Inspirasi</h3>
                <p class="text-gray-500">Design nail art akan segera hadir dari nailist kami!</p>
            </div>
            @endforelse
        </div>

        <div class="text-center mt-12">
            @auth
                <a href="{{ route('catalogs.index') }}" class="inline-block bg-white text-purple-600 border-2 border-purple-500 hover:bg-purple-50 px-10 py-4 rounded-full font-bold text-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                    Jelajahi Semua Design
                </a>
            @else
                <button onclick="showLoginPrompt()" class="inline-block bg-white text-purple-600 border-2 border-purple-500 hover:bg-purple-50 px-10 py-4 rounded-full font-bold text-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                    Jelajahi Semua Design
                </button>
            @endauth
        </div>
    </div>
</section>

<!-- Body Section 5: Testimoni & Ulasan -->
<section id="testimoni" class="py-16 lg:py-24 bg-gradient-to-br from-pink-100 via-rose-100 to-pink-100">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl lg:text-5xl font-['Playfair_Display'] font-bold text-gray-800 mb-4">
                Testimoni & Ulasan
            </h2>
            <p class="text-lg text-gray-600">Apa kata pelanggan kami</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Testimonial Card 1 -->
            <div class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300">
                <div class="flex items-center mb-6">
                    <div class="w-16 h-16 bg-gradient-to-br from-pink-400 to-rose-400 rounded-full flex items-center justify-center text-white text-2xl font-bold">
                        SA
                    </div>
                    <div class="ml-4">
                        <h4 class="font-bold text-gray-800 text-lg">Sarah Amanda</h4>
                        <div class="flex text-yellow-400 text-sm">
                            ⭐⭐⭐⭐⭐
                        </div>
                    </div>
                </div>
                <p class="text-gray-600 leading-relaxed italic">
                    "Sistem pengukurannya sangat membantu! Sekarang nail art saya selalu pas dan nyaman dipakai."
                </p>
            </div>

            <!-- Testimonial Card 2 -->
            <div class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300">
                <div class="flex items-center mb-6">
                    <div class="w-16 h-16 bg-gradient-to-br from-rose-400 to-pink-500 rounded-full flex items-center justify-center text-white text-2xl font-bold">
                        DP
                    </div>
                    <div class="ml-4">
                        <h4 class="font-bold text-gray-800 text-lg">Dinda Permata</h4>
                        <div class="flex text-yellow-400 text-sm">
                            ⭐⭐⭐⭐⭐
                        </div>
                    </div>
                </div>
                <p class="text-gray-600 leading-relaxed italic">
                    "Mudah digunakan dan hasilnya akurat. Rekomendasi produknya juga sangat membantu!"
                </p>
            </div>

            <!-- Testimonial Card 3 -->
            <div class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300">
                <div class="flex items-center mb-6">
                    <div class="w-16 h-16 bg-gradient-to-br from-pink-500 to-rose-500 rounded-full flex items-center justify-center text-white text-2xl font-bold">
                        MP
                    </div>
                    <div class="ml-4">
                        <h4 class="font-bold text-gray-800 text-lg">Melissa Putri</h4>
                        <div class="flex text-yellow-400 text-sm">
                            ⭐⭐⭐⭐⭐
                        </div>
                    </div>
                </div>
                <p class="text-gray-600 leading-relaxed italic">
                    "Kualitas produk bagus dan ukurannya benar-benar sesuai. Highly recommended!"
                </p>
            </div>
        </div>

        <div class="text-center mt-12">
            <a href="#" class="inline-block bg-gradient-to-r from-pink-500 to-rose-500 hover:from-pink-600 hover:to-rose-600 text-white px-10 py-4 rounded-full font-bold text-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                Lihat Semua Ulasan
            </a>
        </div>
    </div>
</section>

@include('components.footer')
@endsection
