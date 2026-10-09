<?php batasi_akses_role(['admin','petugas']); ?>
<div class="content-header"><div class="container-fluid"><h3 class="text-success font-weight-bold">Tambah Kategori</h3></div></div>
<div class="content"><div class="container-fluid"><div class="card card-success card-outline col-md-6"><div class="card-body">
<form action="proses/prosesbarang.php" method="POST">
<input type="hidden" name="aksi" value="tambah_kategori">
<div class="form-group"><label>Nama Kategori *</label><input type="text" name="namakategori" class="form-control" placeholder="Contoh: P3K, Alkes, Obat Keras" required></div>
<div class="form-group"><label>Deskripsi</label><textarea name="deskripsi" class="form-control" rows="3"></textarea></div>
<a href="index.php?halaman=kategori" class="btn btn-secondary">Kembali</a> <button class="btn btn-success">Simpan</button>
</form></div></div></div></div>