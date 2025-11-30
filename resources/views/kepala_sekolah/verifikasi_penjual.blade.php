@extends('kepala_sekolah.layouts.app')
@section('title', 'Verifikasi Penjual')

@section('content')
<div class="container-fluid">
    <div class="mb-4 d-sm-flex align-items-center justify-content-between">
        <h1 class="mb-0 text-gray-800 h3">Verifikasi Pengajuan Penjual</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-4 shadow card">
        <div class="py-3 card-header">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Pengajuan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Siswa</th>
                            <th>Kelas / Jurusan</th>
                            <th>Nama Toko</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pendingSellers as $seller)
                            <tr>
                                <td>{{ $seller->user->name }}</td>
                                <td>{{ $seller->kelas }} - {{ $seller->jurusan }}</td>
                                <td>{{ $seller->shop_name }}</td>
                                <td>{{ $seller->created_at->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('kepala_sekolah.verifikasi.show', $seller->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada pengajuan pending.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
