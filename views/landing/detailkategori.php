<?php
$id = (int)($_GET['idkategori'] ?? $_GET['id'] ?? 0);
if($id==0){ echo '<section class="py-5" style="background:#f8fafc"><div class="container"><div class="uk-card p-5 text-center" style="border-radius:18px"><span class="badge" style="background:#fee2e2;color:#dc2626;border-radius:20px">ID Kategori tidak ada</span><br><a href="index.php?halaman=daftarkategori" class="btn mt-3 rounded-pill text-white" style="background:#0f766e">Kembali</a></div></div></section>'; return; }

$kat = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM kategori WHERE idkategori=$id"));
if(!$kat){ echo '<section class="py-5" style="background:#f8fafc"><div class="container"><div class="uk-card p-5 text-center" style="border-radius:18px"><span class="badge" style="background:#fee2e2;color:#dc2626;border-radius:20px">Kategori tidak ditemukan</span></div></div></section>'; return; }

$q = mysqli_query($koneksi, "SELECT * FROM barang WHERE idkategori=$id ORDER BY namabarang ASC");
$jml = mysqli_num_rows($q);
?>
<section class="py-5" style="background:#f8fafc">
<style>
:root{ --teal:#0f766e; --teal2:#14b8a6; --mint:#ccfbf1; --mint2:#f0fdfa; --dark:#064e3b; --radius:18px; }
.uk-card{border-radius:var(--radius); border:1px solid #e0f2f1; background:white; box-shadow:0 8px 30px rgba(15,118,110,0.07); transition:.3s; overflow:hidden}
.uk-card:hover{transform:translateY(-4px); box-shadow:0 16px 40px rgba(15,118,110,0.12)}
.icon-box{width:72px;height:72px;border-radius:18px;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,var(--teal),var(--teal2));color:white}
.section-title{font-weight:800;color:var(--dark)}
.breadcrumb-teal{border-radius:30px;padding:8px 16px;background:var(--mint2);display:inline-flex;align-items:center;font-size:13px}
.breadcrumb-teal a{color:var(--teal);font-weight:700;text-decoration:none !important}
</style>

<div class="container">
  <!-- Breadcrumb Selaras -->
  <div class="mb-4">
    <div class="breadcrumb-teal">
      <a href="index.php?halaman=daftarkategori"><i class="fas fa-arrow-left mr-2"></i> Klasifikasi Kategori</a>
      <span class="mx-2 text-muted">/</span>
      <span style="color:var(--dark);font-weight:700"><?= htmlspecialchars($kat['namakategori']) ?></span>
    </div>
  </div>

  <!-- Header Kategori - Selaras Profil Pasien cekriwayat -->
  <div class="uk-card p-4 p-lg-4 mb-4">
    <div class="d-flex align-items-center">
      <div class="icon-box mr-4"><i class="fas fa-prescription-bottle-alt fa-lg"></i></div>
      <div class="flex-grow-1">
        <div class="d-flex justify-content-between align-items-start">
          <div>
            <h2 class="section-title mb-1"><?= htmlspecialchars($kat['namakategori']) ?></h2>
            <p class="text-muted small mb-2" style="max-width:500px;line-height:1.6"><?= htmlspecialchars($kat['deskripsi'] ?? $kat['keterangan'] ?? 'Kategori logistik medis UKS Digital SMKN 1 Karang Baru - Sesuai ERD laporan.') ?></p>
            <span class="badge px-3 py-2" style="background:var(--mint);color:var(--teal);border-radius:20px;font-weight:700"><i class="fas fa-pills mr-1"></i> <?= $jml ?> jenis obat terdaftar</span>
            <span class="badge px-3 py-2 ml-2" style="background:var(--mint2);color:var(--dark);border:1px solid #ccfbf1;border-radius:20px">ID: <?= $kat['idkategori'] ?></span>
          </div>
          <a href="index.php?halaman=daftarobat&idkategori=<?= $kat['idkategori'] ?>" class="btn rounded-pill px-4 d-none d-md-inline-block font-weight-bold" style="background:var(--mint);color:var(--teal)"><i class="fas fa-th-large mr-1"></i> Lihat di Katalog</a>
        </div>
      </div>
    </div>
  </div>

  <!-- List Obat di Kategori Ini - Selaras daftarobat -->
  <div class="row">
    <?php if($jml>0): while($b=mysqli_fetch_assoc($q)): 
      $base = __DIR__ . '/../../assets/images/barang/'; $baseUrl='assets/images/barang/'; $gambar=$baseUrl.'default_obat.png';
      if(!empty($b['foto']) && file_exists($base.$b['foto'])) $gambar=$baseUrl.$b['foto'];
      elseif(file_exists($base.$b['idbarang'].'.jpg')) $gambar=$baseUrl.$b['idbarang'].'.jpg';
      elseif(file_exists($base.$b['idbarang'].'.png')) $gambar=$baseUrl.$b['idbarang'].'.png';
      $stok = (int)$b['stok'];
    ?>
    <div class="col-md-6 col-lg-3 mb-4">
      <div class="uk-card h-100">
        <div style="height:180px;background:var(--mint2);display:flex;align-items:center;justify-content:center;padding:16px;position:relative">
          <span class="badge" style="position:absolute;top:12px;left:12px;background:white;color:var(--teal);border:1px solid var(--mint);border-radius:20px;font-size:10px;padding:5px 10px"><?= htmlspecialchars($kat['namakategori']) ?></span>
          <img src="<?= $gambar ?>" style="max-height:150px;max-width:100%;object-fit:contain" onerror="this.src='assets/images/barang/default_obat.png'">
        </div>
        <div class="p-3">
          <h6 class="font-weight-bold mb-2" style="color:var(--dark);line-height:1.3"><?= htmlspecialchars($b['namabarang']) ?></h6>
          <div class="d-flex justify-content-between align-items-center mb-2">
            <small class="text-muted">Stok: <b class="<?= $stok<=5 ? 'text-danger' : '' ?>" style="<?= $stok>5 ? 'color:var(--teal)' : '' ?>"><?= $b['stok'] ?> <?= htmlspecialchars($b['satuan']??'') ?></b></small>
            <small class="text-muted" style="font-size:11px">Exp <?= date('m/Y',strtotime($b['tanggalkadaluarsa'])) ?></small>
          </div>
          <?php if($stok<=5 && $stok>0): ?><div class="mb-2"><span class="badge px-2 py-1" style="background:#fef9c3;color:#854d0e;border-radius:20px;font-size:10px"><i class="fas fa-exclamation-triangle mr-1"></i> Menipis</span></div><?php elseif($stok==0): ?><div class="mb-2"><span class="badge px-2 py-1 text-white" style="background:#ef4444;border-radius:20px;font-size:10px"><i class="fas fa-times-circle mr-1"></i> Habis</span></div><?php endif; ?>
          <a href="index.php?halaman=detailobat&id=<?= $b['idbarang'] ?>" class="btn btn-block rounded-pill font-weight-bold mt-2" style="background:<?= $stok==0 ? '#f1f5f9;color:#94a3b8' : 'var(--mint);color:var(--teal)' ?>"><i class="fas fa-eye mr-1"></i> Lihat Detail</a>
        </div>
      </div>
    </div>
    <?php endwhile; else: ?>
    <div class="col-12"><div class="uk-card p-5 text-center"><div class="icon-box mx-auto mb-3" style="background:#f1f5f9;color:#94a3b8;width:72px;height:72px;border-radius:20px"><i class="fas fa-box-open fa-2x"></i></div><h6 class="font-weight-bold" style="color:var(--dark)">Belum ada obat di kategori <b><?= htmlspecialchars($kat['namakategori']) ?></b></h6><p class="text-muted small">Silakan tambah di Master Data Barang - Login sebagai petugas/admin</p><a href="index.php?halaman=daftarkategori" class="btn rounded-pill px-4 mt-2" style="background:var(--mint);color:var(--teal)">Kembali ke Klasifikasi</a> <a href="index.php?halaman=loginuser" class="btn rounded-pill px-4 mt-2 text-white" style="background:var(--teal)">Login Petugas</a></div></div>
    <?php endif; ?>
  </div>

  <div class="text-center mt-4">
    <a href="index.php?halaman=daftarkategori" class="btn rounded-pill px-4 mr-2" style="background:white;border:1px solid #ccfbf1;color:var(--teal);font-weight:700"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
    <a href="index.php?halaman=daftarobat" class="btn rounded-pill px-4 font-weight-bold text-white" style="background:var(--teal)"><i class="fas fa-th-large mr-1"></i> Semua Obat</a>
  </div>
</div>
</section>