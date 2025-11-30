@extends('kepala_sekolah.layouts.app')
@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <div class="mb-4 d-sm-flex align-items-center justify-content-between">
        <h1 class="mb-0 text-gray-800 h3">Dashboard Kepala Sekolah</h1>
    </div>

    <div class="row">
        <!-- Pending Verifications Card -->
        <div class="mb-4 col-xl-4 col-md-6">
            <div class="py-2 shadow card border-left-warning h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="mr-2 col">
                            <div class="mb-1 text-xs font-weight-bold text-warning text-uppercase">
                                Menunggu Verifikasi</div>
                            <div class="mb-0 text-gray-800 h5 font-weight-bold">{{ $pendingVerifications }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="text-gray-300 fas fa-clipboard-list fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Active Sellers Card -->
        <div class="mb-4 col-xl-4 col-md-6">
            <div class="py-2 shadow card border-left-success h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="mr-2 col">
                            <div class="mb-1 text-xs font-weight-bold text-success text-uppercase">
                                Penjual Aktif</div>
                            <div class="mb-0 text-gray-800 h5 font-weight-bold">{{ $activeSellers }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="text-gray-300 fas fa-store fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Students Card -->
        <div class="mb-4 col-xl-4 col-md-6">
            <div class="py-2 shadow card border-left-primary h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="mr-2 col">
                            <div class="mb-1 text-xs font-weight-bold text-primary text-uppercase">
                                Total Siswa Wirausaha</div>
                            <div class="mb-0 text-gray-800 h5 font-weight-bold">{{ $totalStudents }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="text-gray-300 fas fa-users fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Total Transactions Card -->
        <div class="mb-4 col-xl-6 col-md-6">
            <div class="py-2 shadow card border-left-info h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="mr-2 col">
                            <div class="mb-1 text-xs font-weight-bold text-info text-uppercase">
                                Total Transaksi Berhasil</div>
                            <div class="mb-0 text-gray-800 h5 font-weight-bold">{{ $totalTransactions }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="text-gray-300 fas fa-shopping-cart fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Revenue Card -->
        <div class="mb-4 col-xl-6 col-md-6">
            <div class="py-2 shadow card border-left-success h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="mr-2 col">
                            <div class="mb-1 text-xs font-weight-bold text-success text-uppercase">
                                Total Perputaran Uang</div>
                            <div class="mb-0 text-gray-800 h5 font-weight-bold">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="text-gray-300 fas fa-dollar-sign fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection