<?php
ob_start(); // FIX WAJIB BARIS 1 - ANTI Cannot modify header information
// Memuat pondasi database dan pengaman session
require_once 'proses/koneksi.php';
require_once 'proses/session.php';

$halaman = $_GET['halaman'] ?? 'home';

// Daftar halaman sesuai treediagram
$authPages = ['loginuser'];
$landingPages = ['home','cekriwayat','daftarobat','detailobat','daftarkategori','detailkategori','tentang','kontak','daftarisi'];
$isPublic = in_array($halaman, $authPages) || in_array($halaman, $landingPages) || $halaman === 'logout';

/*
|[STRIPPED 74 bytes]
| ZONA PUBLIC - TIDAK PAKAI ADMINLTE LAYOUT (ANTI KEDIP)
|[STRIPPED 74 bytes]
*/
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
        $file = in_array($halaman, $authPages) ? "views/auth/{$halaman}.php" : "views/landing/{$halaman}.php";
        if (file_exists($file)) {
            include $file;
        } else {
            include 'views/errors/404.php';
        }
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
/*
|[STRIPPED 74 bytes]
| ZONA INTERNAL PENGURUS UKS - PAKAI ADMINLTE
|[STRIPPED 74 bytes]
*/
} else {

    // Cek login dulu SEBELUM load header/sidebar!
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

    // Sidebar sesuai role - sekarang aman karena ob_start di atas
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
            case 'dashboardadmin':
                batasi_akses_role(['admin']);
                include 'views/user/dashboard/dashboardadmin.php'; break;
            case 'dashboardpetugas':
                batasi_akses_role(['admin','petugas']);
                include 'views/user/dashboard/dashboardpetugas.php'; break;
            case 'dashboardanggota':
                batasi_akses_role(['admin','petugas','anggota']);
                include 'views/user/dashboard/dashboardanggota.php'; break;

            case 'user': 
                batasi_akses_role(['admin']);
                include 'views/user/user/index.php'; break;
            case 'createuser': include 'views/user/user/create.php'; break;
            case 'edituser': include 'views/user/user/edit.php'; break;
            case 'showuser': include 'views/user/user/show.php'; break;

            case 'siswa': 
                batasi_akses_role(['admin','petugas','anggota']);
                include 'views/user/siswa/index.php'; break;
            case 'createsiswa': include 'views/user/siswa/create.php'; break;
            case 'editsiswa': include 'views/user/siswa/edit.php'; break;
            case 'showsiswa': include 'views/user/siswa/show.php'; break;

            case 'guru': 
                batasi_akses_role(['admin','petugas']);
                include 'views/user/guru/index.php'; break;
            case 'createguru': include 'views/user/guru/create.php'; break;
            case 'editguru': include 'views/user/guru/edit.php'; break;
            case 'showguru': include 'views/user/guru/show.php'; break;

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
            case 'editpenanganan': include 'views/user/penanganan/edit.php'; break;
            case 'showpenanganan': include 'views/user/penanganan/show.php'; break;

            case 'laporanharian': 
                batasi_akses_role(['admin','petugas']);
                include 'views/user/laporan/laporanharian.php'; break;
            case 'cetaklaporanharian': include 'views/user/laporan/cetaklaporanharian.php'; break;
            case 'laporanbulanan': include 'views/user/laporan/laporanbulanan.php'; break;
            case 'cetaklaporanbulanan': include 'views/user/laporan/cetaklaporanbulanan.php'; break;
            case 'laporantahunan': include 'views/user/laporan/laporantahunan.php'; break;
            case 'cetaklaporantahunan': include 'views/user/laporan/cetaklaporantahunan.php'; break;

            default: include 'views/errors/404.php'; break;
        }
        ?>
    </div>
</div>
<?php include 'views/component/footerjs.php'; ?>
</body>
        ?>
    </div> <!-- tutup .content-wrapper -->

    <?php 
    // FOOTER USER - ini yang bikin hilang di screenshot kamu
    include 'views/component/user/footer.php'; 
    ?>

</div> <!-- tutup .wrapper yang dibuka di navbar.php -->

<?php include 'views/component/footerjs.php'; ?>
</body>
</html>
<?php 
ob_end_flush();
} 
?>