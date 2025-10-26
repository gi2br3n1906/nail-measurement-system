@extends('layouts.app')

@section('title', 'Katalog Produk - Nail Measurement System')

@section('content')
@include('components.navbar')

<!-- Hero Section -->
<section class="bg-gradient-to-br from-pink-50 via-rose-50 to-pink-100 py-16">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl lg:text-5xl font-['Playfair_Display'] font-bold text-gray-800 mb-4">
            Katalog Produk
        </h1>
        <p class="text-lg lg:text-xl text-gray-600 max-w-2xl mx-auto">
            Temukan koleksi nail art terbaik untuk setiap ukuran
        </p>
    </div>
</section>

<!-- Filter & Search Section -->
<section class="py-8 bg-white shadow-sm sticky top-0 z-10">
    <div class="container mx-auto px-4">
        <form method="GET" action="{{ route('products.index') }}" id="filterForm" class="flex flex-col lg:flex-row gap-4 items-center justify-between">
            <!-- Search with Live Search -->
            <div class="w-full lg:w-96">
                <div class="relative">
                    <input type="text"
                           name="search"
                           id="searchInput"
                           value="{{ request('search') }}"
                           placeholder="Cari produk..."
                           class="w-full pl-12 pr-12 py-3 rounded-full border-2 border-pink-200 focus:border-pink-400 focus:outline-none focus:ring-2 focus:ring-pink-100 transition-all"
                           autocomplete="off">
                    <svg class="w-6 h-6 text-pink-400 absolute left-4 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <!-- Loading Spinner -->
                    <div id="searchSpinner" class="hidden absolute right-4 top-3.5">
                        <svg class="animate-spin h-6 w-6 text-pink-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Filter & Sort -->
            <div class="flex flex-wrap gap-3 items-center">
                <!-- Size Filter (Auto-submit on change) -->
                <select name="size"
                        id="sizeFilter"
                        class="px-4 py-3 rounded-full border-2 border-pink-200 focus:border-pink-400 focus:outline-none focus:ring-2 focus:ring-pink-100 bg-white cursor-pointer"
                        onchange="applyFilters()">
                    <option value="all" {{ request('size') == 'all' ? 'selected' : '' }}>Semua Ukuran</option>
                    <option value="XS" {{ request('size') == 'XS' ? 'selected' : '' }}>Size XS</option>
                    <option value="S" {{ request('size') == 'S' ? 'selected' : '' }}>Size S</option>
                    <option value="M" {{ request('size') == 'M' ? 'selected' : '' }}>Size M</option>
                    <option value="XL" {{ request('size') == 'XL' ? 'selected' : '' }}>Size XL</option>
                </select>

                <!-- Sort (Auto-submit on change) -->
                <select name="sort"
                        id="sortFilter"
                        class="px-4 py-3 rounded-full border-2 border-pink-200 focus:border-pink-400 focus:outline-none focus:ring-2 focus:ring-pink-100 bg-white cursor-pointer"
                        onchange="applyFilters()">
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                    <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Harga Terendah</option>
                    <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Harga Tertinggi</option>
                    <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Nama A-Z</option>
                </select>

                @if(request('search') || request('size') != 'all' || request('sort') != 'newest')
                <a href="{{ route('products.index') }}" class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-full font-semibold transition-all duration-300">
                    Reset
                </a>
                @endif
            </div>
        </form>
    </div>
</section>

<!-- Products Grid Section -->
<section class="py-16 lg:py-20">
    <div class="container mx-auto px-4">
        <div id="productsContainer">
            @include('products.partials.product-list')
        </div>
    </div>
</section>

@include('components.footer')

<script>
    let searchTimeout;
    const searchInput = document.getElementById('searchInput');
    const searchSpinner = document.getElementById('searchSpinner');
    const filterForm = document.getElementById('filterForm');
    const productsContainer = document.getElementById('productsContainer');

    // Fetch products via AJAX
    function fetchProducts() {
        const formData = new FormData(filterForm);
        const params = new URLSearchParams(formData);

        // Show loading spinner
        searchSpinner.classList.remove('hidden');

        // Add loading state to container
        productsContainer.style.opacity = '0.5';
        productsContainer.style.pointerEvents = 'none';

        // Fetch products
        fetch('{{ route("products.index") }}?' + params.toString(), {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'text/html'
            }
        })
        .then(response => response.text())
        .then(html => {
            // Update products container
            productsContainer.innerHTML = html;
            productsContainer.style.opacity = '1';
            productsContainer.style.pointerEvents = 'auto';

            // Hide loading spinner
            searchSpinner.classList.add('hidden');

            // Update URL without reload
            const newUrl = '{{ route("products.index") }}?' + params.toString();
            window.history.pushState({}, '', newUrl);

            // Smooth scroll to products section
            productsContainer.scrollIntoView({ behavior: 'smooth', block: 'start' });
        })
        .catch(error => {
            console.error('Error:', error);
            searchSpinner.classList.add('hidden');
            productsContainer.style.opacity = '1';
            productsContainer.style.pointerEvents = 'auto';
        });
    }

    // Live search with debounce (500ms delay)
    searchInput.addEventListener('input', function() {
        // Clear previous timeout
        clearTimeout(searchTimeout);

        // Set new timeout
        searchTimeout = setTimeout(function() {
            fetchProducts();
        }, 500);
    });

    // Apply filters (for size and sort dropdowns)
    function applyFilters() {
        fetchProducts();
    }

    // Prevent form submission (we handle it via AJAX)
    filterForm.addEventListener('submit', function(e) {
        e.preventDefault();
        fetchProducts();
    });

    // Hide spinner on page load
    window.addEventListener('pageshow', function() {
        searchSpinner.classList.add('hidden');
    });
</script>
@endsection
