<?php
// proses/prosesuser.php - FIX - 0103786196 - alamat doesn't have default value
session_start();

// Auto cari koneksi & fungsi - biar gak error path kayak guru tadi
if(file_exists(__DIR__.'/../config/koneksi.php')) require_once __DIR__.'/../config/koneksi.php';
elseif(file_exists(__DIR__.'/../koneksi.php')) require_once __DIR__.'/../koneksi.php';
elseif(file_exists(__DIR__.'/koneksi.php')) require_once __DIR__.'/koneksi.php';
else require_once 'koneksi.php';

if(file_exists(__DIR__.'/../config/fungsi.php')) require_once __DIR__.'/../config/fungsi.php';
elseif(file_exists(__DIR__.'/../session.php')) require_once __DIR__.'/../session.php';
elseif(file_exists(__DIR__.'/../fungsi.php')) require_once __DIR__.'/../fungsi.php';
else if(file_exists('session.php')) require_once 'session.php';

if(!function_exists('batasi_akses_role')){
  function batasi_akses_role($allowed=[]){
    if(!isset($_SESSION['role'])){ header("Location: ../index.php?halaman=loginuser"); exit(); }
    if(!empty($allowed) && !in_array($_SESSION['role'], $allowed)){ header("Location: ../index.php?halaman=dashboard".$_SESSION['role']); exit(); }
  }
}
batasi_akses_role(['admin']);

$aksi = $_GET['aksi'] ?? '';

if ($aksi === 'tambah') {
    if (isset($_POST['simpan'])) {
        $namauser = mysqli_real_escape_string($koneksi, trim($_POST['namauser'] ?? ''));
        $username = mysqli_real_escape_string($koneksi, trim($_POST['username'] ?? ''));
        $password = mysqli_real_escape_string($koneksi, trim($_POST['password'] ?? ''));
        $role     = mysqli_real_escape_string($koneksi, $_POST['role'] ?? 'petugas');
        $nohp     = mysqli_real_escape_string($koneksi, trim($_POST['nohp'] ?? ''));
        $alamat   = mysqli_real_escape_string($koneksi, trim($_POST['alamat'] ?? 'SMKN 1 Karang Baru'));
        
        $namaFotoBaru = 'default.png'; 
        if (!empty($_FILES['foto']['name']) && $_FILES['foto']['error']==0) {
            $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
            if(in_array($ext, ['jpg','jpeg','png'])){
                $namaFotoBaru = uniqid().'.'.$ext;
                @move_uploaded_file($_FILES['foto']['tmp_name'], __DIR__.'/../assets/images/user/'.$namaFotoBaru);
                if(!file_exists(__DIR__.'/../assets/images/user/'.$namaFotoBaru)){
                  @move_uploaded_file($_FILES['foto']['tmp_name'], '../assets/images/user/'.$namaFotoBaru);
                }
            }
        }

        // FIX: Masukkan alamat & nohp biar gak error doesn't have default value
        $queryInsert = "INSERT INTO user (namauser, username, password, role, foto, nohp, alamat) 
                        VALUES ('$namauser', '$username', '$password', '$role', '$namaFotoBaru', '$nohp', '$alamat')";
        
        // Fallback kalau kolom nohp/alamat belum ada di tabel user lama
        $q = @mysqli_query($koneksi, $queryInsert);
        if(!$q){
          $q = @mysqli_query($koneksi, "INSERT INTO user (namauser, username, password, role, foto) VALUES ('$namauser', '$username', '$password', '$role', '$namaFotoBaru')");
        }
        // Fallback terakhir: coba dengan alamat saja
        if(!$q){
          $q = @mysqli_query($koneksi, "INSERT INTO user (namauser, username, password, role, foto, alamat) VALUES ('$namauser', '$username', '$password', '$role', '$namaFotoBaru', '$alamat')");
        }
        
        if ($q) {
            header("Location: ../index.php?halaman=user&status=sukses_tambah");
        } else {
            header("Location: ../index.php?halaman=user&status=gagal&err=".urlencode(mysqli_error($koneksi)));
        }
        exit();
    }
}

elseif ($aksi === 'ubah') {
    if (isset($_POST['update'])) {
        $iduser   = (int)($_POST['iduser'] ?? 0);
        $namauser = mysqli_real_escape_string($koneksi, trim($_POST['namauser'] ?? ''));
        $username = mysqli_real_escape_string($koneksi, trim($_POST['username'] ?? ''));
        $password = mysqli_real_escape_string($koneksi, trim($_POST['password'] ?? ''));
        $role     = mysqli_real_escape_string($koneksi, $_POST['role'] ?? 'petugas');
        $nohp     = mysqli_real_escape_string($koneksi, trim($_POST['nohp'] ?? ''));
        $alamat   = mysqli_real_escape_string($koneksi, trim($_POST['alamat'] ?? ''));
        
        $queryCek  = mysqli_query($koneksi, "SELECT foto FROM user WHERE iduser = '$iduser'");
        $dataLama  = mysqli_fetch_assoc($queryCek);
        $namaFoto  = $dataLama['foto'] ?? 'default.png';

        if (!empty($_FILES['foto']['name']) && $_FILES['foto']['error']==0) {
            $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
            if(in_array($ext, ['jpg','jpeg','png'])){
                $namaFotoBaru = uniqid().'.'.$ext;
                if (@move_uploaded_file($_FILES['foto']['tmp_name'], __DIR__.'/../assets/images/user/'.$namaFotoBaru) || move_uploaded_file($_FILES['foto']['tmp_name'], '../assets/images/user/'.$namaFotoBaru)) {
                    if ($namaFoto !== 'default.png' && file_exists(__DIR__.'/../assets/images/user/'.$namaFoto)) @unlink(__DIR__.'/../assets/images/user/'.$namaFoto);
                    if ($namaFoto !== 'default.png' && file_exists('../assets/images/user/'.$namaFoto)) @unlink('../assets/images/user/'.$namaFoto);
                    $namaFoto = $namaFotoBaru;
                }
            }
        }

        $queryUpdate = "UPDATE user SET 
                        namauser = '$namauser', 
                        username = '$username', 
                        password = '$password', 
                        role = '$role', 
                        foto = '$namaFoto',
                        nohp = '$nohp',
                        alamat = '$alamat'
                        WHERE iduser = '$iduser'";
        
        $q = @mysqli_query($koneksi, $queryUpdate);
        if(!$q){
          $q = mysqli_query($koneksi, "UPDATE user SET namauser='$namauser', username='$username', password='$password', role='$role', foto='$namaFoto' WHERE iduser='$iduser'");
        }
        
        if ($q) header("Location: ../index.php?halaman=user&status=sukses_ubah");
        else header("Location: ../index.php?halaman=user&status=gagal");
        exit();
    }
}

elseif ($aksi === 'hapus') {
    $iduser = (int)($_GET['id'] ?? 0);
    $queryCek = mysqli_query($koneksi, "SELECT foto FROM user WHERE iduser = '$iduser'");
    if (mysqli_num_rows($queryCek) === 1) {
        $data = mysqli_fetch_assoc($queryCek);
        if ($data['foto'] !== 'default.png') {
            @unlink(__DIR__.'/../assets/images/user/'.$data['foto']);
            @unlink('../assets/images/user/'.$data['foto']);
        }
        mysqli_query($koneksi, "DELETE FROM user WHERE iduser = '$iduser'");
        header("Location: ../index.php?halaman=user&status=sukses_hapus");
        exit();
    }
}

header("Location: ../index.php?halaman=user");
exit();
?>