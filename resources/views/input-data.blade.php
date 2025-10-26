@extends('layouts.app')

@section('title', 'Input Data Pengukuran - Nail Measurement System')

@section('content')
@include('components.navbar')

<!-- Hero Section -->
<section class="bg-gradient-to-br from-pink-50 via-rose-50 to-pink-100 py-16">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl lg:text-5xl font-['Playfair_Display'] font-bold text-gray-800 mb-4">
            Input Data Pengukuran
        </h1>
        <p class="text-lg lg:text-xl text-gray-600 max-w-2xl mx-auto">
            Masukkan hasil pengukuran kuku Anda untuk mendapatkan rekomendasi produk yang tepat
        </p>
    </div>
</section>

<!-- Form Section -->
<section class="py-16 lg:py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto">
            <!-- Form Card -->
            <div class="bg-white rounded-3xl shadow-2xl p-8 lg:p-12">
                <!-- Toggle Switch di Kanan Atas -->
                <div class="flex justify-end mb-6">
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <span class="text-gray-700 font-medium group-hover:text-pink-600 transition-colors">
                            Ukuran tangan kanan & kiri berbeda
                        </span>
                        <div class="relative inline-block w-14 h-8 align-middle select-none">
                            <input type="checkbox" id="toggleLeftHand" class="toggle-checkbox absolute opacity-0 w-0 h-0" onchange="toggleLeftHandForm()">
                            <label for="toggleLeftHand" class="toggle-label block overflow-hidden h-8 rounded-full bg-gray-300 cursor-pointer transition-colors duration-300"></label>
                        </div>
                    </label>
                </div>

                <form action="{{ route('hasil-klasifikasi.store') }}" method="POST">
                    @csrf

                    <!-- Info Section -->
                    <div class="bg-gradient-to-br from-pink-100 to-rose-100 rounded-2xl p-6 mb-8">
                        <div class="flex items-start gap-4">
                            <svg class="w-8 h-8 text-pink-500 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <h3 class="font-bold text-gray-800 mb-2">Petunjuk Pengisian:</h3>
                                <ul class="text-gray-600 text-sm space-y-1">
                                    <li>• Masukkan ukuran dalam satuan milimeter (mm)</li>
                                    <li>• Ukur lebar kuku pada bagian terlebar</li>
                                    <li>• Pastikan pengukuran dilakukan dengan teliti</li>
                                    <li>• Secara default, ukuran akan diterapkan untuk kedua tangan</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Tangan Kanan Section -->
                    <div class="mb-8">
                        <h3 id="rightHandTitle" class="text-2xl font-['Playfair_Display'] font-bold text-gray-800 mb-6 flex items-center gap-3">
                            <svg class="w-8 h-8 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11.5V14m0-2.5v-6a1.5 1.5 0 113 0m-3 6a1.5 1.5 0 00-3 0v2a7.5 7.5 0 0015 0v-5a1.5 1.5 0 00-3 0m-6-3V11m0-5.5v-1a1.5 1.5 0 013 0v1m0 0V11m0-5.5a1.5 1.5 0 013 0v3m0 0V11"></path>
                            </svg>
                            <span id="rightHandText">Ukuran Jari</span>
                        </h3>

                        <!-- All Fingers in One Row on Desktop, Responsive Grid -->
                        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
                            <!-- Jempol -->
                            <div>
                                <label class="block text-gray-800 font-semibold mb-2 text-center text-sm">
                                    <span class="flex flex-col items-center gap-1">
                                        <span class="bg-gradient-to-r from-pink-500 to-rose-500 text-white w-6 h-6 rounded-full flex items-center justify-center text-xs">1</span>
                                        <span>Jempol</span>
                                    </span>
                                </label>
                                <div class="relative">
                                    <input type="number" name="right_jempol" step="0.1" min="0" required
                                           class="w-full px-3 py-3 rounded-xl border-2 border-pink-200 focus:border-pink-400 focus:outline-none focus:ring-2 focus:ring-pink-100 transition-all text-center text-base font-semibold"
                                           placeholder="14.5">
                                    <span class="block text-center text-xs text-gray-400 mt-1">mm</span>
                                </div>
                            </div>

                            <!-- Telunjuk -->
                            <div>
                                <label class="block text-gray-800 font-semibold mb-2 text-center text-sm">
                                    <span class="flex flex-col items-center gap-1">
                                        <span class="bg-gradient-to-r from-pink-500 to-rose-500 text-white w-6 h-6 rounded-full flex items-center justify-center text-xs">2</span>
                                        <span>Telunjuk</span>
                                    </span>
                                </label>
                                <div class="relative">
                                    <input type="number" name="right_telunjuk" step="0.1" min="0" required
                                           class="w-full px-3 py-3 rounded-xl border-2 border-pink-200 focus:border-pink-400 focus:outline-none focus:ring-2 focus:ring-pink-100 transition-all text-center text-base font-semibold"
                                           placeholder="12.0">
                                    <span class="block text-center text-xs text-gray-400 mt-1">mm</span>
                                </div>
                            </div>

                            <!-- Jari Tengah -->
                            <div>
                                <label class="block text-gray-800 font-semibold mb-2 text-center text-sm">
                                    <span class="flex flex-col items-center gap-1">
                                        <span class="bg-gradient-to-r from-pink-500 to-rose-500 text-white w-6 h-6 rounded-full flex items-center justify-center text-xs">3</span>
                                        <span>Tengah</span>
                                    </span>
                                </label>
                                <div class="relative">
                                    <input type="number" name="right_jari_tengah" step="0.1" min="0" required
                                           class="w-full px-3 py-3 rounded-xl border-2 border-pink-200 focus:border-pink-400 focus:outline-none focus:ring-2 focus:ring-pink-100 transition-all text-center text-base font-semibold"
                                           placeholder="12.5">
                                    <span class="block text-center text-xs text-gray-400 mt-1">mm</span>
                                </div>
                            </div>

                            <!-- Jari Manis -->
                            <div>
                                <label class="block text-gray-800 font-semibold mb-2 text-center text-sm">
                                    <span class="flex flex-col items-center gap-1">
                                        <span class="bg-gradient-to-r from-pink-500 to-rose-500 text-white w-6 h-6 rounded-full flex items-center justify-center text-xs">4</span>
                                        <span>Manis</span>
                                    </span>
                                </label>
                                <div class="relative">
                                    <input type="number" name="right_jari_manis" step="0.1" min="0" required
                                           class="w-full px-3 py-3 rounded-xl border-2 border-pink-200 focus:border-pink-400 focus:outline-none focus:ring-2 focus:ring-pink-100 transition-all text-center text-base font-semibold"
                                           placeholder="11.0">
                                    <span class="block text-center text-xs text-gray-400 mt-1">mm</span>
                                </div>
                            </div>

                            <!-- Kelingking -->
                            <div>
                                <label class="block text-gray-800 font-semibold mb-2 text-center text-sm">
                                    <span class="flex flex-col items-center gap-1">
                                        <span class="bg-gradient-to-r from-pink-500 to-rose-500 text-white w-6 h-6 rounded-full flex items-center justify-center text-xs">5</span>
                                        <span>Kelingking</span>
                                    </span>
                                </label>
                                <div class="relative">
                                    <input type="number" name="right_kelingking" step="0.1" min="0" required
                                           class="w-full px-3 py-3 rounded-xl border-2 border-pink-200 focus:border-pink-400 focus:outline-none focus:ring-2 focus:ring-pink-100 transition-all text-center text-base font-semibold"
                                           placeholder="9.5">
                                    <span class="block text-center text-xs text-gray-400 mt-1">mm</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tangan Kiri Section (Hidden by Default) -->
                    <div id="leftHandSection" class="mb-8 hidden">
                        <div class="border-t-2 border-pink-200 my-8"></div>

                        <h3 class="text-2xl font-['Playfair_Display'] font-bold text-gray-800 mb-6 flex items-center gap-3">
                            <svg class="w-8 h-8 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11.5V14m0-2.5v-6a1.5 1.5 0 113 0m-3 6a1.5 1.5 0 00-3 0v2a7.5 7.5 0 0015 0v-5a1.5 1.5 0 00-3 0m-6-3V11m0-5.5v-1a1.5 1.5 0 013 0v1m0 0V11m0-5.5a1.5 1.5 0 013 0v3m0 0V11"></path>
                            </svg>
                            Tangan Kiri
                        </h3>

                        <!-- All Fingers in One Row on Desktop, Responsive Grid -->
                        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
                            <!-- Jempol Kiri -->
                            <div>
                                <label class="block text-gray-800 font-semibold mb-2 text-center text-sm">
                                    <span class="flex flex-col items-center gap-1">
                                        <span class="bg-gradient-to-r from-rose-500 to-pink-500 text-white w-6 h-6 rounded-full flex items-center justify-center text-xs">1</span>
                                        <span>Jempol</span>
                                    </span>
                                </label>
                                <div class="relative">
                                    <input type="number" name="left_jempol" step="0.1" min="0"
                                           class="w-full px-3 py-3 rounded-xl border-2 border-rose-200 focus:border-rose-400 focus:outline-none focus:ring-2 focus:ring-rose-100 transition-all text-center text-base font-semibold"
                                           placeholder="14.5">
                                    <span class="block text-center text-xs text-gray-400 mt-1">mm</span>
                                </div>
                            </div>

                            <!-- Telunjuk Kiri -->
                            <div>
                                <label class="block text-gray-800 font-semibold mb-2 text-center text-sm">
                                    <span class="flex flex-col items-center gap-1">
                                        <span class="bg-gradient-to-r from-rose-500 to-pink-500 text-white w-6 h-6 rounded-full flex items-center justify-center text-xs">2</span>
                                        <span>Telunjuk</span>
                                    </span>
                                </label>
                                <div class="relative">
                                    <input type="number" name="left_telunjuk" step="0.1" min="0"
                                           class="w-full px-3 py-3 rounded-xl border-2 border-rose-200 focus:border-rose-400 focus:outline-none focus:ring-2 focus:ring-rose-100 transition-all text-center text-base font-semibold"
                                           placeholder="12.0">
                                    <span class="block text-center text-xs text-gray-400 mt-1">mm</span>
                                </div>
                            </div>

                            <!-- Jari Tengah Kiri -->
                            <div>
                                <label class="block text-gray-800 font-semibold mb-2 text-center text-sm">
                                    <span class="flex flex-col items-center gap-1">
                                        <span class="bg-gradient-to-r from-rose-500 to-pink-500 text-white w-6 h-6 rounded-full flex items-center justify-center text-xs">3</span>
                                        <span>Tengah</span>
                                    </span>
                                </label>
                                <div class="relative">
                                    <input type="number" name="left_jari_tengah" step="0.1" min="0"
                                           class="w-full px-3 py-3 rounded-xl border-2 border-rose-200 focus:border-rose-400 focus:outline-none focus:ring-2 focus:ring-rose-100 transition-all text-center text-base font-semibold"
                                           placeholder="12.5">
                                    <span class="block text-center text-xs text-gray-400 mt-1">mm</span>
                                </div>
                            </div>

                            <!-- Jari Manis Kiri -->
                            <div>
                                <label class="block text-gray-800 font-semibold mb-2 text-center text-sm">
                                    <span class="flex flex-col items-center gap-1">
                                        <span class="bg-gradient-to-r from-rose-500 to-pink-500 text-white w-6 h-6 rounded-full flex items-center justify-center text-xs">4</span>
                                        <span>Manis</span>
                                    </span>
                                </label>
                                <div class="relative">
                                    <input type="number" name="left_jari_manis" step="0.1" min="0"
                                           class="w-full px-3 py-3 rounded-xl border-2 border-rose-200 focus:border-rose-400 focus:outline-none focus:ring-2 focus:ring-rose-100 transition-all text-center text-base font-semibold"
                                           placeholder="11.0">
                                    <span class="block text-center text-xs text-gray-400 mt-1">mm</span>
                                </div>
                            </div>

                            <!-- Kelingking Kiri -->
                            <div>
                                <label class="block text-gray-800 font-semibold mb-2 text-center text-sm">
                                    <span class="flex flex-col items-center gap-1">
                                        <span class="bg-gradient-to-r from-rose-500 to-pink-500 text-white w-6 h-6 rounded-full flex items-center justify-center text-xs">5</span>
                                        <span>Kelingking</span>
                                    </span>
                                </label>
                                <div class="relative">
                                    <input type="number" name="left_kelingking" step="0.1" min="0"
                                           class="w-full px-3 py-3 rounded-xl border-2 border-rose-200 focus:border-rose-400 focus:outline-none focus:ring-2 focus:ring-rose-100 transition-all text-center text-base font-semibold"
                                           placeholder="9.5">
                                    <span class="block text-center text-xs text-gray-400 mt-1">mm</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t-2 border-pink-100">
                        <a href="{{ route('panduan') }}" class="flex-1">
                            <button type="button" class="w-full bg-white text-pink-600 border-2 border-pink-500 hover:bg-pink-50 px-8 py-4 rounded-full font-bold text-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                                <svg class="inline-block w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Kembali ke Panduan
                            </button>
                        </a>
                        <button type="submit" class="flex-1 bg-gradient-to-r from-pink-500 to-rose-500 hover:from-pink-600 hover:to-rose-600 text-white px-8 py-4 rounded-full font-bold text-lg shadow-2xl hover:shadow-3xl transform hover:scale-105 hover:-translate-y-1 transition-all duration-300">
                            Lihat Hasil Klasifikasi
                            <svg class="inline-block w-6 h-6 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Tips Section -->
            <div class="mt-8 bg-gradient-to-br from-pink-50 to-rose-50 rounded-3xl p-8 shadow-lg">
                <h3 class="text-2xl font-['Playfair_Display'] font-bold text-gray-800 mb-4 flex items-center gap-3">
                    <svg class="w-8 h-8 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                    </svg>
                    Tips Pengukuran yang Akurat
                </h3>
                <ul class="space-y-3 text-gray-600">
                    <li class="flex items-start gap-3">
                        <span class="text-pink-500 font-bold flex-shrink-0">✓</span>
                        <span>Ukur di pagi hari ketika jari tidak bengkak</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="text-pink-500 font-bold flex-shrink-0">✓</span>
                        <span>Gunakan penggaris transparan untuk hasil lebih akurat</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="text-pink-500 font-bold flex-shrink-0">✓</span>
                        <span>Ukur 2-3 kali untuk memastikan konsistensi</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="text-pink-500 font-bold flex-shrink-0">✓</span>
                        <span>Catat hasil pengukuran sebelum memasukkan data</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

@include('components.footer')

<style>
/* Toggle Switch Styling */
.toggle-label {
    position: relative;
    display: block;
    width: 56px;
    height: 32px;
    background-color: #d1d5db !important; /* gray-300 */
    border-radius: 9999px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.toggle-label::before {
    content: '';
    position: absolute;
    top: 4px;
    left: 4px;
    width: 24px;
    height: 24px;
    background-color: white;
    border-radius: 50%;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s ease;
}

.toggle-checkbox:checked + .toggle-label {
    background-color: #ec4899 !important; /* pink-500 */
}

.toggle-checkbox:checked + .toggle-label::before {
    transform: translateX(24px);
}

/* Hover effect */
.toggle-label:hover {
    opacity: 0.9;
}
</style>

<script>
function toggleLeftHandForm() {
    const checkbox = document.getElementById('toggleLeftHand');
    const leftHandSection = document.getElementById('leftHandSection');
    const leftHandInputs = leftHandSection.querySelectorAll('input[type="number"]');
    const rightHandText = document.getElementById('rightHandText');

    if (checkbox.checked) {
        // Change right hand title to "Tangan Kanan"
        rightHandText.textContent = 'Tangan Kanan';

        // Show left hand form with animation
        leftHandSection.classList.remove('hidden');
        leftHandSection.style.opacity = '0';
        setTimeout(() => {
            leftHandSection.style.transition = 'opacity 0.3s ease-in-out';
            leftHandSection.style.opacity = '1';
        }, 10);

        // Make left hand inputs required
        leftHandInputs.forEach(input => {
            input.required = true;
        });
    } else {
        // Change right hand title back to "Ukuran Jari"
        rightHandText.textContent = 'Ukuran Jari';

        // Hide left hand form with animation
        leftHandSection.style.opacity = '0';
        setTimeout(() => {
            leftHandSection.classList.add('hidden');
        }, 300);

        // Remove required from left hand inputs and clear values
        leftHandInputs.forEach(input => {
            input.required = false;
            input.value = '';
        });
    }
}
</script>
@endsection
