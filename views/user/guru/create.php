<?php
// views/user/guru/create.php - FINAL FIX MUNCUL - pakai uk-card-pen
batasi_akses_role(['admin','petugas']);
?>
<div class="dash">
  <div class="content-header"><div class="container-fluid"><div class="row mb-2 align-items-center">
    <div class="col-sm-7"><h1 class="m-0 font-weight-bold" style="color:var(--dark)"><i class="fas fa-user-plus mr-2" style="color:var(--teal)"></i> Tambah Guru</h1><small class="text-muted">UKS Digital - <b style="color:var(--teal)">Guru Baru</b> | <span class="badge-mint">BARU</span></small></div>
    <div class="col-sm-5 text-right"><a href="index.php?halaman=guru" class="btn-toska"><i class="fas fa-arrow-left mr-1"></i> Kembali</a></div>
  </div></div></div>
  <div class="content"><div class="container-fluid">
    <div class="uk-card-pen">
      <div class="header-pen"><h6 class="font-weight-bold mb-0" style="color:var(--dark)"><i class="fas fa-user-plus mr-2" style="color:var(--teal)"></i> Form Tambah Guru</h6><span class="badge-mint">NIP Unik</span></div>
      <form action="proses/prosesguru.php?aksi=tambah" method="POST" enctype="multipart/form-data">
        <div class="p-4"><div class="row">
          <div class="col-md-6">
            <div class="form-group"><label class="font-weight-bold">NIP <span class="text-danger">*</span></label><input type="text" name="nip" class="form-control" placeholder="NIP Guru" required></div>
            <div class="form-group"><label class="font-weight-bold">Nama Guru <span class="text-danger">*</span></label><input type="text" name="namaguru" class="form-control" placeholder="Nama lengkap guru" required></div>
            <div class="form-group"><label class="font-weight-bold">Jenis Kelamin</label><select name="jeniskelamin" class="form-control" required><option value="L">Laki-laki</option><option value="P" selected>Perempuan</option></select></div>
          </div>
          <div class="col-md-6">
            <div class="form-group"><label class="font-weight-bold">No HP <span class="text-danger">*</span></label><input type="text" name="nohp" class="form-control" placeholder="+62..." required></div>
            <div class="form-group"><label class="font-weight-bold">Alamat</label><textarea name="alamat" class="form-control" rows="2" placeholder="Alamat guru"></textarea></div>
            <div class="form-group"><label class="font-weight-bold">Riwayat Penyakit / Alergi</label><textarea name="riwayatpenyakit" class="form-control" rows="2" placeholder="Asma, alergi debu, dll"></textarea></div>
            <div class="form-group"><label class="font-weight-bold">Foto</label><input type="file" name="foto" class="form-control-file border p-2 rounded" accept="image/*"></div>
          </div>
        </div></div>
        <div class="p-3 text-right" style="border-top:1px solid #e0f2f1;background:var(--mint2)"><a href="index.php?halaman=guru" class="btn-outline-bar">Batal</a> <button type="submit" class="btn-toska"><i class="fas fa-save mr-1"></i> Simpan Guru</button></div>
      </form>
    </div>
  </div></div>
</div>