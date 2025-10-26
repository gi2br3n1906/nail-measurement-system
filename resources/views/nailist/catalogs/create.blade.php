@extends('nailist.layout')

@section('title', 'Upload New Catalog')
@section('page-title', 'Upload New Catalog')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-md p-8">
        <!-- Header -->
        <div class="mb-8">
            <h3 class="text-2xl font-bold text-gray-800 mb-2">Add New Nail Art Design</h3>
            <p class="text-gray-600">Fill in the details and upload images of your beautiful design</p>
        </div>

        <form action="{{ route('nailist.catalogs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Title -->
            <div class="mb-6">
                <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Design Title *</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" required
                       class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-pink-500 focus:ring-2 focus:ring-pink-200 outline-none transition-all"
                       placeholder="e.g., Elegant French Manicure">
                @error('title')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-6">
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Description *</label>
                <textarea id="description" name="description" rows="5" required
                          class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-pink-500 focus:ring-2 focus:ring-pink-200 outline-none transition-all"
                          placeholder="Describe your design, materials used, special techniques, etc.">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Price & Category Row -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Price -->
                <div>
                    <label for="price" class="block text-sm font-semibold text-gray-700 mb-2">Price (Rp) *</label>
                    <input type="number" id="price" name="price" value="{{ old('price') }}" required min="0" step="1000"
                           class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-pink-500 focus:ring-2 focus:ring-pink-200 outline-none transition-all"
                           placeholder="50000">
                    @error('price')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category -->
                <div>
                    <label for="category" class="block text-sm font-semibold text-gray-700 mb-2">Category *</label>
                    <input type="text" id="category" name="category" value="{{ old('category') }}" required
                           class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-pink-500 focus:ring-2 focus:ring-pink-200 outline-none transition-all"
                           placeholder="e.g., french, ombre, glitter, 3d">
                    @error('category')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-500 mt-1">Examples: french, ombre, glitter, 3d, minimalist, floral</p>
                </div>
            </div>

            <!-- Difficulty & Duration Row -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Difficulty -->
                <div>
                    <label for="difficulty" class="block text-sm font-semibold text-gray-700 mb-2">Difficulty *</label>
                    <select id="difficulty" name="difficulty" required
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-pink-500 focus:ring-2 focus:ring-pink-200 outline-none transition-all">
                        <option value="">Select difficulty</option>
                        <option value="easy" {{ old('difficulty') === 'easy' ? 'selected' : '' }}>Easy</option>
                        <option value="medium" {{ old('difficulty') === 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="hard" {{ old('difficulty') === 'hard' ? 'selected' : '' }}>Hard</option>
                    </select>
                    @error('difficulty')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Duration -->
                <div>
                    <label for="duration_minutes" class="block text-sm font-semibold text-gray-700 mb-2">Duration (minutes) *</label>
                    <input type="number" id="duration_minutes" name="duration_minutes" value="{{ old('duration_minutes', 60) }}" required min="1"
                           class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-pink-500 focus:ring-2 focus:ring-pink-200 outline-none transition-all"
                           placeholder="60">
                    @error('duration_minutes')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Images Upload -->
            <div class="mb-8">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Upload Images * (Max 5 images)</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-pink-400 transition-colors">
                    <input type="file" id="images" name="images[]" multiple accept="image/*" required
                           class="hidden"
                           onchange="previewImages(event)">
                    <label for="images" class="cursor-pointer">
                        <div class="mb-4">
                            <svg class="w-12 h-12 text-gray-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                        </div>
                        <p class="text-gray-600 font-medium mb-1">Click to upload images</p>
                        <p class="text-gray-500 text-sm">PNG, JPG, WEBP up to 2MB each</p>
                    </label>
                </div>
                @error('images')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
                @error('images.*')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror

                <!-- Image Preview -->
                <div id="imagePreview" class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4 hidden"></div>
            </div>

            <!-- Buttons -->
            <div class="flex gap-4">
                <button type="submit" class="flex-1 bg-gradient-to-r from-pink-500 to-rose-500 hover:from-pink-600 hover:to-rose-600 text-white px-8 py-4 rounded-lg font-bold shadow-md hover:shadow-lg transition-all">
                    Upload Catalog
                </button>
                <a href="{{ route('nailist.catalogs.index') }}" class="px-8 py-4 border-2 border-gray-300 text-gray-700 font-bold rounded-lg hover:bg-gray-50 transition-colors">
                    Cancel
                </a>
            </div>
        </form>
    </div>

    <!-- Help Box -->
    <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-6">
        <h4 class="font-bold text-blue-900 mb-3 flex items-center gap-2">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
            </svg>
            Tips for Great Catalog
        </h4>
        <ul class="text-sm text-blue-800 space-y-2">
            <li>• Use high-quality, well-lit photos from multiple angles</li>
            <li>• Write detailed descriptions including materials and techniques</li>
            <li>• Set competitive pricing based on complexity and time required</li>
            <li>• Choose accurate difficulty level to set proper customer expectations</li>
            <li>• Use descriptive categories to help customers find your designs</li>
        </ul>
    </div>
</div>

<script>
function previewImages(event) {
    const preview = document.getElementById('imagePreview');
    const files = event.target.files;

    if (files.length > 0) {
        preview.innerHTML = '';
        preview.classList.remove('hidden');

        Array.from(files).slice(0, 5).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'relative aspect-square rounded-lg overflow-hidden border-2 border-gray-200';
                div.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover">`;
                preview.appendChild(div);
            }
            reader.readAsDataURL(file);
        });
    }
}
</script>
@endsection
