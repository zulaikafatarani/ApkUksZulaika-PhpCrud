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
$stokKritis = mysqli_query($koneksi,"SELECT * FROM barang WHERE stok<=5 ORDER BY stok ASC LIMIT 8");
$kadaluarsa = mysqli_query($koneksi,"SELECT * FROM barang WHERE tanggalkadaluarsa < DATE_ADD(CURDATE(), INTERVAL 30 DAY) ORDER BY tanggalkadaluarsa ASC LIMIT 5");
$recent = mysqli_query($koneksi,"SELECT p.*, s.namasiswa, g.namaguru, u.namauser FROM penanganan p LEFT JOIN siswa s ON p.idsiswa=s.idsiswa LEFT JOIN guru g ON p.idguru=g.idguru LEFT JOIN user u ON p.iduser=u.iduser ORDER BY p.idpenanganan DESC LIMIT 7");
?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6"><h1 class="m-0 font-weight-bold text-success"><i class="fas fa-shield-alt mr-2"></i>Dashboard Admin - Full Akses</h1><small class="text-muted">UKS Digital SMKN 1 Karang Baru - <?= $_SESSION['namauser'] ?> | Role: <?= $_SESSION['role'] ?></small></div>
      <div class="col-sm-6 text-right"><span class="badge badge-success p-2"><i class="fas fa-calendar mr-1"></i> <?= date('d F Y H:i') ?></span></div>
    </div>
  </div>
</div>
<div class="content"><div class="container-fluid">

<!-- Banner Master -->
<div class="card bg-gradient-success shadow-sm">
  <div class="card-body">
    <div class="row align-items-center">
      <div class="col-md-8"><h4 class="font-weight-bold">Selamat Datang, <?= htmlspecialchars($_SESSION['namauser']); ?> <span class="badge badge-light">ADMIN - MASTER</span></h4>
      <p class="mb-1">Akses: <b>YA semua (No.1-13 tabel kendali)</b> - Kelola Akun (Admin/Petugas/Anggota), Master Siswa/Guru/Kategori/Obat, Transaksi Penanganan, & Cetak Laporan Harian/Bulanan/Tahunan.</p>
      <small><i class="fas fa-info-circle"></i> Hari ini melayani <b><?= $hariIni ?> pasien</b>, bulan ini <b><?= $bulanIni ?> kasus</b>.</small></div>
      <div class="col-md-4 text-right"><i class="fas fa-user-shield fa-4x opacity-50"></i></div>
    </div>
  </div>
</div>

<!-- 4 Statistik Utama + 4 Statistik Layanan -->
<div class="row">
  <div class="col-lg-3 col-6"><div class="small-box bg-success"><div class="inner"><h3><?= $totSiswa ?></h3><p>Total Siswa (Pasien Didik)</p></div><div class="icon"><i class="fas fa-user-graduate"></i></div><a href="index.php?halaman=siswa" class="small-box-footer">Master Siswa <i class="fas fa-arrow-circle-right"></i></a></div></div>
  <div class="col-lg-3 col-6"><div class="small-box bg-info"><div class="inner"><h3><?= $totObat ?></h3><p>Jenis Obat & Alkes / <?= $totKategori ?> Kat</p></div><div class="icon"><i class="fas fa-pills"></i></div><a href="index.php?halaman=barang" class="small-box-footer">Cek Lemari <i class="fas fa-arrow-circle-right"></i></a></div></div>
  <div class="col-lg-3 col-6"><div class="small-box bg-warning"><div class="inner"><h3><?= $totGuru ?></h3><p>Data Guru (Pasien Pendidik)</p></div><div class="icon"><i class="fas fa-chalkboard-teacher"></i></div><a href="index.php?halaman=guru" class="small-box-footer">Master Guru <i class="fas fa-arrow-circle-right"></i></a></div></div>
  <div class="col-lg-3 col-6"><div class="small-box bg-danger"><div class="inner"><h3><?= $totUser ?></h3><p>User Sistem (Admin/Petugas/Anggota)</p></div><div class="icon"><i class="fas fa-users"></i></div><a href="index.php?halaman=user" class="small-box-footer">Kelola Akun <i class="fas fa-arrow-circle-right"></i></a></div></div>
</div>
<div class="row">
  <div class="col-lg-3 col-6"><div class="info-box"><span class="info-box-icon bg-primary"><i class="fas fa-procedures"></i></span><div class="info-box-content"><span class="info-box-text">Pasien Hari Ini</span><span class="info-box-number"><?= $hariIni ?></span></div></div></div>
  <div class="col-lg-3 col-6"><div class="info-box"><span class="info-box-icon bg-success"><i class="fas fa-heartbeat"></i></span><div class="info-box-content"><span class="info-box-text">Penanganan Bulan Ini</span><span class="info-box-number"><?= $bulanIni ?> Kasus</span></div></div></div>
  <div class="col-lg-3 col-6"><div class="info-box"><span class="info-box-icon bg-warning"><i class="fas fa-boxes"></i></span><div class="info-box-content"><span class="info-box-text">Total Penanganan</span><span class="info-box-number"><?= $totPenanganan ?> Riwayat</span></div></div></div>
  <div class="col-lg-3 col-6"><div class="info-box"><span class="info-box-icon bg-danger"><i class="fas fa-exclamation-triangle"></i></span><div class="info-box-content"><span class="info-box-text">Stok Kritis ≤5</span><span class="info-box-number"><?= mysqli_num_rows($stokKritis) ?> Item</span></div></div></div>
</div>

<div class="row">
  <!-- Menu Cepat Admin Full -->
  <div class="col-md-8">
    <div class="card card-success card-outline shadow-sm">
      <div class="card-header"><h3 class="card-title font-weight-bold"><i class="fas fa-bolt mr-1"></i> Menu Cepat Admin - 13 Use Case (YA Semua)</h3></div>
      <div class="card-body">
        <div class="row text-center">
          <div class="col-3 mb-3"><a href="index.php?halaman=user" class="btn btn-app bg-danger"><i class="fas fa-users-c