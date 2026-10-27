<?php
// views/user/barang/create.php - FINAL GABUNG UKS.CSS
batasi_akses_role(['admin','petugas','anggota']);
$qKat = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY namakategori ASC");
?>
<div class="dash">
  <div class="content-header"><div class="container-fluid"><div class="row mb-2 align-items-center">
    <div class="col-sm-6"><h1 class="m-0 font-weight-bold" style="color:var(--dark)"><i class="fas fa-plus-circle mr-2" style="color:var(--teal)"></i> Tambah Obat / Alkes</h1><small class="text-muted">UKS Digital - <b style="color:var(--teal)">Barang Baru</b> | <span class="badge-mint">BARU</span></small></div>
    <div class="col-sm-6 text-right"><a href="index.php?halaman=barang" class="btn-toska"><i class="fas fa-arrow-left mr-1"></i> Kembali</a></div>
  </div></div></div>
  <div class="content"><div class="container-fluid"><div class="uk-card-bar">
    <form action="proses/prosesbarang.php?aksi=tambah" method="POST" enctype="multipart/form-data">
      <div class="p-4"><div class="row">
        <div class="col-md-6">
          <div class="form-group"><label class="font-weight-bold">Nama Obat / Alkes</label><input type="text" name="namabarang" class="form-control" placeholder="Paracetamol 500mg / Tensimeter" required></div>
          <div class="form-group"><label class="font-weight-bold">Kategori</label><select name="idkategori" class="form-control" required><option value="" disabled selected>-- Pilih Kategori --</option><?php while($k=mysqli_fetch_assoc($qKat)): ?><option value="<?= $k['idkategori'] ?>"><?= htmlspecialchars($k['namakategori']) ?></option><?php endwhile; ?></select></div>
          <div class="form-group"><label class="font-weight-bold">Foto</label><input type="file" name="foto" class="form-control-file border p-2 rounded" accept="image/*"><small class="text-muted">JPG/PNG, kosongkan pakai default_obat.png</small></div>
        </div>
        <div class="col-md-6">
          <div class="row"><div class="col-6"><div class="form-group"><label class="font-weight-bold">Stok</label><input type="number" name="stok" class="form-control" min="0" value="0" required></div></div><div class="col-6"><div class="form-group"><label class="font-weight-bold">Satuan</label><input type="text" name="satuan" class="form-control" placeholder="Tablet, Botol, Pcs" required></div></div></div>
          <div class="form-group"><label class="font-weight-bold">Tanggal Kadaluarsa</label><input type="date" name="tanggalkadaluarsa" class="form-control" required></div>
          <div class="form-group"><label class="font-weight-bold">Tanggal Masuk</label><input type="date" name="tanggalmasuk" class="form-control" value="<?= date('Y-m-d') ?>" required></div>
        </div>
      </div></div>
      <div class="p-3 text-right" style="border-top:1px solid #e0f2f1;background:var(--mint2)"><button type="submit" name="simpan" class="btn-toska"><i class="fas fa-save mr-1"></i> Simpan ke Lemari</button></div>
    </form>
  </div></div></div>
</div>