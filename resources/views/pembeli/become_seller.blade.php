@extends('pembeli.layouts.app')
@section('title', 'Daftar Menjadi Penjual')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Menjadi Penjual</h1>
        <a href="{{ route('pembeli.dashboard') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Pendaftaran Penjual</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('pembeli.become-seller.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Toko</label>
                            <input type="text" name="shop_name" class="form-control @error('shop_name') is-invalid @enderror" value="{{ old('shop_name') }}" required>
                            @error('shop_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nomor Telepon / WA</label>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>NIS</label>
                            <input type="text" name="nis" class="form-control @error('nis') is-invalid @enderror" value="{{ old('nis') }}" required>
                            @error('nis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Kelas</label>
                            <input type="text" name="kelas" class="form-control @error('kelas') is-invalid @enderror" value="{{ old('kelas') }}" required>
                            @error('kelas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Jurusan</label>
                            <input type="text" name="jurusan" class="form-control @error('jurusan') is-invalid @enderror" value="{{ old('jurusan') }}" required>
                            @error('jurusan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Alamat Toko (Lokasi di Sekolah)</label>
                    <textarea name="alamat_toko" class="form-control @error('alamat_toko') is-invalid @enderror" rows="3" required>{{ old('alamat_toko') }}</textarea>
                    @error('alamat_toko')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Deskripsi Toko</label>
                    <textarea name="deskripsi_toko" class="form-control @error('deskripsi_toko') is-invalid @enderror" rows="4" required>{{ old('deskripsi_toko') }}</textarea>
                    @error('deskripsi_toko')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Foto Selfie (Wajib)</label>
                            <input type="file" name="selfie_photo" class="form-control-file @error('selfie_photo') is-invalid @enderror" required accept="image/*">
                            <small class="text-muted">Upload foto selfie Anda untuk verifikasi.</small>
                            @error('selfie_photo')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Foto Toko (Opsional)</label>
                            <input type="file" name="shop_photo" class="form-control-file @error('shop_photo') is-invalid @enderror" accept="image/*">
                            <small class="text-muted">Upload foto toko atau produk Anda jika ada.</small>
                            @error('shop_photo')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Kirim Pendaftaran</button>
            </form>
        </div>
    </div>
</div>
@endsection
