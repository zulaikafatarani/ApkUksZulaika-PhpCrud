<?php $hal = $_GET['halaman'] ?? 'home'; ?>
<style>
:root{ --teal:#0f766e; --teal2:#14b8a6; --mint:#ccfbf1; --dark:#064e3b; }
/* TOPBAR ANIMASI */
.topbar-uks{background:linear-gradient(90deg,var(--dark),var(--teal),var(--teal2)); background-size:200% 100%; color:white; padding:10px 0; position:relative; overflow:hidden; animation:gradMove 8s ease infinite}
@keyframes gradMove{0%{background-position:0% 50%}50%{background-position:100% 50%}100%{background-position:0% 50%}}
.topbar-uks::before{content:''; position:absolute; top:0; left:-100%; width:100%; height:100%; background:linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent); animation:shine 4s infinite}
@keyframes shine{0%{left:-100%}100%{left:100%}}
.topbar-text{font-size:14px; font-weight:800; letter-spacing:0.8px; text-transform:uppercase; animation:slideLeft 20s linear infinite; white-space:nowrap}
@keyframes slideLeft{0%{transform:translateX(0)}100%{transform:translateX(-10px)}}

/* NAVBAR ANIMASI */
.navbar-uks{ min-height:72px; background:rgba(255,255,255,0.95) !important; backdrop-filter:blur(12px); border-bottom:1px solid #e0f2f1; transition:all .4s; position:sticky; top:0; z-index:1030}
.navbar-uks.scrolled{box-shadow:0 10px 40px rgba(15,118,110,0.1); min-height:64px}
.navbar-uks .navbar-brand{font-weight:800; letter-spacing:-0.5px; transition:.3s}
.navbar-uks .navbar-brand:hover{transform:scale(1.05)}
.navbar-uks .navbar-brand img{transition:transform .6s}
.navbar-uks .navbar-brand:hover img{transform:rotate(15deg) scale(1.1)}
.navbar-uks .nav-link{position:relative; font-weight:600; font-size:14px; color:#475569 !important; padding:8px 14px !important; margin:0 2px; border-radius:30px; transition:all .3s}
.navbar-uks .nav-link::after{content:''; position:absolute; bottom:2px; left:50%; width:0; height:2.5px; background:linear-gradient(90deg,var(--teal),var(--teal2)); border-radius:2px; transition:all .3s; transform:translateX(-50%)}
.navbar-uks .nav-link:hover::after, .navbar-uks .nav-link.active::after{width:60%}
.navbar-uks .nav-link:hover{color:var(--teal) !important; background:var(--mint2)}
.navbar-uks .nav-link.active{background:var(--mint); color:var(--teal) !important; font-weight:800}
.pulse-btn{position:relative; overflow:hidden; animation:pulseBtn 2.5s infinite}
@keyframes pulseBtn{0%{box-shadow:0 0 0 0 rgba(220,38,38,0.4)}70%{box-shadow:0 0 0 12px rgba(220,38,38,0)}100%{box-shadow:0 0 0 0 rgba(220,38,38,0)}}
</style>

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