@props(['shop'])

<div class="bg-white rounded-lg shadow-sm border border-gray-100 p-4 flex flex-col items-center text-center hover:shadow-md transition h-full">
    <div class="w-16 h-16 rounded-full bg-gray-200 flex items-center justify-center text-2xl font-bold text-gray-500 mb-3 overflow-hidden">
        @if($shop->penjualProfile && $shop->penjualProfile->shop_photo)
            <img 
                src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" 
                data-src="{{ asset('storage/' . $shop->penjualProfile->shop_photo) }}" 
                alt="{{ $shop->penjualProfile->shop_name }}" 
                loading="lazy"
                class="w-full h-full object-cover lazy-load"
            >
        @else
            {{ substr($shop->penjualProfile->shop_name ?? $shop->name, 0, 1) }}
        @endif
    </div>
    
    <h3 class="font-bold text-gray-900 mb-1 line-clamp-1">{{ $shop->penjualProfile->shop_name ?? $shop->name }}</h3>
    <p class="text-xs text-gray-500 mb-3 line-clamp-1">{{ $shop->penjualProfile->alamat_toko ?? 'Lokasi tidak tersedia' }}</p>
    
    <div class="flex items-center justify-center space-x-4 text-xs text-gray-600 mb-4 w-full">
        <div class="flex flex-col">
            <span class="font-bold text-gray-900">{{ $shop->active_products_count ?? 0 }}</span>
            <span>Produk</span>
        </div>
        <div class="w-px h-8 bg-gray-200"></div>
        <div class="flex flex-col">
            <span class="font-bold text-gray-900">{{ $shop->total_sold ?? 0 }}</span>
            <span>Terjual</span>
        </div>
    </div>
    
    <a href="{{ route('shop.show', $shop->id) }}" class="w-full py-2 px-4 bg-white border border-primary text-primary rounded-lg text-sm font-medium hover:bg-primary hover:text-white transition mt-auto">
        Kunjungi Toko
    </a>
</div>
