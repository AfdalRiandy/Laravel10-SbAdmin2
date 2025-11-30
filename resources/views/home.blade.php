@extends('layouts.marketplace')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Banner -->
    <x-banner-grid />

    <!-- Categories -->
    <div class="mb-12">
        <h2 class="text-xl font-bold text-gray-800 mb-6">Kategori Pilihan</h2>
        <div class="grid grid-cols-2 md:grid-cols-5 lg:grid-cols-10 gap-4">
            @foreach($categories as $category)
                <a href="{{ route('category.show', $category->slug) }}" class="flex flex-col items-center justify-center p-4 bg-white rounded-lg shadow-sm hover:shadow-md transition border border-gray-100 group">
                    <div class="w-10 h-10 bg-blue-50 rounded-full flex items-center justify-center text-primary mb-2 group-hover:bg-primary group-hover:text-white transition">
                        <i class="{{ $category->icon ?? 'fas fa-box' }}"></i>
                    </div>
                    <span class="text-xs font-medium text-center text-gray-600 group-hover:text-primary">{{ $category->name }}</span>
                </a>
            @endforeach
        </div>
    </div>

    <!-- Latest Products -->
    <div class="mb-12">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-gray-800">Produk Terbaru</h2>
            <a href="#" class="text-primary text-sm font-medium hover:underline">Lihat Semua</a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
            @foreach($products as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>
    </div>
</div>
@endsection
