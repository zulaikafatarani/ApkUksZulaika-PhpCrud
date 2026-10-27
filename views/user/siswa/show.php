<?php
// views/user/siswa/show.php - FINAL MODEL SAMA KAYAK USER
batasi_akses_role(['admin', 'petugas', 'anggota']);
$idsiswa = (int)($_GET['id'] ?? 0);
$query = mysqli_query($koneksi, "SELECT * FROM siswa WHERE idsiswa = $idsiswa");
if (mysqli_num_rows($query) !== 1) {
    header("Location: index.php?halaman=siswa");
    exit();
}
$data = mysqli_fetch_assoc($query);

$base = __DIR__ . '/../../../assets/images/siswa/';
$baseUrl = 'assets/images/siswa/';
$foto = $baseUrl.'default.png';
if(!empty($data['foto']) && file_exists($base.$data['foto'])){
    $foto = $baseUrl.$data['foto'];
}
$jk = strtolower($data['jeniskelamin'] ?? $data['jk'] ?? 'p');
?>
<div class="dash">
  <div class="content-header" style="opacity:1 !important; transform:none !important">
    <div class="container-fluid">
      <div class="row mb-2 align-items-center">
        <div class="col-sm-7">
          <h1 class="m-0 font-weight-bold" style="color:#064e3b">
            <i class="fas fa-file-medical mr-2" style="color:#0f766e"></i> Kartu Rekam Medis Murid
          </h1>
          <small class="text-muted">UKS Digital - <b style="color:#0f766e">Biodata Pasien</b> | <span class="badge-role badge-anggota">SISWA</span> | 0103786196</small>
        </div>
        <div class="col-sm-5 text-right">
          <a href="index.php?halaman=siswa" class="btn-toska"><i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar</a>
        </div>
      </div>
    </div>
  </div>

  <div class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="uk-card p-0 mb-4" style="overflow:hidden">
            <div class="p-3 d-flex justify-content-between align-items-center" style="border-bottom:1px solid #e0f2f1;background:#f0fdfa">
              <h6 class="font-weight-bold mb-0" style="color:#064e3b"><i class="fas fa-address-card mr-2" style="color:#0f766e"></i> Biodata Pasien</h6>
              <span class="badge-mint"><?= htmlspecialchars($data['kelas'] ?? '-') ?></span>
            </div>
            <div class="p-4">
              <div class="text-center mb-4">
                <img src="<?= $foto ?>" width="120" height="120" style="width:120px !important; height:120px !important; object-fit:cover; border-radius:50%; border:3px solid #5eead4; box-shadow:0 0 0 4px #f0fdfa" onerror="this.src='assets/images/siswa/default.png'">
                <h5 class="mt-3 font-weight-bold" style="color:#064e3b"><?= htmlspecialchars($data['namasiswa'] ?? '-') ?></h5>
                <span class="badge-role badge-petugas"><?= htmlspecialchars($data['kelas'] ?? '-') ?></span>
              </div>
              <div class="table-responsive">
                <table class="table table-uks mb-0">
                  <tr><th style="width:32%; background:#f0fdfa">NISN / NIS</th><td class="font-weight-bold"><?= htmlspecialchars($data['nis'] ?? $data['nisn'] ?? '-') ?></td></tr>
                  <tr><th style="background:#f0fdfa">Nama Pasien</th><td class="font-weight-bold" style="color:#064e3b"><?= htmlspecialchars($data['namasiswa'] ?? '-') ?></td></tr>
                  <tr><th style="background:#f0fdfa">Kelas</th><td><?= htmlspecialchars($data['kelas'] ?? '-') ?></td></tr>
                  <tr><th style="background:#f0fdfa">Jenis Kelamin</th><td><?= ($jk=='l'||$jk=='laki-laki')?'Laki-Laki':'Perempuan' ?></td></tr>
                  <tr><th style="background:#f0fdfa">Golongan Darah</th><td><span class="badge-role badge-petugas"><?= htmlspecialchars($data['golongandarah'] ?? '-') ?></span></td></tr>
                  <tr><th style="background:#f0fdfa">No HP Orang Tua</th><td><?= htmlspecialchars($data['nohp'] ?? $data['hp_ortu'] ?? '-') ?></td></tr>
                  <tr><th style="background:#f0fdfa">Alamat</th><td><?= htmlspecialchars($data['alamat'] ?? '-') ?></td></tr>
                  <tr><th style="background:#f0fdfa" class="text-danger"><i class="fas fa-exclamation-triangle mr-1"></i> Riwayat Penyakit</th><td><?= htmlspecialchars($data['riwayatpenyakit'] ?? $data['penyakit_bawaan'] ?? '-') ?></td></tr>
                  <tr><th style="background:#f0fdfa" class="text-danger"><i class="fas fa-exclamation-triangle mr-1"></i> Kerentanan Alergi</th><td class="font-weight-bold text-danger"><?= htmlspecialchars($data['riwayatalergi'] ?? $data['alergi'] ?? '-') ?></td></tr>
                </table>
              </div>
            </div>
            <div class="p-3 text-right" style="border-top:1px solid #e0f2f1;background:#f0fdfa">
              <a href="index.php?halaman=editsiswa&id=<?= $data['idsiswa'] ?>" class="btn-toska"><i class="fas fa-edit mr-1"></i> Edit Data</a>
              <a href="index.php?halaman=siswa" class="btn-pill" style="background:#e2e8f0;color:#475569;padding:8px 20px">Kembali</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>