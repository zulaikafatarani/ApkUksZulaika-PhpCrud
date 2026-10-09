<?php $hal = $_GET['halaman'] ?? 'home'; ?>
<nav class="navbar navbar-expand-lg navbar-white bg-white shadow-sm fixed-top">
    <div class="container">
        <a href="index.php?halaman=home" class="navbar-brand font-weight-bold">
            <img src="assets/images/logouks.jpg" style="width:32px;height:32px" class="mr-1" onerror="this.src='assets/images/user/default.png'">
            <span class="text-success">UKS</span> DIGITAL
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"><i class="fas fa-bars mt-1"></i></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a href="index.php?halaman=home" class="nav-link <?= $hal == 'home' ? 'active text-success font-weight-bold' : '' ?>"><i class="fas fa-home mr-1"></i> Home</a></li>
                <li class="nav-item"><a href="index.php?halaman=cekriwayat" class="nav-link <?= $hal == 'cekriwayat' ? 'active text-success font-weight-bold' : '' ?>"><i class="fas fa-notes-medical mr-1"></i> Cek Riwayat</a></li>
                <li class="nav-item"><a href="index.php?halaman=daftarobat" class="nav-link <?= $hal == 'daftarobat' ? 'active text-success font-weight-bold' : '' ?>"><i class="fas fa-pills mr-1"></i> Daftar Obat</a></li>
                <li class="nav-item"><a href="index.php?halaman=daftarkategori" class="nav-link <?= $hal == 'daftarkategori' ? 'active text-success font-weight-bold' : '' ?>"><i class="fas fa-tags mr-1"></i> Kategori</a></li>
                <li class="nav-item"><a href="index.php?halaman=tentang" class="nav-link <?= $hal == 'tentang' ? 'active text-success font-weight-bold' : '' ?>"><i class="fas fa-heartbeat mr-1"></i> Tentang</a></li>
                <li class="nav-item"><a href="index.php?halaman=kontak" class="nav-link <?= $hal == 'kontak' ? 'active text-success font-weight-bold' : '' ?>"><i class="fas fa-phone-alt mr-1"></i> Kontak</a></li>
                <!-- INI YANG HILANG DI SCREENSHOT KAMU -->
                <li class="nav-item"><a href="index.php?halaman=daftarisi" class="nav-link <?= $hal == 'daftarisi' ? 'active text-success font-weight-bold' : '' ?>"><i class="fas fa-list mr-1"></i> Daftar Isi</a></li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a href="index.php?halaman=loginuser" class="btn btn-danger rounded-pill px-3 font-weight-bold"><i class="fas fa-user-shield mr-1"></i> Login Petugas</a></li>
            </ul>
        </div>
    </div>
</nav>
<div style="height:76px;"></div> <!-- Spacer anti ketutup fixed-top -->