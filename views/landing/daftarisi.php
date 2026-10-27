<?php
$isLoginUser = isset($_SESSION['iduser']) && isset($_SESSION['role']);
$role = $_SESSION['role'] ?? '';
$nama = $_SESSION['namauser'] ?? '';
?>
<section class="py-5 position-relative" style="background:#f8fafc; overflow:hidden">

<!-- ORNAMEN MENARI -->
<div class="float-orb orb1" style="top:3%; left:-80px"></div>
<div class="float-orb orb2" style="top:45%; right:-100px"></div>
<div class="float-orb orb3" style="bottom:5%; left:20%"></div>
<div class="dots-grid"></div>

<div class="container position-relative" style="z-index:5">
    <div class="text-center mb-5 reveal">
        <span class="badge-mint mb-3"><i class="fas fa-sitemap mr-2"></i> SITEMAP APLIKASI</span>
        <h1 class="section-title" style="font-size:44px"><i class="fas fa-sitemap mr-2" style="color:var(--teal)"></i>Daftar Isi Aplikasi</h1>
        <p class="text-muted small" style="max-width:650px;margin:0 auto; line-height:1.7">Peta navigasi & pembagian hak akses UKS Digital SMKN 1 Karang Baru - Final sesuai laporan ERD 7 entitas • Toska elegant #0f766e • 0103786196 XI RPL 2</p>
        <div class="mt-3">
          <span class="badge px-3 py-2 mr-2" style="background:white;border:1px solid #ccfbf1;color:var(--teal);border-radius:20px"><i class="fas fa-globe mr-1"></i> Portal Publik Tanpa Login</span>
          <span class="badge px-3 py-2" style="background:var(--dark);color:#5eead4;border-radius:20px"><i class="fas fa-user-shield mr-1"></i> Zona Internal Role</span>
        </div>
    </div>

    <div class="row">
        <!-- PORTAL PUBLIK - MENARI -->
        <div class="col-lg-6 mb-4 reveal">
            <div class="uk-card p-4 h-100">
                <div class="float-orb orb1" style="width:120px;height:120px;top:-30px;right:-30px;opacity:0.4"></div>
                <div class="d-flex align-items-center mb-4 position-relative" style="z-index:2">
                  <div class="icon-box mr-3 shimmer"><i class="fas fa-globe" style="font-size:20px"></i></div>
                  <div><h5 class="font-weight-bold mb-0" style="color:var(--dark)">PORTAL PUBLIK</h5><small class="badge px-2 py-1 mt-1" style="background:var(--mint);color:var(--teal);border-radius:20px">Warga Sekolah - Tanpa Login • Bisa Dipencet</small></div>
                </div>

                <div class="mt-3 position-relative" style="z-index:2">
                  <a href="index.php?halaman=home" class="sitemap-link mb-3 shimmer"><div class="icon-box mint mr-3" style="width:42px;height:42px"><i class="fas fa-home"></i></div><div><b>Beranda Utama</b><br><small class="text-muted">Real-time + Grafik Tren Penyakit + Statistik 4 Card Overlap</small></div><i class="fas fa-chevron-right ml-auto small" style="color:var(--teal2)"></i></a>
                  
                  <a href="index.php?halaman=cekriwayat" class="sitemap-link mb-3" style="background:var(--mint2);border-color:var(--teal2); border:1px solid var(--teal2)"><div class="icon-box mr-3" style="width:42px;height:42px;background:var(--teal)"><i class="fas fa-search"></i></div><div><b>Pelacakan Rekam Medis</b><br><small class="text-muted">NIS/NIP + No HP + Kelas + Alamat • 4 Faktor Verifikasi</small></div><span class="badge ml-auto px-3 py-1" style="background:var(--teal);color:white;border-radius:20px;animation:pulseBadge 2s infinite">0103786196</span></a>
                  
                  <a href="index.php?halaman=daftarobat" class="sitemap-link mb-3"><div class="icon-box mint mr-3" style="width:42px;height:42px"><i class="fas fa-pills"></i></div><div><b>Katalog Lemari Obat & Alkes</b><br><small class="text-muted">Stok real-time & aturan pakai • Ready Stock badge</small></div><i class="fas fa-chevron-right ml-auto small text-muted"></i></a>
                  
                  <a href="index.php?halaman=daftarkategori" class="sitemap-link mb-3"><div class="icon-box mint mr-3" style="width:42px;height:42px"><i class="fas fa-boxes"></i></div><div><b>Filter Kategori Obat</b><br><small class="text-muted">Bebas / Keras / P3K / Alat • Klasifikasi Lemari</small></div><i class="fas fa-chevron-right ml-auto small text-muted"></i></a>
                  
                  <a href="index.php?halaman=tentang" class="sitemap-link mb-3"><div class="icon-box mint mr-3" style="width:42px;height:42px"><i class="fas fa-heartbeat"></i></div><div><b>Profil & Struktur PMR</b><br><small class="text-muted">Visi Misi & 7 Entitas ERD FIX • V1.0</small></div><i class="fas fa-chevron-right ml-auto small text-muted"></i></a>
                  
                  <a href="index.php?halaman=kontak" class="sitemap-link mb-3"><div class="icon-box mint mr-3" style="width:42px;height:42px"><i class="fas fa-phone-alt"></i></div><div><b>Kontak Darurat & Piket</b><br><small class="text-muted">Hotline +62 812-3456-7890 + Form Konsultasi WA</small></div><i class="fas fa-chevron-right ml-auto small text-muted"></i></a>
                  
                  <div class="sitemap-link" style="background:var(--dark);color:white;border:none"><div class="icon-box mr-3" style="width:42px;height:42px;background:rgba(255,255,255,0.15);color:#5eead4"><i class="fas fa-sitemap"></i></div><div><b class="text-white">Daftar Isi (Halaman Ini)</b><br><small style="color:#99f6e0">Sitemap - Kamu di sini • Menari + ornamen</small></div><span class="badge ml-auto" style="background:#5eead4;color:var(--dark);border-radius:20px;animation:popUp .8s infinite alternate">AKTIF</span></div>
                </div>
            </div>
        </div>

        <!-- ZONA INTERNAL - MENARI -->
        <div class="col-lg-6 mb-4 reveal" style="transition-delay:.15s">
            <div class="uk-card p-4 h-100" style="<?= $isLoginUser ? 'border:2px solid var(--teal); box-shadow:0 0 0 4px var(--mint2), 0 16px 40px rgba(15,118,110,0.15)' : '' ?>">
                <div class="float-orb orb3" style="width:140px;height:140px;top:-40px;right:-40px;opacity:0.35"></div>
                <div class="d-flex align-items-center mb-4 position-relative" style="z-index:2">
                  <div class="icon-box mr-3 shimmer" style="<?= $isLoginUser ? '' : 'background:linear-gradient(135deg,#dc2626,#f87171)' ?>"><i class="fas <?= $isLoginUser ? 'fa-user-shield' : 'fa-lock' ?>" style="font-size:20px"></i></div>
                  <div>
                    <h5 class="font-weight-bold mb-0" style="color:var(--dark)">ZONA INTERNAL PENGURUS</h5>
                    <?php if($isLoginUser): ?>
                      <span class="badge-mint mt-2" style="background:var(--teal);color:white"><i class="fas fa-check-circle mr-1"></i> <?= strtoupper($role) ?> - <?= htmlspecialchars($nama) ?> • Login</span>
                    <?php else: ?>
                      <small class="badge px-3 py-1 mt-1" style="background:#fee2e2;color:#dc2626;border-radius:20px"><i class="fas fa-lock mr-1"></i> Butuh Login Terpusat</small>
                    <?php endif; ?>
                  </div>
                </div>

                <div class="position-relative" style="z-index:2">
                <?php if($isLoginUser): ?>
                <div class="p-3 mb-3 shimmer" style="background:linear-gradient(90deg,var(--mint2),white);border-radius:12px;border-left:4px solid var(--teal)"><small class="font-weight-bold" style="color:var(--dark)"><i class="fas fa-users mr-1" style="color:var(--teal)"></i> Akses Bersama (Semua Role) • Bisa Dipencet</small></div>
                
                <a href="index.php?halaman=dashboard<?= $role ?>" class="sitemap-link mb-2"><div class="icon-box mint mr-2" style="width:40px;height:40px"><i class="fas fa-tachometer-alt"></i></div><div><b>Dashboard Internal</b><br><small class="text-muted">Ringkasan <?= $role ?> + Statistik Live</small></div><i class="fas fa-external-link-alt ml-auto small" style="color:var(--teal2)"></i></a>
                
                <a href="index.php?halaman=siswa" class="sitemap-link mb-2"><div class="icon-box mint mr-2" style="width:40px;height:40px"><i class="fas fa-user-graduate"></i></div><div><b>Master Data Siswa</b><br><small class="text-muted">Pasien Murid - NIS & No HP • 200+ Siswa</small></div><span class="badge ml-auto" style="background:var(--mint);color:var(--teal);border-radius:20px">NIS+HP</span></a>
                
                <a href="index.php?halaman=barang" class="sitemap-link mb-2"><div class="icon-box mint mr-2" style="width:40px;height:40px"><i class="fas fa-capsules"></i></div><div><b>Stok Obat & Alkes</b><br><small class="text-muted">Kelola barang.stok + foto + expired H-30</small></div><span class="badge ml-auto" style="background:#fef9c3;color:#a16207;border-radius:20px;animation:pulseBadge 2s infinite">Live</span></a>

                <div class="p-3 mb-3 mt-4" style="background:#e0f2fe;border-radius:12px;border-left:4px solid #0369a1"><small class="font-weight-bold" style="color:#0369a1"><i class="fas fa-user-tag mr-1"></i> Hak Petugas & Admin • Menari Hover</small></div>
                
                <a href="index.php?halaman=guru" class="sitemap-link mb-2"><div class="icon-box mr-2" style="width:40px;height:40px;background:#e0f2fe;color:#0369a1"><i class="fas fa-chalkboard-teacher"></i></div><div><b>Master Data Guru</b><br><small class="text-muted">NIP & No HP • Pasien Guru</small></div></a>
                
                <a href="index.php?halaman=kategori" class="sitemap-link mb-2"><div class="icon-box mr-2" style="width:40px;height:40px;background:#e0f2fe;color:#0369a1"><i class="fas fa-tags"></i></div><div><b>Klasifikasi Kategori Obat</b><br><small class="text-muted">Bebas / Keras / P3K / Alat</small></div></a>
                
                <a href="index.php?halaman=penanganan" class="sitemap-link mb-2" style="border:1px dashed #7dd3fc"><div class="icon-box mr-2" style="width:40px;height:40px;background:linear-gradient(135deg,#0369a1,#38bdf8);color:white"><i class="fas fa-hand-holding-medical"></i></div><div><b>Penanganan Pasien</b><br><small class="text-muted">Potong stok otomatis via detailpenanganan</small></div><span class="badge ml-auto px-2 py-1" style="background:#0369a1;color:white;border-radius:20px">Auto Cut</span></a>
                
                <a href="index.php?halaman=laporanharian" class="sitemap-link mb-2"><div class="icon-box mr-2" style="width:40px;height:40px;background:#e0f2fe;color:#0369a1"><i class="fas fa-print"></i></div><div><b>Modul Cetak Laporan</b><br><small class="text-muted">Harian / Bulanan / Tahunan PDF 1 Klik</small></div></a>

                <?php if($role=='admin'): ?>
                <div class="p-3 mb-3 mt-4" style="background:#fef9c3;border-radius:12px;border-left:4px solid #a16207"><small class="font-weight-bold" style="color:#854d0e"><i class="fas fa-crown mr-1"></i> Hak Tertinggi Admin • 0103786196</small></div>
                <a href="index.php?halaman=user" class="sitemap-link mb-2 shimmer" style="background:linear-gradient(90deg,#fef9c3,white);border:1px solid #facc15"><div class="icon-box mr-2" style="width:40px;height:40px;background:#facc15;color:#713f12"><i class="fas fa-users-cog"></i></div><div><b>Kelola Akun Sistem</b><br><small class="text-muted">User Pengurus • admin/petugas/anggota</small></div><i class="fas fa-crown ml-auto small" style="color:#a16207"></i></a>
                <?php endif; ?>

                <?php else: ?>
                <div class="text-center py-4">
                  <div class="icon-box mx-auto mb-4 shimmer" style="width:80px;height:80px;background:linear-gradient(135deg,#fee2e2,#fecaca);color:#dc2626;border-radius:22px"><i class="fas fa-lock fa-2x"></i></div>
                  <h6 class="font-weight-bold" style="color:var(--dark)">Zona Terkunci Menari</h6>
                  <p class="text-muted small mb-4" style="line-height:1.7">Login untuk melihat menu internal sesuai role <code>admin / petugas / anggota</code> yang dibatasi via <code>batasi_akses_role()</code> di <code>proses/session.php</code> + animasi ornamen</p>
                  <a href="index.php?halaman=loginuser" class="btn rounded-pill px-5 font-weight-bold text-white shadow-lg shimmer" style="background:linear-gradient(90deg,#dc2626,#ef4444);padding:12px 28px; position:relative; z-index:20; pointer-events:auto"><i class="fas fa-sign-in-alt mr-2"></i> Login Pengurus Terpusat</a>
                  <div class="mt-4 d-flex justify-content-center"><span class="badge px-3 py-1 mr-2" style="background:#f1f5f9;color:#64748b;border-radius:20px">admin: full</span><span class="badge px-3 py-1 mr-2" style="background:#f1f5f9;color:#64748b;border-radius:20px">petugas: penanganan</span><span class="badge px-3 py-1" style="background:#f1f5f9;color:#64748b;border-radius:20px">anggota: lihat</span></div>
                </div>
                <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-5 reveal">
        <div class="uk-card d-inline-flex p-2" style="border-radius:30px; background:var(--mint2); border:1px dashed var(--teal2)">
          <a href="index.php?halaman=home" class="btn rounded-pill px-5 font-weight-bold text-white shadow-sm shimmer mr-2" style="background:linear-gradient(90deg,var(--teal),var(--teal2));padding:12px 28px; position:relative; z-index:20; pointer-events:auto"><i class="fas fa-home mr-2"></i> Beranda Real-time</a>
          <a href="index.php?halaman=cekriwayat" class="btn rounded-pill px-5 font-weight-bold" style="background:white;border:1px solid #ccfbf1;color:var(--teal);padding:12px 28px; position:relative; z-index:20; pointer-events:auto"><i class="fas fa-search mr-2"></i> Cek Riwayat 0103786196</a>
        </div>
        <p class="small text-muted mt-3"><i class="fas fa-magic mr-1" style="color:var(--teal2)"></i> Daftar Isi ini sudah menari dengan 12 ornamen: float-orb, dots-grid, shimmer, reveal, pulseBadge, rotateY, translateX • 100% bisa dipencet fix pointer-events</p>
    </div>
</div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function(){
  const reveals=document.querySelectorAll('.reveal');
  const obs=new IntersectionObserver(entries=>{entries.forEach(e=>{if(e.isIntersecting){e.target.classList.add('active')}})},{threshold:0.12});
  reveals.forEach(r=>obs.observe(r));
});
</script>