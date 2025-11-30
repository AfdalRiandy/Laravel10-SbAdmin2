@extends('admin.layouts.app')
@section('title', 'Edit Produk')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Produk</h1>
        <a href="{{ route('seller.products.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('seller.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Nama Produk</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $product->name) }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Kategori</label>
                    <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="5">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Harga (Rp)</label>
                            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $product->price) }}">
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Stok</label>
                            <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', $product->stock) }}">
                            @error('stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="is_active" class="form-control">
                        <option value="1" {{ $product->is_active ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ !$product->is_active ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Gambar Produk</label>
                    <div class="row mb-3">
                        @foreach($product->images as $image)
                            <div class="col-md-3 mb-3">
                                <div class="card">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" class="card-img-top" alt="Product Image" style="height: 150px; object-fit: cover;">
                                    <div class="card-body p-2 text-center">
                                        @if($image->is_primary)
                                            <span class="badge badge-success mb-2">Utama</span>
                                        @else
                                            <span class="badge badge-secondary mb-2">Tambahan</span>
                                        @endif
                                        
                                        @if($product->images->count() > 1)
                                            <button type="button" class="btn btn-danger btn-sm btn-block" onclick="deleteImage({{ $image->id }})">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <label>Tambah Gambar Baru (Maksimal Total 5)</label>
                    <input type="file" name="images[]" class="form-control @error('images') is-invalid @enderror" multiple accept="image/*">
                    <small class="text-muted">Tekan Ctrl (Windows) atau Command (Mac) untuk memilih banyak gambar.</small>
                    @error('images')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>

<form id="delete-image-form" action="" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script>
    function deleteImage(imageId) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Gambar yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                var form = document.getElementById('delete-image-form');
                form.action = "{{ url('penjual/products/' . $product->id . '/images') }}/" + imageId;
                form.submit();
            }
        });
    }
</script>
@endsection
