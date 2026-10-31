<?php
// views/pasien/cetakkartu.php - LENGKAP
if(!isset($_SESSION['pasien'])){ header("Location: index.php?halaman=loginpasien"); exit(); }
$p = $_SESSION['pasien'];
?>
<div class="dash">
  <div class="content"><div class="container-fluid"><div class="row justify-content-center"><div class="col-md-6">
    <div class="kartu-uks">
      <div class="kartu-header"><i class="fas fa-heartbeat"></i> KARTU UKS DIGITAL <span>SMKN 1 KARANG BARU</span></div>
      <div class="kartu-body">
        <div><h4><?= htmlspecialchars($p['nama']) ?></h4><p style="margin:8px 0 0">NIS/NIP: <b><?= htmlspecialchars($p['nis']) ?></b><br>Kelas: <?= htmlspecialchars($p['kelas']) ?><br>Goldar: <b><?= htmlspecialchars($p['goldar']) ?></b></p><span class="badge-mint" style="margin-top:10px; display:inline-block">ANGGOTA UKS • AKTIF</span></div>
        <div class="qr-box"><img src="https://api.qrserver.com/v1/create-qr-code/?size=110x110&data=<?= urlencode($p['nis']) ?>"><small>SCAN DI UKS</small></div>
      </div>
    </div>
    <div class="text-center mt-3"><button onclick="window.print()" class="btn-toska"><i class="fas fa-print mr-1"></i> Cetak Kartu</button> <a href="index.php?halaman=dashboardpasien" class="btn-outline-bar">Kembali</a></div>
  </div></div></div></div>
</div>