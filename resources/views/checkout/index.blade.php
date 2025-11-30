@extends('layouts.marketplace')

@section('content')
<div class="px-4 py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <h1 class="mb-8 text-2xl font-bold text-gray-900">Checkout</h1>

    <form action="{{ route('checkout.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 gap-8 lg:grid-cols-3">
        @csrf
        <div class="space-y-8 lg:col-span-2">
            <!-- Shipping Address -->
            <div class="p-6 bg-white border border-gray-100 rounded-lg shadow-sm">
                <h2 class="mb-4 text-lg font-bold text-gray-900">Alamat Pengiriman</h2>
                <div>
                    <label for="shipping_address" class="block text-sm font-medium text-gray-700">Alamat Lengkap</label>
                    <textarea id="shipping_address" name="shipping_address" rows="3" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary focus:ring-primary sm:text-sm" required></textarea>
                </div>
            </div>

            <!-- Order Items -->
            <div class="p-6 bg-white border border-gray-100 rounded-lg shadow-sm">
                <h2 class="mb-4 text-lg font-bold text-gray-900">Rincian Pesanan</h2>
                <ul class="divide-y divide-gray-200">
                    @foreach($cart->items as $item)
                        <li class="flex py-4">
                            <img class="object-cover w-16 h-16 rounded" src="https://via.placeholder.com/100" alt="{{ $item->product->name }}">
                            <div class="flex-1 ml-4">
                                <div class="flex justify-between">
                                    <h3 class="text-sm font-medium text-gray-900">{{ $item->product->name }}</h3>
                                    <p class="text-sm font-bold text-gray-900">Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</p>
                                </div>
                                <p class="text-sm text-gray-500">{{ $item->quantity }} x Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="space-y-8 lg:col-span-1">
            <!-- Payment -->
            <div class="p-6 bg-white border border-gray-100 rounded-lg shadow-sm">
                <h2 class="mb-4 text-lg font-bold text-gray-900">Pembayaran</h2>
                <div class="p-4 mb-4 rounded-lg bg-blue-50">
                    <p class="text-sm font-medium text-blue-800">Transfer Manual</p>
                    <p class="mt-1 text-xs text-blue-600">Silakan transfer ke rekening berikut:</p>
                    <p class="mt-2 text-sm font-bold text-blue-900">BCA 1234567890 a.n Sekolah</p>
                </div>
                
                <div class="mb-4">
                    <label for="payment_proof" class="block text-sm font-medium text-gray-700">Upload Bukti Transfer</label>
                    <input type="file" id="payment_proof" name="payment_proof" class="block w-full mt-1 text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-primary hover:file:bg-blue-100" required>
                </div>

                <div class="pt-4 border-t">
                    <div class="flex justify-between mb-2">
                        <span class="text-gray-600">Total Tagihan</span>
                        <span class="text-xl font-bold text-primary">Rp {{ number_format($cart->items->sum(fn($item) => $item->product->price * $item->quantity), 0, ',', '.') }}</span>
                    </div>
                    <button type="submit" class="w-full px-4 py-3 mt-4 font-bold text-white transition rounded-lg bg-primary hover:bg-primary-dark">
                        Bayar Sekarang
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
