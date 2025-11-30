@extends('layouts.auth')

@section('content')
<div class="w-full max-w-4xl bg-white rounded-2xl shadow-xl overflow-hidden flex flex-col md:flex-row">
    <!-- Left Side: Illustration/Branding -->
    <div class="w-full md:w-1/2 bg-gradient-to-br from-primary to-primary-dark p-8 md:p-12 flex flex-col justify-center items-center text-white text-center relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full opacity-10">
            <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <path d="M0 100 C 20 0 50 0 100 100 Z" fill="white" />
            </svg>
        </div>
        
        <div class="relative z-10">
            <div class="mb-6 bg-white/20 p-4 rounded-full inline-block backdrop-blur-sm">
                <i class="fas fa-shopping-bag text-4xl"></i>
            </div>
            <h2 class="text-3xl font-bold mb-4">Selamat Datang Kembali!</h2>
            <p class="text-blue-100 mb-8">Masuk untuk mulai berbelanja atau mengelola toko Anda di MarketSekolah.</p>
            <div class="hidden md:block">
                <p class="text-sm text-blue-200">Belum punya akun?</p>
                <a href="{{ route('register') }}" class="inline-block mt-2 px-6 py-2 border-2 border-white rounded-full font-semibold hover:bg-white hover:text-primary transition duration-300">
                    Daftar Sekarang
                </a>
            </div>
        </div>
    </div>

    <!-- Right Side: Login Form -->
    <div class="w-full md:w-1/2 p-8 md:p-12 bg-white">
        <div class="text-center md:text-left mb-8">
            <h3 class="text-2xl font-bold text-gray-900">Masuk Akun</h3>
            <p class="text-gray-500 text-sm mt-1">Silakan masukkan email dan password Anda.</p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-50 rounded-lg border border-red-100">
                <div class="font-medium text-red-600 text-sm">Whoops! Ada masalah.</div>
                <ul class="mt-1 list-disc list-inside text-sm text-red-600">
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
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-envelope text-gray-400"></i>
                    </div>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                        class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 transition duration-200" 
                        placeholder="nama@sekolah.sch.id">
                </div>
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-lock text-gray-400"></i>
                    </div>
                    <input id="password" type="password" name="password" required autocomplete="current-password" 
                        class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 transition duration-200" 
                        placeholder="••••••••">
                </div>
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-primary shadow-sm focus:ring-primary" name="remember">
                    <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-primary hover:text-primary-dark font-medium" href="{{ route('password.request') }}">
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
