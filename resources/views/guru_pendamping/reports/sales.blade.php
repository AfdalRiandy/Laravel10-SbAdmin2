@extends('guru_pendamping.layouts.app')
@section('title', 'Laporan Penjualan')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Laporan Penjualan Siswa</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Laporan Penjualan Siswa Binaan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Siswa</th>
                            <th>Nama Toko</th>
                            <th>Kelas / Jurusan</th>
                            <th>Total Produk Terjual</th>
                            <th>Total Pendapatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                        <tr>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->penjualProfile->shop_name ?? '-' }}</td>
                            <td>
                                {{ $student->penjualProfile->kelas ?? '-' }} / 
                                {{ $student->penjualProfile->jurusan ?? '-' }}
                            </td>
                            <td>{{ $student->total_sold }}</td>
                            <td>Rp {{ number_format($student->total_sales, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
@endpush
