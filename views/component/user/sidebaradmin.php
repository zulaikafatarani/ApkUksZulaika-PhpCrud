<?php // WAJIB BARIS 1 PHP - FIX HEADER ADMIN 
$foto = htmlspecialchars($_SESSION['foto'] ?? 'default.png');
$nama = htmlspecialchars($_SESSION['namauser'] ?? 'Nama Admin');
$role = htmlspecialchars($_SESSION['role'] ?? 'ADMIN');
$hal = $halaman ?? '';
function active($hal, $keys){ return in_array($hal, (array)$keys) ? 'active' : ''; }
$menu = [
  ['header'=>'MENU UTAMA'],
  ['url'=>'dashboardadmin','icon'=>'fa-tachometer-alt','label'=>'Dashboard Utama','keys'=>['dashboardadmin']],
  ['header'=>'MANAJEMEN PENGURUS'],
  ['url'=>'user','icon'=>'fa-users-cog','label'=>'Kelola Akun Sistem','keys'=>['user','createuser','edituser','showuser']],
  ['header'=>'DATA MASTER'],
  ['url'=>'siswa','icon'=>'fa-user-graduate','label'=>'Master Data Siswa','keys'=>['siswa','createsiswa','editsiswa','showsiswa']],
  ['url'=>'guru','icon'=>'fa-chalkboard-teacher','label'=>'Master Data Guru','keys'=>['guru','createguru','editguru','showguru']],
  ['url'=>'kategori','icon'=>'fa-tags','label'=>'Kategori Obat','keys'=>['kategori','createkategori','editkategori','showkategori']],
  ['url'=>'barang','icon'=>'fa-pills','label'=>'Stok Obat & Alkes','keys'=>['barang','createbarang','editbarang','showbarang']],
  ['header'=>'PELAYANAN MEDIS'],
  ['url'=>'penanganan','icon'=>'fa-heartbeat','label'=>'Penanganan Pasien','keys'=>['penanganan','createpenanganan','editpenanganan','showpenanganan']],
  ['header'=>'REKAPITULASI'],
  ['url'=>'laporanharian','icon'=>'fa-file-medical-alt','label'=>'Cetak Laporan UKS','keys'=>['laporanharian','laporanbulanan','laporantahunan']],
  ['header'=>'SISTEM'],
];
?>

<div class="float-orb-sidebar" style="width:180px;height:180px;top:10%;right:-40px"></div>
<div class="float-orb-sidebar" style="width:120px;height:120px;bottom:20%;left:-30px; animation-delay:2s"></div>

<aside class="main-sidebar sidebar-dark-teal elevation-4">
    <a href="index.php?halaman=dashboardadmin" class="brand-link">
      <span class="brand-text"><i class="fas fa-heartbeat mr-2" style="color:#5eead4"></i> UKS DIGITAL</span>
      <small class="d-block" style="color:#99f6e0; font-size:10px; letter-spacing:0.5px; margin-top:2px; font-weight:600">SMKN 1 KARANG BARU • 0103786196</small>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image"><img src="assets/images/user/<?= $foto ?>" class="img-circle elevation-2" alt="Foto Admin" style="width:42px;height:42px;object-fit:cover" onerror="this.src='assets/images/user/default.png'"></div>
            <div class="info ml-2"><a href="#" class="d-block font-weight-bold text-white" style="font-size:14px"><?= $nama ?></a><small class="text-uppercase font-weight-bold" style="font-size:10px; color:#5eead4; letter-spacing:1px"><i class="fas fa-user-shield mr-1"></i> <?= $role ?> • ONLINE</small><br><span class="badge mt-1 px-2 py-1" style="background:rgba(94,234,212,0.15);color:#ccfbf1;border-radius:20px;font-size:9px;border:1px solid rgba(94,234,212,0.25)">ADMIN • FULL AKSES</span></div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <?php foreach($menu as $m): ?>
                  <?php if(isset($m['header'])): ?>
                    <li class="nav-header"><i class="fas fa-minus mr-1" style="font-size:8px"></i> <?= $m['header'] ?></li>
                  <?php else: ?>
                    <li class="nav-item"><a href="index.php?halaman=<?= $m['url'] ?>" class="nav-link <?= active($hal, $m['keys']) ?>"><i class="nav-icon fas <?= $m['icon'] ?>"></i><p><?= $m['label'] ?></p><?php if(active($hal,$m['keys'])): ?><i class="fas fa-chevron-right ml-auto" style="font-size:10px; opacity:0.8"></i><?php endif; ?></a></li>
                  <?php endif; ?>
                <?php endforeach; ?>
                <li class="nav-item mt-2"><a href="proses/proseslogout.php" class="nav-link" style="background:rgba(220,38,38,0.1); color:#fecaca !important; border:1px solid rgba(248,113,113,0.2)" onclick="return confirm('Yakin ingin keluar? Sesi 1 jam akan berakhir')"><i class="nav-icon fas fa-power-off" style="color:#fca5a5 !important"></i><p>Keluar Aplikasi</p></a></li>
                <li class="nav-item mt-4 text-center"><small style="color:#5eead4; font-size:10px; opacity:0.7; line-height:1.5">UKS Digital v1.0<br>ERD 7 Entitas FIX<br>0103786196 XI RPL 2<br>Gedung C Lt.1 Sebelah Lab RPL</small></li>
            </ul>
        </nav>
    </div>
</aside>