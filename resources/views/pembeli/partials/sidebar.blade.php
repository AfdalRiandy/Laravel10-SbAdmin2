<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <i class="fas fa-user"></i>
        </div>
        <div class="mx-3 sidebar-brand-text">pembeli</div>
    </a>

    <!-- Divider -->
    <hr class="my-0 sidebar-divider">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->routeIs('pembeli.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('pembeli.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Belanja Saya
    </div>

    <!-- Nav Item - Pesanan Saya -->
    <li class="nav-item {{ request()->routeIs('pembeli.orders.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('pembeli.orders.index') }}">
            <i class="fas fa-fw fa-shopping-bag"></i>
            <span>Pesanan Saya</span></a>
    </li>

    <!-- Nav Item - Riwayat Belanja -->
    <li class="nav-item {{ request()->routeIs('pembeli.history.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('pembeli.history.index') }}">
            <i class="fas fa-fw fa-history"></i>
            <span>Riwayat Belanja</span></a>
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