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
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/global.css', 'resources/js/global.js'])
</head>
<body class="font-sans antialiased text-gray-800 bg-gray-50">
    <div class="flex flex-col min-h-screen">
        <!-- Navbar Minimal -->
        <nav class="sticky top-0 z-50 bg-white shadow-sm">
            <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <!-- Logo -->
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="flex items-center flex-shrink-0">
                            <span class="text-2xl font-bold text-primary">Market<span class="text-accent">Sekolah</span></span>
                        </a>
                    </div>

                    <!-- Right Menu -->
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('home') }}" class="text-sm font-medium text-gray-600 hover:text-primary">
                            <i class="mr-1 fas fa-home"></i> Beranda
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="flex items-center justify-center flex-grow px-4 py-12 sm:px-6 lg:px-8 bg-gray-50">
            @yield('content')
        </main>

        <!-- Footer Minimal -->
        <footer class="py-6 bg-white border-t">
            <div class="px-4 mx-auto text-center max-w-7xl sm:px-6 lg:px-8">
                <p class="text-sm text-gray-500">&copy; {{ date('Y') }} MarketSekolah. All rights reserved.</p>
            </div>
        </footer>
    </div>
</body>
</html>
