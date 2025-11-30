@extends('pembeli.layouts.app')
@section('title', 'Pesanan Saya')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Pesanan Saya</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            @if($orders->isEmpty())
                <div class="text-center py-5">
                    <h5 class="text-gray-600">Belum ada pesanan aktif</h5>
                    <a href="{{ route('home') }}" class="btn btn-primary mt-3">Mulai Belanja</a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID Pesanan</th>
                                <th>Tanggal</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td>#{{ $order->id }}</td>
                                <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                                <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                <td>
                                    <span class="badge badge-{{ $order->status == 'pending' ? 'warning' : ($order->status == 'processing' ? 'info' : 'primary') }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
