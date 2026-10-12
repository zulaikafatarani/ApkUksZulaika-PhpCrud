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
<section class="py-5" style="background:#f8fafc">
<style>
:root{ --teal:#0f766e; --teal2:#14b8a6; --mint:#ccfbf1; --mint2:#f0fdfa; --dark:#064e3b; --radius:18px; }
.uk-card{border-radius:var(--radius); border:1px solid #e0f2f1; background:white; box-shadow:0 8px 30px rgba(15,118,110,0.07); transition:.3s; overflow:hidden}
.uk-card:hover{transform:translateY(-5px); box-shadow:0 16px 40px rgba(15,118,110,0.12); border-color:var(--teal2)}
.icon-box{width:48px;height:48px;border-radius:12px;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,var(--teal),var(--teal2));color:white}
.section-title{font-weight:800;color:var(--dark)}
.filter-btn{border-radius:30px;padding:8px 18px;font-size:13px;font-weight:700;border:1px solid #ccfbf1;background:white;color:var(--teal);transition:.2s;text-decoration:none !important;display:inline-block;margin:4px}
.filter-btn:hover,.filter-btn.active{background:var(--teal);color:white;border-color:var(--teal)}
</style>

<div class="container">
    <div class="text-center mb-5">
        <span class="badge px-4 py-2 mb-3 font-weight-bold" style="background:var(--mint);color:var(--teal);border-radius:30px;letter-spacing:1px">LEMA RI OBAT UKS</span>
        <h1 class="section-title"><i class="fas fa-pills mr-2" style="color:var(--teal)"></i>Katalog Obat & Alkes UKS</h1>
        <p class="text-muted small mt-2">Menampilkan: <b style="color:var(--dark)"><?= htmlspecialchars($judul) ?></b> | Total <b style="color:var(--teal)"><?= $total ?></b> item tersedia - Gratis untuk warga sekolah.</p>
        
        <!-- FILTER KATEGORI SELARAS DAFTARKATEGORI -->
        <div class="mt-4">
          <a href="index.php?halaman=daftarobat" class="filter-btn <?= $idkategori==0?'active':'' ?>"><i class="fas fa-th-large mr-1"></i> Semua</a>
          <?php while($k=mysqli_fetch_assoc($qKat)): ?>
            <a href="index.php?halaman=daftarobat&idkategori=<?= $k['idkategori'] ?>" class="filter-btn <?= $idkategori==$k['idkategori']?'active':'' ?>"><?= htmlspecialchars($k['namakategori']) ?></a>
          <?php endwhile; ?>
          <?php if($idkategori>0): ?>
            <a href="index.php?halaman=daftarobat" class="filter-btn" style="background:#fee2e2;color:#dc2626;border-color:#fecaca"><i class="fas fa-times mr-1"></i> Reset</a>
          <?php endif; ?>
        </div>
    </div>

    <div class="row">
    <?php if($total>0): while($b=mysqli_fetch_assoc($result)): 
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
    ?>
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="uk-card h-100">
                <div style="height:220px; background:var(--mint2); display:flex; align-items:center; justify-content:center; padding:20px; position:relative">
                    <span class="badge" style="position:absolute;top:14px;left:14px;background:white;color:var(--teal);border:1px solid var(--mint);border-radius:20px;padding:6px 12px;font-size:11px"><i class="fas fa-bookmark mr-1"></i> <?= htmlspecialchars($b['namakategori'] ?? 'Umum') ?></span>
                    <span class="badge" style="position:absolute;top:14px;right:14px;background:white;border-radius:20px;padding:6px 12px;font-size:11px;border:1px solid #e2e8f0">Exp <?= date('m/Y', strtotime($b['tanggalkadaluarsa'])) ?></span>
                    <img src="<?= $gambar ?>" alt="<?= htmlspecialchars($b['namabarang']) ?>" style="max-height:180px; max-width:100%; object-fit:contain;" onerror="this.src='assets/images/barang/default_obat.png'">
                </div>
                <div class="p-4 d-flex flex-column">
                    <h6 class="font-weight-bold mb-2" style="color:var(--dark);line-height:1.3"><?= htmlspecialchars($b['namabarang']) ?></h6>
                    
                    <div class="mt-2 mb-3">
                        <?php if($stok > 10): ?>
                            <span class="badge px-3 py-2" style="background:var(--mint);color:var(--teal);border-radius:20px"><i class="fas fa-check-circle mr-1"></i> <?= $b['stok'] ?> <?= $b['satuan'] ?> Tersedia</span>
                        <?php elseif($stok > 0): ?>
                            <span class="badge px-3 py-2" style="background:#fef9c3;color:#854d0e;border-radius:20px"><i class="fas fa-exclamation-triangle mr-1"></i> Sisa <?= $b['stok'] ?> <?= $b['satuan'] ?> - Menipis</span>
                        <?php else: ?>
                            <span class="badge px-3 py-2 text-white" style="background:#ef4444;border-radius:20px"><i class="fas fa-times-circle mr-1"></i> Stok Habis</span>
                        <?php endif; ?>
                    </div>

                    <a href="index.php?halaman=detailobat&id=<?= $b['idbarang'] ?>" class="btn btn-block rounded-pill font-weight-bold mt-auto text-white" style="background:linear-gradient(90deg,var(--teal),var(--teal2))"><i class="fas fa-notes-medical mr-1"></i> Aturan Pakai & Khasiat</a>
                </div>
            </div>
        </div>
    <?php endwhile; else: ?>
        <div class="col-12"><div class="uk-card p-5 text-center"><div class="icon-box mx-auto mb-3" style="background:#f1f5f9;color:#94a3b8;width:72px;height:72px;border-radius:20px"><i class="fas fa-box-open fa-2x"></i></div><h6 class="font-weight-bold" style="color:var(--dark)">Tidak ada obat di kategori ini</h6><p class="text-muted small">Coba filter lain atau tampilkan semua sediaan</p><a href="index.php?halaman=daftarobat" class="btn rounded-pill px-4 mt-2 text-white" style="background:var(--teal)">Tampilkan Semua</a></div></div>
    <?php endif; ?>
    </div>
</div>
</section>