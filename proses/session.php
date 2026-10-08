<?php
/*
|--------------------------------------------------------------------------
| INEDKS UTAMA SESSION
|--------------------------------------------------------------------------
*/
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/*
|--------------------------------------------------------------------------
| LOGIKA TIMEOUT GURU (Otomatis Keluar Setelah 1 Jam Pasif)
|--------------------------------------------------------------------------
*/
$timeout = 60 * 60; // 1 jam dalam satuan detik

if (isset($_SESSION['last_activity'])) {
    $selisihWaktu = time() - $_SESSION['last_activity'];

    if ($selisihWaktu > $timeout) {
        session_unset();
        session_destroy();
        // Alihkan ke form login dan beri notifikasi sesi berakhir
        header("Location: index.php?halaman=loginuser&pesan=timeout");
        exit;
    }
}

// Update waktu aktivitas terakhir user
$_SESSION['last_activity'] = time();


/*
|--------------------------------------------------------------------------
| FUNGSI SAKLAR PENGAMAN LOGIN & PEMBATAS ROLE (UKS DIGITAL)
|--------------------------------------------------------------------------
*/

/**
 * Saklar 1: Cek Status Login (Anti-Bypass URL)
 * Mencegah orang luar langsung masuk ke halaman internal tanpa login
 */
function cek_status_login() {
    if (!isset($_SESSION['iduser']) || !isset($_SESSION['role'])) {
        // Jika belum login, paksa keluar ke halaman login
        header("Location: index.php?halaman=loginuser&pesan=belum_login");
        exit;
    }
}

/**
 * Saklar 2: Pembatasan Hak Akses Role (Role Gate)
 * Memastikan Admin, Petugas, atau Anggota PMR tidak saling intip menu yang dilarang
 */
function batasi_akses_role($role_yang_diizinkan = []) {
    // Jalankan pengecekan login dasar terlebih dahulu
    cek_status_login();
    
    // Periksa apakah role user yang sedang aktif ada di daftar yang diizinkan
    if (!in_array($_SESSION['role'], $role_yang_diizinkan)) {
        // Jika mencoba mengakses menu terlarang, lempar otomatis ke error 403 (Forbidden)
        header("Location: index.php?halaman=403");
        exit;
    }
}
?>
