<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <i class="fas fa-user"></i>
        </div>
        <div class="mx-3 sidebar-brand-text">kepala_sekolah</div>
    </a>

    <!-- Divider -->
    <hr class="my-0 sidebar-divider">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->routeIs('kepala_sekolah.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('kepala_sekolah.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Nav Item - Verifikasi Penjual -->
    <li class="nav-item {{ request()->routeIs('kepala_sekolah.verifikasi*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('kepala_sekolah.verifikasi_penjual') }}">
            <i class="fas fa-fw fa-check-circle"></i>
            <span>Verifikasi Penjual</span></a>
    </li>

    <!-- Nav Item - Laporan Collapse Menu -->
    <li class="nav-item {{ request()->routeIs('kepala_sekolah.laporan.*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLaporan"
            aria-expanded="true" aria-controls="collapseLaporan">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Laporan</span>
        </a>
        <div id="collapseLaporan" class="collapse {{ request()->routeIs('kepala_sekolah.laporan.*') ? 'show' : '' }}" aria-labelledby="headingLaporan" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Laporan Transaksi:</h6>
                <a class="collapse-item {{ request()->routeIs('kepala_sekolah.laporan.penjualan') ? 'active' : '' }}" href="{{ route('kepala_sekolah.laporan.penjualan') }}">Penjualan Siswa</a>
                <a class="collapse-item {{ request()->routeIs('kepala_sekolah.laporan.pembelian') ? 'active' : '' }}" href="{{ route('kepala_sekolah.laporan.pembelian') }}">Pembelian Siswa</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

        <!-- Nav Item - Return to Home -->
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/') }}">
                <i class="fas fa-fw fa-home"></i>
                <span>Kembali ke Beranda</span></a>
        </li>
</ul>