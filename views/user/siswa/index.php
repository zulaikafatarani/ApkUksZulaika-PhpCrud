<?php 
batasi_akses_role(['admin', 'petugas', 'anggota']);
$q = mysqli_query($koneksi, "SELECT * FROM siswa ORDER BY idsiswa DESC"); 
$status = $_GET['status'] ?? '';
?>
<div class="content-header"><div class="container-fluid"><div class="row mb-2"><div class="col-sm-6"><h1 class="m-0 text-success font-weight-bold"><i class="fas fa-user-graduate mr-2"></i>Data Pasien Siswa</h1></div><div class="col-sm-6 text-right"><a href="index.php?halaman=createsiswa" class="btn btn-success font-weight-bold shadow-sm rounded-pill px-3 btn-sm"><i class="fas fa-plus-circle mr-1"></i> Tambah Siswa</a></div></div></div></div>

<div class="content"><div class="container-fluid">
<?php if ($status === 'sukses_tambah'): ?><div class="alert alert-success small py-2"><i class="fas fa-check-circle mr-1"></i> Siswa berhasil ditambah!</div>
<?php elseif ($status === 'sukses_ubah'): ?><div class="alert alert-info small py-2">Biodata siswa diperbarui!</div>
<?php elseif ($status === 'sukses_hapus'): ?><div class="alert alert-warning small py-2">Data siswa dihapus!</div><?php endif; ?>

<div class="card card-success card-outline shadow-sm"><div class="card-body p-0 table-responsive">
<table class="table table-hover table-striped mb-0">
<thead class="bg-success text-white"><tr>
<th width="60" class="text-center">No</th><th width="130">NIS / NISN</th><th>Nama Lengkap Siswa</th><th width="120">Kelas / Jurusan</th><th width="50" class="text-center">L/P</th><th width="140">No HP</th><th>Riwayat Alergi</th><th width="120" class="text-center">Aksi</th>
</tr></thead>
<tbody>
<?php $no=1; if(mysqli_num_rows($q)>0): while($r=mysqli_fetch_assoc($q)): 
// FIX ANTI ERROR: pakai ?? biar support nis dan nisn
$nis = $r['nis'] ?? $r['nisn'] ?? '-';
$jk = $r['jeniskelamin'] ?? $r['jk'] ?? 'L';
$hp = $r['nohp'] ?? $r['hp_ortu'] ?? $r['no_hp'] ?? '-';
$alergi = $r['riwayatalergi'] ?? $r['alergi'] ?? '-';
?>
<tr class="align-middle">
<td class="text-center text-muted"><?= $no++ ?></td>
<td class="font-weight-bold text-secondary"><?= htmlspecialchars($nis) ?></td>
<td class="font-weight-bold text-dark"><?= htmlspecialchars($r['namasiswa']) ?></td>
<td><span class="badge badge-info"><?= htmlspecialchars($r['kelas'] ?? '-') ?></span></td>
<td class="text-center"><?= $jk=='L' ? '<span class="text-primary font-weight-bold">L</span>' : '<span class="text-danger font-weight-bold">P</span>' ?></td>
<td class="text-muted small"><?= htmlspecialchars($hp) ?></td>
<td><?php if(!empty($alergi) && $alergi!='-' ): ?><span class="badge badge-danger"><i class="fas fa-exclamation-triangle mr-1"></i><?= htmlspecialchars($alergi) ?></span><?php else: ?><span class="text-muted small font-italic">- Tidak Ada -</span><?php endif; ?></td>
<td class="text-center">
<a href="index.php?halaman=showsiswa&id=<?= $r['idsiswa'] ?>" class="btn btn-success btn-xs"><i class="fas fa-eye"></i></a> 
<a href="index.php?halaman=editsiswa&id=<?= $r['idsiswa'] ?>" class="btn btn-info btn-xs"><i class="fas fa-edit"></i></a> 
<!-- FIX ROUTE HAPUS: prosespasien.php pakai aksi=hapus&jenis=siswa -->
<a href="proses/prosespasien.php?aksi=hapus&jenis=siswa&id=<?= $r['idsiswa'] ?>" onclick="return confirm('Hapus <?= htmlspecialchars($r['namasiswa']) ?>?')" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></a>
</td>
</tr>
<?php endwhile; else: ?><tr><td colspan="8" class="text-center py-4 text-muted">Belum ada data siswa</td></tr><?php endif; ?>
</tbody>
</table>
</div></div>
</div></div>