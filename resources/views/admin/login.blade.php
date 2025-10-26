<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Nail Measurement System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-gray-100 via-gray-50 to-gray-100 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md px-4">
        <!-- Login Card -->
        <div class="bg-white rounded-3xl shadow-2xl p-8 lg:p-12">
            <!-- Logo/Header -->
            <div class="text-center mb-8">
                <div class="inline-block bg-gradient-to-br from-pink-500 to-purple-600 p-4 rounded-2xl mb-4">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-['Playfair_Display'] font-bold text-gray-800 mb-2">Login</h1>
                <p class="text-gray-600">Admin & Nailist Portal</p>
            </div>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                        <div>
                            @foreach ($errors->all() as $error)
                                <p class="text-red-700 text-sm">{{ $error }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('admin.authenticate') }}">
                @csrf

                <!-- Email -->
                <div class="mb-6">
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                    <input type="email"
                           id="email"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           autofocus
                           class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-pink-500 focus:ring-2 focus:ring-pink-200 outline-none transition-all duration-300"
                           placeholder="admin@nailperfect.com">
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                    <input type="password"
                           id="password"
                           name="password"
                           required
                           class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-pink-500 focus:ring-2 focus:ring-pink-200 outline-none transition-all duration-300"
                           placeholder="••••••••">
                </div>

                <!-- Remember Me -->
                <div class="flex items-center mb-6">
                    <input type="checkbox"
                           id="remember"
                           name="remember"
                           class="w-4 h-4 text-pink-500 border-gray-300 rounded focus:ring-pink-500">
                    <label for="remember" class="ml-2 text-sm text-gray-600">Remember me</label>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                        class="w-full bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white font-bold py-4 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                    <svg class="inline-block w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                    </svg>
                    Login
                </button>
            </form>

            <!-- Back to Home -->
            <div class="text-center mt-6">
                <a href="{{ route('home') }}" class="text-sm text-pink-600 hover:text-pink-700 font-semibold">
                    ← Back to Website
                </a>
            </div>

            <!-- Test Credentials -->
            <div class="mt-8 p-4 bg-gray-50 rounded-xl border border-gray-200">
                <p class="text-xs text-gray-600 font-semibold mb-2">Test Credentials:</p>
                <div class="space-y-1">
                    <p class="text-xs text-gray-700"><strong>Admin:</strong> <span class="font-mono bg-white px-2 py-1 rounded">admin@nailperfect.com</span> / <span class="font-mono bg-white px-2 py-1 rounded">admin123</span></p>
                    <p class="text-xs text-gray-700"><strong>Nailist:</strong> <span class="font-mono bg-white px-2 py-1 rounded">bella@nailperfect.com</span> / <span class="font-mono bg-white px-2 py-1 rounded">nailist123</span></p>
                    <p class="text-xs text-gray-700"><strong>Both:</strong> <span class="font-mono bg-white px-2 py-1 rounded">sarah@nailperfect.com</span> / <span class="font-mono bg-white px-2 py-1 rounded">admin123</span></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
