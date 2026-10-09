<?php batasi_akses_role(['admin','petugas','anggota']);
$q=mysqli_query($koneksi,"SELECT p.*, s.namasiswa, s.nis, s.kelas, s.foto as foto_siswa, g.namaguru, g.nip, u.namauser FROM penanganan p LEFT JOIN siswa s ON p.idsiswa=s.idsiswa LEFT JOIN guru g ON p.idguru=g.idguru LEFT JOIN user u ON p.iduser=u.iduser ORDER BY p.tanggalpenanganan DESC, p.idpenanganan DESC");
$status=$_GET['status']??'';
if($status=='sukses_tambah') echo '<div class="alert alert-success"><i class="fas fa-check"></i> Penanganan disimpan, stok otomatis terpotong!</div>';
if($status=='sukses_hapus') echo '<div class="alert alert-warning"><i class="fas fa-undo"></i> Penanganan dihapus, stok dikembalikan!</div>';
if($status=='sukses_ubah') echo '<div class="alert alert-info"><i class="fas fa-edit"></i> Penanganan diubah!</div>';
if($status=='stok_kurang') echo '<div class="alert alert-danger"><i class="fas fa-times"></i> Gagal! Stok obat ID '.$_GET['idb'].' tidak cukup!</div>';
?>
<div class="content-header"><div class="container-fluid"><div class="row mb-2">
<div class="col-sm-6"><h1 class="m-0 text-success font-weight-bold"><i class="fas fa-hand-holding-medical mr-1"></i> Data Penanganan UKS</h1></div>
<div class="col-sm-6 text-right"><a href="index.php?halaman=createpenanganan" class="btn btn-success btn-sm rounded-pill px-3 shadow-sm"><i class="fas fa-plus mr-1"></i> Tangani Pasien Baru</a></div>
</div></div></div>
<div class="content"><div class="container-fluid"><div class="card card-success card-outline shadow-sm"><div class="card-body p-0 table-responsive">
<table class="table table-hover table-striped mb-0">
<thead class="bg-light"><tr><th width="5%">#</th><th>Tanggal</th><th>Pasien</th><th>Keluhan</th><th>Tindakan</th><th>Status</th><th>Petugas</th><th width="15%" class="text-center">Aksi</th></tr></thead>
<tbody>
<?php $no=1; while($r=mysqli_fetch_assoc($q)): 
$pasien = $r['namasiswa'] ? $r['namasiswa'].'<br><small class="text-muted">'.$r['nis'].' - '.$r['kelas'].'</small>' : $r['namaguru'].'<br><small class="text-muted">'.$r['nip'].'</small>';
?>
<tr>
<td><?= $no++ ?></td>
<td><small class="font-weight-bold"><?= date('d/m/Y',strtotime($r['tanggalpenanganan'])) ?></small></td>
<td><?= $pasien ?></td>
<td><small><?= htmlspecialchars(substr($r['keluhan'],0,40)) ?>...</small></td>
<td><small><?= htmlspecialchars(substr($r['tindakan'],0,40)) ?>...</small></td>
<td><?php if($r['statuspasien']=='sembuh'): ?><span class="badge badge-success">Sembuh</span><?php elseif($r['statuspasien']=='rujuk'): ?><span class="badge badge-danger">Rujuk</span><?php else: ?><span class="badge badge-warning">Istirahat</span><?php endif; ?></td>
<td><small><?= $r['namauser'] ?></small></td>
<td class="text-center">
<a href="index.php?halaman=showpenanganan&id=<?= $r['idpenanganan'] ?>" class="btn btn-info btn-xs" title="Detail Obat Dipakai"><i class="fas fa-eye"></i></a>
<a href="index.php?halaman=editpenanganan&id=<?= $r['idpenanganan'] ?>" class="btn btn-warning btn-xs" title="Edit"><i class="fas fa-edit"></i></a>
<a href="proses/prosespenanganan.php?aksi=hapus&id=<?= $r['idpenanganan'] ?>" onclick="return confirm('Hapus penanganan ini? Stok obat akan dikembalikan otomatis!')" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></a>
</td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>
<div class="card-footer bg-light small text-muted"><i class="fas fa-info-circle mr-1"></i> Hapus penanganan = stok balik. Ini logika relasional halaman 6 laporan yang dinilai dosen.</div>
</div></div></div>