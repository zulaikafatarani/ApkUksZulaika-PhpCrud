<?php
// views/user/user/show.php - DETAIL PENGURUS V2
batasi_akses_role(['admin']);
if (!isset($koneksi)) include __DIR__.'/../../../proses/koneksi.php';

$id = (int)($_GET['id'] ?? 0);
$data = mysqli_query($koneksi, "SELECT * FROM user WHERE iduser=$id");
$u = mysqli_fetch_assoc($data);

if(!$u){
  echo '<div class="content"><div class="container-fluid"><div class="alert alert-danger">User ID '.$id.' tidak ada di database!</div><a href="index.php?halaman=user" class="btn btn-secondary">Kembali</a></div></div>';
  return;
}
$foto = 'assets/images/user/'.($u['foto'] ?: 'default.png');
if(!file_exists($foto)) $foto='assets/images/user/default.png';
$role = strtolower($u['role']);
?>
<div class="content-header"><div class="container-fluid"><h3 class="font-weight-bold text-success"><i class="fas fa-id-card"></i> Detail Pengurus</h3></div></div>
<div class="content"><div class="container-fluid">
<div class="row">
  <div class="col-md-4">
    <div class="card card-success card-outline text-center shadow">
      <div class="card-body">
        <img src="<?= $foto ?>" width="130" height="130" class="img-circle elevation-2 mb-3" style="object-fit:cover;border:3px solid #28a745" onerror="this.src='assets/images/user/default.png'">
        <h4 class="font-weight-bold"><?= htmlspecialchars($u['namauser']) ?></h4>
        <p class="text-muted">@<?= htmlspecialchars($u['username']) ?></p>
        <span class="badge badge-<?= $role=='admin'?'danger':($role=='petugas'?'info':'warning') ?> px-3 py-2"><?= strtoupper($u['role']) ?></span>
        <hr>
        <a href="index.php?halaman=edituser&id=<?= $u['iduser'] ?>" class="btn btn-info btn-sm btn-block"><i class="fas fa-edit"></i> Edit Data</a>
        <a href="index.php?halaman=user" class="btn btn-secondary btn-sm btn-block">Kembali</a>
      </div>
    </div>
  </div>
  <div class="col-md-8">
    <div class="card shadow">
      <div class="card-header bg-success text-white"><i class="fas fa-info-circle"></i> Data Lengkap Yang Telah Diinput</div>
      <div class="card-body p-0">
        <table class="table table-bordered mb-0">
          <tr><th width="30%">ID User</th><td><?= $u['iduser'] ?></td></tr>
          <tr><th>Nama Lengkap</th><td><b><?= htmlspecialchars($u['namauser']) ?></b></td></tr>
          <tr><th>Username</th><td>@<?= htmlspecialchars($u['username']) ?></td></tr>
          <tr><th>Password</th><td><code>*** terenkripsi ***</code></td></tr>
          <tr><th>Role / Hak Akses</th><td><?= strtoupper($u['role']) ?> - <?php if($role=='admin') echo 'Admin bisa kelola semua'; elseif($role=='petugas') echo 'Petugas bisa kelola master & medis'; else echo 'Anggota hanya lihat & tangani pasien'; ?></td></tr>
          <tr><th>Foto File</th><td><?= htmlspecialchars($u['foto'] ?: 'default.png') ?></td></tr>
          <tr><th>Status</th><td><span class="badge badge-success">AKTIF</span> - Akun bisa dipakai login di halaman loginuser</td></tr>
        </table>
      </div>
    </div>
  </div>
</div>
</div></div>