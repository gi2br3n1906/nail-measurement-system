@extends('nailist.layout')

@section('title', $catalog->title)
@section('page-title', 'Catalog Details')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">
    <!-- Back Button -->
    <a href="{{ route('nailist.catalogs.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-800 font-medium">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Back to My Catalogs
    </a>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Images -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                @if(count($catalog->images) > 0)
                    <div class="aspect-square">
                        <img src="{{ asset('storage/' . $catalog->images[0]) }}" alt="{{ $catalog->title }}" class="w-full h-full object-cover" id="mainImage">
                    </div>
                    @if(count($catalog->images) > 1)
                        <div class="p-4 grid grid-cols-4 gap-2">
                            @foreach($catalog->images as $image)
                                <img src="{{ asset('storage/' . $image) }}" alt="{{ $catalog->title }}"
                                     class="w-full aspect-square object-cover rounded-lg cursor-pointer hover:opacity-75 transition-opacity"
                                     onclick="document.getElementById('mainImage').src = this.src">
                            @endforeach
                        </div>
                    @endif
                @endif
            </div>

            <!-- Description -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Description</h3>
                <p class="text-gray-700 whitespace-pre-line">{{ $catalog->description }}</p>
            </div>

            <!-- Reviews -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Customer Reviews ({{ $catalog->review_count }})</h3>
                @if($catalog->reviews->count() > 0)
                    <div class="space-y-4">
                        @foreach($catalog->reviews as $review)
                            <div class="border-b border-gray-200 pb-4 last:border-0">
                                <div class="flex items-start gap-3">
                                    <div class="w-10 h-10 rounded-full bg-pink-100 flex items-center justify-center flex-shrink-0">
                                        <span class="font-bold text-pink-600">{{ substr($review->user->name, 0, 1) }}</span>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between mb-1">
                                            <span class="font-semibold text-gray-800">{{ $review->user->name }}</span>
                                            <span class="text-sm text-gray-500">{{ $review->created_at->diffForHumans() }}</span>
                                        </div>
                                        <div class="flex items-center gap-1 mb-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400 fill-current' : 'text-gray-300 fill-current' }}" viewBox="0 0 20 20">
                                                    <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                                </svg>
                                            @endfor
                                        </div>
                                        @if($review->comment)
                                            <p class="text-gray-700">{{ $review->comment }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-center py-8">No reviews yet</p>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Info Card -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">{{ $catalog->title }}</h2>

                <div class="space-y-3 mb-6">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Price</span>
                        <span class="text-2xl font-bold text-pink-600">Rp {{ number_format($catalog->price, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Category</span>
                        <span class="px-3 py-1 bg-pink-100 text-pink-700 rounded-full text-sm font-medium capitalize">{{ $catalog->category }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Difficulty</span>
                        <span class="px-3 py-1 rounded-full text-sm font-medium capitalize
                            {{ $catalog->difficulty === 'easy' ? 'bg-green-100 text-green-700' : '' }}
                            {{ $catalog->difficulty === 'medium' ? 'bg-yellow-100 text-yellow-700' : '' }}
                            {{ $catalog->difficulty === 'hard' ? 'bg-red-100 text-red-700' : '' }}">
                            {{ $catalog->difficulty }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Duration</span>
                        <span class="font-semibold text-gray-800">{{ $catalog->duration_minutes }} min</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Status</span>
                        <span class="px-3 py-1 rounded-full text-sm font-bold {{ $catalog->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $catalog->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </div>

                <div class="border-t border-gray-200 pt-4 mb-6">
                    <div class="grid grid-cols-3 gap-4 text-center">
                        <div>
                            <p class="text-2xl font-bold text-gray-800">{{ $catalog->view_count }}</p>
                            <p class="text-xs text-gray-600">Views</p>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-800">{{ $catalog->review_count }}</p>
                            <p class="text-xs text-gray-600">Reviews</p>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-800">{{ $catalog->average_rating > 0 ? number_format($catalog->average_rating, 1) : 'N/A' }}</p>
                            <p class="text-xs text-gray-600">Rating</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-2">
                    <a href="{{ route('nailist.catalogs.edit', $catalog) }}" class="block w-full bg-blue-500 hover:bg-blue-600 text-white text-center px-4 py-3 rounded-lg font-semibold transition-colors">
                        Edit Catalog
                    </a>
                    <form action="{{ route('nailist.catalogs.destroy', $catalog) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="block w-full bg-red-500 hover:bg-red-600 text-white text-center px-4 py-3 rounded-lg font-semibold transition-colors">
                            Delete Catalog
                        </button>
                    </form>
                </div>
            </div>

            <!-- Statistics -->
            <div class="bg-gradient-to-br from-pink-500 to-rose-500 rounded-xl shadow-md p-6 text-white">
                <h4 class="font-bold mb-4">Performance</h4>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span>Created</span>
                        <span class="font-semibold">{{ $catalog->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Last Updated</span>
                        <span class="font-semibold">{{ $catalog->updated_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
