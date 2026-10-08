<?php
// Pastikan $koneksi ada dari proses/koneksi.php yang di-include di index.php
if (!isset($koneksi)) {
    include __DIR__ . '/../../proses/koneksi.php';
}

/*
|[STRIPPED 74 bytes]
| ARSITEKTUR DATA HOMEPAGE UKS DIGITAL - REVISI SESUAI DATABASE
|[STRIPPED 74 bytes]
*/

// 1. Statistik realtime - pakai COUNT biar ringan
$q = mysqli_query($koneksi, "SELECT COUNT(*) as jml FROM barang");
$totalObat = mysqli_fetch_assoc($q)['jml'];

$q = mysqli_query($koneksi, "SELECT COUNT(*) as jml FROM siswa");
$totalSiswa = mysqli_fetch_assoc($q)['jml'];

$q = mysqli_query($koneksi, "SELECT COUNT(*) as jml FROM guru");
$totalGuru = mysqli_fetch_assoc($q)['jml'];

$q = mysqli_query($koneksi, "SELECT COUNT(*) as jml FROM kategori");
$totalKategori = mysqli_fetch_assoc($q)['jml'];

$q = mysqli_query($koneksi, "SELECT COUNT(*) as jml FROM penanganan WHERE tanggalpenanganan = CURDATE()");
$totalHariIni = mysqli_fetch_assoc($q)['jml'];

// 2. Kategori untuk etalase (max 4)
$queryKategori = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY idkategori DESC LIMIT 4");

// 3. Obat terbaru - sesuai field asli kamu (tanpa foto)
$queryObatBaru = mysqli_query($koneksi, "
    SELECT barang.*, kategori.namakategori 
    FROM barang 
    LEFT JOIN kategori ON barang.idkategori = kategori.idkategori 
    ORDER BY barang.tanggalmasuk DESC, barang.idbarang DESC 
    LIMIT 8
");

// 4. GRAFIK TREN PENYAKIT 30 HARI TERAKHIR - ini yang diminta di tree
$queryTren = mysqli_query($koneksi, "
    SELECT keluhan, COUNT(*) as total 
    FROM penanganan 
    WHERE tanggalpenanganan >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)
    GROUP BY keluhan 
    ORDER BY total DESC LIMIT 5
");
$labelTren = [];
$dataTren = [];
while($t = mysqli_fetch_assoc($queryTren)){
    $labelTren[] = $t['keluhan'];
    $dataTren[] = $t['total'];
}

// 5. Obat kritis (hampir kadaluarsa < 30 hari atau stok < 5)
$queryKritis = mysqli_query($koneksi, "
    SELECT * FROM barang 
    WHERE stok <= 5 OR tanggalkadaluarsa <= DATE_ADD(CURDATE(), INTERVAL 30 DAY)
    LIMIT 3
");
?>

<!-- HERO SECTION -->
<section class="py-5 text-center text-white" style="background: linear-gradient(135deg,#16a34a,#15803d); min-height: 50vh; display:flex; align-items:center;">
    <div class="container">
        <h1 class="display-4 font-weight-bold mb-3">🚑 UKS DIGITAL SMKN 1 KARANG BARU</h1>
        <p class="lead mb-4">Sistem Layanan Medis Instan & Pelacakan Rekam Medis Mandiri<br>Siswa & Guru Berbasis Digital</p>
        <div class="d-flex justify-content-center gap-2 flex-wrap">
            <a href="index.php?halaman=cekriwayat" class="btn btn-light text-success font-weight-bold btn-lg shadow rounded-pill px-4 mr-2">
                <i class="fas fa-search mr-2"></i> Cek Riwayat Medis (NIS/NIP + No HP)
            </a>
            <a href="index.php?halaman=daftarobat" class="btn btn-outline-light font-weight-bold btn-lg rounded-pill px-4">
                Lihat Lemari Obat
            </a>
        </div>
    </div>
</section>

<!-- STATISTIK REALTIME -->
<section class="content py-4 bg-light border-bottom">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-6 mb-3">
                <div class="small-box bg-success shadow-sm">
                    <div class="inner"><h3><?= $totalObat; ?></h3><p>Jenis Obat & Alkes</p></div>
                    <div class="icon"><i class="fas fa-pills"></i></div>
                    <a href="index.php?halaman=daftarobat" class="small-box-footer">Katalog <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6 mb-3">
                <div class="small-box bg-info shadow-sm">
                    <div class="inner"><h3><?= $totalSiswa; ?></h3><p>Siswa Terdata</p></div>
                    <div class="icon"><i class="fas fa-user-graduate"></i></div>
                    <a href="index.php?halaman=cekriwayat" class="small-box-footer">Cek Data <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6 mb-3">
                <div class="small-box bg-warning shadow-sm">
                    <div class="inner text-dark"><h3><?= $totalKategori; ?></h3><p>Kategori Obat</p></div>
                    <div class="icon"><i class="fas fa-tags"></i></div>
                    <a href="index.php?halaman=daftarkategori" class="small-box-footer text-dark">Filter <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
<div class="col-lg-3 col-6 mb-3">
    <div class="small-box bg-danger shadow-sm">
        <div class="inner"><h3><?= $totalHariIni; ?></h3><p>Pasien Hari Ini</p></div>
        <div class="icon"><i class="fas fa-procedures"></i></div>
        <!-- FIX: Jangan ke tentang, tapi ke penanganan atau login -->
        <?php if(isset($_SESSION['iduser'])): ?>
            <a href="index.php?halaman=penanganan" class="small-box-footer">Lihat Penanganan <i class="fas fa-arrow-circle-right"></i></a>
        <?php else: ?>
            <a href="index.php?halaman=loginuser" class="small-box-footer">Login Petugas Untuk Lihat <i class="fas fa-arrow-circle-right"></i></a>
        <?php endif; ?>
    </div>
</div>        </div>
    </div>
</section>

<!-- GRAFIK TREN PENYAKIT + INFO FASILITAS -->
<section class="content py-5 bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-7 mb-4">
                <h4 class="font-weight-bold"><i class="fas fa-chart-line text-success mr-2"></i> Tren Keluhan Terbanyak (30 Hari)</h4>
                <p class="text-muted small">Data diambil langsung dari tabel `penanganan.keluhan`</p>
                <canvas id="trenChart" style="max-height:300px;"></canvas>
                <?php if(empty($labelTren)): ?>
                    <div class="alert alert-light border text-center mt-3">Belum ada data penanganan bulan ini.</div>
                <?php endif; ?>
            </div>
            <div class="col-md-5 mb-4">
                <div class="card shadow-sm border-0 bg-light">
                    <div class="card-body">
                        <h5 class="font-weight-bold">Fasilitas UKS Digital</h5>
                        <ul class="list-unstyled mt-3">
                            <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i> Penanganan P3K Instan</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i> Stok Obat Terpantau Kadaluarsa</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i> Rekam Medis Siswa & Guru (NIS/NIP + No HP)</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i> Laporan Harian/Bulanan/Tahunan Otomatis</li>
                        </ul>
                        <a href="index.php?halaman=kontak" class="btn btn-success btn-sm rounded-pill mt-2">Jadwal Piket & Kontak Darurat</a>
                    </div>
                </div>

                <?php if(mysqli_num_rows($queryKritis) > 0): ?>
                <div class="alert alert-danger mt-3 small">
                    <strong><i class="fas fa-exclamation-triangle"></i> Peringatan Stok:</strong><br>
                    <?php while($k = mysqli_fetch_assoc($queryKritis)): ?>
                        - <?= htmlspecialchars($k['namabarang']); ?> (Stok: <?= $k['stok']; ?>, Exp: <?= date('d/m/Y', strtotime($k['tanggalkadaluarsa'])); ?>)<br>
                    <?php endwhile; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- KATEGORI -->
<section class="content py-5 bg-light border-top">
    <div class="container">
        <div class="text-center mb-4">
            <h3 class="font-weight-bold">Klasifikasi Lemari Obat</h3>
            <p class="text-muted">Filter obat berdasarkan `kategori.namakategori`</p>
        </div>
        <div class="row">
            <?php while($kat = mysqli_fetch_assoc($queryKategori)): ?>
            <div class="col-md-3 col-6 mb-3">
                <div class="card h-100 text-center shadow-sm border-0">
                    <div class="card-body py-4">
                        <i class="fas fa-prescription-bottle-alt fa-3x text-success mb-3"></i>
                        <h6 class="font-weight-bold"><?= htmlspecialchars($kat['namakategori']); ?></h6>
                        <a href="index.php?halaman=daftarkategori&idkategori=<?= $kat['idkategori']; ?>" class="btn btn-outline-success btn-sm rounded-pill mt-2">Lihat Sediaan</a>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<!-- OBAT TERBARU -->
<section class="content py-5 bg-white">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="font-weight-bold mb-0">Pasokan Terbaru</h3>
            <a href="index.php?halaman=daftarobat" class="btn btn-link text-success font-weight-bold">Lihat Semua <i class="fas fa-arrow-right"></i></a>
        </div>
        <div class="row">
            <?php if(mysqli_num_rows($queryObatBaru) > 0): ?>
                <?php while($obat = mysqli_fetch_assoc($queryObatBaru)): 
                    $gambar = 'assets/images/barang/default_obat.png';
                    // Karena tabel tidak ada kolom foto, cek file berdasarkan idbarang.jpg kalau kamu upload manual
                    $cekFile = 'assets/images/barang/'.$obat['idbarang'].'.jpg';
                    if(file_exists($cekFile)) $gambar = $cekFile;
                ?>
                <div class="col-md-3 col-6 mb-4">
                    <div class="card h-100 shadow-sm border">
                        <img src="<?= $gambar; ?>" class="card-img-top" style="height:160px; object-fit:cover;">
                        <div class="card-body d-flex flex-column">
                            <span class="badge badge-success mb-2 align-self-start"><?= htmlspecialchars($obat['namakategori'] ?? 'Umum'); ?></span>
                            <h6 class="font-weight-bold"><?= htmlspecialchars($obat['namabarang']); ?></h6>
                            <small class="text-muted mb-2">
                                Stok: <b><?= $obat['stok']; ?> <?= $obat['satuan']; ?></b><br>
                                Masuk: <?= date('d M Y', strtotime($obat['tanggalmasuk'])); ?><br>
                                Exp: <?= date('d M Y', strtotime($obat['tanggalkadaluarsa'])); ?>
                            </small>
                            <a href="index.php?halaman=detailobat&id=<?= $obat['idbarang']; ?>" class="btn btn-success btn-sm mt-auto"><i class="fas fa-eye mr-1"></i> Aturan Pakai</a>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12"><div class="alert alert-light border text-center">Belum ada data obat di `barang`.</div></div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- ChartJS -->
<script src="assets/plugins/chart.js/Chart.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function(){
    var ctx = document.getElementById('trenChart');
    if(ctx){
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($labelTren); ?>,
                datasets: [{
                    label: 'Jumlah Kasus',
                    data: <?= json_encode($dataTren); ?>,
                    backgroundColor: '#16a34a'
                }]
            },
            options: {
                responsive:true,
                scales: { y: { beginAtZero:true, ticks:{ precision:0 } } }
            }
        });
    }
});
</script>