<?php
ob_start();
require_once 'proses/koneksi.php';
require_once 'proses/session.php';

$halaman = $_GET['halaman'] ?? 'home';

// === DAFTAR HALAMAN SESUAI TREE DIAGRAM ===
$authPages = ['loginuser'];
$landingPages = ['home','daftarobat','detailobat','daftarkategori','detailkategori','tentang','kontak','daftarisi'];
$pasienPublicPages = ['loginpasien']; // Belum login, tapi bukan pengurus - pakai navbar tamu
$pasienPages = ['dashboardpasien','riwayatpasien','ubahpassword','cetakkartu']; // Sudah login pasien - pakai sidebar pasien

$isPublic = in_array($halaman, $authPages) || in_array($halaman, $landingPages) || $halaman === 'logout' || in_array($halaman, $pasienPublicPages);

// ============================================================
// ZONA 1: PUBLIC + LOGIN PASIEN - TIDAK PAKAI ADMINLTE SIDEBAR
// ============================================================
if ($isPublic) {
    include 'views/component/header.php';
?>
<body class="bg-light">
    <?php
    if ($halaman === 'logout') {
        include 'views/auth/logout.php';
    } else {
        include 'views/component/tamu/navbar.php';
        echo '<main class="content">';
        if (in_array($halaman, $authPages)) {
            $file = "views/auth/{$halaman}.php";
        } elseif (in_array($halaman, $pasienPublicPages)) {
            $file = "views/pasien/{$halaman}.php";
        } else {
            $file = "views/landing/{$halaman}.php";
        }
        if (file_exists($file)) include $file; else include 'views/errors/404.php';
        echo '</main>';
        include 'views/component/tamu/footer.php';
    }
    ?>
<?php include 'views/component/footerjs.php'; ?>
</body>
</html>
<?php
    ob_end_flush();
    exit;
}

// ============================================================
// ZONA 2: PASIEN SUDAH LOGIN - PAKAI SIDEBAR PASIEN (BUKAN ADMIN)
// ============================================================
if (in_array($halaman, $pasienPages)) {
    if (!isset($_SESSION['pasien'])) {
        header("Location: index.php?halaman=loginpasien&pesan=login_dulu");
        exit();
    }
    include 'views/component/header.php';
?>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <?php
    include 'views/component/pasien/navbar.php';
    include 'views/component/pasien/sidebarpasien.php';
    ?>
    <div class="content-wrapper">
        <?php
        switch ($halaman) {
            case 'dashboardpasien': include 'views/pasien/dashboardpasien.php'; break;
            case 'riwayatpasien': include 'views/pasien/riwayatpasien.php'; break;
            case 'ubahpassword': include 'views/pasien/ubahpassword.php'; break;
            case 'cetakkartu': include 'views/pasien/cetakkartu.php'; break;
        }
        ?>
    </div>
    <?php include 'views/component/pasien/footer.php'; ?>
</div>
<?php include 'views/component/footerjs.php'; ?>
</body>
</html>
<?php
    ob_end_flush();
    exit;
}

// ============================================================
// ZONA 3: INTERNAL PENGURUS - PAKAI ADMINLTE + SIDEBAR SESUAI ROLE
// ============================================================
if (!isset($_SESSION['iduser'])) {
    header("Location: index.php?halaman=loginuser&pesan=akses_ditolak");
    exit();
}
include 'views/component/header.php';
?>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <?php
    include 'views/component/user/navbar.php';
    if ($_SESSION['role'] === 'admin') {
        include 'views/component/user/sidebaradmin.php';
    } elseif ($_SESSION['role'] === 'petugas') {
        include 'views/component/user/sidebarpetugas.php';
    } else {
        include 'views/component/user/sidebaranggota.php';
    }
    ?>
    <div class="content-wrapper">
        <?php
        switch ($halaman) {
            case 'dashboardadmin': batasi_akses_role(['admin']); include 'views/user/dashboard/dashboardadmin.php'; break;
            case 'dashboardpetugas': batasi_akses_role(['admin','petugas']); include 'views/user/dashboard/dashboardpetugas.php'; break;
            case 'dashboardanggota': batasi_akses_role(['admin','petugas','anggota']); include 'views/user/dashboard/dashboardanggota.php'; break;
            case 'user': batasi_akses_role(['admin']); include 'views/user/user/index.php'; break;
            case 'createuser': include 'views/user/user/create.php'; break;
            case 'edituser': include 'views/user/user/edit.php'; break;
            case 'showuser': include 'views/user/user/show.php'; break;
            case 'siswa': batasi_akses_role(['admin','petugas','anggota']); include 'views/user/siswa/index.php'; break;
            case 'createsiswa': include 'views/user/siswa/create.php'; break;
            case 'editsiswa': include 'views/user/siswa/edit.php'; break;
            case 'showsiswa': include 'views/user/siswa/show.php'; break;
            case 'cetakkartusiswa': include 'views/user/siswa/cetakkartu.php'; break;
            case 'guru': batasi_akses_role(['admin','petugas']); include 'views/user/guru/index.php'; break;
            case 'createguru': include 'views/user/guru/create.php'; break;
            case 'editguru': include 'views/user/guru/edit.php'; break;
            case 'showguru': include 'views/user/guru/show.php'; break;
            case 'cetakkartuguru': include 'views/user/guru/cetakkartu.php'; break;
            case 'kategori': include 'views/user/kategori/index.php'; break;
            case 'createkategori': include 'views/user/kategori/create.php'; break;
            case 'editkategori': include 'views/user/kategori/edit.php'; break;
            case 'showkategori': include 'views/user/kategori/show.php'; break;
            case 'barang': include 'views/user/barang/index.php'; break;
            case 'createbarang': include 'views/user/barang/create.php'; break;
            case 'editbarang': include 'views/user/barang/edit.php'; break;
            case 'showbarang': include 'views/user/barang/show.php'; break;

case 'penanganan': include 'views/user/penanganan/index.php'; break;
case 'createpenanganan': include 'views/user/penanganan/create.php'; break;
case 'showpenanganan': include 'views/user/penanganan/show.php'; break;
case 'editpenanganan': include 'views/user/penanganan/edit.php'; break;
case 'cetaksurat': include 'views/user/penanganan/cetaksurat.php'; break; 


            case 'laporanharian': batasi_akses_role(['admin','petugas']); include 'views/user/laporan/laporanharian.php'; break;
            case 'cetaklaporanharian': include 'views/user/laporan/cetaklaporanharian.php'; break;
            case 'laporanbulanan': include 'views/user/laporan/laporanbulanan.php'; break;
            case 'cetaklaporanbulanan': include 'views/user/laporan/cetaklaporanbulanan.php'; break;
            case 'laporantahunan': include 'views/user/laporan/laporantahunan.php'; break;
            case 'cetaklaporantahunan': include 'views/user/laporan/cetaklaporantahunan.php'; break;
            default: include 'views/errors/404.php'; break;
        }
        ?>
    </div>
    <?php include 'views/component/user/footer.php'; ?>
</div>
<?php include 'views/component/footerjs.php'; ?>
</body>
</html>
<?php ob_end_flush(); ?>