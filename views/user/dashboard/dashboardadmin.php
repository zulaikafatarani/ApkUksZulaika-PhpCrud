<?php
batasi_akses_role(['admin']);
function hitung($koneksi,$tabel,$where=""){ $q=mysqli_query($koneksi,"SELECT COUNT(*) as c FROM $tabel $where"); $d=mysqli_fetch_assoc($q); return $d['c']??0; }
$totSiswa = hitung($koneksi,'siswa');
$totGuru = hitung($koneksi,'guru');
$totObat = hitung($koneksi,'barang');
$totKategori = hitung($koneksi,'kategori');
$totUser = hitung($koneksi,'user');
$totPenanganan = hitung($koneksi,'penanganan');
$hariIni = hitung($koneksi,'penanganan',"WHERE DATE(tanggalpenanganan)=CURDATE()");
$bulanIni = hitung($koneksi,'penanganan',"WHERE MONTH(tanggalpenanganan)=MONTH(CURDATE()) AND YEAR(tanggalpenanganan)=YEAR(CURDATE())");
$stokKritis = mysqli_query($koneksi,"SELECT * FROM barang WHERE stok<=5 ORDER BY stok ASC LIMIT 6");
$kadaluarsa = mysqli_query($koneksi,"SELECT * FROM barang WHERE tanggalkadaluarsa < DATE_ADD(CURDATE(), INTERVAL 30 DAY) ORDER BY tanggalkadaluarsa ASC LIMIT 5");
$recent = mysqli_query($koneksi,"SELECT p.*, s.namasiswa, g.namaguru FROM penanganan p LEFT JOIN siswa s ON p.idsiswa=s.idsiswa LEFT JOIN guru g ON p.idguru=g.idguru ORDER BY p.idpenanganan DESC LIMIT 5");
?>
<div class="content-header">
  <div class="container-fluid"><div class="row mb-2"><div class="col-sm-7"><h1 class="m-0 font-weight-bold text-success"><i class="fas fa-shield-alt mr-2"></i>Dashboard Admin - Full Akses</h1><small class="text-muted">UKS Digital SMKN 1 Karang Baru - <?= $_SESSION['namauser'] ?> | Role: <?= $_SESSION['role'] ?> | 13 Use Case = YA SEMUA</small></div><div class="col-sm-5 text-right"><span class="badge badge-success p-2"><i class="fas fa-calendar mr-1"></i> <?= date('d F Y H:i') ?></span></div></div></div>
</div>
<div class="content"><div class="container-fluid">

<div class="card bg-gradient-success shadow-sm">
  <div class="card-body"><div class="row align-items-center"><div class="col-md-9"><h4 class="font-weight-bold">Selamat Datang, <?= htmlspecialchars($_SESSION['namauser']); ?> <span class="badge badge-light">ADMIN - MASTER</span></h4><p class="mb-1">Akses: <b>YA semua (No.1-13 tabel kendali)</b> - Kelola Akun (Admin/Petugas/Anggota), Master Siswa/Guru/Kategori/Obat, Transaksi Penanganan, & Cetak Laporan Harian/Bulanan/Tahunan.</p><small><i class="fas fa-info-circle"></i> Hari ini <b><?= $hariIni ?> pasien</b>, bulan ini <b><?= $bulanIni ?> kasus</b>, total <b><?= $totPenanganan ?> riwayat</b>.</small></div><div class="col-md-3 text-right"><i class="fas fa-user-shield fa-4x opacity-50"></i></div></div></div>
</div>

<div class="row">
  <div class="col-lg-3 col-6"><div class="small-box bg-success"><div class="inner"><h3><?= $totSiswa ?></h3><p>Total Siswa (Pasien Didik)</p></div><div class="icon"><i class="fas fa-user-graduate"></i></div><a href="index.php?halaman=siswa" class="small-box-footer">Master Siswa <i class="fas fa-arrow-circle-right"></i></a></div></div>
  <div class="col-lg-3 col-6"><div class="small-box bg-info"><div class="inner"><h3><?= $totObat ?></h3><p>Jenis Obat & Alkes / <?= $totKategori ?> Kat</p></div><div class="icon"><i class="fas fa-pills"></i></div><a href="index.php?halaman=barang" class="small-box-footer">Cek Lemari <i class="fas fa-arrow-circle-right"></i></a></div></div>
  <div class="col-lg-3 col-6"><div class="small-box bg-warning"><div class="inner"><h3><?= $totGuru ?></h3><p>Data Guru (Pasien Pendidik)</p></div><div class="icon"><i class="fas fa-chalkboard-teacher"></i></div><a href="index.php?halaman=guru" class="small-box-footer">Master Guru <i class="fas fa-arrow-circle-right"></i></a></div></div>
  <div class="col-lg-3 col-6"><div class="small-box bg-danger"><div class="inner"><h3><?= $totUser ?></h3><p>User Sistem (Admin/Petugas/Anggota)</p></div><div class="icon"><i class="fas fa-users"></i></div><a href="index.php?halaman=user" class="small-box-footer">Kelola Akun <i class="fas fa-arrow-circle-right"></i></a></div></div>
</div>

<div class="row">
  <div class="col-md-8">
    <div class="card card-success card-outline shadow-sm">
      <div class="card-header"><h3 class="card-title font-weight-bold"><i class="fas fa-bolt mr-1"></i> Menu Cepat Admin - 13 Use Case (YA Semua) - Bedanya sama Petugas ada Kelola Akun</h3></div>
      <div class="card-body"><div class="row text-center">
        <div class="col-3 mb-3"><a href="index.php?halaman=user" class="btn btn-app bg-danger"><i class="fas fa-users-cog"></i> Kelola Akun</a></div>
        <div class="col-3 mb-3"><a href="index.php?halaman=siswa" class="btn btn-app"><i class="fas fa-user-graduate"></i> Siswa</a></div>
        <div class="col-3 mb-3"><a href="index.php?halaman=guru" class="btn btn-app"><i class="fas fa-chalkboard-teacher"></i> Guru</a></div>
        <div class="col-3 mb-3"><a href="index.php?halaman=kategori" class="btn btn-app"><i class="fas fa-tags"></i> Kategori</a></div>
        <div class="col-3 mb-3"><a href="index.php?halaman=barang" class="btn btn-app"><i class="fas fa-pills"></i> Obat</a></div>
        <div class="col-3 mb-3"><a href="index.php?halaman=penanganan" class="btn btn-app bg-success"><i class="fas fa-notes-medical"></i> Penanganan</a></div>
        <div class="col-3 mb-3"><a href="index.php?halaman=laporanharian" class="btn btn-app"><i class="fas fa-calendar-day"></i> Lap Harian</a></div>
        <div class="col-3 mb-3"><a href="index.php?halaman=laporanbulanan" class="btn btn-app"><i class="fas fa-calendar-alt"></i> Lap Bulanan</a></div>
        <div class="col-3 mb-3"><a href="index.php?halaman=laporantahunan" class="btn btn-app"><i class="fas fa-chart-bar"></i> Lap Tahunan</a></div>
        <div class="col-3 mb-3"><a href="index.php?halaman=barang" class="btn btn-app"><i class="fas fa-exclamation-triangle text-danger"></i> Stok Kritis</a></div>
        <div class="col-3 mb-3"><a href="index.php?halaman=home" class="btn btn-app"><i class="fas fa-home"></i> Homepage</a></div>
        <div class="col-3 mb-3"><a href="index.php?halaman=logout" class="btn btn-app bg-danger"><i class="fas fa-power-off"></i> Keluar</a></div>
      </div></div>
    </div>

    <div class="card card-outline card-primary"><div class="card-header"><h3 class="card-title"><i class="fas fa-history"></i> 5 Penanganan Terbaru</h3></div><div class="card-body p-0 table-responsive"><table class="table table-sm mb-0"><thead><tr><th>Tgl</th><th>Pasien</th><th>Keluhan</th></tr></thead><tbody><?php while($r=mysqli_fetch_assoc($recent)): ?><tr><td><small><?= date('d/m',strtotime($r['tanggalpenanganan'])) ?></small></td><td><b><?= htmlspecialchars($r['namasiswa']??$r['namaguru']??'-') ?></b></td><td><small><?= htmlspecialchars(substr($r['keluhan']??'-',0,40)) ?></small></td></tr><?php endwhile; ?></tbody></table></div></div>
  </div>

  <div class="col-md-4">
    <div class="card card-success card-outline text-center"><div class="card-header"><h3 class="card-title">Info Akun ADMIN</h3></div><div class="card-body"><img src="assets/images/user/<?= $_SESSION['foto']??'default.png' ?>" class="img-circle elevation-2 mb-2" width="80" onerror="this.src='assets/images/user/default.png'"><h5 class="font-weight-bold"><?= htmlspecialchars($_SESSION['namauser']) ?></h5><span class="badge badge-danger">ADMIN - FULL AKSES</span><hr><p class="small mb-1">Total Penanganan: <b><?= $totPenanganan ?> kasus</b></p><p class="small text-muted">User Sistem: <?= $totUser ?> akun | Hari ini: <?= $hariIni ?></p><a href="index.php?halaman=logout" class="btn btn-danger btn-block btn-sm mt-3"><i class="fas fa-power-off mr-1"></i> Keluar Aplikasi</a></div></div>
    <div class="card card-danger card-outline"><div class="card-header"><h3 class="card-title text-danger"><i class="fas fa-exclamation-triangle"></i> Stok Kritis ≤5</h3></div><div class="card-body p-0"><table class="table table-sm mb-0"><tr><th>Obat</th><th>Sisa</th></tr><?php while($b=mysqli_fetch_assoc($stokKritis)): ?><tr><td><small><?= htmlspecialchars($b['namabarang']) ?></small></td><td class="text-danger font-weight-bold"><?= $b['stok'] ?></td></tr><?php endwhile; ?></table></div></div>
    <div class="card card-warning card-outline"><div class="card-header"><h3 class="card-title text-warning"><i class="fas fa-clock"></i> Akan Kadaluarsa <30 Hari</h3></div><div class="card-body p-0"><table class="table table-sm mb-0"><tr><th>Obat</th><th>Exp</th></tr><?php while($k=mysqli_fetch_assoc($kadaluarsa)): ?><tr><td><small><?= htmlspecialchars($k['namabarang']) ?></small></td><td><small><?= $k['tanggalkadaluarsa'] ?></small></td></tr><?php endwhile; ?></table></div></div>
  </div>
</div>

</div></div>