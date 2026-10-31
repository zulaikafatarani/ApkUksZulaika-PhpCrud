<?php
// views/component/pasien/sidebarpasien.php - LENGKAP - Simpan di folder component/pasien/
$menu = [
  ['dashboardpasien', 'fas fa-home', 'Beranda Saya'],
  ['riwayatpasien', 'fas fa-file-medical', 'Riwayat Medis Saya'],
  ['cetakkartu', 'fas fa-id-card', 'Kartu UKS Saya'],
  ['ubahpassword', 'fas fa-lock', 'Ubah Password'],
];
$hal = $_GET['halaman'] ?? '';
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background:linear-gradient(180deg,#064e3b,#0f766e)">
  <a href="index.php?halaman=dashboardpasien" class="brand-link" style="border-bottom:1px solid rgba(255,255,255,0.15)"><span class="brand-text font-weight-bold text-white">UKS DIGITAL</span></a>
  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex" style="border-bottom:1px solid rgba(255,255,255,0.15)"><div class="image"><img src="assets/images/siswa/default.png" class="img-circle elevation-2" width="40" height="40" style="object-fit:cover"></div><div class="info"><a href="#" class="d-block text-white"><?= htmlspecialchars($_SESSION['pasien']['nama'] ?? 'Pasien') ?></a><small class="text-white-50">PASIEN • <?= htmlspecialchars($_SESSION['pasien']['nis'] ?? '') ?></small></div></div>
    <nav class="mt-2"><ul class="nav nav-pills nav-sidebar flex-column">
      <?php foreach($menu as $m): ?><li class="nav-item"><a href="index.php?halaman=<?= $m[0] ?>" class="nav-link <?= $hal==$m[0]?'active':'' ?>" style="<?= $hal==$m[0]?'background:#14b8a6; color:white':'' ?>"><i class="nav-icon <?= $m[1] ?>"></i><p><?= $m[2] ?></p></a></li><?php endforeach; ?>
      <li class="nav-item"><a href="proses/prosespasien.php?aksi=logoutpasien" class="nav-link"><i class="nav-icon fas fa-sign-out-alt"></i><p>Keluar</p></a></li>
    </ul></nav>
  </div>
</aside>