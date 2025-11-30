@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Laporan Penjual</h1>
    </div>

    <!-- Summary -->
    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Penjual</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalSellers }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-store fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Penjual Terverifikasi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $verifiedSellers }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Menunggu Verifikasi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pendingVerification }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Sellers -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Penjual Terbaik</h6>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach($topSellers as $index => $seller)
                <div class="col-md-4 mb-3">
                    <div class="card {{ $index == 0 ? 'border-warning' : '' }}">
                        <div class="card-body text-center">
                            @if($index == 0)
                                <i class="fas fa-crown fa-2x text-warning mb-2"></i>
                            @endif
                            <h5 class="card-title">{{ $seller->name }}</h5>
                            <p class="card-text">
                                <span class="badge badge-primary">{{ $seller->penjualProfile->shop_name ?? 'Belum ada nama toko' }}</span>
                            </p>
                            <p class="text-muted">
                                Total Penjualan: Rp {{ number_format($seller->total_sales ?? 0, 0, ',', '.') }}
                            </p>
                            <p class="text-muted">
                                Produk: {{ $seller->products_count ?? 0 }}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- All Sellers -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Semua Penjual</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Nama Toko</th>
                            <th>Jurusan</th>
                            <th>Kelas</th>
                            <th>Jumlah Produk</th>
                            <th>Status</th>
                            <th>Bergabung</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sellers as $seller)
                        <tr>
                            <td>{{ $seller->name }}</td>
                            <td>{{ $seller->penjualProfile->shop_name ?? '-' }}</td>
                            <td>{{ $seller->penjualProfile->jurusan ?? '-' }}</td>
                            <td>{{ $seller->penjualProfile->kelas ?? '-' }}</td>
                            <td>{{ $seller->products_count ?? 0 }}</td>
                            <td>
                                @if($seller->penjualProfile)
                                    @switch($seller->penjualProfile->status_verifikasi)
                                        @case('pending')
                                            <span class="badge badge-warning">Pending</span>
                                            @break
                                        @case('verified')
                                            <span class="badge badge-success">Terverifikasi</span>
                                            @break
                                        @case('rejected')
                                            <span class="badge badge-danger">Ditolak</span>
                                            @break
                                        @default
                                            <span class="badge badge-secondary">-</span>
                                    @endswitch
                                @else
                                    <span class="badge badge-secondary">Belum Daftar</span>
                                @endif
                            </td>
                            <td>{{ $seller->created_at->format('d M Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
