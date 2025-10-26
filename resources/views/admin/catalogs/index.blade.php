@extends('admin.layout')

@section('title', 'Catalog Moderation')
@section('page-title', 'Catalog Moderation')

@section('content')
    <!-- Search & Filter Bar -->
    <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
        <form method="GET" action="{{ route('admin.catalogs.index') }}" class="flex flex-wrap gap-4">
            <!-- Search -->
            <div class="flex-1 min-w-[250px]">
                <input type="text" name="search" value="{{ $search }}"
                    placeholder="Search by title, description, or nailist name..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent">
            </div>

            <!-- Category Filter -->
            <div class="w-48">
                <select name="category" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ $category == $cat ? 'selected' : '' }}>
                            {{ ucfirst($cat) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Search Button -->
            <button type="submit" class="px-6 py-2 bg-pink-600 text-white rounded-lg hover:bg-pink-700 transition-colors font-semibold">
                <i class="fas fa-search mr-2"></i>Search
            </button>

            @if($search || $category)
                <a href="{{ route('admin.catalogs.index', ['status' => $status]) }}" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors font-semibold">
                    <i class="fas fa-times mr-2"></i>Clear
                </a>
            @endif
        </form>
    </div>

    <!-- Tabs -->
    <div class="bg-white rounded-t-xl shadow-sm">
        <div class="flex border-b border-gray-200">
            <a href="{{ route('admin.catalogs.index', ['status' => 'all', 'search' => $search, 'category' => $category]) }}"
               class="px-6 py-4 font-semibold border-b-2 transition-colors {{ $status === 'all' ? 'border-pink-600 text-pink-600' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
                All Catalogs
                <span class="ml-2 px-2 py-1 text-xs rounded-full {{ $status === 'all' ? 'bg-pink-100 text-pink-700' : 'bg-gray-100 text-gray-600' }}">
                    {{ $totalCatalogs }}
                </span>
            </a>

            <a href="{{ route('admin.catalogs.index', ['status' => 'active', 'search' => $search, 'category' => $category]) }}"
               class="px-6 py-4 font-semibold border-b-2 transition-colors {{ $status === 'active' ? 'border-green-600 text-green-600' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
                Active
                <span class="ml-2 px-2 py-1 text-xs rounded-full {{ $status === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                    {{ $activeCatalogs }}
                </span>
            </a>

            <a href="{{ route('admin.catalogs.index', ['status' => 'inactive', 'search' => $search, 'category' => $category]) }}"
               class="px-6 py-4 font-semibold border-b-2 transition-colors {{ $status === 'inactive' ? 'border-red-600 text-red-600' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
                Inactive (Taken Down)
                <span class="ml-2 px-2 py-1 text-xs rounded-full {{ $status === 'inactive' ? 'bg-red-100 text-red-700' : 'bg-gray-100 text-gray-600' }}">
                    {{ $inactiveCatalogs }}
                </span>
            </a>
        </div>
    </div>

    <!-- Catalogs Grid -->
    <div class="bg-white rounded-b-xl shadow-sm p-6">
        @if($catalogs->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($catalogs as $catalog)
                    <div class="border border-gray-200 rounded-xl overflow-hidden hover:shadow-lg transition-shadow">
                        <!-- Image -->
                        <div class="relative h-48 bg-gray-200">
                            @php
                                $img = $catalog->primary_image ?? null;
                            @endphp
                            @if($img)
                                <img src="{{ $img }}"
                                     alt="{{ $catalog->title }}"
                                     class="w-full h-full object-cover"
                                     onerror="this.onerror=null;this.src='/images/placeholder.svg';this.classList.add('bg-gray-100');">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif

                            <!-- Status Badge -->
                            @if(!$catalog->is_active)
                                <div class="absolute top-2 right-2">
                                    <span class="badge-danger">
                                        <i class="fas fa-ban mr-1"></i>Inactive
                                    </span>
                                </div>
                            @else
                                <div class="absolute top-2 right-2">
                                    <span class="badge-success">
                                        <i class="fas fa-check mr-1"></i>Active
                                    </span>
                                </div>
                            @endif
                        </div>

                        <!-- Content -->
                        <div class="p-4">
                            <h3 class="font-bold text-gray-800 mb-2 line-clamp-2">{{ $catalog->title }}</h3>

                            <!-- Nailist Info -->
                            <div class="flex items-center gap-2 mb-3 text-sm text-gray-600">
                                <div class="avatar-circle-small">
                                    {{ substr($catalog->nailist->name, 0, 1) }}
                                </div>
                                <span>{{ $catalog->nailist->name }}</span>
                            </div>

                            <!-- Stats -->
                            <div class="flex items-center gap-4 mb-3 text-xs text-gray-500">
                                <span><i class="fas fa-eye mr-1"></i>{{ number_format($catalog->view_count) }}</span>
                                <span><i class="fas fa-star text-yellow-500 mr-1"></i>{{ number_format($catalog->average_rating, 1) }}</span>
                                <span><i class="fas fa-comment mr-1"></i>{{ $catalog->review_count }}</span>
                            </div>

                            <!-- Category & Price -->
                            <div class="flex items-center justify-between mb-3">
                                <span class="badge-info text-xs">{{ ucfirst($catalog->category) }}</span>
                                <span class="text-sm font-semibold text-pink-600">Rp {{ number_format($catalog->price, 0, ',', '.') }}</span>
                            </div>

                            <!-- Moderation Info -->
                            @if($catalog->moderation_reason)
                                <div class="bg-red-50 border border-red-200 rounded-lg p-2 mb-3">
                                    <p class="text-xs text-red-700 font-semibold mb-1">Takedown Reason:</p>
                                    <p class="text-xs text-red-600">{{ Str::limit($catalog->moderation_reason, 80) }}</p>
                                </div>
                            @endif

                            <!-- Actions -->
                            <div class="flex gap-2">
                                <a href="{{ route('admin.catalogs.show', $catalog->id) }}"
                                   class="flex-1 px-3 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 transition-colors text-center font-semibold">
                                    <i class="fas fa-eye mr-1"></i>View Details
                                </a>

                                @if($catalog->is_active)
                                    <button onclick="openDeactivateModal({{ $catalog->id }}, '{{ addslashes($catalog->title) }}')"
                                            class="flex items-center justify-center w-10 h-10 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors"
                                            title="Deactivate catalog" aria-label="Deactivate catalog">
                                        <!-- inline ban icon for guaranteed visibility -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 5.636a9 9 0 11-12.728 12.728 9 9 0 0112.728-12.728z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 9l-6 6"></path>
                                        </svg>
                                    </button>
                                @else
                                    <form method="POST" action="{{ route('admin.catalogs.restore', $catalog->id) }}" class="inline">
                                        @csrf
                                        <button type="submit"
                                                onclick="return confirm('Restore this catalog?')"
                                                class="px-3 py-2 bg-green-600 text-white text-sm rounded-lg hover:bg-green-700 transition-colors font-semibold">
                                            <i class="fas fa-undo"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $catalogs->appends(['status' => $status, 'search' => $search, 'category' => $category])->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <p class="text-gray-500 text-lg">No catalogs found</p>
                @if($search || $category)
                    <a href="{{ route('admin.catalogs.index', ['status' => $status]) }}" class="text-pink-600 hover:text-pink-700 font-semibold mt-2 inline-block">
                        Clear filters
                    </a>
                @endif
            </div>
        @endif
    </div>

    <!-- Deactivate Modal -->
    <div id="deactivateModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-md w-full p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Deactivate Catalog</h3>
            <p class="text-gray-600 mb-4">You are about to take down: <strong id="catalogTitle"></strong></p>

            <form id="deactivateForm" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Reason for takedown *</label>
                    <textarea name="reason" required maxlength="500" rows="4"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                        placeholder="e.g., Inappropriate content, violates guidelines, copyright infringement..."></textarea>
                    <p class="text-xs text-gray-500 mt-1">This reason will be visible to the nailist</p>
                    @error('reason')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-3">
                    <button type="button" onclick="closeDeactivateModal()"
                            class="flex-1 px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors font-semibold">
                        Cancel
                    </button>
                    <button type="submit"
                            class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-semibold">
                        <i class="fas fa-ban mr-2"></i>Deactivate
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openDeactivateModal(catalogId, catalogTitle) {
            document.getElementById('deactivateModal').classList.remove('hidden');
            document.getElementById('catalogTitle').textContent = catalogTitle;
            document.getElementById('deactivateForm').action = `/admin/catalogs/${catalogId}/deactivate`;
        }

        function closeDeactivateModal() {
            document.getElementById('deactivateModal').classList.add('hidden');
        }

        // Close modal on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeDeactivateModal();
            }
        });
    </script>
@endsection
