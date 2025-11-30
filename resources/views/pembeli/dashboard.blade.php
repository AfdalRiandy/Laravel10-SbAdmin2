@extends('pembeli.layouts.app')
@section('title', 'Dashboard Pembeli')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard Pembeli</h1>
        
        @if(auth()->user()->hasRole('penjual'))
            <a href="{{ route('seller.dashboard') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
                <i class="fas fa-store fa-sm text-white-50"></i> Beralih ke Dashboard Penjual
            </a>
        @endif
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(session('info'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            {{ session('info') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <!-- Status Penjual Card -->
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Status Akun Penjual</div>
                            
                            @if(auth()->user()->hasRole('penjual'))
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    Anda adalah Penjual Terverifikasi
                                </div>
                                <p class="mt-2 mb-0 text-sm text-gray-600">
                                    Kelola toko Anda melalui Dashboard Penjual.
                                </p>
                            @elseif($penjualProfile)
                                @if($penjualProfile->status_verifikasi == 'pending')
                                    <div class="h5 mb-0 font-weight-bold text-warning">
                                        Menunggu Konfirmasi Admin
                                    </div>
                                    <p class="mt-2 mb-0 text-sm text-gray-600">
                                        Pendaftaran Anda sedang ditinjau. Mohon tunggu persetujuan dari admin.
                                    </p>
                                @elseif($penjualProfile->status_verifikasi == 'rejected')
                                    <div class="h5 mb-0 font-weight-bold text-danger">
                                        Pendaftaran Ditolak
                                    </div>
                                    <p class="mt-2 mb-0 text-sm text-gray-600">
                                        Maaf, pendaftaran Anda ditolak. Silakan hubungi admin untuk info lebih lanjut.
                                    </p>
                                @endif
                            @else
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    Belum Menjadi Penjual
                                </div>
                                <p class="mt-2 mb-0 text-sm text-gray-600">
                                    Ingin mulai berjualan? Daftarkan diri Anda sekarang!
                                </p>
                                <a href="{{ route('pembeli.become-seller.create') }}" class="btn btn-primary mt-3">
                                    Daftar Jadi Penjual
                                </a>
                            @endif
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-store fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection