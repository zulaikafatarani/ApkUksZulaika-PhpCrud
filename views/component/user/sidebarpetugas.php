<?php // WAJIB BARIS 1 PHP - FIX HEADER PETUGAS ?>
<!-- Main Sidebar - Area Petugas Medis UKS Digital -->
<aside class="main-sidebar sidebar-dark-success elevation-4">
    <a href="index.php?halaman=dashboardpetugas" class="brand-link bg-success border-0"><span class="brand-text font-weight-bold tracking-wide">🚑 UKS DIGITAL</span></a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex border-secondary">
            <div class="image"><img src="assets/images/user/<?= htmlspecialchars($_SESSION['foto'] ?? 'default.png') ?>" class="img-circle elevation-2" alt="Foto Petugas" onerror="this.src='assets/images/user/default.png'"></div>
            <div class="info"><a href="#" class="d-block font-weight-bold text-white"><?= htmlspecialchars($_SESSION['namauser'] ?? 'Nama Petugas') ?></a><small class="text-success text-uppercase font-weight-bold" style="font-size:0.75rem;"><i class="fas fa-user-md mr-1"></i> <?= htmlspecialchars($_SESSION['role'] ?? 'PETUGAS') ?></small></div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item"><a href="index.php?halaman=dashboardpetugas" class="nav-link <?= ($halaman === 'dashboardpetugas') ? 'active bg-success' : '' ?>"><i class="nav-icon fas fa-tachometer-alt"></i><p>Dashboard Pelayanan</p></a></li>
                <li class="nav-header font-weight-bold text-muted">DATA MASTER MEDIS</li>
                <li class="nav-item"><a href="index.php?halaman=siswa" class="nav-link <?= in_array($halaman, ['siswa','createsiswa','editsiswa','showsiswa']) ? 'active bg-success' : '' ?>"><i class="nav-icon fas fa-user-graduate"></i><p>Master Data Siswa</p></a></li>
                <li class="nav-item"><a href="index.php?halaman=guru" class="nav-link <?= in_array($halaman, ['guru','createguru','editguru','showguru']) ? 'active bg-success' : '' ?>"><i class="nav-icon fas fa-chalkboard-teacher"></i><p>Master Data Guru</p></a></li>
                <li class="nav-item"><a href="index.php?halaman=kategori" class="nav-link <?= in_array($halaman, ['kategori','createkategori','editkategori','showkategori']) ? 'active bg-success' : '' ?>"><i class="nav-icon fas fa-tags"></i><p>Kategori Obat</p></a></li>
                <li class="nav-item"><a href="index.php?halaman=barang" class="nav-link <?= in_array($halaman, ['barang','createbarang','editbarang','showbarang']) ? 'active bg-success' : '' ?>"><i class="nav-icon fas fa-pills"></i><p>Stok Obat & Alkes</p></a></li>
                <li class="nav-header font-weight-bold text-muted">PELAYANAN UTAMA</li>
                <li class="nav-item"><a href="index.php?halaman=penanganan" class="nav-link <?= in_array($halaman, ['penanganan','createpenanganan','editpenanganan','showpenanganan']) ? 'active bg-success' : '' ?>"><i class="nav-icon fas fa-heartbeat"></i><p>Penanganan Pasien</p></a></li>
                <li class="nav-header font-weight-bold text-muted">REKAPITULASI</li>
                <li class="nav-item"><a href="index.php?halaman=laporanharian" class="nav-link <?= in_array($halaman, ['laporanharian','laporanbulanan','laporantahunan']) ? 'active bg-success' : '' ?>"><i class="nav-icon fas fa-file-medical-alt"></i><p>Cetak Laporan UKS</p></a></li>
                <li class="nav-header font-weight-bold text-muted">SISTEM KELUAR</li>
                <li class="nav-item"><a href="proses/proseslogout.php" class="nav-link text-danger" onclick="return confirm('Yakin ingin keluar dari UKS Digital?')"><i class="nav-icon fas fa-power-off"></i><p>Keluar Aplikasi</p></a></li>
            </ul>
        </nav>
    </div>
</aside>