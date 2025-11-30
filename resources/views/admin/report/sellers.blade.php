@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="mb-4 d-sm-flex align-items-center justify-content-between">
        <h1 class="mb-0 text-gray-800 h3">Laporan Penjual</h1>
    </div>

    <!-- Summary -->
    <div class="row">
        <div class="mb-4 col-xl-4 col-md-6">
            <div class="py-2 shadow card border-left-primary h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="mr-2 col">
                            <div class="mb-1 text-xs font-weight-bold text-primary text-uppercase">Total Penjual</div>
                            <div class="mb-0 text-gray-800 h5 font-weight-bold">{{ $totalSellers }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="text-gray-300 fas fa-store fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-4 col-xl-4 col-md-6">
            <div class="py-2 shadow card border-left-success h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="mr-2 col">
                            <div class="mb-1 text-xs font-weight-bold text-success text-uppercase">Penjual Terverifikasi</div>
                            <div class="mb-0 text-gray-800 h5 font-weight-bold">{{ $verifiedSellers }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="text-gray-300 fas fa-check-circle fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-4 col-xl-4 col-md-6">
            <div class="py-2 shadow card border-left-warning h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="mr-2 col">
                            <div class="mb-1 text-xs font-weight-bold text-warning text-uppercase">Menunggu Verifikasi</div>
                            <div class="mb-0 text-gray-800 h5 font-weight-bold">{{ $pendingVerification }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="text-gray-300 fas fa-clock fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Sellers -->
    <div class="mb-4 shadow card">
        <div class="py-3 card-header">
            <h6 class="m-0 font-weight-bold text-primary">Penjual Terbaik</h6>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach($topSellers as $index => $seller)
                <div class="mb-3 col-md-4">
                    <div class="card {{ $index == 0 ? 'border-warning' : '' }}">
                        <div class="text-center card-body">
                            @if($index == 0)
                                <i class="mb-2 fas fa-crown fa-2x text-warning"></i>
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
    <div class="mb-4 shadow card">
        <div class="py-3 card-header">
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

@section('scripts')
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
@endsection