<?php
// Validasi status login pengurus terpusat
$isLoginUser = isset($_SESSION['iduser']) && isset($_SESSION['role']);
?>
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="font-weight-bold text-success"><i class="fas fa-sitemap mr-2"></i>Daftar Isi Aplikasi</h1>
            <p class="text-muted">Peta navigasi & pembagian hak akses UKS Digital SMKN 1 Karang Baru - Final sesuai laporan ERD.</p>
        </div>

        <div class="card border-0 shadow-sm" style="border-radius:15px;">
            <div class="card-body p-4 bg-white">
<pre class="mb-0" style="font-family:'Courier New',monospace;font-size:14px;line-height:1.9;white-space:pre-wrap;color:#333;"><strong>🚑 UKS DIGITAL (SMKN 1 KARANG BARU)</strong>
├── <strong>PORTAL PUBLIK (WARGA SEKOLAH)</strong>
│   ├── <a href="index.php?halaman=home" class="text-success font-weight-bold">Beranda Utama (Home) - Grafik Tren Penyakit</a>
│   ├── <a href="index.php?halaman=cekriwayat" class="text-success font-weight-bold">Pelacakan Mandiri Rekam Medis (NIS/NIP + No HP)</a>
│   ├── <a href="index.php?halaman=daftarobat" class="text-success font-weight-bold">Katalog Lemari Obat & Alkes</a>
│   │   └── <a href="index.php?halaman=detailobat&id=1" class="text-secondary">Detail Aturan Pakai Obat</a>
│   ├── <a href="index.php?halaman=daftarkategori" class="text-success font-weight-bold">Filter Kategori Obat (Bebas/Keras/P3K)</a>
│   ├── <a href="index.php?halaman=tentang" class="text-success font-weight-bold">Profil & Struktur Organisasi PMR</a>
│   ├── <a href="index.php?halaman=kontak" class="text-success font-weight-bold">Nomor Darurat & Jadwal Piket</a>
│   └── <a href="index.php?halaman=daftarisi" class="text-success font-weight-bold">Daftar Isi (Sitemap) - Halaman Ini</a>
│
<?php if ($isLoginUser): ?>
└── <strong>ZONA INTERNAL PENGURUS UKS (LOGIN: <?= strtoupper($_SESSION['role']) ?> - <?= htmlspecialchars($_SESSION['namauser'] ?? '') ?>)</strong>
    ├── <strong>Akses Bersama (Semua Role):</strong>
    │   ├── <a href="index.php?halaman=dashboard<?= $_SESSION['role'] ?>" class="text-success">Dashboard Internal</a>
    │   ├── <a href="index.php?halaman=siswa" class="text-success">Master Data Siswa (Pasien Murid)</a>
    │   └── <a href="index.php?halaman=barang" class="text-success">Stok Obat & Alkes</a>
    │
    ├── <strong>Hak Akses Tambahan (Petugas & Admin):</strong>
    │   ├── <a href="index.php?halaman=guru" class="text-success">Master Data Guru</a>
    │   ├── <a href="index.php?halaman=kategori" class="text-success">Klasifikasi Kategori Obat</a>
    │   ├── <a href="index.php?halaman=penanganan" class="text-success">Penanganan Pasien (Potong Stok Otomatis)</a>
    │   └── <a href="index.php?halaman=laporanharian" class="text-success">Modul Cetak Rekapitulasi Laporan</a>
    │
    └── <strong>Hak Akses Tertinggi (Khusus Admin):</strong>
        └── <a href="index.php?halaman=user" class="text-success">Kelola Akun Sistem (User Pengurus)</a>
<?php else: ?>
└── <strong>ZONA INTERNAL PENGURUS UKS</strong>
    └── <a href="index.php?halaman=loginuser" class="btn btn-danger btn-sm rounded-pill px-3"><i class="fas fa-lock mr-1"></i> Login Pengurus Terpusat (Admin/Petugas/Anggota)</a>
<?php endif; ?></pre>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="index.php?halaman=home" class="btn btn-success font-weight-bold shadow rounded-pill px-4 mr-2"><i class="fas fa-home mr-1"></i> Beranda</a>
            <a href="index.php?halaman=cekriwayat" class="btn btn-outline-success font-weight-bold rounded-pill px-4"><i class="fas fa-search mr-1"></i> Cek Riwayat</a>
        </div>
    </div>
</section>