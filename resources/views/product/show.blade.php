@extends('layouts.marketplace')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
        <div class="grid grid-cols-1 md:grid-cols-2">
            <!-- Image Gallery -->
            <div class="p-6 bg-gray-50">
                <div class="aspect-w-1 aspect-h-1 rounded-lg overflow-hidden mb-4">
                    @php
                        $primaryImage = $product->images->where('is_primary', true)->first() ?? $product->images->first();
                        $initialImage = $primaryImage ? asset('storage/' . $primaryImage->image_path) : 'https://via.placeholder.com/600';
                    @endphp
                    <img id="main-image" src="{{ $initialImage }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                </div>
                <div class="grid grid-cols-4 gap-2">
                    @foreach($product->images as $image)
                        <div class="aspect-w-1 aspect-h-1 rounded-lg overflow-hidden cursor-pointer border-2 border-transparent hover:border-primary thumbnail-container {{ $image->is_primary ? 'border-primary' : '' }}" 
                             onclick="changeImage('{{ asset('storage/' . $image->image_path) }}', this)">
                            <img src="{{ asset('storage/' . $image->image_path) }}" class="w-full h-full object-cover">
                        </div>
                    @endforeach
                </div>
            </div>

            <script>
                function changeImage(src, element) {
                    document.getElementById('main-image').src = src;
                    // Remove active class from all thumbnails
                    document.querySelectorAll('.thumbnail-container').forEach(el => {
                        el.classList.remove('border-primary');
                    });
                    // Add active class to clicked thumbnail
                    element.classList.add('border-primary');
                }
            </script>

            <!-- Product Details -->
            <div class="p-8">
                <div class="mb-4">
                    <a href="{{ route('category.show', $product->category->slug) }}" class="text-sm text-primary font-medium hover:underline">
                        {{ $product->category->name }}
                    </a>
                    <h1 class="text-3xl font-bold text-gray-900 mt-1">{{ $product->name }}</h1>
                </div>

                <div class="flex items-center mb-6">
                    <div class="flex items-center mr-4">
                        <x-rating-stars :rating="4" />
                        <span class="ml-2 text-sm text-gray-500">(10 Reviews)</span>
                    </div>
                    <div class="text-sm text-gray-500 border-l pl-4">
                        Terjual <span class="font-semibold text-gray-900">50+</span>
                    </div>
                </div>

                <div class="mb-8">
                    <span class="text-4xl font-bold text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                </div>

                <div class="border-t border-b py-6 mb-8">
                    <a href="{{ route('shop.show', $product->user->id) }}" class="flex items-center mb-4 hover:bg-gray-50 p-2 rounded-lg transition -mx-2">
                        <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center text-xl font-bold text-gray-500 mr-4 overflow-hidden">
                            @if($product->user->penjualProfile && $product->user->penjualProfile->shop_photo)
                                <img src="{{ asset('storage/' . $product->user->penjualProfile->shop_photo) }}" alt="{{ $product->user->penjualProfile->shop_name }}" class="w-full h-full object-cover">
                            @else
                                {{ substr($product->user->penjualProfile->shop_name ?? $product->user->name, 0, 1) }}
                            @endif
                        </div>
                        <div>
                            <div class="font-bold text-gray-900">{{ $product->user->penjualProfile->shop_name ?? $product->user->name }}</div>
                            <div class="text-sm text-gray-500">{{ $product->user->penjualProfile->jurusan ?? 'Siswa SMK' }}</div>
                        </div>
                        <div class="ml-auto text-primary text-sm font-medium">
                            Kunjungi Toko >
                        </div>
                    </a>
                </div>

                <form action="{{ route('cart.store') }}" method="POST" class="flex items-center space-x-4">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="w-32">
                        <label for="quantity" class="sr-only">Quantity</label>
                        <input type="number" name="quantity" id="quantity" min="1" max="{{ $product->stock }}" value="1" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
                    </div>
                    <button type="submit" class="flex-1 bg-primary text-white px-8 py-3 rounded-lg font-bold hover:bg-primary-dark transition flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        Masukkan Keranjang
                    </button>
                </form>
            </div>
        </div>

        <!-- Description & Reviews -->
        <div class="border-t bg-gray-50 p-8">
            <h3 class="text-xl font-bold text-gray-900 mb-4">Deskripsi Produk</h3>
            <div class="prose max-w-none text-gray-600 mb-8">
                {!! nl2br(e($product->description)) !!}
            </div>
        </div>
    </div>

    <!-- Related Products -->
    <div class="mt-12">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Produk Terkait</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach($relatedProducts as $related)
                <x-product-card :product="$related" />
            @endforeach
        </div>
    </div>
</div>
@endsection
