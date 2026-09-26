@extends('admin.layout')

@section('title', 'Product Management')
@section('page-title', 'Product Management')

@section('content')
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between mb-6">
        <p class="text-gray-600">Manage press-on sets, categories, variants, and storefront visibility.</p>
        <a href="{{ route('admin.products.create') }}" class="bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 inline-flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Add New Product
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-pink-50 to-purple-50">
                    <tr>
                        <th class="text-left py-4 px-6 font-bold text-gray-700">Product</th>
                        <th class="text-left py-4 px-6 font-bold text-gray-700">Category</th>
                        <th class="text-left py-4 px-6 font-bold text-gray-700">Sizes</th>
                        <th class="text-left py-4 px-6 font-bold text-gray-700">Lengths</th>
                        <th class="text-right py-4 px-6 font-bold text-gray-700">Price</th>
                        <th class="text-center py-4 px-6 font-bold text-gray-700">Stock</th>
                        <th class="text-center py-4 px-6 font-bold text-gray-700">Status</th>
                        <th class="text-center py-4 px-6 font-bold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-pink-100 to-purple-100 overflow-hidden flex items-center justify-center flex-shrink-0">
                                        @if($product->image_url)
                                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                        @else
                                            <svg class="w-6 h-6 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-800">{{ $product->name }}</p>
                                        <p class="text-sm text-gray-500 line-clamp-1 max-w-xs">{{ $product->description }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="inline-block bg-pink-100 text-pink-700 px-3 py-1 rounded-full text-sm font-semibold">{{ $product->category }}</span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex flex-wrap gap-1">
                                    @foreach($product->availableSizes() as $size)
                                        <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded-lg text-xs font-semibold">{{ $size }}</span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex flex-wrap gap-1">
                                    @foreach($product->availableLengths() as $length)
                                        <span class="bg-purple-100 text-purple-700 px-2 py-1 rounded-lg text-xs font-semibold">{{ $length }}</span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="py-4 px-6 text-right font-bold text-gray-800">{{ $product->formatted_price }}</td>
                            <td class="py-4 px-6 text-center font-semibold {{ $product->stock > 0 ? 'text-gray-700' : 'text-red-600' }}">{{ $product->stock }}</td>
                            <td class="py-4 px-6 text-center">
                                @if($product->is_active)
                                    <span class="inline-block bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">Active</span>
                                @else
                                    <span class="inline-block bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-sm font-semibold">Hidden</span>
                                @endif
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="bg-blue-100 hover:bg-blue-200 text-blue-700 p-2 rounded-lg transition-colors" title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}" onsubmit="return confirm('Delete {{ addslashes($product->name) }}? This cannot be undone.');">
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
                            <td colspan="8" class="py-12 text-center text-gray-500">
                                <p class="text-lg font-semibold mb-2">No products found</p>
                                <p class="text-sm">Click "Add New Product" to create your first product</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $products->links() }}
        </div>
    </div>
@endsection
