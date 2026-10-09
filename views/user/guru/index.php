<?php
batasi_akses_role(['admin','petugas']);
$q = mysqli_query($koneksi, "SELECT * FROM guru ORDER BY idguru DESC");
?>
<div class="content-header">
  <div class="container-fluid d-flex justify-content-between align-items-center">
    <h3 class="m-0 font-weight-bold text-success"><i class="fas fa-chalkboard-teacher mr-2"></i>Data Pasien Guru</h3>
    <a href="index.php?halaman=createguru" class="btn btn-success btn-sm rounded-pill shadow"><i class="fas fa-plus mr-1"></i> Tambah Guru</a>
  </div>
</div>
<div class="content"><div class="container-fluid">
<div class="card shadow-sm border-0">
<div class="card-body p-0 table-responsive">
<table class="table table-hover mb-0">
<thead style="background:#16a34a;color:white;">
<tr><th>No</th><th>Foto</th><th>NIP</th><th>Nama Lengkap Guru</th><th>L/P</th><th>No HP</th><th>Riwayat Alergi</th><th class="text-center">Aksi</th></tr>
</thead>
<tbody>
<?php $no=1; while($r=mysqli_fetch_assoc($q)){ $foto='assets/images/guru/'.($r['foto']??''); if(empty($r['foto'])||!file_exists($foto)) $foto='assets/images/user/default.png'; $alergi=trim($r['riwayatpenyakit']??$r['riwayatalergi']??''); ?>
<tr>
<td class="text-center"><?= $no++ ?></td>
<td><img src="<?= $foto ?>" width="42" height="42" class="rounded-circle" style="object-fit:cover" onerror="this.src='assets/images/user/default.png'"></td>
<td><b><?= htmlspecialchars($r['nip']??'-') ?></b></td>
<td><b><?= htmlspecialchars($r['namaguru']??'-') ?></b></td>
<td><b class="text-danger"><?= $r['jeniskelamin']??'P' ?></b></td>
<td><small><?= htmlspecialchars($r['nohp']??'-') ?></small></td>
<td><?php if(empty($alergi)||$alergi=='-'){ ?><i class="text-muted small">- Tidak Ada -</i><?php }else{ ?><span class="badge badge-danger"><?= htmlspecialchars($alergi) ?></span><?php } ?></td>
<td class="text-center">
<a href="index.php?halaman=showguru&id=<?= $r['idguru'] ?>" class="btn btn-success btn-xs"><i class="fas fa-eye"></i></a>
<a href="index.php?halaman=editguru&id=<?= $r['idguru'] ?>" class="btn btn-info btn-xs"><i class="fas fa-edit"></i></a>
<a href="proses/prosespasien.php?aksi=hapus&jenis=guru&id=<?= $r['idguru'] ?>" onclick="return confirm('Hapus?')" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></a>
</td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
</div></div>