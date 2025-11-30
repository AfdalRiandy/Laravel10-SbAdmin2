@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="mb-4 d-sm-flex align-items-center justify-content-between">
        <h1 class="mb-0 text-gray-800 h3">Laporan Produk</h1>
    </div>

    <!-- Summary -->
    <div class="row">
        <div class="mb-4 col-xl-3 col-md-6">
            <div class="py-2 shadow card border-left-primary h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="mr-2 col">
                            <div class="mb-1 text-xs font-weight-bold text-primary text-uppercase">Total Produk</div>
                            <div class="mb-0 text-gray-800 h5 font-weight-bold">{{ $totalProducts }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="text-gray-300 fas fa-box fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-4 col-xl-3 col-md-6">
            <div class="py-2 shadow card border-left-success h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="mr-2 col">
                            <div class="mb-1 text-xs font-weight-bold text-success text-uppercase">Produk Aktif</div>
                            <div class="mb-0 text-gray-800 h5 font-weight-bold">{{ $activeProducts }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="text-gray-300 fas fa-check-circle fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-4 col-xl-3 col-md-6">
            <div class="py-2 shadow card border-left-warning h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="mr-2 col">
                            <div class="mb-1 text-xs font-weight-bold text-warning text-uppercase">Stok Rendah</div>
                            <div class="mb-0 text-gray-800 h5 font-weight-bold">{{ $lowStock }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="text-gray-300 fas fa-exclamation-triangle fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-4 col-xl-3 col-md-6">
            <div class="py-2 shadow card border-left-danger h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="mr-2 col">
                            <div class="mb-1 text-xs font-weight-bold text-danger text-uppercase">Stok Habis</div>
                            <div class="mb-0 text-gray-800 h5 font-weight-bold">{{ $outOfStock }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="text-gray-300 fas fa-times-circle fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Products by Category -->
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-4 shadow card">
                <div class="py-3 card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Produk per Kategori</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th>Kategori</th>
                                    <th>Jumlah Produk</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($productsByCategory as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->products_count }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="mb-4 shadow card">
                <div class="py-3 card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Produk Terlaris</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Terjual</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bestSelling as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->total_sold ?? 0 }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Table -->
    <div class="mb-4 shadow card">
        <div class="py-3 card-header">
            <h6 class="m-0 font-weight-bold text-primary">Detail Produk</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Penjual</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Rating</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->user->name }}</td>
                            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td>
                                @if($product->stock <= 0)
                                    <span class="badge badge-danger">{{ $product->stock }}</span>
                                @elseif($product->stock <= 10)
                                    <span class="badge badge-warning">{{ $product->stock }}</span>
                                @else
                                    <span class="badge badge-success">{{ $product->stock }}</span>
                                @endif
                            </td>
                            <td>
                                <i class="fas fa-star text-warning"></i> {{ number_format($product->reviews->avg('rating') ?? 0, 1) }}
                            </td>
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
        </div>
    </div>
</div>
@endsection


@section('scripts')
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
@endsection