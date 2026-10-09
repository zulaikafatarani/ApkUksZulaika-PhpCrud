<?php batasi_akses_role(['admin','petugas','anggota']); ?>
<div class="content-header"><div class="container-fluid"><h1 class="m-0 font-weight-bold text-success"><i class="fas fa-user-plus mr-1"></i> Registrasi Siswa</h1></div></div>
<div class="content"><div class="container-fluid"><div class="card card-success card-outline shadow-sm">
<form action="proses/prosespasien.php?aksi=tambah&jenis=siswa" method="POST" enctype="multipart/form-data">
<div class="card-body">
<div class="row">
<div class="col-md-6">
<div class="form-group"><label>NIS (No Induk Siswa) - Kunci Cek Riwayat</label><input type="text" name="nis" class="form-control" placeholder="0103786196" required></div>
<div class="form-group"><label>Nama Lengkap Siswa</label><input type="text" name="namasiswa" class="form-control" placeholder="Zulaika Fatarani" required></div>
<div class="row"><div class="col-6"><div class="form-group"><label>Kelas</label><input type="text" name="kelas" class="form-control" placeholder="XI RPL 2" required></div></div>
<div class="col-6"><div class="form-group"><label>Jenis Kelamin</label><select name="jeniskelamin" class="form-control" required><option value="L">Laki-laki</option><option value="P">Perempuan</option></select></div></div></div>
<div class="form-group"><label>Gol. Darah</label><select name="golongandarah" class="form-control"><option value="">- Pilih -</option><option value="A">A</option><option value="B">B</option><option value="AB">AB</option><option value="O">O</option></select></div>
</div>
<div class="col-md-6">
<div class="form-group"><label>No HP / WA Aktif (Kunci Verifikasi Ganda)</label><input type="text" name="nohp" class="form-control" placeholder="+62 812-6938-9167" required><small class="text-muted">Dipakai untuk login cekriwayat.php NIS + No HP</small></div>
<div class="form-group"><label>Alamat</label><textarea name="alamat" class="form-control" rows="2" placeholder="Karang Baru, Aceh Tamiang"></textarea></div>
<div class="form-group"><label>Riwayat Penyakit</label><textarea name="riwayatpenyakit" class="form-control" rows="2" placeholder="Asma, Demam"></textarea></div>
<div class="form-group"><label>Riwayat Alergi</label><textarea name="riwayatalergi" class="form-control" rows="2" placeholder="Alergi debu, udang"></textarea></div>
<div class="form-group"><label>Foto Siswa</label><input type="file" name="foto" class="form-control-file border p-1 rounded" accept="image/*"></div>
</div>
</div></div>
<div class="card-footer bg-light text-right"><a href="index.php?halaman=siswa" class="btn btn-secondary">Batal</a> <button type="submit" class="btn btn-success font-weight-bold px-4">Simpan Siswa</button></div>
</form></div></div></div>