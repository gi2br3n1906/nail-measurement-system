<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Your Role - NailPerfect</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-pink-50 via-purple-50 to-pink-100 min-h-screen">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="max-w-4xl w-full">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-gray-800 mb-2">Welcome Back, {{ $user->name }}! 👋</h1>
                <p class="text-gray-600">Please select which role you'd like to access</p>
            </div>

            @if(session('error'))
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Role Cards -->
            <div class="grid md:grid-cols-2 gap-6">
                @if($user->hasRole('admin'))
                <!-- Admin Card -->
                <form action="{{ route('role.select') }}" method="POST">
                    @csrf
                    <input type="hidden" name="role" value="admin">
                    <button type="submit" class="w-full group hover:scale-105 transition-all duration-300">
                        <div class="bg-white rounded-2xl shadow-lg p-8 border-2 border-transparent hover:border-purple-400 hover:shadow-2xl transition-all">
                            <!-- Icon -->
                            <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>

                            <!-- Content -->
                            <h2 class="text-2xl font-bold text-gray-800 mb-3">Admin Panel</h2>
                            <p class="text-gray-600 mb-6">Manage system settings, users, and content moderation</p>

                            <!-- Features -->
                            <div class="space-y-2 text-left mb-6">
                                <div class="flex items-center text-sm text-gray-700">
                                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Dashboard & Analytics
                                </div>
                                <div class="flex items-center text-sm text-gray-700">
                                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Manage Nailists & Catalogs
                                </div>
                                <div class="flex items-center text-sm text-gray-700">
                                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    System Configuration
                                </div>
                            </div>

                            <!-- Button -->
                            <div class="bg-gradient-to-r from-purple-500 to-pink-500 text-white font-semibold py-3 px-6 rounded-lg group-hover:from-purple-600 group-hover:to-pink-600 transition-colors">
                                Access Admin Panel →
                            </div>
                        </div>
                    </button>
                </form>
                @endif

                @if($user->hasRole('nailist'))
                <!-- Nailist Card -->
                <form action="{{ route('role.select') }}" method="POST">
                    @csrf
                    <input type="hidden" name="role" value="nailist">
                    <button type="submit" class="w-full group hover:scale-105 transition-all duration-300">
                        <div class="bg-white rounded-2xl shadow-lg p-8 border-2 border-transparent hover:border-pink-400 hover:shadow-2xl transition-all">
                            <!-- Icon -->
                            <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-pink-400 to-rose-500 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                                </svg>
                            </div>

                            <!-- Content -->
                            <h2 class="text-2xl font-bold text-gray-800 mb-3">Nailist Panel</h2>
                            <p class="text-gray-600 mb-6">Manage your nail art catalog and customer reviews</p>

                            <!-- Features -->
                            <div class="space-y-2 text-left mb-6">
                                <div class="flex items-center text-sm text-gray-700">
                                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    My Catalog Dashboard
                                </div>
                                <div class="flex items-center text-sm text-gray-700">
                                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Upload & Edit Designs
                                </div>
                                <div class="flex items-center text-sm text-gray-700">
                                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    View Statistics & Reviews
                                </div>
                            </div>

                            <!-- Button -->
                            <div class="bg-gradient-to-r from-pink-400 to-rose-500 text-white font-semibold py-3 px-6 rounded-lg group-hover:from-pink-500 group-hover:to-rose-600 transition-colors">
                                Access Nailist Panel →
                            </div>
                        </div>
                    </button>
                </form>
                @endif
            </div>

            <!-- Back to Website -->
            <div class="text-center mt-8">
                <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-800 font-medium inline-flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to Website
                </a>
            </div>
        </div>
    </div>
</body>
</html>
