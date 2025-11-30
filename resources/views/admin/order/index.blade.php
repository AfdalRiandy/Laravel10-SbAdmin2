@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manajemen Pesanan</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Pesanan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Invoice</th>
                            <th>Pembeli</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->invoice_number }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td>
                                @switch($order->status)
                                    @case('pending')
                                        <span class="badge badge-warning">Pending</span>
                                        @break
                                    @case('paid')
                                        <span class="badge badge-info">Dibayar</span>
                                        @break
                                    @case('shipped')
                                        <span class="badge badge-primary">Dikirim</span>
                                        @break
                                    @case('completed')
                                        <span class="badge badge-success">Selesai</span>
                                        @break
                                    @case('cancelled')
                                        <span class="badge badge-danger">Dibatalkan</span>
                                        @break
                                @endswitch
                            </td>
                            <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" class="d-inline" onsubmit="confirmDelete(event)">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
