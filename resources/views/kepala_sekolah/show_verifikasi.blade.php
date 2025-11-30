@extends('kepala_sekolah.layouts.app')
@section('title', 'Detail Verifikasi')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Pengajuan Penjual</h1>
        <a href="{{ route('kepala_sekolah.verifikasi_penjual') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Siswa & Toko</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th>Nama Siswa</th>
                            <td>{{ $profile->user->name }}</td>
                        </tr>
                        <tr>
                            <th>NIS</th>
                            <td>{{ $profile->nis }}</td>
                        </tr>
                        <tr>
                            <th>Kelas / Jurusan</th>
                            <td>{{ $profile->kelas }} / {{ $profile->jurusan }}</td>
                        </tr>
                        <tr>
                            <th>No. Telepon</th>
                            <td>{{ $profile->phone }}</td>
                        </tr>
                        <tr>
                            <th>Nama Toko</th>
                            <td>{{ $profile->shop_name }}</td>
                        </tr>
                        <tr>
                            <th>Alamat Toko</th>
                            <td>{{ $profile->alamat_toko }}</td>
                        </tr>
                        <tr>
                            <th>Deskripsi Toko</th>
                            <td>{{ $profile->deskripsi_toko }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Foto Pendukung</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="font-weight-bold">Foto Selfie:</label><br>
                        @if($profile->selfie_photo)
                            <img src="{{ asset('storage/' . $profile->selfie_photo) }}" class="img-fluid rounded" style="max-height: 200px;">
                        @else
                            <span class="text-muted">Tidak ada foto selfie.</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="font-weight-bold">Foto Toko:</label><br>
                        @if($profile->shop_photo)
                            <img src="{{ asset('storage/' . $profile->shop_photo) }}" class="img-fluid rounded" style="max-height: 200px;">
                        @else
                            <span class="text-muted">Tidak ada foto toko.</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Aksi Verifikasi</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('kepala_sekolah.verifikasi.approve', $profile->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="guru_pendamping_id">Pilih Guru Pendamping:</label>
                            <select name="guru_pendamping_id" id="guru_pendamping_id" class="form-control" required>
                                <option value="">-- Pilih Guru Pendamping --</option>
                                @foreach($guruPendampings as $guru)
                                    <option value="{{ $guru->id }}">{{ $guru->name }}</option>
                                @endforeach
                            </select>
                            @error('guru_pendamping_id')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success btn-block">
                            <i class="fas fa-check"></i> Setujui & Tetapkan Guru Pendamping
                        </button>
                    </form>

                    <hr>

                    <form action="{{ route('kepala_sekolah.verifikasi.reject', $profile->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menolak pengajuan ini?');">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-danger btn-block">
                            <i class="fas fa-times"></i> Tolak Pengajuan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
