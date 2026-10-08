<?php batasi_akses_role(['admin','petugas']); ?>
<div class="content-header"><div class="container-fluid"><h1 class="m-0 text-success font-weight-bold">Tambah Guru</h1></div></div>
<div class="content"><div class="container-fluid"><div class="card card-success card-outline shadow-sm">
<form action="proses/prosespasien.php?aksi=tambah&jenis=guru" method="POST" enctype="multipart/form-data">
<div class="card-body">
<div class="row">
<div class="col-md-6"><div class="form-group"><label>NIP</label><input type="text" name="nip" class="form-control" placeholder="NIP Guru" required></div>
<div class="form-group"><label>Nama Guru</label><input type="text" name="namaguru" class="form-control" required></div>
<div class="form-group"><label>Jenis Kelamin</label><select name="jeniskelamin" class="form-control" required><option value="L">Laki-laki</option><option value="P">Perempuan</option></select></div></div>
<div class="col-md-6"><div class="form-group"><label>No HP</label><input type="text" name="nohp" class="form-control" placeholder="+62..." required></div>
<div class="form-group"><label>Alamat</label><textarea name="alamat" class="form-control" rows="2"></textarea></div>
<div class="form-group"><label>Riwayat Penyakit</label><textarea name="riwayatpenyakit" class="form-control" rows="2" placeholder="Asma, dll"></textarea></div>
<div class="form-group"><label>Foto</label><input type="file" name="foto" class="form-control-file border p-1 rounded" accept="image/*"></div></div>
</div></div>
<div class="card-footer bg-light text-right"><a href="index.php?halaman=guru" class="btn btn-secondary">Batal</a> <button type="submit" class="btn btn-success">Simpan</button></div>
</form></div></div></div>