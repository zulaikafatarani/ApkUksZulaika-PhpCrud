<?php batasi_akses_role(['admin','petugas']); 
$q = mysqli_query($koneksi, "SELECT k.*, (SELECT COUNT(*) FROM barang b WHERE b.idkategori=k.idkategori) as jml FROM kategori k ORDER BY k.namakategori ASC"); ?>
<div class="content-header"><div class="container-fluid"><div class="row"><div class="col-6"><h3 class="font-weight-bold text-success"><i class="fas fa-tags"></i> Kategori Obat</h3></div><div class="col-6 text-right"><a href="index.php?halaman=createkategori" class="btn btn-success btn-sm rounded-pill"><i class="fas fa-plus"></i> Tambah</a></div></div></div></div>
<div class="content"><div class="container-fluid"><div class="card shadow-sm"><div class="card-body p-0 table-responsive">
<table class="table table-hover mb-0"><thead class="bg-success text-white"><tr><th>No</th><th>Nama</th><th>Deskripsi</th><th>Jml Obat</th><th>Aksi</th></tr></thead><tbody>
<?php $no=1; while($r=mysqli_fetch_assoc($q)){ ?>
<tr><td><?= $no++ ?></td><td><b><?= htmlspecialchars($r['namakategori']) ?></b></td><td><small><?= htmlspecialchars($r['deskripsi']??'-') ?></small></td><td><span class="badge badge-info"><?= $r['jml'] ?> item</span></td>
<td><a href="index.php?halaman=showkategori&id=<?= $r['idkategori'] ?>" class="btn btn-success btn-xs"><i class="fas fa-eye"></i></a> <a href="index.php?halaman=editkategori&id=<?= $r['idkategori'] ?>" class="btn btn-warning btn-xs"><i class="fas fa-edit"></i></a> <a href="proses/prosesbarang.php?hapus_kategori=<?= $r['idkategori'] ?>" onclick="return confirm('Hapus kategori ini?')" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></a></td></tr>
<?php } ?>
</tbody></table></div></div></div></div>