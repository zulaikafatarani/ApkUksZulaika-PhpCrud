<?php
$isLoginUser = isset($_SESSION['iduser']) && isset($_SESSION['role']);
$role = $_SESSION['role'] ?? '';
$nama = $_SESSION['namauser'] ?? '';
?>
<section class="py-5" style="background:#f8fafc">
<style>
:root{ --teal:#0f766e; --teal2:#14b8a6; --mint:#ccfbf1; --mint2:#f0fdfa; --dark:#064e3b; --radius:18px; }
.uk-card{border-radius:var(--radius); border:1px solid #e0f2f1; background:white; box-shadow:0 8px 30px rgba(15,118,110,0.07); transition:.3s}
.uk-card:hover{transform:translateY(-3px); box-shadow:0 16px 40px rgba(15,118,110,0.12)}
.icon-box{width:48px;height:48px;border-radius:12px;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,var(--teal),var(--teal2));color:white}
.icon-box.mint{background:var(--mint);color:var(--teal)}
.sitemap-link{display:flex;align-items:center;padding:12px 16px;border-radius:12px;text-decoration:none !important;color:var(--dark);transition:.2s;border:1px solid transparent}
.sitemap-link:hover{background:var(--mint2);border-color:var(--mint);color:var(--teal);transform:translateX(4px)}
.section-title{font-weight:800;color:var(--dark)}
</style>

<div class="container">
    <div class="text-center mb-5">
        <span class="badge px-4 py-2 mb-3 font-weight-bold" style="background:var(--mint);color:var(--teal);border-radius:30px;letter-spacing:1px">SITEMAP APLIKASI</span>
        <h1 class="section-title"><i class="fas fa-sitemap mr-2" style="color:var(--teal)"></i>Daftar Isi Aplikasi</h1>
        <p class="text-muted small" style="max-width:600px;margin:0 auto">Peta navigasi & pembagian hak akses UKS Digital SMKN 1 Karang Baru - Final sesuai laporan ERD 7 entitas.</p>
    </div>

    <div class="row">
        <!-- PORTAL PUBLIK -->
        <div class="col-lg-6 mb-4">
            <div class="uk-card p-4 h-100">
                <div class="d-flex align-items-center mb-4">
                  <div class="icon-box mr-3"><i class="fas fa-globe"></i></div>
                  <div><h5 class="font-weight-bold mb-0" style="color:var(--dark)">PORTAL PUBLIK</h5><small class="text-muted">Warga Sekolah - Tanpa Login</small></div>
                </div>

                <div class="mt-3">
                  <a href="index.php?halaman=home" class="sitemap-link mb-2"><i class="fas fa-home mr-3" style="color:var(--teal)"></i><div><b>Beranda Utama</b><br><small class="text-muted">Grafik Tren Penyakit + Statistik</small></div><i class="fas fa-chevron-right ml-auto small text-muted"></i></a>
                  <a href="index.php?halaman=cekriwayat" class="sitemap-link mb-2" style="background:var(--mint2);border-color:var(--teal2)"><i class="fas fa-search mr-3" style="color:var(--teal)"></i><div><b>Pelacakan Rekam Medis</b><br><small class="text-muted">NIS/NIP + No HP + Kelas + Alamat</small></div><span class="badge ml-auto" style="background:var(--teal);color:white">0103786196</span></a>
                  <a href="index.php?halaman=daftarobat" class="sitemap-link mb-2"><i class="fas fa-pills mr-3" style="color:var(--teal)"></i><div><b>Katalog Lemari Obat & Alkes</b><br><small class="text-muted">Stok real-time & aturan pakai</small></div><i class="fas fa-chevron-right ml-auto small text-muted"></i></a>
                  <a href="index.php?halaman=daftarkategori" class="sitemap-link mb-2"><i class="fas fa-boxes mr-3" style="color:var(--teal)"></i><div><b>Filter Kategori Obat</b><br><small class="text-muted">Bebas / Keras / P3K / Alat</small></div><i class="fas fa-chevron-right ml-auto small text-muted"></i></a>
                  <a href="index.php?halaman=tentang" class="sitemap-link mb-2"><i class="fas fa-heartbeat mr-3" style="color:var(--teal)"></i><div><b>Profil & Struktur PMR</b><br><small class="text-muted">Visi Misi & 7 Entitas ERD</small></div><i class="fas fa-chevron-right ml-auto small text-muted"></i></a>
                  <a href="index.php?halaman=kontak" class="sitemap-link mb-2"><i class="fas fa-phone-alt mr-3" style="color:var(--teal)"></i><div><b>Kontak Darurat & Piket</b><br><small class="text-muted">Hotline + Form Konsultasi</small></div><i class="fas fa-chevron-right ml-auto small text-muted"></i></a>
                  <div class="sitemap-link mb-2" style="background:#f8fafc"><i class="fas fa-sitemap mr-3 text-muted"></i><div><b>Daftar Isi (Halaman Ini)</b><br><small class="text-muted">Sitemap - Kamu di sini</small></div><span class="badge ml-auto badge-light border">AKTIF</span></div>
                </div>
            </div>
        </div>

        <!-- ZONA INTERNAL -->
        <div class="col-lg-6 mb-4">
            <div class="uk-card p-4 h-100" style="<?= $isLoginUser ? 'border:2px solid var(--teal)' : '' ?>">
                <div class="d-flex align-items-center mb-4">
                  <div class="icon-box mr-3" style="<?= $isLoginUser ? '' : 'background:#fee2e2;color:#dc2626' ?>"><i class="fas <?= $isLoginUser ? 'fa-user-shield' : 'fa-lock' ?>"></i></div>
                  <div>
                    <h5 class="font-weight-bold mb-0" style="color:var(--dark)">ZONA INTERNAL PENGURUS</h5>
                    <?php if($isLoginUser): ?>
                      <small class="badge px-2 py-1 mt-1" style="background:var(--teal);color:white"><?= strtoupper($role) ?> - <?= htmlspecialchars($nama) ?></small>
                    <?php else: ?>
                      <small class="text-danger font-weight-bold">Butuh Login Terpusat</small>
                    <?php endif; ?>
                  </div>
                </div>

                <?php if($isLoginUser): ?>
                <div class="p-3 mb-3" style="background:var(--mint2);border-radius:12px"><small class="font-weight-bold" style="color:var(--dark)"><i class="fas fa-users mr-1"></i> Akses Bersama (Semua Role)</small></div>
                <a href="index.php?halaman=dashboard<?= $role ?>" class="sitemap-link mb-2"><i class="fas fa-tachometer-alt mr-3 text-success"></i><div><b>Dashboard Internal</b><br><small class="text-muted">Ringkasan <?= $role ?></small></div></a>
                <a href="index.php?halaman=siswa" class="sitemap-link mb-2"><i class="fas fa-user-graduate mr-3 text-success"></i><div><b>Master Data Siswa</b><br><small class="text-muted">Pasien Murid - NIS & No HP</small></div></a>
                <a href="index.php?halaman=barang" class="sitemap-link mb-2"><i class="fas fa-capsules mr-3 text-success"></i><div><b>Stok Obat & Alkes</b><br><small class="text-muted">Kelola barang.stok</small></div></a>

                <div class="p-3 mb-3 mt-4" style="background:#e0f2fe;border-radius:12px"><small class="font-weight-bold" style="color:#0369a1"><i class="fas fa-user-tag mr-1"></i> Hak Petugas & Admin</small></div>
                <a href="index.php?halaman=guru" class="sitemap-link mb-2"><i class="fas fa-chalkboard-teacher mr-3" style="color:#0369a1"></i><div><b>Master Data Guru</b></div></a>
                <a href="index.php?halaman=kategori" class="sitemap-link mb-2"><i class="fas fa-tags mr-3" style="color:#0369a1"></i><div><b>Klasifikasi Kategori Obat</b></div></a>
                <a href="index.php?halaman=penanganan" class="sitemap-link mb-2"><i class="fas fa-hand-holding-medical mr-3" style="color:#0369a1"></i><div><b>Penanganan Pasien</b><br><small class="text-muted">Potong stok otomatis</small></div></a>
                <a href="index.php?halaman=laporanharian" class="sitemap-link mb-2"><i class="fas fa-print mr-3" style="color:#0369a1"></i><div><b>Modul Cetak Laporan</b><br><small class="text-muted">Harian / Bulanan / Tahunan</small></div></a>

                <?php if($role=='admin'): ?>
                <div class="p-3 mb-3 mt-4" style="background:#fef9c3;border-radius:12px"><small class="font-weight-bold" style="color:#854d0e"><i class="fas fa-crown mr-1"></i> Hak Tertinggi Admin</small></div>
                <a href="index.php?halaman=user" class="sitemap-link mb-2"><i class="fas fa-users-cog mr-3" style="color:#854d0e"></i><div><b>Kelola Akun Sistem</b><br><small class="text-muted">User Pengurus</small></div></a>
                <?php endif; ?>

                <?php else: ?>
                <div class="text-center py-5">
                  <div class="icon-box mx-auto mb-3" style="width:72px;height:72px;background:#fee2e2;color:#dc2626;border-radius:20px"><i class="fas fa-lock fa-2x"></i></div>
                  <h6 class="font-weight-bold" style="color:var(--dark)">Zona Terkunci</h6>
                  <p class="text-muted small mb-4">Login untuk melihat menu internal sesuai role <code>admin / petugas / anggota</code> yang dibatasi via <code>batasi_akses_role()</code></p>
                  <a href="index.php?halaman=loginuser" class="btn rounded-pill px-4 font-weight-bold text-white shadow" style="background:linear-gradient(90deg,#dc2626,#ef4444)"><i class="fas fa-sign-in-alt mr-2"></i> Login Pengurus Terpusat</a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="index.php?halaman=home" class="btn rounded-pill px-4 mr-2 font-weight-bold text-white shadow-sm" style="background:var(--teal)"><i class="fas fa-home mr-1"></i> Beranda</a>
        <a href="index.php?halaman=cekriwayat" class="btn rounded-pill px-4 font-weight-bold" style="background:var(--mint);color:var(--teal)"><i class="fas fa-search mr-1"></i> Cek Riwayat 0103786196</a>
    </div>
</div>
</section>