<?php
// views/user/kategori/index.php - FINAL GABUNG UKS.CSS
batasi_akses_role(['admin','petugas']);
$q = mysqli_query($koneksi, "SELECT k.*, (SELECT COUNT(*) FROM barang b WHERE b.idkategori=k.idkategori) as jml FROM kategori k ORDER BY k.namakategori ASC");
?>
<div class="dash">
  <div class="content-header"><div class="container-fluid"><div class="row mb-2 align-items-center">
    <div class="col-sm-7"><h1 class="m-0 font-weight-bold" style="color:var(--dark)"><i class="fas fa-tags mr-2" style="color:var(--teal)"></i> Kategori Obat</h1><small class="text-muted">UKS Digital - <b style="color:var(--teal)">Admin / Petugas</b> | <span class="badge-mint">KATEGORI • BARANG</span> | 0103786196</small></div>
    <div class="col-sm-5 text-right"><a href="index.php?halaman=createkategori" class="btn-toska"><i class="fas fa-plus mr-1"></i> Tambah Kategori</a></div>
  </div></div></div>
  <div class="content"><div class="container-fluid"><div class="uk-card-kat">
    <div class="header-kat"><h6 class="font-weight-bold mb-0" style="color:var(--dark)"><i class="fas fa-tags mr-2" style="color:var(--teal)"></i> Daftar Kategori UKS</h6><span class="badge-mint"><?= mysqli_num_rows($q) ?> Kategori</span></div>
    <div class="table-responsive"><table class="table table-hover table-kat">
      <thead><tr><th style="width:70px">No</th><th>Nama Kategori</th><th>Deskripsi</th><th style="width:120px">Jml Obat</th><th class="text-center" style="width:160px">Aksi</th></tr></thead>
      <tbody>
        <?php $no=1; while($r=mysqli_fetch_assoc($q)){ ?>
        <tr>
          <td class="text-center font-weight-bold text-muted"><?= $no++ ?></td>
          <td><b style="color:var(--dark)"><?= htmlspecialchars($r['namakategori']) ?></b></td>
          <td><small><?= htmlspecialchars($r['deskripsi']??'-') ?></small></td>
          <td><span class="badge-jml"><?= $r['jml'] ?> item</span></td>
          <td class="text-center">
            <a href="index.php?halaman=showkategori&id=<?= $r['idkategori'] ?>" class="btn-aksi btn-lihat"><i class="fas fa-eye"></i></a>
            <a href="index.php?halaman=editkategori&id=<?= $r['idkategori'] ?>" class="btn-aksi btn-edit"><i class="fas fa-edit"></i></a>
            <a href="proses/prosesbarang.php?hapus_kategori=<?= $r['idkategori'] ?>" onclick="return confirm('Hapus kategori ini?')" class="btn-aksi btn-hapus"><i class="fas fa-trash"></i></a>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table></div>
  </div></div></div>
</div>