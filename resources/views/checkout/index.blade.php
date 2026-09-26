@extends('layouts.app')

@section('title', 'Checkout - Nail Measurement System')

@section('content')
@include('components.navbar')

<div class="min-h-screen bg-gradient-to-br from-pink-50 via-purple-50 to-blue-50 py-12">
    <div class="max-w-5xl mx-auto px-4">
        <nav class="mb-8 flex items-center text-sm text-gray-600">
            <a href="{{ route('products.index') }}" class="hover:text-pink-500 transition-colors">Produk</a>
            <svg class="w-3 h-3 mx-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
            </svg>
            <span class="text-gray-800 font-medium">Checkout</span>
        </nav>

        <h1 class="font-['Playfair_Display'] text-4xl font-bold text-gray-800 mb-8">Checkout</h1>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
            <!-- Order Summary -->
            <div class="lg:col-span-3 bg-white rounded-3xl shadow-xl p-8">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Ringkasan Pesanan</h2>

                <div class="space-y-4">
                    @foreach($items as $item)
                    <div class="flex items-center justify-between gap-4 border-b border-gray-100 pb-4">
                        <div class="min-w-0">
                            <p class="font-semibold text-gray-800">{{ $item->product->name }}</p>
                            <p class="text-sm text-gray-500">Size {{ $item->size }}{{ $item->length ? ' · ' . $item->length : '' }} · Qty {{ $item->quantity }}</p>
                        </div>
                        <p class="font-semibold text-gray-800 whitespace-nowrap">
                            Rp {{ number_format((float) $item->product->price * $item->quantity, 0, ',', '.') }}
                        </p>
                    </div>
                    @endforeach
                </div>

                <dl class="mt-6 space-y-2 text-sm">
                    <div class="flex justify-between text-gray-600">
                        <dt>Subtotal</dt>
                        <dd>Rp {{ number_format($subtotal, 0, ',', '.') }}</dd>
                    </div>
                    @if($coupon)
                    <div class="flex justify-between text-emerald-600">
                        <dt>Diskon ({{ $coupon->code }})</dt>
                        <dd>-Rp {{ number_format($discount, 0, ',', '.') }}</dd>
                    </div>
                    @endif
                    <div class="flex justify-between border-t border-gray-200 pt-3 text-lg font-bold text-gray-900">
                        <dt>Total</dt>
                        <dd>Rp {{ number_format($total, 0, ',', '.') }}</dd>
                    </div>
                </dl>

                @if($notes !== '')
                <div class="mt-6 rounded-xl bg-gray-50 border border-gray-200 p-4">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500 mb-1">Catatan</p>
                    <p class="text-sm text-gray-700">{{ $notes }}</p>
                </div>
                @endif
            </div>

            <!-- Customer Form -->
            <div class="lg:col-span-2 bg-white rounded-3xl shadow-xl p-8 h-fit">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Data Pemesan</h2>

                <form method="POST" action="{{ route('checkout.submit') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="customer_name" class="block text-sm font-bold text-gray-700 mb-2">Nama <span class="text-red-500">*</span></label>
                        <input type="text" id="customer_name" name="customer_name" value="{{ old('customer_name') }}" required
                               class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-pink-500 focus:ring-2 focus:ring-pink-200 outline-none transition-all @error('customer_name') border-red-500 @enderror">
                        @error('customer_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="customer_phone" class="block text-sm font-bold text-gray-700 mb-2">No. HP / WhatsApp <span class="text-red-500">*</span></label>
                        <input type="text" id="customer_phone" name="customer_phone" value="{{ old('customer_phone') }}" required
                               class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-pink-500 focus:ring-2 focus:ring-pink-200 outline-none transition-all @error('customer_phone') border-red-500 @enderror">
                        @error('customer_phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="customer_address" class="block text-sm font-bold text-gray-700 mb-2">Alamat Pengiriman</label>
                        <textarea id="customer_address" name="customer_address" rows="3"
                                  class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-pink-500 focus:ring-2 focus:ring-pink-200 outline-none transition-all @error('customer_address') border-red-500 @enderror">{{ old('customer_address') }}</textarea>
                        @error('customer_address')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-pink-500 to-rose-500 hover:from-pink-600 hover:to-rose-600 text-white px-6 py-4 rounded-full font-bold text-lg shadow-lg hover:shadow-xl transition-all duration-300">
                        Pesan via WhatsApp
                    </button>

                    <p class="text-xs text-gray-500 text-center">Pesanan akan diteruskan ke WhatsApp admin untuk konfirmasi pembayaran dan pengiriman.</p>
                </form>
            </div>
        </div>
    </div>
</div>

@include('components.footer')
@endsection
