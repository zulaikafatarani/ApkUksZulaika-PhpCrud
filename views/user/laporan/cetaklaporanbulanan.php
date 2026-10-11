<?php
batasi_akses_role(['admin','petugas']);
$bulan = $_GET['bulan'] ?? date('m'); $tahun = $_GET['tahun'] ?? date('Y');
$namaBulan = date('F Y', mktime(0,0,0,$bulan,1,$tahun));
$q = mysqli_query($koneksi,"SELECT p.*, s.namasiswa, s.nis, s.kelas, g.namaguru, g.nip, u.namauser, GROUP_CONCAT(CONCAT(b.namabarang,' x',dp.jumlahkeluar) SEPARATOR ', ') as obat FROM penanganan p LEFT JOIN siswa s ON p.idsiswa=s.idsiswa LEFT JOIN guru g ON p.idguru=g.idguru LEFT JOIN user u ON p.iduser=u.iduser LEFT JOIN detailpenanganan dp ON p.idpenanganan=dp.idpenanganan LEFT JOIN barang b ON dp.idbarang=b.idbarang WHERE MONTH(p.tanggalpenanganan)='$bulan' AND YEAR(p.tanggalpenanganan)='$tahun' GROUP BY p.idpenanganan ORDER BY p.tanggalpenanganan ASC");
$total = mysqli_num_rows($q);
?>
<!DOCTYPE html><html><head><meta charset="utf-8"><title>Cetak Bulanan <?= $bulan ?>-<?= $tahun ?></title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<style>
body{font-family:'Times New Roman',serif;font-size:11px;color:#000}
.kop-wrapper{border-bottom:3px double #000;padding:8px 0 10px;margin-bottom:15px}
.kop{display:flex;align-items:center;justify-content:center;gap:15px}
.kop img{width:70px;height:70px;object-fit:contain;flex-shrink:0}
.kop-tengah{text-align:center;line-height:1.2}
@media print{.no-print{display:none} @page{margin:10mm}}
</style></head><body>
<div class="container mt-2">
<div class="kop-wrapper">
<div class="kop">
    <img src="assets/images/logouks.jpg" onerror="this.src='assets/images/logouks.jpg'">
    <div class="kop-tengah">
        <div style="font-weight:bold;font-size:13px">PEMERINTAH PROVINSI ACEH</div>
        <div style="font-weight:bold;font-size:13px">DINAS PENDIDIKAN - SMKN 1 KARANG BARU</div>
        <div style="font-weight:bold;font-size:15px">UKS DIGITAL - UNIT KESEHATAN SEKOLAH</div>
        <div style="font-size:10px">Jl. Kesehatan No.1 Karang Baru, Aceh Tamiang - 24476 | Laporan Bulanan | Periode: <b><?= $namaBulan ?></b> | Total: <b><?= $total ?> Pasien</b></div>
    </div>
    <img src="assets/images/logosmk.png" onerror="this.src='assets/images/logosmk.png'">
</div>
</div>

<table class="table table-bordered table-sm">
<thead class="bg-light"><tr><th>No</th><th>Tanggal</th><th>Pasien</th><th>Kelas</th><th>Keluhan</th><th>Tindakan</th><th>Status</th><th>Obat</th><th>Petugas</th></tr></thead>
<tbody>
<?php $no=1; mysqli_data_seek($q,0); while($r=mysqli_fetch_assoc($q)): ?>
<tr><td><?= $no++ ?></td><td><?= date('d/m/Y',strtotime($r['tanggalpenanganan'])) ?></td><td><?= htmlspecialchars($r['namasiswa']?:$r['namaguru']) ?></td><td><?= $r['kelas']??$r['nip']??'-' ?></td><td><?= htmlspecialchars($r['keluhan']) ?></td><td><?= htmlspecialchars($r['tindakan']??$r['keluhan']) ?></td><td><?= strtoupper($r['statuspasien']) ?></td><td><small><?= $r['obat']?:'-' ?></small></td><td><small><?= $r['namauser'] ?></small></td></tr>
<?php endwhile; 
if($total==0) echo '<tr><td colspan="9" class="text-center py-3">Tidak ada data di bulan '.$namaBulan.'</td></tr>';
?>
</tbody></table>

<div class="row mt-4"><div class="col-8"></div><div class="col-4 text-center">Karang Baru, <?= date('d F Y') ?><br>Pembina UKS / Petugas<br><br><br><br><b><u><?= $_SESSION['namauser']??'Buk Ely' ?></u></b></div></div>
<div class="no-print text-center mt-3"><button onclick="window.print()" class="btn btn-success btn-sm">Cetak PDF Bulanan</button> <a href="index.php?halaman=laporanbulanan&bulan=<?= $bulan ?>&tahun=<?= $tahun ?>" class="btn btn-secondary btn-sm">Kembali</a></div>
</div></body></html>