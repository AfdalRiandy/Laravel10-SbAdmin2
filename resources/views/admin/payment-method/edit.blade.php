@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Metode Pembayaran</h1>
        <a href="{{ route('admin.payment-methods.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.payment-methods.update', $paymentMethod) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Nama Bank / Metode</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $paymentMethod->name) }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Nomor Rekening / Tujuan</label>
                    <input type="text" name="number" class="form-control @error('number') is-invalid @enderror" value="{{ old('number', $paymentMethod->number) }}">
                    @error('number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Atas Nama</label>
                    <input type="text" name="holder" class="form-control @error('holder') is-invalid @enderror" value="{{ old('holder', $paymentMethod->holder) }}">
                    @error('holder')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Tipe</label>
                    <select name="type" class="form-control @error('type') is-invalid @enderror">
                        <option value="transfer" {{ $paymentMethod->type == 'transfer' ? 'selected' : '' }}>Transfer Bank</option>
                        <option value="ewallet" {{ $paymentMethod->type == 'ewallet' ? 'selected' : '' }}>E-Wallet</option>
                        <option value="cod" {{ $paymentMethod->type == 'cod' ? 'selected' : '' }}>COD (Bayar di Tempat)</option>
                    </select>
                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="is_active" class="form-control">
                        <option value="1" {{ $paymentMethod->is_active ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ !$paymentMethod->is_active ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>
@endsection
