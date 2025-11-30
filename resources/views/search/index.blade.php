@extends('layouts.marketplace')

@section('content')
<div class="min-h-screen py-8 bg-gray-50">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex flex-col gap-8 md:flex-row">
            <!-- Sidebar Filters -->
            <div class="flex-shrink-0 w-full md:w-64">
                <div class="sticky p-6 bg-white rounded-lg shadow-sm top-24">
                    <h3 class="mb-4 font-bold text-gray-900">Filter</h3>
                    
                    <form action="{{ route('search.index') }}" method="GET">
                        <input type="hidden" name="q" value="{{ $query }}">
                        <input type="hidden" name="sort" value="{{ $sort }}">
                        
                        <div class="mb-6">
                            <h4 class="mb-2 text-sm font-medium text-gray-700">Kategori</h4>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="radio" name="category" value="" class="text-primary focus:ring-primary" {{ request('category') == '' ? 'checked' : '' }} onchange="this.form.submit()">
                                    <span class="ml-2 text-sm text-gray-600">Semua Kategori</span>
                                </label>
                                @foreach($categories as $category)
                                <label class="flex items-center">
                                    <input type="radio" name="category" value="{{ $category->id }}" class="text-primary focus:ring-primary" {{ request('category') == $category->id ? 'checked' : '' }} onchange="this.form.submit()">
                                    <span class="ml-2 text-sm text-gray-600">{{ $category->name }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Main Content -->
            <div class="flex-1">
                <div class="flex flex-col items-center justify-between p-4 mb-6 bg-white rounded-lg shadow-sm sm:flex-row">
                    <div class="mb-4 sm:mb-0">
                        <h1 class="text-lg font-bold text-gray-900">
                            @if($query)
                                Hasil pencarian untuk "{{ $query }}"
                            @else
                                Semua Produk
                            @endif
                        </h1>
                        <p class="text-sm text-gray-500">{{ $products->total() }} produk ditemukan</p>
                    </div>
                    
                    <div class="flex items-center">
                        <span class="mr-2 text-sm text-gray-600">Urutkan:</span>
                        <form action="{{ route('search.index') }}" method="GET">
                            <input type="hidden" name="q" value="{{ $query }}">
                            <input type="hidden" name="category" value="{{ $categoryId }}">
                            <select name="sort" class="text-sm border-gray-300 rounded-md focus:ring-primary focus:border-primary" onchange="this.form.submit()">
                                <option value="latest" {{ $sort == 'latest' ? 'selected' : '' }}>Terbaru</option>
                                <option value="price_asc" {{ $sort == 'price_asc' ? 'selected' : '' }}>Harga Terendah</option>
                                <option value="price_desc" {{ $sort == 'price_desc' ? 'selected' : '' }}>Harga Tertinggi</option>
                                <option value="oldest" {{ $sort == 'oldest' ? 'selected' : '' }}>Terlama</option>
                            </select>
                        </form>
                    </div>
                </div>

                @if($products->count() > 0)
                    <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                        @foreach($products as $product)
                            <x-product-card :product="$product" />
                        @endforeach
                    </div>
                    <div class="mt-8">
                        {{ $products->links() }}
                    </div>
                @else
                    <div class="p-12 text-center bg-white rounded-lg shadow-sm">
                        <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 text-gray-400 bg-gray-100 rounded-full">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <h3 class="mb-2 text-lg font-medium text-gray-900">Produk tidak ditemukan</h3>
                        <p class="text-gray-500">Coba gunakan kata kunci lain atau hapus filter kategori.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
