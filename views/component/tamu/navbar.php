<?php $hal = $_GET['halaman'] ?? 'home'; ?>

<!-- TOPBAR - VERSI BESAR + ANIMASI SHINE -->
<div class="topbar-uks">
    <div class="container d-flex justify-content-between align-items-center position-relative" style="z-index:2">
        <div class="d-flex align-items-center">
            <span class="mr-3 d-flex align-items-center justify-content-center" style="width:28px;height:28px;border-radius:8px;background:rgba(255,255,255,0.2);animation:beat 1.5s infinite"><i class="fas fa-heartbeat" style="color:#ccfbf1;font-size:14px"></i></span>
            <span style="font-size:14px; font-weight:800; letter-spacing:0.8px; text-transform:uppercase">Generasi Sehat, Masa Depan Hebat - UKS DIGITAL SMKN 1 KARANG BARU</span>
            <span class="badge ml-3 d-none d-lg-inline-flex align-items-center" style="background:rgba(255,255,255,0.18);color:white;border:1px solid rgba(255,255,255,0.2);border-radius:20px;font-size:10px"><span style="width:6px;height:6px;background:#2dd4bf;border-radius:50%;display:inline-block;margin-right:6px;animation:blink 1.5s infinite"></span>LIVE</span>
        </div>
        <div class="d-none d-md-flex align-items-center" style="font-size:12px; opacity:0.95; letter-spacing:0.3px">
            <span><i class="fas fa-map-marker-alt mr-1"></i> Aceh Tamiang</span>
            <span class="mx-2" style="opacity:0.4">|</span>
            <span><i class="fas fa-envelope mr-1"></i> uks@smkn1karangbaru.sch.id</span>
            <span class="ml-3 px-2 py-1" style="background:rgba(255,255,255,0.15);border-radius:20px;font-size:11px">0103786196 XI RPL 2</span>
        </div>
    </div>
</div>

<!-- NAVBAR PUTIH - TETAP VERSI KAMU + ANIMASI -->
<nav class="navbar navbar-expand-lg navbar-uks navbar-white bg-white shadow-sm" id="navbarUKS">
    <div class="container">
        <a href="index.php?halaman=home" class="navbar-brand d-flex align-items-center">
            <img src="assets/images/logouks.jpg" style="width:38px;height:38px;object-fit:cover" class="mr-2 rounded" onerror="this.src='assets/images/user/default.png'">
            <span style="color:var(--teal)">UKS</span>&nbsp;<span style="color:#0369a1">DIGITAL</span>
            <span class="ml-2 d-none d-md-inline badge" style="background:var(--mint);color:var(--teal);border-radius:20px;font-size:10px">v1.0</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" style="border:none;outline:none">
            <span style="width:32px;height:32px;border-radius:10px;background:var(--mint);display:flex;align-items:center;justify-content:center"><i class="fas fa-bars" style="color:var(--teal)"></i></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a href="index.php?halaman=home" class="nav-link <?= $hal=='home'?'active':'' ?>"><i class="fas fa-home mr-1"></i> Home</a></li>
                <li class="nav-item"><a href="index.php?halaman=cekriwayat" class="nav-link <?= $hal=='cekriwayat'?'active':'' ?>"><i class="fas fa-notes-medical mr-1"></i> Cek Riwayat</a></li>
                <li class="nav-item"><a href="index.php?halaman=daftarobat" class="nav-link <?= $hal=='daftarobat'?'active':'' ?>"><i class="fas fa-pills mr-1"></i> Daftar Obat</a></li>
                <li class="nav-item"><a href="index.php?halaman=daftarkategori" class="nav-link <?= $hal=='daftarkategori'?'active':'' ?>"><i class="fas fa-tags mr-1"></i> Kategori</a></li>
                <li class="nav-item"><a href="index.php?halaman=tentang" class="nav-link <?= $hal=='tentang'?'active':'' ?>"><i class="fas fa-heartbeat mr-1"></i> Tentang</a></li>
                <li class="nav-item"><a href="index.php?halaman=kontak" class="nav-link <?= $hal=='kontak'?'active':'' ?>"><i class="fas fa-phone-alt mr-1"></i> Kontak</a></li>
                <li class="nav-item"><a href="index.php?halaman=daftarisi" class="nav-link <?= $hal=='daftarisi'?'active':'' ?>"><i class="fas fa-list mr-1"></i> Daftar Isi</a></li>
            </ul>
            <a href="index.php?halaman=loginuser" class="btn rounded-pill px-4 font-weight-bold text-white pulse-btn" style="background:linear-gradient(90deg,#dc2626,#ef4444);box-shadow:0 6px 18px rgba(220,38,38,0.25)"><i class="fas fa-user-shield mr-1"></i> Login Petugas</a>
        </div>
    </div>
</nav>

<script>
// Navbar scroll mengecil + shadow - biar kayak aplikasi premium
window.addEventListener('scroll', function(){
  var nav=document.getElementById('navbarUKS');
  if(window.scrollY>60){ nav.classList.add('scrolled'); } else { nav.classList.remove('scrolled'); }
});
</script>
<style>
@keyframes beat{0%,100%{transform:scale(1)}50%{transform:scale(1.15)}}
@keyframes blink{0%,100%{opacity:1}50%{opacity:0.3}}
#heroCarousel .carousel-item{height:62vh; min-height:420px; background-size:cover; background-position:center top}
#heroCarousel .overlay{background: linear-gradient(180deg, rgba(0,0,0,0.08) 0%, rgba(0,0,0,0.40) 100%);}
</style>