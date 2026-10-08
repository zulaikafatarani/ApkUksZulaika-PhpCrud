<?php
// Wajib sertakan koneksi database dan pengaturan session pengaman
require_once 'koneksi.php';
require_once 'session.php';

// Pastikan file ini diproses hanya ketika form login mengirimkan data POST
if (isset($_POST['login'])) {
    
    // Amankan input data dari karakter aneh penyerangan SQL Injection
    $username = mysqli_real_escape_string($koneksi, trim($_POST['username']));
    $password = trim($_POST['password']); // Password mentah dari input form

    // Query untuk mencari akun user berdasarkan username yang dimasukkan
    $query  = "SELECT * FROM user WHERE username = '$username'";
    $runSql = mysqli_query($koneksi, $query);

    // Periksa apakah data usernamenya ditemukan di database
    if (mysqli_num_rows($runSql) === 1) {
        
        // Ambil baris data user tersebut
        $dataUser = mysqli_fetch_assoc($runSql);

        // Validasi Password (Bisa disesuaikan dengan password_verify jika di-hash, atau string match standar)
        // Di sini menggunakan string match standar '===' sesuai dengan query bawaan awal Anda
        if ($password === $dataUser['password']) {
            
            // JIKA COCOK, BUAT BERKAS TRACKING SESSION LOGIN NYA
            $_SESSION['iduser']        = $dataUser['iduser'];
            $_SESSION['username']      = $dataUser['username'];
            $_SESSION['namauser']      = $dataUser['namauser'];
            $_SESSION['role']          = $dataUser['role'];
            $_SESSION['foto']          = $dataUser['foto'];
            $_SESSION['last_activity'] = time(); // Set waktu awal aktivitas untuk fungsi timeout guru

            // Alihkan halaman dashboard secara otomatis berdasarkan role user yang login
            if ($dataUser['role'] === 'admin') {
                header("Location: ../index.php?halaman=dashboardadmin");
            } elseif ($dataUser['role'] === 'petugas') {
                header("Location: ../index.php?halaman=dashboardpetugas");
            } else {
                header("Location: ../index.php?halaman=dashboardanggota");
            }
            exit();

        }
    }

    // Jika username tidak ketemu ATAU password salah, tendang balik ke form login dan beri pesan gagal
    header("Location: ../index.php?halaman=loginuser&pesan=gagal");
    exit();

} else {
    // Jika ada yang mencoba mengakses file proses ini langsung via URL tanpa klik tombol login
    header("Location: ../index.php?halaman=403");
    exit();
}
?>
