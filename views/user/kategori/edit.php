<?php batasi_akses_role(['admin','petugas']); $id=(int)($_GET['id']??0); $d=mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT * FROM kategori WHERE idkategori=$id")); if(!$d){ echo 'Tidak ada'; return; } ?>
<div class="content-header"><div class="container-fluid"><h3 class="text-success font-weight-bold">Edit: <?= htmlspecialchars($d['namakategori']) ?></h3></div></div>
<div class="content"><div class="container-fluid"><div class="card card-warning card-outline col-md-6"><div class="card-body">
<form action="proses/prosesbarang.php" method="POST">
<input type="hidden" name="aksi" value="edit_kategori">
<input type="hidden" name="idkategori" value="<?= $d['idkategori'] ?>">
<div class="form-group"><label>Nama Kategori</label><input type="text" name="namakategori" class="form-control" value="<?= htmlspecialchars($d['namakategori']) ?>" required></div>
<div class="form-group"><label>Deskripsi</label><textarea name="deskripsi" class="form-control" rows="3"><?= htmlspecialchars($d['deskripsi']??'') ?></textarea></div>
<a href="index.php?halaman=kategori" class="btn btn-secondary">Kembali</a> <button class="btn btn-warning">Update</button>
</form></div></div></div></div>