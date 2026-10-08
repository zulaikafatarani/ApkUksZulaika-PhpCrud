<!-- Main Sidebar - Area Admin UKS Digital -->
<aside class="main-sidebar sidebar-dark-success elevation-4"> <!-- Diubah jadi tema hijau sukses khas UKS -->

    <!-- Identitas Aplikasi -->
    <a href="index.php?halaman=dashboardadmin" class="brand-link bg-success border-0">
        <span class="brand-text font-weight-bold tracking-wide">
            🚑 UKS DIGITAL
        </span>
    </a>

    <!-- Konten di Dalam Sidebar -->
    <div class="sidebar">

        <!-- Panel Identitas Informasi Admin Aktif -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex border-secondary">
            <div class="image">
                <img src="assets/images/user/<?= $_SESSION['foto'] ?? 'default.png'; ?>" class="img-circle elevation-2" alt="Foto Admin">
            </div>
            <div class="info">
                <a href="#" class="d-block font-weight-bold text-white">
                    <?= $_SESSION['namauser'] ?? 'Nama Admin'; ?>
                </a>
                <small class="text-success text-uppercase font-weight-bold" style="font-size: 0.75rem;">
                    <i class="fas fa-user-shield mr-1"></i> <?= $_SESSION['role'] ?? 'ADMIN'; ?>
                </small>
            </div>
        </div>

        <!-- Navigasi Menu Sidebar Admin (Akses 100% Fitur) -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- 1. Menu Dashboard -->
                <li class="nav-item">
                    <a href="index.php?halaman=dashboardadmin" class="nav-link <?= ($halaman === 'dashboardadmin') ? 'active bg-success' : ''; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard Utama</p>
                    </a>
                </li>

                <li class="nav-header font-weight-bold text-muted">MANAJEMEN PENGURUS</li>
                
                <!-- 2. Menu Kelola User (Khusus Admin) -->
                <li class="nav-item">
                    <a href="index.php?halaman=user" class="nav-link <?= (in_array($halaman, ['user', 'createuser', 'edituser', 'showuser'])) ? 'active bg-success' : ''; ?>">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>Kelola Akun Sistem</p>
                    </a>
                </li>

                <li class="nav-header font-weight-bold text-muted">DATA DATA MASTER</li>

                <!-- 3. Menu Kelola Siswa -->
                <li class="nav-item">
                    <a href="index.php?halaman=siswa" class="nav-link <?= (in_array($halaman, ['siswa', 'createsiswa', 'editsiswa', 'showsiswa'])) ? 'active bg-success' : ''; ?>">
                        <i class="nav-icon fas fa-user-graduate"></i>
                        <p>Master Data Siswa</p>
                    </a>
                </li>

                <!-- 4. Menu Kelola Guru -->
                <li class="nav-item">
                    <a href="index.php?halaman=guru" class="nav-link <?= (in_array($halaman, ['guru', 'createguru', 'editguru', 'showguru'])) ? 'active bg-success' : ''; ?>">
                        <i class="nav-icon fas fa-chalkboard-teacher"></i>
                        <p>Master Data Guru</p>
                    </a>
                </li>

                <!-- 5. Menu Kelola Kategori -->
                <li class="nav-item">
                    <a href="index.php?halaman=kategori" class="nav-link <?= (in_array($halaman, ['kategori', 'createkategori', 'editkategori', 'showkategori'])) ? 'active bg-success' : ''; ?>">
                        <i class="nav-icon fas fa-tags"></i>
                        <p>Kategori Obat</p>
                    </a>
                </li>

                <!-- 6. Menu Kelola Barang (Obat & Alkes) -->
                <li class="nav-item">
                    <a href="index.php?halaman=barang" class="nav-link <?= (in_array($halaman, ['barang', 'createbarang', 'editbarang', 'showbarang'])) ? 'active bg-success' : ''; ?>">
                        <i class="nav-icon fas fa-pills"></i>
                        <p>Stok Obat & Alkes</p>
                    </a>
                </li>

                <li class="nav-header font-weight-bold text-muted">PELAYANAN MEDIS</li>

                <!-- 7. Menu Transaksi Inti Penanganan -->
                <li class="nav-item">
                    <a href="index.php?halaman=penanganan" class="nav-link <?= (in_array($halaman, ['penanganan', 'createpenanganan', 'editpenanganan', 'showpenanganan'])) ? 'active bg-success' : ''; ?>">
                        <i class="nav-icon fas fa-heartbeat"></i>
                        <p>Penanganan Pasien</p>
                    </a>
                </li>

                <li class="nav-header font-weight-bold text-muted">REKAPITULASI KESAKITAN</li>

                <!-- 8. Modul Rekap Cetak Laporan Berkalas -->
                <li class="nav-item">
                    <a href="index.php?halaman=laporanbulanan" class="nav-link <?= (in_array($halaman, ['laporanharian', 'laporanbulanan', 'laporantahunan'])) ? 'active bg-success' : ''; ?>">
                        <i class="nav-icon fas fa-file-medical-alt"></i>
                        <p>Cetak Laporan UKS</p>
                    </a>
                </li>

                <li class="nav-header font-weight-bold text-muted">SISTEM KELUAR</li>

                <!-- 9. Menu Logout -->
                <li class="nav-item">
                    <a href="index.php?halaman=logout" class="nav-link text-danger">
                        <i class="nav-icon fas fa-power-off"></i>
                        <p>Keluar Aplikasi</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>
