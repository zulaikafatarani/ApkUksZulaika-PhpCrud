<?php
batasi_akses_role(['admin','petugas']);
$tahun = $_GET['tahun'] ?? date('Y');
$rekap = mysqli_query($koneksi,"SELECT MONTH(tanggalpenanganan) as bln, COUNT(*) as total, SUM(CASE WHEN statuspasien='sembuh' THEN 1 ELSE 0 END) as sembuh, SUM(CASE WHEN statuspasien='rujuk' THEN 1 ELSE 0 END) as rujuk, SUM(CASE WHEN statuspasien='istirahat' THEN 1 ELSE 0 END) as istirahat FROM penanganan WHERE YEAR(tanggalpenanganan)='$tahun' GROUP BY MONTH(tanggalpenanganan) ORDER BY bln ASC");
$detail = mysqli_query($koneksi,"SELECT p.*, s.namasiswa, s.nis, g.namaguru FROM penanganan p LEFT JOIN siswa s ON p.idsiswa=s.idsiswa LEFT JOIN guru g ON p.idguru=g.idguru WHERE YEAR(p.tanggalpenanganan)='$tahun' ORDER BY p.tanggalpenanganan DESC");
$totalTahun = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT COUNT(*) as c FROM penanganan WHERE YEAR(tanggalpenanganan)='$tahun'"))['c'];
?>
<!DOCTYPE html><html><head><meta charset="utf-8"><title>Cetak Tahunan <?= $tahun ?></title><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"><style>body{font-size:11px} @media print{.no-print{display:none}}</style></head><body>
<div class="container mt-3">
<div class="text-center border-bottom border-dark pb-2 mb-2">
<h4 class="font-weight-bold">LAPORAN TAHUNAN UKS DIGITAL</h4>
<h5>SMKN 1 KARANG BARU - TAHUN <?= $tahun ?></h5>
<small>Total Kunjungan Tahun <?= $tahun ?>: <b><?= $totalTahun ?> Pasien</b> | Dicetak oleh <?= $_SESSION['namauser']??'Admin' ?> - <?= date('d F Y') ?></small>
</div>
<h6 class="font-weight-bold mt-3">A. Rekap Per Bulan</h6>
<table class="table table-bordered table-sm"><thead class="bg-light"><tr><th>Bulan</th><th>Total Pasien</th><th>Sembuh</th><th>Istirahat</th><th>Rujuk</th></tr></thead><tbody><?php while($r=mysqli_fetch_assoc($rekap)): ?><tr><td><?= date('F',mktime(0,0,0,$r['bln'],1)) ?></td><td><b><?= $r['total'] ?></b></td><td><?= $r['sembuh'] ?></td><td><?= $r['istirahat'] ?></td><td><?= $r['rujuk'] ?></td></tr><?php endwhile; ?></tbody></table>

<h6 class="font-weight-bold mt-4">B. Detail Kunjungan</h6>
<table class="table table-bordered table-sm"><thead class="bg-light"><tr><th>No</th><th>Tanggal</th><th>Pasien</th><th>Keluhan</th><th>Tindakan</th><th>Status</th></tr></thead><tbody><?php $no=1; while($d=mysqli_fetch_assoc($detail)): ?><tr><td><?= $no++ ?></td><td><?= date('d/m/Y',strtotime($d['tanggalpenanganan'])) ?></td><td><?= $d['namasiswa']?:$d['namaguru'] ?></td><td><?= htmlspecialchars($d['keluhan']) ?></td><td><?= htmlspecialchars($d['tindakan']) ?></td><td><?= $d['statuspasien'] ?></td></tr><?php endwhile; ?></tbody></table>

<div class="row mt-4"><div class="col-8"></div><div class="col-4 text-center">Mengetahui,<br>Kepala SMKN 1 Karang Baru<br><br><br><br><b>(___________________)</b></div></div>
<div class="no-print text-center mt-3"><button onclick="window.print()" class="btn btn-success btn-sm">Cetak Tahunan</button></div>
</div><script>window.onload=function(){ window.print(); }</script></body></html>