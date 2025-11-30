@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pengaturan</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <!-- General Settings -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Pengaturan Umum</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.settings.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="site_name">Nama Website</label>
                            <input type="text" class="form-control" id="site_name" name="site_name" value="{{ $settings['site_name'] ?? 'Marketplace Sekolah' }}">
                        </div>

                        <div class="form-group">
                            <label for="site_description">Deskripsi Website</label>
                            <textarea class="form-control" id="site_description" name="site_description" rows="3">{{ $settings['site_description'] ?? '' }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="contact_email">Email Kontak</label>
                            <input type="email" class="form-control" id="contact_email" name="contact_email" value="{{ $settings['contact_email'] ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="contact_phone">Telepon Kontak</label>
                            <input type="text" class="form-control" id="contact_phone" name="contact_phone" value="{{ $settings['contact_phone'] ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="address">Alamat Sekolah</label>
                            <textarea class="form-control" id="address" name="address" rows="2">{{ $settings['address'] ?? '' }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Transaction Settings -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Pengaturan Transaksi</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.settings.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="payment_method">Metode Pembayaran</label>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="payment_cash" name="payment_cash" {{ ($settings['payment_cash'] ?? true) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="payment_cash">Cash / COD</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="payment_transfer" name="payment_transfer" {{ ($settings['payment_transfer'] ?? true) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="payment_transfer">Transfer Bank</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="bank_name">Nama Bank</label>
                            <input type="text" class="form-control" id="bank_name" name="bank_name" value="{{ $settings['bank_name'] ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="bank_account">Nomor Rekening</label>
                            <input type="text" class="form-control" id="bank_account" name="bank_account" value="{{ $settings['bank_account'] ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="bank_holder">Atas Nama</label>
                            <input type="text" class="form-control" id="bank_holder" name="bank_holder" value="{{ $settings['bank_holder'] ?? '' }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
                    </form>
                </div>
            </div>

            <!-- Social Media -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Media Sosial</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.settings.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="instagram"><i class="fab fa-instagram"></i> Instagram</label>
                            <input type="text" class="form-control" id="instagram" name="instagram" value="{{ $settings['instagram'] ?? '' }}" placeholder="@username">
                        </div>

                        <div class="form-group">
                            <label for="facebook"><i class="fab fa-facebook"></i> Facebook</label>
                            <input type="text" class="form-control" id="facebook" name="facebook" value="{{ $settings['facebook'] ?? '' }}" placeholder="facebook.com/page">
                        </div>

                        <div class="form-group">
                            <label for="whatsapp"><i class="fab fa-whatsapp"></i> WhatsApp</label>
                            <input type="text" class="form-control" id="whatsapp" name="whatsapp" value="{{ $settings['whatsapp'] ?? '' }}" placeholder="08xxxxxxxxxx">
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
