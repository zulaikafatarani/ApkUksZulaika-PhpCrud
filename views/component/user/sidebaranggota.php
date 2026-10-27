<?php // <--- WAJIB BARIS 1 ADALAH PHP, BUKAN KOMEN HTML 
$foto = htmlspecialchars($_SESSION['foto'] ?? 'default.png');
$nama = htmlspecialchars($_SESSION['namauser'] ?? $_SESSION['nama'] ?? 'Anggota');
$role = htmlspecialchars($_SESSION['role'] ?? 'ANGGOTA');
$hal = $halaman ?? '';
function active($hal,$keys){ return in_array($hal,(array)$keys) ? 'active' : ''; }
$menu = [
  ['url'=>'dashboardanggota','icon'=>'fa-tachometer-alt','label'=>'Dashboard Anggota','keys'=>['dashboardanggota']],
  ['header'=>'DATA MASTER'],
  ['url'=>'siswa','icon'=>'fa-user-graduate','label'=>'Master Data Siswa','keys'=>['siswa','createsiswa','editsiswa','showsiswa']],
  ['url'=>'barang','icon'=>'fa-pills','label'=>'Stok Obat & Alkes','keys'=>['barang','createbarang','editbarang','showbarang']],
  ['header'=>'PELAYANAN UTAMA'],
  ['url'=>'penanganan','icon'=>'fa-heartbeat','label'=>'Penanganan Pasien','keys'=>['penanganan','createpenanganan','editpenanganan','showpenanganan']],
  ['header'=>'SISTEM'],
];
?>

<div class="float-orb-sidebar" style="width:160px;height:160px;top:12%;right:-35px"></div>
<div class="float-orb-sidebar" style="width:110px;height:110px;bottom:25%;left:-25px; animation-delay:2s"></div>

<aside class="main-sidebar sidebar-dark-teal elevation-4">
    <a href="index.php?halaman=dashboardanggota" class="brand-link">
      <span class="brand-text"><i class="fas fa-users mr-2" style="color:#5eead4"></i> UKS DIGITAL</span>
      <small class="d-block" style="color:#99f6e0; font-size:10px; letter-spacing:0.5px; margin-top:2px; font-weight:600">PMR ANGGOTA • 0103786196 • XI RPL 2</small>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image"><img src="assets/images/user/<?= $foto ?>" class="img-circle elevation-2" alt="Foto Anggota" style="width:42px;height:42px;object-fit:cover" onerror="this.src='assets/images/user/default.png'"></div>
            <div class="info ml-2"><a href="#" class="d-block font-weight-bold text-white" style="font-size:14px"><?= $nama ?></a><small class="text-uppercase font-weight-bold" style="font-size:10px; color:#5eead4; letter-spacing:1px"><i class="fas fa-user-friends mr-1"></i> <?= $role ?> • PMR</small><br><span class="badge mt-1 px-2 py-1" style="background:rgba(94,234,212,0.15);color:#ccfbf1;border-radius:20px;font-size:9px;border:1px solid rgba(94,234,212,0.25)"><i class="fas fa-eye mr-1"></i> READ + CREATE</span></div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <?php foreach($menu as $m): ?>
                  <?php if(isset($m['header'])): ?>
                    <li class="nav-header"><i class="fas fa-minus mr-1" style="font-size:8px"></i> <?= $m['header'] ?></li>
                  <?php else: ?>
                    <li class="nav-item"><a href="index.php?halaman=<?= $m['url'] ?>" class="nav-link <?= active($hal,$m['keys']) ?>"><i class="nav-icon fas <?= $m['icon'] ?>"></i><p><?= $m['label'] ?></p><?php if(active($hal,$m['keys'])): ?><i class="fas fa-chevron-right ml-auto" style="font-size:10px; opacity:0.8"></i><?php endif; ?></a></li>
                  <?php endif; ?>
                <?php endforeach; ?>
                <li class="nav-item mt-2"><a href="proses/proseslogout.php" class="nav-link" style="background:rgba(220,38,38,0.1); color:#fecaca !important; border:1px solid rgba(248,113,113,0.2)" onclick="return confirm('Yakin ingin keluar?')"><i class="nav-icon fas fa-power-off" style="color:#fca5a5 !important"></i><p>Keluar Aplikasi</p></a></li>
                <li class="nav-item mt-3 p-2 mx-2" style="background:rgba(204,251,241,0.08); border-radius:12px; border:1px dashed rgba(94,234,212,0.25)"><small style="color:#99f6e0; font-size:11px; line-height:1.6; display:block"><i class="fas fa-info-circle mr-1"></i> <b>Anggota PMR:</b><br>• Bisa lihat siswa & stok<br>• Bisa input penanganan<br>• Tidak bisa hapus master<br>Role: batasi_akses_role()</small></li>
                <li class="nav-item mt-3 text-center"><small style="color:#5eead4; font-size:10px; opacity:0.7">UKS Digital v1.0<br>PMR SMKN 1 Karang Baru<br>0103786196 XI RPL 2</small></li>
            </ul>
        </nav>
    </div>
</aside>