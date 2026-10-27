<?php
// views/user/siswa/edit.php - FINAL MODEL SAMA KAYAK USER
batasi_akses_role(['admin','petugas','anggota']);
$id = (int)($_GET['id'] ?? 0);
$q = mysqli_query($koneksi, "SELECT * FROM siswa WHERE idsiswa=$id");
if(mysqli_num_rows($q)!=1){ header("Location: index.php?halaman=siswa"); exit(); }
$data = mysqli_fetch_assoc($q);
$nis_val = $data['nis'] ?? $data['nisn'] ?? '';
$jk_val = $data['jeniskelamin'] ?? $data['jk'] ?? 'L';
$hp_val = $data['nohp'] ?? $data['hp_ortu'] ?? '';
$alergi_val = $data['riwayatalergi'] ?? $data['alergi'] ?? '';
$penyakit_val = $data['riwayatpenyakit'] ?? '';
$alamat_val = $data['alamat'] ?? '';
$darah_val = $data['golongandarah'] ?? '';
$fotoLama = 'assets/images/siswa/'.($data['foto'] ?? 'default.png');
if(!file_exists(__DIR__.'/../../../'.$fotoLama)) $fotoLama='assets/images/user/default.png';
?>
<div class="dash">
  <div class="content-header" style="opacity:1 !important; transform:none !important">
    <div class="container-fluid">
      <div class="row mb-2 align-items-center">
        <div class="col-sm-7"><h1 class="m-0 font-weight-bold" style="color:#064e3b"><i class="fas fa-user-edit mr-2" style="color:#0f766e"></i> Ubah Data Murid</h1><small class="text-muted">UKS Digital - <b style="color:#0f766e">Edit Siswa</b> | <span class="badge-role badge-anggota"><?= htmlspecialchars($data['namasiswa'] ?? '-') ?></span></small></div>
        <div class="col-sm-5 text-right"><a href="index.php?halaman=siswa" class="btn-toska"><i class="fas fa-arrow-left mr-1"></i> Kembali</a></div>
      </div>
    </div>
  </div>
  <div class="content"><div class="container-fluid">
    <div class="uk-card p-0 mb-4" style="overflow:hidden">
      <div class="p-3" style="border-bottom:1px solid #e0f2f1;background:#f0fdfa"><h6 class="font-weight-bold mb-0" style="color:#064e3b"><i class="fas fa-edit mr-2" style="color:#0f766e"></i> Form Edit Siswa</h6></div>
      <form action="proses/prosespasien.php?aksi=ubah&jenis=siswa" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="idsiswa" value="<?= $data['idsiswa'] ?>">
        <input type="hidden" name="foto_lama" value="<?= $data['foto'] ?? 'default.png' ?>">
        <div class="p-4"><div class="row">
          <div class="col-md-6">
            <div class="form-group mb-3"><label class="font-weight-bold">NISN / NIS Murid</label><input type="text" name="nis" class="form-control" value="<?= htmlspecialchars($nis_val) ?>" required></div>
            <div class="form-group mb-3"><label class="font-weight-bold">Nama Lengkap Murid</label><input type="text" name="namasiswa" class="form-control" value="<?= htmlspecialchars($data['namasiswa']) ?>" required></div>
            <div class="form-group mb-3"><label class="font-weight-bold">Jenis Kelamin</label><select name="jeniskelamin" class="form-control" required><option value="L" <?= $jk_val=='L'?'selected':'' ?>>Laki-Laki</option><option value="P" <?= $jk_val=='P'?'selected':'' ?>>Perempuan</option></select></div>
            <div class="form-group mb-3"><label class="font-weight-bold">Kelas & Tingkatan</label><input type="text" name="kelas" class="form-control" value="<?= htmlspecialchars($data['kelas'] ?? '') ?>" required></div>
            <div class="form-group mb-3"><label>Foto Lama</label><br><img src="<?= $fotoLama ?>" width="60" height="60" style="width:60px !important; height:60px !important; object-fit:cover; border-radius:50%; border:2px solid #5eead4" onerror="this.src='assets/images/siswa/default.png'"></div>
          </div>
          <div class="col-md-6">
            <div class="form-group mb-3"><label class="font-weight-bold">Golongan Darah</label><select name="golongandarah" class="form-control"><option value="">- Pilih -</option><?php foreach(['A','B','AB','O'] as $g): ?><option value="<?= $g ?>" <?= $darah_val==$g?'selected':'' ?>><?= $g ?></option><?php endforeach; ?></select></div>
            <div class="form-group mb-3"><label class="font-weight-bold">No HP / WA</label><input type="text" name="nohp" class="form-control" value="<?= htmlspecialchars($hp_val) ?>" required></div>
            <div class="form-group mb-3"><label class="font-weight-bold">Alamat</label><textarea name="alamat" class="form-control" rows="2"><?= htmlspecialchars($alamat_val) ?></textarea></div>
            <div class="form-group mb-3"><label class="font-weight-bold">Riwayat Penyakit</label><textarea name="riwayatpenyakit" class="form-control" rows="2"><?= htmlspecialchars($penyakit_val) ?></textarea></div>
            <div class="form-group mb-3"><label class="font-weight-bold">Riwayat Alergi Bawaan</label><textarea name="riwayatalergi" class="form-control" rows="2"><?= htmlspecialchars($alergi_val) ?></textarea></div>
            <div class="form-group mb-3"><label>Ganti Foto (kosongkan jika tidak ganti)</label><input type="file" name="foto" class="form-control-file border p-2 rounded" accept="image/*"></div>
          </div>
        </div></div>
        <div class="p-3 text-right" style="border-top:1px solid #e0f2f1;background:#f0fdfa"><button type="submit" class="btn-toska"><i class="fas fa-save mr-1"></i> Simpan Perubahan</button></div>
      </form>
    </div>
  </div></div>
</div>