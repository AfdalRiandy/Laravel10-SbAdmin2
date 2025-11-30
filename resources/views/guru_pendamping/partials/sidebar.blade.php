<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <i class="fas fa-user"></i>
        </div>
        <div class="mx-3 sidebar-brand-text">guru_pendamping</div>
    </a>

    <!-- Divider -->
    <hr class="my-0 sidebar-divider">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->routeIs('guru_pendamping.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('guru_pendamping.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Manajemen Siswa
    </div>

    <!-- Nav Item - Daftar Siswa -->
    <li class="nav-item {{ request()->routeIs('guru_pendamping.students.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('guru_pendamping.students.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Daftar Siswa</span></a>
    </li>

    <!-- Nav Item - Laporan Penjualan -->
    <li class="nav-item {{ request()->routeIs('guru_pendamping.reports.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('guru_pendamping.reports.sales') }}">
            <i class="fas fa-fw fa-chart-line"></i>
            <span>Laporan Penjualan</span></a>
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