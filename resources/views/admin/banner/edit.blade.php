@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="mb-4 d-sm-flex align-items-center justify-content-between">
        <h1 class="mb-0 text-gray-800 h3">Edit Banner</h1>
        <a href="{{ route('admin.banners.index') }}" class="shadow-sm d-none d-sm-inline-block btn btn-sm btn-secondary">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="mb-4 shadow card">
        <div class="py-3 card-header">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Banner</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.banners.update', $banner) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Judul (Opsional)</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $banner->title) }}">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $banner->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image">Gambar</label>
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $banner->image_path) }}" alt="{{ $banner->title }}" width="200">
                    </div>
                    <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image">
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="link">Link (Opsional)</label>
                    <input type="url" class="form-control @error('link') is-invalid @enderror" id="link" name="link" value="{{ old('link', $banner->link) }}">
                    @error('link')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="position">Posisi</label>
                    <select class="form-control @error('position') is-invalid @enderror" id="position" name="position" required>
                        <option value="main" {{ $banner->position == 'main' ? 'selected' : '' }}>Main (Utama)</option>
                        <option value="side_top" {{ $banner->position == 'side_top' ? 'selected' : '' }}>Side Top (Samping Atas)</option>
                        <option value="side_bottom" {{ $banner->position == 'side_bottom' ? 'selected' : '' }}>Side Bottom (Samping Bawah)</option>
                    </select>
                    @error('position')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" {{ $banner->is_active ? 'checked' : '' }}>
                        <label class="custom-control-label" for="is_active">Aktif</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>
@endsection
