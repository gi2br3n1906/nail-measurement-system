@extends('layouts.app')

@section('title', $product->name . ' - Nail Measurement System')

@section('content')
@include('components.navbar')

<div class="min-h-screen bg-gradient-to-br from-pink-50 via-purple-50 to-blue-50 py-12">
    <div class="max-w-7xl mx-auto px-4">
        <!-- Breadcrumb -->
        <nav class="mb-8 flex items-center text-sm text-gray-600">
            <a href="{{ route('home') }}" class="hover:text-pink-500 transition-colors">Home</a>
            <svg class="w-3 h-3 mx-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
            </svg>
            <a href="{{ route('products.index') }}" class="hover:text-pink-500 transition-colors">Produk</a>
            <svg class="w-3 h-3 mx-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
            </svg>
            <span class="text-gray-800 font-medium">{{ $product->name }}</span>
        </nav>

        <!-- Product Detail -->
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden mb-12">
            <div class="grid md:grid-cols-2 gap-8 p-8 md:p-12">
                <!-- Product Image -->
                <div class="flex items-center justify-center bg-gradient-to-br from-pink-50 to-purple-50 rounded-2xl p-8">
                    <img src="{{ $product->image_url }}"
                         alt="{{ $product->name }}"
                         class="max-w-full h-auto rounded-xl shadow-lg hover:scale-105 transition-transform duration-300">
                </div>

                <!-- Product Info -->
                <div class="flex flex-col justify-center">
                    <!-- Size Badge -->
                    <div class="mb-4">
                        <span class="inline-block px-4 py-2 bg-gradient-to-r from-pink-500 to-rose-500 text-white font-bold rounded-full text-sm">
                            Size {{ $product->size }}
                        </span>
                    </div>

                    <!-- Product Name -->
                    <h1 class="font-display text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                        {{ $product->name }}
                    </h1>

                    <!-- Price -->
                    <div class="mb-6">
                        <span class="text-4xl font-bold bg-gradient-to-r from-pink-600 to-purple-600 bg-clip-text text-transparent">
                            {{ $product->formatted_price }}
                        </span>
                    </div>

                    <!-- Stock Status -->
                    <div class="mb-6">
                        @if($product->inStock())
                            <div class="flex items-center text-green-600">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="font-medium">Stok Tersedia ({{ $product->stock }} unit)</span>
                            </div>
                        @else
                            <div class="flex items-center text-red-600">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                <span class="font-medium">Stok Habis</span>
                            </div>
                        @endif
                    </div>

                    <!-- Description -->
                    <div class="mb-8">
                        <h3 class="font-bold text-gray-800 text-lg mb-3">Deskripsi Produk</h3>
                        <p class="text-gray-600 leading-relaxed">{{ $product->description }}</p>
                    </div>

                    <!-- Product Features -->
                    <div class="mb-8 p-6 bg-gradient-to-r from-pink-50 to-purple-50 rounded-2xl">
                        <h3 class="font-bold text-gray-800 text-lg mb-4">Keunggulan Produk</h3>
                        <ul class="space-y-3">
                            <li class="flex items-start">
                                <svg class="w-5 h-5 mr-3 text-pink-500 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700">Material berkualitas tinggi dan aman untuk kuku</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 mr-3 text-pink-500 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700">Mudah dipasang dan tahan lama hingga 2 minggu</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 mr-3 text-pink-500 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700">Desain eksklusif dan mengikuti tren terkini</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 mr-3 text-pink-500 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700">Sudah termasuk lem dan file kuku gratis</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        @if($product->inStock())
                            <a href="https://wa.me/6281234567890?text=Halo%2C%20saya%20ingin%20memesan%20{{ urlencode($product->name) }}%20(Size%20{{ $product->size }})%20seharga%20{{ urlencode($product->formatted_price) }}"
                               target="_blank"
                               class="flex-1">
                                <button type="button" class="w-full bg-gradient-to-r from-pink-500 to-rose-500 hover:from-pink-600 hover:to-rose-600 text-white px-8 py-4 rounded-full font-bold text-lg shadow-2xl hover:shadow-3xl transform hover:scale-105 hover:-translate-y-1 transition-all duration-300">
                                    <svg class="inline-block w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                                    </svg>
                                    Pesan via WhatsApp
                                </button>
                            </a>
                        @else
                            <button type="button" disabled class="flex-1 bg-gray-300 text-gray-500 px-8 py-4 rounded-full font-bold text-lg cursor-not-allowed">
                                <svg class="inline-block w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Stok Habis
                            </button>
                        @endif

                        <a href="{{ route('input-data') }}" class="flex-1">
                            <button type="button" class="w-full bg-gradient-to-r from-purple-500 to-indigo-500 hover:from-purple-600 hover:to-indigo-600 text-white px-8 py-4 rounded-full font-bold text-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                                <svg class="inline-block w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                                Cek Ukuran Saya
                            </button>
                        </a>
                    </div>

                    <!-- Size Guide Reminder -->
                    <div class="mt-6 p-4 bg-blue-50 rounded-xl border-l-4 border-blue-500">
                        <p class="text-sm text-gray-700 flex items-start">
                            <svg class="w-5 h-5 mr-2 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>
                                <strong>Tips:</strong> Belum tahu ukuran kuku Anda? Gunakan fitur
                                <a href="{{ route('input-data') }}" class="text-blue-600 hover:text-blue-700 font-medium underline">pengukuran otomatis</a>
                                kami untuk mengetahui ukuran yang pas!
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
        <div class="mb-12">
            <h2 class="font-display text-3xl md:text-4xl font-bold text-gray-800 text-center mb-8">
                Produk Sejenis
                <span class="block text-lg font-normal text-gray-600 mt-2">Size {{ $product->size }} Lainnya</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $related)
                <a href="{{ route('products.show', $related->id) }}" class="group">
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300">
                        <!-- Product Image -->
                        <div class="relative h-64 bg-gradient-to-br from-pink-100 to-purple-100 overflow-hidden">
                            <img src="{{ $related->image_url }}"
                                 alt="{{ $related->name }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">

                            <!-- Size Badge -->
                            <div class="absolute top-4 right-4">
                                <span class="px-3 py-1 bg-white/90 backdrop-blur-sm text-pink-600 font-bold rounded-full text-sm shadow-lg">
                                    {{ $related->size }}
                                </span>
                            </div>

                            <!-- Stock Badge -->
                            @if(!$related->inStock())
                            <div class="absolute top-4 left-4">
                                <span class="px-3 py-1 bg-red-500 text-white font-bold rounded-full text-xs">
                                    Habis
                                </span>
                            </div>
                            @endif
                        </div>

                        <!-- Product Info -->
                        <div class="p-6">
                            <h3 class="font-bold text-lg text-gray-800 mb-2 group-hover:text-pink-600 transition-colors line-clamp-2">
                                {{ $related->name }}
                            </h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $related->description }}</p>

                            <div class="flex items-center justify-between">
                                <span class="text-xl font-bold text-pink-600">
                                    {{ $related->formatted_price }}
                                </span>
                                <span class="text-sm text-gray-500">
                                    @if($related->inStock())
                                        <svg class="inline-block w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Stok: {{ $related->stock }}
                                    @else
                                        <span class="text-red-500 font-medium">Habis</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Back Button -->
        <div class="text-center">
            <a href="{{ route('products.index') }}">
                <button type="button" class="bg-white text-gray-700 border-2 border-gray-300 hover:bg-gray-50 px-8 py-3 rounded-full font-bold shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                    <svg class="inline-block w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Katalog
                </button>
            </a>
        </div>
    </div>
</div>

@include('components.footer')
@endsection
