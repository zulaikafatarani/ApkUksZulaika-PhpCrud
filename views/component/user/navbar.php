<!-- Navbar Internal Pengurus UKS - FIX HAMBURGER FINAL - 0103786196 -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light" id="navbarUKS" style="background:rgba(255,255,255,0.96) !important; backdrop-filter:blur(12px); border-bottom:1px solid #ccfbf1; box-shadow:0 8px 30px rgba(15,118,110,0.07); position:sticky; top:0; z-index:9999">
    <ul class="navbar-nav">
        <li class="nav-item">
            <button type="button" id="btnHamburger" class="btn" style="color:var(--teal); background:var(--mint2); border:1px solid #ccfbf1; border-radius:10px; width:40px; height:40px; display:flex; align-items:center; justify-content:center; cursor:pointer"><i class="fas fa-bars"></i></button>
        </li>
    </ul>

    <ul class="navbar-nav ml-2">
        <li class="nav-item d-none d-md-inline-block">
            <a href="index.php?halaman=createpenanganan" class="nav-link" style="font-weight:600; color:var(--dark)"><i class="fas fa-plus-circle mr-1" style="color:var(--teal)"></i> Penanganan</a>
        </li>
        <li class="nav-item d-none d-md-inline-block">
            <a href="index.php?halaman=barang" class="nav-link" style="font-weight:600; color:var(--dark)"><i class="fas fa-pills mr-1" style="color:#0369a1"></i> Stok Obat</a>
        </li>
        <?php if (($_SESSION['role'] ?? '') === 'admin' || ($_SESSION['role'] ?? '') === 'petugas'): ?>
        <li class="nav-item dropdown d-none d-md-inline-block">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" style="font-weight:600"><i class="fas fa-file-medical-alt mr-1" style="color:var(--teal)"></i> Laporan</a>
            <div class="dropdown-menu" style="border-radius:14px; border:1px solid #e0f2f1">
                <a href="index.php?halaman=laporanharian&tgl=<?= date('Y-m-d') ?>" class="dropdown-item"><i class="fas fa-calendar-day mr-2"></i> Harian</a>
                <a href="index.php?halaman=laporanbulanan&bulan=<?= date('m') ?>&tahun=<?= date('Y') ?>" class="dropdown-item"><i class="fas fa-calendar-alt mr-2"></i> Bulanan</a>
                <a href="index.php?halaman=laporantahunan&tahun=<?= date('Y') ?>" class="dropdown-item"><i class="fas fa-chart-line mr-2"></i> Tahunan</a>
            </div>
        </li>
        <?php endif; ?>
    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-toggle="dropdown">
                <img src="assets/images/user/<?= htmlspecialchars($_SESSION['foto'] ?? 'default.png') ?>" class="img-circle" style="width:32px;height:32px; object-fit:cover" onerror="this.src='assets/images/user/default.png'">
                <span class="d-none d-md-inline ml-2 font-weight-bold" style="font-size:13px"><?= htmlspecialchars($_SESSION['namauser'] ?? 'Buk Ely') ?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-right" style="border-radius:14px; border:1px solid #e0f2f1; min-width:260px; padding:0; overflow:hidden">
                <li class="user-header text-white text-center" style="background:linear-gradient(135deg, var(--dark), var(--teal)); padding:20px">
                    <img src="assets/images/user/<?= htmlspecialchars($_SESSION['foto'] ?? 'default.png') ?>" class="img-circle" style="border:3px solid #5eead4; width:60px; height:60px; object-fit:cover" onerror="this.src='assets/images/user/default.png'">
                    <p class="mt-2 mb-0 font-weight-bold"><?= htmlspecialchars($_SESSION['namauser'] ?? 'Pengurus') ?><br><small style="color:#5eead4">Role: <?= strtoupper($_SESSION['role'] ?? '') ?> • 0103786196</small></p>
                </li>
                <li class="user-footer d-flex justify-content-between p-2" style="background:var(--mint2)">
                    <span class="badge" style="background:var(--mint); color:var(--teal); border-radius:20px; border:1px solid #99f6e0"><?= strtoupper($_SESSION['role'] ?? 'PMR') ?></span>
                    <a href="proses/proseslogout.php" class="btn btn-sm" style="background:#fee2e2; color:#dc2626; border-radius:20px" onclick="return confirm('Yakin logout?')"><i class="fas fa-sign-out-alt"></i> LOGOUT</a>
                </li>
            </ul>
        </li>
    </ul>
</nav>

<style>
/* FIX TOTAL HAMBURGER */
#navbarUKS{ position:sticky!important; top:0!important; z-index:9999!important }
#btnHamburger{ position:relative!important; z-index:10000!important; pointer-events:auto!important }
.main-sidebar{ z-index:9998!important; transition:all .3s ease!important }
@media (max-width:991px){
  .main-sidebar{ transform:translateX(-100%); position:fixed!important; height:100vh!important }
  body.sidebar-open .main-sidebar{ transform:translateX(0)!important; box-shadow:0 0 30px rgba(0,0,0,0.2) }
  body.sidebar-open::after{ content:''; position:fixed; top:0; left:0; right:0; bottom:0; background:rgba(0,0,0,0.4); z-index:9997 }
}
</style>

<script>
// HAMBURGER FIX FINAL - GAK PAKAI AdminLTE, MANUAL 100% JALAN
(function(){
  var btn = document.getElementById('btnHamburger');
  var body = document.body;
  var isOpen = false;
  
  function toggleSidebar(e){
    if(e) e.preventDefault();
    isOpen = !isOpen;
    if(isOpen){
      body.classList.add('sidebar-open');
      body.classList.remove('sidebar-collapse');
      body.classList.add('sidebar-is-opening');
    } else {
      body.classList.remove('sidebar-open');
      body.classList.remove('sidebar-is-opening');
      body.classList.add('sidebar-collapse');
    }
    console.log('Hamburger clicked, open:', isOpen);
  }
  
  if(btn){
    btn.addEventListener('click', toggleSidebar);
    btn.addEventListener('touchstart', toggleSidebar, {passive:false});
  }
  
  // Klik overlay untuk tutup sidebar di HP
  document.addEventListener('click', function(e){
    if(isOpen && !e.target.closest('.main-sidebar') && !e.target.closest('#btnHamburger')){
      if(body.classList.contains('sidebar-open')){
        toggleSidebar();
      }
    }
  });
})();
</script>