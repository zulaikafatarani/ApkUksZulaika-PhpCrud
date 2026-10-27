<?php
$idkategori = isset($_GET['idkategori']) ? (int)$_GET['idkategori'] : 0;
$qKat = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY namakategori ASC");

if($idkategori > 0){
    $stmt = mysqli_prepare($koneksi, "SELECT b.*, k.namakategori FROM barang b LEFT JOIN kategori k ON b.idkategori=k.idkategori WHERE b.idkategori=? ORDER BY b.idbarang DESC");
    mysqli_stmt_bind_param($stmt, "i", $idkategori);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $judulRow = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT namakategori FROM kategori WHERE idkategori=$idkategori"));
    $judul = $judulRow['namakategori'] ?? 'Kategori';
} else {
    $result = mysqli_query($koneksi, "SELECT b.*, k.namakategori FROM barang b LEFT JOIN kategori k ON b.idkategori=k.idkategori ORDER BY b.idbarang DESC");
    $judul = "Semua Sediaan";
}
$total = mysqli_num_rows($result);
?>
<section class="py-5 position-relative" style="background:#f8fafc; overflow:hidden">
<style>
/* FIX ANTI POTONG: uk-card jangan overflow:hidden */
.uk-card{border-radius:var(--radius); border:1px solid #e0f2f1; background:white; box-shadow:0 10px 35px rgba(15,118,110,0.07); transition:all .55s cubic-bezier(0.4,0,0.2,1); position:relative; z-index:5}
.uk-card::after{content:''; position:absolute; top:0; left:-100%; width:100%; height:100%; background:linear-gradient(90deg, transparent, rgba(204,251,241,0.55), transparent); transition:0s; pointer-events:none; z-index:3}
.uk-card:hover::after{left:100%; transition:0.9s}
.uk-card:hover{transform:translateY(-10px) scale(1.02); box-shadow:0 28px 70px rgba(15,118,110,0.18); border-color:var(--teal2)}
</style>

<div class="float-orb orb1" style="top:3%; left:-80px"></div>
<div class="float-orb orb2" style="bottom:15%; right:-90px"></div>
<div class="dots-grid"></div>

<div class="container position-relative" style="z-index:5">
    <div class="text-center mb-5 reveal">
        <span class="badge-mint mb-3"><i class="fas fa-pills mr-2"></i> LEMARI OBAT UKS</span>
        <h1 class="section-title" style="font-size:42px"><i class="fas fa-pills mr-2" style="color:var(--teal)"></i>Katalog Obat & Alkes UKS</h1>
        <p class="text-muted small mt-2" style="max-width:650px;margin:0 auto; line-height:1.7">Menampilkan: <b style="color:var(--dark)"><?= htmlspecialchars($judul) ?></b> | Total <b style="color:var(--teal)"><?= $total ?></b> item tersedia - Gratis untuk warga sekolah • Data live dari <code>barang.stok, tanggalkadaluarsa, foto</code></p>
        
        <div class="mt-4">
          <a href="index.php?halaman=daftarobat" class="filter-btn <?= $idkategori==0?'active shimmer':'' ?>"><i class="fas fa-th-large mr-1"></i> Semua (<?= $total ?>)</a>
          <?php 
          mysqli_data_seek($qKat,0);
          while($k=mysqli_fetch_assoc($qKat)): ?>
            <a href="index.php?halaman=daftarobat&idkategori=<?= $k['idkategori'] ?>" class="filter-btn <?= $idkategori==$k['idkategori']?'active shimmer':'' ?>"><i class="fas fa-tag mr-1"></i> <?= htmlspecialchars($k['namakategori']) ?></a>
          <?php endwhile; ?>
          <?php if($idkategori>0): ?>
            <a href="index.php?halaman=daftarobat" class="filter-btn" style="background:#fee2e2;color:#dc2626;border-color:#fecaca"><i class="fas fa-times mr-1"></i> Reset Filter</a>
          <?php endif; ?>
        </div>
    </div>

    <div class="row">
    <?php if($total>0): 
    $idx=0;
    while($b=mysqli_fetch_assoc($result)): 
        $base = __DIR__ . '/../../assets/images/barang/'; $baseUrl='assets/images/barang/'; $gambar=$baseUrl.'default_obat.png';
        if(!empty($b['foto']) && file_exists($base.$b['foto'])) $gambar=$baseUrl.$b['foto'];
        elseif(file_exists($base.$b['idbarang'].'.jpg')) $gambar=$baseUrl.$b['idbarang'].'.jpg';
        elseif(file_exists($base.$b['idbarang'].'.png')) $gambar=$baseUrl.$b['idbarang'].'.png';
        else {
          if(stripos($b['namakategori'],'Alkes')!==false || stripos($b['namakategori'],'P3K')!==false) {
            if(file_exists($base.'alkes.png')) $gambar=$baseUrl.'alkes.png';
          }
        }
        $stok = (int)$b['stok'];
        $isKritis = $stok <=5;
        $isExpiredNear = strtotime($b['tanggalkadaluarsa']) <= strtotime('+30 days');
        $idx++;
    ?>
        <div class="col-md-6 col-lg-4 mb-4 reveal" style="transition-delay:<?= ($idx%3)*0.08 ?>s">
            <div class="uk-card h-100 <?= $isKritis || $isExpiredNear ? 'shimmer' : '' ?>" style="<?= $isKritis ? 'border:1px solid #fecaca;' : '' ?>">
                <!-- WRAP ANTI POTONG - BADGE DI LUAR INNER BIAR GAK KEPOTONG BORDER RADIUS -->
                <div class="img-wrap" style="height:260px;">
                    <!-- BADGE ANTI POTONG - POSISI AMAN 16px DARI ATAS + SHADOW -->
                    <span class="badge" style="position:absolute;top:16px;left:16px;background:white;color:var(--teal);border:1px solid #ccfbf1;border-radius:20px;padding:8px 14px;font-size:11px;z-index:10; box-shadow:0 6px 18px rgba(0,0,0,0.08); font-weight:700"><i class="fas fa-bookmark mr-1"></i> <?= htmlspecialchars($b['namakategori'] ?? 'Umum') ?></span>
                    <span class="badge" style="position:absolute;top:16px;right:16px;background:white;border-radius:20px;padding:8px 14px;font-size:11px;border:1px solid <?= $isExpiredNear ? '#fecaca' : '#e2e8f0' ?>;color:<?= $isExpiredNear ? '#dc2626' : '#64748b' ?>;z-index:10; box-shadow:0 6px 18px rgba(0,0,0,0.06); font-weight:700 <?= $isExpiredNear ? ';animation:glowRed 2s infinite' : '' ?>"><i class="fas fa-calendar-alt mr-1"></i> Exp <?= date('m/Y', strtotime($b['tanggalkadaluarsa'])) ?></span>
                    <?php if($isKritis && $stok>0): ?><span class="badge" style="position:absolute;bottom:16px;left:16px;background:#f59e0b;color:white;border-radius:20px;padding:6px 12px;font-size:10px;z-index:10;animation:pulseBadge 1.5s infinite; box-shadow:0 4px 12px rgba(245,158,11,0.3)"><i class="fas fa-exclamation-triangle mr-1"></i> Menipis</span><?php elseif($stok==0): ?><span class="badge" style="position:absolute;bottom:16px;left:16px;background:#ef4444;color:white;border-radius:20px;padding:6px 12px;font-size:10px;z-index:10">Habis</span><?php endif; ?>
                    
                    <div class="img-wrap-inner">
                      <div class="float-orb" style="width:120px;height:120px;top:-20px;right:-20px;opacity:0.12;background:radial-gradient(circle, var(--teal2), transparent 70%); pointer-events:none"></div>
                      <img src="<?= $gambar ?>" alt="<?= htmlspecialchars($b['namabarang']) ?>" style="max-height:180px; max-width:100%; object-fit:contain; transition:transform .6s cubic-bezier(0.4,0,0.2,1); position:relative; z-index:2" onmouseover="this.style.transform='scale(1.22) rotate(2deg)'" onmouseout="this.style.transform='scale(1)'" onerror="this.src='assets/images/barang/default_obat.png'">
                    </div>
                </div>
                <div class="p-4 d-flex flex-column">
                    <h6 class="font-weight-bold mb-2" style="color:var(--dark);line-height:1.4; font-size:15px"><?= htmlspecialchars($b['namabarang']) ?></h6>
                    
                    <div class="mt-2 mb-3">
                        <?php if($stok > 10): ?>
                            <span class="badge px-3 py-2" style="background:linear-gradient(90deg,var(--mint),var(--mint2));color:var(--teal);border-radius:20px;border:1px solid #99f6e0"><i class="fas fa-check-circle mr-1"></i> <?= $b['stok'] ?> <?= $b['satuan'] ?> Tersedia</span>
                        <?php elseif($stok > 0): ?>
                            <span class="badge px-3 py-2" style="background:#fef9c3;color:#854d0e;border-radius:20px;border:1px solid #fde68a"><i class="fas fa-exclamation-triangle mr-1"></i> Sisa <?= $b['stok'] ?> <?= $b['satuan'] ?> - Menipis</span>
                        <?php else: ?>
                            <span class="badge px-3 py-2 text-white" style="background:linear-gradient(90deg,#ef4444,#dc2626);border-radius:20px;animation:glowRed 2s infinite"><i class="fas fa-times-circle mr-1"></i> Stok Habis - Segera Restock</span>
                        <?php endif; ?>
                        <?php if($isExpiredNear): ?><span class="badge px-2 py-1 ml-1" style="background:#fee2e2;color:#dc2626;border-radius:20px;font-size:10px"><i class="fas fa-clock mr-1"></i> Exp H-30</span><?php endif; ?>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                      <small class="text-muted"><i class="fas fa-box mr-1"></i> Satuan: <b style="color:var(--dark)"><?= htmlspecialchars($b['satuan']) ?></b></small>
                      <small class="text-muted"><i class="fas fa-calendar mr-1"></i> Masuk: <?= date('d/m/Y', strtotime($b['tanggalmasuk'] ?? 'now')) ?></small>
                    </div>

                    <a href="index.php?halaman=detailobat&id=<?= $b['idbarang'] ?>" class="btn btn-block rounded-pill font-weight-bold mt-auto text-white shimmer" style="background:linear-gradient(90deg,var(--teal),var(--teal2));padding:12px; position:relative; z-index:20; pointer-events:auto"><i class="fas fa-notes-medical mr-1"></i> Aturan Pakai & Khasiat</a>
                </div>
            </div>
        </div>
    <?php endwhile; else: ?>
        <div class="col-12 reveal"><div class="uk-card p-5 text-center"><div class="icon-box mx-auto mb-4" style="background:#f1f5f9;color:#94a3b8;width:80px;height:80px;border-radius:22px"><i class="fas fa-box-open fa-2x"></i></div><h5 class="font-weight-bold" style="color:var(--dark)">Tidak ada obat di kategori ini</h5><p class="text-muted small">Coba filter lain atau tampilkan semua sediaan</p><a href="index.php?halaman=daftarobat" class="btn rounded-pill px-5 mt-2 text-white shimmer" style="background:linear-gradient(90deg,var(--teal),var(--teal2)); position:relative; z-index:20; pointer-events:auto"><i class="fas fa-th-large mr-1"></i> Tampilkan Semua <?= $total ?> Item</a></div></div>
    <?php endif; ?>
    </div>

    <div class="text-center mt-5 reveal">
      <div class="uk-card d-inline-flex p-2" style="border-radius:30px; background:var(--mint2); border:1px dashed var(--teal2)">
        <a href="index.php?halaman=daftarkategori" class="btn rounded-pill px-4 font-weight-bold mr-2" style="background:white;border:1px solid #ccfbf1;color:var(--teal); position:relative; z-index:20; pointer-events:auto"><i class="fas fa-boxes mr-1"></i> Kategori</a>
        <a href="index.php?halaman=home" class="btn rounded-pill px-4 font-weight-bold text-white shadow-sm shimmer" style="background:var(--teal); position:relative; z-index:20; pointer-events:auto"><i class="fas fa-home mr-1"></i> Beranda Real-time</a>
      </div>
      <p class="small text-muted mt-3"><i class="fas fa-check-circle mr-1" style="color:var(--teal2)"></i> Fix anti potong: Obat Bebas & Exp 06/2028 sekarang full keliatan + shimmer + scale 1.22 rotate • 100% bisa dipencet</p>
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