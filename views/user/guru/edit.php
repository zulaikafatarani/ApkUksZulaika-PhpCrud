<?php batasi_akses_role(['admin','petugas']);
$id=(int)($_GET['id']??0);
$d=mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT * FROM guru WHERE idguru=$id"));
if(!$d){ header("Location: index.php?halaman=guru"); exit(); }
?>
<div class="content-header"><div class="container-fluid"><h1 class="m-0 text-success font-weight-bold">Edit Guru - <?= htmlspecialchars($d['namaguru']) ?></h1></div></div>
<div class="content"><div class="container-fluid"><div class="card card-success card-outline shadow-sm">
<form action="proses/prosespasien.php?aksi=ubah&jenis=guru" method="POST" enctype="multipart/form-data">
<input type="hidden" name="idguru" value="<?= $d['idguru'] ?>"><input type="hidden" name="foto_lama" value="<?= $d['foto'] ?>">
<div class="card-body">
<div class="row">
<div class="col-md-6">
<div class="form-group"><label>NIP</label><input type="text" name="nip" class="form-control" value="<?= htmlspecialchars($d['nip']) ?>" required></div>
<div class="form-group"><label>Nama</label><input type="text" name="namaguru" class="form-control" value="<?= htmlspecialchars($d['namaguru']) ?>" required></div>
<div class="form-group"><label>JK</label><select name="jeniskelamin" class="form-control"><option value="L" <?= $d['jeniskelamin']=='L'?'selected':'' ?>>Laki-laki</option><option value="P" <?= $d['jeniskelamin']=='P'?'selected':'' ?>>Perempuan</option></select></div>
<div class="form-group"><label>Foto Lama</label><br><img src="assets/images/guru/<?= $d['foto'] ?>" style="max-height:80px" class="img-thumbnail"></div>
</div>
<div class="col-md-6">
<div class="form-group"><label>No HP</label><input type="text" name="nohp" class="form-control" value="<?= htmlspecialchars($d['nohp']) ?>"></div>
<div class="form-group"><label>Alamat</label><textarea name="alamat" class="form-control"><?= htmlspecialchars($d['alamat']) ?></textarea></div>
<div class="form-group"><label>Riwayat Penyakit</label><textarea name="riwayatpenyakit" class="form-control"><?= htmlspecialchars($d['riwayatpenyakit']) ?></textarea></div>
<div class="form-group"><label>Ganti Foto</label><input type="file" name="foto" class="form-control-file border p-1 rounded" accept="image/*"><small class="text-muted">Kosongkan jika tidak ganti</small></div>
</div>
</div></div>
<div class="card-footer bg-light text-right"><a href="index.php?halaman=guru" class="btn btn-secondary">Batal</a> <button type="submit" class="btn btn-success">Update</button></div>
</form></div></div></div>