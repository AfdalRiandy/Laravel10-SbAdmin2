@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Penjual</h1>
        <a href="{{ route('admin.verifikasi-penjual.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Penjual</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="200">Nama</th>
                            <td>{{ $verifikasi_penjual->user->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $verifikasi_penjual->user->email }}</td>
                        </tr>
                        <tr>
                            <th>NIS</th>
                            <td>{{ $verifikasi_penjual->nis ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Kelas</th>
                            <td>{{ $verifikasi_penjual->kelas ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Jurusan</th>
                            <td>{{ $verifikasi_penjual->jurusan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Alamat Toko</th>
                            <td>{{ $verifikasi_penjual->alamat_toko ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Deskripsi Toko</th>
                            <td>{{ $verifikasi_penjual->deskripsi_toko ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @switch($verifikasi_penjual->status_verifikasi)
                                    @case('pending')
                                        <span class="badge badge-warning">Menunggu</span>
                                        @break
                                    @case('verified')
                                        <span class="badge badge-success">Terverifikasi</span>
                                        @break
                                    @case('rejected')
                                        <span class="badge badge-danger">Ditolak</span>
                                        @break
                                @endswitch
                            </td>
                        </tr>
                        <tr>
                            <th>Tanggal Daftar</th>
                            <td>{{ $verifikasi_penjual->created_at->format('d M Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            @if($verifikasi_penjual->status_verifikasi == 'pending')
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Aksi Verifikasi</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.verifikasi-penjual.update', $verifikasi_penjual) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status_verifikasi" value="verified">
                        <button type="submit" class="btn btn-success btn-block mb-2" onclick="return confirm('Verifikasi penjual ini?')">
                            <i class="fas fa-check"></i> Verifikasi Penjual
                        </button>
                    </form>
                    <form action="{{ route('admin.verifikasi-penjual.update', $verifikasi_penjual) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status_verifikasi" value="rejected">
                        <button type="submit" class="btn btn-danger btn-block" onclick="return confirm('Tolak penjual ini?')">
                            <i class="fas fa-times"></i> Tolak Penjual
                        </button>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
