@extends('admin.layout')

@section('title', 'Edit Size Standard')
@section('page-title', 'Edit Size Standard: ' . $sizeStandard->size_name)

@section('content')
    <div class="max-w-4xl">
        <!-- Back Button -->
        <a href="{{ route('admin.size-standards.index') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-800 mb-6 font-semibold">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Size Standards
        </a>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <form method="POST" action="{{ route('admin.size-standards.update', $sizeStandard->id) }}">
                @csrf
                @method('PUT')

                <!-- Size Name -->
                <div class="mb-6">
                    <label for="size_name" class="block text-sm font-bold text-gray-700 mb-2">
                        Size Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           id="size_name"
                           name="size_name"
                           value="{{ old('size_name', $sizeStandard->size_name) }}"
                           required
                           placeholder="e.g., XS, S, M, L, XL, XXL"
                           class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-pink-500 focus:ring-2 focus:ring-pink-200 outline-none transition-all @error('size_name') border-red-500 @enderror">
                    @error('size_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Measurements Grid -->
                <div class="mb-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Finger Measurements (in mm)</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <!-- Jempol -->
                        <div>
                            <label for="jempol" class="block text-sm font-semibold text-gray-700 mb-2">
                                Jempol (Thumb) <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="number"
                                       id="jempol"
                                       name="jempol"
                                       value="{{ old('jempol', $sizeStandard->jempol) }}"
                                       step="0.01"
                                       min="0"
                                       required
                                       class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-pink-500 focus:ring-2 focus:ring-pink-200 outline-none transition-all @error('jempol') border-red-500 @enderror">
                                <span class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-500 text-sm">mm</span>
                            </div>
                            @error('jempol')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Telunjuk -->
                        <div>
                            <label for="telunjuk" class="block text-sm font-semibold text-gray-700 mb-2">
                                Telunjuk (Index) <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="number"
                                       id="telunjuk"
                                       name="telunjuk"
                                       value="{{ old('telunjuk', $sizeStandard->telunjuk) }}"
                                       step="0.01"
                                       min="0"
                                       required
                                       class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-pink-500 focus:ring-2 focus:ring-pink-200 outline-none transition-all @error('telunjuk') border-red-500 @enderror">
                                <span class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-500 text-sm">mm</span>
                            </div>
                            @error('telunjuk')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tengah -->
                        <div>
                            <label for="tengah" class="block text-sm font-semibold text-gray-700 mb-2">
                                Tengah (Middle) <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="number"
                                       id="tengah"
                                       name="tengah"
                                       value="{{ old('tengah', $sizeStandard->tengah) }}"
                                       step="0.01"
                                       min="0"
                                       required
                                       class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-pink-500 focus:ring-2 focus:ring-pink-200 outline-none transition-all @error('tengah') border-red-500 @enderror">
                                <span class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-500 text-sm">mm</span>
                            </div>
                            @error('tengah')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Manis -->
                        <div>
                            <label for="manis" class="block text-sm font-semibold text-gray-700 mb-2">
                                Manis (Ring) <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="number"
                                       id="manis"
                                       name="manis"
                                       value="{{ old('manis', $sizeStandard->manis) }}"
                                       step="0.01"
                                       min="0"
                                       required
                                       class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-pink-500 focus:ring-2 focus:ring-pink-200 outline-none transition-all @error('manis') border-red-500 @enderror">
                                <span class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-500 text-sm">mm</span>
                            </div>
                            @error('manis')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kelingking -->
                        <div>
                            <label for="kelingking" class="block text-sm font-semibold text-gray-700 mb-2">
                                Kelingking (Pinky) <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="number"
                                       id="kelingking"
                                       name="kelingking"
                                       value="{{ old('kelingking', $sizeStandard->kelingking) }}"
                                       step="0.01"
                                       min="0"
                                       required
                                       class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-pink-500 focus:ring-2 focus:ring-pink-200 outline-none transition-all @error('kelingking') border-red-500 @enderror">
                                <span class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-500 text-sm">mm</span>
                            </div>
                            @error('kelingking')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tolerance -->
                        <div>
                            <label for="tolerance" class="block text-sm font-semibold text-gray-700 mb-2">
                                Tolerance <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="number"
                                       id="tolerance"
                                       name="tolerance"
                                       value="{{ old('tolerance', $sizeStandard->tolerance) }}"
                                       step="0.1"
                                       min="0"
                                       required
                                       class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-pink-500 focus:ring-2 focus:ring-pink-200 outline-none transition-all @error('tolerance') border-red-500 @enderror">
                                <span class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-500 text-sm">± mm</span>
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Acceptable deviation range</p>
                            @error('tolerance')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Status -->
                <div class="mb-8">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox"
                               id="is_active"
                               name="is_active"
                               value="1"
                               {{ old('is_active', $sizeStandard->is_active) ? 'checked' : '' }}
                               class="w-5 h-5 text-pink-500 border-gray-300 rounded focus:ring-pink-500">
                        <span class="text-sm font-semibold text-gray-700">
                            Set as Active
                            <span class="block text-xs text-gray-500 font-normal">This size standard will be used in classification</span>
                        </span>
                    </label>
                </div>

                <!-- Buttons -->
                <div class="flex items-center gap-4">
                    <button type="submit" class="bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white px-8 py-3 rounded-xl font-bold shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                        <svg class="inline-block w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Update Size Standard
                    </button>
                    <a href="{{ route('admin.size-standards.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-8 py-3 rounded-xl font-bold transition-colors">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
