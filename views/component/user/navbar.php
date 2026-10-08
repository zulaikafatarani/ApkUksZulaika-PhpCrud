
<!-- Navbar Internal Pengurus UKS -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light shadow-sm">

    <!-- Tombol Pemicu Sidebar (Pushmenu) -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
    </ul>

    <!-- Menu Akses Cepat Tengah (Disesuaikan untuk UKS) -->
    <ul class="navbar-nav">
        <!-- Menu Cepat 1: Pencatatan Medis Baru -->
        <li class="nav-item d-none d-md-inline-block">
            <a href="index.php?halaman=createpenanganan" class="nav-link">
                <i class="fas fa-plus-circle text-success mr-1"></i>
                Penanganan Medis
            </a>
        </li>

        <!-- Menu Cepat 2: Cek Lemari Obat -->
        <li class="nav-item d-none d-md-inline-block">
            <a href="index.php?halaman=barang" class="nav-link">
                <i class="fas fa-pills mr-1"></i>
                Stok Obat & Alkes
            </a>
        </li>

        <!-- Menu Cepat 3: Dropdown Laporan (Hanya tampil untuk Admin & Petugas) -->
        <?php if ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'petugas'): ?>
        <li class="nav-item dropdown d-none d-md-inline-block">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                <i class="fas fa-file-medical-alt mr-1"></i>
                Rekap Laporan
            </a>
            <div class="dropdown-menu shadow border-0">
                <a href="index.php?halaman=laporanharian" class="dropdown-item">
                    <i class="fas fa-calendar-day text-success mr-2"></i> Laporan Harian
                </a>
                <a href="index.php?halaman=laporanbulanan" class="dropdown-item">
                    <i class="fas fa-calendar-alt text-success mr-2"></i> Laporan Bulanan
                </a>
                <a href="index.php?halaman=laporantahunan" class="dropdown-item">
                    <i class="fas fa-chart-line text-success mr-2"></i> Laporan Tahunan
                </a>
            </div>
        </li>
        <?php endif; ?>
    </ul>

    <!-- Menu Profil Pengurus Sebelah Kanan (User Menu Dropdown) -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="assets/images/user/<?= $_SESSION['foto'] ?? 'default.png'; ?>" 
                     class="user-image img-circle elevation-1" alt="Foto Pengurus">
                <span class="d-none d-md-inline text-dark font-weight-bold">
                    <?= $_SESSION['namauser'] ?? 'Pengurus'; ?>
                </span>
            </a>

            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right shadow border-0">
                <!-- Bagian Atas Dropdown (Diubah menjadi warna Hijau UKS) -->
                <li class="user-header bg-success text-white">
                    <img src="assets/images/user/<?= $_SESSION['foto'] ?? 'default.png'; ?>" 
                         class="img-circle elevation-2" alt="Foto Pengurus">
                    <p class="font-weight-bold">
                        <?= $_SESSION['namauser'] ?? 'Pengurus'; ?>
                        <small class="text-white-50 mt-1">
                            Role Hak Akses: <?= strtoupper($_SESSION['role'] ?? 'anggota'); ?>
                        </small>
                    </p>
                </li>

                <!-- Bagian Badan Dropdown (Link Pintasan) -->
                <li class="user-body">
                    <div class="row">
                        <div class="col-12 text-center">
                            <a href="index.php?halaman=showuser&id=<?= $_SESSION['iduser']; ?>" class="text-secondary">
                                <i class="fas fa-user-shield text-success mr-1"></i> Hak Akses Sistem Terbuka
                            </a>
                        </div>
                    </div>
                </li>

                <!-- Bagian Kaki Dropdown (Status & Tombol Keluar) -->
                <li class="user-footer bg-light d-flex justify-content-between align-items-center">
                    <span class="badge badge-success px-3 py-2 text-uppercase">
                        <i class="fas fa-id-badge mr-1"></i> <?= $_SESSION['role'] ?? 'PMR'; ?>
                    </span>
                    <a href="index.php?halaman=logout" class="btn btn-danger btn-sm font-weight-bold px-3">
                        <i class="fas fa-sign-out-alt mr-1"></i> LOGOUT
                    </a>
                </li>
            </ul>
        </li>
    </ul>

</nav>
<!-- /.navbar -->
