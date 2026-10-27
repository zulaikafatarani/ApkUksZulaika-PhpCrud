<?php
// views/user/guru/edit.php - FINAL GABUNG UKS.CSS
batasi_akses_role(['admin','petugas']);
$id=(int)($_GET['id']??0);
$d=mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT * FROM guru WHERE idguru=$id"));
if(!$d){ header("Location: index.php?halaman=guru"); exit(); }
$fotoLama = 'assets/images/guru/'.($d['foto']??'default.png');
?>
<div class="dash">
  <div class="content-header"><div class="container-fluid"><div class="row mb-2 align-items-center">
    <div class="col-sm-7"><h1 class="m-0 font-weight-bold" style="color:var(--dark)"><i class="fas fa-user-edit mr-2" style="color:var(--teal)"></i> Edit Guru - <?= htmlspecialchars($d['namaguru']) ?></h1><small class="text-muted">UKS Digital - <b style="color:var(--teal)">Ubah Data Guru</b></small></div>
    <div class="col-sm-5 text-right"><a href="index.php?halaman=guru" class="btn-toska"><i class="fas fa-arrow-left mr-1"></i> Kembali</a></div>
  </div></div></div>
  <div class="content"><div class="container-fluid"><div class="uk-card-guru">
    <div class="header-guru"><h6 class="font-weight-bold mb-0" style="color:var(--dark)"><i class="fas fa-edit mr-2" style="color:var(--teal)"></i> Form Edit Guru</h6></div>
    <form action="proses/prosespasien.php?aksi=ubah&jenis=guru" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="idguru" value="<?= $d['idguru'] ?>"><input type="hidden" name="foto_lama" value="<?= $d['foto'] ?>">
      <div class="p-4"><div class="row">
        <div class="col-md-6">
          <div class="form-group"><label class="font-weight-bold">NIP</label><input type="text" name="nip" class="form-control" value="<?= htmlspecialchars($d['nip']) ?>" required></div>
          <div class="form-group"><label class="font-weight-bold">Nama Guru</label><input type="text" name="namaguru" class="form-control" value="<?= htmlspecialchars($d['namaguru']) ?>" required></div>
          <div class="form-group"><label class="font-weight-bold">Jenis Kelamin</label><select name="jeniskelamin" class="form-control"><option value="L" <?= $d['jeniskelamin']=='L'?'selected':'' ?>>Laki-laki</option><option value="P" <?= $d['jeniskelamin']=='P'?'selected':'' ?>>Perempuan</option></select></div>
          <div class="form-group"><label>Foto Lama</label><br><img src="<?= $fotoLama ?>" width="60" height="60" class="foto-guru" onerror="this.src='assets/images/user/default.png'"></div>
        </div>
        <div class="col-md-6">
          <div class="form-group"><label class="font-weight-bold">No HP</label><input type="text" name="nohp" class="form-control" value="<?= htmlspecialchars($d['nohp']) ?>"></div>
          <div class="form-group"><label class="font-weight-bold">Alamat</label><textarea name="alamat" class="form-control" rows="2"><?= htmlspecialchars($d['alamat']) ?></textarea></div>
          <div class="form-group"><label class="font-weight-bold">Riwayat Penyakit</label><textarea name="riwayatpenyakit" class="form-control" rows="2"><?= htmlspecialchars($d['riwayatpenyakit']) ?></textarea></div>
          <div class="form-group"><label>Ganti Foto</label><input type="file" name="foto" class="form-control-file border p-2 rounded" accept="image/*"><small class="text-muted">Kosongkan jika tidak ganti</small></div>
        </div>
      </div></div>
      <div class="p-3 text-right" style="border-top:1px solid #e0f2f1;background:var(--mint2)"><a href="index.php?halaman=guru" class="btn btn-secondary" style="border-radius:30px; padding:8px 20px">Batal</a> <button type="submit" class="btn-toska">Update</button></div>
    </form>
  </div></div></div>
</div>