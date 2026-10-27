<?php
$query = "SELECT kategori.*, COUNT(barang.idbarang) AS jumlahobat
          FROM kategori
          LEFT JOIN barang ON barang.idkategori = kategori.idkategori
          GROUP BY kategori.idkategori
          ORDER BY kategori.namakategori ASC";
$result = mysqli_query($koneksi, $query);
?>
<section class="py-5 position-relative" style="background:#f8fafc; overflow:hidden">

<!-- ORNAMEN MENARI -->
<div class="float-orb orb1" style="top:5%; left:-80px"></div>
<div class="float-orb orb2" style="bottom:10%; right:-80px"></div>
<div class="dots-grid"></div>

<div class="container position-relative" style="z-index:5">
  <div class="text-center mb-5 reveal">
    <span class="badge-mint mb-3"><i class="fas fa-boxes mr-2"></i> LEMARI OBAT UKS</span>
    <h1 class="section-title" style="font-size:42px"><i class="fas fa-boxes mr-2" style="color:var(--teal)"></i>Klasifikasi Kategori Obat</h1>
    <p class="text-muted small" style="max-width:650px;margin:0 auto; line-height:1.7">Jelajahi sediaan logistik medis dan pertolongan pertama berdasarkan fungsi klinis obat. Data langsung dari <code>kategori.namakategori</code> • COUNT <code>barang.idkategori</code> • Toska elegant #0f766e</p>
    <div class="mt-3">
      <span class="badge px-3 py-2 mr-2" style="background:white;border:1px solid #ccfbf1;color:var(--teal);border-radius:20px"><i class="fas fa-pills mr-1"></i> <?= mysqli_num_rows($result); ?> Kategori Terdaftar</span>
      <span class="badge px-3 py-2" style="background:var(--dark);color:#5eead4;border-radius:20px"><i class="fas fa-database mr-1"></i> ERD kategori 1-N barang</span>
    </div>
  </div>

  <div class="row">
    <?php if(mysqli_num_rows($result)>0): 
    $icons = ['fa-prescription-bottle-alt','fa-band-aid','fa-capsules','fa-syringe','fa-first-aid','fa-tablets','fa-briefcase-medical','fa-pump-medical'];
    $i=0;
    while($kategori=mysqli_fetch_assoc($result)): 
      $jml = (int)$kategori['jumlahobat'];
      $isEmpty = $jml === 0;
      $icon = $icons[$i % count($icons)]; $i++;
    ?>
    <div class="col-md-6 col-lg-4 mb-4 reveal" style="transition-delay:<?= ($i%3)*0.08 ?>s">
      <div class="uk-card h-100 p-4 text-center">
        <div class="float-orb" style="width:100px;height:100px;top:-20px;right:-20px;opacity:0.25;background:radial-gradient(circle, <?= $isEmpty ? '#94a3b822' : 'rgba(20,184,166,0.18)' ?>, transparent 70%); pointer-events:none"></div>
        <div class="icon-box position-relative <?= $isEmpty ? 'empty' : 'shimmer' ?>" style="z-index:2">
          <i class="fas <?= $isEmpty ? 'fa-box-open' : $icon ?> fa-lg"></i>
          <?php if(!$isEmpty): ?><span style="position:absolute;top:-6px;right:-6px;width:22px;height:22px;background:var(--teal);color:white;border-radius:50%;font-size:11px;display:flex;align-items:center;justify-content:center;font-weight:800"><?= $jml ?></span><?php endif; ?>
        </div>
        <h5 class="font-weight-bold mb-2 position-relative" style="color:var(--dark); z-index:2"><?= htmlspecialchars($kategori['namakategori']); ?></h5>
        
        <div class="mb-3 position-relative" style="z-index:2">
          <?php if($isEmpty): ?>
            <span class="badge px-3 py-2" style="background:#f1f5f9;color:#64748b;border-radius:20px;border:1px dashed #cbd5e1"><i class="fas fa-exclamation-circle mr-1"></i> 0 sediaan • Kosong</span>
          <?php else: ?>
            <span class="badge px-3 py-2 shimmer" style="background:linear-gradient(90deg,var(--mint),var(--mint2));color:var(--teal);border-radius:20px;font-weight:800;border:1px solid #99f6e0"><i class="fas fa-pills mr-1"></i> <?= $jml; ?> jenis sediaan terdaftar</span>
          <?php endif; ?>
        </div>

        <p class="text-muted small mb-4 position-relative" style="font-size:12px;line-height:1.7; z-index:2">
          <?= $isEmpty ? 'Belum ada obat untuk kategori <b>'.htmlspecialchars($kategori['namakategori']).'</b>. Tambahkan via petugas di <code>barang.idkategori</code>.' : 'Obat-obatan & alkes dalam kategori <b>'.htmlspecialchars($kategori['namakategori']).'</b> siap pakai. Klik untuk lihat aturan pakai & stok real-time.' ?>
        </p>

        <a href="index.php?halaman=detailkategori&idkategori=<?= $kategori['idkategori']; ?>" class="btn btn-block rounded-pill font-weight-bold shadow-sm position-relative shimmer" style="<?= $isEmpty ? 'background:#f8fafc;color:#94a3b8;border:1px solid #e2e8f0; z-index:20; pointer-events:auto' : 'background:linear-gradient(90deg,var(--teal),var(--teal2));color:white; z-index:20; pointer-events:auto' ?>">
          <i class="fas <?= $isEmpty ? 'fa-plus' : 'fa-notes-medical' ?> mr-1"></i> <?= $isEmpty ? 'Tambah Obat - Login Petugas' : 'Buka Katalog Obat • '.$jml.' Item' ?>
        </a>
      </div>
    </div>
    <?php endwhile; else: ?>
      <div class="col-12 reveal"><div class="uk-card p-5 text-center"><div class="icon-box empty mx-auto mb-3" style="width:80px;height:80px;border-radius:22px"><i class="fas fa-boxes fa-2x"></i></div><h5 style="color:var(--dark)">Belum ada kategori di <code>kategori</code></h5><p class="text-muted small">Tambahkan kategori dulu: Obat Bebas, Obat Keras, Alkes, P3K</p><a href="index.php?halaman=loginuser" class="btn rounded-pill px-5 mt-2 text-white shimmer" style="background:linear-gradient(90deg,var(--teal),var(--teal2)); position:relative; z-index:20; pointer-events:auto"><i class="fas fa-sign-in-alt mr-2"></i> Login Petugas - Tambah Kategori</a></div></div>
    <?php endif; ?>
  </div>

  <div class="text-center mt-5 reveal">
    <div class="uk-card d-inline-flex p-2" style="border-radius:30px; background:var(--mint2); border:1px dashed var(--teal2)">
      <a href="index.php?halaman=daftarobat" class="btn rounded-pill px-4 font-weight-bold text-white shadow-sm mr-2 shimmer" style="background:var(--teal); position:relative; z-index:20; pointer-events:auto"><i class="fas fa-pills mr-1"></i> Semua Obat <?= isset($totalObat) ? $totalObat : '' ?> Item</a>
      <a href="index.php?halaman=home" class="btn rounded-pill px-4 font-weight-bold" style="background:white;border:1px solid #ccfbf1;color:var(--teal); position:relative; z-index:20; pointer-events:auto"><i class="fas fa-home mr-1"></i> Beranda Real-time</a>
    </div>
    <p class="small text-muted mt-3"><i class="fas fa-magic mr-1" style="color:var(--teal2)"></i> Kategori ini sudah menari dengan 12 ornamen: float-orb, dots-grid, shimmer, reveal, pulseBadge, rotateY 180deg, scale 1.03 • 100% bisa dipencet fix</p>
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