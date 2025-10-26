@extends('admin.layout')

@section('title', 'Measurement Detail')
@section('page-title', 'Measurement #' . $measurement->id)

@section('content')
    <!-- Back Button -->
    <a href="{{ route('admin.measurements.index') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-800 mb-6 font-semibold">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
        Back to All Measurements
    </a>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Right Hand -->
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <div class="flex items-center gap-3 mb-6">
                    <svg class="w-8 h-8 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11.5V14m0-2.5v-6a1.5 1.5 0 113 0m-3 6a1.5 1.5 0 00-3 0v2a7.5 7.5 0 0015 0v-5a1.5 1.5 0 00-3 0m-6-3V11m0-5.5v-1a1.5 1.5 0 013 0v1m0 0V11m0-5.5a1.5 1.5 0 013 0v3m0 0V11"></path>
                    </svg>
                    <h2 class="text-2xl font-bold text-gray-800">Right Hand</h2>
                </div>

                <!-- Size Badge -->
                <div class="bg-gradient-to-br from-pink-500 to-rose-500 text-white px-8 py-6 rounded-2xl shadow-lg mb-6 text-center">
                    <p class="text-sm font-semibold uppercase tracking-wider mb-2">Classified Size</p>
                    <p class="text-5xl font-bold">{{ $measurement->classified_size_right }}</p>
                </div>

                <!-- Measurements -->
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                    @php
                        $rightHand = json_decode($measurement->right_hand_data, true);
                    @endphp
                    @foreach(['jempol', 'telunjuk', 'tengah', 'manis', 'kelingking'] as $finger)
                        <div class="bg-pink-50 rounded-xl p-4 text-center border-2 border-pink-100">
                            <p class="text-sm text-gray-600 mb-2 capitalize">{{ ucfirst($finger) }}</p>
                            <p class="text-2xl font-bold text-pink-600">{{ $rightHand[$finger] ?? '-' }}</p>
                            <p class="text-xs text-gray-400">mm</p>
                        </div>
                    @endforeach
                    <div class="bg-pink-100 rounded-xl p-4 text-center border-2 border-pink-200">
                        <p class="text-sm text-gray-600 mb-2">Average</p>
                        <p class="text-2xl font-bold text-pink-700">{{ number_format($measurement->right_hand_average, 2) }}</p>
                        <p class="text-xs text-gray-400">mm</p>
                    </div>
                </div>
            </div>

            <!-- Left Hand (if exists) -->
            @if($measurement->left_hand_data)
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11.5V14m0-2.5v-6a1.5 1.5 0 113 0m-3 6a1.5 1.5 0 00-3 0v2a7.5 7.5 0 0015 0v-5a1.5 1.5 0 00-3 0m-6-3V11m0-5.5v-1a1.5 1.5 0 013 0v1m0 0V11m0-5.5a1.5 1.5 0 013 0v3m0 0V11"></path>
                        </svg>
                        <h2 class="text-2xl font-bold text-gray-800">Left Hand</h2>
                    </div>

                    <!-- Size Badge -->
                    <div class="bg-gradient-to-br from-purple-500 to-indigo-500 text-white px-8 py-6 rounded-2xl shadow-lg mb-6 text-center">
                        <p class="text-sm font-semibold uppercase tracking-wider mb-2">Classified Size</p>
                        <p class="text-5xl font-bold">{{ $measurement->classified_size_left }}</p>
                    </div>

                    <!-- Measurements -->
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                        @php
                            $leftHand = json_decode($measurement->left_hand_data, true);
                        @endphp
                        @foreach(['jempol', 'telunjuk', 'tengah', 'manis', 'kelingking'] as $finger)
                            <div class="bg-purple-50 rounded-xl p-4 text-center border-2 border-purple-100">
                                <p class="text-sm text-gray-600 mb-2 capitalize">{{ ucfirst($finger) }}</p>
                                <p class="text-2xl font-bold text-purple-600">{{ $leftHand[$finger] ?? '-' }}</p>
                                <p class="text-xs text-gray-400">mm</p>
                            </div>
                        @endforeach
                        <div class="bg-purple-100 rounded-xl p-4 text-center border-2 border-purple-200">
                            <p class="text-sm text-gray-600 mb-2">Average</p>
                            <p class="text-2xl font-bold text-purple-700">{{ number_format($measurement->left_hand_average, 2) }}</p>
                            <p class="text-xs text-gray-400">mm</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Measurement Info -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Measurement Info</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between py-2 border-b border-gray-100">
                        <span class="text-sm text-gray-600">ID</span>
                        <span class="text-sm font-bold text-gray-800">#{{ $measurement->id }}</span>
                    </div>
                    <div class="flex items-center justify-between py-2 border-b border-gray-100">
                        <span class="text-sm text-gray-600">Created</span>
                        <span class="text-sm font-semibold text-gray-800">{{ $measurement->created_at->format('d M Y, H:i') }}</span>
                    </div>
                    <div class="flex items-center justify-between py-2 border-b border-gray-100">
                        <span class="text-sm text-gray-600">Updated</span>
                        <span class="text-sm font-semibold text-gray-800">{{ $measurement->updated_at->format('d M Y, H:i') }}</span>
                    </div>
                    <div class="flex items-center justify-between py-2">
                        <span class="text-sm text-gray-600">Hands Measured</span>
                        <span class="text-sm font-semibold text-gray-800">{{ $measurement->left_hand_data ? 'Both' : 'Right Only' }}</span>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Quick Actions</h3>
                <div class="space-y-3">
                    <!-- View on Frontend -->
                    <a href="{{ route('measurements.show', $measurement->id) }}" target="_blank" class="flex items-center justify-center gap-2 bg-blue-100 hover:bg-blue-200 text-blue-700 px-4 py-3 rounded-xl font-semibold transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                        View on Frontend
                    </a>

                    <!-- Print -->
                    <a href="{{ route('measurements.print', $measurement->id) }}" target="_blank" class="flex items-center justify-center gap-2 bg-green-100 hover:bg-green-200 text-green-700 px-4 py-3 rounded-xl font-semibold transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                        </svg>
                        Print
                    </a>

                    <!-- Delete -->
                    <form method="POST" action="{{ route('admin.measurements.destroy', $measurement->id) }}" onsubmit="return confirm('Are you sure you want to delete this measurement? This action cannot be undone.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full flex items-center justify-center gap-2 bg-red-100 hover:bg-red-200 text-red-700 px-4 py-3 rounded-xl font-semibold transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Delete Measurement
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
