<?php
// views/user/barang/show.php - FINAL GABUNG UKS.CSS
batasi_akses_role(['admin','petugas','anggota']);
$id = (int)($_GET['id'] ?? 0);
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT b.*, k.namakategori FROM barang b LEFT JOIN kategori k ON b.idkategori=k.idkategori WHERE b.idbarang=$id LIMIT 1"));
if(!$data){ header("Location: index.php?halaman=barang"); exit(); }
$stok = (int)$data['stok']; $exp = strtotime($data['tanggalkadaluarsa']); $isExp = $exp < time();
?>
<div class="dash">
  <div class="content-header"><div class="container-fluid"><div class="row mb-2 align-items-center">
    <div class="col-sm-6"><h1 class="m-0 font-weight-bold" style="color:var(--dark)"><i class="fas fa-eye mr-2" style="color:var(--teal)"></i> Detail Obat</h1><small class="text-muted">UKS Digital - <b style="color:var(--teal)">Detail Barang</b> | <span class="badge-mint"><?= htmlspecialchars($data['namakategori'] ?? 'Umum') ?></span></small></div>
    <div class="col-sm-6 text-right"><a href="index.php?halaman=barang" class="btn-toska"><i class="fas fa-arrow-left mr-1"></i> Kembali</a></div>
  </div></div></div>
  <div class="content"><div class="container-fluid"><div class="uk-card-bar"><div class="p-4"><div class="row align-items-center">
    <div class="col-md-4 text-center mb-3"><img src="assets/images/barang/<?= htmlspecialchars($data['foto']) ?>" class="foto-big-bar" onerror="this.src='assets/images/barang/default_obat.png'"><h5 class="mt-3 font-weight-bold" style="color:var(--dark)"><?= htmlspecialchars($data['namabarang']) ?></h5></div>
    <div class="col-md-8">
      <table class="table table-bordered mb-0"><tr><th style="width:35%; background:var(--mint2)">Nama</th><td class="font-weight-bold"><?= htmlspecialchars($data['namabarang']) ?></td></tr><tr><th style="background:var(--mint2)">Kategori</th><td><?= htmlspecialchars($data['namakategori'] ?? 'Umum') ?></td></tr><tr><th style="background:var(--mint2)">Stok</th><td><b><?= $stok ?> <?= htmlspecialchars($data['satuan']) ?></b> - <?php if($stok==0): ?><span class="badge-exp">Habis</span><?php elseif($stok<=5): ?><span class="badge-kritis">Kritis</span><?php else: ?><span class="badge-aman">Aman</span><?php endif; ?></td></tr><tr><th style="background:var(--mint2)">Kadaluarsa</th><td class="<?= $isExp?'text-danger font-weight-bold':'' ?>"><?= date('d M Y', $exp) ?> <?= $isExp?'(SUDAH KADALUARSA)':'' ?></td></tr><tr><th style="background:var(--mint2)">Tanggal Masuk</th><td><?= date('d M Y', strtotime($data['tanggalmasuk'])) ?></td></tr></table>
      <div class="mt-3"><a href="index.php?halaman=editbarang&id=<?= $data['idbarang'] ?>" class="btn-toska">Edit</a> <a href="proses/prosesbarang.php?aksi=hapus&id=<?= $data['idbarang'] ?>" onclick="return confirm('Hapus?')" class="btn-aksi btn-hapus" style="width:auto; padding:8px 20px; border-radius:30px">Hapus</a></div>
    </div>
  </div></div></div></div></div>
</div>