<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ auth()->user()->hasRole('admin') ? route('admin.dashboard') : route('seller.dashboard') }}">
        <div class="sidebar-brand-icon">
            <i class="fas fa-store"></i>
        </div>
        <div class="sidebar-brand-text mx-3">MarketSekolah</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    @role('admin')
    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Manajemen Pengguna
    </div>

    <!-- Nav Item - User Management -->
    <li class="nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.users.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Semua Pengguna</span></a>
    </li>

    <!-- Nav Item - Verifikasi Penjual -->
    <li class="nav-item {{ request()->routeIs('admin.verifikasi-penjual.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.verifikasi-penjual.index') }}">
            <i class="fas fa-fw fa-user-check"></i>
            <span>Verifikasi Penjual</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Manajemen Produk
    </div>

    <!-- Nav Item - Kategori -->
    <li class="nav-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.categories.index') }}">
            <i class="fas fa-fw fa-tags"></i>
            <span>Kategori</span></a>
    </li>

    <!-- Nav Item - Produk -->
    <li class="nav-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.products.index') }}">
            <i class="fas fa-fw fa-box"></i>
            <span>Produk</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Transaksi
    </div>

    <!-- Nav Item - Pesanan -->
    <li class="nav-item {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.orders.index') }}">
            <i class="fas fa-fw fa-shopping-cart"></i>
            <span>Pesanan</span></a>
    </li>

    <!-- Nav Item - Pembayaran -->
    <li class="nav-item {{ request()->routeIs('admin.payments.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.payments.index') }}">
            <i class="fas fa-fw fa-credit-card"></i>
            <span>Konfirmasi Pembayaran</span></a>
    </li>

    <!-- Nav Item - Metode Pembayaran -->
    <li class="nav-item {{ request()->routeIs('admin.payment-methods.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.payment-methods.index') }}">
            <i class="fas fa-fw fa-money-bill-wave"></i>
            <span>Metode Pembayaran</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Laporan
    </div>

    <!-- Nav Item - Laporan Penjualan -->
    <li class="nav-item {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReports"
            aria-expanded="true" aria-controls="collapseReports">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Laporan</span>
        </a>
        <div id="collapseReports" class="collapse {{ request()->routeIs('admin.reports.*') ? 'show' : '' }}" aria-labelledby="headingReports" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Laporan:</h6>
                <a class="collapse-item {{ request()->routeIs('admin.reports.sales') ? 'active' : '' }}" href="{{ route('admin.reports.sales') }}">Penjualan</a>
                <a class="collapse-item {{ request()->routeIs('admin.reports.products') ? 'active' : '' }}" href="{{ route('admin.reports.products') }}">Produk</a>
                <a class="collapse-item {{ request()->routeIs('admin.reports.sellers') ? 'active' : '' }}" href="{{ route('admin.reports.sellers') }}">Penjual</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Lainnya
    </div>

    <!-- Nav Item - Banner -->
    <li class="nav-item {{ request()->routeIs('admin.banners.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.banners.index') }}">
            <i class="fas fa-fw fa-image"></i>
            <span>Manajemen Banner</span></a>
    </li>
    @endrole

    @role('penjual')
    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->routeIs('seller.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('seller.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Toko Saya
    </div>

    <!-- Nav Item - Produk -->
    <li class="nav-item {{ request()->routeIs('seller.products.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('seller.products.index') }}">
            <i class="fas fa-fw fa-box"></i>
            <span>Produk Saya</span></a>
    </li>

    <!-- Nav Item - Pesanan -->
    <li class="nav-item {{ request()->routeIs('seller.orders.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('seller.orders.index') }}">
            <i class="fas fa-fw fa-shopping-cart"></i>
            <span>Pesanan Masuk</span></a>
    </li>

    <!-- Nav Item - Profil Toko -->
    <li class="nav-item {{ request()->routeIs('seller.shop.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('seller.shop.edit') }}">
            <i class="fas fa-fw fa-store"></i>
            <span>Profil Toko</span></a>
    </li>
    @endrole

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Nav Item - Return to Home -->
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/') }}">
            <i class="fas fa-fw fa-home"></i>
            <span>Kembali ke Beranda</span></a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>