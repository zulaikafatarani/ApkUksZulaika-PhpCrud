<!-- Main Sidebar - Area Anggota PMR UKS Digital -->
<aside class="main-sidebar sidebar-dark-success elevation-4">

    <!-- Identitas Aplikasi -->
    <a href="index.php?halaman=dashboardanggota" class="brand-link bg-success border-0">
        <span class="brand-text font-weight-bold tracking-wide">
            🚑 UKS DIGITAL
        </span>
    </a>

    <!-- Konten di Dalam Sidebar -->
    <div class="sidebar">

        <!-- Panel Identitas Informasi Anggota PMR Aktif -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex border-secondary">
            <div class="image">
                <img src="assets/images/user/<?= $_SESSION['foto'] ?? 'default.png'; ?>" class="img-circle elevation-2" alt="Foto Anggota">
            </div>
            <div class="info">
                <a href="#" class="d-block font-weight-bold text-white">
                    <?= $_SESSION['namauser'] ?? 'Nama Anggota'; ?>
                </a>
                <small class="text-success text-uppercase font-weight-bold" style="font-size: 0.75rem;">
                    <i class="fas fa-user-friends mr-1"></i> <?= $_SESSION['role'] ?? 'ANGGOTA'; ?>
                </small>
            </div>
        </div>

        <!-- Navigasi Menu Sidebar Anggota PMR -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- 1. Menu Dashboard Anggota PMR -->
                <li class="nav-item">
                    <a href="index.php?halaman=dashboardanggota" class="nav-link <?= ($halaman === 'dashboardanggota') ? 'active bg-success' : ''; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard Anggota</p>
                    </a>
                </li>

                <!-- Sesuai Kesepakatan: MENU KELOLA AKUN USER DIKUNCI / DISKIP DARI SIDEBAR INI -->

                <li class="nav-header font-weight-bold text-muted">DATA MASTER</li>

                <!-- 2. Menu Kelola Siswa (Bisa diakses Anggota PMR untuk mendata sesama murid) -->
                <li class="nav-item">
                    <a href="index.php?halaman=siswa" class="nav-link <?= (in_array($halaman, ['siswa', 'createsiswa', 'editsiswa', 'showsiswa'])) ? 'active bg-success' : ''; ?>">
                        <i class="nav-icon fas fa-user-graduate"></i>
                        <p>Master Data Siswa</p>
                    </a>
                </li>

                <!-- Sesuai Kesepakatan: MENU MASTER DATA GURU DIKUNCI / DISKIP DARI SIDEBAR INI -->
                <!-- Sesuai Kesepakatan: MENU KATEGORI OBAT DIKUNCI / DISKIP DARI SIDEBAR INI -->

                <!-- 3. Menu Kelola Barang (Hanya untuk memantau sisa Stok Obat & Alkes saat piket) -->
                <li class="nav-item">
                    <a href="index.php?halaman=barang" class="nav-link <?= (in_array($halaman, ['barang', 'createbarang', 'editbarang', 'showbarang'])) ? 'active bg-success' : ''; ?>">
                        <i class="nav-icon fas fa-pills"></i>
                        <p>Stok Obat & Alkes</p>
                    </a>
                </li>

                <li class="nav-header font-weight-bold text-muted">PELAYANAN UTAMA</li>

                <!-- 4. Menu Transaksi Inti Penanganan Pasien Sakit -->
                <li class="nav-item">
                    <a href="index.php?halaman=penanganan" class="nav-link <?= (in_array($halaman, ['penanganan', 'createpenanganan', 'editpenanganan', 'showpenanganan'])) ? 'active bg-success' : ''; ?>">
                        <i class="nav-icon fas fa-heartbeat"></i>
                        <p>Penanganan Pasien</p>
                    </a>
                </li>

                <!-- Sesuai Kesepakatan: MODUL REKAP CETAK LAPORAN DIKUNCI / DISKIP DARI SIDEBAR INI -->

                <li class="nav-header font-weight-bold text-muted">SISTEM KELUAR</li>

                <!-- 5. Menu Logout -->
                <li class="nav-header font-weight-bold text-muted">SISTEM KELUAR</li>
                <!-- FIX LOGOUT ANTI PUTIH -->
                <li class="nav-item">
                    <a href="proses/proseslogout.php" class="nav-link text-danger" onclick="return confirm('Yakin ingin keluar dari UKS Digital?')">
                        <i class="nav-icon fas fa-power-off"></i>
                        <p>Keluar Aplikasi</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
