<?php batasi_akses_role(['admin','petugas','anggota']);
$id = (int)($_GET['id'] ?? 0);
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT b.*, k.namakategori FROM barang b LEFT JOIN kategori k ON b.idkategori=k.idkategori WHERE b.idbarang=$id LIMIT 1"));
if(!$data){ header("Location: index.php?halaman=barang"); exit(); }
$stok = (int)$data['stok']; $exp = strtotime($data['tanggalkadaluarsa']); $isExp = $exp < time();
?>
<div class="content-header"><div class="container-fluid"><div class="row mb-2">
    <div class="col-sm-6"><h1 class="m-0 font-weight-bold text-success"><i class="fas fa-eye mr-1"></i>Detail Obat</h1></div>
    <div class="col-sm-6 text-right"><a href="index.php?halaman=barang" class="btn btn-outline-secondary btn-sm rounded-pill px-3">Kembali</a></div>
</div></div></div>
<div class="content"><div class="container-fluid"><div class="card card-success card-outline shadow-sm">
    <div class="card-body"><div class="row align-items-center">
        <div class="col-md-4 text-center mb-3"><img src="assets/images/barang/<?= htmlspecialchars($data['foto']) ?>" class="img-fluid rounded shadow-sm border p-2" style="max-height:250px" onerror="this.src='assets/images/barang/default_obat.png'"></div>
        <div class="col-md-8">
            <table class="table table-bordered mb-0">
                <tr><th class="bg-light" width="35%">Nama</th><td class="font-weight-bold"><?= htmlspecialchars($data['namabarang']) ?></td></tr>
                <tr><th class="bg-light">Kategori</th><td><?= htmlspecialchars($data['namakategori'] ?? 'Umum') ?></td></tr>
                <tr><th class="bg-light">Stok</th><td><b><?= $stok ?> <?= htmlspecialchars($data['satuan']) ?></b> - 
                    <?php if($stok==0): ?><span class="badge badge-danger">Habis</span><?php elseif($stok<=5): ?><span class="badge badge-warning">Kritis</span><?php else: ?><span class="badge badge-success">Aman</span><?php endif; ?>
                </td></tr>
                <tr><th class="bg-light">Kadaluarsa</th><td class="<?= $isExp?'text-danger font-weight-bold':'' ?>"><?= date('d M Y', $exp) ?> <?= $isExp?'(SUDAH KADALUARSA)':'' ?></td></tr>
                <tr><th class="bg-light">Tanggal Masuk</th><td><?= date('d M Y', strtotime($data['tanggalmasuk'])) ?></td></tr>
            </table>
            <div class="mt-3">
                <a href="index.php?halaman=editbarang&id=<?= $data['idbarang'] ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                <a href="proses/prosesbarang.php?aksi=hapus&id=<?= $data['idbarang'] ?>" onclick="return confirm('Hapus?')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</a>
            </div>
        </div>
    </div></div>
</div></div></div>