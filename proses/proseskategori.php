<?php
require_once 'koneksi.php'; require_once 'session.php';
$aksi=$_GET['aksi']??''; batasi_akses_role(['admin','petugas']);
if($aksi=='tambah'){ 
    $nama=mysqli_real_escape_string($koneksi, trim($_POST['namakategori']));
    mysqli_query($koneksi,"INSERT INTO kategori (namakategori) VALUES ('$nama')");
    header("Location: ../index.php?halaman=kategori&status=sukses_tambah"); exit();
}
if($aksi=='ubah'){
    $id=(int)$_POST['idkategori']; $nama=mysqli_real_escape_string($koneksi, trim($_POST['namakategori']));
    mysqli_query($koneksi,"UPDATE kategori SET namakategori='$nama' WHERE idkategori=$id");
    header("Location: ../index.php?halaman=kategori&status=sukses_ubah"); exit();
}
if($aksi=='hapus'){
    $id=(int)$_GET['id']; mysqli_query($koneksi,"DELETE FROM kategori WHERE idkategori=$id");
    header("Location: ../index.php?halaman=kategori&status=sukses_hapus"); exit();
}
?>