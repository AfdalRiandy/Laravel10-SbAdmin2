@props(['banners'])

@php
    $mainBanner = $banners->where('position', 'main')->first();
    $sideTopBanner = $banners->where('position', 'side_top')->first();
    $sideBottomBanner = $banners->where('position', 'side_bottom')->first();
@endphp

<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
    <!-- Main Banner -->
    <div class="md:col-span-2 relative rounded-xl overflow-hidden h-64 md:h-80 bg-gray-200 group">
        @if($mainBanner)
            <img src="{{ asset('storage/' . $mainBanner->image_path) }}" alt="{{ $mainBanner->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-6">
                <div>
                    <h2 class="text-white text-2xl font-bold mb-2">{{ $mainBanner->title }}</h2>
                    @if($mainBanner->description)
                        <p class="text-white/90 mb-4">{{ $mainBanner->description }}</p>
                    @endif
                    @if($mainBanner->link)
                        <a href="{{ $mainBanner->link }}" class="btn-primary inline-block">Lihat Detail</a>
                    @endif
                </div>
            </div>
        @else
            <img src="https://via.placeholder.com/800x400?text=Banner+Utama" alt="Banner Utama" class="w-full h-full object-cover">
        @endif
    </div>

    <!-- Side Banners -->
    <div class="flex flex-col gap-4 h-64 md:h-80">
        <!-- Side Top -->
        <div class="relative rounded-xl overflow-hidden flex-1 bg-gray-200 group">
            @if($sideTopBanner)
                <img src="{{ asset('storage/' . $sideTopBanner->image_path) }}" alt="{{ $sideTopBanner->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                @if($sideTopBanner->link)
                    <a href="{{ $sideTopBanner->link }}" class="absolute inset-0"></a>
                @endif
                <div class="absolute inset-0 bg-black/30 flex items-center justify-center pointer-events-none">
                    <span class="text-white font-bold text-lg">{{ $sideTopBanner->title }}</span>
                </div>
            @else
                <img src="https://via.placeholder.com/400x200?text=Side+Top" alt="Side Top" class="w-full h-full object-cover">
            @endif
        </div>

        <!-- Side Bottom -->
        <div class="relative rounded-xl overflow-hidden flex-1 bg-gray-200 group">
            @if($sideBottomBanner)
                <img src="{{ asset('storage/' . $sideBottomBanner->image_path) }}" alt="{{ $sideBottomBanner->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                @if($sideBottomBanner->link)
                    <a href="{{ $sideBottomBanner->link }}" class="absolute inset-0"></a>
                @endif
                <div class="absolute inset-0 bg-black/30 flex items-center justify-center pointer-events-none">
                    <span class="text-white font-bold text-lg">{{ $sideBottomBanner->title }}</span>
                </div>
            @else
                <img src="https://via.placeholder.com/400x200?text=Side+Bottom" alt="Side Bottom" class="w-full h-full object-cover">
            @endif
        </div>
    </div>
</div>
