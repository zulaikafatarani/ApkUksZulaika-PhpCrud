<?php
// views/component/pasien/navbar.php - LENGKAP
?>
<nav class="main-header navbar navbar-expand navbar-light" style="background:white; border-bottom:2px solid var(--mint)">
  <ul class="navbar-nav"><li class="nav-item"><a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars" style="color:var(--teal)"></i></a></li></ul>
  <ul class="navbar-nav ml-auto"><li class="nav-item"><span class="nav-link font-weight-bold" style="color:var(--teal)"><i class="fas fa-heartbeat mr-1"></i> UKS DIGITAL • PASIEN • <?= htmlspecialchars($_SESSION['pasien']['nama'] ?? '') ?></span></li><li class="nav-item"><a href="proses/prosespasien.php?aksi=logoutpasien" class="nav-link" style="color:#dc2626"><i class="fas fa-sign-out-alt"></i> Keluar</a></li></ul>
</nav>