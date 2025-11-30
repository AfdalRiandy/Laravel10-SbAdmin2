@props(['product'])

<div class="card-product bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100 h-full flex flex-col">
    <a href="{{ route('product.show', $product->slug) }}" class="block relative group">
        @php
            $primaryImage = $product->images->where('is_primary', true)->first() ?? $product->images->first();
            $imageUrl = $primaryImage ? asset('storage/' . $primaryImage->image_path) : 'https://via.placeholder.com/300';
        @endphp
        <img src="{{ $imageUrl }}" alt="{{ $product->name }}" class="w-full ratio-1-1 object-cover group-hover:opacity-90 transition">
        @if($product->stock < 1)
            <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                <span class="text-white font-bold px-3 py-1 bg-red-600 rounded">Habis</span>
            </div>
        @endif
    </a>
    <div class="p-4 flex flex-col flex-grow">
        <div class="text-xs text-gray-500 mb-1">{{ $product->category->name }}</div>
        <a href="{{ route('product.show', $product->slug) }}" class="text-sm font-semibold text-gray-800 hover:text-primary line-clamp-2 mb-2 flex-grow">
            {{ $product->name }}
        </a>
        <div class="flex items-center mb-2">
            <x-rating-stars :rating="4" /> <span class="text-xs text-gray-400 ml-1">(10)</span>
        </div>
        <div class="flex items-center justify-between mt-auto">
            <span class="text-primary font-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
            <div class="text-xs text-gray-500 flex items-center">
                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                {{ $product->user->penjualProfile->alamat_toko ?? 'Sekolah' }}
            </div>
        </div>
    </div>
</div>
