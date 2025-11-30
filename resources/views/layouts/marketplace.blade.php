<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Marketplace Sekolah') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/global.css', 'resources/js/global.js'])
</head>
<body class="font-sans antialiased text-gray-800 bg-background">
    <div class="flex flex-col min-h-screen">
        <!-- Navbar -->
        <nav class="sticky top-0 z-50 bg-white shadow-sm">
            <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <!-- Logo & Search -->
                    <div class="flex items-center flex-1">
                        <a href="{{ route('home') }}" class="flex items-center flex-shrink-0">
                            <span class="text-2xl font-bold text-primary">Market<span class="text-accent">Sekolah</span></span>
                        </a>
                        
                        <!-- Search Bar -->
                        <div class="flex-1 hidden max-w-lg sm:ml-6 sm:flex sm:space-x-8">
                            <form action="{{ route('search.index') }}" method="GET" class="relative w-full">
                                <input type="text" name="q" value="{{ request('q') }}" class="w-full pl-4 pr-10 border-gray-300 rounded-full focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" placeholder="Cari produk...">
                                <button type="submit" class="absolute top-0 right-0 mt-2 mr-3 text-gray-400 hover:text-primary">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Right Menu -->
                    <div class="flex items-center ml-4 space-x-4">
                        <!-- Cart -->
                        <a href="{{ route('cart.index') }}" class="relative p-2 text-gray-600 hover:text-primary">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            @auth
                                @if(auth()->user()->cart && auth()->user()->cart->items->count() > 0)
                                    <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform bg-red-600 rounded-full translate-x-1/4 -translate-y-1/4">{{ auth()->user()->cart->items->count() }}</span>
                                @endif
                            @endauth
                        </a>

                        <!-- Auth Links -->
                        @guest
                            <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 hover:text-primary">Masuk</a>
                            <a href="{{ route('register') }}" class="text-sm font-medium btn-primary">Daftar</a>
                        @else
                            <div class="relative ml-3" x-data="{ open: false }">
                                <div>
                                    <button @click="open = !open" type="button" class="flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                        <span class="sr-only">Open user menu</span>
                                        <div class="flex items-center justify-center w-8 h-8 font-bold text-white rounded-full bg-primary">
                                            {{ substr(Auth::user()->name, 0, 1) }}
                                        </div>
                                    </button>
                                </div>
                                <div x-show="open" @click.away="open = false" class="absolute right-0 w-48 py-1 mt-2 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1" style="display: none;">
                                    <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Dashboard</a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="block w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-100" role="menuitem">Keluar</button>
                                    </form>
                                </div>
                            </div>
                        @endguest
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="flex-grow">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="mt-12 bg-white border-t">
            <div class="px-4 py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                    <div>
                        <h3 class="mb-4 text-lg font-bold text-primary">MarketSekolah</h3>
                        <p class="text-sm text-gray-500">Platform jual beli karya siswa SMK. Dukung kreativitas siswa dengan membeli produk lokal berkualitas.</p>
                    </div>
                    <div>
                        <h3 class="mb-4 text-sm font-semibold tracking-wider text-gray-400 uppercase">Kategori</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-base text-gray-500 hover:text-primary">Makanan & Minuman</a></li>
                            <li><a href="#" class="text-base text-gray-500 hover:text-primary">Kerajinan Tangan</a></li>
                            <li><a href="#" class="text-base text-gray-500 hover:text-primary">Jasa Desain</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="mb-4 text-sm font-semibold tracking-wider text-gray-400 uppercase">Bantuan</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-base text-gray-500 hover:text-primary">Cara Belanja</a></li>
                            <li><a href="#" class="text-base text-gray-500 hover:text-primary">Konfirmasi Pembayaran</a></li>
                            <li><a href="#" class="text-base text-gray-500 hover:text-primary">Hubungi Kami</a></li>
                        </ul>
                    </div>
                </div>
                <div class="pt-8 mt-8 text-center border-t border-gray-200">
                    <p class="text-base text-gray-400">&copy; {{ date('Y') }} MarketSekolah. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
