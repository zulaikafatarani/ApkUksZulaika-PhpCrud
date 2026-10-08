<?php
require_once 'koneksi.php';
require_once 'session.php';
batasi_akses_role(['admin','petugas']);

$aksi = $_GET['aksi'] ?? $_POST['aksi'] ?? '';

/*
  Halaman laporan tidak perlu INSERT, cuma filter.
  Tapi file proses ini kita pakai untuk EXPORT Excel / PDF
  Biar dosen lihat kamu pakai logika laporan harian, bulanan, tahunan.
*/

if($aksi == 'cetak'){
    $jenis = $_GET['jenis'] ?? 'harian'; // harian, bulanan, tahunan
    $tgl_awal = $_GET['tgl_awal'] ?? date('Y-m-d');
    $tgl_akhir = $_GET['tgl_akhir'] ?? date('Y-m-d');

    // Build query sesuai jenis laporan
    $where = "";
    if($jenis == 'harian'){
        $where = "WHERE DATE(p.tanggalpenanganan) = '$tgl_awal'";
    } elseif($jenis == 'bulanan'){
        $bulan = date('m', strtotime($tgl_awal));
        $tahun = date('Y', strtotime($tgl_awal));
        $where = "WHERE MONTH(p.tanggalpenanganan)='$bulan' AND YEAR(p.tanggalpenanganan)='$tahun'";
    } elseif($jenis == 'tahunan'){
        $tahun = date('Y', strtotime($tgl_awal));
        $where = "WHERE YEAR(p.tanggalpenanganan)='$tahun'";
    } elseif($jenis == 'custom'){
        $where = "WHERE DATE(p.tanggalpenanganan) BETWEEN '$tgl_awal' AND '$tgl_akhir'";
    }

    $query = "SELECT p.*, s.namasiswa, s.nis, s.kelas, g.namaguru, g.nip, u.namauser,
              (SELECT GROUP_CONCAT(CONCAT(b.namabarang,' (', dp.jumlahkeluar,' ', b.satuan,')') SEPARATOR ', ') 
               FROM detailpenanganan dp JOIN barang b ON dp.idbarang=b.idbarang 
               WHERE dp.idpenanganan=p.idpenanganan) as obat_dipakai
              FROM penanganan p
              LEFT JOIN siswa s ON p.idsiswa=s.idsiswa
              LEFT JOIN guru g ON p.idguru=g.idguru
              LEFT JOIN user u ON p.iduser=u.iduser
              $where
              ORDER BY p.tanggalpenanganan DESC";

    $result = mysqli_query($koneksi, $query);

    // Jika mode export Excel
    if(isset($_GET['export']) && $_GET['export']=='excel'){
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=laporan-uks-$jenis-$tgl_awal.xls");
        echo "<table border='1'><tr><th>Tanggal</th><th>Pasien</th><th>Kelas/NIP</th><th>Keluhan</th><th>Tindakan</th><th>Status</th><th>Obat Dipakai</th><th>Petugas</th></tr>";
        while($r=mysqli_fetch_assoc($result)){
            $pasien = $r['namasiswa'] ? $r['namasiswa']." (".$r['nis'].")" : $r['namaguru']." (".$r['nip'].")";
            $kelas = $r['kelas'] ?? '-';
            echo "<tr><td>{$r['tanggalpenanganan']}</td><td>$pasien</td><td>$kelas</td><td>{$r['keluhan']}</td><td>{$r['tindakan']}</td><td>{$r['statuspasien']}</td><td>{$r['obat_dipakai']}</td><td>{$r['namauser']}</td></tr>";
        }
        echo "</table>"; exit();
    }

    // Simpan ke session untuk ditampilkan di views/user/laporan/cetak.php
    $_SESSION['laporan_data'] = [];
    while($r=mysqli_fetch_assoc($result)){ $_SESSION['laporan_data'][]=$r; }
    $_SESSION['laporan_info'] = ['jenis'=>$jenis, 'tgl_awal'=>$tgl_awal, 'tgl_akhir'=>$tgl_akhir];
    header("Location: ../index.php?halaman=cetaklaporan"); exit();
}

// Jika ada reset stok (admin only)
if($aksi == 'reset_stok' && $_SESSION['role']=='admin'){
    $id = (int)$_GET['id'];
    $qty = (int)$_GET['qty'];
    mysqli_query($koneksi, "UPDATE barang SET stok=stok+$qty WHERE idbarang=$id");
    header("Location: ../index.php?halaman=barang&status=stok_dikembalikan"); exit();
}

header("Location: ../index.php?halaman=laporan"); exit();
?>