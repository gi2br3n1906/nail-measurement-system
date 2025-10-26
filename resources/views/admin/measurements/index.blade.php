@extends('admin.layout')

@section('title', 'All Measurements')
@section('page-title', 'Measurements Management')

@section('content')
    <!-- Search & Filter -->
    <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
        <form method="GET" action="{{ route('admin.measurements.index') }}" class="flex flex-col md:flex-row gap-4">
            <!-- Search Input -->
            <div class="flex-1">
                <div class="relative">
                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Search by ID or size..."
                           class="w-full pl-12 pr-4 py-3 border-2 border-gray-300 rounded-xl focus:border-pink-500 focus:ring-2 focus:ring-pink-200 outline-none transition-all">
                    <svg class="w-5 h-5 text-gray-400 absolute left-4 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>

            <!-- Size Filter -->
            <div class="w-full md:w-48">
                <select name="size" class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-pink-500 focus:ring-2 focus:ring-pink-200 outline-none transition-all">
                    <option value="">All Sizes</option>
                    <option value="XS" {{ request('size') == 'XS' ? 'selected' : '' }}>XS</option>
                    <option value="S" {{ request('size') == 'S' ? 'selected' : '' }}>S</option>
                    <option value="M" {{ request('size') == 'M' ? 'selected' : '' }}>M</option>
                    <option value="XL" {{ request('size') == 'XL' ? 'selected' : '' }}>XL</option>
                    <option value="Custom Size" {{ request('size') == 'Custom Size' ? 'selected' : '' }}>Custom Size</option>
                </select>
            </div>

            <!-- Search Button -->
            <button type="submit" class="bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white px-8 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all">
                <svg class="inline-block w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                </svg>
                Filter
            </button>

            @if(request('search') || request('size'))
                <a href="{{ route('admin.measurements.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-3 rounded-xl font-semibold transition-colors">
                    Clear
                </a>
            @endif
        </form>
    </div>

    <!-- Measurements Table -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-pink-50 to-purple-50">
                    <tr>
                        <th class="text-left py-4 px-6 font-bold text-gray-700">ID</th>
                        <th class="text-center py-4 px-6 font-bold text-gray-700">Right Hand Size</th>
                        <th class="text-center py-4 px-6 font-bold text-gray-700">Left Hand Size</th>
                        <th class="text-center py-4 px-6 font-bold text-gray-700">Date</th>
                        <th class="text-center py-4 px-6 font-bold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($measurements as $measurement)
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                            <td class="py-4 px-6 text-gray-700 font-semibold">#{{ $measurement->id }}</td>
                            <td class="py-4 px-6 text-center">
                                <span class="inline-block bg-pink-100 text-pink-700 px-4 py-2 rounded-xl text-sm font-bold">
                                    {{ $measurement->classified_size_right }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                @if($measurement->classified_size_left)
                                    <span class="inline-block bg-purple-100 text-purple-700 px-4 py-2 rounded-xl text-sm font-bold">
                                        {{ $measurement->classified_size_left }}
                                    </span>
                                @else
                                    <span class="text-gray-400 text-sm">-</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-center text-gray-600 text-sm">
                                <div>{{ $measurement->created_at->format('d M Y') }}</div>
                                <div class="text-xs text-gray-400">{{ $measurement->created_at->format('H:i') }}</div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center justify-center gap-2">
                                    <!-- View Button -->
                                    <a href="{{ route('admin.measurements.show', $measurement->id) }}" class="bg-blue-100 hover:bg-blue-200 text-blue-700 px-4 py-2 rounded-lg transition-colors font-semibold text-sm">
                                        View Details
                                    </a>

                                    <!-- Delete Button -->
                                    <form method="POST" action="{{ route('admin.measurements.destroy', $measurement->id) }}" onsubmit="return confirm('Are you sure you want to delete this measurement?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-100 hover:bg-red-200 text-red-700 p-2 rounded-lg transition-colors" title="Delete">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-gray-500">
                                <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p class="text-lg font-semibold mb-2">No measurements found</p>
                                <p class="text-sm">Try adjusting your search or filters</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($measurements->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $measurements->links() }}
            </div>
        @endif
    </div>

    <!-- Statistics -->
    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-gradient-to-br from-pink-50 to-rose-50 rounded-xl p-6 border-2 border-pink-200">
            <h4 class="text-sm font-semibold text-gray-600 mb-2">Total Measurements</h4>
            <p class="text-3xl font-bold text-pink-600">{{ $measurements->total() }}</p>
        </div>
        <div class="bg-gradient-to-br from-purple-50 to-indigo-50 rounded-xl p-6 border-2 border-purple-200">
            <h4 class="text-sm font-semibold text-gray-600 mb-2">Current Page</h4>
            <p class="text-3xl font-bold text-purple-600">{{ $measurements->currentPage() }} / {{ $measurements->lastPage() }}</p>
        </div>
        <div class="bg-gradient-to-br from-cyan-50 to-blue-50 rounded-xl p-6 border-2 border-cyan-200">
            <h4 class="text-sm font-semibold text-gray-600 mb-2">Per Page</h4>
            <p class="text-3xl font-bold text-cyan-600">{{ $measurements->perPage() }}</p>
        </div>
    </div>
@endsection
