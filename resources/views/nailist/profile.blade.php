@extends('nailist.layout')

@section('title', 'My Profile')
@section('page-title', 'My Profile')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-md p-8">
        <form action="{{ route('nailist.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Name *</label>
                    <input type="text" name="name" value="{{ old('name', $nailist->name) }}" required
                           class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-pink-500 focus:ring-2 focus:ring-pink-200 outline-none">
                    @error('name')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Salon Name *</label>
                    <input type="text" name="salon_name" value="{{ old('salon_name', $nailist->salon_name) }}" required
                           class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-pink-500 focus:ring-2 focus:ring-pink-200 outline-none">
                    @error('salon_name')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Phone *</label>
                    <input type="text" name="phone" value="{{ old('phone', $nailist->phone) }}" required
                           class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-pink-500 focus:ring-2 focus:ring-pink-200 outline-none">
                    @error('phone')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">WhatsApp</label>
                    <input type="text" name="whatsapp" value="{{ old('whatsapp', $nailist->whatsapp) }}"
                           class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-pink-500 focus:ring-2 focus:ring-pink-200 outline-none"
                           placeholder="628123456789">
                    @error('whatsapp')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Instagram</label>
                <input type="text" name="instagram" value="{{ old('instagram', $nailist->instagram) }}"
                       class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-pink-500 focus:ring-2 focus:ring-pink-200 outline-none"
                       placeholder="@yourusername">
                @error('instagram')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Bio</label>
                <textarea name="bio" rows="4"
                          class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-pink-500 focus:ring-2 focus:ring-pink-200 outline-none">{{ old('bio', $nailist->bio) }}</textarea>
                @error('bio')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Address</label>
                <textarea name="address" rows="3"
                          class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-pink-500 focus:ring-2 focus:ring-pink-200 outline-none">{{ old('address', $nailist->address) }}</textarea>
                @error('address')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <button type="submit" class="w-full bg-gradient-to-r from-pink-500 to-rose-500 hover:from-pink-600 hover:to-rose-600 text-white px-8 py-4 rounded-lg font-bold">
                Update Profile
            </button>
        </form>
    </div>
</div>
@endsection
