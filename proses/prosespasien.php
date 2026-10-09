<?php
require_once 'koneksi.php';
require_once 'session.php';

$aksi = strtolower($_GET['aksi'] ?? $_POST['aksi'] ?? '');
$jenis = strtolower($_GET['jenis'] ?? $_POST['jenis'] ?? '');

if(!in_array($jenis, ['siswa','guru'])){
    header("Location: ../index.php?halaman=siswa&status=jenis_tidak_valid");
    exit();
}

if($jenis == 'siswa'){
    batasi_akses_role(['admin','petugas','anggota']);
    $tabel = 'siswa'; $idField = 'idsiswa'; $folder = 'siswa';
} else {
    batasi_akses_role(['admin','petugas']);
    $tabel = 'guru'; $idField = 'idguru'; $folder = 'guru';
}

function uploadFotoPasien($file, $folder, $old = null){
    $dir = "../assets/images/$folder/";
    if(!is_dir($dir)) mkdir($dir, 0777, true);
    if($file['error'] == 4) return $old ?? 'default.png';
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if(!in_array($ext, ['jpg','jpeg','png','webp'])) return $old ?? 'default.png';
    $baru = uniqid($folder.'_').'.'.$ext;
    if(move_uploaded_file($file['tmp_name'], $dir.$baru)){
        if($old && $old != 'default.png' && file_exists($dir.$old)) unlink($dir.$old);
        return $baru;
    }
    return $old ?? 'default.png';
}

// ================= 1. TAMBAH =================
if($aksi == 'tambah' || $aksi == 'tambahsiswa' || $aksi == 'tambahguru'){
    $foto = uploadFotoPasien($_FILES['foto'], $folder);

    if($jenis == 'siswa'){
        // FIX: jadikan variabel dulu, jangan $_POST langsung di bind_param
        $nis = $_POST['nis'] ?? $_POST['nisn'] ?? '';
        $nama = $_POST['namasiswa'] ?? '';
        $kelas = $_POST['kelas'] ?? '';
        $jk = $_POST['jeniskelamin'] ?? $_POST['jk'] ?? 'L';
        $goldar = $_POST['golongandarah'] ?? '';
        $riwPenyakit = $_POST['riwayatpenyakit'] ?? $_POST['alergi'] ?? $_POST['penyakit_bawaan'] ?? '';
        $riwAlergi = $_POST['riwayatalergi'] ?? $_POST['alergi'] ?? '';
        $alamat = $_POST['alamat'] ?? '';
        $nohp = $_POST['nohp'] ?? $_POST['hp_ortu'] ?? '';

        $stmt = mysqli_prepare($koneksi, "INSERT INTO siswa (nis, namasiswa, kelas, jeniskelamin, golongandarah, riwayatpenyakit, riwayatalergi, foto, alamat, nohp) VALUES (?,?,?,?,?,?,?,?,?,?)");
        mysqli_stmt_bind_param($stmt, "ssssssssss", $nis, $nama, $kelas, $jk, $goldar, $riwPenyakit, $riwAlergi, $foto, $alamat, $nohp);
    } else {
        $nip = $_POST['nip'] ?? '';
        $nama = $_POST['namaguru'] ?? '';
        $riwPenyakit = $_POST['riwayatpenyakit'] ?? $_POST['penyakit_bawaan'] ?? '';
        $jk = $_POST['jeniskelamin'] ?? $_POST['jk'] ?? 'L';
        $alamat = $_POST['alamat'] ?? '';
        $nohp = $_POST['nohp'] ?? $_POST['hp_guru'] ?? '';

        $stmt = mysqli_prepare($koneksi, "INSERT INTO guru (nip, namaguru, riwayatpenyakit, jeniskelamin, foto, alamat, nohp) VALUES (?,?,?,?,?,?,?)");
        mysqli_stmt_bind_param($stmt, "sssssss", $nip, $nama, $riwPenyakit, $jk, $foto, $alamat, $nohp);
    }
    mysqli_stmt_execute($stmt);
    header("Location: ../index.php?halaman=$jenis&status=sukses_tambah"); exit();
}

// ================= 2. UBAH / EDIT - INI YANG ERROR TADI =================
if($aksi == 'ubah' || $aksi == 'edit' || $aksi == 'ubahsiswa' || $aksi == 'ubahguru'){
    $id = (int)($_POST['id'] ?? $_POST['idsiswa'] ?? $_POST['idguru'] ?? 0);
    $fotoLama = $_POST['foto_lama'] ?? 'default.png';
    $foto = uploadFotoPasien($_FILES['foto'], $folder, $fotoLama);

    if($jenis == 'siswa'){
        // FIX WAJIB: semua jadi variabel
        $nis = $_POST['nis'] ?? $_POST['nisn'] ?? '';
        $nama = $_POST['namasiswa'] ?? '';
        $kelas = $_POST['kelas'] ?? '';
        $jk = $_POST['jeniskelamin'] ?? $_POST['jk'] ?? 'L';
        $goldar = $_POST['golongandarah'] ?? '';
        $riwPenyakit = $_POST['riwayatpenyakit'] ?? $_POST['alergi'] ?? '';
        $riwAlergi = $_POST['riwayatalergi'] ?? '';
        $alamat = $_POST['alamat'] ?? '';
        $nohp = $_POST['nohp'] ?? $_POST['hp_ortu'] ?? '';

        $stmt = mysqli_prepare($koneksi, "UPDATE siswa SET nis=?, namasiswa=?, kelas=?, jeniskelamin=?, golongandarah=?, riwayatpenyakit=?, riwayatalergi=?, foto=?, alamat=?, nohp=? WHERE idsiswa=?");
        mysqli_stmt_bind_param($stmt, "ssssssssssi", $nis, $nama, $kelas, $jk, $goldar, $riwPenyakit, $riwAlergi, $foto, $alamat, $nohp, $id);
    } else {
        $nip = $_POST['nip'] ?? '';
        $nama = $_POST['namaguru'] ?? '';
        $riwPenyakit = $_POST['riwayatpenyakit'] ?? $_POST['penyakit_bawaan'] ?? '';
        $jk = $_POST['jeniskelamin'] ?? $_POST['jk'] ?? 'L';
        $alamat = $_POST['alamat'] ?? '';
        $nohp = $_POST['nohp'] ?? $_POST['hp_guru'] ?? '';

        $stmt = mysqli_prepare($koneksi, "UPDATE guru SET nip=?, namaguru=?, riwayatpenyakit=?, jeniskelamin=?, foto=?, alamat=?, nohp=? WHERE idguru=?");
        mysqli_stmt_bind_param($stmt, "sssssssi", $nip, $nama, $riwPenyakit, $jk, $foto, $alamat, $nohp, $id);
    }
    mysqli_stmt_execute($stmt);
    header("Location: ../index.php?halaman=$jenis&status=sukses_ubah"); exit();
}

// ================= 3. HAPUS =================
if($aksi == 'hapus' || $aksi == 'hapussiswa' || $aksi == 'hapusguru'){
    $id = (int)($_GET['id'] ?? 0);
    $q = mysqli_query($koneksi, "SELECT foto FROM $tabel WHERE $idField=$id");
    if($d = mysqli_fetch_assoc($q)){
        if($d['foto'] != 'default.png' && file_exists("../assets/images/$folder/".$d['foto'])){
            unlink("../assets/images/$folder/".$d['foto']);
        }
    }
    mysqli_query($koneksi, "DELETE FROM $tabel WHERE $idField=$id");
    header("Location: ../index.php?halaman=$jenis&status=sukses_hapus"); exit();
}
?>