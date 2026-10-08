<?php
// Wajib sertakan berkas koneksi dan session pengaman
require_once 'koneksi.php';
require_once 'session.php';

// Kunci backend: Pastikan hanya Admin yang bisa mengeksekusi manipulasi data ini
batasi_akses_role(['admin']);

// Tangkap parameter aksi dari URL (?aksi=...)
$aksi = $_GET['aksi'] ?? '';

/*
====================================================================
1. PROSES TAMBAH DATA AKUN (INSERT)
====================================================================
*/
if ($aksi === 'tambah') {
    if (isset($_POST['simpan'])) {
        // Amankan data input dari penyerangan SQL Injection
        $namauser = mysqli_real_escape_string($koneksi, trim($_POST['namauser']));
        $username = mysqli_real_escape_string($koneksi, trim($_POST['username']));
        $password = trim($_POST['password']); 
        $role     = mysqli_real_escape_string($koneksi, $_POST['role']);
        
        // Logika Pengolahan File Foto
        $namaFotoBaru = 'default.png'; 
        if (!empty($_FILES['foto']['name'])) {
            $namaFile   = $_FILES['foto']['name'];
            $ukuranFile = $_FILES['foto']['size'];
            $errorFile  = $_FILES['foto']['error'];
            $tmpName    = $_FILES['foto']['tmp_name'];

            $ekstensiValid = ['jpg', 'jpeg', 'png'];
            $ekstensiFile  = explode('.', $namaFile);
            $ekstensiFile  = strtolower(end($ekstensiFile));

            if (in_array($ekstensiFile, $ekstensiValid) && $ukuranFile <= 2000000 && $errorFile === 0) {
                $namaFotoBaru = uniqid() . '.' . $ekstensiFile;
                move_uploaded_file($tmpName, '../assets/images/user/' . $namaFotoBaru);
            }
        }

        // Jalankan Query Simpan Data ke Tabel User
        $queryInsert = "INSERT INTO user (namauser, username, password, role, foto) 
                        VALUES ('$namauser', '$username', '$password', '$role', '$namaFotoBaru')";
        
        if (mysqli_query($koneksi, $queryInsert)) {
            header("Location: ../index.php?halaman=user&status=sukses_tambah");
        } else {
            header("Location: ../index.php?halaman=user&status=gagal");
        }
        exit();
    }
}

/*
====================================================================
2. PROSES UBAH DATA AKUN (UPDATE)
====================================================================
*/
elseif ($aksi === 'ubah') {
    if (isset($_POST['update'])) {
        $iduser   = mysqli_real_escape_string($koneksi, $_POST['iduser']);
        $namauser = mysqli_real_escape_string($koneksi, trim($_POST['namauser']));
        $username = mysqli_real_escape_string($koneksi, trim($_POST['username']));
        $password = trim($_POST['password']);
        $role     = mysqli_real_escape_string($koneksi, $_POST['role']);
        
        // Ambil data lama untuk mengecek foto
        $queryCek  = mysqli_query($koneksi, "SELECT foto FROM user WHERE iduser = '$iduser'");
        $dataLama  = mysqli_fetch_assoc($queryCek);
        $namaFoto  = $dataLama['foto'];

        if (!empty($_FILES['foto']['name'])) {
            $namaFile   = $_FILES['foto']['name'];
            $ukuranFile = $_FILES['foto']['size'];
            $errorFile  = $_FILES['foto']['error'];
            $tmpName    = $_FILES['foto']['tmp_name'];

            $ekstensiValid = ['jpg', 'jpeg', 'png'];
            $ekstensiFile  = explode('.', $namaFile);
            $ekstensiFile  = strtolower(end($ekstensiFile));

            if (in_array($ekstensiFile, $ekstensiValid) && $ukuranFile <= 2000000 && $errorFile === 0) {
                $namaFotoBaru = uniqid() . '.' . $ekstensiFile;
                if (move_uploaded_file($tmpName, '../assets/images/user/' . $namaFotoBaru)) {
                    // Hapus foto lama fisik jika bukan default.png
                    if ($namaFoto !== 'default.png' && file_exists('../assets/images/user/' . $namaFoto)) {
                        unlink('../assets/images/user/' . $namaFoto);
                    }
                    $namaFoto = $namaFotoBaru;
                }
            }
        }

        // Jalankan Query Update Data
        $queryUpdate = "UPDATE user SET 
                        namauser = '$namauser', 
                        username = '$username', 
                        password = '$password', 
                        role = '$role', 
                        foto = '$namaFoto' 
                        WHERE iduser = '$iduser'";
        
        if (mysqli_query($koneksi, $queryUpdate)) {
            header("Location: ../index.php?halaman=user&status=sukses_ubah");
        } else {
            header("Location: ../index.php?halaman=user&status=gagal");
        }
        exit();
    }
}

/*
====================================================================
3. PROSES HAPUS DATA AKUN (DELETE)
====================================================================
*/
elseif ($aksi === 'hapus') {
    $iduser = mysqli_real_escape_string($koneksi, $_GET['id']);

    $queryCek = mysqli_query($koneksi, "SELECT foto FROM user WHERE iduser = '$iduser'");
    if (mysqli_num_rows($queryCek) === 1) {
        $data = mysqli_fetch_assoc($queryCek);
        
        if ($data['foto'] !== 'default.png' && file_exists('../assets/images/user/' . $data['foto'])) {
            unlink('../assets/images/user/' . $data['foto']);
        }

        $queryDelete = "DELETE FROM user WHERE iduser = '$iduser'";
        if (mysqli_query($koneksi, $queryDelete)) {
            header("Location: ../index.php?halaman=user&status=sukses_hapus");
        } else {
            header("Location: ../index.php?halaman=user&status=gagal");
        }
        exit();
    }
}

// Apabila diakses ilegal tanpa rute aksi yang valid
header("Location: ../index.php?halaman=403");
exit();
?>
