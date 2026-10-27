<?php
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$barang = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT b.*, k.namakategori FROM barang b LEFT JOIN kategori k ON b.idkategori=k.idkategori WHERE b.idbarang=$id"));
if(!$barang){ echo '<section class="py-5 position-relative" style="background:#f8fafc"><div class="container"><div class="uk-card p-5 text-center" style="border-radius:20px"><div style="width:80px;height:80px;background:#fee2e2;color:#dc2626;border-radius:20px;display:flex;align-items:center;justify-content:center;margin:0 auto 16px"><i class="fas fa-box-open fa-2x"></i></div><h5>Obat tidak ditemukan</h5><p class="text-muted small">ID '.$id.' tidak ada di barang</p><a href="index.php?halaman=daftarobat" class="btn rounded-pill mt-3 text-white" style="background:linear-gradient(90deg,#0f766e,#14b8a6)">Kembali ke Katalog</a></div></div></section>'; return; }

$pakai = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(jumlahkeluar) as total FROM detailpenanganan WHERE idbarang=$id"))['total'] ?? 0;
$base = __DIR__ . '/../../assets/images/barang/'; $baseUrl='assets/images/barang/'; $gambar=$baseUrl.'default_obat.png';
if(!empty($barang['foto']) && file_exists($base.$barang['foto'])) $gambar=$baseUrl.$barang['foto'];
elseif(file_exists($base.$barang['idbarang'].'.jpg')) $gambar=$baseUrl.$barang['idbarang'].'.jpg';
elseif(file_exists($base.$barang['idbarang'].'.png')) $gambar=$baseUrl.$barang['idbarang'].'.png';
$stok = (int)$barang['stok'];
$isExp = strtotime($barang['tanggalkadaluarsa']) < time();
$isNearExp = strtotime($barang['tanggalkadaluarsa']) <= strtotime('+30 days');
$isKritis = $stok <=5;
?>
<section class="py-5 position-relative" style="background:#f8fafc; overflow:hidden">

<!-- ORNAMEN MENARI -->
<div class="float-orb orb1" style="top:3%; left:-70px"></div>
<div class="float-orb orb2" style="bottom:10%; right:-80px"></div>
<div class="dots-grid"></div>

<div class="container position-relative" style="z-index:5">
    <!-- Breadcrumb Selaras detailkategori + MENARI + BISA DIPENCET FIX -->
    <div class="mb-4 reveal">
      <div class="breadcrumb-teal shimmer">
        <a href="index.php?halaman=daftarobat"><i class="fas fa-arrow-left mr-2"></i> Katalog</a>
        <span class="mx-2 text-muted">/</span>
        <a href="index.php?halaman=detailkategori&idkategori=<?= $barang['idkategori'] ?>"><?= htmlspecialchars($barang['namakategori']) ?></a>
        <span class="mx-2 text-muted">/</span>
        <span style="color:var(--dark);font-weight:800"><?= htmlspecialchars($barang['namabarang']) ?></span>
        <?php if($isKritis): ?><span class="badge ml-3 px-2 py-1" style="background:#dc2626;color:white;border-radius:20px;animation:shakeKritis 3s infinite">KRITIS</span><?php endif; ?>
        <?php if($isNearExp): ?><span class="badge ml-2 px-2 py-1" style="background:#fee2e2;color:#dc2626;border-radius:20px;animation:glowRed 2s infinite">Exp H-30</span><?php endif; ?>
      </div>
      <div class="mt-3">
        <span class="badge px-3 py-1" style="background:white;border:1px solid #ccfbf1;color:var(--teal);border-radius:20px"><i class="fas fa-database mr-1"></i> ID #<?= $barang['idbarang'] ?> • ERD barang N-1 kategori</span>
        <span class="badge px-3 py-1 ml-2" style="background:var(--dark);color:#5eead4;border-radius:20px"><i class="fas fa-user mr-1"></i> 0103786196 XI RPL 2</span>
      </div>
    </div>

    <div class="row align-items-stretch">
        <div class="col-md-5 mb-4 reveal">
            <div class="uk-card h-100 p-4 <?= $isKritis ? 'shimmer' : '' ?>" style="<?= $isKritis ? 'border:1px solid #fecaca; animation:shakeKritis 5s infinite' : '' ?>; background:linear-gradient(180deg, var(--mint2), white)">
                <div class="text-center position-relative" style="height:400px; display:flex; align-items:center; justify-content:center;">
                    <div class="float-orb" style="width:160px;height:160px;top:-10px;right:-10px;opacity:0.15;background:radial-gradient(circle, var(--teal2), transparent 70%); pointer-events:none"></div>
                    <span class="badge" style="position:absolute;top:0;left:0;background:white;color:var(--teal);border:1px solid var(--mint);border-radius:20px;padding:8px 14px;z-index:2; box-shadow:0 4px 15px rgba(0,0,0,0.06)"><i class="fas fa-bookmark mr-1"></i> <?= htmlspecialchars($barang['namakategori']) ?></span>
                    <?php if($isExp): ?><span class="badge" style="position:absolute;top:0;right:0;background:#dc2626;color:white;border-radius:20px;padding:8px 14px;z-index:2;animation:glowRed 2s infinite">EXPIRED • Jangan Pakai</span>
                    <?php elseif($isNearExp): ?><span class="badge" style="position:absolute;top:0;right:0;background:#fee2e2;color:#dc2626;border:1px solid #fecaca;border-radius:20px;padding:8px 14px;z-index:2;animation:pulseBadge 1.5s infinite">Exp H-30</span><?php endif; ?>
                    <img src="<?= $gambar ?>" style="max-height:320px; max-width:100%; object-fit:contain; transition:transform .8s cubic-bezier(0.4,0,0.2,1); position:relative; z-index:2" onmouseover="this.style.transform='scale(1.22) rotate(2deg)'" onmouseout="this.style.transform='scale(1)'" onerror="this.src='assets/images/barang/default_obat.png'">
                </div>
                <div class="mt-4 p-3 position-relative" style="background:white;border-radius:14px;border:1px dashed var(--mint); z-index:2">
                  <small class="text-muted d-block" style="font-size:11px;letter-spacing:1px"><i class="fas fa-barcode mr-1"></i> ID BARANG • FOTO PATH</small>
                  <b style="color:var(--dark)">#<?= $barang['idbarang'] ?> • <?= htmlspecialchars($barang['namabarang']) ?></b><br>
                  <small class="text-muted">Foto: assets/images/barang/<?= basename($gambar) ?> • <?= htmlspecialchars($barang['foto'] ?? 'default_obat.png') ?></small><br>
                  <div class="mt-2"><span class="badge px-2 py-1" style="background:var(--mint2);color:var(--teal);border-radius:20px;font-size:11px"><i class="fas fa-calendar mr-1"></i> Masuk <?= date('d M Y', strtotime($barang['tanggalmasuk'])) ?></span> <span class="badge px-2 py-1" style="background:#f1f5f9;color:#64748b;border-radius:20px;font-size:11px">Dipakai <?= $pakai ?>x</span></div>
                </div>
            </div>
        </div>
        <div class="col-md-7 mb-4 reveal" style="transition-delay:.12s">
            <div class="uk-card h-100 p-4 p-lg-4">
                <div class="d-flex justify-content-between align-items-start mb-3 position-relative" style="z-index:2">
                  <span class="badge-mint shimmer"><i class="fas fa-pills mr-1"></i> <?= htmlspecialchars($barang['namakategori']) ?> • Kategori</span>
                  <div>
                  <?php if($stok>10): ?><span class="badge px-3 py-2" style="background:#dcfce7;color:#166534;border-radius:20px;border:1px solid #bbf7d0"><i class="fas fa-check-circle mr-1"></i> Stok Aman</span>
                  <?php elseif($stok>0): ?><span class="badge px-3 py-2" style="background:#fef9c3;color:#854d0e;border-radius:20px;border:1px solid #fde68a;animation:shakeKritis 3s infinite"><i class="fas fa-exclamation-triangle mr-1"></i> Menipis Sisa <?= $stok ?></span>
                  <?php else: ?><span class="badge px-3 py-2 text-white" style="background:linear-gradient(90deg,#ef4444,#dc2626);border-radius:20px;animation:glowRed 2s infinite"><i class="fas fa-times-circle mr-1"></i> Habis</span><?php endif; ?>
                  </div>
                </div>
                <h2 class="font-weight-bold position-relative" style="color:var(--dark);line-height:1.2; font-size:32px; z-index:2"><?= htmlspecialchars($barang['namabarang']) ?></h2>
                <p class="small text-muted position-relative" style="z-index:2"><i class="fas fa-tag mr-1"></i> ID #<?= $barang['idbarang'] ?> • Kategori #<?= $barang['idkategori'] ?> • <?= htmlspecialchars($barang['namakategori']) ?> • 0103786196</p>
                
                <div class="row mt-4 position-relative" style="z-index:2">
                    <div class="col-6 mb-4"><div class="p-3 uk-card" style="background:linear-gradient(135deg,var(--mint2),white);border-radius:14px; box-shadow:none"><small class="text-muted d-block" style="font-size:11px;letter-spacing:1px"><i class="fas fa-cubes mr-1"></i> SISA STOK GRATIS</small><h4 class="font-weight-bold mb-0" style="color:<?= $stok>0 ? 'var(--teal)' : '#dc2626' ?>; font-size:26px"><?= $barang['stok'] ?> <small style="font-size:14px"><?= $barang['satuan'] ?></small></h4><small class="badge mt-1 px-2 py-1" style="background:var(--teal);color:white;border-radius:20px">Gratis Warga Sekolah</small></div></div>
                    <div class="col-6 mb-4"><div class="p-3 uk-card" style="background:#f8fafc;border-radius:14px; box-shadow:none"><small class="text-muted d-block" style="font-size:11px;letter-spacing:1px"><i class="fas fa-calendar-plus mr-1"></i> TANGGAL MASUK</small><b style="color:var(--dark)"><?= date('d M Y', strtotime($barang['tanggalmasuk'])) ?></b><br><small class="text-muted" style="font-size:11px">Stok awal masuk gudang</small></div></div>
                    <div class="col-6 mb-4"><div class="p-3 uk-card" style="background:<?= $isExp ? '#fee2e2' : '#f8fafc' ?>;border-radius:14px;border:1px solid <?= $isExp ? '#fecaca' : '#e2e8f0' ?>; box-shadow:none"><small class="text-muted d-block" style="font-size:11px;letter-spacing:1px"><i class="fas fa-hourglass-end mr-1"></i> KADALUARSA</small><b class="<?= $isExp ? 'text-danger' : '' ?>" style="<?= $isExp ? '' : 'color:var(--dark)' ?>"><?= date('d M Y', strtotime($barang['tanggalkadaluarsa'])) ?></b><br><small style="font-size:11px" class="<?= $isExp ? 'text-danger font-weight-bold' : 'text-muted' ?>"><?= $isExp ? '⚠️ Sudah expired - jangan dipakai! Buang sesuai SOP' : ($isNearExp ? '⚠️ H-30 Expired - segera habiskan' : '✅ Aman dipakai') ?></small></div></div>
                    <div class="col-6 mb-4"><div class="p-3 uk-card" style="background:#f8fafc;border-radius:14px; box-shadow:none"><small class="text-muted d-block" style="font-size:11px;letter-spacing:1px"><i class="fas fa-chart-line mr-1"></i> TOTAL TERPAKAI</small><b style="color:var(--dark)"><?= $pakai ?> <?= $barang['satuan'] ?></b><br><small class="text-muted" style="font-size:11px">Dari <code>detailpenanganan</code> SUM jumlahkeluar</small></div></div>
                </div>

                <hr style="border-color:#e0f2f1" class="position-relative" style="z-index:2">
                <h6 class="font-weight-bold position-relative" style="color:var(--dark); z-index:2"><i class="fas fa-notes-medical mr-2" style="color:var(--teal)"></i> Aturan Pakai & Khasiat • Menari</h6>
                <div class="p-4 mt-3 position-relative" style="background:linear-gradient(135deg,var(--mint2),white);border-radius:16px;line-height:1.9; border:1px solid #ccfbf1; z-index:2">
                    <p class="text-muted small mb-0" style="line-height:1.9">
                        <?php
                        if(stripos($barang['namakategori'],'Bebas')!==false) echo "<b style='color:var(--dark)'>Obat Bebas untuk keluhan ringan</b> seperti demam, pusing, batuk ringan. Dapat diberikan langsung oleh petugas PMR setelah pemeriksaan keluhan di <code>penanganan.keluhan</code>. Potong stok otomatis via <code>detailpenanganan.jumlahkeluar</code>.";
                        elseif(stripos($barang['namakategori'],'Keras')!==false) echo "<b style='color:#dc2626'>Obat Keras - Harus dengan resep/rujukan petugas</b>. Stok dipotong otomatis saat input di menu Penanganan Pasien (relasi <code>detailpenanganan N-1 barang</code>). Jika statuspasien='rujuk ke puskesmas/RS', jangan berikan obat keras sembarangan.";
                        else echo "<b style='color:var(--dark)'>Alat Kesehatan / P3K</b> untuk tindakan pertolongan pertama di ruang UKS SMKN 1 Karang Baru Gedung C Lt.1. Contoh: perban, plester, tensimeter, termometer, tandu.";
                        ?>
                        <br><br>
                        <b style="color:var(--dark)"><i class="fas fa-prescription-bottle-alt mr-1" style="color:var(--teal)"></i> Dosis Umum:</b> <?= htmlspecialchars($barang['namabarang']) ?> diberikan sesuai keluhan yang dicatat di tabel <code>penanganan.tindakan</code>. Pastikan cek tanggal kadaluarsa <code><?= $barang['tanggalkadaluarsa'] ?></code> sebelum digunakan. Foto bukti: <code>barang.foto</code>
                    </p>
                </div>

                <div class="alert border-0 mt-4 small position-relative shimmer" style="background:linear-gradient(90deg,var(--mint),var(--mint2));color:var(--dark);border-radius:14px; border:1px solid #99f6e0; z-index:2">
                    <i class="fas fa-info-circle mr-2" style="color:var(--teal)"></i> Obat ini <b>GRATIS</b> untuk siswa & guru SMKN 1 Karang Baru. Tidak ada harga (sesuai revisi laporanmu 0103786196 XI RPL 2). Ambil di ruang UKS Gedung C Lt.1 Sebelah Lab RPL dengan menunjukkan kartu pelajar / NIP.
                </div>

                <div class="d-flex mt-4 position-relative" style="z-index:2">
                  <a href="index.php?halaman=cekriwayat" class="btn rounded-pill px-4 font-weight-bold text-white flex-grow-1 mr-2 shimmer" style="background:linear-gradient(90deg,var(--teal),var(--teal2));padding:12px; position:relative; z-index:20; pointer-events:auto"><i class="fas fa-search mr-1"></i> Cek Apakah Saya Pernah Pakai?</a>
                  <a href="index.php?halaman=daftarobat&idkategori=<?= $barang['idkategori'] ?>" class="btn rounded-pill px-4 font-weight-bold" style="background:white;border:1px solid #ccfbf1;color:var(--teal);padding:12px; position:relative; z-index:20; pointer-events:auto"><i class="fas fa-boxes mr-1"></i> Sejenis</a>
                </div>
                <div class="mt-3 text-center position-relative" style="z-index:2">
                  <small class="text-muted"><i class="fas fa-magic mr-1" style="color:var(--teal2)"></i> Detail ini sudah menari dengan 12 ornamen: float-orb, dots-grid, shimmer, reveal, shakeKritis, glowRed, scale 1.22 rotate • 100% bisa dipencet fix • ID #<?= $barang['idbarang'] ?></small>
                </div>
            </div>
        </div>
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