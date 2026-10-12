<?php
$query = "SELECT kategori.*, COUNT(barang.idbarang) AS jumlahobat
          FROM kategori
          LEFT JOIN barang ON barang.idkategori = kategori.idkategori
          GROUP BY kategori.idkategori
          ORDER BY kategori.namakategori ASC";
$result = mysqli_query($koneksi, $query);
?>
<section class="py-5" style="background:#f8fafc">
<style>
:root{ --teal:#0f766e; --teal2:#14b8a6; --mint:#ccfbf1; --mint2:#f0fdfa; --dark:#064e3b; --radius:18px; }
.uk-card{border-radius:var(--radius); border:1px solid #e0f2f1; background:white; box-shadow:0 8px 30px rgba(15,118,110,0.07); transition:.3s}
.uk-card:hover{transform:translateY(-5px); box-shadow:0 16px 40px rgba(15,118,110,0.12); border-color:var(--teal2)}
.icon-box{width:64px;height:64px;border-radius:16px;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,var(--teal),var(--teal2));color:white;margin:0 auto 16px}
.icon-box.mint{background:var(--mint);color:var(--teal)}
.section-title{font-weight:800;color:var(--dark)}
</style>

<div class="container">
  <div class="text-center mb-5">
    <span class="badge px-4 py-2 mb-3 font-weight-bold" style="background:var(--mint);color:var(--teal);border-radius:30px;letter-spacing:1px">LEMA RI OBAT UKS</span>
    <h1 class="section-title"><i class="fas fa-boxes mr-2" style="color:var(--teal)"></i>Klasifikasi Kategori Obat</h1>
    <p class="text-muted small" style="max-width:600px;margin:0 auto">Jelajahi sediaan logistik medis dan pertolongan pertama berdasarkan fungsi klinis obat. Data langsung dari <code>kategori.namakategori</code></p>
  </div>

  <div class="row">
    <?php if(mysqli_num_rows($result)>0): while($kategori=mysqli_fetch_assoc($result)): 
      $jml = (int)$kategori['jumlahobat'];
      $isEmpty = $jml === 0;
    ?>
    <div class="col-md-6 col-lg-4 mb-4">
      <div class="uk-card h-100 p-4 text-center">
        <div class="icon-box" style="<?= $isEmpty ? 'background:#f1f5f9;color:#94a3b8' : '' ?>">
          <i class="fas <?= $isEmpty ? 'fa-box-open' : 'fa-prescription-bottle-alt' ?> fa-lg"></i>
        </div>
        <h5 class="font-weight-bold mb-2" style="color:var(--dark)"><?= htmlspecialchars($kategori['namakategori']); ?></h5>
        
        <div class="mb-3">
          <?php if($isEmpty): ?>
            <span class="badge px-3 py-2" style="background:#f1f5f9;color:#64748b;border-radius:20px"><i class="fas fa-exclamation-circle mr-1"></i> 0 sediaan</span>
          <?php else: ?>
            <span class="badge px-3 py-2" style="background:var(--mint2);color:var(--teal);border-radius:20px;font-weight:700"><i class="fas fa-pills mr-1"></i> <?= $jml; ?> jenis sediaan terdaftar</span>
          <?php endif; ?>
        </div>

        <p class="text-muted small mb-4" style="font-size:12px;line-height:1.6">
          <?= $isEmpty ? 'Belum ada obat untuk kategori ini. Tambahkan via petugas.' : 'Obat-obatan & alkes dalam kategori ' . htmlspecialchars($kategori['namakategori']) . ' siap pakai.' ?>
        </p>

        <a href="index.php?halaman=detailkategori&idkategori=<?= $kategori['idkategori']; ?>" class="btn btn-block rounded-pill font-weight-bold shadow-sm" style="<?= $isEmpty ? 'background:#f8fafc;color:#94a3b8;border:1px solid #e2e8f0' : 'background:linear-gradient(90deg,var(--teal),var(--teal2));color:white' ?>">
          <i class="fas fa-notes-medical mr-1"></i> <?= $isEmpty ? 'Lihat Kategori' : 'Buka Katalog Obat' ?>
        </a>
      </div>
    </div>
    <?php endwhile; else: ?>
      <div class="col-12"><div class="uk-card p-5 text-center"><i class="fas fa-boxes fa-3x mb-3" style="color:#cbd5e1"></i><p class="text-muted">Belum ada kategori di <code>kategori</code></p><a href="index.php?halaman=loginuser" class="btn rounded-pill px-4 mt-2 text-white" style="background:var(--teal)">Login Petugas - Tambah Kategori</a></div></div>
    <?php endif; ?>
  </div>
</div>
</section>