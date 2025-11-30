@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Metode Pembayaran</h1>
        <a href="{{ route('admin.payment-methods.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Metode
        </a>
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
            <h6 class="m-0 font-weight-bold text-primary">Daftar Metode Pembayaran</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Bank/Metode</th>
                            <th>Nomor Rekening/Tujuan</th>
                            <th>Atas Nama</th>
                            <th>Tipe</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($paymentMethods as $method)
                        <tr>
                            <td>{{ $method->name }}</td>
                            <td>{{ $method->number }}</td>
                            <td>{{ $method->holder }}</td>
                            <td>
                                @if($method->type == 'transfer')
                                    <span class="badge badge-primary">Transfer Bank</span>
                                @elseif($method->type == 'ewallet')
                                    <span class="badge badge-info">E-Wallet</span>
                                @else
                                    <span class="badge badge-secondary">COD</span>
                                @endif
                            </td>
                            <td>
                                @if($method->is_active)
                                    <span class="badge badge-success">Aktif</span>
                                @else
                                    <span class="badge badge-danger">Nonaktif</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.payment-methods.edit', $method) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.payment-methods.destroy', $method) }}" method="POST" class="d-inline" onsubmit="confirmDelete(event)">
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
