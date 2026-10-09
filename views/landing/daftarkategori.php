<?php
/*
| daftarkategori.php - FINAL FIX - link ke detailkategori.php
*/
$query = "SELECT kategori.*, COUNT(barang.idbarang) AS jumlahobat
          FROM kategori
          LEFT JOIN barang ON barang.idkategori = kategori.idkategori
          GROUP BY kategori.idkategori
          ORDER BY kategori.namakategori ASC";
$result = mysqli_query($koneksi, $query);
?>
<section class="py-5 bg-light">
<div class="container">
<div class="text-center mb-5">
<h1 class="font-weight-bold text-success"><i class="fas fa-boxes mr-2"></i>Klasifikasi Kategori Obat</h1>
<p class="text-muted">Jelajahi sediaan logistik medis dan pertolongan pertama berdasarkan fungsi klinis obat.</p>
</div>
<div class="row">
<?php if(mysqli_num_rows($result)>0): while($kategori=mysqli_fetch_assoc($result)): ?>
<div class="col-md-6 col-lg-4 mb-4">
<div class="card h-100 border-0 shadow-sm" style="border-radius:12px;">
<div class="card-body text-center p-4">
<div class="mb-3 text-success"><i class="fas fa-prescription-bottle-alt fa-3x"></i></div>
<h4 class="font-weight-bold text-dark"><?= htmlspecialchars($kategori['namakategori']); ?></h4>
<p class="text-muted small font-weight-bold"><i class="fas fa-pills mr-1"></i> <?= (int)$kategori['jumlahobat']; ?> jenis sediaan obat terdaftar</p>
<!-- INI YANG BIKIN PUNYA DOSEN KEBuka: arahkan ke detailkategori -->
<a href="index.php?halaman=detailkategori&idkategori=<?= $kategori['idkategori']; ?>" class="btn btn-success btn-block font-weight-bold rounded-pill shadow-sm">
<i class="fas fa-notes-medical mr-1"></i> Buka Katalog Obat
</a>
</div>
</div>
</div>
<?php endwhile; else: ?>
<div class="col-12"><div class="alert alert-light border text-center">Belum ada kategori</div></div>
<?php endif; ?>
</div>
</div>
</section>