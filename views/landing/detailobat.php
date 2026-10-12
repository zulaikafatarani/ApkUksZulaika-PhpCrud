<?php
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$barang = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT b.*, k.namakategori FROM barang b LEFT JOIN kategori k ON b.idkategori=k.idkategori WHERE b.idbarang=$id"));
if(!$barang){ echo '<section class="py-5" style="background:#f8fafc"><div class="container"><div class="uk-card p-5 text-center" style="border-radius:18px"><i class="fas fa-box-open fa-3x mb-3" style="color:#cbd5e1"></i><h5>Obat tidak ditemukan</h5><a href="index.php?halaman=daftarobat" class="btn rounded-pill mt-3 text-white" style="background:#0f766e">Kembali ke Katalog</a></div></div></section>'; return; }

$pakai = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(jumlahkeluar) as total FROM detailpenanganan WHERE idbarang=$id"))['total'] ?? 0;
$base = __DIR__ . '/../../assets/images/barang/'; $baseUrl='assets/images/barang/'; $gambar=$baseUrl.'default_obat.png';
if(!empty($barang['foto']) && file_exists($base.$barang['foto'])) $gambar=$baseUrl.$barang['foto'];
elseif(file_exists($base.$barang['idbarang'].'.jpg')) $gambar=$baseUrl.$barang['idbarang'].'.jpg';
elseif(file_exists($base.$barang['idbarang'].'.png')) $gambar=$baseUrl.$barang['idbarang'].'.png';
$stok = (int)$barang['stok'];
$isExp = strtotime($barang['tanggalkadaluarsa']) < time();
?>
<section class="py-5" style="background:#f8fafc">
<style>
:root{ --teal:#0f766e; --teal2:#14b8a6; --mint:#ccfbf1; --mint2:#f0fdfa; --dark:#064e3b; --radius:18px; }
.uk-card{border-radius:var(--radius); border:1px solid #e0f2f1; background:white; box-shadow:0 8px 30px rgba(15,118,110,0.07); transition:.3s; overflow:hidden}
.icon-box{width:48px;height:48px;border-radius:12px;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,var(--teal),var(--teal2));color:white}
.breadcrumb-teal{border-radius:30px;padding:8px 16px;background:var(--mint2);display:inline-flex;align-items:center;font-size:13px}
.breadcrumb-teal a{color:var(--teal);font-weight:700;text-decoration:none !important}
</style>

<div class="container">
    <!-- Breadcrumb Selaras detailkategori -->
    <div class="mb-4">
      <div class="breadcrumb-teal">
        <a href="index.php?halaman=daftarobat"><i class="fas fa-arrow-left mr-2"></i> Katalog</a>
        <span class="mx-2 text-muted">/</span>
        <a href="index.php?halaman=detailkategori&idkategori=<?= $barang['idkategori'] ?>"><?= htmlspecialchars($barang['namakategori']) ?></a>
        <span class="mx-2 text-muted">/</span>
        <span style="color:var(--dark);font-weight:700"><?= htmlspecialchars($barang['namabarang']) ?></span>
      </div>
    </div>

    <div class="row align-items-stretch">
        <div class="col-md-5 mb-4">
            <div class="uk-card h-100 p-4" style="background:var(--mint2)">
                <div class="text-center" style="height:380px; display:flex; align-items:center; justify-content:center; position:relative">
                    <span class="badge" style="position:absolute;top:0;left:0;background:white;color:var(--teal);border:1px solid var(--mint);border-radius:20px;padding:6px 12px"><i class="fas fa-bookmark mr-1"></i> <?= htmlspecialchars($barang['namakategori']) ?></span>
                    <?php if($isExp): ?><span class="badge" style="position:absolute;top:0;right:0;background:#fee2e2;color:#dc2626;border-radius:20px;padding:6px 12px">EXPIRED</span><?php endif; ?>
                    <img src="<?= $gambar ?>" style="max-height:300px; max-width:100%; object-fit:contain;" onerror="this.src='assets/images/barang/default_obat.png'">
                </div>
                <div class="mt-4 p-3" style="background:white;border-radius:12px;border:1px dashed var(--mint)">
                  <small class="text-muted d-block" style="font-size:11px;letter-spacing:1px">ID BARANG</small>
                  <b style="color:var(--dark)">#<?= $barang['idbarang'] ?> • <?= htmlspecialchars($barang['namabarang']) ?></b><br>
                  <small class="text-muted">Foto: assets/images/barang/<?= basename($gambar) ?></small>
                </div>
            </div>
        </div>
        <div class="col-md-7 mb-4">
            <div class="uk-card h-100 p-4 p-lg-4">
                <div class="d-flex justify-content-between align-items-start mb-2">
                  <span class="badge px-3 py-2" style="background:var(--mint);color:var(--teal);border-radius:20px;font-weight:700"><i class="fas fa-pills mr-1"></i> <?= htmlspecialchars($barang['namakategori']) ?></span>
                  <?php if($stok>10): ?><span class="badge px-3 py-2" style="background:var(--mint2);color:var(--teal);border-radius:20px">Stok Aman</span>
                  <?php elseif($stok>0): ?><span class="badge px-3 py-2" style="background:#fef9c3;color:#854d0e;border-radius:20px">Menipis</span>
                  <?php else: ?><span class="badge px-3 py-2 text-white" style="background:#ef4444;border-radius:20px">Habis</span><?php endif; ?>
                </div>
                <h2 class="font-weight-bold" style="color:var(--dark);line-height:1.2"><?= htmlspecialchars($barang['namabarang']) ?></h2>
                
                <div class="row mt-4">
                    <div class="col-6 mb-4"><div class="p-3" style="background:var(--mint2);border-radius:14px"><small class="text-muted d-block" style="font-size:11px;letter-spacing:1px">SISA STOK GRATIS</small><h4 class="font-weight-bold mb-0" style="color:<?= $stok>0 ? 'var(--teal)' : '#dc2626' ?>"><?= $barang['stok'] ?> <?= $barang['satuan'] ?></h4></div></div>
                    <div class="col-6 mb-4"><div class="p-3" style="background:#f8fafc;border-radius:14px;border:1px solid #e2e8f0"><small class="text-muted d-block" style="font-size:11px;letter-spacing:1px">TANGGAL MASUK</small><b style="color:var(--dark)"><?= date('d M Y', strtotime($barang['tanggalmasuk'])) ?></b></div></div>
                    <div class="col-6 mb-4"><div class="p-3" style="background:<?= $isExp ? '#fee2e2' : '#f8fafc' ?>;border-radius:14px;border:1px solid <?= $isExp ? '#fecaca' : '#e2e8f0' ?>"><small class="text-muted d-block" style="font-size:11px;letter-spacing:1px">KADALUARSA</small><b class="<?= $isExp ? 'text-danger' : '' ?>" style="<?= $isExp ? '' : 'color:var(--dark)' ?>"><?= date('d M Y', strtotime($barang['tanggalkadaluarsa'])) ?></b><br><small style="font-size:11px" class="<?= $isExp ? 'text-danger' : 'text-muted' ?>"><?= $isExp ? 'Sudah expired - jangan dipakai' : 'Aman dipakai' ?></small></div></div>
                    <div class="col-6 mb-4"><div class="p-3" style="background:#f8fafc;border-radius:14px;border:1px solid #e2e8f0"><small class="text-muted d-block" style="font-size:11px;letter-spacing:1px">TOTAL TERPAKAI</small><b style="color:var(--dark)"><?= $pakai ?> <?= $barang['satuan'] ?></b><br><small class="text-muted" style="font-size:11px">Dari detailpenanganan</small></div></div>
                </div>

                <hr style="border-color:var(--mint)">
                <h6 class="font-weight-bold" style="color:var(--dark)"><i class="fas fa-notes-medical mr-2" style="color:var(--teal)"></i> Aturan Pakai & Khasiat</h6>
                <div class="p-3 mt-3" style="background:var(--mint2);border-radius:14px;line-height:1.8">
                    <p class="text-muted small mb-0">
                        <?php
                        if(stripos($barang['namakategori'],'Bebas')!==false) echo "Obat bebas untuk keluhan ringan seperti demam, pusing, batuk. Dapat diberikan langsung oleh petugas PMR setelah pemeriksaan keluhan di <code>penanganan</code>.";
                        elseif(stripos($barang['namakategori'],'Keras')!==false) echo "Obat keras - <b style='color:var(--dark)'>Harus dengan resep/rujukan petugas</b>. Stok dipotong otomatis saat input di menu Penanganan Pasien (relasi <code>detailpenanganan</code>).";
                        else echo "Alat Kesehatan / P3K untuk tindakan pertolongan pertama di ruang UKS SMKN 1 Karang Baru.";
                        ?>
                        <br><br>
                        <b style="color:var(--dark)">Dosis Umum:</b> <?= htmlspecialchars($barang['namabarang']) ?> diberikan sesuai keluhan yang dicatat di tabel <code>penanganan.tindakan</code>. Pastikan cek tanggal kadaluarsa sebelum digunakan.
                    </p>
                </div>

                <div class="alert border-0 mt-4 small" style="background:var(--mint);color:var(--dark);border-radius:12px">
                    <i class="fas fa-info-circle mr-2" style="color:var(--teal)"></i> Obat ini <b>GRATIS</b> untuk siswa & guru. Tidak ada harga (sesuai revisi laporanmu). Ambil di ruang UKS Lt.1 dengan menunjukkan kartu pelajar.
                </div>

                <div class="d-flex mt-3">
                  <a href="index.php?halaman=cekriwayat" class="btn rounded-pill px-4 font-weight-bold text-white flex-grow-1 mr-2" style="background:linear-gradient(90deg,var(--teal),var(--teal2))"><i class="fas fa-search mr-1"></i> Cek Apakah Saya Pernah Pakai?</a>
                  <a href="index.php?halaman=daftarobat&idkategori=<?= $barang['idkategori'] ?>" class="btn rounded-pill px-4 font-weight-bold" style="background:white;border:1px solid #ccfbf1;color:var(--teal)"><i class="fas fa-boxes"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
</section>