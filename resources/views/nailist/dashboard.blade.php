@extends('nailist.layout')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Catalogs -->
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-pink-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Total Catalogs</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalCatalogs }}</p>
                    <p class="text-xs text-gray-500 mt-1">{{ $activeCatalogs }} active</p>
                </div>
                <div class="bg-pink-100 p-3 rounded-lg">
                    <svg class="w-8 h-8 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Views -->
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Total Views</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ number_format($totalViews) }}</p>
                    <p class="text-xs text-gray-500 mt-1">All time</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-lg">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Reviews -->
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-amber-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Total Reviews</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalReviews }}</p>
                    <p class="text-xs text-gray-500 mt-1">From customers</p>
                </div>
                <div class="bg-amber-100 p-3 rounded-lg">
                    <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Average Rating -->
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Average Rating</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ $averageRating ? number_format($averageRating, 1) : 'N/A' }}</p>
                    <div class="flex items-center mt-1">
                        @if($averageRating)
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $averageRating)
                                    <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                        <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                    </svg>
                                @else
                                    <svg class="w-4 h-4 text-gray-300 fill-current" viewBox="0 0 20 20">
                                        <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                    </svg>
                                @endif
                            @endfor
                        @else
                            <span class="text-xs text-gray-500">No reviews yet</span>
                        @endif
                    </div>
                </div>
                <div class="bg-green-100 p-3 rounded-lg">
                    <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Category Distribution -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Catalog by Category</h3>
            @if($categoryDistribution->count() > 0)
                <div class="space-y-3">
                    @foreach($categoryDistribution as $cat)
                        <div>
                            <div class="flex justify-between text-sm mb-1">
                                <span class="font-medium text-gray-700 capitalize">{{ $cat->category }}</span>
                                <span class="text-gray-600">{{ $cat->count }}</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-gradient-to-r from-pink-500 to-rose-500 h-2 rounded-full" style="width: {{ ($cat->count / $totalCatalogs) * 100 }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 text-center py-8">No catalog data yet</p>
            @endif
        </div>

        <!-- Monthly Views -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Views Last 6 Months</h3>
            @if($monthlyViews->count() > 0)
                <div class="space-y-3">
                    @foreach($monthlyViews->reverse() as $month)
                        <div>
                            <div class="flex justify-between text-sm mb-1">
                                <span class="font-medium text-gray-700">{{ $month->month }}</span>
                                <span class="text-gray-600">{{ $month->count }} views</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-gradient-to-r from-blue-500 to-cyan-500 h-2 rounded-full" style="width: {{ ($month->count / $monthlyViews->max('count')) * 100 }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 text-center py-8">No view data yet</p>
            @endif
        </div>
    </div>

    <!-- Tables Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Catalogs -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-bold text-gray-800">Recent Catalogs</h3>
                <a href="{{ route('nailist.catalogs.index') }}" class="text-sm text-pink-600 hover:text-pink-700 font-medium">View All →</a>
            </div>
            <div class="divide-y divide-gray-200">
                @forelse($recentCatalogs as $catalog)
                    <a href="{{ route('nailist.catalogs.show', $catalog) }}" class="block p-4 hover:bg-gray-50 transition-colors">
                        <div class="flex items-center gap-4">
                            @if(count($catalog->images) > 0)
                                <img src="{{ asset('storage/' . $catalog->images[0]) }}" alt="{{ $catalog->title }}" class="w-16 h-16 rounded-lg object-cover">
                            @else
                                <div class="w-16 h-16 rounded-lg bg-gray-200 flex items-center justify-center">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                            <div class="flex-1 min-w-0">
                                <h4 class="font-semibold text-gray-800 truncate">{{ $catalog->title }}</h4>
                                <p class="text-sm text-gray-500">{{ $catalog->view_count }} views • {{ $catalog->review_count }} reviews</p>
                            </div>
                            <span class="px-3 py-1 rounded-full text-xs font-medium {{ $catalog->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                                {{ $catalog->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                    </a>
                @empty
                    <div class="p-8 text-center text-gray-500">
                        <p>No catalogs yet</p>
                        <a href="{{ route('nailist.catalogs.create') }}" class="inline-block mt-4 bg-gradient-to-r from-pink-500 to-rose-500 text-white px-6 py-2 rounded-lg font-semibold hover:from-pink-600 hover:to-rose-600 transition-colors">
                            Create Your First Catalog
                        </a>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Top Performing Catalogs -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-bold text-gray-800">Top Performing</h3>
            </div>
            <div class="divide-y divide-gray-200">
                @forelse($topCatalogs as $catalog)
                    <a href="{{ route('nailist.catalogs.show', $catalog) }}" class="block p-4 hover:bg-gray-50 transition-colors">
                        <div class="flex items-center gap-4">
                            @if(count($catalog->images) > 0)
                                <img src="{{ asset('storage/' . $catalog->images[0]) }}" alt="{{ $catalog->title }}" class="w-16 h-16 rounded-lg object-cover">
                            @else
                                <div class="w-16 h-16 rounded-lg bg-gray-200 flex items-center justify-center">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                            <div class="flex-1 min-w-0">
                                <h4 class="font-semibold text-gray-800 truncate">{{ $catalog->title }}</h4>
                                <div class="flex items-center gap-3 text-sm text-gray-500">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        {{ $catalog->view_count }}
                                    </span>
                                    @if($catalog->average_rating > 0)
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                                <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                            </svg>
                                            {{ number_format($catalog->average_rating, 1) }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="p-8 text-center text-gray-500">
                        <p>No active catalogs yet</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-gradient-to-r from-pink-500 to-rose-500 rounded-xl shadow-md p-8 text-white">
        <div class="flex flex-col md:flex-row items-center justify-between gap-6">
            <div>
                <h3 class="text-2xl font-bold mb-2">Ready to add more designs?</h3>
                <p class="text-pink-100">Upload your nail art catalog and reach more customers!</p>
            </div>
            <a href="{{ route('nailist.catalogs.create') }}" class="bg-white text-pink-600 px-8 py-3 rounded-lg font-bold hover:bg-pink-50 transition-colors shadow-lg whitespace-nowrap">
                + Upload New Catalog
            </a>
        </div>
    </div>
</div>
@endsection
