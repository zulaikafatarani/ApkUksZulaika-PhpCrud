<!-- Navbar Internal Pengurus UKS - VERSI ANTI GAGAL (TANPA JS) -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light shadow-sm">
    <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a></li>
    </ul>

    <style>
    /* FIX DROPDOWN HOVER - biar muncul tanpa klik */
    .rekap-dropdown{position:relative}
    .rekap-dropdown .dropdown-menu{display:none;position:absolute;top:100%;left:0;z-index:1050;min-width:200px}
    .rekap-dropdown:hover .dropdown-menu{display:block}
    </style>

    <ul class="navbar-nav">
        <li class="nav-item d-none d-sm-inline-block">
            <a href="index.php?halaman=createpenanganan" class="nav-link"><i class="fas fa-plus-circle text-success mr-1"></i> Penanganan Medis</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="index.php?halaman=barang" class="nav-link"><i class="fas fa-pills mr-1"></i> Stok Obat & Alkes</a>
        </li>

        <?php if ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'petugas'): ?>
        <li class="nav-item dropdown rekap-dropdown">
            <a class="nav-link" href="#" style="cursor:pointer">
                <i class="fas fa-file-medical-alt mr-1"></i> Rekap Laporan <i class="fas fa-caret-down ml-1"></i>
            </a>
            <div class="dropdown-menu shadow border-0">
                <a href="index.php?halaman=laporanharian&tgl=<?= date('Y-m-d') ?>" class="dropdown-item">
                    <i class="fas fa-calendar-day text-success mr-2"></i> Laporan Harian
                </a>
                <a href="index.php?halaman=laporanbulanan&bulan=<?= date('m') ?>&tahun=<?= date('Y') ?>" class="dropdown-item">
                    <i class="fas fa-calendar-alt text-primary mr-2"></i> Laporan Bulanan
                </a>
                <a href="index.php?halaman=laporantahunan&tahun=<?= date('Y') ?>" class="dropdown-item">
                    <i class="fas fa-chart-line text-success mr-2"></i> Laporan Tahunan
                </a>
            </div>
        </li>
        <?php endif; ?>
    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="assets/images/user/<?= $_SESSION['foto'] ?? 'default.png'; ?>" class="user-image img-circle elevation-1">
                <span class="d-none d-md-inline text-dark font-weight-bold"><?= $_SESSION['namauser'] ?? 'Buk Ely'; ?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right shadow border-0">
                <li class="user-header bg-success text-white">
                    <img src="assets/images/user/<?= $_SESSION['foto'] ?? 'default.png'; ?>" class="img-circle elevation-2">
                    <p><?= $_SESSION['namauser'] ?? 'Pengurus'; ?><small class="d-block">Role: <?= strtoupper($_SESSION['role'] ?? ''); ?></small></p>
                </li>
                <li class="user-footer bg-light d-flex justify-content-between">
                    <span class="badge badge-success px-3 py-2"><?= $_SESSION['role'] ?? 'PMR'; ?></span>
                    <a href="index.php?halaman=logout" class="btn btn-danger btn-sm"><i class="fas fa-sign-out-alt"></i> LOGOUT</a>
                </li>
            </ul>
        </li>
    </ul>
</nav>