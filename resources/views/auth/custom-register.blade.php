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
                <i class="fas fa-user-plus text-4xl"></i>
            </div>
            <h2 class="text-3xl font-bold mb-4">Bergabung Bersama Kami!</h2>
            <p class="text-blue-100 mb-8">Buat akun sekarang untuk mulai berjualan atau berbelanja produk kreatif siswa SMK.</p>
            <div class="hidden md:block">
                <p class="text-sm text-blue-200">Sudah punya akun?</p>
                <a href="{{ route('login') }}" class="inline-block mt-2 px-6 py-2 border-2 border-white rounded-full font-semibold hover:bg-white hover:text-primary transition duration-300">
                    Masuk Sekarang
                </a>
            </div>
        </div>
    </div>

    <!-- Right Side: Register Form -->
    <div class="w-full md:w-1/2 p-8 md:p-12 bg-white">
        <div class="text-center md:text-left mb-8">
            <h3 class="text-2xl font-bold text-gray-900">Buat Akun Baru</h3>
            <p class="text-gray-500 text-sm mt-1">Lengkapi data diri Anda untuk mendaftar.</p>
        </div>

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

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-user text-gray-400"></i>
                    </div>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" 
                        class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 transition duration-200" 
                        placeholder="Nama Lengkap Anda">
                </div>
            </div>

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-envelope text-gray-400"></i>
                    </div>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" 
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
                    <input id="password" type="password" name="password" required autocomplete="new-password" 
                        class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 transition duration-200" 
                        placeholder="••••••••">
                </div>
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-lock text-gray-400"></i>
                    </div>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" 
                        class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 transition duration-200" 
                        placeholder="••••••••">
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition duration-300 transform hover:-translate-y-0.5 mt-6">
                Daftar Sekarang
            </button>

            <!-- Mobile Login Link -->
            <div class="mt-6 text-center md:hidden">
                <p class="text-sm text-gray-600">
                    Sudah punya akun? 
                    <a href="{{ route('login') }}" class="font-medium text-primary hover:text-primary-dark">
                        Masuk Sekarang
                    </a>
                </p>
            </div>
        </form>
    </div>
</div>
@endsection
