@extends('guru_pendamping.layouts.app')
@section('title', 'Dashboard Guru Pendamping')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="mb-4 d-sm-flex align-items-center justify-content-between">
        <h1 class="mb-0 text-gray-800 h3">Dashboard Guru Pendamping</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Total Siswa Card -->
        <div class="mb-4 col-xl-3 col-md-6">
            <div class="py-2 shadow card border-left-primary h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="mr-2 col">
                            <div class="mb-1 text-xs font-weight-bold text-primary text-uppercase">
                                Total Siswa Binaan</div>
                            <div class="mb-0 text-gray-800 h5 font-weight-bold">{{ $totalStudents }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="text-gray-300 fas fa-users fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Laporan Penjualan Card -->
        <div class="mb-4 col-xl-3 col-md-6">
            <div class="py-2 shadow card border-left-success h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="mr-2 col">
                            <div class="mb-1 text-xs font-weight-bold text-success text-uppercase">
                                Laporan Penjualan</div>
                            <div class="mb-0 text-gray-800 h5 font-weight-bold">Lihat Detail</div>
                        </div>
                        <div class="col-auto">
                            <i class="text-gray-300 fas fa-chart-line fa-2x"></i>
                        </div>
                    </div>
                    <a href="{{ route('guru_pendamping.reports.sales') }}" class="stretched-link"></a>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection