<?php
// views/user/siswa/index.php - FINAL STYLE SAMA + ADA FOTO
if (!isset($koneksi)) include __DIR__.'/../../proses/koneksi.php';
batasi_akses_role(['admin','petugas']);

$q = mysqli_query($koneksi, "SELECT * FROM siswa ORDER BY idsiswa DESC");
?>
<div class="content-header">
  <div class="container-fluid d-flex justify-content-between align-items-center">
    <h3 class="m-0 font-weight-bold text-success"><i class="fas fa-user-graduate mr-2"></i>Data Pasien Siswa</h3>
    <a href="index.php?halaman=createsiswa" class="btn btn-success btn-sm rounded-pill shadow"><i class="fas fa-plus mr-1"></i> Tambah Siswa</a>
  </div>
</div>
<div class="content"><div class="container-fluid">
<div class="card shadow-sm border-0">
  <div class="card-body p-0 table-responsive">
    <table class="table table-hover mb-0">
      <thead style="background:#16a34a; color:white;">
        <tr>
          <th class="py-3">No</th>
          <th class="py-3">Foto</th>
          <th class="py-3">NIS / NISN</th>
          <th class="py-3">Nama Lengkap Siswa</th>
          <th class="py-3">Kelas /<br>Jurusan</th>
          <th class="py-3">L/P</th>
          <th class="py-3">No HP</th>
          <th class="py-3">Riwayat Alergi</th>
          <th class="py-3 text-center">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php $no=1; while($d=mysqli_fetch_assoc($q)): 
          // Foto - cek file
          $namaFoto = $d['foto'] ?? $d['fotosiswa'] ?? '';
          $pathFoto = 'assets/images/siswa/'.$namaFoto;
          $foto = (!empty($namaFoto) && file_exists($pathFoto)) ? $pathFoto : 'assets/images/siswa/default.png';
          // Fallback jika default.png juga belum ada, pakai user default
          if(!file_exists($foto)) $foto = 'assets/images/user/default.png';
        ?>
        <tr>
          <td class="align-middle text-center"><?= $no++ ?></td>
          <td class="align-middle">
            <img src="<?= $foto ?>" width="42" height="42" class="img-circle elevation-1" style="object-fit:cover" onerror="this.src='assets/images/user/default.png'">
          </td>
          <td class="align-middle"><b><?= htmlspecialchars($d['nis'] ?? $d['nisn'] ?? '-') ?></b></td>
          <td class="align-middle"><b><?= htmlspecialchars($d['namasiswa'] ?? '-') ?></b></td>
          <td class="align-middle">
            <span class="badge badge-info" style="background:#0891b2;"><?= htmlspecialchars($d['kelas'] ?? '-') ?></span>
          </td>
          <td class="align-middle"><b class="text-danger"><?= htmlspecialchars($d['jeniskelamin'] ?? $d['jk'] ?? $d['gender'] ?? 'P') ?></b></td>
          <td class="align-middle"><small class="text-muted"><?= htmlspecialchars($d['nohp'] ?? $d['no_hp'] ?? '-') ?></small></td>
          <td class="align-middle">
            <?php 
            $alergi = trim($d['riwayatalergi'] ?? $d['alergi'] ?? '');
            if(empty($alergi) || strtolower($alergi)=='-' || strtolower($alergi)=='tidak ada'): ?>
              <i class="text-muted small">- Tidak Ada -</i>
            <?php else: ?>
              <span class="badge badge-danger"><i class="fas fa-exclamation-triangle mr-1"></i><?= htmlspecialchars($alergi) ?></span>
            <?php endif; ?>
          </td>
          <td class="align-middle text-center">
            <a href="index.php?halaman=showsiswa&id=<?= $d['idsiswa'] ?>" class="btn btn-success btn-xs"><i class="fas fa-eye"></i></a>
            <a href="index.php?halaman=editsiswa&id=<?= $d['idsiswa'] ?>" class="btn btn-info btn-xs"><i class="fas fa-edit"></i></a>
            <a href="proses/prosespasien.php?hapus_siswa=<?= $d['idsiswa'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('Hapus data siswa ini?')"><i class="fas fa-trash"></i></a>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>
</div></div>