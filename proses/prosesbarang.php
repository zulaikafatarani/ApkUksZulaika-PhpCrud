<?php
require_once 'koneksi.php'; require_once 'session.php';
$aksi=$_GET['aksi']??''; batasi_akses_role(['admin','petugas','anggota']);

function uploadBarang($file){
    $dir="../assets/images/barang/"; if(!is_dir($dir)) mkdir($dir,0777,true);
    if($file['error']==4) return 'default_obat.png';
    $ext=strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));
    $baru=uniqid('obat_').'.'.$ext;
    move_uploaded_file($file['tmp_name'],$dir.$baru); return $baru;
}

if($aksi=='tambah'){
    $foto=uploadBarang($_FILES['foto']);
    $stmt=mysqli_prepare($koneksi,"INSERT INTO barang (foto, idkategori, namabarang, stok, satuan, tanggalkadaluarsa, tanggalmasuk) VALUES (?,?,?,?,?,?,?)");
    mysqli_stmt_bind_param($stmt,"sisssss", $foto, $_POST['idkategori'], $_POST['namabarang'], $_POST['stok'], $_POST['satuan'], $_POST['tanggalkadaluarsa'], $_POST['tanggalmasuk']);
    mysqli_stmt_execute($stmt);
    header("Location: ../index.php?halaman=barang&status=sukses_tambah"); exit();
}
if($aksi=='ubah'){
    $id=(int)$_POST['idbarang']; $fotoLama=$_POST['foto_lama']??'default_obat.png';
    $foto=$_FILES['foto']['error']!=4 ? uploadBarang($_FILES['foto']) : $fotoLama;
    $stmt=mysqli_prepare($koneksi,"UPDATE barang SET foto=?, idkategori=?, namabarang=?, stok=?, satuan=?, tanggalkadaluarsa=?, tanggalmasuk=? WHERE idbarang=?");
    mysqli_stmt_bind_param($stmt,"sisssssi", $foto, $_POST['idkategori'], $_POST['namabarang'], $_POST['stok'], $_POST['satuan'], $_POST['tanggalkadaluarsa'], $_POST['tanggalmasuk'], $id);
    mysqli_stmt_execute($stmt);
    header("Location: ../index.php?halaman=barang&status=sukses_ubah"); exit();
}
if($aksi=='hapus'){
    $id=(int)$_GET['id']; 
    $f=mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT foto FROM barang WHERE idbarang=$id"))['foto']??'';
    if($f!='default_obat.png' && file_exists("../assets/images/barang/$f")) unlink("../assets/images/barang/$f");
    mysqli_query($koneksi,"DELETE FROM barang WHERE idbarang=$id");
    header("Location: ../index.php?halaman=barang&status=sukses_hapus"); exit();
}
?>