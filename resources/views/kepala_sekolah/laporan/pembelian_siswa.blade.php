@extends('kepala_sekolah.layouts.app')
@section('title', 'Laporan Pembelian Siswa')

@section('content')
<div class="container-fluid">
    <div class="mb-4 d-sm-flex align-items-center justify-content-between">
        <h1 class="mb-0 text-gray-800 h3">Laporan Pembelian Siswa</h1>
    </div>

    <div class="mb-4 shadow card">
        <div class="py-3 card-header">
            <h6 class="m-0 font-weight-bold text-primary">Data Pembelian Siswa</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Siswa</th>
                            <th>Email</th>
                            <th>Total Transaksi</th>
                            <th>Total Pengeluaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($buyers as $buyer)
                            <tr>
                                <td>{{ $buyer->name }}</td>
                                <td>{{ $buyer->email }}</td>
                                <td>{{ $buyer->total_purchases }}</td>
                                <td>Rp {{ number_format($buyer->total_spent, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Belum ada data pembelian.</td>
                            </tr>
                        @endforelse
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
