<!-- Navbar Internal Pengurus UKS - VERSI TOSKA MENARI ANTI KETUTUP -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background:rgba(255,255,255,0.94) !important; backdrop-filter:blur(12px); border-bottom:1px solid #ccfbf1; box-shadow:0 8px 30px rgba(15,118,110,0.07); position:sticky; top:0; z-index:1038; transition:all .35s">
    <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" data-widget="pushmenu" href="#" role="button" style="color:var(--teal); background:var(--mint2); border:1px solid #ccfbf1; border-radius:10px; width:38px; height:38px; display:flex; align-items:center; justify-content:center; margin-right:8px; transition:all .35s; position:relative; z-index:20; pointer-events:auto"><i class="fas fa-bars"></i></a></li>
    </ul>


    <ul class="navbar-nav">
        <li class="nav-item d-none d-sm-inline-block">
            <a href="index.php?halaman=createpenanganan" class="nav-link nav-link-pengurus"><i class="fas fa-plus-circle mr-1" style="color:var(--teal)"></i> Penanganan Medis</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="index.php?halaman=barang" class="nav-link nav-link-pengurus"><i class="fas fa-pills mr-1" style="color:#0369a1"></i> Stok Obat & Alkes</a>
        </li>

        <?php if (($_SESSION['role'] ?? '') === 'admin' || ($_SESSION['role'] ?? '') === 'petugas'): ?>
        <li class="nav-item dropdown rekap-dropdown">
            <a class="nav-link" href="#" style="cursor:pointer">
                <i class="fas fa-file-medical-alt mr-1" style="color:var(--teal)"></i> Rekap Laporan <i class="fas fa-caret-down ml-1" style="font-size:10px; opacity:0.7"></i>
            </a>
            <div class="dropdown-menu shadow border-0">
                <a href="index.php?halaman=laporanharian&tgl=<?= date('Y-m-d') ?>" class="dropdown-item shimmer">
                    <i class="fas fa-calendar-day mr-2" style="color:var(--teal)"></i> Laporan Harian
                </a>
                <a href="index.php?halaman=laporanbulanan&bulan=<?= date('m') ?>&tahun=<?= date('Y') ?>" class="dropdown-item">
                    <i class="fas fa-calendar-alt mr-2" style="color:#0369a1"></i> Laporan Bulanan
                </a>
                <a href="index.php?halaman=laporantahunan&tahun=<?= date('Y') ?>" class="dropdown-item">
                    <i class="fas fa-chart-line mr-2" style="color:var(--teal2)"></i> Laporan Tahunan
                </a>
                <div class="dropdown-divider" style="border-color:#e0f2f1"></div>
                <small class="px-3 py-1 d-block" style="color:#64748b; font-size:11px"><i class="fas fa-shield-alt mr-1" style="color:var(--teal)"></i> Akses: admin & petugas medis • 0103786196</small>
            </div>
        </li>
        <?php endif; ?>
    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-toggle="dropdown">
                <img src="assets/images/user/<?= htmlspecialchars($_SESSION['foto'] ?? 'default.png') ?>" class="user-image img-circle elevation-1" style="width:32px;height:32px; object-fit:cover" onerror="this.src='assets/images/user/default.png'">
                <span class="d-none d-md-inline ml-2 text-dark font-weight-bold" style="font-size:13px"><?= htmlspecialchars($_SESSION['namauser'] ?? 'Buk Ely') ?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right shadow border-0" style="border-radius:14px; border:1px solid #e0f2f1 !important; overflow:hidden; min-width:280px; z-index:1060; padding:0">
                <li class="user-header text-white" style="background:linear-gradient(135deg, var(--dark), var(--teal)); padding:20px">
                    <img src="assets/images/user/<?= htmlspecialchars($_SESSION['foto'] ?? 'default.png') ?>" class="img-circle elevation-2" style="border:3px solid #5eead4; width:70px; height:70px; object-fit:cover" onerror="this.src='assets/images/user/default.png'">
                    <p style="color:#ccfbf1; margin-top:10px; font-weight:700"><?= htmlspecialchars($_SESSION['namauser'] ?? 'Pengurus') ?><small class="d-block mt-1" style="color:#5eead4; font-weight:600">Role: <?= strtoupper(htmlspecialchars($_SESSION['role'] ?? '')) ?> • 0103786196 XI RPL 2</small></p>
                </li>
                <li class="user-footer d-flex justify-content-between align-items-center p-3" style="background:var(--mint2)">
                    <span class="badge px-3 py-2" style="background:var(--mint); color:var(--teal); border-radius:20px; border:1px solid #99f6e0; font-weight:700"><i class="fas fa-user-shield mr-1"></i> <?= strtoupper(htmlspecialchars($_SESSION['role'] ?? 'PMR')) ?></span>
                    <a href="proses/proseslogout.php" class="btn btn-sm rounded-pill" style="background:#fee2e2; color:#dc2626; border:1px solid #fecaca; font-weight:700" onclick="return confirm('Yakin logout?')"><i class="fas fa-sign-out-alt mr-1"></i> LOGOUT</a>
                </li>
                <li class="p-2 text-center"><small class="text-muted" style="font-size:10px">UKS Digital v1.0 • ERD 7 Entitas FIX • <?= date('d/m/Y H:i') ?> • Anti Ketutup Sidebar</small></li>
            </ul>
        </li>
    </ul>
    <div class="float-orb-nav" style="width:70px;height:70px;top:-10px;right:15%; opacity:0.6"></div>
</nav>