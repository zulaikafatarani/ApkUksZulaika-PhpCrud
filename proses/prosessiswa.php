<?php
// proses/prosessiswa.php - FIX PATH ANTI ERROR - 0103786196
session_start();

// Cari file koneksi otomatis - biar gak 404 lagi
if(file_exists(__DIR__.'/../config/koneksi.php')) include __DIR__.'/../config/koneksi.php';
elseif(file_exists(__DIR__.'/../koneksi.php')) include __DIR__.'/../koneksi.php';
elseif(file_exists(__DIR__.'/../config/database.php')) include __DIR__.'/../config/database.php';
elseif(file_exists(__DIR__.'/koneksi.php')) include __DIR__.'/koneksi.php';

if(file_exists(__DIR__.'/../config/fungsi.php')) include __DIR__.'/../config/fungsi.php';
elseif(file_exists(__DIR__.'/../fungsi.php')) include __DIR__.'/../fungsi.php';
elseif(file_exists(__DIR__.'/../config/function.php')) include __DIR__.'/../config/function.php';

// Kalau fungsi batasi_akses_role belum ada, bikin manual biar gak fatal error
if(!function_exists('batasi_akses_role')){
  function batasi_akses_role($allowed=[]){
    if(!isset($_SESSION['role'])){ header("Location: ../index.php?halaman=loginuser"); exit(); }
    if(!empty($allowed) && !in_array($_SESSION['role'], $allowed)){ header("Location: ../index.php?halaman=dashboard".$_SESSION['role']); exit(); }
  }
}
batasi_akses_role(['admin','petugas','anggota']);

$aksi = $_GET['aksi'] ?? '';
$folderFoto = __DIR__.'/../assets/images/siswa/';
if(!is_dir($folderFoto)) mkdir($folderFoto, 0777, true);

if($aksi=='tambah'){
  $nis = mysqli_real_escape_string($koneksi, $_POST['nis'] ?? '');
  $namasiswa = mysqli_real_escape_string($koneksi, $_POST['namasiswa'] ?? '');
  $jk = mysqli_real_escape_string($koneksi, $_POST['jeniskelamin'] ?? 'L');
  $kelas = mysqli_real_escape_string($koneksi, $_POST['kelas'] ?? '');
  $darah = mysqli_real_escape_string($koneksi, $_POST['golongandarah'] ?? '');
  $nohp = mysqli_real_escape_string($koneksi, $_POST['nohp'] ?? '');
  $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat'] ?? '');
  $penyakit = mysqli_real_escape_string($koneksi, $_POST['riwayatpenyakit'] ?? '');
  $alergi = mysqli_real_escape_string($koneksi, $_POST['riwayatalergi'] ?? '');
  
  $cek = mysqli_query($koneksi, "SELECT idsiswa FROM siswa WHERE nis='$nis' LIMIT 1");
  if(mysqli_num_rows($cek)>0){
    header("Location: ../index.php?halaman=siswa&status=nis_duplikat");
    exit();
  }

  $fotoName = 'default.png';
  if(!empty($_FILES['foto']['name']) && $_FILES['foto']['error']==0){
    $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
    $fotoName = 'siswa_'.time().'_'.rand(100,999).'.'.$ext;
    move_uploaded_file($_FILES['foto']['tmp_name'], $folderFoto.$fotoName);
  }

  $pass = md5($nis);
  // Coba insert dengan password dulu
  $q = @mysqli_query($koneksi, "INSERT INTO siswa (nis, namasiswa, jeniskelamin, kelas, golongandarah, nohp, alamat, riwayatpenyakit, riwayatalergi, foto, password) VALUES ('$nis','$namasiswa','$jk','$kelas','$darah','$nohp','$alamat','$penyakit','$alergi','$fotoName','$pass')");
  if(!$q){
    // Kalau gagal (kolom password belum ada), insert tanpa password
    $q = mysqli_query($koneksi, "INSERT INTO siswa (nis, namasiswa, jeniskelamin, kelas, golongandarah, nohp, alamat, riwayatpenyakit, riwayatalergi, foto) VALUES ('$nis','$namasiswa','$jk','$kelas','$darah','$nohp','$alamat','$penyakit','$alergi','$fotoName')");
  }

  if($q) header("Location: ../index.php?halaman=siswa&status=sukses_tambah");
  else header("Location: ../index.php?halaman=siswa&status=gagal&err=".urlencode(mysqli_error($koneksi)));
  exit();
}

if($aksi=='ubah'){
  $id = (int)($_POST['idsiswa'] ?? 0);
  $nis = mysqli_real_escape_string($koneksi, $_POST['nis'] ?? '');
  $namasiswa = mysqli_real_escape_string($koneksi, $_POST['namasiswa'] ?? '');
  $jk = mysqli_real_escape_string($koneksi, $_POST['jeniskelamin'] ?? 'L');
  $kelas = mysqli_real_escape_string($koneksi, $_POST['kelas'] ?? '');
  $darah = mysqli_real_escape_string($koneksi, $_POST['golongandarah'] ?? '');
  $nohp = mysqli_real_escape_string($koneksi, $_POST['nohp'] ?? '');
  $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat'] ?? '');
  $penyakit = mysqli_real_escape_string($koneksi, $_POST['riwayatpenyakit'] ?? '');
  $alergi = mysqli_real_escape_string($koneksi, $_POST['riwayatalergi'] ?? '');
  $fotoLama = $_POST['foto_lama'] ?? 'default.png';

  $fotoName = $fotoLama;
  if(!empty($_FILES['foto']['name']) && $_FILES['foto']['error']==0){
    $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
    $fotoName = 'siswa_'.time().'_'.rand(100,999).'.'.$ext;
    move_uploaded_file($_FILES['foto']['tmp_name'], $folderFoto.$fotoName);
    if($fotoLama!='default.png' && file_exists($folderFoto.$fotoLama)) @unlink($folderFoto.$fotoLama);
  }

  mysqli_query($koneksi, "UPDATE siswa SET nis='$nis', namasiswa='$namasiswa', jeniskelamin='$jk', kelas='$kelas', golongandarah='$darah', nohp='$nohp', alamat='$alamat', riwayatpenyakit='$penyakit', riwayatalergi='$alergi', foto='$fotoName' WHERE idsiswa=$id");
  header("Location: ../index.php?halaman=siswa&status=sukses_ubah");
  exit();
}

if($aksi=='hapus'){
  $id = (int)($_GET['id'] ?? 0);
  $d = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT foto FROM siswa WHERE idsiswa=$id"));
  if($d){ if($d['foto']!='default.png' && file_exists($folderFoto.$d['foto'])) @unlink($folderFoto.$d['foto']); mysqli_query($koneksi, "DELETE FROM siswa WHERE idsiswa=$id"); }
  header("Location: ../index.php?halaman=siswa&status=sukses_hapus");
  exit();
}

if($aksi=='resetpass'){
  $id = (int)($_GET['id'] ?? 0);
  $d = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT nis FROM siswa WHERE idsiswa=$id"));
  if($d){ $pass = md5($d['nis']); @mysqli_query($koneksi, "UPDATE siswa SET password='$pass' WHERE idsiswa=$id"); }
  header("Location: ../index.php?halaman=siswa&status=reset_ok");
  exit();
}

header("Location: ../index.php?halaman=siswa");
?>