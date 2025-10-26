<!-- Footer -->
<footer class="bg-gradient-to-br from-gray-800 via-gray-900 to-gray-800 text-white py-16">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
            <div>
                <h3 class="text-3xl font-['Playfair_Display'] font-bold bg-gradient-to-r from-pink-400 to-rose-400 bg-clip-text text-transparent mb-4">
                    NailPerfect
                </h3>
                <p class="text-gray-400 leading-relaxed">
                    Sistem pengukuran kuku berbasis web untuk hasil nail art yang sempurna
                </p>
            </div>

            <div>
                <h4 class="text-lg font-bold text-pink-400 mb-4">Hubungi Kami</h4>
                <p class="text-gray-400 mb-2">Email: admin@nailperfect.com</p>
                <p class="text-gray-400">
                    Laporkan Bug:
                    <a href="mailto:bug@nailperfect.com" class="text-pink-400 hover:text-pink-300 transition-colors">
                        bug@nailperfect.com
                    </a>
                </p>
            </div>

            <div>
                <h4 class="text-lg font-bold text-pink-400 mb-4">Quick Links</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-400 hover:text-pink-400 transition-colors">Tentang Kami</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-pink-400 transition-colors">Panduan Pengukuran</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-pink-400 transition-colors">FAQ</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-pink-400 transition-colors">Kebijakan Privasi</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-lg font-bold text-pink-400 mb-4">Konsultasi</h4>
                <p class="text-gray-400 mb-4">Butuh bantuan nailist profesional?</p>
                <a href="https://wa.me/6281234567890" target="_blank">
                    <button class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white px-6 py-3 rounded-full font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                        </svg>
                        Hubungi via WhatsApp
                    </button>
                </a>
            </div>
        </div>

        <div class="border-t border-gray-700 pt-8 text-center">
            <p class="text-gray-400">&copy; 2025 NailPerfect. All rights reserved.</p>
        </div>
    </div>
</footer>

<!-- Login Prompt Modal -->
<div id="loginPromptModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-[100] flex items-center justify-center p-4" onclick="closeLoginPrompt(event)">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-8 transform transition-all" onclick="event.stopPropagation()">
        <div class="text-center">
            <!-- Icon -->
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-pink-500 to-purple-500 rounded-full mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
            </div>

            <h3 class="text-2xl font-bold text-gray-800 mb-2">Login Required</h3>
            <p class="text-gray-600 mb-6">
                Silakan login atau daftar untuk melihat detail design dan kontak nailist
            </p>

            <!-- Buttons -->
            <div class="flex flex-col gap-3">
                <a href="{{ route('login') }}" class="w-full bg-gradient-to-r from-pink-500 to-purple-500 hover:from-pink-600 hover:to-purple-600 text-white py-3 rounded-full font-semibold shadow-lg hover:shadow-xl transition-all duration-300">
                    Login
                </a>
                <a href="{{ route('register') }}" class="w-full bg-white border-2 border-pink-500 text-pink-600 hover:bg-pink-50 py-3 rounded-full font-semibold transition-all duration-300">
                    Daftar Gratis
                </a>
                <button onclick="closeLoginPrompt(event)" class="text-gray-500 hover:text-gray-700 font-medium py-2">
                    Nanti Saja
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function showLoginPrompt() {
    document.getElementById('loginPromptModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeLoginPrompt(event) {
    if (event) {
        event.preventDefault();
        event.stopPropagation();
    }
    document.getElementById('loginPromptModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}
</script>
