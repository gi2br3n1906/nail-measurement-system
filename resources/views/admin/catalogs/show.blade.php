@extends('admin.layout')

@section('title', 'Catalog Details')
@section('page-title', 'Catalog Details')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6">
    <div class="flex gap-6">
        <div class="w-1/3">
            <div class="grid grid-cols-1 gap-3">
                @php $primary = $catalog->primary_image ?? null; @endphp
                @if(!empty($catalog->images))
                    @foreach($catalog->images as $img)
                        <div class="relative border rounded overflow-hidden catalog-image-block" data-img="{{ $img }}">
                            <img src="{{ $img }}" class="w-full h-48 object-cover" onerror="this.onerror=null;this.src='/images/placeholder.svg';this.classList.add('bg-gray-100');">
                            <button type="button" class="absolute top-2 right-2 bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 catalog-image-delete" data-img="{{ $img }}">Delete</button>
                        </div>
                    @endforeach
                @elseif($primary)
                    <div class="relative border rounded overflow-hidden catalog-image-block" data-img="{{ $primary }}">
                        <img src="{{ $primary }}" class="w-full h-48 object-cover" onerror="this.onerror=null;this.src='/images/placeholder.svg';this.classList.add('bg-gray-100');">
                    </div>
                @else
                    <div class="w-full h-48 flex items-center justify-center text-gray-400">No images</div>
                @endif
            </div>
        </div>

        <div class="flex-1">
            <h2 class="text-xl font-bold mb-2">{{ $catalog->title }}</h2>
            <p class="text-sm text-gray-600 mb-4">By: {{ $catalog->nailist->name }}</p>

            <p class="mb-4">{{ $catalog->description }}</p>

            <div class="mb-4">
                <strong>Category:</strong> {{ ucfirst($catalog->category) }}
            </div>

            <div class="mb-4">
                <strong>Price:</strong> Rp {{ number_format($catalog->price, 0, ',', '.') }}
            </div>

            <div class="flex gap-3">
                @if($catalog->is_active)
                    <form action="{{ route('admin.catalogs.deactivate', $catalog->id) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded">Deactivate</button>
                    </form>
                @else
                    <form action="{{ route('admin.catalogs.restore', $catalog->id) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Restore</button>
                    </form>
                @endif

                <form action="{{ route('admin.catalogs.destroy', $catalog->id) }}" method="POST" onsubmit="return confirm('Delete this catalog permanently?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-gray-200">Delete</button>
                </form>
            </div>

            @if($catalog->moderation_reason)
                <div class="mt-4 bg-red-50 border border-red-200 rounded p-3">
                    <strong>Takedown reason:</strong>
                    <p class="text-sm text-red-700">{{ $catalog->moderation_reason }}</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
