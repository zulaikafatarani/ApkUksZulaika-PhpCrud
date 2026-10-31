<?php
// proses/prosespasien.php - LENGKAP - Ganti semua isi file lama dengan ini
include 'koneksi.php';
if(session_status()==PHP_SESSION_NONE) session_start();

$aksi = $_GET['aksi'] ?? '';

if($aksi == 'loginpasien'){
  $jenis = $_POST['jenis'] ?? 'siswa';
  $id = mysqli_real_escape_string($koneksi, $_POST['id'] ?? '');
  $pass = md5($_POST['password'] ?? '');
  
  if($jenis == 'siswa'){
    $q = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nis='$id' AND password='$pass' LIMIT 1");
    $d = mysqli_fetch_assoc($q);
    if($d){ $_SESSION['pasien'] = ['jenis'=>'siswa','nama'=>$d['namasiswa'],'nis'=>$d['nis'],'kelas'=>$d['kelas'],'goldar'=>$d['golongandarah'],'foto'=>$d['foto']]; header("Location: ../index.php?halaman=dashboardpasien"); exit(); }
  } else {
    $q = mysqli_query($koneksi, "SELECT * FROM guru WHERE nip='$id' AND password='$pass' LIMIT 1");
    $d = mysqli_fetch_assoc($q);
    if($d){ $_SESSION['pasien'] = ['jenis'=>'guru','nama'=>$d['namaguru'],'nis'=>$d['nip'],'kelas'=>'Guru','goldar'=>$d['golongandarah'] ?? '-','foto'=>$d['foto'] ?? '']; header("Location: ../index.php?halaman=dashboardpasien"); exit(); }
  }
  header("Location: ../index.php?halaman=loginpasien&error=1"); exit();
}

if($aksi == 'logoutpasien'){
  unset($_SESSION['pasien']);
  header("Location: ../index.php?halaman=loginpasien"); exit();
}

if($aksi == 'cari'){
  $nis = mysqli_real_escape_string($koneksi, $_GET['nis'] ?? '');
  $q = mysqli_query($koneksi, "SELECT namasiswa as nama, kelas, golongandarah as goldar, riwayatpenyakit as riwayat FROM siswa WHERE nis='$nis' LIMIT 1");
  if(mysqli_num_rows($q)==0){
    $q = mysqli_query($koneksi, "SELECT namaguru as nama, 'Guru' as kelas, golongandarah as goldar, '-' as riwayat FROM guru WHERE nip='$nis' LIMIT 1");
  }
  header('Content-Type: application/json');
  echo json_encode(mysqli_fetch_assoc($q)); exit();
}

if($aksi == 'ubahpassword'){
  if(!isset($_SESSION['pasien'])){ header("Location: ../index.php?halaman=loginpasien"); exit(); }
  $p = $_SESSION['pasien'];
  $lama = md5($_POST['lama'] ?? '');
  $baru = md5($_POST['baru'] ?? '');
  $tbl = $p['jenis']=='siswa' ? 'siswa' : 'guru';
  $col = $p['jenis']=='siswa' ? 'nis' : 'nip';
  $cek = mysqli_query($koneksi, "SELECT * FROM $tbl WHERE $col='{$p['nis']}' AND password='$lama' LIMIT 1");
  if(mysqli_num_rows($cek)==1){
    mysqli_query($koneksi, "UPDATE $tbl SET password='$baru' WHERE $col='{$p['nis']}'");
    header("Location: ../index.php?halaman=dashboardpasien&sukses=1"); exit();
  } else {
    header("Location: ../index.php?halaman=ubahpassword&error=1"); exit();
  }
}
?>

