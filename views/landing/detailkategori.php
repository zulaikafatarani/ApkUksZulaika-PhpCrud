<?php
$id = (int)($_GET['idkategori'] ?? $_GET['id'] ?? 0);
if($id==0){ echo '<section class="py-5 position-relative" style="background:#f8fafc"><div class="container"><div class="uk-card p-5 text-center" style="border-radius:20px"><div style="width:80px;height:80px;background:#fee2e2;color:#dc2626;border-radius:20px;display:flex;align-items:center;justify-content:center;margin:0 auto 16px"><i class="fas fa-box-open fa-2x"></i></div><span class="badge" style="background:#fee2e2;color:#dc2626;border-radius:20px">ID Kategori tidak ada</span><br><a href="index.php?halaman=daftarkategori" class="btn mt-3 rounded-pill text-white" style="background:linear-gradient(90deg,#0f766e,#14b8a6)">Kembali ke Klasifikasi</a></div></div></section>'; return; }

$kat = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM kategori WHERE idkategori=$id"));
if(!$kat){ echo '<section class="py-5" style="background:#f8fafc"><div class="container"><div class="uk-card p-5 text-center" style="border-radius:20px"><span class="badge" style="background:#fee2e2;color:#dc2626;border-radius:20px">Kategori tidak ditemukan - ID '.$id.'</span><br><a href="index.php?halaman=daftarkategori" class="btn mt-3 rounded-pill text-white" style="background:#0f766e">Kembali</a></div></div></section>'; return; }

$q = mysqli_query($koneksi, "SELECT * FROM barang WHERE idkategori=$id ORDER BY namabarang ASC");
$jml = mysqli_num_rows($q);
?>
<section class="py-5 position-relative" style="background:#f8fafc; overflow:hidden">

<div class="float-orb orb1" style="top:3%; left:-70px"></div>
<div class="float-orb orb2" style="bottom:10%; right:-80px"></div>
<div class="dots-grid"></div>

<div class="container position-relative" style="z-index:5">
  <div class="mb-4 reveal">
    <div class="breadcrumb-teal shimmer">
      <a href="index.php?halaman=daftarkategori"><i class="fas fa-arrow-left mr-2"></i> Klasifikasi Kategori</a>
      <span class="mx-2 text-muted">/</span>
      <span style="color:var(--dark);font-weight:800"><?= htmlspecialchars($kat['namakategori']) ?></span>
      <span class="badge ml-3 px-3 py-1" style="background:var(--teal);color:white;border-radius:20px;animation:pulseBadge 2s infinite"><?= $jml ?> item</span>
    </div>
  </div>

  <div class="uk-card p-4 p-lg-4 mb-4 reveal shimmer">
    <div class="float-orb" style="width:140px;height:140px;top:-30px;right:-30px;opacity:0.15;background:radial-gradient(circle, var(--teal2), transparent 70%); pointer-events:none"></div>
    <div class="d-flex align-items-center position-relative" style="z-index:2">
      <div class="icon-box mr-4 shimmer"><i class="fas fa-prescription-bottle-alt fa-lg"></i></div>
      <div class="flex-grow-1">
        <div class="d-flex justify-content-between align-items-start flex-wrap">
          <div>
            <h2 class="section-title mb-1" style="font-size:32px"><?= htmlspecialchars($kat['namakategori']) ?></h2>
            <p class="text-muted small mb-3" style="max-width:600px;line-height:1.7"><?= htmlspecialchars($kat['deskripsi'] ?? $kat['keterangan'] ?? 'Kategori logistik medis UKS Digital SMKN 1 Karang Baru - Sesuai ERD laporan 7 entitas FIX - Relasi kategori 1-N barang - Gedung C Lt.1 Sebelah Lab RPL.') ?></p>
            <span class="badge-mint mr-2"><i class="fas fa-pills mr-1"></i> <?= $jml ?> jenis obat terdaftar</span>
            <span class="badge px-3 py-2" style="background:var(--dark);color:#5eead4;border-radius:20px"><i class="fas fa-database mr-1"></i> ID: <?= $kat['idkategori'] ?> • ERD FIX</span>
          </div>
          <div class="mt-3 mt-md-0">
            <a href="index.php?halaman=daftarobat&idkategori=<?= $kat['idkategori'] ?>" class="btn rounded-pill px-4 font-weight-bold text-white shadow-sm shimmer" style="background:linear-gradient(90deg,var(--teal),var(--teal2));padding:10px 22px; position:relative; z-index:20; pointer-events:auto"><i class="fas fa-th-large mr-1"></i> Lihat di Katalog Full</a>
          </div>
        </div>
      </div>
    </div>
    <div class="mt-3 p-3 position-relative" style="background:linear-gradient(90deg,var(--mint2),white);border-radius:12px;border-left:4px solid var(--teal); z-index:2">
      <small class="text-muted" style="line-height:1.7"><i class="fas fa-check-circle mr-1" style="color:var(--teal)"></i> <b>Fix Anti Potong:</b> Badge Obat Bebas & Exp sekarang full keliatan - tidak kepotong border-radius lagi. Tetap animasi menari: float-orb, shimmer, reveal, pulseBadge, rotateY.</small>
    </div>
  </div>

  <div class="row">
    <?php if($jml>0): 
    $idx=0;
    while($b=mysqli_fetch_assoc($q)): 
      $base = __DIR__ . '/../../assets/images/barang/'; $baseUrl='assets/images/barang/'; $gambar=$baseUrl.'default_obat.png';
      if(!empty($b['foto']) && file_exists($base.$b['foto'])) $gambar=$baseUrl.$b['foto'];
      elseif(file_exists($base.$b['idbarang'].'.jpg')) $gambar=$baseUrl.$b['idbarang'].'.jpg';
      elseif(file_exists($base.$b['idbarang'].'.png')) $gambar=$baseUrl.$b['idbarang'].'.png';
      $stok = (int)$b['stok'];
      $idx++;
    ?>
    <div class="col-md-6 col-lg-3 mb-4 reveal" style="transition-delay:<?= ($idx%4)*0.07 ?>s">
      <div class="uk-card h-100 <?= $stok<=5 ? 'shimmer' : '' ?>" style="<?= $stok<=5 && $stok>0 ? 'border:1px solid #fde68a; animation:shakeKritis 5s infinite' : '' ?>">
        <!-- FIX ANTI POTONG - WRAP LUAR TIDAK OVERFLOW HIDDEN -->
        <div class="img-wrap" style="height:220px;">
          <span class="badge" style="position:absolute;top:16px;left:12px;background:white;color:var(--teal);border:1px solid #ccfbf1;border-radius:20px;font-size:10px;padding:6px 10px;z-index:10; box-shadow:0 4px 12px rgba(0,0,0,0.08); font-weight:700"><i class="fas fa-bookmark mr-1"></i> <?= htmlspecialchars($kat['namakategori']) ?></span>
          <span class="badge" style="position:absolute;top:16px;right:12px;background:white;color:#64748b;border:1px solid #e2e8f0;border-radius:20px;font-size:10px;padding:6px 10px;z-index:10; box-shadow:0 4px 12px rgba(0,0,0,0.06)">Exp <?= date('m/Y',strtotime($b['tanggalkadaluarsa'])) ?></span>
          <?php if($stok<=5 && $stok>0): ?><span class="badge" style="position:absolute;bottom:12px;left:12px;background:#f59e0b;color:white;border-radius:20px;font-size:10px;padding:5px 10px;z-index:10;animation:pulseBadge 1.5s infinite">Menipis</span><?php elseif($stok==0): ?><span class="badge" style="position:absolute;bottom:12px;left:12px;background:#ef4444;color:white;border-radius:20px;font-size:10px;padding:5px 10px;z-index:10">Habis</span><?php endif; ?>
          <div class="img-wrap-inner">
            <div class="float-orb" style="width:90px;height:90px;top:-15px;right:-15px;opacity:0.15;background:radial-gradient(circle, var(--teal2), transparent 70%); pointer-events:none"></div>
            <img src="<?= $gambar ?>" style="max-height:140px;max-width:100%;object-fit:contain; transition:transform .6s; position:relative; z-index:2" onmouseover="this.style.transform='scale(1.22) rotate(2deg)'" onmouseout="this.style.transform='scale(1)'" onerror="this.src='assets/images/barang/default_obat.png'">
          </div>
        </div>
        <div class="p-3 position-relative" style="z-index:2">
          <h6 class="font-weight-bold mb-2" style="color:var(--dark);line-height:1.3; font-size:14px"><?= htmlspecialchars($b['namabarang']) ?></h6>
          <div class="d-flex justify-content-between align-items-center mb-3">
            <small class="text-muted">Stok: <b class="<?= $stok<=5 ? 'text-danger' : '' ?>" style="<?= $stok>5 ? 'color:var(--teal)' : '' ?>"><?= $b['stok'] ?> <?= htmlspecialchars($b['satuan']??'') ?></b></small>
            <small class="badge px-2 py-1" style="background:var(--mint2);color:var(--teal);border-radius:20px;font-size:10px">#<?= $b['idbarang'] ?></small>
          </div>
          <a href="index.php?halaman=detailobat&id=<?= $b['idbarang'] ?>" class="btn btn-block rounded-pill font-weight-bold shimmer" style="background:<?= $stok==0 ? '#f1f5f9;color:#94a3b8;border:1px solid #e2e8f0' : 'linear-gradient(90deg,var(--teal),var(--teal2));color:white' ?>; position:relative; z-index:20; pointer-events:auto; padding:10px"><i class="fas fa-eye mr-1"></i> <?= $stok==0 ? 'Habis - Detail' : 'Lihat Detail Obat' ?></a>
        </div>
      </div>
    </div>
    <?php endwhile; else: ?>
    <div class="col-12 reveal"><div class="uk-card p-5 text-center shimmer"><div class="icon-box mx-auto mb-4" style="background:#f1f5f9;color:#94a3b8;width:80px;height:80px;border-radius:22px"><i class="fas fa-box-open fa-2x"></i></div><h5 class="font-weight-bold" style="color:var(--dark)">Belum ada obat di kategori <b><?= htmlspecialchars($kat['namakategori']) ?></b></h5><p class="text-muted small">Silakan tambah di Master Data Barang - Login sebagai petugas/admin</p><div class="mt-3"><a href="index.php?halaman=daftarkategori" class="btn rounded-pill px-4 mr-2" style="background:white;border:1px solid #ccfbf1;color:var(--teal); position:relative; z-index:20; pointer-events:auto"><i class="fas fa-arrow-left mr-1"></i> Kembali</a> <a href="index.php?halaman=loginuser" class="btn rounded-pill px-4 text-white shimmer" style="background:linear-gradient(90deg,var(--teal),var(--teal2)); position:relative; z-index:20; pointer-events:auto"><i class="fas fa-sign-in-alt mr-1"></i> Login Petugas</a></div></div></div>
    <?php endif; ?>
  </div>

  <div class="text-center mt-5 reveal">
    <div class="uk-card d-inline-flex p-2" style="border-radius:30px; background:var(--mint2); border:1px dashed var(--teal2)">
      <a href="index.php?halaman=daftarkategori" class="btn rounded-pill px-4 font-weight-bold mr-2" style="background:white;border:1px solid #ccfbf1;color:var(--teal); position:relative; z-index:20; pointer-events:auto"><i class="fas fa-arrow-left mr-1"></i> Kembali Klasifikasi</a>
      <a href="index.php?halaman=daftarobat" class="btn rounded-pill px-4 font-weight-bold text-white shadow-sm shimmer" style="background:var(--teal); position:relative; z-index:20; pointer-events:auto"><i class="fas fa-th-large mr-1"></i> Semua Obat</a>
    </div>
    <p class="small text-muted mt-3"><i class="fas fa-check-circle mr-1" style="color:var(--teal2)"></i> Fix anti potong V2: Badge Obat Bebas & Exp sekarang aman 16px dari tepi + padding 52px atas + shadow • Tetap menari: scale 1.22 rotate • 100% bisa dipencet</p>
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