@extends('admin.layout')

@section('title', 'Size Standards')
@section('page-title', 'Size Standards Management')

@section('content')
    <!-- Header with Add Button -->
    <div class="flex items-center justify-between mb-6">
        <p class="text-gray-600">Manage nail size standards and tolerances</p>
        <a href="{{ route('admin.size-standards.create') }}" class="bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Add New Size
        </a>
    </div>

    <!-- Size Standards Table -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-pink-50 to-purple-50">
                    <tr>
                        <th class="text-left py-4 px-6 font-bold text-gray-700">Size Name</th>
                        <th class="text-center py-4 px-6 font-bold text-gray-700">Jempol</th>
                        <th class="text-center py-4 px-6 font-bold text-gray-700">Telunjuk</th>
                        <th class="text-center py-4 px-6 font-bold text-gray-700">Tengah</th>
                        <th class="text-center py-4 px-6 font-bold text-gray-700">Manis</th>
                        <th class="text-center py-4 px-6 font-bold text-gray-700">Kelingking</th>
                        <th class="text-center py-4 px-6 font-bold text-gray-700">Tolerance</th>
                        <th class="text-center py-4 px-6 font-bold text-gray-700">Status</th>
                        <th class="text-center py-4 px-6 font-bold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($standards as $standard)
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                            <td class="py-4 px-6">
                                <span class="inline-block bg-gradient-to-r from-pink-500 to-purple-600 text-white px-4 py-2 rounded-xl font-bold text-lg shadow-md">
                                    {{ $standard->size_name }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-center text-gray-700 font-semibold">{{ $standard->jempol }} mm</td>
                            <td class="py-4 px-6 text-center text-gray-700 font-semibold">{{ $standard->telunjuk }} mm</td>
                            <td class="py-4 px-6 text-center text-gray-700 font-semibold">{{ $standard->tengah }} mm</td>
                            <td class="py-4 px-6 text-center text-gray-700 font-semibold">{{ $standard->manis }} mm</td>
                            <td class="py-4 px-6 text-center text-gray-700 font-semibold">{{ $standard->kelingking }} mm</td>
                            <td class="py-4 px-6 text-center text-gray-600">± {{ $standard->tolerance }} mm</td>
                            <td class="py-4 px-6 text-center">
                                @if($standard->is_active)
                                    <span class="inline-block bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">
                                        Active
                                    </span>
                                @else
                                    <span class="inline-block bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-sm font-semibold">
                                        Inactive
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center justify-center gap-2">
                                    <!-- Edit Button -->
                                    <a href="{{ route('admin.size-standards.edit', $standard->id) }}" class="bg-blue-100 hover:bg-blue-200 text-blue-700 p-2 rounded-lg transition-colors" title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>

                                    <!-- Delete Button -->
                                    <form method="POST" action="{{ route('admin.size-standards.destroy', $standard->id) }}" onsubmit="return confirm('Are you sure you want to delete this size standard?');">
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
                            <td colspan="9" class="py-12 text-center text-gray-500">
                                <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                </svg>
                                <p class="text-lg font-semibold mb-2">No size standards found</p>
                                <p class="text-sm">Click "Add New Size" to create your first size standard</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Info Box -->
    <div class="mt-6 bg-blue-50 border-l-4 border-blue-500 p-6 rounded-lg">
        <div class="flex items-start gap-3">
            <svg class="w-6 h-6 text-blue-500 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div>
                <h4 class="font-bold text-blue-900 mb-2">About Size Standards</h4>
                <p class="text-blue-800 text-sm mb-2">Size standards define the measurement ranges for each nail size (XS, S, M, L, XL). The system uses these standards to classify user measurements.</p>
                <ul class="text-blue-800 text-sm space-y-1">
                    <li>• <strong>Tolerance:</strong> Acceptable deviation range (± mm) for matching measurements to a size</li>
                    <li>• <strong>Active Status:</strong> Only active sizes are used in the classification algorithm</li>
                    <li>• <strong>Custom Size:</strong> Measurements outside all standards are marked as "Custom Size"</li>
                </ul>
            </div>
        </div>
    </div>
@endsection
