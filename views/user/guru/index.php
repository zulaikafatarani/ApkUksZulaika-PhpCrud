<?php batasi_akses_role(['admin','petugas']);
$q = mysqli_query($koneksi, "SELECT * FROM guru ORDER BY idguru DESC");
$status=$_GET['status']??'';
if($status) echo '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Berhasil: '.$status.'</div>';
?>
<div class="content-header"><div class="container-fluid"><div class="row mb-2">
<div class="col-sm-6"><h1 class="m-0 text-success font-weight-bold"><i class="fas fa-chalkboard-teacher mr-1"></i> Data Guru</h1></div>
<div class="col-sm-6 text-right"><a href="index.php?halaman=createguru" class="btn btn-success btn-sm rounded-pill px-3"><i class="fas fa-plus mr-1"></i> Tambah Guru</a></div>
</div></div></div>
<div class="content"><div class="container-fluid"><div class="card card-success card-outline shadow-sm"><div class="card-body p-0 table-responsive">
<table class="table table-hover table-striped mb-0">
<thead class="bg-light"><tr><th>No</th><th>Foto</th><th>NIP</th><th>Nama</th><th>L/P</th><th>No HP</th><th>Riwayat</th><th class="text-center">Aksi</th></tr></thead>
<tbody><?php $no=1; while($r=mysqli_fetch_assoc($q)): ?>
<tr>
<td><?= $no++ ?></td>
<td><img src="assets/images/guru/<?= $r['foto'] ?>" style="width:40px;height:40px;object-fit:cover" class="rounded-circle" onerror="this.src='assets/images/guru/default.png'"></td>
<td><b><?= htmlspecialchars($r['nip']) ?></b></td>
<td><?= htmlspecialchars($r['namaguru']) ?></td>
<td><?= $r['jeniskelamin']=='L'?'L':'P' ?></td>
<td><?= htmlspecialchars($r['nohp']) ?></td>
<td><small class="text-danger"><?= htmlspecialchars($r['riwayatpenyakit']??'-') ?></small></td>
<td class="text-center">
<a href="index.php?halaman=showguru&id=<?= $r['idguru'] ?>" class="btn btn-info btn-xs"><i class="fas fa-eye"></i></a>
<a href="index.php?halaman=editguru&id=<?= $r['idguru'] ?>" class="btn btn-warning btn-xs"><i class="fas fa-edit"></i></a>
<a href="proses/prosespasien.php?aksi=hapus&jenis=guru&id=<?= $r['idguru'] ?>" onclick="return confirm('Hapus guru <?= htmlspecialchars($r['namaguru']) ?>?')" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></a>
</td>
</tr><?php endwhile; ?></tbody>
</table>
</div></div></div></div>