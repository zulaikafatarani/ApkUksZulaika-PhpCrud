<?php
// proses/proseslogout.php - ANTI WHITE SCREEN
// BARIS 1 HARUS LANGSUNG <?php TANPA SPASI
ob_start();
session_start();
$_SESSION = [];
session_unset();
session_destroy();
ob_end_clean();

// Kembali ke Homepage Landing yang ada di index.php utama
// Struktur kamu: aplikasiuksdigital/index.php = home
header("Location: ../index.php");
exit();
?>