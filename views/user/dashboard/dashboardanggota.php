<?php
batasi_akses_role(['anggota']);
function hitungA($koneksi,$tabel){ $q=mysqli_query($koneksi,"SELECT COUNT(*) as c FROM $tabel"); return mysqli_fetch_assoc($q)['c']??0; }
$totalBarang = hitungA($koneksi,'barang');
$totalSiswa  = hitungA($koneksi,'siswa');
$totalTangani = hitungA($koneksi,'penanganan');
$myTangani = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT COUNT(*) as c FROM penanganan WHERE iduser=".$_SESSION['iduser']))['c'];
?>
<section class="content-header"><div class="container-fluid"><div class="row mb-2"><div class="col-sm-6"><h1>Dashboard Anggota PMR</h1></div><div class="col-sm-6 text-right"><small class="text-muted"><?= date('d F Y') ?> - PMR Wira</small></div></div></div></section>
<section class="content"><div class="container-fluid">
<div class="card bg-gradient-info"><div class="card-body">
<h4>Halo, <?= $_SESSION['namauser']; ?> <span class="badge badge-light">ANGGOTA PMR</span></h4>
<p class="mb-0">Akses Anggota: <b>hanya</b> kelola data siswa, kelola barang, pencatatan penanganan (tabel kendali No.7,10,11 = YA). <b>TIDAK boleh</b> kelola guru, kategori, cetak laporan, kelola user.</p>
</div></div>
<div class="row">
<div class="col-lg-4 col-6"><div class="small-box bg-success"><div class="inner"><h3><?= $totalSiswa ?></h3><p>Data Siswa</p></div><div class="icon"><i class="fas fa-user-graduate"></i></div><a href="index.php?halaman=siswa" class="small-box-footer">Kelola <i class="fas fa-arrow-circle-right"></i></a></div></div>
<div class="col-lg-4 col-6"><div class="small-box bg-primary"><div class="inner"><h3><?= $totalBarang ?></h3><p>Obat & Alkes</p></div><div class="icon"><i class="fas fa-pills"></i></div><a href="index.php?halaman=barang" class="small-box-footer">Lemari <i class="fas fa-arrow-circle-right"></i></a></div></div>
<div class="col-lg-4 col-6"><div class="small-box bg-warning"><div class="inner"><h3><?= $myTangani ?></h3><p>Penanganan oleh Saya</p></div><div class="icon"><i class="fas fa-hand-holding-medical"></i></div><a href="index.php?halaman=penanganan" class="small-box-footer">Input <i class="fas fa-arrow-circle-right"></i></a></div></div>
</div>
<div class="row"><div class="col-md-8">
<div class="card card-info"><div class="card-header"><h3 class="card-title">Menu Anggota PMR (Yang YA saja)</h3></div><div class="card-body"><div class="row text-center">
<div class="col-4 mb-3"><a href="index.php?halaman=siswa" class="btn btn-app"><i class="fas fa-user-graduate"></i> Kelola Siswa</a></div>
<div class="col-4 mb-3"><a href="index.php?halaman=barang" class="btn btn-app"><i class="fas fa-pills"></i> Kelola Obat</a></div>
<div class="col-4 mb-3"><a href="index.php?halaman=penanganan" class="btn btn-app"><i class="fas fa-notes-medical"></i> Catat Penanganan</a></div>
</div><div class="alert alert-warning small mb-0"><i class="fas fa-lock mr-1"></i> Menu Guru, Kategori, Laporan & Kelola User terkunci untuk Anggota - sesuai tabel kendali kamu.</div></div></div>
</div><div class="col-md-4"><div class="card card-outline card-info"><div class="card-header"><h3 class="card-title">Akun PMR</h3></div><div class="card-body text-center"><img src="assets/images/user/<?= $_SESSION['foto']??'default.png' ?>" class="img-circle mb-2" width="80" onerror="this.src='assets/images/user/default.png'"><h5><?= $_SESSION['namauser'] ?></h5><span class="badge badge-info">ANGGOTA</span><hr><small class="text-muted">Kamu telah menangani <?= $myTangani ?> pasien<br>Total UKS: <?= $totalTangani ?> penanganan</small><a href="index.php?halaman=logout" class="btn btn-danger btn-block btn-sm mt-3">Logout</a></div></div></div></div>
</div></section>