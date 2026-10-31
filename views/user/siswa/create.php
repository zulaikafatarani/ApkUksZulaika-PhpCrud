<?php
// views/user/siswa/create.php - FINAL CREATE - 0103786196 XI RPL 2
batasi_akses_role(['admin','petugas','anggota']);
?>
<div class="dash">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2 align-items-center">
        <div class="col-sm-7">
          <h1 class="m-0 font-weight-bold" style="color:var(--dark)"><i class="fas fa-user-plus mr-2" style="color:var(--teal)"></i> Tambah Data Murid</h1>
          <small class="text-muted">UKS Digital - <b style="color:var(--teal)">Tambah Siswa Baru</b> | <span class="badge-mint">Siswa • Master Data</span></small>
        </div>
        <div class="col-sm-5 text-right"><a href="index.php?halaman=siswa" class="btn-toska"><i class="fas fa-arrow-left mr-1"></i> Kembali</a></div>
      </div>
    </div>
  </div>
  <div class="content"><div class="container-fluid">
    <div class="uk-card-pen p-0 mb-4">
      <div class="header-pen"><h6 class="font-weight-bold mb-0" style="color:var(--dark)"><i class="fas fa-plus-circle mr-2" style="color:var(--teal)"></i> Form Tambah Siswa</h6><span class="badge-mint">Wajib Isi • NIS Unik</span></div>
      <form action="proses/prosessiswa.php?aksi=tambah" method="POST" enctype="multipart/form-data">
        <div class="p-4"><div class="row">
          <div class="col-md-6">
            <div class="form-group mb-3"><label class="font-weight-bold">NISN / NIS Murid <span class="text-danger">*</span></label><input type="text" name="nis" class="form-control" placeholder="Contoh: 0103786196" required><small class="text-muted">NIS harus unik, tidak boleh sama dengan siswa lain</small></div>
            <div class="form-group mb-3"><label class="font-weight-bold">Nama Lengkap Murid <span class="text-danger">*</span></label><input type="text" name="namasiswa" class="form-control" placeholder="Contoh: Zulaika Fatarani" required></div>
            <div class="form-group mb-3"><label class="font-weight-bold">Jenis Kelamin <span class="text-danger">*</span></label><select name="jeniskelamin" class="form-control" required><option value="">- Pilih JK -</option><option value="L">Laki-Laki</option><option value="P">Perempuan</option></select></div>
            <div class="form-group mb-3"><label class="font-weight-bold">Kelas & Tingkatan <span class="text-danger">*</span></label><input type="text" name="kelas" class="form-control" placeholder="Contoh: XI RPL 2" required></div>
            <div class="form-group mb-3"><label class="font-weight-bold">Foto Siswa</label><input type="file" name="foto" class="form-control-file border p-2 rounded" accept="image/*"><small class="text-muted">Kosongkan jika tidak ada foto, akan pakai default</small></div>
          </div>
          <div class="col-md-6">
            <div class="form-group mb-3"><label class="font-weight-bold">Golongan Darah</label><select name="golongandarah" class="form-control"><option value="">- Pilih Gol. Darah -</option><option value="A">A</option><option value="B">B</option><option value="AB">AB</option><option value="O">O</option></select></div>
            <div class="form-group mb-3"><label class="font-weight-bold">No HP / WA Orang Tua <span class="text-danger">*</span></label><input type="text" name="nohp" class="form-control" placeholder="Contoh: 0822xxxx" required></div>
            <div class="form-group mb-3"><label class="font-weight-bold">Alamat Lengkap</label><textarea name="alamat" class="form-control" rows="2" placeholder="Contoh: Jl. Pendidikan No.1 Karang Baru"></textarea></div>
            <div class="form-group mb-3"><label class="font-weight-bold">Riwayat Penyakit</label><textarea name="riwayatpenyakit" class="form-control" rows="2" placeholder="Contoh: Asma, - (jika tidak ada)"></textarea></div>
            <div class="form-group mb-3"><label class="font-weight-bold">Riwayat Alergi Bawaan</label><textarea name="riwayatalergi" class="form-control" rows="2" placeholder="Contoh: Alergi debu, alergi udang"></textarea></div>
            <div class="form-group mb-3 p-3" style="background:var(--mint2); border-radius:12px; border:1px solid #99f6e0"><small class="text-muted"><i class="fas fa-info-circle mr-1" style="color:var(--teal)"></i> Password login pasien otomatis = NIS (MD5). Nanti bisa reset di menu siswa. Kolom password sudah ada di tabel siswa.</small></div>
          </div>
        </div></div>
        <div class="p-3 text-right" style="border-top:1px solid #e0f2f1;background:var(--mint2)"><a href="index.php?halaman=siswa" class="btn-outline-bar">Batal</a> <button type="submit" class="btn-toska"><i class="fas fa-save mr-1"></i> Simpan Siswa</button></div>
      </form>
    </div>
  </div></div>
</div>