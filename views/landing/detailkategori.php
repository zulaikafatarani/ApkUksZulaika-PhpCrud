<?php
// views/landing/detailkategori.php - BARU, BIAR SAMA KAYAK PUNYA DOSEN
$id = (int)($_GET['idkategori'] ?? $_GET['id'] ?? 0);
if($id==0){ echo '<div class="container py-5"><div class="alert alert-danger">ID Kategori tidak ada</div><a href="index.php?halaman=daftarkategori" class="btn btn-secondary">Kembali</a></div>'; return; }

$kat = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM kategori WHERE idkategori=$id"));
if(!$kat){ echo '<div class="container py-5"><div class="alert alert-danger">Kategori tidak ditemukan</div></div>'; return; }

$q = mysqli_query($koneksi, "SELECT * FROM barang WHERE idkategori=$id ORDER BY namabarang ASC");
$jml = mysqli_num_rows($q);
?>
<section class="py-5 bg-light">
<div class="container">
  <!-- Breadcrumb -->
  <nav class="mb-4"><a href="index.php?halaman=daftarkategori" class="text-success"><i class="fas fa-arrow-left mr-1"></i> Kembali ke Klasifikasi Kategori</a> <span class="text-muted">/ <?= htmlspecialchars($kat['namakategori']) ?></span></nav>

  <!-- Header Kategori -->
  <div class="card border-0 shadow-sm mb-4" style="border-radius:15px;">
    <div class="card-body p-4 d-flex align-items-center">
      <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center mr-4" style="width:70px;height:70px;"><i class="fas fa-prescription-bottle-alt fa-2x"></i></div>
      <div>
        <h2 class="font-weight-bold text-success mb-1"><?= htmlspecialchars($kat['namakategori']) ?></h2>
        <p class="text-muted mb-1"><?= htmlspecialchars($kat['deskripsi'] ?? $kat['keterangan'] ?? 'Kategori logistik medis UKS') ?></p>
        <span class="badge badge-success px-3 py-2"><?= $jml ?> jenis obat terdaftar di kategori ini</span>
      </div>
    </div>
  </div>

  <!-- List Obat di Kategori Ini -->
  <div class="row">
    <?php if($jml>0): while($b=mysqli_fetch_assoc($q)): ?>
    <div class="col-md-4 col-lg-3 mb-4">
      <div class="card h-100 border-0 shadow-sm" style="border-radius:12px;">
        <img src="assets/images/barang/<?= $b['foto']??'default_obat.png' ?>" style="height:160px;object-fit:cover;border-radius:12px 12px 0 0;" class="card-img-top" onerror="this.src='assets/images/barang/default_obat.png'">
        <div class="card-body">
          <span class="badge badge-light border text-success mb-2"><?= htmlspecialchars($kat['namakategori']) ?></span>
          <h6 class="font-weight-bold"><?= htmlspecialchars($b['namabarang']) ?></h6>
          <small class="text-muted d-block">Stok: <b class="<?= $b['stok']<=5?'text-danger':'text-success' ?>"><?= $b['stok'] ?> <?= htmlspecialchars($b['satuan']??'') ?></b></small>
          <small class="text-muted">Exp: <?= date('d/m/Y',strtotime($b['tanggalkadaluarsa'])) ?></small>
          <a href="index.php?halaman=detailobat&id=<?= $b['idbarang'] ?>" class="btn btn-outline-success btn-sm btn-block mt-3 rounded-pill">Lihat Detail</a>
        </div>
      </div>
    </div>
    <?php endwhile; else: ?>
    <div class="col-12"><div class="alert alert-light border text-center py-4"><i class="fas fa-box-open mr-2"></i>Belum ada obat di kategori <b><?= htmlspecialchars($kat['namakategori']) ?></b> - silakan tambah di Master Data Barang</div></div>
    <?php endif; ?>
  </div>
</div>
</section>