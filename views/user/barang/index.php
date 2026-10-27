<?php
// views/user/barang/index.php - FINAL GABUNG UKS.CSS
batasi_akses_role(['admin','petugas','anggota']);
$isAnggota = strtolower($_SESSION['role']) === 'anggota';
$status = $_GET['status'] ?? '';
?>
<div class="dash">
  <div class="content-header"><div class="container-fluid"><div class="row mb-2 align-items-center">
    <div class="col-sm-6"><h1 class="m-0 font-weight-bold" style="color:var(--dark)"><i class="fas fa-boxes mr-2" style="color:var(--teal)"></i> Lemari Obat & Alkes</h1><small class="text-muted">UKS Digital - <b style="color:var(--teal)">Admin / Petugas / Anggota</b> | <span class="badge-mint">BARANG • OBAT</span></small></div>
    <div class="col-sm-6 text-right">
      <?php if(!$isAnggota): ?>
      <a href="index.php?halaman=createbarang" class="btn-toska"><i class="fas fa-plus mr-1"></i> Tambah Barang</a>
      <a href="index.php?halaman=kategori" class="btn-outline-bar ml-1"><i class="fas fa-tags mr-1"></i> Kategori</a>
      <?php endif; ?>
    </div>
  </div></div></div>
  <div class="content"><div class="container-fluid">
    <?php if($status=='sukses_tambah'): ?><div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><i class="fas fa-check"></i> Obat ditambahkan!</div><?php endif; ?>
    <?php if($status=='sukses_ubah'): ?><div class="alert alert-info alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><i class="fas fa-edit"></i> Obat diubah!</div><?php endif; ?>
    <?php if($status=='sukses_hapus'): ?><div class="alert alert-warning">Obat dihapus!</div><?php endif; ?>
    <?php $q = mysqli_query($koneksi,"SELECT b.*, k.namakategori FROM barang b LEFT JOIN kategori k ON b.idkategori=k.idkategori ORDER BY b.tanggalkadaluarsa ASC, b.idbarang DESC"); ?>
    <div class="uk-card-bar">
      <div class="header-bar"><h6 class="font-weight-bold mb-0" style="color:var(--dark)"><i class="fas fa-boxes mr-2" style="color:var(--teal)"></i> Daftar Obat & Alkes</h6><span class="badge-mint"><?= mysqli_num_rows($q) ?> Barang</span></div>
      <div class="table-responsive"><table class="table table-hover table-bar">
        <thead><tr><th style="width:50px">#</th><th style="width:80px">Foto</th><th>Nama Sediaan</th><th>Kategori</th><th>Stok</th><th>Kadaluarsa</th><th>Masuk</th><th class="text-center" style="width:190px">Aksi</th></tr></thead>
        <tbody>
          <?php $no=1; while($b=mysqli_fetch_assoc($q)):
          $stok=(int)($b['stok']??0); $expTime = strtotime($b['tanggalkadaluarsa'] ?? date('Y-m-d')); $isExp = $expTime < time(); $isKritis = $stok<=5 && $stok>0;
          ?>
<tr class="<?= $isExp?'table-danger row-habis':($stok==0?'table-danger row-habis':($isKritis?'table-warning row-kritis':'')) ?>">            <td class="text-center font-weight-bold text-muted"><?= $no++ ?></td>
            <td><img src="assets/images/barang/<?= htmlspecialchars($b['foto'] ?? 'default_obat.png') ?>" width="45" height="45" class="foto-bar" onerror="this.src='assets/images/barang/default_obat.png'"></td>
            <td><b style="color:var(--dark)"><?= htmlspecialchars($b['namabarang']) ?></b><br><small class="text-muted"><?= htmlspecialchars($b['satuan'] ?? '') ?></small><?php if($isExp): ?><br><span class="badge-exp">KADALUARSA</span><?php endif; ?></td>
            <td><span class="badge-kat"><?= htmlspecialchars($b['namakategori'] ?? 'Umum') ?></span></td>
<td class="<?= $stok==0?'stok-habis':($isKritis?'stok-kritis':'') ?>">
  <span class="stok-angka"><?= $stok ?></span>
  <?php if($stok==0): ?><br><span class="label-habis">⚠ HABIS</span>
  <?php elseif($isKritis): ?><br><span class="label-menipis">⚠ MENIPIS</span><?php endif; ?>
</td>            <td class="<?= $isExp?'text-danger font-weight-bold':'' ?>"><small><?= date('d/m/Y',$expTime) ?></small></td>
            <td><small><?= isset($b['tanggalmasuk']) ? date('d/m/Y',strtotime($b['tanggalmasuk'])) : '-' ?></small></td>
            <td class="text-center"><div class="aksi-wrap">
              <a href="index.php?halaman=showbarang&id=<?= $b['idbarang'] ?>" class="btn-aksi btn-lihat" title="Detail"><i class="fas fa-eye"></i></a>
              <?php if(!$isAnggota): ?>
              <a href="index.php?halaman=editbarang&id=<?= $b['idbarang'] ?>" class="btn-aksi btn-edit" title="Edit"><i class="fas fa-edit"></i></a>
              <a href="proses/prosesbarang.php?aksi=hapus&id=<?= $b['idbarang'] ?>" onclick="return confirm('Hapus <?= addslashes($b['namabarang']) ?>?')" class="btn-aksi btn-hapus" title="Hapus"><i class="fas fa-trash"></i></a>
              <?php endif; ?>
            </div></td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table></div>
      <div class="p-3" style="border-top:1px solid #e0f2f1;background:var(--mint2)"><small class="text-muted"><i class="fas fa-info-circle"></i> Merah = kadaluarsa, Kuning = stok ≤5 <?= $isAnggota?'<br><b>Mode Anggota: Hanya Lihat Stok (Read Only)</b>':'' ?></small></div>
    </div>
  </div></div>
</div>