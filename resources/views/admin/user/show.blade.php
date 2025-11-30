@extends('admin.layouts.app')
@section('title', 'Detail Pengguna')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Pengguna</h1>
        <div>
            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <!-- User Info -->
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Pengguna</h6>
                </div>
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-user-circle fa-5x text-gray-300"></i>
                    </div>
                    <h4>{{ $user->name }}</h4>
                    <p class="text-muted">{{ $user->email }}</p>
                    @foreach($user->roles as $role)
                        @switch($role->name)
                            @case('admin')
                                <span class="badge badge-danger badge-lg">Admin</span>
                                @break
                            @case('kepala_sekolah')
                                <span class="badge badge-primary badge-lg">Kepala Sekolah</span>
                                @break
                            @case('guru_pendamping')
                                <span class="badge badge-info badge-lg">Guru Pendamping</span>
                                @break
                            @case('penjual')
                                <span class="badge badge-success badge-lg">Penjual</span>
                                @break
                            @case('pembeli')
                                <span class="badge badge-secondary badge-lg">Pembeli</span>
                                @break
                        @endswitch
                    @endforeach
                    <hr>
                    <div class="text-left">
                        <p><strong>Terdaftar:</strong> {{ $user->created_at->format('d M Y H:i') }}</p>
                        <p><strong>Terakhir diupdate:</strong> {{ $user->updated_at->format('d M Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Info based on role -->
        <div class="col-lg-8">
            @if($user->hasRole('penjual'))
            <!-- Seller Profile -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Profil Penjual</h6>
                </div>
                <div class="card-body">
                    @if($user->penjualProfile)
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Nama Toko:</strong> {{ $user->penjualProfile->shop_name ?? '-' }}</p>
                            <p><strong>Jurusan:</strong> {{ $user->penjualProfile->jurusan ?? '-' }}</p>
                            <p><strong>Kelas:</strong> {{ $user->penjualProfile->kelas ?? '-' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>No. HP:</strong> {{ $user->penjualProfile->phone ?? '-' }}</p>
                            <p><strong>Status:</strong>
                                @switch($user->penjualProfile->status_verifikasi)
                                    @case('pending')
                                        <span class="badge badge-warning">Pending</span>
                                        @break
                                    @case('verified')
                                        <span class="badge badge-success">Terverifikasi</span>
                                        @break
                                    @case('rejected')
                                        <span class="badge badge-danger">Ditolak</span>
                                        @break
                                @endswitch
                            </p>
                        </div>
                    </div>
                    <p><strong>Deskripsi:</strong></p>
                    <p>{{ $user->penjualProfile->description ?? '-' }}</p>
                    @else
                    <p class="text-muted">Belum melengkapi profil penjual</p>
                    @endif
                </div>
            </div>

            <!-- Products -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Produk ({{ $user->products->count() }})</h6>
                </div>
                <div class="card-body">
                    @if($user->products->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user->products->take(5) as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td>
                                        @if($product->is_active)
                                            <span class="badge badge-success">Aktif</span>
                                        @else
                                            <span class="badge badge-secondary">Nonaktif</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if($user->products->count() > 5)
                    <a href="{{ route('admin.products.index', ['seller' => $user->id]) }}" class="btn btn-sm btn-primary">Lihat Semua</a>
                    @endif
                    @else
                    <p class="text-muted">Belum ada produk</p>
                    @endif
                </div>
            </div>
            @endif

            @if($user->hasRole('pembeli'))
            <!-- Orders -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Pesanan ({{ $user->orders->count() }})</h6>
                </div>
                <div class="card-body">
                    @if($user->orders->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th>Invoice</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user->orders->take(5) as $order)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.orders.show', $order) }}">
                                            {{ $order->invoice_number }}
                                        </a>
                                    </td>
                                    <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                    <td>
                                        @switch($order->status)
                                            @case('pending')
                                                <span class="badge badge-warning">Pending</span>
                                                @break
                                            @case('paid')
                                                <span class="badge badge-info">Dibayar</span>
                                                @break
                                            @case('shipped')
                                                <span class="badge badge-primary">Dikirim</span>
                                                @break
                                            @case('completed')
                                                <span class="badge badge-success">Selesai</span>
                                                @break
                                        @endswitch
                                    </td>
                                    <td>{{ $order->created_at->format('d M Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if($user->orders->count() > 5)
                    <a href="{{ route('admin.orders.index', ['user' => $user->id]) }}" class="btn btn-sm btn-primary">Lihat Semua</a>
                    @endif
                    @else
                    <p class="text-muted">Belum ada pesanan</p>
                    @endif
                </div>
            </div>
            @endif

            @if($user->hasRole('admin') || $user->hasRole('kepala_sekolah') || $user->hasRole('guru_pendamping'))
            <!-- Admin/Staff Info -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Tambahan</h6>
                </div>
                <div class="card-body">
                    <p>Pengguna ini memiliki akses sebagai <strong>{{ ucfirst(str_replace('_', ' ', $user->roles->first()->name ?? '')) }}</strong>.</p>
                    <p>Dengan akses ini, pengguna dapat:</p>
                    <ul>
                        @if($user->hasRole('admin'))
                            <li>Mengelola semua data pengguna</li>
                            <li>Mengelola kategori dan produk</li>
                            <li>Mengelola pesanan dan pembayaran</li>
                            <li>Verifikasi penjual</li>
                            <li>Melihat laporan</li>
                            <li>Mengatur pengaturan website</li>
                        @elseif($user->hasRole('kepala_sekolah'))
                            <li>Melihat laporan penjualan</li>
                            <li>Memverifikasi penjual</li>
                            <li>Melihat performa siswa penjual</li>
                        @elseif($user->hasRole('guru_pendamping'))
                            <li>Melihat siswa yang dibimbing</li>
                            <li>Memberikan penilaian</li>
                            <li>Melihat laporan penjualan siswa</li>
                        @endif
                    </ul>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
