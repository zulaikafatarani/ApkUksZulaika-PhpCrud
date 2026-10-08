<?php batasi_akses_role(['admin','petugas']); $id=(int)($_GET['id']??0);
$d=mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT * FROM guru WHERE idguru=$id"));
if(!$d){ header("Location: index.php?halaman=guru"); exit(); }
?>
<div class="content"><div class="container-fluid"><div class="card card-success card-outline shadow-sm mt-3"><div class="card-body">
<div class="row"><div class="col-md-3 text-center"><img src="assets/images/guru/<?= $d['foto'] ?>" class="img-fluid rounded border p-2" style="max-height:220px" onerror="this.src='assets/images/guru/default.png'"><h5 class="mt-2 font-weight-bold"><?= htmlspecialchars($d['namaguru']) ?></h5><small class="text-muted"><?= $d['nip'] ?></small></div>
<div class="col-md-9"><table class="table table-bordered"><tr><th class="bg-light" width="30%">NIP</th><td><?= htmlspecialchars($d['nip']) ?></td></tr><tr><th class="bg-light">Nama</th><td><?= htmlspecialchars($d['namaguru']) ?></td></tr><tr><th class="bg-light">JK</th><td><?= $d['jeniskelamin'] ?></td></tr><tr><th class="bg-light">No HP</th><td><?= htmlspecialchars($d['nohp']) ?></td></tr><tr><th class="bg-light">Alamat</th><td><?= htmlspecialchars($d['alamat']) ?></td></tr><tr><th class="bg-light">Riwayat Penyakit</th><td class="text-danger"><?= htmlspecialchars($d['riwayatpenyakit']) ?></td></tr></table>
<a href="index.php?halaman=guru" class="btn btn-secondary btn-sm">Kembali</a> <a href="index.php?halaman=editguru&id=<?= $d['idguru'] ?>" class="btn btn-warning btn-sm">Edit</a>
</div></div></div></div></div></div>