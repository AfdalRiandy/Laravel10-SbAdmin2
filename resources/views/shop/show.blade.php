@extends('layouts.marketplace')

@section('content')
<div class="bg-gray-100 min-h-screen pb-12">
    <!-- Shop Header -->
    <div class="bg-white shadow-sm mb-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col md:flex-row items-start md:items-center gap-6">
                <!-- Shop Avatar & Basic Info -->
                <div class="flex items-center gap-4 flex-1">
                    <div class="relative">
                        @if($seller->penjualProfile->shop_photo)
                            <img src="{{ asset('storage/' . $seller->penjualProfile->shop_photo) }}" alt="{{ $seller->penjualProfile->shop_name }}" class="w-20 h-20 rounded-full object-cover border-2 border-gray-200">
                        @else
                            <div class="w-20 h-20 rounded-full bg-gray-200 flex items-center justify-center text-2xl font-bold text-gray-500 border-2 border-gray-200">
                                {{ substr($seller->penjualProfile->shop_name ?? $seller->name, 0, 1) }}
                            </div>
                        @endif
                        @if($seller->penjualProfile->status_verifikasi == 'verified')
                            <div class="absolute bottom-0 right-0 bg-blue-500 text-white p-1 rounded-full border-2 border-white" title="Terverifikasi">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">{{ $seller->penjualProfile->shop_name ?? $seller->name }}</h1>
                        <div class="flex items-center gap-2 text-sm text-gray-500 mt-1">
                            <span>{{ $seller->penjualProfile->kelas ?? 'Siswa' }}</span>
                            <span>•</span>
                            <span>{{ $seller->penjualProfile->jurusan ?? 'Umum' }}</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-500 mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>{{ $seller->penjualProfile->alamat_toko ?? 'Lokasi tidak tersedia' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Shop Stats -->
                <div class="flex gap-8 border-l pl-8 border-gray-200">
                    <div class="text-center">
                        <div class="text-lg font-bold text-gray-900">{{ $products->total() }}</div>
                        <div class="text-sm text-gray-500">Produk</div>
                    </div>
                    <div class="text-center">
                        <div class="text-lg font-bold text-gray-900">{{ $seller->created_at->diffForHumans() }}</div>
                        <div class="text-sm text-gray-500">Bergabung</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Sidebar Info -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-sm p-6 sticky top-24">
                    <h3 class="font-bold text-gray-900 mb-4">Tentang Toko</h3>
                    <p class="text-gray-600 text-sm leading-relaxed mb-6">
                        {{ $seller->penjualProfile->deskripsi_toko ?? 'Tidak ada deskripsi toko.' }}
                    </p>
                    
                    <div class="border-t pt-4">
                        <h4 class="font-bold text-gray-900 text-sm mb-3">Hubungi Penjual</h4>
                        @if($seller->penjualProfile->phone)
                            <a href="https://wa.me/{{ $seller->penjualProfile->phone }}" target="_blank" class="flex items-center gap-2 text-green-600 hover:text-green-700 text-sm font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" clip-rule="evenodd" />
                                </svg>
                                Chat via WhatsApp
                            </a>
                        @else
                            <span class="text-gray-400 text-sm">Kontak tidak tersedia</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="lg:col-span-3">
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-bold text-gray-900">Semua Produk</h2>
                        <div class="text-sm text-gray-500">Menampilkan {{ $products->count() }} dari {{ $products->total() }} produk</div>
                    </div>

                    @if($products->count() > 0)
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            @foreach($products as $product)
                                <x-product-card :product="$product" />
                            @endforeach
                        </div>
                        <div class="mt-8">
                            {{ $products->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                            <p class="text-gray-500">Belum ada produk yang ditampilkan.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
