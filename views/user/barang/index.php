<?php
batasi_akses_role(['admin','petugas','anggota']);
$status = $_GET['status'] ?? '';
?>
<div class="content-header"><div class="container-fluid">
<div class="row mb-2"><div class="col-sm-6"><h1 class="m-0 font-weight-bold text-success"><i class="fas fa-boxes mr-1"></i> Lemari Obat & Alkes</h1></div>
<div class="col-sm-6 text-right">
<a href="index.php?halaman=createbarang" class="btn btn-success btn-sm rounded-pill px-3"><i class="fas fa-plus mr-1"></i> Tambah Barang</a>
<a href="index.php?halaman=kategori" class="btn btn-outline-secondary btn-sm rounded-pill px-3"><i class="fas fa-tags mr-1"></i> Kategori</a>
</div></div>
</div></div>

<div class="content"><div class="container-fluid">
<?php if($status=='sukses_tambah'): ?><div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><i class="fas fa-check"></i> Obat ditambahkan!</div><?php endif; ?>
<?php if($status=='sukses_ubah'): ?><div class="alert alert-info alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><i class="fas fa-edit"></i> Obat diubah!</div><?php endif; ?>
<?php if($status=='sukses_hapus'): ?><div class="alert alert-warning">Obat dihapus!</div><?php endif; ?>

<?php
$q = mysqli_query($koneksi,"SELECT b.*, k.namakategori FROM barang b LEFT JOIN kategori k ON b.idkategori=k.idkategori ORDER BY b.tanggalkadaluarsa ASC, b.idbarang DESC");
?>
<div class="card card-success card-outline shadow-sm"><div class="card-body p-0 table-responsive">
<table class="table table-hover table-striped mb-0">
<thead class="bg-light"><tr><th width="5%">#</th><th width="10%">Foto</th><th>Nama Sediaan</th><th>Kategori</th><th>Stok</th><th>Kadaluarsa</th><th>Masuk</th><th width="18%" class="text-center">Aksi</th></tr></thead>
<tbody>
<?php $no=1; while($b=mysqli_fetch_assoc($q)): 
$stok=(int)($b['stok']??0);
$expTime = strtotime($b['tanggalkadaluarsa'] ?? date('Y-m-d'));
$isExp = $expTime < time();
$isKritis = $stok<=5 && $stok>0;
?>
<tr class="<?= $isExp?'table-danger':($isKritis?'table-warning':'') ?>">
<td><?= $no++ ?></td>
<td><img src="assets/images/barang/<?= htmlspecialchars($b['foto'] ?? 'default_obat.png') ?>" style="width:45px;height:45px;object-fit:cover" class="rounded border" onerror="this.src='assets/images/barang/default_obat.png'"></td>
<td><b><?= htmlspecialchars($b['namabarang']) ?></b><br><small class="text-muted"><?= htmlspecialchars($b['satuan'] ?? '') ?></small><?php if($isExp): ?><br><span class="badge badge-danger">KADALUARSA</span><?php endif; ?></td>
<td><span class="badge badge-success"><?= htmlspecialchars($b['namakategori'] ?? 'Umum') ?></span></td>
<td><b class="<?= $stok==0?'text-danger':($isKritis?'text-warning':'text-success') ?>"><?= $stok ?></b><?php if($stok==0): ?><br><small class="text-danger">Habis</small><?php elseif($isKritis): ?><br><small class="text-warning">Menipis</small><?php endif; ?></td>
<td class="<?= $isExp?'text-danger font-weight-bold':'' ?>"><small><?= date('d/m/Y',$expTime) ?></small></td>
<td><small><?= isset($b['tanggalmasuk']) ? date('d/m/Y',strtotime($b['tanggalmasuk'])) : '-' ?></small></td>
<td class="text-center">
<a href="index.php?halaman=showbarang&id=<?= $b['idbarang'] ?>" class="btn btn-info btn-xs" title="Detail"><i class="fas fa-eye"></i></a>
<a href="index.php?halaman=editbarang&id=<?= $b['idbarang'] ?>" class="btn btn-warning btn-xs" title="Edit"><i class="fas fa-edit"></i></a>
<a href="proses/prosesbarang.php?aksi=hapus&id=<?= $b['idbarang'] ?>" onclick="return confirm('Hapus <?= addslashes($b['namabarang']) ?>?')" class="btn btn-danger btn-xs" title="Hapus"><i class="fas fa-trash"></i></a>
</td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>
<div class="card-footer bg-light small text-muted"><i class="fas fa-info-circle"></i> Merah = kadaluarsa, Kuning = stok ≤5</div>
</div>
</div></div>