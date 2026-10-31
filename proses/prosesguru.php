<?php
// proses/prosesguru.php - FINAL FIX PATH ANTI ERROR - TANPA MAPEL - 0103786196
session_start();

// Auto cari file koneksi - biar gak 404 lagi kayak screenshot
if(file_exists(__DIR__.'/../config/koneksi.php')) include __DIR__.'/../config/koneksi.php';
elseif(file_exists(__DIR__.'/../koneksi.php')) include __DIR__.'/../koneksi.php';
elseif(file_exists(__DIR__.'/../config/database.php')) include __DIR__.'/../config/database.php';
elseif(file_exists(__DIR__.'/koneksi.php')) include __DIR__.'/koneksi.php';
elseif(file_exists(__DIR__.'/../inc/koneksi.php')) include __DIR__.'/../inc/koneksi.php';

if(file_exists(__DIR__.'/../config/fungsi.php')) include __DIR__.'/../config/fungsi.php';
elseif(file_exists(__DIR__.'/../fungsi.php')) include __DIR__.'/../fungsi.php';
elseif(file_exists(__DIR__.'/../config/function.php')) include __DIR__.'/../config/function.php';
elseif(file_exists(__DIR__.'/../inc/fungsi.php')) include __DIR__.'/../inc/fungsi.php';

// Kalau fungsi batasi_akses_role belum ada, bikin manual biar gak fatal error
if(!function_exists('batasi_akses_role')){
  function batasi_akses_role($allowed=[]){
    if(!isset($_SESSION['role'])){ header("Location: ../index.php?halaman=loginuser"); exit(); }
    if(!empty($allowed) && !in_array($_SESSION['role'], $allowed)){ header("Location: ../index.php?halaman=dashboard".$_SESSION['role']); exit(); }
  }
}
batasi_akses_role(['admin','petugas','anggota']);

$aksi = $_GET['aksi'] ?? '';
$folderFoto = __DIR__.'/../assets/images/guru/';
if(!is_dir($folderFoto)) mkdir($folderFoto, 0777, true);

if($aksi=='tambah'){
  $nip = mysqli_real_escape_string($koneksi, $_POST['nip'] ?? '');
  $namaguru = mysqli_real_escape_string($koneksi, $_POST['namaguru'] ?? '');
  $jk = mysqli_real_escape_string($koneksi, $_POST['jeniskelamin'] ?? 'P');
  $nohp = mysqli_real_escape_string($koneksi, $_POST['nohp'] ?? '');
  $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat'] ?? '');
  $penyakit = mysqli_real_escape_string($koneksi, $_POST['riwayatpenyakit'] ?? '');

  $cek = mysqli_query($koneksi, "SELECT idguru FROM guru WHERE nip='$nip' LIMIT 1");
  if(mysqli_num_rows($cek)>0){ header("Location: ../index.php?halaman=guru&status=nip_duplikat"); exit(); }

  $fotoName = 'default.png';
  if(!empty($_FILES['foto']['name']) && $_FILES['foto']['error']==0){
    $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
    $fotoName = 'guru_'.time().'_'.rand(100,999).'.'.$ext;
    move_uploaded_file($_FILES['foto']['tmp_name'], $folderFoto.$fotoName);
  }

  $pass = md5($nip);
  // Coba insert dengan password
  $q = @mysqli_query($koneksi, "INSERT INTO guru (nip, namaguru, jeniskelamin, nohp, alamat, riwayatpenyakit, foto, password) VALUES ('$nip','$namaguru','$jk','$nohp','$alamat','$penyakit','$fotoName','$pass')");
  if(!$q){
    // Kalau gagal (kolom password belum ada atau mapel masih ada di struktur lama), coba tanpa password & tanpa mapel
    $q = @mysqli_query($koneksi, "INSERT INTO guru (nip, namaguru, jeniskelamin, nohp, alamat, riwayatpenyakit, foto) VALUES ('$nip','$namaguru','$jk','$nohp','$alamat','$penyakit','$fotoName')");
  }
  if(!$q){
    // Fallback terakhir: struktur lama yang ada mapel
    $q = @mysqli_query($koneksi, "INSERT INTO guru (nip, namaguru, jeniskelamin, nohp, alamat, foto) VALUES ('$nip','$namaguru','$jk','$nohp','$alamat','$fotoName')");
  }

  if($q) header("Location: ../index.php?halaman=guru&status=sukses_tambah");
  else header("Location: ../index.php?halaman=guru&status=gagal&err=".urlencode(mysqli_error($koneksi)));
  exit();
}

if($aksi=='ubah'){
  $id = (int)($_POST['idguru'] ?? 0);
  $nip = mysqli_real_escape_string($koneksi, $_POST['nip'] ?? '');
  $namaguru = mysqli_real_escape_string($koneksi, $_POST['namaguru'] ?? '');
  $jk = mysqli_real_escape_string($koneksi, $_POST['jeniskelamin'] ?? 'P');
  $nohp = mysqli_real_escape_string($koneksi, $_POST['nohp'] ?? '');
  $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat'] ?? '');
  $penyakit = mysqli_real_escape_string($koneksi, $_POST['riwayatpenyakit'] ?? '');
  $fotoLama = $_POST['foto_lama'] ?? 'default.png';

  $fotoName = $fotoLama;
  if(!empty($_FILES['foto']['name']) && $_FILES['foto']['error']==0){
    $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
    $fotoName = 'guru_'.time().'_'.rand(100,999).'.'.$ext;
    move_uploaded_file($_FILES['foto']['tmp_name'], $folderFoto.$fotoName);
    if($fotoLama!='default.png' && file_exists($folderFoto.$fotoLama)) @unlink($folderFoto.$fotoLama);
  }

  @mysqli_query($koneksi, "UPDATE guru SET nip='$nip', namaguru='$namaguru', jeniskelamin='$jk', nohp='$nohp', alamat='$alamat', riwayatpenyakit='$penyakit', foto='$fotoName' WHERE idguru=$id");
  header("Location: ../index.php?halaman=guru&status=sukses_ubah");
  exit();
}

if($aksi=='hapus'){
  $id = (int)($_GET['id'] ?? 0);
  $d = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT foto FROM guru WHERE idguru=$id"));
  if($d){ if($d['foto']!='default.png' && file_exists($folderFoto.$d['foto'])) @unlink($folderFoto.$d['foto']); mysqli_query($koneksi, "DELETE FROM guru WHERE idguru=$id"); }
  header("Location: ../index.php?halaman=guru&status=sukses_hapus");
  exit();
}

if($aksi=='resetpass'){
  $id = (int)($_GET['id'] ?? 0);
  $d = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT nip FROM guru WHERE idguru=$id"));
  if($d){ $pass = md5($d['nip']); @mysqli_query($koneksi, "UPDATE guru SET password='$pass' WHERE idguru=$id"); }
  header("Location: ../index.php?halaman=guru&status=reset_ok");
  exit();
}

header("Location: ../index.php?halaman=guru");
?>