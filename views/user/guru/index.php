<?php
// views/user/guru/index.php - FINAL GABUNG UKS.CSS
batasi_akses_role(['admin','petugas']);
$q = mysqli_query($koneksi, "SELECT * FROM guru ORDER BY idguru DESC");
?>
<div class="dash">
  <div class="content-header"><div class="container-fluid"><div class="row mb-2 align-items-center">
    <div class="col-sm-7"><h1 class="m-0 font-weight-bold" style="color:var(--dark)"><i class="fas fa-chalkboard-teacher mr-2" style="color:var(--teal)"></i> Data Pasien Guru</h1><small class="text-muted">UKS Digital - <b style="color:var(--teal)">Admin / Petugas</b> | <span class="badge-mint">GURU • PASIEN</span> | 0103786196</small></div>
    <div class="col-sm-5 text-right"><a href="index.php?halaman=createguru" class="btn-toska"><i class="fas fa-plus mr-1"></i> Tambah Guru</a></div>
  </div></div></div>
  <div class="content"><div class="container-fluid"><div class="uk-card-guru">
    <div class="header-guru"><h6 class="font-weight-bold mb-0" style="color:var(--dark)"><i class="fas fa-chalkboard-teacher mr-2" style="color:var(--teal)"></i> Daftar Guru UKS</h6><span class="badge-mint"><?= mysqli_num_rows($q) ?> Guru</span></div>
    <div class="table-responsive"><table class="table table-hover table-guru">
      <thead><tr><th style="width:70px">No</th><th style="width:90px">Foto</th><th>NIP</th><th>Nama Lengkap Guru</th><th style="width:70px">L/P</th><th>No HP</th><th>Riwayat Alergi</th><th class="text-center" style="width:160px">Aksi</th></tr></thead>
      <tbody>
        <?php $no=1; while($r=mysqli_fetch_assoc($q)){ $foto='assets/images/guru/'.($r['foto']??''); if(empty($r['foto'])||!file_exists($foto)) $foto='assets/images/user/default.png'; $alergi=trim($r['riwayatpenyakit']??$r['riwayatalergi']??''); ?>
        <tr>
          <td class="text-center font-weight-bold text-muted"><?= $no++ ?></td>
          <td><img src="<?= $foto ?>" width="45" height="45" class="foto-guru" onerror="this.src='assets/images/user/default.png'"></td>
          <td><span class="badge-nip"><?= htmlspecialchars($r['nip']??'-') ?></span></td>
          <td><b style="color:var(--dark)"><?= htmlspecialchars($r['namaguru']??'-') ?></b></td>
          <td><b style="color:#dc2626"><?= $r['jeniskelamin']??'P' ?></b></td>
          <td><small class="text-muted"><?= htmlspecialchars($r['nohp']??'-') ?></small></td>
          <td><?php if(empty($alergi)||$alergi=='-'){ ?><i class="text-muted small">- Tidak Ada -</i><?php }else{ ?><span class="badge-alergi"><?= htmlspecialchars($alergi) ?></span><?php } ?></td>
          <td class="text-center">
            <a href="index.php?halaman=showguru&id=<?= $r['idguru'] ?>" class="btn-aksi btn-lihat"><i class="fas fa-eye"></i></a>
            <a href="index.php?halaman=editguru&id=<?= $r['idguru'] ?>" class="btn-aksi btn-edit"><i class="fas fa-edit"></i></a>
            <a href="proses/prosespasien.php?aksi=hapus&jenis=guru&id=<?= $r['idguru'] ?>" onclick="return confirm('Hapus?')" class="btn-aksi btn-hapus"><i class="fas fa-trash"></i></a>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table></div>
  </div></div></div>
</div>