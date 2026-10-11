<?php
batasi_akses_role(['admin','petugas']);
$tgl = $_GET['tgl'] ?? date('Y-m-d');
$q = mysqli_query($koneksi,"SELECT p.*, s.namasiswa, s.nis, s.kelas, g.namaguru, g.nip, u.namauser, GROUP_CONCAT(CONCAT(b.namabarang,' x',dp.jumlahkeluar,' ',b.satuan) SEPARATOR ', ') as obat FROM penanganan p LEFT JOIN siswa s ON p.idsiswa=s.idsiswa LEFT JOIN guru g ON p.idguru=g.idguru LEFT JOIN user u ON p.iduser=u.iduser LEFT JOIN detailpenanganan dp ON p.idpenanganan=dp.idpenanganan LEFT JOIN barang b ON dp.idbarang=b.idbarang WHERE DATE(p.tanggalpenanganan)='$tgl' GROUP BY p.idpenanganan ORDER BY p.idpenanganan ASC");
?>
<!DOCTYPE html>
<html><head><meta charset="utf-8"><title>Cetak Harian <?= $tgl ?></title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<style>
body{font-family:'Times New Roman',serif;font-size:12px;color:#000}
.kop-wrapper{border-bottom:3px double #000;padding:8px 0 10px;margin-bottom:15px}
.kop{display:flex;align-items:center;justify-content:center;gap:15px}
.kop img{width:70px;height:70px;object-fit:contain;flex-shrink:0}
.kop-tengah{text-align:center;line-height:1.2}
@media print{.no-print{display:none} @page{margin:10mm} }
</style></head>
<body>
<div class="container mt-2">
<div class="kop-wrapper">
<div class="kop">
    <img src="assets/images/logouks.jpg" onerror="this.src='assets/images/logouks.jpg'">
    <div class="kop-tengah">
        <div style="font-weight:bold;font-size:13px">PEMERINTAH PROVINSI ACEH</div>
        <div style="font-weight:bold;font-size:13px">DINAS PENDIDIKAN - SMKN 1 KARANG BARU</div>
        <div style="font-weight:bold;font-size:15px">UKS DIGITAL - UNIT KESEHATAN SEKOLAH</div>
        <div style="font-size:10px">Jl. Kesehatan No.1 Karang Baru, Aceh Tamiang - 24476 | Email: uks@smkn1karangbaru.sch.id</div>
        <div style="font-size:10px;margin-top:2px"><b>Laporan Harian Penanganan UKS | Tanggal: <?= date('d F Y',strtotime($tgl)) ?></b></div>
    </div>
    <img src="assets/images/logosmk.png" onerror="this.src='assets/images/logosmk.png'">
</div>
</div>

<table class="table table-bordered table-sm">
<thead class="bg-light">
<tr><th width="3%">No</th><th width="15%">Pasien</th><th width="10%">NIS/NIP</th><th width="20%">Keluhan</th><th width="20%">Tindakan</th><th width="8%">Status</th><th width="14%">Obat Dipakai</th><th width="10%">Petugas</th></tr>
</thead>
<tbody>
<?php $no=1; 
if(mysqli_num_rows($q)>0){ 
  while($r=mysqli_fetch_assoc($q)){ ?>
<tr>
<td><?= $no++ ?></td>
<td><?= htmlspecialchars($r['namasiswa']?:$r['namaguru']) ?><br><small class="text-muted"><?= $r['kelas']??'' ?></small></td>
<td><small><?= $r['nis']?:$r['nip'] ?></small></td>
<td><?= htmlspecialchars($r['keluhan']) ?></td>
<td><?= htmlspecialchars($r['tindakan']) ?></td>
<td><?= strtoupper($r['statuspasien']) ?></td>
<td><small><?= $r['obat']?:'-' ?></small></td>
<td><small><?= htmlspecialchars($r['namauser']) ?></small></td>
</tr>
<?php } 
} else { ?>
<tr><td colspan="8" class="text-center py-3">Tidak ada data pada tanggal <?= date('d/m/Y',strtotime($tgl)) ?></td></tr>
<?php } ?>
</tbody>
</table>

<div class="row mt-4"><div class="col-8"></div><div class="col-4 text-center">Karang Baru, <?= date('d F Y') ?><br>Pembina UKS / Petugas<br><br><br><br><b><u><?= $_SESSION['namauser']??'Buk Ely' ?></u></b><br>NIP. -</div></div>

<div class="no-print text-center mt-4">
<button onclick="window.print()" class="btn btn-success btn-sm">Cetak / Simpan PDF</button>
<a href="index.php?halaman=laporanharian&tgl=<?= $tgl ?>" class="btn btn-secondary btn-sm">Kembali</a>
</div>

</div>
</body></html>