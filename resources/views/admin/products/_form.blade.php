@extends('admin.layout')

@section('title', $product->exists ? 'Edit Product' : 'Add Product')
@section('page-title', $product->exists ? 'Edit Product: ' . $product->name : 'Add New Product')

@section('content')
    <div class="max-w-5xl">
        <a href="{{ route('admin.products.index') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-800 mb-6 font-semibold">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Products
        </a>

        <div class="bg-white rounded-2xl shadow-lg p-8">
            <form method="POST" action="{{ $product->exists ? route('admin.products.update', $product) : route('admin.products.store') }}">
                @csrf
                @if($product->exists)
                    @method('PUT')
                @endif

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-bold text-gray-700 mb-2">Product Name <span class="text-red-500">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-pink-500 focus:ring-2 focus:ring-pink-200 outline-none transition-all @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="category" class="block text-sm font-bold text-gray-700 mb-2">Category <span class="text-red-500">*</span></label>
                        <select id="category" name="category" required class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-pink-500 focus:ring-2 focus:ring-pink-200 outline-none transition-all @error('category') border-red-500 @enderror">
                            <option value="">Select category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category }}" {{ old('category', $product->category) === $category ? 'selected' : '' }}>{{ $category }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6">
                    <label for="description" class="block text-sm font-bold text-gray-700 mb-2">Description <span class="text-red-500">*</span></label>
                    <textarea id="description" name="description" rows="4" required class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-pink-500 focus:ring-2 focus:ring-pink-200 outline-none transition-all @error('description') border-red-500 @enderror">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <div>
                        <label for="price" class="block text-sm font-bold text-gray-700 mb-2">Price <span class="text-red-500">*</span></label>
                        <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}" min="0" step="0.01" required class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-pink-500 focus:ring-2 focus:ring-pink-200 outline-none transition-all @error('price') border-red-500 @enderror">
                        @error('price')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="stock" class="block text-sm font-bold text-gray-700 mb-2">Stock <span class="text-red-500">*</span></label>
                        <input type="number" id="stock" name="stock" value="{{ old('stock', $product->stock ?? 0) }}" min="0" required class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-pink-500 focus:ring-2 focus:ring-pink-200 outline-none transition-all @error('stock') border-red-500 @enderror">
                        @error('stock')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <div>
                        <h3 class="text-sm font-bold text-gray-700 mb-3">Available Sizes <span class="text-red-500">*</span></h3>
                        <div class="grid grid-cols-2 gap-3">
                            @php($selectedSizes = old('available_sizes', $product->exists ? $product->availableSizes() : ['S']))
                            @foreach($sizes as $size)
                                <label class="flex items-center gap-3 border-2 border-gray-200 rounded-xl px-4 py-3 cursor-pointer hover:border-pink-300 transition">
                                    <input type="checkbox" name="available_sizes[]" value="{{ $size }}" class="w-4 h-4 text-pink-600 rounded focus:ring-pink-500" {{ in_array($size, $selectedSizes) ? 'checked' : '' }}>
                                    <span class="font-semibold text-gray-700">{{ $size }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('available_sizes')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-gray-700 mb-3">Available Lengths <span class="text-red-500">*</span></h3>
                        <div class="grid grid-cols-1 gap-3">
                            @php($selectedLengths = old('available_lengths', $product->exists ? $product->availableLengths() : ['Short', 'Medium', 'Long']))
                            @foreach($lengths as $length)
                                <label class="flex items-center gap-3 border-2 border-gray-200 rounded-xl px-4 py-3 cursor-pointer hover:border-pink-300 transition">
                                    <input type="checkbox" name="available_lengths[]" value="{{ $length }}" class="w-4 h-4 text-pink-600 rounded focus:ring-pink-500" {{ in_array($length, $selectedLengths) ? 'checked' : '' }}>
                                    <span class="font-semibold text-gray-700">{{ $length }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('available_lengths')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6">
                    <label for="image_url" class="block text-sm font-bold text-gray-700 mb-2">Image URL</label>
                    <input type="text" id="image_url" name="image_url" value="{{ old('image_url', $product->image_url) }}" class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-pink-500 focus:ring-2 focus:ring-pink-200 outline-none transition-all @error('image_url') border-red-500 @enderror">
                    @error('image_url')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6">
                    <label class="flex items-center gap-3 border-2 border-gray-200 rounded-xl px-4 py-3 cursor-pointer hover:border-pink-300 transition w-fit">
                        <input type="checkbox" name="is_active" value="1" class="w-4 h-4 text-pink-600 rounded focus:ring-pink-500" {{ old('is_active', $product->exists ? $product->is_active : true) ? 'checked' : '' }}>
                        <span class="font-semibold text-gray-700">Show on storefront</span>
                    </label>
                </div>

                <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-100">
                    <a href="{{ route('admin.products.index') }}" class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-xl font-semibold transition-all duration-300">Cancel</a>
                    <button type="submit" class="bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white px-8 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300">
                        {{ $product->exists ? 'Update Product' : 'Create Product' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
