<?php
require_once 'koneksi.php';
require_once 'session.php';

// Ambil aksi dan jenis dari URL: ?aksi=tambah&jenis=siswa atau guru
$aksi = strtolower($_GET['aksi'] ?? $_POST['aksi'] ?? '');
$jenis = strtolower($_GET['jenis'] ?? $_POST['jenis'] ?? '');

// Validasi jenis - HARUS siswa atau guru
if(!in_array($jenis, ['siswa','guru'])){
    header("Location: ../index.php?halaman=siswa&status=jenis_tidak_valid");
    exit();
}

// Tentukan tabel & hak akses sesuai jenis (sesuai roadmap)
if($jenis == 'siswa'){
    batasi_akses_role(['admin','petugas','anggota']); // siswa boleh diolah anggota PMR
    $tabel = 'siswa'; $idField = 'idsiswa'; $folder = 'siswa';
} else {
    batasi_akses_role(['admin','petugas']); // guru hanya admin & petugas
    $tabel = 'guru'; $idField = 'idguru'; $folder = 'guru';
}

function uploadFotoPasien($file, $folder, $old = null){
    $dir = "../assets/images/$folder/";
    if(!is_dir($dir)) mkdir($dir, 0777, true);
    if($file['error'] == 4) return $old ?? 'default.png';
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if(!in_array($ext, ['jpg','jpeg','png','webp'])) return false;
    $baru = uniqid($folder.'_').'.'.$ext;
    if(move_uploaded_file($file['tmp_name'], $dir.$baru)){
        if($old && $old != 'default.png' && file_exists($dir.$old)) unlink($dir.$old);
        return $baru;
    }
    return false;
}

// ================= 1. TAMBAH =================
if($aksi == 'tambah' || $aksi == 'tambahsiswa' || $aksi == 'tambahguru'){
    $foto = uploadFotoPasien($_FILES['foto'], $folder);
    if($foto === false){ header("Location: ../index.php?halaman=$jenis&status=gagal_foto"); exit(); }

    if($jenis == 'siswa'){
        // Kolom asli sesuai LAPORAN halaman 4: nis, namasiswa, kelas, jeniskelamin, golongandarah, riwayatpenyakit, riwayatalergi, foto, alamat, nohp
        $stmt = mysqli_prepare($koneksi, "INSERT INTO siswa (nis, namasiswa, kelas, jeniskelamin, golongandarah, riwayatpenyakit, riwayatalergi, foto, alamat, nohp) VALUES (?,?,?,?,?,?,?,?,?,?)");
        $riwPenyakit = $_POST['riwayatpenyakit'] ?? $_POST['alergi'] ?? $_POST['penyakit_bawaan'] ?? null;
        $riwAlergi = $_POST['riwayatalergi'] ?? $_POST['alergi'] ?? null;
        mysqli_stmt_bind_param($stmt, "ssssssssss", $_POST['nis'] ?? $_POST['nisn'], $_POST['namasiswa'], $_POST['kelas'], $_POST['jeniskelamin'] ?? $_POST['jk'], $_POST['golongandarah'], $riwPenyakit, $riwAlergi, $foto, $_POST['alamat'], $_POST['nohp'] ?? $_POST['hp_ortu']);
    } else {
        // Kolom asli guru: nip, namaguru, riwayatpenyakit, jeniskelamin, foto, alamat, nohp
        $stmt = mysqli_prepare($koneksi, "INSERT INTO guru (nip, namaguru, riwayatpenyakit, jeniskelamin, foto, alamat, nohp) VALUES (?,?,?,?,?,?,?)");
        $riwPenyakit = $_POST['riwayatpenyakit'] ?? $_POST['penyakit_bawaan'] ?? null;
        mysqli_stmt_bind_param($stmt, "sssssss", $_POST['nip'], $_POST['namaguru'], $riwPenyakit, $_POST['jeniskelamin'] ?? $_POST['jk'], $foto, $_POST['alamat'], $_POST['nohp'] ?? $_POST['hp_guru']);
    }

    if(mysqli_stmt_execute($stmt)){
        header("Location: ../index.php?halaman=$jenis&status=sukses_tambah");
    } else {
        header("Location: ../index.php?halaman=$jenis&status=gagal&msg=".urlencode(mysqli_error($koneksi)));
    }
    exit();
}

// ================= 2. UBAH / EDIT =================
if($aksi == 'ubah' || $aksi == 'edit' || $aksi == 'ubahsiswa' || $aksi == 'ubahguru'){
    $id = (int)($_POST['id'] ?? $_POST['idsiswa'] ?? $_POST['idguru'] ?? 0);
    $fotoLama = $_POST['foto_lama'] ?? 'default.png';
    $foto = uploadFotoPasien($_FILES['foto'], $folder, $fotoLama);
    if($foto === false){ header("Location: ../index.php?halaman=$jenis&status=gagal_foto"); exit(); }

    if($jenis == 'siswa'){
        $stmt = mysqli_prepare($koneksi, "UPDATE siswa SET nis=?, namasiswa=?, kelas=?, jeniskelamin=?, golongandarah=?, riwayatpenyakit=?, riwayatalergi=?, foto=?, alamat=?, nohp=? WHERE idsiswa=?");
        $riwPenyakit = $_POST['riwayatpenyakit'] ?? $_POST['alergi'] ?? null;
        $riwAlergi = $_POST['riwayatalergi'] ?? null;
        mysqli_stmt_bind_param($stmt, "ssssssssssi", $_POST['nis'] ?? $_POST['nisn'], $_POST['namasiswa'], $_POST['kelas'], $_POST['jeniskelamin'] ?? $_POST['jk'], $_POST['golongandarah'], $riwPenyakit, $riwAlergi, $foto, $_POST['alamat'], $_POST['nohp'] ?? $_POST['hp_ortu'], $id);
    } else {
        $stmt = mysqli_prepare($koneksi, "UPDATE guru SET nip=?, namaguru=?, riwayatpenyakit=?, jeniskelamin=?, foto=?, alamat=?, nohp=? WHERE idguru=?");
        $riwPenyakit = $_POST['riwayatpenyakit'] ?? $_POST['penyakit_bawaan'] ?? null;
        mysqli_stmt_bind_param($stmt, "sssssssi", $_POST['nip'], $_POST['namaguru'], $riwPenyakit, $_POST['jeniskelamin'] ?? $_POST['jk'], $foto, $_POST['alamat'], $_POST['nohp'] ?? $_POST['hp_guru'], $id);
    }
    mysqli_stmt_execute($stmt);
    header("Location: ../index.php?halaman=$jenis&status=sukses_ubah");
    exit();
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
    header("Location: ../index.php?halaman=$jenis&status=sukses_hapus");
    exit();
}

header("Location: ../index.php?halaman=403");
exit();
?>