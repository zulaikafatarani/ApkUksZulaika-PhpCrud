<?php
// views/user/guru/show.php - FINAL GABUNG UKS.CSS
batasi_akses_role(['admin','petugas']);
$id=(int)($_GET['id']??0);
$d=mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT * FROM guru WHERE idguru=$id"));
if(!$d){ header("Location: index.php?halaman=guru"); exit(); }
$fotoShow = 'assets/images/guru/'.($d['foto']??'default.png');
if(empty($d['foto']) || !file_exists($fotoShow)) $fotoShow='assets/images/user/default.png';
?>
<div class="dash">
  <div class="content-header"><div class="container-fluid"><div class="row mb-2 align-items-center">
    <div class="col-sm-7"><h1 class="m-0 font-weight-bold" style="color:var(--dark)"><i class="fas fa-chalkboard-teacher mr-2" style="color:var(--teal)"></i> Kartu Pasien Guru</h1><small class="text-muted">UKS Digital - <b style="color:var(--teal)">Biodata Guru</b> | <span class="badge-mint"><?= htmlspecialchars($d['nip']) ?></span></small></div>
    <div class="col-sm-5 text-right"><a href="index.php?halaman=guru" class="btn-toska"><i class="fas fa-arrow-left mr-1"></i> Kembali</a></div>
  </div></div></div>
  <div class="content"><div class="container-fluid"><div class="uk-card-guru"><div class="p-4"><div class="row">
    <div class="col-md-3 text-center" style="border-right:1px solid #e0f2f1">
      <img src="<?= $fotoShow ?>" width="120" height="120" class="foto-big-guru" onerror="this.src='assets/images/user/default.png'">
      <h5 class="mt-3 font-weight-bold" style="color:var(--dark)"><?= htmlspecialchars($d['namaguru']) ?></h5>
      <span class="badge-nip"><?= htmlspecialchars($d['nip']) ?></span>
    </div>
    <div class="col-md-9">
      <table class="table table-bordered mb-3"><tr><th style="width:30%; background:var(--mint2)">NIP</th><td><?= htmlspecialchars($d['nip']) ?></td></tr><tr><th style="background:var(--mint2)">Nama</th><td class="font-weight-bold" style="color:var(--dark)"><?= htmlspecialchars($d['namaguru']) ?></td></tr><tr><th style="background:var(--mint2)">Jenis Kelamin</th><td><?= $d['jeniskelamin']=='L'?'Laki-Laki':'Perempuan' ?> (<?= $d['jeniskelamin'] ?>)</td></tr><tr><th style="background:var(--mint2)">No HP</th><td><?= htmlspecialchars($d['nohp']) ?></td></tr><tr><th style="background:var(--mint2)">Alamat</th><td><?= htmlspecialchars($d['alamat']) ?></td></tr><tr><th style="background:var(--mint2)" class="text-danger">Riwayat Penyakit</th><td class="text-danger font-weight-bold"><?= htmlspecialchars($d['riwayatpenyakit']??'-') ?></td></tr></table>
      <a href="index.php?halaman=guru" class="btn btn-secondary btn-sm" style="border-radius:30px; padding:8px 20px">Kembali</a> <a href="index.php?halaman=editguru&id=<?= $d['idguru'] ?>" class="btn-toska">Edit</a>
    </div>
  </div></div></div></div></div>
</div>