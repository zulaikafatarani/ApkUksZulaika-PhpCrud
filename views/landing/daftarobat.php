<?php
// views/landing/daftarobat.php - FINAL UKS DIGITAL - Tanpa merk, tanpa harga
$idkategori = isset($_GET['idkategori']) ? (int)$_GET['idkategori'] : 0;

if($idkategori > 0){
    // Filter otomatis jika klik dari daftarkategori.php
    $stmt = mysqli_prepare($koneksi, "SELECT b.*, k.namakategori FROM barang b LEFT JOIN kategori k ON b.idkategori=k.idkategori WHERE b.idkategori=? ORDER BY b.idbarang DESC");
    mysqli_stmt_bind_param($stmt, "i", $idkategori);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $judul = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT namakategori FROM kategori WHERE idkategori=$idkategori"))['namakategori'] ?? 'Kategori';
} else {
    $result = mysqli_query($koneksi, "SELECT b.*, k.namakategori FROM barang b LEFT JOIN kategori k ON b.idkategori=k.idkategori ORDER BY b.idbarang DESC");
    $judul = "Semua Sediaan";
}
?>
<section class="py-5 bg-light">
<div class="container">
    <div class="text-center mb-5">
        <h1 class="font-weight-bold text-success"><i class="fas fa-pills mr-2"></i>Katalog Obat & Alkes UKS</h1>
        <p class="text-muted">Menampilkan: <b><?= htmlspecialchars($judul) ?></b> | Total <?= mysqli_num_rows($result) ?> item tersedia - Gratis untuk warga sekolah.</p>
        <?php if($idkategori>0): ?>
            <a href="index.php?halaman=daftarobat" class="btn btn-outline-success btn-sm rounded-pill mt-2"><i class="fas fa-times mr-1"></i> Tampilkan Semua</a>
        <?php endif; ?>
    </div>
    <div class="row">
    <?php if(mysqli_num_rows($result)>0): while($b=mysqli_fetch_assoc($result)): 
        // Penyesuaian gambar: di laporan barang tidak ada foto, jadi pakai default per kategori
        $gambar = "default_obat.png";
        if(!empty($b['foto'])){ // jika kamu sudah alter table tambah foto
            $gambar = $b['foto'];
        } else {
            // mapping otomatis biar gak polos
            if(stripos($b['namakategori'],'Alkes')!==false || stripos($b['namakategori'],'P3K')!==false) $gambar = "alkes.png";
        }
        $pathGambar = "assets/images/barang/".$gambar;
    ?>
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow-sm border-0" style="border-radius:12px; overflow:hidden;">
                <div style="height:220px; background:#f8f9fa; display:flex; align-items:center; justify-content:center;">
                    <img src="<?= $pathGambar ?>" alt="<?= htmlspecialchars($b['namabarang']) ?>" style="max-height:200px; object-fit:contain;" onerror="this.src='assets/images/barang/default_obat.png'">
                </div>
                <div class="card-body d-flex flex-column p-4">
                    <h5 class="font-weight-bold text-dark mb-1"><?= htmlspecialchars($b['namabarang']) ?></h5>
                    <p class="small text-muted mb-2"><i class="fas fa-bookmark text-success mr-1"></i> <?= htmlspecialchars($b['namakategori'] ?? 'Umum') ?> | Exp: <?= date('m/Y', strtotime($b['tanggalkadaluarsa'])) ?></p>
                    
                    <div class="mt-2 mb-3">
                        <?php if((int)$b['stok'] > 10): ?>
                            <span class="badge badge-success p-2"><i class="fas fa-check-circle mr-1"></i> <?= $b['stok'] ?> <?= $b['satuan'] ?> Tersedia</span>
                        <?php elseif((int)$b['stok'] > 0): ?>
                            <span class="badge badge-warning p-2 text-dark"><i class="fas fa-exclamation-triangle mr-1"></i> Sisa <?= $b['stok'] ?> <?= $b['satuan'] ?> - Menipis</span>
                        <?php else: ?>
                            <span class="badge badge-danger p-2"><i class="fas fa-times-circle mr-1"></i> Stok Habis</span>
                        <?php endif; ?>
                    </div>

                    <a href="index.php?halaman=detailobat&id=<?= $b['idbarang'] ?>" class="btn btn-success btn-block rounded-pill font-weight-bold mt-auto"><i class="fas fa-notes-medical mr-1"></i> Aturan Pakai & Khasiat</a>
                </div>
            </div>
        </div>
    <?php endwhile; else: ?>
        <div class="col-12"><div class="alert alert-light border text-center py-5 shadow-sm"><i class="fas fa-box-open fa-3x text-success mb-3 d-block"></i>Tidak ada obat di kategori ini.</div></div>
    <?php endif; ?>
    </div>
</div>
</section>