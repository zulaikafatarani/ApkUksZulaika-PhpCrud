<?php
batasi_akses_role(['petugas']);
function hitung($koneksi,$tabel,$where=""){ $q=mysqli_query($koneksi,"SELECT COUNT(*) as c FROM $tabel $where"); return mysqli_fetch_assoc($q)['c']??0; }
$totalBarang = hitung($koneksi,'barang');
$totalSiswa = hitung($koneksi,'siswa');
$totalGuru = hitung($koneksi,'guru');
$totalPenanganan = hitung($koneksi,'penanganan');
$hariIni = hitung($koneksi,'penanganan',"WHERE DATE(tanggalpenanganan)=CURDATE()");
$bulanIni = hitung($koneksi,'penanganan',"WHERE MONTH(tanggalpenanganan)=MONTH(CURDATE())");
$stokKritis = mysqli_query($koneksi,"SELECT * FROM barang WHERE stok<=5 ORDER BY stok ASC LIMIT 6");
$recent = mysqli_query($koneksi,"SELECT p.*, s.namasiswa, g.namaguru FROM penanganan p LEFT JOIN siswa s ON p.idsiswa=s.idsiswa LEFT JOIN guru g ON p.idguru=g.idguru ORDER BY p.idpenanganan DESC LIMIT 5");
?>
<div class="content-header"><div class="container-fluid"><div class="row mb-2"><div class="col-sm-6"><h1 class="m-0 font-weight-bold text-success">Dashboard Petugas UKS</h1></div><div class="col-sm-6 text-right"><small class="text-muted"><i class="fas fa-calendar"></i> <?= date('d F Y') ?> - <?= htmlspecialchars($_SESSION['namauser']) ?></small></div></div></div></div>
<div class="content"><div class="container-fluid">

<div class="card bg-gradient-success shadow-sm">
  <div class="card-body">
    <h4 class="font-weight-bold">Selamat Datang, <?= htmlspecialchars($_SESSION['namauser']); ?> <span class="badge badge-light">PETUGAS</span></h4>
    <p class="mb-0">Tugas: Kelola pasien siswa & guru, kelola stok obat & kategori, catat penanganan, cetak laporan harian/bulanan/tahunan. <b class="text-warning">Tidak boleh kelola data user (Sesuai tabel kendali No.6)</b></p>
  </div>
</div>

<div class="row">
  <div class="col-lg-3 col-6"><div class="small-box bg-primary"><div class="inner"><h3><?= $totalBarang ?></h3><p>Jenis Obat & Alkes</p></div><div class="icon"><i class="fas fa-pills"></i></div><a href="index.php?halaman=barang" class="small-box-footer">Cek Lemari <i class="fas fa-arrow-circle-right"></i></a></div></div>
  <div class="col-lg-3 col-6"><div class="small-box bg-success"><div class="inner"><h3><?= $totalSiswa ?></h3><p>Data Siswa</p></div><div class="icon"><i class="fas fa-user-graduate"></i></div><a href="index.php?halaman=siswa" class="small-box-footer">Kelola Siswa <i class="fas fa-arrow-circle-right"></i></a></div></div>
  <div class="col-lg-3 col-6"><div class="small-box bg-warning"><div class="inner"><h3><?= $totalGuru ?></h3><p>Data Guru</p></div><div class="icon"><i class="fas fa-chalkboard-teacher"></i></div><a href="index.php?halaman=guru" class="small-box-footer">Kelola Guru <i class="fas fa-arrow-circle-right"></i></a></div></div>
  <div class="col-lg-3 col-6"><div class="small-box bg-danger"><div class="inner"><h3><?= $hariIni ?></h3><p>Pasien Hari Ini / <?= $bulanIni ?> Bulan Ini</p></div><div class="icon"><i class="fas fa-procedures"></i></div><a href="index.php?halaman=penanganan" class="small-box-footer">Input Penanganan <i class="fas fa-arrow-circle-right"></i></a></div></div>
</div>

<div class="row">
  <div class="col-md-8">
    <div class="card card-success card-outline"><div class="card-header"><h3 class="card-title font-weight-bold">Menu Cepat Petugas (Use Case PETUGAS = YA)</h3></div>
      <div class="card-body"><div class="row text-center">
        <div class="col-3 mb-3"><a href="index.php?halaman=barang" class="btn btn-app"><i class="fas fa-box"></i> Obat</a></div>
        <div class="col-3 mb-3"><a href="index.php?halaman=siswa" class="btn btn-app"><i class="fas fa-user-graduate"></i> Siswa</a></div>
        <div class="col-3 mb-3"><a href="index.php?halaman=guru" class="btn btn-app"><i class="fas fa-chalkboard-teacher"></i> Guru</a></div>
        <div class="col-3 mb-3"><a href="index.php?halaman=kategori" class="btn btn-app"><i class="fas fa-tags"></i> Kategori</a></div>
        <div class="col-3 mb-3"><a href="index.php?halaman=penanganan" class="btn btn-app bg-success"><i class="fas fa-notes-medical"></i> Penanganan</a></div>
        <div class="col-3 mb-3"><a href="index.php?halaman=laporanharian" class="btn btn-app"><i class="fas fa-calendar-day"></i> Lap Harian</a></div>
        <div class="col-3 mb-3"><a href="index.php?halaman=laporanbulanan" class="btn btn-app"><i class="fas fa-calendar-alt"></i> Lap Bulanan</a></div>
        <div class="col-3 mb-3"><a href="index.php?halaman=laporantahunan" class="btn btn-app"><i class="fas fa-chart-bar"></i> Lap Tahunan</a></div>
      </div></div>
    </div>
    <div class="card card-outline card-primary"><div class="card-header"><h3 class="card-title"><i class="fas fa-history"></i> 5 Penanganan Terbaru</h3></div>
      <div class="card-body p-0 table-responsive"><table class="table table-sm mb-0"><thead><tr><th>Tgl</th><th>Pasien</th><th>Keluhan</th></tr></thead><tbody><?php while($r=mysqli_fetch_assoc($recent)): ?><tr><td><small><?= date('d/m',strtotime($r['tanggalpenanganan'])) ?></small></td><td><b><?= htmlspecialchars($r['namasiswa']??$r['namaguru']??'-') ?></b></td><td><small><?= htmlspecialchars(substr($r['keluhan']??'-',0,35)) ?></small></td></tr><?php endwhile; ?></tbody></table></div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card card-success card-outline text-center"><div class="card-header"><h3 class="card-title">Info Akun</h3></div><div class="card-body"><img src="assets/images/user/<?= $_SESSION['foto']??'default.png' ?>" class="img-circle elevation-2 mb-2" width="80" onerror="this.src='assets/images/user/default.png'"><h5 class="font-weight-bold"><?= htmlspecialchars($_SESSION['namauser']) ?></h5><span class="badge badge-success">PETUGAS UKS</span><hr><p class="small mb-1">Total Penanganan: <b><?= $totalPenanganan ?> kasus</b></p><p class="small text-muted">Bulan ini: <?= $bulanIni ?> kasus</p><a href="proses/proseslogout.php" class="btn btn-danger btn-block btn-sm mt-3" onclick="return confirm('Yakin keluar?')"><i class="fas fa-power-off mr-1"></i> Keluar Aplikasi</a></div></div>
    <div class="card card-danger card-outline"><div class="card-header"><h3 class="card-title text-danger"><i class="fas fa-exclamation-triangle"></i> Stok Kritis ≤5</h3></div><div class="card-body p-0"><table class="table table-sm mb-0"><tr><th>Obat</th><th>Sisa</th><th>Exp</th></tr><?php while($b=mysqli_fetch_assoc($stokKritis)): ?><tr><td><small><?= htmlspecialchars($b['namabarang']) ?></small></td><td class="text-danger font-weight-bold"><?= $b['stok'] ?></td><td><small><?= $b['tanggalkadaluarsa'] ?></small></td></tr><?php endwhile; ?></table></div></div>
  </div>
</div>
</div></div>