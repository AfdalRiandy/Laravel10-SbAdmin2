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
            @if($mainBanner->link)
                <a href="{{ $mainBanner->link }}" class="block w-full h-full">
                    <img src="{{ asset('storage/' . $mainBanner->image_path) }}" alt="{{ $mainBanner->title ?? 'Banner Utama' }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                </a>
            @else
                <img src="{{ asset('storage/' . $mainBanner->image_path) }}" alt="{{ $mainBanner->title ?? 'Banner Utama' }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
            @endif
        @else
            <img src="https://via.placeholder.com/800x400?text=Banner+Utama" alt="Banner Utama" class="w-full h-full object-cover">
        @endif
    </div>

    <!-- Side Banners -->
    <div class="flex flex-col gap-4 h-64 md:h-80">
        <!-- Side Top -->
        <div class="relative rounded-xl overflow-hidden flex-1 bg-gray-200 group">
            @if($sideTopBanner)
                <img src="{{ asset('storage/' . $sideTopBanner->image_path) }}" alt="{{ $sideTopBanner->title ?? 'Side Top' }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                @if($sideTopBanner->link)
                    <a href="{{ $sideTopBanner->link }}" class="absolute inset-0"></a>
                @endif
            @else
                <img src="https://via.placeholder.com/400x200?text=Side+Top" alt="Side Top" class="w-full h-full object-cover">
            @endif
        </div>

        <!-- Side Bottom -->
        <div class="relative rounded-xl overflow-hidden flex-1 bg-gray-200 group">
            @if($sideBottomBanner)
                <img src="{{ asset('storage/' . $sideBottomBanner->image_path) }}" alt="{{ $sideBottomBanner->title ?? 'Side Bottom' }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                @if($sideBottomBanner->link)
                    <a href="{{ $sideBottomBanner->link }}" class="absolute inset-0"></a>
                @endif
            @else
                <img src="https://via.placeholder.com/400x200?text=Side+Bottom" alt="Side Bottom" class="w-full h-full object-cover">
            @endif
        </div>
    </div>
</div>
