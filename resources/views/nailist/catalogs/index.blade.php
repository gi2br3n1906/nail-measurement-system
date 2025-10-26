@extends('nailist.layout')

@section('title', 'My Catalogs')
@section('page-title', 'My Catalogs')

@section('content')
<div class="space-y-6">
    <!-- Header Actions -->
    <div class="flex justify-between items-center">
        <div>
            <h3 class="text-xl font-bold text-gray-800">Manage Your Nail Art Catalogs</h3>
            <p class="text-gray-600 text-sm mt-1">Upload and manage your beautiful designs</p>
        </div>
        <a href="{{ route('nailist.catalogs.create') }}" class="bg-gradient-to-r from-pink-500 to-rose-500 hover:from-pink-600 hover:to-rose-600 text-white px-6 py-3 rounded-lg font-semibold shadow-md hover:shadow-lg transition-all flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Upload New Catalog
        </a>
    </div>

    <!-- Catalogs Grid -->
    @if($catalogs->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($catalogs as $catalog)
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                    <!-- Image -->
                    <div class="relative aspect-square">
                        @if(count($catalog->images) > 0)
                            <img src="{{ asset('storage/' . $catalog->images[0]) }}" alt="{{ $catalog->title }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif

                        <!-- Status Badge -->
                        <span class="absolute top-3 right-3 px-3 py-1 rounded-full text-xs font-bold {{ $catalog->is_active ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }} shadow-lg">
                            {{ $catalog->is_active ? 'Active' : 'Inactive' }}
                        </span>

                        <!-- Images Count -->
                        @if(count($catalog->images) > 1)
                            <span class="absolute top-3 left-3 px-2 py-1 bg-black/60 text-white text-xs rounded-full flex items-center gap-1">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                                </svg>
                                {{ count($catalog->images) }}
                            </span>
                        @endif
                    </div>

                    <!-- Content -->
                    <div class="p-5">
                        <!-- Title & Category -->
                        <div class="mb-3">
                            <h4 class="font-bold text-gray-800 text-lg mb-1 line-clamp-1">{{ $catalog->title }}</h4>
                            <span class="inline-block px-2 py-1 bg-pink-100 text-pink-700 text-xs font-medium rounded-full capitalize">
                                {{ $catalog->category }}
                            </span>
                        </div>

                        <!-- Stats -->
                        <div class="flex items-center gap-4 text-sm text-gray-600 mb-4">
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                {{ $catalog->view_count }}
                            </span>
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                    <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                </svg>
                                {{ $catalog->average_rating > 0 ? number_format($catalog->average_rating, 1) : 'N/A' }}
                            </span>
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                                </svg>
                                {{ $catalog->review_count }}
                            </span>
                        </div>

                        <!-- Price & Difficulty -->
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-2xl font-bold text-pink-600">Rp {{ number_format($catalog->price, 0, ',', '.') }}</span>
                            <span class="px-2 py-1 text-xs font-medium rounded capitalize
                                {{ $catalog->difficulty === 'easy' ? 'bg-green-100 text-green-700' : '' }}
                                {{ $catalog->difficulty === 'medium' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                {{ $catalog->difficulty === 'hard' ? 'bg-red-100 text-red-700' : '' }}">
                                {{ $catalog->difficulty }}
                            </span>
                        </div>

                        <!-- Actions -->
                        <div class="flex gap-2">
                            <a href="{{ route('nailist.catalogs.show', $catalog) }}" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-medium text-center transition-colors text-sm">
                                View Details
                            </a>
                            <a href="{{ route('nailist.catalogs.edit', $catalog) }}" class="flex items-center justify-center bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </a>
                            <form action="{{ route('nailist.catalogs.destroy', $catalog) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this catalog?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="flex items-center justify-center bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $catalogs->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-white rounded-xl shadow-md p-12 text-center">
            <div class="inline-block p-6 bg-pink-100 rounded-full mb-6">
                <svg class="w-16 h-16 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">No Catalogs Yet</h3>
            <p class="text-gray-600 mb-6">Start showcasing your amazing nail art designs!</p>
            <a href="{{ route('nailist.catalogs.create') }}" class="inline-block bg-gradient-to-r from-pink-500 to-rose-500 hover:from-pink-600 hover:to-rose-600 text-white px-8 py-3 rounded-lg font-semibold shadow-md hover:shadow-lg transition-all">
                Upload Your First Catalog
            </a>
        </div>
    @endif
</div>
@endsection
