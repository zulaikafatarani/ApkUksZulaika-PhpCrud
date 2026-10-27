<?php
// views/user/kategori/create.php - FINAL GABUNG UKS.CSS
batasi_akses_role(['admin','petugas']);
?>
<div class="dash">
  <div class="content-header"><div class="container-fluid"><div class="row mb-2 align-items-center">
    <div class="col-sm-7"><h1 class="m-0 font-weight-bold" style="color:var(--dark)"><i class="fas fa-plus-circle mr-2" style="color:var(--teal)"></i> Tambah Kategori</h1><small class="text-muted">UKS Digital - <b style="color:var(--teal)">Kategori Baru</b> | <span class="badge-mint">BARU</span></small></div>
    <div class="col-sm-5 text-right"><a href="index.php?halaman=kategori" class="btn-toska"><i class="fas fa-arrow-left mr-1"></i> Kembali</a></div>
  </div></div></div>
  <div class="content"><div class="container-fluid"><div class="row justify-content-center"><div class="col-md-6"><div class="uk-card-kat">
    <div class="header-kat"><h6 class="font-weight-bold mb-0" style="color:var(--dark)"><i class="fas fa-tags mr-2" style="color:var(--teal)"></i> Form Tambah Kategori</h6></div>
    <div class="p-4">
      <form action="proses/prosesbarang.php" method="POST">
        <input type="hidden" name="aksi" value="tambah_kategori">
        <div class="form-group"><label class="font-weight-bold">Nama Kategori *</label><input type="text" name="namakategori" class="form-control" placeholder="Contoh: P3K, Alkes, Obat Keras" required></div>
        <div class="form-group"><label class="font-weight-bold">Deskripsi</label><textarea name="deskripsi" class="form-control" rows="3" placeholder="Deskripsi kategori obat..."></textarea></div>
        <div class="text-right"><a href="index.php?halaman=kategori" class="btn btn-secondary" style="border-radius:30px; padding:8px 20px">Kembali</a> <button class="btn-toska"><i class="fas fa-save mr-1"></i> Simpan</button></div>
      </form>
    </div>
  </div></div></div></div></div>
</div>