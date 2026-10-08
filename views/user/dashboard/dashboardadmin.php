<?php
// 1. Pastikan hanya Admin yang bisa membuka halaman ini
batasi_akses_role(['admin']);

// 2. Query hitung data langsung di tempat menggunakan koneksi database yang sudah ada
$hitungSiswa = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM siswa");
$dataSiswa   = mysqli_fetch_assoc($hitungSiswa);

$hitungObat  = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM barang");
$dataObat    = mysqli_fetch_assoc($hitungObat);
?>

<!-- 3. Tampilan Kartu Statistik Kotak Hijau AdminLTE -->
<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0 font-weight-bold text-success">Dashboard Admin</h1>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            
            <!-- Kotak Statistik 1: Total Siswa -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success shadow-sm">
                    <div class="inner">
                        <h3><?= $dataSiswa['total']; ?></h3>
                        <p>Total Master Data Siswa</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <a href="index.php?halaman=siswa" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- Kotak Statistik 2: Total Stok Obat -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info shadow-sm">
                    <div class="inner">
                        <h3><?= $dataObat['total']; ?></h3>
                        <p>Jenis Obat & Alkes</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-pills"></i>
                    </div>
                    <a href="index.php?halaman=barang" class="small-box-footer">Cek Stok Lemari <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

        </div>
    </div>
</div>
