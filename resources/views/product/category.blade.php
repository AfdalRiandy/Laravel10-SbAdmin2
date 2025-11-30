@extends('layouts.marketplace')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $category->name }}</h1>
        <p class="text-gray-500">Menampilkan produk dalam kategori {{ $category->name }}</p>
    </div>

    @if($products->count() > 0)
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
            @foreach($products as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>
        <div class="mt-8">
            {{ $products->links() }}
        </div>
    @else
        <div class="text-center py-12">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
            <h3 class="text-lg font-medium text-gray-900">Belum ada produk</h3>
            <p class="text-gray-500">Kategori ini belum memiliki produk.</p>
        </div>
    @endif
</div>
@endsection
