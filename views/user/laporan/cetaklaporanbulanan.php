<?php
batasi_akses_role(['admin','petugas']);
$bulan = $_GET['bulan'] ?? date('m'); $tahun = $_GET['tahun'] ?? date('Y');
$namaBulan = date('F Y', mktime(0,0,0,$bulan,1,$tahun));
$q = mysqli_query($koneksi,"SELECT p.*, s.namasiswa, s.nis, s.kelas, g.namaguru, g.nip, u.namauser, GROUP_CONCAT(CONCAT(b.namabarang,' x',dp.jumlahkeluar) SEPARATOR ', ') as obat FROM penanganan p LEFT JOIN siswa s ON p.idsiswa=s.idsiswa LEFT JOIN guru g ON p.idguru=g.idguru LEFT JOIN user u ON p.iduser=u.iduser LEFT JOIN detailpenanganan dp ON p.idpenanganan=dp.idpenanganan LEFT JOIN barang b ON dp.idbarang=b.idbarang WHERE MONTH(p.tanggalpenanganan)='$bulan' AND YEAR(p.tanggalpenanganan)='$tahun' GROUP BY p.idpenanganan ORDER BY p.tanggalpenanganan ASC");
$total = mysqli_num_rows($q);
?>
<!DOCTYPE html><html><head><meta charset="utf-8"><title>Cetak Bulanan <?= $bulan ?>-<?= $tahun ?></title><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"><style>body{font-size:11px;font-family:'Times New Roman'} @media print{.no-print{display:none}}</style></head><body>
<div class="container mt-3">
<div class="text-center border-bottom border-dark pb-2 mb-3">
<h4 class="font-weight-bold mb-0">UKS DIGITAL SMKN 1 KARANG BARU</h4>
<small>Laporan Bulanan Penanganan UKS | Periode: <b><?= $namaBulan ?></b> | Total Pasien: <b><?= $total ?></b> | Dicetak: <?= date('d/m/Y H:i') ?></small>
</div>
<table class="table table-bordered table-sm"><thead class="bg-light"><tr><th>No</th><th>Tanggal</th><th>Pasien</th><th>Kelas</th><th>Keluhan</th><th>Status</th><th>Obat</th><th>Petugas</th></tr></thead>
<tbody><?php $no=1; mysqli_data_seek($q,0); while($r=mysqli_fetch_assoc($q)): ?><tr><td><?= $no++ ?></td><td><?= date('d/m/Y',strtotime($r['tanggalpenanganan'])) ?></td><td><?= $r['namasiswa']?:$r['namaguru'] ?></td><td><?= $r['kelas']??$r['nip'] ?></td><td><?= $r['keluhan'] ?></td><td><?= $r['statuspasien'] ?></td><td><small><?= $r['obat']?:'-' ?></small></td><td><?= $r['namauser'] ?></td></tr><?php endwhile; ?></tbody></table>
<div class="text-center no-print mt-3"><button onclick="window.print()" class="btn btn-success btn-sm">Cetak PDF Bulanan</button></div>
</div><script>window.onload=function(){ window.print(); }</script></body></html>