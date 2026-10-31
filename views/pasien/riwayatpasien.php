<?php
// views/pasien/riwayatpasien.php - LENGKAP - FIX p.tanggal -> p.tanggalpenanganan
if(!isset($_SESSION['pasien'])){ header("Location: index.php?halaman=loginpasien"); exit(); }
$p = $_SESSION['pasien']; $nis = mysqli_real_escape_string($koneksi, $p['nis']);
if($p['jenis']=='siswa'){
  $qS = mysqli_query($koneksi, "SELECT idsiswa FROM siswa WHERE nis='$nis' LIMIT 1");
  $dS = mysqli_fetch_assoc($qS); $where = "p.idsiswa=".(int)($dS['idsiswa'] ?? 0);
} else {
  $qG = mysqli_query($koneksi, "SELECT idguru FROM guru WHERE nip='$nis' LIMIT 1");
  $dG = mysqli_fetch_assoc($qG); $where = "p.idguru=".(int)($dG['idguru'] ?? 0);
}
$q = mysqli_query($koneksi, "SELECT p.*, b.namabarang FROM penanganan p LEFT JOIN detailpenanganan dp ON p.idpenanganan=dp.idpenanganan LEFT JOIN barang b ON dp.idbarang=b.idbarang WHERE $where ORDER BY p.tanggalpenanganan DESC");
?>
<div class="dash">
  <div class="content-header"><div class="container-fluid"><div class="row mb-2 align-items-center"><div class="col-sm-7"><h1 class="m-0 font-weight-bold" style="color:var(--dark)"><i class="fas fa-file-medical mr-2" style="color:var(--teal)"></i> Riwayat Medis Saya</h1><small class="text-muted">Halo <b style="color:var(--teal)"><?= htmlspecialchars($p['nama']) ?></b> • NIS/NIP <?= htmlspecialchars($p['nis']) ?></small></div><div class="col-sm-5 text-right"><a href="index.php?halaman=dashboardpasien" class="btn-toska"><i class="fas fa-arrow-left mr-1"></i> Kembali</a></div></div></div></div>
  <div class="content"><div class="container-fluid"><div class="uk-card-bar"><div class="header-bar"><h6 class="font-weight-bold mb-0">Riwayat Kunjungan UKS Kamu</h6><span class="badge-mint"><?= mysqli_num_rows($q) ?> Kunjungan</span></div><div class="table-responsive"><table class="table table-bar"><thead><tr><th>Tanggal</th><th>Keluhan</th><th>Tindakan</th><th>Obat</th><th>Status</th></tr></thead><tbody><?php if(mysqli_num_rows($q)==0): ?><tr><td colspan="5" class="text-center text-muted">Belum ada riwayat kunjungan.</td></tr><?php endif; ?><?php while($r=mysqli_fetch_assoc($q)): ?><tr><td><?= date('d/m/Y', strtotime($r['tanggalpenanganan'])) ?></td><td><b><?= htmlspecialchars($r['keluhan']) ?></b></td><td><?= htmlspecialchars($r['tindakan']) ?></td><td><?= htmlspecialchars($r['namabarang'] ?? '-') ?></td><td><span class="badge-mint"><?= htmlspecialchars($r['statuspasien'] ?? '-') ?></span></td></tr><?php endwhile; ?></tbody></table></div></div></div></div>
</div>