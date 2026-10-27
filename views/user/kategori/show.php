<?php
// views/user/kategori/show.php - FINAL GABUNG UKS.CSS
batasi_akses_role(['admin','petugas']);
$id=(int)($_GET['id']??0);
$kat=mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT * FROM kategori WHERE idkategori=$id"));
if(!$kat){ header("Location: index.php?halaman=kategori"); exit(); }
$obat=mysqli_query($koneksi,"SELECT * FROM barang WHERE idkategori=$id");
?>
<div class="dash">
  <div class="content-header"><div class="container-fluid"><div class="row mb-2 align-items-center">
    <div class="col-sm-7"><h1 class="m-0 font-weight-bold" style="color:var(--dark)"><i class="fas fa-tags mr-2" style="color:var(--teal)"></i> <?= htmlspecialchars($kat['namakategori']) ?></h1><small class="text-muted">UKS Digital - <b style="color:var(--teal)">Detail Kategori</b> | <span class="badge-mint"><?= mysqli_num_rows($obat) ?> Obat</span></small></div>
    <div class="col-sm-5 text-right"><a href="index.php?halaman=kategori" class="btn-toska"><i class="fas fa-arrow-left mr-1"></i> Kembali</a></div>
  </div></div></div>
  <div class="content"><div class="container-fluid"><div class="row">
    <div class="col-md-4"><div class="uk-card-kat text-center p-4">
      <div class="icon-kat"><i class="fas fa-prescription-bottle-alt"></i></div>
      <h5 class="font-weight-bold" style="color:var(--dark)"><?= htmlspecialchars($kat['namakategori']) ?></h5>
      <p class="text-muted small"><?= htmlspecialchars($kat['deskripsi']??'-') ?></p>
      <span class="badge-mint"><?= mysqli_num_rows($obat) ?> Obat di Kategori Ini</span>
    </div></div>
    <div class="col-md-8"><div class="uk-card-kat">
      <div class="header-kat"><h6 class="font-weight-bold mb-0" style="color:var(--dark)"><i class="fas fa-pills mr-2" style="color:var(--teal)"></i> Daftar Obat di Kategori Ini</h6><span class="badge-mint"><?= mysqli_num_rows($obat) ?> Item</span></div>
      <div class="table-responsive"><table class="table table-hover table-kat"><thead><tr><th>Nama Obat</th><th style="width:120px">Stok</th></tr></thead><tbody><?php while($b=mysqli_fetch_assoc($obat)){ echo '<tr><td><b style="color:var(--dark)">'.htmlspecialchars($b['namabarang']).'</b></td><td><span class="badge-jml">'.$b['stok'].' '.$b['satuan'].'</span></td></tr>'; } if(mysqli_num_rows($obat)==0) echo '<tr><td colspan="2" class="text-center text-muted p-3">Belum ada obat di kategori ini</td></tr>'; ?></tbody></table></div>
    </div></div>
  </div>
  <div class="mt-3"><a href="index.php?halaman=kategori" class="btn-toska">Kembali ke Daftar</a></div>
  </div></div>
</div>