<?php
batasi_akses_role(['admin','petugas']);
$tahun = $_GET['tahun'] ?? date('Y');
// FIX status kamu lowercase - aku pakai LIKE biar kehitung semua
$rekap = mysqli_query($koneksi,"SELECT MONTH(tanggalpenanganan) as bln, COUNT(*) as total, SUM(CASE WHEN statuspasien LIKE '%kembali%' THEN 1 ELSE 0 END) as sembuh, SUM(CASE WHEN statuspasien LIKE '%rujuk%' THEN 1 ELSE 0 END) as rujuk, SUM(CASE WHEN statuspasien LIKE '%istirahat%' THEN 1 ELSE 0 END) as istirahat FROM penanganan WHERE YEAR(tanggalpenanganan)='$tahun' GROUP BY MONTH(tanggalpenanganan) ORDER BY bln ASC");
$detail = mysqli_query($koneksi,"SELECT p.*, s.namasiswa, s.nis, g.namaguru FROM penanganan p LEFT JOIN siswa s ON p.idsiswa=s.idsiswa LEFT JOIN guru g ON p.idguru=g.idguru WHERE YEAR(p.tanggalpenanganan)='$tahun' ORDER BY p.tanggalpenanganan DESC");
$totalTahun = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT COUNT(*) as c FROM penanganan WHERE YEAR(tanggalpenanganan)='$tahun'"))['c'];
?>
<!DOCTYPE html><html><head><meta charset="utf-8"><title>Cetak Tahunan <?= $tahun ?></title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<style>
body{font-family:'Times New Roman',serif;font-size:11px;color:#000}
.kop-wrapper{border-bottom:3px double #000;padding:8px 0 10px;margin-bottom:15px}
.kop{display:flex;align-items:center;justify-content:center;gap:15px}
.kop img{width:70px;height:70px;object-fit:contain}
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
        <div style="font-weight:bold;font-size:16px">LAPORAN TAHUNAN UKS DIGITAL - TAHUN <?= $tahun ?></div>
        <div style="font-size:10px">Total Kunjungan Tahun <?= $tahun ?>: <b><?= $totalTahun ?> Pasien</b> | Dicetak oleh <?= $_SESSION['namauser']??'Buk Ely' ?> - <?= date('d F Y') ?></div>
    </div>
    <img src="assets/images/logosmk.png" onerror="this.src='assets/images/logoamk.png'">
</div>
</div>

<h6 class="font-weight-bold mt-3">A. Rekap Per Bulan</h6>
<table class="table table-bordered table-sm"><thead class="bg-light"><tr><th>Bulan</th><th>Total Pasien</th><th>Kembali ke Kelas</th><th>Istirahat di UKS</th><th>Rujuk Puskesmas/RS</th></tr></thead>
<tbody>
<?php while($r=mysqli_fetch_assoc($rekap)): ?>
<tr><td><?= date('F',mktime(0,0,0,$r['bln'],1)) ?></td><td><b><?= $r['total'] ?></b></td><td><?= $r['sembuh'] ?></td><td><?= $r['istirahat'] ?></td><td><?= $r['rujuk'] ?></td></tr>
<?php endwhile; 
if(mysqli_num_rows($rekap)==0) echo '<tr><td colspan="5" class="text-center">Belum ada data tahun '.$tahun.'</td></tr>';
?>
</tbody></table>

<h6 class="font-weight-bold mt-4">B. Detail Kunjungan</h6>
<table class="table table-bordered table-sm"><thead class="bg-light"><tr><th>No</th><th>Tanggal</th><th>Pasien</th><th>Keluhan</th><th>Tindakan</th><th>Status</th></tr></thead>
<tbody><?php $no=1; while($d=mysqli_fetch_assoc($detail)): ?><tr><td><?= $no++ ?></td><td><?= date('d/m/Y',strtotime($d['tanggalpenanganan'])) ?></td><td><?= htmlspecialchars($d['namasiswa']?:$d['namaguru']) ?></td><td><?= htmlspecialchars($d['keluhan']) ?></td><td><?= htmlspecialchars($d['tindakan']) ?></td><td><?= strtoupper($d['statuspasien']) ?></td></tr><?php endwhile; ?></tbody></table>

<div class="row mt-4"><div class="col-6 text-center">Mengetahui,<br>Kepala SMKN 1 Karang Baru<br><br><br><br><b>(___________________)</b></div><div class="col-6 text-center">Karang Baru, <?= date('d F Y') ?><br>Pembina UKS<br><br><br><br><b><u><?= $_SESSION['namauser']??'Buk Ely' ?></u></b></div></div>
<div class="no-print text-center mt-3"><button onclick="window.print()" class="btn btn-success btn-sm">Cetak Tahunan</button> <a href="index.php?halaman=laporantahunan&tahun=<?= $tahun ?>" class="btn btn-secondary btn-sm">Kembali</a></div>
</div><script>window.onload=function(){ window.print(); }</script></body></html>