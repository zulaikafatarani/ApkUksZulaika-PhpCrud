<?php
// views/pasien/dashboardpasien.php - LENGKAP - FIX p.tanggal -> p.tanggalpenanganan
if(!isset($_SESSION['pasien'])){ header("Location: index.php?halaman=loginpasien"); exit(); }
$p = $_SESSION['pasien'];
$nis = mysqli_real_escape_string($koneksi, $p['nis']);
if($p['jenis']=='siswa'){
  $qS = mysqli_query($koneksi, "SELECT idsiswa FROM siswa WHERE nis='$nis' LIMIT 1");
  $dS = mysqli_fetch_assoc($qS); $idsiswa = (int)($dS['idsiswa'] ?? 0);
  $where = "p.idsiswa=$idsiswa";
} else {
  $qG = mysqli_query($koneksi, "SELECT idguru FROM guru WHERE nip='$nis' LIMIT 1");
  $dG = mysqli_fetch_assoc($qG); $idguru = (int)($dG['idguru'] ?? 0);
  $where = "p.idguru=$idguru";
}
$qTotal = mysqli_query($koneksi, "SELECT * FROM penanganan p WHERE $where");
$total = mysqli_num_rows($qTotal);
$q = mysqli_query($koneksi, "SELECT p.* FROM penanganan p WHERE $where ORDER BY p.tanggalpenanganan DESC LIMIT 3");
?>
<div class="dash">
  <div class="content-header"><div class="container-fluid"><div class="row mb-2 align-items-center">
    <div class="col-sm-7"><h1 class="m-0 font-weight-bold" style="color:var(--dark)"><i class="fas fa-home mr-2" style="color:var(--teal)"></i> Halo, <?= htmlspecialchars($p['nama']) ?>!</h1><small class="text-muted">NIS/NIP: <b style="color:var(--teal)"><?= htmlspecialchars($p['nis']) ?></b> • Kelas: <?= htmlspecialchars($p['kelas']) ?> • Goldar: <?= htmlspecialchars($p['goldar']) ?></small></div>
    <div class="col-sm-5 text-right"><a href="index.php?halaman=cetakkartu" class="btn-toska"><i class="fas fa-id-card mr-1"></i> Cetak Kartu Saya</a></div>
  </div></div></div>
  <div class="content"><div class="container-fluid">
    <?php if(isset($_GET['sukses'])): ?><div class="alert alert-success">Password berhasil diubah!</div><?php endif; ?>
    <div class="row">
      <div class="col-md-4"><div class="uk-card-bar p-4 text-center"><h2 style="color:var(--teal); font-size:42px; margin:0"><?= $total ?></h2><p class="text-muted mb-0">Total Kunjungan Ke UKS</p><a href="index.php?halaman=riwayatpasien" class="btn-toska mt-3" style="padding:8px 18px; font-size:13px">Lihat Semua Riwayat</a></div></div>
      <div class="col-md-8"><div class="uk-card-bar"><div class="header-bar"><h6 class="font-weight-bold mb-0"><i class="fas fa-history mr-2" style="color:var(--teal)"></i> Kunjungan Terakhir Kamu</h6><span class="badge-mint">3 Terakhir</span></div><div class="p-3">
        <?php if($total==0): ?><p class="text-muted mb-0">Belum pernah ke UKS. Sehat terus ya!</p><?php endif; ?>
        <?php while($r=mysqli_fetch_assoc($q)): ?><div class="mb-2 pb-2" style="border-bottom:1px solid #f0fdfa"><b><?= date('d/m/Y', strtotime($r['tanggalpenanganan'])) ?></b> - <?= htmlspecialchars($r['keluhan']) ?><br><small class="text-muted">Tindakan: <?= htmlspecialchars($r['tindakan']) ?> • Status: <?= htmlspecialchars($r['statuspasien'] ?? '-') ?></small></div><?php endwhile; ?>
      </div></div></div>
    </div>
  </div></div>
</div>