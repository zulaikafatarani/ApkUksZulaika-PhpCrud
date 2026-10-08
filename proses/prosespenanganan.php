<?php
require_once 'koneksi.php';
require_once 'session.php';
$aksi = $_GET['aksi'] ?? $_POST['aksi'] ?? '';
batasi_akses_role(['admin','petugas','anggota']);

// ========== 1. TAMBAH PENANGANAN ==========
if($aksi == 'tambah'){
    $tgl = $_POST['tanggalpenanganan'] ?? date('Y-m-d');
    $keluhan = mysqli_real_escape_string($koneksi, $_POST['keluhan']);
    $tindakan = mysqli_real_escape_string($koneksi, $_POST['tindakan']);
    $status = mysqli_real_escape_string($koneksi, $_POST['statuspasien']); // sembuh, istirahat, rujuk
    $idsiswa = !empty($_POST['idsiswa']) ? (int)$_POST['idsiswa'] : 'NULL';
    $idguru = !empty($_POST['idguru']) ? (int)$_POST['idguru'] : 'NULL';
    $iduser = (int)$_SESSION['iduser'];

    $q = mysqli_query($koneksi, "INSERT INTO penanganan (idsiswa, idguru, iduser, tanggalpenanganan, keluhan, tindakan, statuspasien) 
    VALUES ($idsiswa, $idguru, $iduser, '$tgl', '$keluhan', '$tindakan', '$status')");
    
    if(!$q){ die("Gagal header penanganan: ".mysqli_error($koneksi)); }
    $idPenanganan = mysqli_insert_id($koneksi);

    // Loop detail obat yang dipakai
    if(isset($_POST['idbarang']) && is_array($_POST['idbarang'])){
        foreach($_POST['idbarang'] as $i => $idb){
            $idb = (int)$idb;
            $qty = (int)($_POST['jumlahkeluar'][$i] ?? 0);
            if($idb > 0 && $qty > 0){
                // Cek stok cukup gak
                $stok = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT stok FROM barang WHERE idbarang=$idb"))['stok'] ?? 0;
                if($stok < $qty){
                    // Rollback jika stok kurang
                    mysqli_query($koneksi, "DELETE FROM penanganan WHERE idpenanganan=$idPenanganan");
                    header("Location: ../index.php?halaman=penanganan&status=stok_kurang&idb=$idb"); exit();
                }
                mysqli_query($koneksi, "INSERT INTO detailpenanganan (idpenanganan, idbarang, jumlahkeluar) VALUES ($idPenanganan, $idb, $qty)");
                mysqli_query($koneksi, "UPDATE barang SET stok = stok - $qty WHERE idbarang=$idb");
            }
        }
    }
    header("Location: ../index.php?halaman=penanganan&status=sukses_tambah"); exit();
}

// ========== 2. HAPUS PENANGANAN (Stok Balik) ==========
if($aksi == 'hapus'){
    $id = (int)$_GET['id'];
    // Balikin dulu stoknya sebelum hapus
    $details = mysqli_query($koneksi, "SELECT idbarang, jumlahkeluar FROM detailpenanganan WHERE idpenanganan=$id");
    while($d = mysqli_fetch_assoc($details)){
        mysqli_query($koneksi, "UPDATE barang SET stok = stok + {$d['jumlahkeluar']} WHERE idbarang={$d['idbarang']}");
    }
    mysqli_query($koneksi, "DELETE FROM detailpenanganan WHERE idpenanganan=$id");
    mysqli_query($koneksi, "DELETE FROM penanganan WHERE idpenanganan=$id");
    header("Location: ../index.php?halaman=penanganan&status=sukses_hapus"); exit();
}

// ========== 3. UBAH / EDIT PENANGANAN (Balik dulu baru potong lagi) ==========
if($aksi == 'ubah'){
    $id = (int)$_POST['idpenanganan'];
    $keluhan = mysqli_real_escape_string($koneksi, $_POST['keluhan']);
    $tindakan = mysqli_real_escape_string($koneksi, $_POST['tindakan']);
    $status = mysqli_real_escape_string($koneksi, $_POST['statuspasien']);

    // 1. Balikin stok lama dulu
    $old = mysqli_query($koneksi, "SELECT idbarang, jumlahkeluar FROM detailpenanganan WHERE idpenanganan=$id");
    while($o = mysqli_fetch_assoc($old)){
        mysqli_query($koneksi, "UPDATE barang SET stok = stok + {$o['jumlahkeluar']} WHERE idbarang={$o['idbarang']}");
    }
    mysqli_query($koneksi, "DELETE FROM detailpenanganan WHERE idpenanganan=$id");

    // 2. Update header
    mysqli_query($koneksi, "UPDATE penanganan SET keluhan='$keluhan', tindakan='$tindakan', statuspasien='$status' WHERE idpenanganan=$id");

    // 3. Insert detail baru + potong lagi
    if(isset($_POST['idbarang'])){
        foreach($_POST['idbarang'] as $i => $idb){
            $idb = (int)$idb; $qty = (int)($_POST['jumlahkeluar'][$i] ?? 0);
            if($idb>0 && $qty>0){
                mysqli_query($koneksi, "INSERT INTO detailpenanganan (idpenanganan, idbarang, jumlahkeluar) VALUES ($id, $idb, $qty)");
                mysqli_query($koneksi, "UPDATE barang SET stok = stok - $qty WHERE idbarang=$idb");
            }
        }
    }
    header("Location: ../index.php?halaman=penanganan&status=sukses_ubah"); exit();
}

header("Location: ../index.php?halaman=penanganan"); exit();
?>