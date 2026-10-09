<?php
batasi_akses_role(['admin','petugas']);
$id = (int)($_GET['id']??0);
$q = mysqli_query($koneksi, "SELECT * FROM barang WHERE idbarang=$id");
$d = mysqli_fetch_assoc($q);
if(!$d){ echo '<div class="alert alert-danger m-3">Data obat tidak ditemukan</div>'; return; }

$katQ = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY namakategori ASC");
$fotoPath = 'assets/images/barang/'.($d['foto']??'default_obat.png');
if(!file_exists($fotoPath) || empty($d['foto'])) $fotoPath = 'assets/images/barang/default_obat.png';
?>
<div class="content-header"><div class="container-fluid"><div class="d-flex justify-content-between"><h3 class="font-weight-bold text-success"><i class="fas fa-edit mr-2"></i>Ubah Obat</h3><a href="index.php?halaman=barang" class="btn btn-secondary btn-sm rounded-pill">Kembali</a></div></div></div>

<div class="content"><div class="container-fluid">
<div class="card card-success card-outline shadow-sm">
<div class="card-body">
<form action="proses/prosesbarang.php?aksi=ubah" method="POST" enctype="multipart/form-data">
<input type="hidden" name="idbarang" value="<?= $d['idbarang'] ?>">
<input type="hidden" name="foto_lama" value="<?= htmlspecialchars($d['foto']??'default_obat.png') ?>">

<div class="row">
<div class="col-md-4"><div class="form-group"><label>Nama</label><input type="text" name="namabarang" class="form-control" value="<?= htmlspecialchars($d['namabarang']) ?>" required></div></div>
<div class="col-md-2"><div class="form-group"><label>Stok</label><input type="number" name="stok" class="form-control" value="<?= $d['stok'] ?>" required></div></div>
<div class="col-md-2"><div class="form-group"><label>Satuan</label><input type="text" name="satuan" class="form-control" value="<?= htmlspecialchars($d['satuan']) ?>" placeholder="Tablet, Botol, Roll"></div></div>
<div class="col-md-4"><div class="form-group"><label>Kategori</label><select name="idkategori" class="form-control" required><option value="">-- Pilih Kategori --</option><?php while($k=mysqli_fetch_assoc($katQ)){ ?><option value="<?= $k['idkategori'] ?>" <?= $k['idkategori']==$d['idkategori']?'selected':'' ?>><?= htmlspecialchars($k['namakategori']) ?></option><?php } ?></select></div></div>

<div class="col-md-4"><div class="form-group"><label>Kadaluarsa</label><input type="date" name="tanggalkadaluarsa" class="form-control" value="<?= $d['tanggalkadaluarsa'] ?>" required></div></div>
<div class="col-md-4"><div class="form-group"><label>Tanggal Masuk</label><input type="date" name="tanggalmasuk" class="form-control" value="<?= $d['tanggalmasuk'] ?>"></div></div>

<div class="col-md-4"><div class="form-group"><label>Foto Lama</label><br>
<img src="<?= $fotoPath ?>" style="max-height:90px;border-radius:8px;" class="img-thumbnail" onerror="this.src='assets/images/barang/default_obat.png'">
</div></div>

<div class="col-md-4"><div class="form-group"><label>Ganti Foto (opsional)</label><input type="file" name="foto" class="form-control" accept="image/*"></div></div>
</div>

<div class="text-right"><button type="submit" class="btn btn-success px-4"><i class="fas fa-save mr-1"></i> Simpan Perubahan</button></div>

</form>
</div>
</div>
</div></div>