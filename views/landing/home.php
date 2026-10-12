<?php
if (!isset($koneksi)) { include __DIR__ . '/../../proses/koneksi.php'; }
$q = mysqli_query($koneksi, "SELECT COUNT(*) as jml FROM barang"); $totalObat = mysqli_fetch_assoc($q)['jml'];
$q = mysqli_query($koneksi, "SELECT COUNT(*) as jml FROM siswa"); $totalSiswa = mysqli_fetch_assoc($q)['jml'];
$q = mysqli_query($koneksi, "SELECT COUNT(*) as jml FROM kategori"); $totalKategori = mysqli_fetch_assoc($q)['jml'];
$q = mysqli_query($koneksi, "SELECT COUNT(*) as jml FROM penanganan WHERE DATE(tanggalpenanganan) = CURDATE()"); $totalHariIni = mysqli_fetch_assoc($q)['jml'];
$queryKategori = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY idkategori DESC LIMIT 4");
$queryObatBaru = mysqli_query($koneksi, "SELECT barang.*, kategori.namakategori FROM barang LEFT JOIN kategori ON barang.idkategori = kategori.idkategori ORDER BY barang.tanggalmasuk DESC LIMIT 8");
$queryTren = mysqli_query($koneksi, "SELECT keluhan, COUNT(*) as total FROM penanganan WHERE tanggalpenanganan >= DATE_SUB(CURDATE(), INTERVAL 30 DAY) GROUP BY keluhan ORDER BY total DESC LIMIT 5");
$labelTren=[]; $dataTren=[]; while($t=mysqli_fetch_assoc($queryTren)){ $labelTren[]=$t['keluhan']; $dataTren[]=$t['total']; }
$queryKritis = mysqli_query($koneksi, "SELECT * FROM barang WHERE stok <= 5 OR tanggalkadaluarsa <= DATE_ADD(CURDATE(), INTERVAL 30 DAY) LIMIT 5");
$programUKS = [
  ['judul'=>'Penyuluhan PHBS','icon'=>'fa-hand-sparkles','desc'=>'Cuci tangan & kebersihan lingkungan','foto'=>'program1.jpg','color'=>'#0f766e'],
  ['judul'=>'Pelatihan P3K','icon'=>'fa-briefcase-medical','desc'=>'Pertolongan pertama kecelakaan','foto'=>'program2.jpg','color'=>'#0369a1'],
  ['judul'=>'Senam Sehat Jumat','icon'=>'fa-running','desc'=>'Senam & cek kebugaran rutin','foto'=>'program3.jpg','color'=>'#a16207'],
  ['judul'=>'Donor Darah PMR','icon'=>'fa-tint','desc'=>'Aksi kemanusiaan sukarela','foto'=>'program4.jpg','color'=>'#dc2626'],
  ['judul'=>'Pemeriksaan Rutin','icon'=>'fa-stethoscope','desc'=>'Cek TB/BB, tensi, mata, gigi','foto'=>'program5.jpg','color'=>'#7c3aed'],
  ['judul'=>'Kader Kesehatan','icon'=>'fa-users','desc'=>'Pembinaan PMR Madya & Wira','foto'=>'program6.jpg','color'=>'#0f766e'],
];
?>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@600;800&display=swap" rel="stylesheet">
<style>
:root{ --teal:#0f766e; --teal2:#14b8a6; --mint:#ccfbf1; --mint2:#f0fdfa; --dark:#064e3b; --radius:20px; }
body{background:#f8fafc; font-family:'Plus Jakarta Sans', sans-serif; overflow-x:hidden}
.uk-card{border-radius:var(--radius); border:1px solid #e0f2f1; background:white; box-shadow:0 8px 30px rgba(15,118,110,0.07); transition:all .5s cubic-bezier(0.4,0,0.2,1); position:relative; overflow:hidden}
.uk-card::after{content:''; position:absolute; top:0; left:-100%; width:100%; height:100%; background:linear-gradient(90deg, transparent, rgba(204,251,241,0.5), transparent); transition:0s}
.uk-card:hover::after{left:100%; transition:0.9s}
.uk-card:hover{transform:translateY(-10px) scale(1.02) rotateX(2deg); box-shadow:0 26px 70px rgba(15,118,110,0.18); border-color:var(--teal2)}
.section-title{font-weight:800; color:var(--dark); letter-spacing:-0.5px}

/* ORNAMEN ANIMASI */
.float-orb{position:absolute; border-radius:50%; pointer-events:none !important; filter:blur(0.5px); z-index:1 !important}
.orb1{width:220px;height:220px;background:radial-gradient(circle, rgba(20,184,166,0.22), transparent 70%); animation:floatOrb 7s ease-in-out infinite}
.orb2{width:320px;height:320px;background:radial-gradient(circle, rgba(204,251,241,0.6), transparent 70%); animation:floatOrb 9s ease-in-out infinite reverse}
.orb3{width:160px;height:160px;background:radial-gradient(circle, rgba(45,212,191,0.18), transparent 70%); animation:floatOrb 6s ease-in-out infinite; animation-delay:1s}
@keyframes floatOrb{0%,100%{transform:translateY(0) translateX(0) scale(1)}33%{transform:translateY(-30px) translateX(15px) scale(1.08)}66%{transform:translateY(-10px) translateX(-10px) scale(0.95)}}
.float-icon{position:absolute; font-size:22px; opacity:0.08; animation:floatIcon 8s ease-in-out infinite; pointer-events:none !important; color:var(--teal); z-index:1 !important}
@keyframes floatIcon{0%,100%{transform:translateY(0) rotate(0deg)}50%{transform:translateY(-40px) rotate(15deg)}}
.dots-grid{position:absolute; inset:0; background-image:radial-gradient(#ccfbf1 1.5px, transparent 1.5px); background-size:22px 22px; opacity:0.4; animation:dotsMove 20s linear infinite; pointer-events:none !important; z-index:1 !important}
@keyframes dotsMove{0%{background-position:0 0}100%{background-position:44px 44px}}
.shimmer{position:relative; overflow:hidden}
.shimmer::before{content:''; position:absolute; top:0; left:-100%; width:60%; height:100%; background:linear-gradient(90deg, transparent, rgba(255,255,255,0.6), transparent); animation:shimmer 3s infinite; pointer-events:none}
@keyframes shimmer{0%{left:-100%}100%{left:200%}}

/* HERO */
#heroFoto{position:relative; overflow:hidden; background:var(--dark); height:84vh; min-height:640px}
#heroFoto .carousel-item{height:84vh; min-height:640px}
#heroFoto .elegant-img{width:100%; height:100%; object-fit:cover; object-position:right center; animation:slowZoom 22s ease-in-out infinite alternate}
@keyframes slowZoom{0%{transform:scale(1)}100%{transform:scale(1.24) translateX(-32px)}}
#heroFoto .overlay-foto{position:absolute; inset:0; background:linear-gradient(90deg, rgba(6,78,59,0.98) 0%, rgba(15,118,110,0.74) 42%, rgba(15,118,110,0.12) 100%); pointer-events:none; z-index:2}
#heroFoto .caption-foto{position:absolute; top:50%; left:6%; transform:translateY(-50%); z-index:4; color:white; max-width:680px}
#heroFoto .carousel-indicators{bottom:38px; z-index:6}
#heroFoto .carousel-indicators li{width:12px;height:12px;border-radius:5px;background:rgba(255,255,255,0.35);border:none;margin:0 5px;transition:all .45s}
#heroFoto .carousel-indicators li.active{width:44px;background:var(--teal2);box-shadow:0 0 12px rgba(20,184,166,0.6)}
.badge-mint{background:var(--mint);color:var(--teal);border-radius:30px;padding:9px 18px;font-weight:800;letter-spacing:0.6px;box-shadow:0 4px 15px rgba(20,184,166,0.2);animation:pulseBadge 2s infinite}
@keyframes pulseBadge{0%,100%{transform:scale(1)}50%{transform:scale(1.05)}}
.stat-foto{background:white; border-radius:20px; padding:26px; border:1px solid #e0f2f1; box-shadow:0 12px 44px rgba(15,118,110,0.08); transition:all .5s; animation:popUp .9s both; position:relative; overflow:hidden; z-index:5 !important; pointer-events:auto}
@keyframes popUp{from{opacity:0; transform:translateY(50px) scale(0.9)}to{opacity:1; transform:translateY(0) scale(1)}}
.stat-foto:hover{transform:translateY(-12px) scale(1.04); box-shadow:0 28px 70px rgba(15,118,110,0.2)}
.icon-mint{width:60px;height:60px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:22px;transition:all .5s}
.stat-foto:hover .icon-mint{transform:rotateY(180deg) scale(1.15)}
@keyframes shakeKritis{0%,100%{transform:translateX(0)}10%,30%,50%,70%,90%{transform:translateX(-3px)}20%,40%,60%,80%{transform:translateX(3px)}}
@keyframes glowRed{0%,100%{box-shadow:0 0 0 0 rgba(220,38,38,0.5), 0 8px 30px rgba(220,38,38,0.15)}50%{box-shadow:0 0 0 16px rgba(220,38,38,0), 0 12px 40px rgba(220,38,38,0.25)}}
.kritis-anim{animation:shakeKritis 3s infinite, glowRed 2.2s infinite; border-radius:18px; background:linear-gradient(90deg,#dc2626,#f87171); position:relative; overflow:hidden}
.program-card{position:relative; border-radius:22px; overflow:hidden; height:280px; background:var(--dark); cursor:pointer; z-index:5 !important}
.program-card img{width:100%; height:100%; object-fit:cover; transition:transform .8s}
.program-card:hover img{transform:scale(1.2) rotate(1.5deg)}
.program-overlay{position:absolute; inset:0; background:linear-gradient(0deg, rgba(6,78,59,0.97) 0%, rgba(6,78,59,0.18) 68%); padding:22px; display:flex; flex-direction:column; justify-content:flex-end; color:white; pointer-events:none; z-index:3}
.reveal{opacity:0; transform:translateY(36px); transition:all .95s cubic-bezier(0.4,0,0.2,1)}
.reveal.active{opacity:1; transform:translateY(0)}
.marquee{overflow:hidden; white-space:nowrap; background:var(--dark); padding:13px 0; border-top:1px solid rgba(204,251,241,0.1); border-bottom:1px solid rgba(204,251,241,0.1); position:relative; z-index:8; pointer-events:none}
.marquee-track{display:inline-flex; animation:marquee 32s linear infinite; pointer-events:auto}
@keyframes marquee{0%{transform:translateX(0)}100%{transform:translateX(-50%)}}
.cta-glow{position:relative; background:linear-gradient(135deg,var(--dark),var(--teal)); border-radius:26px; overflow:hidden}
.cta-glow::before{content:''; position:absolute; width:420px; height:420px; background:radial-gradient(circle, rgba(45,212,191,0.38), transparent 70%); top:-130px; right:-90px; animation:float 6s ease-in-out infinite; pointer-events:none}
@keyframes float{0%,100%{transform:translateY(0)}50%{transform:translateY(-26px)}}

/* FIX KLIK & SLIDER PANAH - WAJIB PALING BAWAH */
.stat-foto a, .uk-card a, .cta-glow a{position:relative !important; z-index:20 !important; pointer-events:auto !important; cursor:pointer !important}
#heroFoto .carousel-control-prev,
#heroFoto .carousel-control-next{
  position:absolute !important; top:0 !important; bottom:0 !important; width:8% !important;
  z-index:25 !important; pointer-events:auto !important; opacity:1 !important;
  display:flex !important; align-items:center !important; justify-content:center !important;
}
#heroFoto .ctrl{
  width:54px !important; height:54px !important;
  background:rgba(15,118,110,0.88) !important; border-radius:50% !important;
  backdrop-filter:blur(10px); border:1px solid rgba(255,255,255,0.25) !important;
  box-shadow:0 8px 24px rgba(0,0,0,0.3) !important;
  display:flex !important; align-items:center; justify-content:center;
  cursor:pointer !important; transition:all .3s !important;
}
#heroFoto .ctrl:hover{transform:scale(1.18) !important; background:var(--teal) !important}
</style>

<!-- ORNAMEN BACKGROUND -->
<div style="position:fixed; inset:0; pointer-events:none !important; z-index:0; overflow:hidden">
  <i class="fas fa-pills float-icon" style="top:12%; left:8%"></i>
  <i class="fas fa-heartbeat float-icon" style="top:22%; right:10%; animation-delay:1s"></i>
  <i class="fas fa-briefcase-medical float-icon" style="top:58%; left:6%; animation-delay:2s"></i>
  <i class="fas fa-user-nurse float-icon" style="top:72%; right:8%; animation-delay:1.5s"></i>
</div>

<!-- HERO -->
<div id="heroFoto" class="carousel slide carousel-fade" data-ride="carousel" data-interval="6000">
  <div class="float-orb orb1" style="top:10%; left:5%"></div>
  <div class="float-orb orb2" style="bottom:12%; right:5%"></div>
  <div class="float-orb orb3" style="top:45%; left:40%"></div>
  <div class="dots-grid"></div>
  <ol class="carousel-indicators"><li data-target="#heroFoto" data-slide-to="0" class="active"></li><li data-target="#heroFoto" data-slide-to="1"></li><li data-target="#heroFoto" data-slide-to="2"></li></ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="assets/images/slider/slider2.jpg" class="elegant-img" onerror="this.src='assets/images/slider/slider3.jpg'">
      <div class="overlay-foto"></div>
      <div class="caption-foto">
        <div class="badge-mint mb-3 shimmer"><i class="fas fa-bolt mr-2"></i> Live Monitoring • <?= date('d M Y') ?></div>
        <h1 class="font-weight-bold" style="font-size:68px;line-height:0.9; text-shadow:0 8px 30px rgba(0,0,0,0.3)">Real-time</h1>
        <p class="mt-3 mb-4" style="font-size:19px;opacity:0.93"><span class="countup" data-target="<?= $totalObat ?>"><?= $totalObat ?></span> Jenis Obat, <span class="countup" data-target="<?= $totalHariIni ?>"><?= $totalHariIni ?></span> Pasien Hari Ini • Update otomatis tiap detailpenanganan</p>
        <a href="index.php?halaman=daftarobat" class="btn rounded-pill px-5 font-weight-bold text-white shadow-lg shimmer" style="background:var(--teal2);padding:14px 32px; position:relative; z-index:20; pointer-events:auto">Katalog Obat <i class="fas fa-arrow-right ml-2"></i></a>
      </div>
    </div>
    <div class="carousel-item">
      <img src="assets/images/slider/slider1.png" class="elegant-img" onerror="this.src='assets/images/slider/slider2.jpg'">
      <div class="overlay-foto"></div>
      <div class="caption-foto">
        <span class="badge-mint mb-3">SMK Negeri 1 Karang Baru • Aceh Tamiang</span>
        <h1 class="font-weight-bold" style="font-size:56px;line-height:1">Islami Terampil<br><span style="color:#5eead4">Siap Bersaing Global</span></h1>
        <p class="mt-3 opacity-80">🚑 UKS DIGITAL - Zulaika Fatarani 0103786196 - XI RPL 2 - 7 Entitas ERD FIX</p>
        <a href="index.php?halaman=cekriwayat" class="btn btn-light rounded-pill px-4 font-weight-bold mt-2 shadow" style="color:var(--teal); position:relative; z-index:20; pointer-events:auto">Cek Riwayat Medis</a>
      </div>
    </div>
    <div class="carousel-item">
      <img src="assets/images/slider/slider3.jpg" class="elegant-img" onerror="this.src='assets/images/slider/slider2.jpg'">
      <div class="overlay-foto"></div>
      <div class="caption-foto">
        <h1 class="font-weight-bold" style="font-size:56px">💊 Stok Obat<br>Real-time & Aman</h1>
        <p class="mt-3" style="color:#99f6e0">Potong stok otomatis via detailpenanganan + Alert H-30 Expired</p>
        <a href="index.php?halaman=daftarobat" class="btn rounded-pill px-4 mt-2 text-white" style="background:var(--teal2); position:relative; z-index:20; pointer-events:auto">Lihat Sediaan</a>
      </div>
    </div>
  </div>
  <!-- KURSOR SLIDER - SUDAH FIX BISA DIPENCET -->
  <a class="carousel-control-prev" href="#heroFoto" role="button" data-slide="prev"><span class="ctrl"><i class="fas fa-chevron-left text-white"></i></span></a>
  <a class="carousel-control-next" href="#heroFoto" role="button" data-slide="next"><span class="ctrl"><i class="fas fa-chevron-right text-white"></i></span></a>
</div>

<div class="marquee"><div class="marquee-track"><span class="mx-5" style="color:#5eead4;font-weight:800"><i class="fas fa-star text-warning mr-2"></i> UKS Sehat, Siswa Hebat!</span><span class="mx-5" style="color:white"><i class="fas fa-hand-sparkles mr-2" style="color:var(--teal2)"></i> Jaga Kebersihan Lingkungan Melalui PHBS</span><span class="mx-5" style="color:#5eead4"><i class="fas fa-pills mr-2"></i> Pastikan Stok Kritis Segera Diperbarui Via Panel Inventaris</span><span class="mx-5" style="color:white"><i class="fas fa-chart-line mr-2"></i> Laporan Harian/Bulanan/Tahunan PDF 1 Klik</span></div></div>

<div class="container" style="margin-top:-86px;position:relative;z-index:10">
  <div class="row">
    <div class="col-md-3 col-6 mb-4"><div class="stat-foto h-100" style="animation-delay:.05s"><div class="d-flex justify-content-between position-relative" style="z-index:2"><div><div style="font-size:11px;letter-spacing:1.4px;font-weight:800;color:#64748b">OBAT & ALKES</div><div class="countup" data-target="<?= $totalObat ?>" style="font-size:38px;font-weight:800;color:var(--dark)"><?= $totalObat ?></div><span class="badge px-2 py-1 mt-1" style="background:var(--mint);color:var(--teal);border-radius:8px;font-size:11px;font-weight:700">Ready Stock</span></div><div class="icon-mint" style="background:var(--mint);color:var(--teal)"><i class="fas fa-pills"></i></div></div><a href="index.php?halaman=daftarobat" class="d-block mt-3 small font-weight-bold" style="color:var(--teal);text-decoration:none">Katalog <i class="fas fa-arrow-right ml-1"></i></a></div></div>
    <div class="col-md-3 col-6 mb-4"><div class="stat-foto h-100" style="animation-delay:.15s"><div class="d-flex justify-content-between position-relative" style="z-index:2"><div><div style="font-size:11px;letter-spacing:1.4px;font-weight:800;color:#64748b">SISWA</div><div class="countup" data-target="<?= $totalSiswa ?>" style="font-size:38px;font-weight:800;color:var(--dark)"><?= $totalSiswa ?></div><span class="badge px-2 py-1 mt-1" style="background:#f1f5f9;color:#475569;border:1px solid #e2e8f0;border-radius:8px;font-size:11px">Terdata</span></div><div class="icon-mint" style="background:#e0f2fe;color:#0369a1"><i class="fas fa-user-graduate"></i></div></div><a href="index.php?halaman=cekriwayat" class="d-block mt-3 small font-weight-bold" style="color:var(--teal);text-decoration:none">Cek Data <i class="fas fa-arrow-right ml-1"></i></a></div></div>
    <div class="col-md-3 col-6 mb-4"><div class="stat-foto h-100" style="animation-delay:.25s"><div class="d-flex justify-content-between position-relative" style="z-index:2"><div><div style="font-size:11px;letter-spacing:1.4px;font-weight:800;color:#64748b">KATEGORI</div><div class="countup" data-target="<?= $totalKategori ?>" style="font-size:38px;font-weight:800;color:var(--dark)"><?= $totalKategori ?></div><span class="badge px-2 py-1 mt-1" style="background:#f1f5f9;color:#475569;border:1px solid #e2e8f0;border-radius:8px;font-size:11px">Klasifikasi</span></div><div class="icon-mint" style="background:#fef9c3;color:#a16207"><i class="fas fa-tags"></i></div></div><a href="index.php?halaman=daftarkategori" class="d-block mt-3 small font-weight-bold" style="color:var(--teal);text-decoration:none">Filter <i class="fas fa-arrow-right ml-1"></i></a></div></div>
    <div class="col-md-3 col-6 mb-4"><div class="stat-foto h-100 text-white" style="background:linear-gradient(135deg,var(--dark),var(--teal));border:none;animation-delay:.35s"><div class="d-flex justify-content-between position-relative" style="z-index:2"><div><div style="font-size:11px;letter-spacing:1.4px;font-weight:800;color:#5eead4">PASIEN HARI INI</div><div class="countup text-white" data-target="<?= $totalHariIni ?>" style="font-size:38px;font-weight:800"><?= $totalHariIni ?></div><span class="badge bg-white px-2 py-1 mt-1" style="color:var(--teal);border-radius:8px;font-size:11px">Live</span></div><div class="icon-mint" style="background:rgba(255,255,255,0.14);color:white"><i class="fas fa-heartbeat"></i></div></div><a href="index.php?halaman=loginuser" class="d-block mt-3 small font-weight-bold text-white" style="text-decoration:none">Lihat Penanganan <i class="fas fa-arrow-right ml-1"></i></a></div></div>
  </div>
</div>

<div class="container py-5">
  <div class="row">
    <div class="col-lg-7 mb-4 reveal">
      <h3 class="section-title mb-4"><i class="fas fa-chart-line mr-2" style="color:var(--teal)"></i> Analisis & Peringatan Dini</h3>
      <?php if(mysqli_num_rows($queryKritis) > 0): ?>
        <div class="kritis-anim text-white p-4 mb-4 shadow-lg">
          <div class="d-flex align-items-center justify-content-between position-relative" style="z-index:2">
            <div><strong class="d-block"><i class="fas fa-exclamation-triangle mr-2"></i> PERINGATAN LOGISTIK - TETAP ANIMASI GETAR & GLOW</strong><small style="opacity:0.9">Terdapat <?= mysqli_num_rows($queryKritis) ?> obat mendekati kedaluwarsa / stok <=5</small></div>
            <a href="index.php?halaman=daftarobat" class="btn btn-sm btn-light font-weight-bold text-danger" style="border-radius:12px; position:relative; z-index:20; pointer-events:auto">Cek Detail</a>
          </div>
          <div class="mt-3 position-relative" style="z-index:2"><?php mysqli_data_seek($queryKritis,0); while($kr=mysqli_fetch_assoc($queryKritis)): ?><span class="d-inline-flex align-items-center mr-2 mb-2 px-3 py-2" style="background:rgba(0,0,0,0.22);border-radius:30px;border:1px solid rgba(255,255,255,0.25);font-size:12px"><i class="fas fa-capsules mr-2"></i><?= htmlspecialchars($kr['namabarang']) ?> • S:<?= $kr['stok'] ?></span><?php endwhile; ?></div>
        </div>
      <?php endif; ?>
      <div class="uk-card p-4 shimmer"><h5 class="font-weight-bold mb-3" style="color:var(--dark)">Tren Keluhan Siswa (30 Hari Terakhir)</h5><canvas id="chartTrenKesehatan" height="150"></canvas></div>
    </div>
    <div class="col-lg-5 mb-4 reveal">
      <h3 class="section-title mb-4"><i class="fas fa-boxes mr-2" style="color:var(--teal)"></i> Logistik Terbaru</h3>
      <div class="uk-card p-4">
        <h5 class="font-weight-bold mb-3" style="color:var(--dark)">Daftar Obat Masuk Terakhir</h5>
        <div class="table-responsive"><table class="table table-borderless table-hover"><thead><tr class="text-muted" style="font-size:12px"><th>Nama Obat</th><th>Kategori</th><th>Stok</th></tr></thead><tbody><?php mysqli_data_seek($queryObatBaru,0); while($row = mysqli_fetch_assoc($queryObatBaru)): ?><tr><td><strong style="color:var(--dark)"><?= htmlspecialchars($row['namabarang']); ?></strong></td><td><span class="badge px-2 py-1" style="background:var(--mint);color:var(--teal);border-radius:20px;font-size:11px"><?= htmlspecialchars($row['namakategori']); ?></span></td><td><span class="font-weight-bold <?= $row['stok'] <=5 ? 'text-danger' : '' ?>" style="<?= $row['stok']>5?'color:var(--teal)':'' ?>"><?= $row['stok']; ?></span></td></tr><?php endwhile; ?></tbody></table></div>
        <a href="index.php?halaman=daftarobat" class="btn btn-block rounded-pill mt-3 font-weight-bold" style="background:var(--mint2);color:var(--teal); position:relative; z-index:20; pointer-events:auto">Lihat Inventaris Lengkap <i class="fas fa-arrow-right ml-1"></i></a>
      </div>
    </div>
  </div>
</div>

<div class="container py-4">
  <div class="text-center mb-5 reveal"><span class="badge-mint">PROGRAM KERJA NYATA - 6 PILAR</span><h3 class="section-title mt-3"><i class="fas fa-heart text-danger mr-2"></i> Program & Kegiatan UKS</h3></div>
  <div class="row">
    <?php foreach($programUKS as $i=>$p): ?>
      <div class="col-md-4 mb-4 reveal" style="transition-delay:<?= $i*0.08 ?>s"><div class="program-card uk-card" style="border:none"><img src="assets/images/program/<?= $p['foto']; ?>" onerror="this.src='assets/images/slider/slider<?= ($i%3)+1 ?>.jpg'"><div class="program-overlay"><span style="font-size:26px" class="mb-2"><i class="fas <?= $p['icon']; ?>" style="color:var(--teal2)"></i></span><h5 class="font-weight-bold m-0"><?= $p['judul']; ?></h5><p class="small m-0" style="opacity:0.85"><?= $p['desc']; ?></p></div></div></div>
    <?php endforeach; ?>
  </div>
</div>

<section class="py-5" style="background:var(--mint2); position:relative; overflow:hidden"><div class="float-orb orb2" style="top:5%; right:-80px; pointer-events:none"></div><div class="container position-relative" style="z-index:2"><div class="d-flex justify-content-between align-items-center mb-4 reveal"><h3 class="section-title mb-0">Pasokan Terbaru <span class="badge ml-2" style="background:var(--teal);color:white;border-radius:20px;font-size:12px"><?= $totalObat ?> Item</span></h3><a href="index.php?halaman=daftarobat" class="btn rounded-pill px-4 font-weight-bold" style="background:white;border:1px solid #ccfbf1;color:var(--teal); position:relative; z-index:20; pointer-events:auto">Lihat Semua <i class="fas fa-arrow-right ml-1"></i></a></div><div class="row"><?php mysqli_data_seek($queryObatBaru,0); while($obat=mysqli_fetch_assoc($queryObatBaru)): $base=__DIR__.'/../../assets/images/barang/'; $baseUrl='assets/images/barang/'; $gambar=$baseUrl.'default_obat.png'; if(!empty($obat['foto']) && file_exists($base.$obat['foto'])) $gambar=$baseUrl.$obat['foto']; elseif(file_exists($base.$obat['idbarang'].'.jpg')) $gambar=$baseUrl.$obat['idbarang'].'.jpg'; elseif(file_exists($base.$obat['idbarang'].'.png')) $gambar=$baseUrl.$obat['idbarang'].'.png'; ?><div class="col-md-3 col-6 mb-4 reveal"><div class="uk-card h-100 overflow-hidden shimmer"><div style="height:180px;background:white" class="d-flex align-items-center justify-content-center p-3 position-relative"><span class="badge" style="position:absolute;top:10px;left:10px;background:var(--mint);color:var(--teal);border-radius:20px;font-size:10px;z-index:2"><?= htmlspecialchars($obat['namakategori'] ?? 'Umum'); ?></span><img src="<?= $gambar; ?>" style="max-height:100%;object-fit:contain;transition:transform .6s" onmouseover="this.style.transform='scale(1.18) rotate(2deg)'" onmouseout="this.style.transform='scale(1)'" onerror="this.src='assets/images/barang/default_obat.png'"></div><div class="p-3"><h6 class="font-weight-bold mt-1 mb-1" style="color:var(--dark);font-size:14px"><?= htmlspecialchars($obat['namabarang']); ?></h6><small class="text-muted">Stok <?= $obat['stok']; ?> <?= $obat['satuan']; ?></small><a href="index.php?halaman=detailobat&id=<?= $obat['idbarang']; ?>" class="btn btn-block rounded-pill mt-3 font-weight-bold text-white" style="background:var(--teal); position:relative; z-index:20; pointer-events:auto">Aturan Pakai</a></div></div></div><?php endwhile; ?></div></div></section>

<div class="container py-5 reveal"><div class="cta-glow text-white p-5 text-center text-md-left d-md-flex align-items-center justify-content-between"><div style="position:relative;z-index:2;max-width:620px"><div class="badge-mint mb-2" style="background:rgba(255,255,255,0.15);color:white;border:1px solid rgba(255,255,255,0.22)">Verifikasi Mandiri • 0103786196 XI RPL 2</div><h2 class="font-weight-bold">Butuh Penanganan Cepat Sekarang?</h2><p class="m-0" style="opacity:0.85">Masuk ke modul pelayanan untuk mencatat pemeriksaan medis - Sistem potong stok otomatis via detailpenanganan</p></div><div class="mt-4 mt-md-0" style="position:relative;z-index:2"><a href="index.php?halaman=loginuser" class="btn btn-light btn-lg font-weight-bold px-5 py-3 shadow-lg shimmer" style="border-radius:16px;color:var(--teal); position:relative; z-index:20; pointer-events:auto"><i class="fas fa-plus-circle mr-2"></i> Input Tindakan UKS</a></div></div></div>

<script src="assets/plugins/chart.js/Chart.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function(){
  const ctx=document.getElementById('chartTrenKesehatan');
  if(ctx){ new Chart(ctx,{type:'bar',data:{labels:<?= json_encode($labelTren); ?>,datasets:[{label:'Jumlah Kasus',data:<?= json_encode($dataTren); ?>,backgroundColor:'rgba(20,184,166,0.68)',borderColor:'#14b8a6',borderWidth:2,borderRadius:10,barThickness:46,hoverBackgroundColor:'#0f766e'}]},options:{responsive:true,animation:{duration:2000, easing:'easeOutBounce'},plugins:{legend:{display:false}},scales:{y:{beginAtZero:true,ticks:{precision:0},grid:{color:'#f0fdfa'}},x:{grid:{display:false},ticks:{color:'#064e3b',font:{weight:'700'}}}}}}); }
  document.querySelectorAll('.countup').forEach(el=>{
    let target=parseInt(el.dataset.target||el.textContent.replace(/,/g,'')); if(isNaN(target)) return;
    let cur=0; let inc=target/60; let timer=setInterval(()=>{cur+=inc; if(cur>=target){cur=target; clearInterval(timer);} el.textContent=Math.floor(cur);},22);
  });
  const reveals=document.querySelectorAll('.reveal');
  const obs=new IntersectionObserver(entries=>{entries.forEach(e=>{if(e.isIntersecting){e.target.classList.add('active')}})},{threshold:0.12});
  reveals.forEach(r=>obs.observe(r));
});
</script>