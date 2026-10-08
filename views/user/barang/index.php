<?php
batasi_akses_role(['admin','petugas','anggota']);

// Notif flash
$status = $_GET['status'] ?? '';
if($status=='sukses_tambah') echo '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><i class="fas fa-check-circle mr-1"></i> Obat berhasil ditambahkan ke lemari!</div>';
if($status=='sukses_ubah') echo '<div class="alert alert-info alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><i class="fas fa-edit mr-1"></i> Data obat berhasil diubah!</div>';
if($status=='sukses_hapus') echo '<div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><i class="fas fa-trash mr-1"></i> Obat dihapus.</div>';
if($status=='stok_kurang') echo '<div class="alert alert-danger"><i class="fas fa-exclamation-triangle mr-1"></i> Stok obat tidak cukup untuk penanganan!</div>';

// Query utama - JOIN kategori (tanpa merk, tanpa harga sesuai revisi UKS)
$query = "SELECT b.*, k.namakategori FROM barang b LEFT JOIN kategori k ON b.idkategori=k.idkategori ORDER BY b.tanggalkadaluarsa ASC, b.idbarang DESC";
$result = mysqli_query($koneksi, $query);
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"><h1 class="m-0 font-weight-bold text-success"><i class="fas fa-boxes mr-1"></i> Lemari Obat & Alkes</h1></div>
            <div class="col-sm-6 text-right">
                <a href="index.php?halaman=tambahbarang" class="btn btn-success btn-sm rounded-pill px-3 font-weight-bold"><i class="fas fa-plus mr-1"></i> Tambah Obat</a>
                <a href="index.php?halaman=kategori" class="btn btn-outline-secondary btn-sm rounded-pill px-3"><i class="fas fa-tags mr-1"></i> Kategori</a>
            </div>
        </div>
    </div>
</div>

<div class="content">
<div class="container-fluid">
<div class="card card-success card-outline shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0" id="tabelBarang">
                <thead class="bg-light">
                    <tr>
                        <th width="5%">#</th>
                        <th width="10%">Foto</th>
                        <th>Nama Sediaan</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Kadaluarsa</th>
                        <th>Masuk</th>
                        <th width="18%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no=1; while($b=mysqli_fetch_assoc($result)): 
                    $stok=(int)$b['stok'];
                    $exp=strtotime($b['tanggalkadaluarsa']);
                    $isExp = $exp < time();
                    $isKritis = $stok <= 5 && $stok > 0;
                ?>
                    <tr class="<?= $isExp?'table-danger':($isKritis?'table-warning':'') ?>">
                        <td><?= $no++ ?></td>
                        <td><img src="assets/images/barang/<?= htmlspecialchars($b['foto']) ?>" style="width:45px;height:45px;object-fit:cover" class="rounded border" onerror="this.src='assets/images/barang/default_obat.png'"></td>
                        <td>
                            <b><?= htmlspecialchars($b['namabarang']) ?></b><br>
                            <small class="text-muted"><?= htmlspecialchars($b['satuan']) ?></small>
                            <?php if($isExp): ?><br><span class="badge badge-danger badge-sm">KADALUARSA</span><?php endif; ?>
                        </td>
                        <td><span class="badge badge-success"><?= htmlspecialchars($b['namakategori'] ?? 'Umum') ?></span></td>
                        <td>
                            <b class="<?= $stok==0?'text-danger':($isKritis?'text-warning':'text-success') ?>"><?= $stok ?></b>
                            <?php if($stok==0): ?><br><small class="text-danger">Habis</small><?php elseif($isKritis): ?><br><small class="text-warning">Menipis</small><?php endif; ?>
                        </td>
                        <td class="<?= $isExp?'text-danger font-weight-bold':'' ?>"><small><?= date('d/m/Y', $exp) ?></small></td>
                        <td><small><?= date('d/m/Y', strtotime($b['tanggalmasuk'])) ?></small></td>
                        <td class="text-center">
                            <a href="index.php?halaman=detailbarang&id=<?= $b['idbarang'] ?>" class="btn btn-info btn-sm" title="Detail"><i class="fas fa-eye"></i></a>
                            <a href="index.php?halaman=editbarang&id=<?= $b['idbarang'] ?>" class="btn btn-warning btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                            <a href="proses/prosesbarang.php?aksi=hapus&id=<?= $b['idbarang'] ?>" onclick="return confirm('Hapus <?= htmlspecialchars($b['namabarang']) ?>? Stok <?= $stok ?> akan hilang!