<?php batasi_akses_role(['admin','petugas','anggota']);
$id=(int)($_GET['id']??0);
$p=mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT p.*, s.namasiswa, s.nis, s.kelas, s.foto as foto_siswa, g.namaguru, g.nip, g.foto as foto_guru, u.namauser FROM penanganan p LEFT JOIN siswa s ON p.idsiswa=s.idsiswa LEFT JOIN guru g ON p.idguru=g.idguru LEFT JOIN user u ON p.iduser=u.iduser WHERE p.idpenanganan=$id"));
if(!$p){ header("Location: index.php?halaman=penanganan"); exit(); }
$details=mysqli_query($koneksi,"SELECT dp.*, b.namabarang, b.satuan, b.foto FROM detailpenanganan dp JOIN barang b ON dp.idbarang=b.idbarang WHERE dp.idpenanganan=$id");
$isSiswa = !empty($p['idsiswa']);
?>
<div class="content"><div class="container-fluid">
<div class="card card-success card-outline shadow-sm mt-3"><div class="card-body">
<div class="row"><div class="col-md-3 text-center border-right">
<img src="assets/images/<?= $isSiswa?'siswa/'.$p['foto_siswa']:'guru/'.$p['foto_guru'] ?>" style="width:100px;height:100px;object-fit:cover" class="rounded-circle border" onerror="this.src='assets/images/<?= $isSiswa?'siswa':'guru' ?>/default.png'">
<h5 class="mt-2 font-weight-bold"><?= $isSiswa?htmlspecialchars($p['namasiswa']):htmlspecialchars($p['namaguru']) ?></h5><small class="text-muted"><?= $isSiswa?$p['nis'].' - '.$p['kelas']:$p['nip'] ?></small><hr>
<small>Tgl: <?= date('d M Y',strtotime($p['tanggalpenanganan'])) ?><br>Petugas: <?= $p['namauser'] ?></small>
</div>
<div class="col-md-9">
<table class="table table-bordered mb-3"><tr><th class="bg-light" width="25%">Keluhan</th><td><?= nl2br(htmlspecialchars($p['keluhan'])) ?></td></tr><tr><th class="bg-light">Tindakan</th><td><?= nl2br(htmlspecialchars($p['tindakan'])) ?></td></tr><tr><th class="bg-light">Status Akhir</th><td><span class="badge badge-<?= $p['statuspasien']=='sembuh'?'success':($p['statuspasien']=='rujuk'?'danger':'warning') ?>"><?= strtoupper($p['statuspasien']) ?></span></td></tr></table>
<h6 class="font-weight-bold text-success"><i class="fas fa-pills mr-1"></i> Obat / Alkes yang Dipakai</h6>
<table class="table table-sm table-bordered"><thead class="bg-light"><tr><th>Foto</th><th>Nama Obat</th><th>Jumlah</th></tr></thead><tbody><?php if(mysqli_num_rows($details)>0){ while($d=mysqli_fetch_assoc($details)): ?><tr><td><img src="assets/images/barang/<?= $d['foto'] ?>" style="width:35px;height:35px;object-fit:cover" class="rounded"></td><td><?= htmlspecialchars($d['namabarang']) ?></td><td><?= $d['jumlahkeluar'] ?> <?= $d['satuan'] ?></td></tr><?php endwhile; } else { echo '<tr><td colspan="3" class="text-center text-muted">Tidak pakai obat / hanya istirahat</td></tr>'; } ?></tbody></table>
<a href="index.php?halaman=penanganan" class="btn btn-secondary btn-sm">Kembali</a> <a href="index.php?halaman=editpenanganan&id=<?= $id ?>" class="btn btn-warning btn-sm">Edit</a>
</div></div>
</div></div>
</div></div>