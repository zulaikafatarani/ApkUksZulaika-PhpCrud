<?php
// views/user/penanganan/index.php - FINAL FIX - u.namauser + tombol cetak
batasi_akses_role(['admin','petugas','anggota']);
$q=mysqli_query($koneksi,"SELECT p.*, s.namasiswa, s.nis, s.kelas, s.foto as foto_siswa, g.namaguru, g.nip, u.namauser FROM penanganan p LEFT JOIN siswa s ON p.idsiswa=s.idsiswa LEFT JOIN guru g ON p.idguru=g.idguru LEFT JOIN user u ON p.iduser=u.iduser ORDER BY p.tanggalpenanganan DESC, p.idpenanganan DESC");
$status=$_GET['status']??'';
if($status=='sukses_tambah') echo '<div class="alert alert-success"><i class="fas fa-check"></i> Penanganan disimpan, stok otomatis terpotong!</div>';
if($status=='sukses_hapus') echo '<div class="alert alert-warning"><i class="fas fa-undo"></i> Penanganan dihapus, stok dikembalikan!</div>';
if($status=='sukses_ubah') echo '<div class="alert alert-info"><i class="fas fa-edit"></i> Penanganan diubah!</div>';
if($status=='stok_kurang') echo '<div class="alert alert-danger"><i class="fas fa-times"></i> Gagal! Stok obat ID '.$_GET['idb'].' tidak cukup!</div>';
?>
<div class="dash">
  <div class="content-header">
    <div class="container-fluid"><div class="row mb-2 align-items-center">
      <div class="col-sm-7"><h1 class="m-0 font-weight-bold" style="color:var(--dark)"><i class="fas fa-hand-holding-medical mr-2" style="color:var(--teal)"></i> Data Penanganan UKS</h1><small class="text-muted">UKS Digital - <b style="color:var(--teal)">Admin / Petugas / Anggota</b> | <span class="badge-mint">PENANGANAN • PASIEN</span> | 0103786196</small></div>
      <div class="col-sm-5 text-right"><a href="index.php?halaman=createpenanganan" class="btn-toska"><i class="fas fa-plus mr-1"></i> Tangani Pasien Baru</a></div>
    </div></div>
  </div>
  <div class="content"><div class="container-fluid">
    <div class="uk-card-pen">
      <div class="header-pen"><h6 class="font-weight-bold mb-0" style="color:var(--dark)"><i class="fas fa-hand-holding-medical mr-2" style="color:var(--teal)"></i> Daftar Penanganan</h6><span class="badge-mint"><?= mysqli_num_rows($q) ?> Penanganan</span></div>
      <div class="table-responsive"><table class="table table-hover table-pen">
        <thead><tr><th style="width:40px">#</th><th>Tanggal</th><th>Pasien</th><th>Keluhan</th><th>Tindakan</th><th>Status</th><th>Petugas</th><th class="text-center" style="width:210px">Aksi</th></tr></thead>
        <tbody>
          <?php $no=1; while($r=mysqli_fetch_assoc($q)):
          $pasien = $r['namasiswa'] ? $r['namasiswa'].'<br><small class="text-muted">'.$r['nis'].' - '.$r['kelas'].'</small>' : $r['namaguru'].'<br><small class="text-muted">'.$r['nip'].'</small>';
          ?>
          <tr>
            <td class="text-center font-weight-bold text-muted"><?= $no++ ?></td>
            <td><small class="font-weight-bold"><?= date('d/m/Y',strtotime($r['tanggalpenanganan'])) ?></small></td>
            <td><b style="color:var(--dark)"><?= $pasien ?></b></td>
            <td><small><?= htmlspecialchars(substr($r['keluhan'],0,35)) ?>...</small></td>
            <td><small><?= htmlspecialchars(substr($r['tindakan'],0,35)) ?>...</small></td>
            <td><?php if($r['statuspasien']=='sembuh'): ?><span class="badge-sembuh">Sembuh</span><?php elseif($r['statuspasien']=='rujuk'): ?><span class="badge-rujuk">Rujuk</span><?php else: ?><span class="badge-istirahat">Istirahat</span><?php endif; ?></td>
            <td><small><?= $r['namauser'] ?></small></td>
            <td class="text-center">
              <a href="index.php?halaman=showpenanganan&id=<?= $r['idpenanganan'] ?>" class="btn-aksi btn-lihat" title="Lihat"><i class="fas fa-eye"></i></a>
              <a href="index.php?halaman=cetaksurat&id=<?= $r['idpenanganan'] ?>" class="btn-aksi" style="background:linear-gradient(90deg,#0f766e,#14b8a6); color:white!important" title="Cetak Surat Izin / Rujukan"><i class="fas fa-file-medical"></i></a>
              <a href="index.php?halaman=editpenanganan&id=<?= $r['idpenanganan'] ?>" class="btn-aksi btn-edit" title="Edit"><i class="fas fa-edit"></i></a>
              <a href="proses/prosespenanganan.php?aksi=hapus&id=<?= $r['idpenanganan'] ?>" onclick="return confirm('Hapus penanganan ini? Stok obat akan dikembalikan otomatis!')" class="btn-aksi btn-hapus" title="Hapus"><i class="fas fa-trash"></i></a>
            </td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table></div>
      <div class="p-3" style="border-top:1px solid #e0f2f1;background:var(--mint2)"><small class="text-muted"><i class="fas fa-file-medical mr-1" style="color:var(--teal)"></i> Cetak Surat = Surat Izin / Rujukan resmi UKS dengan QR verifikasi. Hapus = stok balik otomatis.</small></div>
    </div>
  </div></div>
</div>