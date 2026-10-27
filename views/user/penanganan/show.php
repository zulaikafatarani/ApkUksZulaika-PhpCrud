<?php
// views/user/penanganan/show.php - FINAL GABUNG UKS.CSS
batasi_akses_role(['admin','petugas','anggota']);
$id=(int)($_GET['id']??0);
$p=mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT p.*, s.namasiswa, s.nis, s.kelas, s.foto as foto_siswa, g.namaguru, g.nip, g.foto as foto_guru, u.namauser FROM penanganan p LEFT JOIN siswa s ON p.idsiswa=s.idsiswa LEFT JOIN guru g ON p.idguru=g.idguru LEFT JOIN user u ON p.iduser=u.iduser WHERE p.idpenanganan=$id"));
if(!$p){ header("Location: index.php?halaman=penanganan"); exit(); }
$details=mysqli_query($koneksi,"SELECT dp.*, b.namabarang, b.satuan, b.foto FROM detailpenanganan dp JOIN barang b ON dp.idbarang=b.idbarang WHERE dp.idpenanganan=$id");
$isSiswa = !empty($p['idsiswa']);
$fotoShow = 'assets/images/'.($isSiswa?'siswa/'.($p['foto_siswa']??'default.png'):'guru/'.($p['foto_guru']??'default.png'));
?>
<div class="dash">
  <div class="content-header"><div class="container-fluid"><div class="row mb-2 align-items-center"><div class="col-sm-7"><h1 class="m-0 font-weight-bold" style="color:var(--dark)"><i class="fas fa-file-medical mr-2" style="color:var(--teal)"></i> Detail Penanganan #<?= $id ?></h1><small class="text-muted">UKS Digital - <b style="color:var(--teal)">Rekam Medis</b> | <span class="badge-mint"><?= strtoupper($p['statuspasien']) ?></span></small></div><div class="col-sm-5 text-right"><a href="index.php?halaman=penanganan" class="btn-toska"><i class="fas fa-arrow-left mr-1"></i> Kembali</a></div></div></div></div>
  <div class="content"><div class="container-fluid"><div class="uk-card-pen"><div class="p-4"><div class="row">
    <div class="col-md-3 text-center" style="border-right:1px solid #e0f2f1">
      <img src="<?= $fotoShow ?>" width="100" height="100" class="foto-big-pen" onerror="this.src='assets/images/<?= $isSiswa?'siswa':'guru' ?>/default.png'">
      <h5 class="mt-3 font-weight-bold" style="color:var(--dark)"><?= $isSiswa?htmlspecialchars($p['namasiswa']):htmlspecialchars($p['namaguru']) ?></h5>
      <small class="text-muted"><?= $isSiswa?$p['nis'].' - '.$p['kelas']:$p['nip'] ?></small><hr>
      <small>Tgl: <?= date('d M Y',strtotime($p['tanggalpenanganan'])) ?><br>Petugas: <?= $p['namauser'] ?></small>
    </div>
    <div class="col-md-9">
      <table class="table table-bordered mb-3"><tr><th style="width:25%; background:var(--mint2)">Keluhan</th><td><?= nl2br(htmlspecialchars($p['keluhan'])) ?></td></tr><tr><th style="background:var(--mint2)">Tindakan</th><td><?= nl2br(htmlspecialchars($p['tindakan'])) ?></td></tr><tr><th style="background:var(--mint2)">Status Akhir</th><td><span class="badge-mint"><?= strtoupper($p['statuspasien']) ?></span></td></tr></table>
      <h6 class="font-weight-bold" style="color:var(--teal)"><i class="fas fa-pills mr-1"></i> Obat / Alkes yang Dipakai</h6>
      <table class="table table-sm table-bordered"><thead class="bg-light"><tr><th>Foto</th><th>Nama Obat</th><th>Jumlah</th></tr></thead><tbody><?php if(mysqli_num_rows($details)>0){ while($d=mysqli_fetch_assoc($details)): ?><tr><td><img src="assets/images/barang/<?= $d['foto'] ?>" width="35" height="35" class="foto-obat" onerror="this.src='assets/images/barang/default.png'"></td><td><?= htmlspecialchars($d['namabarang']) ?></td><td><?= $d['jumlahkeluar'] ?> <?= $d['satuan'] ?></td></tr><?php endwhile; } else { echo '<tr><td colspan="3" class="text-center text-muted">Tidak pakai obat / hanya istirahat</td></tr>'; } ?></tbody></table>
      <a href="index.php?halaman=penanganan" class="btn btn-secondary btn-sm" style="border-radius:30px; padding:8px 20px">Kembali</a> <a href="index.php?halaman=editpenanganan&id=<?= $id ?>" class="btn-toska">Edit</a>
    </div>
  </div></div></div></div></div>
</div>