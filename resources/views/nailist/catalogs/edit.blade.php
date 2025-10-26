@extends('nailist.layout')

@section('title', 'Edit Catalog')
@section('page-title', 'Edit Catalog')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-md p-8">
        <form action="{{ route('nailist.catalogs.update', $catalog) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Design Title *</label>
                <input type="text" id="title" name="title" value="{{ old('title', $catalog->title) }}" required
                       class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-pink-500 focus:ring-2 focus:ring-pink-200 outline-none">
                @error('title')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-6">
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Description *</label>
                <textarea id="description" name="description" rows="5" required
                          class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-pink-500 focus:ring-2 focus:ring-pink-200 outline-none">{{ old('description', $catalog->description) }}</textarea>
                @error('description')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="price" class="block text-sm font-semibold text-gray-700 mb-2">Price (Rp) *</label>
                    <input type="number" id="price" name="price" value="{{ old('price', $catalog->price) }}" required min="0" step="1000"
                           class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-pink-500 focus:ring-2 focus:ring-pink-200 outline-none">
                    @error('price')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="category" class="block text-sm font-semibold text-gray-700 mb-2">Category *</label>
                    <input type="text" id="category" name="category" value="{{ old('category', $catalog->category) }}" required
                           class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-pink-500 focus:ring-2 focus:ring-pink-200 outline-none">
                    @error('category')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="difficulty" class="block text-sm font-semibold text-gray-700 mb-2">Difficulty *</label>
                    <select id="difficulty" name="difficulty" required
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-pink-500 focus:ring-2 focus:ring-pink-200 outline-none">
                        <option value="easy" {{ $catalog->difficulty === 'easy' ? 'selected' : '' }}>Easy</option>
                        <option value="medium" {{ $catalog->difficulty === 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="hard" {{ $catalog->difficulty === 'hard' ? 'selected' : '' }}>Hard</option>
                    </select>
                    @error('difficulty')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="duration_minutes" class="block text-sm font-semibold text-gray-700 mb-2">Duration (minutes) *</label>
                    <input type="number" id="duration_minutes" name="duration_minutes" value="{{ old('duration_minutes', $catalog->duration_minutes) }}" required min="1"
                           class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-pink-500 focus:ring-2 focus:ring-pink-200 outline-none">
                    @error('duration_minutes')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <!-- Existing Images -->
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Current Images</label>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($catalog->images as $index => $image)
                        <div class="relative">
                            <img src="{{ asset('storage/' . $image) }}" alt="Image {{ $index + 1 }}" class="w-full aspect-square object-cover rounded-lg">
                            <label class="absolute top-2 right-2 bg-white rounded-lg p-2 shadow-lg cursor-pointer hover:bg-gray-100">
                                <input type="checkbox" name="keep_images[]" value="{{ $image }}" checked class="w-4 h-4">
                            </label>
                        </div>
                    @endforeach
                </div>
                <p class="text-sm text-gray-500 mt-2">Uncheck images you want to remove</p>
            </div>

            <!-- New Images -->
            <div class="mb-8">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Add New Images (optional)</label>
                <input type="file" name="new_images[]" multiple accept="image/*" class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg">
            </div>

            <div class="flex gap-4">
                <button type="submit" class="flex-1 bg-gradient-to-r from-pink-500 to-rose-500 hover:from-pink-600 hover:to-rose-600 text-white px-8 py-4 rounded-lg font-bold">
                    Update Catalog
                </button>
                <a href="{{ route('nailist.catalogs.index') }}" class="px-8 py-4 border-2 border-gray-300 text-gray-700 font-bold rounded-lg hover:bg-gray-50">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
