@extends('admin.layout')

@section('title', 'Dashboard')
@section('page-title', 'Admin Dashboard')

@section('content')
    <!-- Nailist Management Statistics -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">📋 Nailist Management</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <!-- Pending Nailists -->
            <a href="{{ route('admin.nailists.index', ['status' => 'pending']) }}" class="bg-gradient-to-br from-yellow-400 to-orange-500 rounded-2xl shadow-lg p-6 text-white hover:shadow-xl transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-yellow-100 text-sm font-semibold mb-1">Pending Approval</p>
                        <p class="text-4xl font-bold">{{ $pendingNailists }}</p>
                    </div>
                    <div class="bg-white bg-opacity-20 p-3 rounded-xl">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </a>

            <!-- Approved Nailists -->
            <a href="{{ route('admin.nailists.index', ['status' => 'approved']) }}" class="bg-gradient-to-br from-green-400 to-emerald-500 rounded-2xl shadow-lg p-6 text-white hover:shadow-xl transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm font-semibold mb-1">Approved</p>
                        <p class="text-4xl font-bold">{{ $approvedNailists }}</p>
                    </div>
                    <div class="bg-white bg-opacity-20 p-3 rounded-xl">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </a>

            <!-- Rejected Nailists -->
            <a href="{{ route('admin.nailists.index', ['status' => 'rejected']) }}" class="bg-gradient-to-br from-red-400 to-pink-500 rounded-2xl shadow-lg p-6 text-white hover:shadow-xl transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-red-100 text-sm font-semibold mb-1">Rejected</p>
                        <p class="text-4xl font-bold">{{ $rejectedNailists }}</p>
                    </div>
                    <div class="bg-white bg-opacity-20 p-3 rounded-xl">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </a>

            <!-- Total Nailists -->
            <div class="bg-gradient-to-br from-blue-400 to-indigo-500 rounded-2xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm font-semibold mb-1">Total Nailists</p>
                        <p class="text-4xl font-bold">{{ $totalNailists }}</p>
                    </div>
                    <div class="bg-white bg-opacity-20 p-3 rounded-xl">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Catalog & Community Statistics -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">🎨 Catalog & Community</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <!-- Total Catalogs -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-pink-100 p-3 rounded-xl">
                        <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div class="text-right">
                        <p class="text-3xl font-bold text-gray-800">{{ $totalCatalogs }}</p>
                        <p class="text-sm text-gray-500">Total Catalogs</p>
                    </div>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-green-600 font-semibold">✓ Active: {{ $activeCatalogs }}</span>
                    <span class="text-gray-400">Inactive: {{ $inactiveCatalogs }}</span>
                </div>
            </div>

            <!-- Total Reviews -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-yellow-100 p-3 rounded-xl">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                    </div>
                    <div class="text-right">
                        <p class="text-3xl font-bold text-gray-800">{{ $totalReviews }}</p>
                        <p class="text-sm text-gray-500">Total Reviews</p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-yellow-500">★★★★★</span>
                    <span class="text-sm font-semibold text-gray-700">{{ $averageRating }} avg</span>
                </div>
            </div>

            <!-- Total Views -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-purple-100 p-3 rounded-xl">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </div>
                    <div class="text-right">
                        <p class="text-3xl font-bold text-gray-800">{{ number_format($totalViews) }}</p>
                        <p class="text-sm text-gray-500">Total Views</p>
                    </div>
                </div>
                <div class="text-sm text-gray-600">
                    📅 This month: <span class="font-semibold">{{ number_format($viewsThisMonth) }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Original Statistics Cards -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">📏 Measurement System</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Total Measurements -->
        <div class="bg-gradient-to-br from-pink-500 to-rose-500 rounded-2xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-pink-100 text-sm font-semibold mb-1">Total Measurements</p>
                    <p class="text-4xl font-bold">{{ $totalMeasurements }}</p>
                </div>
                <div class="bg-white bg-opacity-20 p-4 rounded-xl">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Products -->
        <div class="bg-gradient-to-br from-purple-500 to-indigo-500 rounded-2xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm font-semibold mb-1">Total Products</p>
                    <p class="text-4xl font-bold">{{ $totalProducts }}</p>
                </div>
                <div class="bg-white bg-opacity-20 p-4 rounded-xl">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Active Size Standards -->
        <div class="bg-gradient-to-br from-cyan-500 to-blue-500 rounded-2xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-cyan-100 text-sm font-semibold mb-1">Size Standards</p>
                    <p class="text-4xl font-bold">{{ $totalSizeStandards }}</p>
                </div>
                <div class="bg-white bg-opacity-20 p-4 rounded-xl">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Size Distribution -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Size Distribution</h3>
            <div class="space-y-3">
                @foreach($sizeDistribution as $size)
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm font-semibold text-gray-700">{{ $size->classified_size_right }}</span>
                            <span class="text-sm text-gray-600">{{ $size->count }} measurements</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div class="bg-gradient-to-r from-pink-500 to-purple-500 h-3 rounded-full" style="width: {{ ($size->count / $totalMeasurements) * 100 }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Monthly Measurements -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Monthly Measurements</h3>
            <div class="space-y-3">
                @foreach($monthlyMeasurements as $monthly)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                        <div class="flex items-center gap-3">
                            <div class="bg-pink-100 p-2 rounded-lg">
                                <svg class="w-5 h-5 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <span class="font-semibold text-gray-700">{{ $monthly->month }}</span>
                        </div>
                        <span class="text-lg font-bold text-pink-600">{{ $monthly->count }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Recent Nailists & Popular Catalogs -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Recent Nailist Registrations -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-gray-800">👤 Recent Nailist Registrations</h3>
                <a href="{{ route('admin.nailists.index') }}" class="text-pink-600 hover:text-pink-700 font-semibold text-sm">View All →</a>
            </div>
            <div class="space-y-3">
                @forelse($recentNailists as $nailist)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="avatar-circle">
                                {{ substr($nailist->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800">{{ $nailist->name }}</p>
                                <p class="text-xs text-gray-500">{{ $nailist->salon_name ?? 'No salon name' }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            @if($nailist->is_nailist_approved === null)
                                <span class="badge-warning text-xs">Pending</span>
                            @elseif($nailist->is_nailist_approved)
                                <span class="badge-success text-xs">Approved</span>
                            @else
                                <span class="badge-danger text-xs">Rejected</span>
                            @endif
                            <p class="text-xs text-gray-400 mt-1">{{ $nailist->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 text-center py-4">No nailists registered yet</p>
                @endforelse
            </div>
        </div>

        <!-- Popular Catalogs -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-gray-800">🔥 Popular Catalogs</h3>
            </div>
            <div class="space-y-3">
                @forelse($popularCatalogs as $catalog)
                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                        @if($catalog->images && count($catalog->images) > 0)
                            <img src="{{ $catalog->images[0] }}" class="w-16 h-16 object-cover rounded-lg" alt="{{ $catalog->title }}">
                        @else
                            <div class="w-16 h-16 bg-gray-300 rounded-lg flex items-center justify-center">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                        <div class="flex-1">
                            <p class="font-semibold text-gray-800">{{ Str::limit($catalog->title, 30) }}</p>
                            <p class="text-xs text-gray-500">by {{ $catalog->nailist->name }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-semibold text-purple-600">{{ number_format($catalog->view_count) }} views</p>
                            <p class="text-xs text-gray-500">⭐ {{ number_format($catalog->average_rating, 1) }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 text-center py-4">No catalogs yet</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Category Distribution -->
    @if($categoryStats->count() > 0)
    <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
        <h3 class="text-xl font-bold text-gray-800 mb-4">📊 Catalog Category Distribution</h3>
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
            @foreach($categoryStats as $cat)
                <div class="text-center p-4 bg-gradient-to-br from-pink-50 to-purple-50 rounded-xl">
                    <p class="text-2xl font-bold text-pink-600">{{ $cat->total }}</p>
                    <p class="text-sm text-gray-600 capitalize mt-1">{{ $cat->category }}</p>
                </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Recent Measurements -->
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-gray-800">📏 Recent Measurements</h3>
            <a href="{{ route('admin.measurements.index') }}" class="text-pink-600 hover:text-pink-700 font-semibold text-sm">View All →</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b-2 border-gray-200">
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">ID</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Right Hand</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Left Hand</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Date</th>
                        <th class="text-center py-3 px-4 font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentMeasurements as $measurement)
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                            <td class="py-3 px-4 text-gray-600">#{{ $measurement->id }}</td>
                            <td class="py-3 px-4">
                                <span class="inline-block bg-pink-100 text-pink-700 px-3 py-1 rounded-full text-sm font-semibold">
                                    {{ $measurement->classified_size_right }}
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                @if($measurement->classified_size_left)
                                    <span class="inline-block bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-sm font-semibold">
                                        {{ $measurement->classified_size_left }}
                                    </span>
                                @else
                                    <span class="text-gray-400 text-sm">-</span>
                                @endif
                            </td>
                            <td class="py-3 px-4 text-gray-600 text-sm">{{ $measurement->created_at->format('d M Y, H:i') }}</td>
                            <td class="py-3 px-4 text-center">
                                <a href="{{ route('admin.measurements.show', $measurement->id) }}" class="text-blue-600 hover:text-blue-700 font-semibold text-sm">
                                    View Details
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
