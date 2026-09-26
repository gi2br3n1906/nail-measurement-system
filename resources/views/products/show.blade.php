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

                    <!-- Add to Cart Form -->
                    <form data-cart-add-form action="{{ route('cart.items.store') }}" method="POST" class="mb-6 space-y-4">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="cartSize" class="block text-sm font-bold text-gray-700 mb-2">Size</label>
                                <select id="cartSize" name="size" required class="w-full px-4 py-3 border-2 border-pink-200 rounded-xl focus:border-pink-500 focus:ring-2 focus:ring-pink-200 outline-none transition-all bg-white">
                                    @foreach($product->availableSizes() as $sizeOption)
                                        <option value="{{ $sizeOption }}" {{ $loop->first ? 'selected' : '' }}>Size {{ $sizeOption }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="cartLength" class="block text-sm font-bold text-gray-700 mb-2">Length</label>
                                <select id="cartLength" name="length" required class="w-full px-4 py-3 border-2 border-pink-200 rounded-xl focus:border-pink-500 focus:ring-2 focus:ring-pink-200 outline-none transition-all bg-white">
                                    @foreach($product->availableLengths() as $lengthOption)
                                        <option value="{{ $lengthOption }}" {{ $loop->first ? 'selected' : '' }}>{{ $lengthOption }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <label for="cartQuantity" class="text-sm font-bold text-gray-700">Qty</label>
                            <input type="number" id="cartQuantity" name="quantity" value="1" min="1" max="{{ max(1, $product->stock) }}" required class="w-20 px-3 py-2 border-2 border-pink-200 rounded-xl focus:border-pink-500 focus:ring-2 focus:ring-pink-200 outline-none transition-all text-center font-semibold">
                        </div>
                    </form>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        @if($product->inStock())
                            <button type="submit" data-cart-add-submit class="flex-1 bg-gradient-to-r from-pink-500 to-rose-500 hover:from-pink-600 hover:to-rose-600 text-white px-8 py-4 rounded-full font-bold text-lg shadow-2xl hover:shadow-3xl transform hover:scale-105 hover:-translate-y-1 transition-all duration-300">
                                <svg class="inline-block w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 3h2l2.2 11.1a2 2 0 002 1.6h8.9a2 2 0 002-1.6L22 7H6"></path>
                                    <circle cx="10" cy="20" r="1"></circle><circle cx="18" cy="20" r="1"></circle>
                                </svg>
                                Tambah ke Keranjang
                            </button>
                            <a href="https://wa.me/6281234567890?text=Halo%2C%20saya%20ingin%20memesan%20{{ urlencode($product->name) }}%20(Size%20{{ $product->size }})%20seharga%20{{ urlencode($product->formatted_price) }}"
                               target="_blank"
                               class="flex-1">
                                <button type="button" class="w-full bg-white border-2 border-pink-500 text-pink-600 hover:bg-pink-50 px-8 py-4 rounded-full font-bold text-lg shadow-md hover:shadow-lg transition-all duration-300">
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
