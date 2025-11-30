@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Verifikasi Penjual</h1>
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
            <h6 class="m-0 font-weight-bold text-primary">Penjual Menunggu Verifikasi</h6>
        </div>
        <div class="card-body">
            @if($penjualProfiles->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>NIS</th>
                            <th>Kelas</th>
                            <th>Jurusan</th>
                            <th>Tanggal Daftar</th>
                            <th width="200">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($penjualProfiles as $profile)
                        <tr>
                            <td>{{ $profile->user->name }}</td>
                            <td>{{ $profile->nis ?? '-' }}</td>
                            <td>{{ $profile->kelas ?? '-' }}</td>
                            <td>{{ $profile->jurusan ?? '-' }}</td>
                            <td>{{ $profile->created_at->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('admin.verifikasi-penjual.show', $profile) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                                <form action="{{ route('admin.verifikasi-penjual.update', $profile) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status_verifikasi" value="verified">
                                    <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Verifikasi penjual ini?')">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                                <form action="{{ route('admin.verifikasi-penjual.update', $profile) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status_verifikasi" value="rejected">
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tolak penjual ini?')">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="text-center py-5">
                <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                <p class="text-muted">Tidak ada penjual yang menunggu verifikasi</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
