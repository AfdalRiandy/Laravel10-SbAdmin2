@extends('layouts.auth')

@section('content')
<div class="flex flex-col w-full max-w-4xl overflow-hidden bg-white shadow-xl rounded-2xl md:flex-row">
    <!-- Left Side: Illustration/Branding -->
    <div class="relative flex flex-col items-center justify-center w-full p-8 overflow-hidden text-center text-white md:w-1/2 bg-gradient-to-br from-primary to-primary-dark md:p-12">
        <div class="absolute top-0 left-0 w-full h-full opacity-10">
            <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <path d="M0 100 C 20 0 50 0 100 100 Z" fill="white" />
            </svg>
        </div>
        
        <div class="relative z-10">
            <div class="inline-block p-4 mb-6 rounded-full bg-white/20 backdrop-blur-sm">
                <i class="text-4xl fas fa-shopping-bag"></i>
            </div>
            <h2 class="mb-4 text-3xl font-bold">Selamat Datang Kembali!</h2>
            <p class="mb-8 text-blue-100">Masuk untuk mulai berbelanja atau mengelola toko Anda di MarketSekolah.</p>
            <div class="hidden md:block">
                <p class="text-sm text-blue-200">Belum punya akun?</p>
                <a href="{{ route('register') }}" class="inline-block px-6 py-2 mt-2 font-semibold transition duration-300 border-2 border-white rounded-full hover:bg-white hover:text-primary">
                    Daftar Sekarang
                </a>
            </div>
        </div>
    </div>

    <!-- Right Side: Login Form -->
    <div class="w-full p-8 bg-white md:w-1/2 md:p-12">
        <div class="mb-8 text-center md:text-left">
            <h3 class="text-2xl font-bold text-gray-900">Masuk Akun</h3>
            <p class="mt-1 text-sm text-gray-500">Silakan masukkan email dan password Anda.</p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="mb-4 text-sm font-medium text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="p-4 mb-4 border border-red-100 rounded-lg bg-red-50">
                <div class="text-sm font-medium text-red-600">Whoops! Ada masalah.</div>
                <ul class="mt-1 text-sm text-red-600 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block mb-1 text-sm font-medium text-gray-700">Email</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i class="text-gray-400 fas fa-envelope"></i>
                    </div>
                    <input id="email" type="email" name="credential" value="{{ old('credential') }}" required autofocus autocomplete="username" 
                        class="block w-full pl-10 transition duration-200 border-gray-300 rounded-lg shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" 
                        placeholder="nama@sekolah.sch.id">
                </div>
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block mb-1 text-sm font-medium text-gray-700">Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i class="text-gray-400 fas fa-lock"></i>
                    </div>
                    <input id="password" type="password" name="password" required autocomplete="current-password" 
                        class="block w-full pl-10 transition duration-200 border-gray-300 rounded-lg shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" 
                        placeholder="••••••••">
                </div>
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="border-gray-300 rounded shadow-sm text-primary focus:ring-primary" name="remember">
                    <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm font-medium text-primary hover:text-primary-dark" href="{{ route('password.request') }}">
                        Lupa password?
                    </a>
                @endif
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition duration-300 transform hover:-translate-y-0.5">
                Masuk Sekarang
            </button>

            <!-- Mobile Register Link -->
            <div class="mt-6 text-center md:hidden">
                <p class="text-sm text-gray-600">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="font-medium text-primary hover:text-primary-dark">
                        Daftar Sekarang
                    </a>
                </p>
            </div>
        </form>
    </div>
</div>
@endsection
