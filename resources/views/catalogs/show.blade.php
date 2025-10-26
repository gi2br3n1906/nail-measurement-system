@extends('layouts.app')

@section('title', $catalog->title . ' - NailPerfect')

@section('content')
@include('components.navbar')

<!-- Catalog Detail -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <!-- Breadcrumb -->
        <nav class="mb-8">
            <ol class="flex items-center gap-2 text-sm text-gray-600">
                <li><a href="{{ route('home') }}" class="hover:text-pink-600">Home</a></li>
                <li>/</li>
                <li><a href="{{ route('catalogs.index') }}" class="hover:text-pink-600">Inspirasi</a></li>
                <li>/</li>
                <li class="text-gray-900 font-semibold">{{ $catalog->title }}</li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Image Gallery -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-8">
                    @if($catalog->images && count($catalog->images) > 0)
                        <!-- Main Image -->
                        <div id="mainImage" class="relative h-96 lg:h-[500px] bg-gradient-to-br from-pink-200 to-purple-200 overflow-hidden">
                            @php
                                $firstImage = $catalog->images[0] ?? null;
                                $firstImageUrl = $firstImage && filter_var($firstImage, FILTER_VALIDATE_URL)
                                    ? $firstImage
                                    : ($firstImage ? asset('storage/' . $firstImage) : null);
                            @endphp
                            <img src="{{ $firstImageUrl }}"
                                 alt="{{ $catalog->title }}"
                                 class="w-full h-full object-cover">
                        </div>

                        <!-- Thumbnail Gallery (if multiple images) -->
                        @if(count($catalog->images) > 1)
                        <div class="p-4 bg-gray-50 flex gap-3 overflow-x-auto">
                            @foreach($catalog->images as $index => $image)
                                @php
                                    $thumbUrl = $image && filter_var($image, FILTER_VALIDATE_URL)
                                        ? $image
                                        : ($image ? asset('storage/' . $image) : null);
                                @endphp
                                <button
                                    onclick="changeMainImage('{{ $thumbUrl }}')"
                                    class="flex-shrink-0 w-24 h-24 rounded-lg overflow-hidden border-2 {{ $index === 0 ? 'border-pink-500' : 'border-gray-300' }} hover:border-pink-500 transition"
                                >
                                    <img src="{{ $thumbUrl }}"
                                         alt="Thumbnail {{ $index + 1 }}"
                                         class="w-full h-full object-cover">
                                </button>
                            @endforeach
                        </div>
                        @endif
                    @else
                        <!-- No Image Placeholder -->
                        <div class="h-96 lg:h-[500px] bg-gradient-to-br from-pink-200 to-purple-200 flex items-center justify-center">
                            <svg class="w-32 h-32 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif
                </div>

                <!-- Description -->
                <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
                    <h1 class="text-3xl lg:text-4xl font-['Playfair_Display'] font-bold text-gray-800 mb-4">
                        {{ $catalog->title }}
                    </h1>

                    <!-- Tags -->
                    <div class="flex flex-wrap gap-2 mb-6">
                        <span class="bg-purple-100 text-purple-700 px-4 py-2 rounded-full text-sm font-semibold">
                            {{ strtoupper($catalog->category) }}
                        </span>
                        <span class="bg-pink-100 text-pink-700 px-4 py-2 rounded-full text-sm font-semibold">
                            {{ strtoupper($catalog->difficulty) }}
                        </span>
                        <span class="bg-blue-100 text-blue-700 px-4 py-2 rounded-full text-sm font-semibold flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $catalog->duration_minutes }} MENIT
                        </span>
                    </div>

                    <!-- Rating & Stats -->
                    <div class="flex items-center gap-6 mb-6 pb-6 border-b border-gray-200">
                        <div class="flex items-center gap-2">
                            <div class="flex text-yellow-400">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= floor($catalog->average_rating))
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    @else
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                        </svg>
                                    @endif
                                @endfor
                            </div>
                            <span class="text-lg font-bold text-gray-800">{{ number_format($catalog->average_rating, 1) }}</span>
                            <span class="text-gray-600">({{ $catalog->review_count }} ulasan)</span>
                        </div>
                        <div class="flex items-center gap-2 text-gray-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            <span>{{ number_format($catalog->view_count) }} views</span>
                        </div>
                    </div>

                    <!-- Description Text -->
                    <h2 class="text-xl font-bold text-gray-800 mb-3">Deskripsi</h2>
                    <p class="text-gray-700 leading-relaxed mb-6">
                        {{ $catalog->description }}
                    </p>

                    <!-- Design Features -->
                    <div class="bg-gradient-to-br from-pink-50 to-purple-50 rounded-xl p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Yang Akan Anda Dapatkan:</h3>
                        <ul class="space-y-3">
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-green-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-gray-700">Design nail art profesional sesuai gambar</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-green-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-gray-700">Konsultasi langsung dengan nailist berpengalaman</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-green-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-gray-700">Material berkualitas tinggi dan aman</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-green-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-gray-700">Estimasi pengerjaan {{ $catalog->duration_minutes }} menit</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Reviews Section -->
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Ulasan Pelanggan ({{ $catalog->review_count }})</h2>

                    <!-- Review Form -->
                    @if($userReview)
                        <!-- User's Existing Review -->
                        <div class="bg-gradient-to-br from-green-50 to-emerald-50 border-2 border-green-200 rounded-xl p-6 mb-8">
                            <div class="flex items-start justify-between mb-4">
                                <div>
                                    <h3 class="font-bold text-gray-800 mb-1">Review Anda</h3>
                                    <p class="text-sm text-gray-600">Dikirim {{ $userReview->created_at->diffForHumans() }}</p>
                                </div>
                                <button
                                    onclick="toggleEditReview()"
                                    class="text-blue-600 hover:text-blue-700 font-semibold text-sm flex items-center gap-1"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Edit
                                </button>
                            </div>

                            <!-- Display Mode -->
                            <div id="reviewDisplay">
                                <div class="flex text-yellow-400 mb-3">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-6 h-6 {{ $i <= $userReview->rating ? 'fill-current' : '' }}" fill="{{ $i <= $userReview->rating ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                        </svg>
                                    @endfor
                                </div>
                                @if($userReview->comment)
                                    <p class="text-gray-700 leading-relaxed">{{ $userReview->comment }}</p>
                                @endif
                            </div>

                            <!-- Edit Mode (Hidden by default) -->
                            <div id="reviewEdit" class="hidden">
                                <form action="{{ route('reviews.update', [$catalog->id, $userReview->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <!-- Star Rating -->
                                    <div class="mb-4">
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Rating Anda</label>
                                        <div class="flex gap-2" id="editStarRating">
                                            @for($i = 1; $i <= 5; $i++)
                                                <button
                                                    type="button"
                                                    onclick="setEditRating({{ $i }})"
                                                    class="star-btn text-gray-300 hover:text-yellow-400 transition"
                                                    data-rating="{{ $i }}"
                                                >
                                                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                    </svg>
                                                </button>
                                            @endfor
                                        </div>
                                        <input type="hidden" name="rating" id="editRatingInput" value="{{ $userReview->rating }}" required>
                                    </div>

                                    <!-- Comment -->
                                    <div class="mb-4">
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Komentar (Opsional)</label>
                                        <textarea
                                            name="comment"
                                            rows="4"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                            placeholder="Ceritakan pengalaman Anda..."
                                        >{{ $userReview->comment }}</textarea>
                                    </div>

                                    <!-- Buttons -->
                                    <div class="flex gap-3">
                                        <button
                                            type="submit"
                                            class="flex-1 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white py-2 rounded-lg font-semibold transition"
                                        >
                                            Simpan Perubahan
                                        </button>
                                        <button
                                            type="button"
                                            onclick="toggleEditReview()"
                                            class="px-6 bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 rounded-lg font-semibold transition"
                                        >
                                            Batal
                                        </button>
                                    </div>
                                </form>

                                <!-- Delete Review Form -->
                                <form action="{{ route('reviews.destroy', [$catalog->id, $userReview->id]) }}" method="POST" class="mt-3" onsubmit="return confirm('Yakin ingin menghapus review Anda?')">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="text-red-600 hover:text-red-700 text-sm font-semibold"
                                    >
                                        Hapus Review
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <!-- New Review Form -->
                        <div class="bg-gradient-to-br from-purple-50 to-pink-50 border-2 border-purple-200 rounded-xl p-6 mb-8">
                            <h3 class="font-bold text-gray-800 mb-4">Berikan Review Anda</h3>

                            <!-- Success Message -->
                            @if(session('success'))
                                <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-4">
                                    <p class="text-sm text-green-800">{{ session('success') }}</p>
                                </div>
                            @endif

                            <!-- Error Message -->
                            @if($errors->any())
                                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-4">
                                    <p class="text-sm text-red-800">{{ $errors->first() }}</p>
                                </div>
                            @endif

                            <form action="{{ route('reviews.store', $catalog->id) }}" method="POST">
                                @csrf

                                <!-- Star Rating -->
                                <div class="mb-4">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Rating <span class="text-red-500">*</span></label>
                                    <div class="flex gap-2" id="starRating">
                                        @for($i = 1; $i <= 5; $i++)
                                            <button
                                                type="button"
                                                onclick="setRating({{ $i }})"
                                                class="star-btn text-gray-300 hover:text-yellow-400 transition"
                                                data-rating="{{ $i }}"
                                            >
                                                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                            </button>
                                        @endfor
                                    </div>
                                    <input type="hidden" name="rating" id="ratingInput" required>
                                    @error('rating')
                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Comment -->
                                <div class="mb-4">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Komentar (Opsional)</label>
                                    <textarea
                                        name="comment"
                                        rows="4"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('comment') border-red-500 @enderror"
                                        placeholder="Ceritakan pengalaman Anda dengan design ini..."
                                    >{{ old('comment') }}</textarea>
                                    @error('comment')
                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
                                <button
                                    type="submit"
                                    class="w-full bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white py-3 rounded-lg font-semibold shadow-md hover:shadow-lg transition-all duration-300"
                                >
                                    Kirim Review
                                </button>
                            </form>
                        </div>
                    @endif

                    <!-- Divider -->
                    <div class="border-t border-gray-200 my-6"></div>

                    @forelse($catalog->reviews as $review)
                    <!-- Review Item -->
                    <div class="border-b border-gray-200 last:border-0 pb-6 mb-6 last:mb-0">
                        <div class="flex items-start gap-4">
                            <!-- User Avatar -->
                            <div class="w-12 h-12 bg-gradient-to-br from-pink-400 to-purple-400 rounded-full flex items-center justify-center text-white font-bold flex-shrink-0">
                                {{ substr($review->user->name, 0, 1) }}
                            </div>

                            <div class="flex-1">
                                <!-- User Name & Rating -->
                                <div class="flex items-center justify-between mb-2">
                                    <div>
                                        <h4 class="font-semibold text-gray-800">{{ $review->user->name }}</h4>
                                        <p class="text-xs text-gray-500">{{ $review->created_at->diffForHumans() }}</p>
                                    </div>
                                    <div class="flex text-yellow-400">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg class="w-4 h-4 {{ $i <= $review->rating ? 'fill-current' : '' }}" fill="{{ $i <= $review->rating ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                            </svg>
                                        @endfor
                                    </div>
                                </div>

                                <!-- Review Comment -->
                                @if($review->comment)
                                <p class="text-gray-700 leading-relaxed">{{ $review->comment }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @empty
                    <!-- No Reviews -->
                    <div class="text-center py-8">
                        <svg class="w-16 h-16 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        <p class="text-gray-500">Belum ada ulasan untuk design ini</p>
                        <p class="text-sm text-gray-400 mt-1">Jadilah yang pertama memberikan ulasan!</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Sidebar -->
            <aside class="lg:col-span-1">
                <!-- Booking Card -->
                <div class="bg-white rounded-2xl shadow-xl p-6 sticky top-24 border-2 border-pink-200">
                    <!-- Price -->
                    <div class="text-center mb-6 pb-6 border-b border-gray-200">
                        <p class="text-gray-600 text-sm mb-1">Harga Mulai Dari</p>
                        <p class="text-4xl font-bold text-pink-600">{{ $catalog->formatted_price }}</p>
                    </div>

                    <!-- Quick Info -->
                    <div class="space-y-4 mb-6">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600 text-sm">Kategori</span>
                            <span class="font-semibold text-gray-800">{{ ucfirst($catalog->category) }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600 text-sm">Kesulitan</span>
                            <span class="font-semibold text-gray-800">{{ ucfirst($catalog->difficulty) }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600 text-sm">Durasi</span>
                            <span class="font-semibold text-gray-800">{{ $catalog->duration_minutes }} menit</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600 text-sm">Rating</span>
                            <span class="font-semibold text-gray-800 flex items-center gap-1">
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                {{ number_format($catalog->average_rating, 1) }}/5
                            </span>
                        </div>
                    </div>

                    <!-- Nailist Info -->
                    <div class="bg-gradient-to-br from-pink-50 to-purple-50 rounded-xl p-4 mb-6">
                        <p class="text-sm text-gray-600 mb-3">Nailist</p>
                        <a href="{{ route('nailist.public.profile', $catalog->nailist->id) }}" class="flex items-center gap-3 mb-4 group">
                            <div class="w-12 h-12 bg-gradient-to-br from-pink-400 to-purple-400 rounded-full flex items-center justify-center text-white font-bold text-lg group-hover:scale-110 transition-transform">
                                {{ substr($catalog->nailist->name, 0, 1) }}
                            </div>
                            <div class="flex-1">
                                <h4 class="font-bold text-gray-800 group-hover:text-purple-600 transition-colors">{{ $catalog->nailist->salon_name ?? $catalog->nailist->name }}</h4>
                                <p class="text-sm text-gray-600">{{ $catalog->nailist->name }}</p>
                            </div>
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-purple-600 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>

                        @if($catalog->nailist->bio)
                        <p class="text-sm text-gray-700 line-clamp-3 mb-3">{{ $catalog->nailist->bio }}</p>
                        @endif

                        <a href="{{ route('nailist.public.profile', $catalog->nailist->id) }}" class="text-sm text-purple-600 hover:text-purple-700 font-semibold flex items-center gap-1">
                            Lihat Profil Lengkap
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                    </div>

                    <!-- Contact Buttons -->
                    @if($catalog->nailist->whatsapp)
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $catalog->nailist->whatsapp) }}"
                       target="_blank"
                       class="block w-full bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white py-3 rounded-lg font-semibold shadow-md hover:shadow-lg transition-all duration-300 mb-3 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                            </svg>
                            Chat via WhatsApp
                        </div>
                    </a>
                    @endif

                    @if($catalog->nailist->instagram)
                    <a href="https://instagram.com/{{ str_replace('@', '', $catalog->nailist->instagram) }}"
                       target="_blank"
                       class="block w-full bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white py-3 rounded-lg font-semibold shadow-md hover:shadow-lg transition-all duration-300 mb-3 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                            Follow Instagram
                        </div>
                    </a>
                    @endif

                    @if($catalog->nailist->phone)
                    <a href="tel:{{ $catalog->nailist->phone }}"
                       class="block w-full bg-gray-600 hover:bg-gray-700 text-white py-3 rounded-lg font-semibold shadow-md hover:shadow-lg transition-all duration-300 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            Telepon
                        </div>
                    </a>
                    @endif
                </div>

                <!-- Other Catalogs from Same Nailist -->
                @if($otherCatalogs->isNotEmpty())
                <div class="bg-white rounded-2xl shadow-lg p-6 mt-8">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Design Lainnya dari {{ $catalog->nailist->salon_name ?? $catalog->nailist->name }}</h3>
                    <div class="space-y-4">
                        @foreach($otherCatalogs as $other)
                        <a href="{{ route('catalogs.show', $other->id) }}" class="flex gap-3 hover:bg-gray-50 p-2 rounded-lg transition group">
                            <div class="w-20 h-20 bg-gradient-to-br from-pink-200 to-purple-200 rounded-lg overflow-hidden flex-shrink-0">
                                @if($other->images && count($other->images) > 0)
                                    @php
                                        $otherFirst = $other->images[0] ?? null;
                                        $otherFirstUrl = $otherFirst && filter_var($otherFirst, FILTER_VALIDATE_URL)
                                            ? $otherFirst
                                            : ($otherFirst ? asset('storage/' . $otherFirst) : null);
                                    @endphp
                                    <img src="{{ $otherFirstUrl }}" alt="{{ $other->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <svg class="w-8 h-8 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="font-semibold text-gray-800 group-hover:text-pink-600 transition line-clamp-1">{{ $other->title }}</h4>
                                <p class="text-sm text-gray-600 line-clamp-1">{{ $other->formatted_price }}</p>
                                <div class="flex items-center gap-2 mt-1">
                                    <div class="flex items-center gap-1 text-xs text-gray-500">
                                        <svg class="w-3 h-3 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                        {{ number_format($other->average_rating, 1) }}
                                    </div>
                                    <span class="text-gray-400">•</span>
                                    <span class="text-xs text-gray-500">{{ number_format($other->view_count) }} views</span>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </aside>
        </div>
    </div>
</section>

@include('components.footer')

<!-- Scripts -->
<script>
// Image Gallery
function changeMainImage(imageUrl) {
    const mainImage = document.querySelector('#mainImage img');
    if (mainImage) {
        mainImage.src = imageUrl;
    }

    // Update active thumbnail border
    const thumbnails = document.querySelectorAll('#mainImage').parentElement.querySelectorAll('button');
    thumbnails.forEach((btn, index) => {
        if (btn.querySelector('img').src === imageUrl) {
            btn.classList.remove('border-gray-300');
            btn.classList.add('border-pink-500');
        } else {
            btn.classList.remove('border-pink-500');
            btn.classList.add('border-gray-300');
        }
    });
}

// Star Rating for New Review
function setRating(rating) {
    document.getElementById('ratingInput').value = rating;

    const stars = document.querySelectorAll('#starRating .star-btn');
    stars.forEach((star, index) => {
        if (index < rating) {
            star.classList.remove('text-gray-300');
            star.classList.add('text-yellow-400');
        } else {
            star.classList.remove('text-yellow-400');
            star.classList.add('text-gray-300');
        }
    });
}

// Star Rating for Edit Review
function setEditRating(rating) {
    document.getElementById('editRatingInput').value = rating;

    const stars = document.querySelectorAll('#editStarRating .star-btn');
    stars.forEach((star, index) => {
        if (index < rating) {
            star.classList.remove('text-gray-300');
            star.classList.add('text-yellow-400');
        } else {
            star.classList.remove('text-yellow-400');
            star.classList.add('text-gray-300');
        }
    });
}

// Toggle Edit Review Mode
function toggleEditReview() {
    const displayMode = document.getElementById('reviewDisplay');
    const editMode = document.getElementById('reviewEdit');

    if (displayMode && editMode) {
        displayMode.classList.toggle('hidden');
        editMode.classList.toggle('hidden');

        // Initialize edit stars if showing edit mode
        if (!editMode.classList.contains('hidden')) {
            const currentRating = parseInt(document.getElementById('editRatingInput').value);
            setEditRating(currentRating);
        }
    }
}

// Initialize edit stars on page load if user has review
@if($userReview ?? false)
    window.addEventListener('DOMContentLoaded', function() {
        const editRating = {{ $userReview->rating }};
        const editStars = document.querySelectorAll('#editStarRating .star-btn');
        editStars.forEach((star, index) => {
            if (index < editRating) {
                star.classList.remove('text-gray-300');
                star.classList.add('text-yellow-400');
            }
        });
    });
@endif
</script>
@endsection
