@extends('layouts.app')

@section('title', 'Inspirasi Nail Art - NailPerfect')

@section('content')
@include('components.navbar')

<!-- Hero Section -->
<section class="bg-gradient-to-br from-purple-600 via-pink-500 to-rose-500 text-white py-16">
    <div class="container mx-auto px-4">
        <div class="text-center max-w-3xl mx-auto">
            <h1 class="text-4xl lg:text-6xl font-['Playfair_Display'] font-bold mb-4">
                Inspirasi Nail Art
            </h1>
            <p class="text-lg lg:text-xl text-pink-100 mb-8">
                Temukan design nail art yang sempurna dari nailist profesional kami
            </p>

            <!-- Search Bar -->
            <div class="max-w-2xl mx-auto">
                <form action="{{ route('catalogs.index') }}" method="GET" class="relative">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari design nail art..."
                        class="w-full px-6 py-4 rounded-full text-gray-800 text-lg focus:outline-none focus:ring-4 focus:ring-purple-300 pr-14"
                    >
                    <button
                        type="submit"
                        class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white p-3 rounded-full transition"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Filters & Content -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar Filters -->
            <aside class="lg:w-64 flex-shrink-0">
                <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-24">
                    <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                        </svg>
                        Filter
                    </h3>

                    <form action="{{ route('catalogs.index') }}" method="GET">
                        <!-- Preserve search query -->
                        @if(request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif

                        <!-- Category Filter -->
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-3">Kategori</label>
                            <select name="category" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                <option value="all">Semua Kategori</option>
                                <option value="classic" {{ request('category') == 'classic' ? 'selected' : '' }}>Classic</option>
                                <option value="glitter" {{ request('category') == 'glitter' ? 'selected' : '' }}>Glitter</option>
                                <option value="minimalist" {{ request('category') == 'minimalist' ? 'selected' : '' }}>Minimalist</option>
                                <option value="floral" {{ request('category') == 'floral' ? 'selected' : '' }}>Floral</option>
                                <option value="marble" {{ request('category') == 'marble' ? 'selected' : '' }}>Marble</option>
                                <option value="neon" {{ request('category') == 'neon' ? 'selected' : '' }}>Neon</option>
                                <option value="geometric" {{ request('category') == 'geometric' ? 'selected' : '' }}>Geometric</option>
                                <option value="chrome" {{ request('category') == 'chrome' ? 'selected' : '' }}>Chrome</option>
                                <option value="pastel" {{ request('category') == 'pastel' ? 'selected' : '' }}>Pastel</option>
                                <option value="abstract" {{ request('category') == 'abstract' ? 'selected' : '' }}>Abstract</option>
                            </select>
                        </div>

                        <!-- Difficulty Filter -->
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-3">Tingkat Kesulitan</label>
                            <select name="difficulty" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                <option value="all">Semua Level</option>
                                <option value="easy" {{ request('difficulty') == 'easy' ? 'selected' : '' }}>Easy</option>
                                <option value="medium" {{ request('difficulty') == 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="hard" {{ request('difficulty') == 'hard' ? 'selected' : '' }}>Hard</option>
                            </select>
                        </div>

                        <!-- Sort Filter -->
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-3">Urutkan</label>
                            <select name="sort" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Paling Populer</option>
                                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                                <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Rating Tertinggi</option>
                                <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Harga Terendah</option>
                                <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Harga Tertinggi</option>
                            </select>
                        </div>

                        <!-- Apply Button -->
                        <button
                            type="submit"
                            class="w-full bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white py-3 rounded-lg font-semibold shadow-md hover:shadow-lg transition-all duration-300"
                        >
                            Terapkan Filter
                        </button>

                        <!-- Reset Button -->
                        <a
                            href="{{ route('catalogs.index') }}"
                            class="block w-full text-center text-gray-600 hover:text-gray-800 py-2 mt-2 font-medium transition"
                        >
                            Reset Filter
                        </a>
                    </form>
                </div>
            </aside>

            <!-- Catalog Grid -->
            <main class="flex-1">
                <!-- Results Info -->
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">
                            @if(request('search'))
                                Hasil pencarian "{{ request('search') }}"
                            @elseif(request('category') && request('category') != 'all')
                                {{ ucfirst(request('category')) }} Design
                            @else
                                Semua Design
                            @endif
                        </h2>
                        <p class="text-gray-600 mt-1">{{ $catalogs->total() }} design ditemukan</p>
                    </div>
                </div>

                <!-- Catalog Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($catalogs as $catalog)
                    <!-- Catalog Card -->
                    <a href="{{ route('catalogs.show', $catalog->id) }}" class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 overflow-hidden group">
                        <!-- Catalog Image -->
                        <div class="relative h-56 overflow-hidden bg-gradient-to-br from-pink-200 to-purple-200">
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
                            <div class="absolute top-3 left-3 flex flex-col gap-2">
                                <span class="bg-purple-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                                    {{ strtoupper($catalog->category) }}
                                </span>
                                <span class="bg-white/90 text-gray-800 px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                                    {{ strtoupper($catalog->difficulty) }}
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

                            <!-- Duration & Price -->
                            <div class="flex items-center justify-between mb-4 pb-4 border-b border-gray-200">
                                <div class="flex items-center gap-1 text-gray-600 text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $catalog->duration_minutes }} min
                                </div>
                                <p class="text-lg font-bold text-pink-600">{{ $catalog->formatted_price }}</p>
                            </div>

                            <!-- Nailist Info -->
                            <a href="{{ route('nailist.public.profile', $catalog->nailist->id) }}" class="flex items-center gap-2 group/nailist hover:bg-gray-50 p-2 -mx-2 rounded-lg transition-colors" onclick="event.stopPropagation()">
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
                        </div>
                    </a>
                    @empty
                    <!-- Empty State -->
                    <div class="col-span-3 text-center py-16">
                        <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="text-2xl font-bold text-gray-600 mb-2">Tidak Ada Design</h3>
                        <p class="text-gray-500 mb-6">Coba ubah filter atau kata kunci pencarian</p>
                        <a href="{{ route('catalogs.index') }}" class="inline-block bg-gradient-to-r from-purple-600 to-pink-600 text-white px-8 py-3 rounded-full font-semibold hover:shadow-lg transition">
                            Lihat Semua Design
                        </a>
                    </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($catalogs->hasPages())
                <div class="mt-12">
                    {{ $catalogs->links() }}
                </div>
                @endif
            </main>
        </div>
    </div>
</section>

@include('components.footer')
@endsection
