<?php
batasi_akses_role(['admin','petugas']);
$tgl = $_GET['tgl'] ?? date('Y-m-d');
$q = mysqli_query($koneksi,"SELECT p.*, s.namasiswa, s.nis, s.kelas, g.namaguru, g.nip, u.namauser, GROUP_CONCAT(CONCAT(b.namabarang,' x',dp.jumlahkeluar,' ',b.satuan) SEPARATOR ', ') as obat FROM penanganan p LEFT JOIN siswa s ON p.idsiswa=s.idsiswa LEFT JOIN guru g ON p.idguru=g.idguru LEFT JOIN user u ON p.iduser=u.iduser LEFT JOIN detailpenanganan dp ON p.idpenanganan=dp.idpenanganan LEFT JOIN barang b ON dp.idbarang=b.idbarang WHERE DATE(p.tanggalpenanganan)='$tgl' GROUP BY p.idpenanganan ORDER BY p.idpenanganan ASC");
?>
<!DOCTYPE html><html><head><meta charset="utf-8"><title>Cetak Harian <?= $tgl ?></title><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"><style>body{font-size:12px;font-family:'Times New Roman'} @media print{.no-print{display:none}}</style></head>
<body>
<div class="container mt-3">
<div class="text-center border-bottom border-dark pb-2 mb-3">
<img src="assets/images/logo.png" style="width:60px" class="float-left" onerror="this.style.display='none'">
<h4 class="font-weight-bold mb-0">UKS DIGITAL SMKN 1 KARANG BARU</h4>
<p class="mb-0">Jl. Kesehatan No. 1 Karang Baru, Aceh Tamiang - 24476</p>
<small>Laporan Harian Penanganan UKS | Tanggal: <b><?= date('d F Y',strtotime($tgl)) ?></b></small>
</div>
<table class="table table-bordered table-sm">
<thead class="bg-light"><tr><th width="3%">No</th><th width="15%">Pasien</th><th width="10%">NIS/NIP</th><th width="20%">Keluhan</th><th width="20%">Tindakan</th><th width="8%">Status</th><th width="14%">Obat Dipakai</th><th width="10%">Petugas</th></tr></thead>
<tbody>
<?php $no=1; if(mysqli_num_rows($q)>0){ while($r=mysqli_fetch_assoc($q)): ?>
<tr><td><?= $no++ ?></td><td><?= htmlspecialchars($r['namasiswa']?:$r['namaguru']) ?><br><small class="text-muted"><?= $r['kelas']??'' ?></small></td><td><small><?= $r['nis']?:$r['nip'] ?></small></td><td><?= htmlspecialchars($r['keluhan']) ?></td><td><?= htmlspecialchars($r['tindakan']) ?></td><td><?= strtoupper($r['statuspasien']) ?></td><td><small><?= $r['obat']?:'-' ?></small></td><td><small><?= $r['namauser'] ?></small></td></tr>
<?php endwhile; } else { echo '<tr><td colspan="8" class="text-center">Tidak ada data pada tanggal ini</td></tr>'; } ?>
</tbody>
</table>
<div class="row mt-4"><div class="col-8"></div><div class="col-4 text-center">Karang Baru, <?= date('d F Y') ?><br>Pembina UKS / Petugas<br><br><br><br><b><u><?= $_SESSION['namauser']??'Admin UKS' ?></u></b><br>NIP. -</div></div>
<div class="no-print text-center mt-4"><button onclick="window.print()" class="btn btn-success btn-sm"><i class="fas fa-print"></i> Cetak / Simpan PDF</button> <a href="index.php?halaman=laporanharian&tgl=<?= $tgl ?>" class="btn btn-secondary btn-sm">Kembali</a></div>
</div>
<script>window.onload=function(){ window.print(); }</script>
</body></html>