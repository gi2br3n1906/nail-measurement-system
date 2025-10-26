@if($products->count() > 0)
    <!-- Results Info -->
    <div class="mb-8 text-center text-gray-600">
        Menampilkan <strong>{{ $products->count() }}</strong> dari <strong>{{ $products->total() }}</strong> produk
    </div>

    <!-- Products Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
        @foreach($products as $product)
        <div class="bg-white rounded-3xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 overflow-hidden">
            <div class="bg-gradient-to-br from-pink-200 to-rose-200 h-56 flex items-center justify-center relative">
                @if($product->stock < 10 && $product->stock > 0)
                    <span class="absolute top-3 right-3 bg-yellow-400 text-yellow-900 px-3 py-1 rounded-full text-xs font-bold">STOK TERBATAS</span>
                @elseif($product->stock == 0)
                    <span class="absolute top-3 right-3 bg-red-500 text-white px-3 py-1 rounded-full text-xs font-bold">SOLD OUT</span>
                @endif
                <span class="absolute top-3 left-3 bg-pink-500 text-white px-3 py-1 rounded-full text-xs font-bold">SIZE {{ $product->size }}</span>

                <!-- Placeholder Image -->
                <svg class="w-24 h-24 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <div class="p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-2 line-clamp-2 min-h-[3.5rem]">{{ $product->name }}</h3>
                <p class="text-sm text-gray-600 mb-3 line-clamp-2 min-h-[2.5rem]">{{ $product->description }}</p>
                <div class="flex items-center justify-between mb-4">
                    <p class="text-2xl font-bold text-pink-600">{{ $product->formatted_price }}</p>
                    <span class="text-sm text-gray-500">Stok: {{ $product->stock }}</span>
                </div>
                <a href="{{ route('products.show', $product->id) }}">
                    <button
                        class="w-full bg-gradient-to-r from-pink-500 to-rose-500 hover:from-pink-600 hover:to-rose-600 text-white py-3 rounded-full font-semibold shadow-md hover:shadow-lg transition-all duration-300 {{ $product->stock == 0 ? 'opacity-50 cursor-not-allowed' : '' }}"
                        {{ $product->stock == 0 ? 'disabled' : '' }}>
                        {{ $product->stock == 0 ? 'Stok Habis' : 'Lihat Detail' }}
                    </button>
                </a>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-12">
        {{ $products->links() }}
    </div>
@else
    <!-- No Products Found -->
    <div class="text-center py-16">
        <svg class="w-32 h-32 mx-auto text-gray-300 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <h3 class="text-3xl font-bold text-gray-600 mb-4">Produk Tidak Ditemukan</h3>
        <p class="text-gray-500 mb-6">Coba ubah filter atau kata kunci pencarian</p>
        <a href="{{ route('products.index') }}" class="inline-block px-8 py-3 bg-gradient-to-r from-pink-500 to-rose-500 hover:from-pink-600 hover:to-rose-600 text-white rounded-full font-semibold shadow-md hover:shadow-lg transition-all duration-300">
            Lihat Semua Produk
        </a>
    </div>
@endif
