<?php
// views/user/penanganan/edit.php - FINAL GABUNG UKS.CSS
batasi_akses_role(['admin','petugas','anggota']);
$id=(int)($_GET['id']??0);
$p=mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT * FROM penanganan WHERE idpenanganan=$id"));
if(!$p){ header("Location: index.php?halaman=penanganan"); exit(); }
$detail=mysqli_query($koneksi,"SELECT * FROM detailpenanganan WHERE idpenanganan=$id");
$barangList=mysqli_query($koneksi,"SELECT * FROM barang ORDER BY namabarang ASC");
?>
<div class="dash">
  <div class="content-header"><div class="container-fluid"><div class="row mb-2 align-items-center"><div class="col-sm-7"><h1 class="m-0 font-weight-bold" style="color:var(--dark)"><i class="fas fa-edit mr-2" style="color:var(--teal)"></i> Edit Penanganan #<?= $id ?></h1><small class="text-muted">UKS Digital - <b style="color:var(--teal)">Ubah Data</b> | Stok lama dikembalikan dulu, baru dipotong lagi</small></div><div class="col-sm-5 text-right"><a href="index.php?halaman=penanganan" class="btn-toska"><i class="fas fa-arrow-left mr-1"></i> Kembali</a></div></div></div></div>
  <div class="content"><div class="container-fluid"><form action="proses/prosespenanganan.php?aksi=ubah" method="POST">
    <input type="hidden" name="idpenanganan" value="<?= $id ?>">
    <div class="uk-card-pen"><div class="p-4">
      <div class="form-group"><label class="font-weight-bold">Keluhan</label><textarea name="keluhan" class="form-control" required><?= htmlspecialchars($p['keluhan']) ?></textarea></div>
      <div class="form-group"><label class="font-weight-bold">Tindakan</label><textarea name="tindakan" class="form-control" required><?= htmlspecialchars($p['tindakan']) ?></textarea></div>
      <div class="form-group"><label class="font-weight-bold">Status</label><select name="statuspasien" class="form-control"><option value="istirahat" <?= $p['statuspasien']=='istirahat'?'selected':'' ?>>Istirahat</option><option value="sembuh" <?= $p['statuspasien']=='sembuh'?'selected':'' ?>>Sembuh</option><option value="rujuk" <?= $p['statuspasien']=='rujuk'?'selected':'' ?>>Rujuk</option></select></div>
      <hr><label class="font-weight-bold">Obat Dipakai (sistem akan balikin stok lama dulu, baru potong lagi)</label>
      <div id="wrapperObat">
        <?php while($d=mysqli_fetch_assoc($detail)): ?>
        <div class="row mb-2 item-obat"><div class="col-7"><select name="idbarang[]" class="form-control"><option value="">-- Pilih Obat --</option><?php mysqli_data_seek($barangList,0); while($b=mysqli_fetch_assoc($barangList)): ?><option value="<?= $b['idbarang'] ?>" <?= $b['idbarang']==$d['idbarang']?'selected':'' ?>><?= $b['namabarang'] ?> (Stok: <?= $b['stok'] ?>)</option><?php endwhile; ?></select></div><div class="col-3"><input type="number" name="jumlahkeluar[]" class="form-control" value="<?= $d['jumlahkeluar'] ?>"></div><div class="col-2"><button type="button" class="btn btn-danger btn-sm btnHapus w-100" style="border-radius:50%; width:42px; height:42px"><i class="fas fa-trash"></i></button></div></div>
        <?php endwhile; ?>
      </div>
      <button type="button" id="btnTambah" class="btn-toska mt-2"><i class="fas fa-plus mr-1"></i> Tambah Obat</button>
    </div>
    <div class="p-3 text-right" style="border-top:1px solid #e0f2f1;background:var(--mint2)"><a href="index.php?halaman=penanganan" class="btn btn-secondary" style="border-radius:30px; padding:8px 20px">Batal</a> <button type="submit" class="btn-toska">Update</button></div>
    </div></form></div></div>
</div>
<script>
document.getElementById('btnTambah').addEventListener('click', function(){
    let first = document.querySelector('.item-obat'); if(!first) return;
    let clone = first.cloneNode(true); document.getElementById('wrapperObat').appendChild(clone);
});
document.addEventListener('click', function(e){ if(e.target.closest('.btnHapus')) e.target.closest('.item-obat').remove(); });
</script>