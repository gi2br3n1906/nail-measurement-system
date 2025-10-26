<!-- Alpine.js for dropdown functionality -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<!-- Header -->
<header class="bg-white/90 backdrop-blur-md shadow-lg sticky top-0 z-50 border-b-2 border-pink-200">
    <div class="container mx-auto px-4 py-4">
        <div class="flex items-center justify-between gap-8">
            <!-- Logo (Clickable to Home) -->
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}">
                    <h1 class="text-3xl lg:text-4xl font-['Playfair_Display'] font-bold bg-gradient-to-r from-pink-500 via-rose-500 to-pink-600 bg-clip-text text-transparent cursor-pointer hover:scale-105 transition-transform duration-300">
                        NailPerfect
                    </h1>
                </a>
            </div>

            <!-- Center: Navigation Menu & Search -->
            <div class="hidden lg:flex items-center gap-8 flex-1 justify-center">
                <!-- Navigation Menu -->
                <nav>
                    <ul class="flex space-x-8">
                        <li><a href="{{ route('panduan') }}" class="text-gray-700 hover:text-pink-500 font-medium transition-colors duration-300">Panduan</a></li>
                        <li><a href="{{ route('products.index') }}" class="text-gray-700 hover:text-pink-500 font-medium transition-colors duration-300">Produk</a></li>
                        <li><a href="{{ route('measurements.index') }}" class="text-gray-700 hover:text-pink-500 font-medium transition-colors duration-300">Riwayat</a></li>
                        <li><a href="#testimoni" class="text-gray-700 hover:text-pink-500 font-medium transition-colors duration-300">Testimoni</a></li>
                    </ul>
                </nav>

                <!-- Search -->
                <div class="relative">
                    <input type="text" placeholder="Cari produk..."
                           class="w-64 pl-4 pr-10 py-2 rounded-full border-2 border-pink-200 focus:border-pink-400 focus:outline-none focus:ring-2 focus:ring-pink-200 transition-all">
                    <button class="absolute right-3 top-1/2 transform -translate-y-1/2 text-pink-500 hover:text-pink-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Right: Auth Section -->
            <div class="hidden lg:block flex-shrink-0">
                @auth
                    <!-- User Dropdown -->
                    <div class="relative" x-data="{ open: false }" @click.away="open = false">
                        <button @click="open = !open" class="flex items-center gap-2 bg-gradient-to-r from-pink-500 to-rose-500 hover:from-pink-600 hover:to-rose-600 text-white px-4 py-2 rounded-full font-semibold shadow-md hover:shadow-lg transition-all duration-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span class="max-w-[120px] truncate">{{ auth()->user()->name }}</span>
                            <svg class="w-4 h-4" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-xl border border-gray-200 py-2 z-50"
                             style="display: none;">
                            <!-- User Info -->
                            <div class="px-4 py-3 border-b border-gray-200">
                                <p class="text-sm font-semibold text-gray-900">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
                            </div>

                            <!-- Menu Items -->
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-pink-50 hover:text-pink-600 transition">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    My Profile
                                </div>
                            </a>

                            <a href="{{ route('measurements.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-pink-50 hover:text-pink-600 transition">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    My Measurements
                                </div>
                            </a>

                            <!-- Admin/Nailist Links -->
                            @if(auth()->user()->hasAnyRole(['admin', 'nailist']))
                                <div class="border-t border-gray-200 my-2"></div>
                                @if(auth()->user()->hasRole('admin'))
                                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-600 transition">
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                            </svg>
                                            Admin Dashboard
                                        </div>
                                    </a>
                                @endif
                                @if(auth()->user()->hasRole('nailist'))
                                    <a href="{{ route('nailist.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-pink-50 hover:text-pink-600 transition">
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            Nailist Dashboard
                                        </div>
                                    </a>
                                @endif
                            @endif

                            <!-- Logout -->
                            <div class="border-t border-gray-200 my-2"></div>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        Logout
                                    </div>
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Guest: Login & Register Buttons -->
                    <div class="flex items-center gap-3">
                        <a href="{{ route('register') }}" class="text-pink-600 hover:text-pink-700 font-semibold px-4 py-2 transition">
                            Register
                        </a>
                        <a href="{{ route('login') }}" class="bg-gradient-to-r from-pink-500 to-rose-500 hover:from-pink-600 hover:to-rose-600 text-white px-6 py-2 rounded-full font-semibold shadow-md hover:shadow-lg transition-all duration-300 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Login
                        </a>
                    </div>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <button class="lg:hidden text-pink-500" onclick="toggleMobileMenu()">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="lg:hidden mt-4 border-t border-pink-200 pt-4 hidden">
            <!-- Search Mobile -->
            <div class="mb-4">
                <div class="relative">
                    <input type="text" placeholder="Cari produk..."
                           class="w-full pl-4 pr-10 py-2 rounded-full border-2 border-pink-200 focus:border-pink-400 focus:outline-none focus:ring-2 focus:ring-pink-200 transition-all">
                    <button class="absolute right-3 top-1/2 transform -translate-y-1/2 text-pink-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Navigation Mobile -->
            <nav class="mb-4">
                <ul class="flex flex-col space-y-3">
                    <li><a href="{{ route('panduan') }}" class="block text-gray-700 hover:text-pink-500 font-medium py-2">Panduan</a></li>
                    <li><a href="{{ route('products.index') }}" class="block text-gray-700 hover:text-pink-500 font-medium py-2">Produk</a></li>
                    <li><a href="{{ route('measurements.index') }}" class="block text-gray-700 hover:text-pink-500 font-medium py-2">Riwayat</a></li>
                    <li><a href="#testimoni" class="block text-gray-700 hover:text-pink-500 font-medium py-2">Testimoni</a></li>
                </ul>
            </nav>

            <!-- Auth Section Mobile -->
            @auth
                <!-- User Info Mobile -->
                <div class="border-t border-pink-200 pt-4">
                    <div class="px-4 py-3 bg-pink-50 rounded-lg mb-3">
                        <p class="font-semibold text-gray-900">{{ auth()->user()->name }}</p>
                        <p class="text-sm text-gray-600">{{ auth()->user()->email }}</p>
                    </div>

                    <!-- Menu Items Mobile -->
                    <div class="flex flex-col space-y-2">
                        <a href="#" class="flex items-center gap-2 px-4 py-2 text-gray-700 hover:bg-pink-50 rounded-lg transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            My Profile
                        </a>

                        <a href="{{ route('measurements.index') }}" class="flex items-center gap-2 px-4 py-2 text-gray-700 hover:bg-pink-50 rounded-lg transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            My Measurements
                        </a>

                        <!-- Admin/Nailist Links -->
                        @if(auth()->user()->hasAnyRole(['admin', 'nailist']))
                            @if(auth()->user()->hasRole('admin'))
                                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-4 py-2 text-purple-700 hover:bg-purple-50 rounded-lg transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                    Admin Dashboard
                                </a>
                            @endif
                            @if(auth()->user()->hasRole('nailist'))
                                <a href="{{ route('nailist.dashboard') }}" class="flex items-center gap-2 px-4 py-2 text-pink-700 hover:bg-pink-50 rounded-lg transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    Nailist Dashboard
                                </a>
                            @endif
                        @endif

                        <!-- Logout -->
                        <form action="{{ route('logout') }}" method="POST" class="mt-2">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-2 px-4 py-2 text-red-600 hover:bg-red-50 rounded-lg transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <!-- Guest: Login & Register Mobile -->
                <div class="flex flex-col gap-3">
                    <a href="{{ route('register') }}" class="flex items-center justify-center gap-2 bg-white border-2 border-pink-500 text-pink-600 px-6 py-3 rounded-full font-semibold text-center shadow-md hover:bg-pink-50 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                        Register
                    </a>
                    <a href="{{ route('login') }}" class="flex items-center justify-center gap-2 bg-gradient-to-r from-pink-500 to-rose-500 hover:from-pink-600 hover:to-rose-600 text-white px-6 py-3 rounded-full font-semibold text-center shadow-md">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Login
                    </a>
                </div>
            @endauth
        </div>
    </div>
</header>

<script>
function toggleMobileMenu() {
    const menu = document.getElementById('mobileMenu');
    menu.classList.toggle('hidden');
}
</script>
