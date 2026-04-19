<!DOCTYPE html>
<html>
<head>
    <title>Web Kasir</title>

    <!-- AdminLTE -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <span class="navbar-brand">@yield('title')</span>
    </nav>

    <!-- Sidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="#" class="brand-link">
            <span class="brand-text font-weight-light">Web Kasir</span>
        </a>

        <div class="sidebar">
            <nav>
                <ul class="nav nav-pills nav-sidebar flex-column">

    <li class="nav-item">
        <a href="/dashboard" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
            <i class="nav-icon fas fa-home"></i>
            <p>Dashboard</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="/produk" class="nav-link {{ request()->is('produk*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-box"></i>
            <p>Produk</p>
        </a>
    </li>

    <!-- 🔥 INI TAMBAHAN -->
    <li class="nav-item">
        <a href="/kategori" class="nav-link {{ request()->is('kategori*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tags"></i>
            <p>Kategori</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="/penjualan" class="nav-link {{ request()->is('penjualan*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-cash-register"></i>
            <p>Penjualan</p>
        </a>
    </li>

    <li class="nav-item">
    <a href="/laporan" class="nav-link {{ request()->is('laporan*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-file"></i>
        <p>Laporan</p>
    </a>
</li>

</ul>
            </nav>
            <!-- LOGOUT DI BAWAH -->
    <div class="p-3">
        <form method="POST" action="/logout">
            @csrf
            <button class="btn btn-danger btn-block">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </div>
        </div>
    </aside>

    <!-- Content -->
    <div class="content-wrapper p-3">
        @yield('content')
    </div>

</div>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html>
