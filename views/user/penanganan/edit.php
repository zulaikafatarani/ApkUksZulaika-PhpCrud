<?php batasi_akses_role(['admin','petugas','anggota']);
$id=(int)($_GET['id']??0);
$p=mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT * FROM penanganan WHERE idpenanganan=$id"));
if(!$p){ header("Location: index.php?halaman=penanganan"); exit(); }
$detail=mysqli_query($koneksi,"SELECT * FROM detailpenanganan WHERE idpenanganan=$id");
$barangList=mysqli_query($koneksi,"SELECT * FROM barang ORDER BY namabarang ASC");
?>
<div class="content-header"><div class="container-fluid"><h1 class="m-0 text-success font-weight-bold">Edit Penanganan #<?= $id ?></h1></div></div>
<div class="content"><div class="container-fluid"><form action="proses/prosespenanganan.php?aksi=ubah" method="POST">
<input type="hidden" name="idpenanganan" value="<?= $id ?>">
<div class="card card-success card-outline shadow-sm"><div class="card-body">
<div class="form-group"><label>Keluhan</label><textarea name="keluhan" class="form-control" required><?= htmlspecialchars($p['keluhan']) ?></textarea></div>
<div class="form-group"><label>Tindakan</label><textarea name="tindakan" class="form-control" required><?= htmlspecialchars($p['tindakan']) ?></textarea></div>
<div class="form-group"><label>Status</label><select name="statuspasien" class="form-control"><option value="istirahat" <?= $p['statuspasien']=='istirahat'?'selected':'' ?>>Istirahat</option><option value="sembuh" <?= $p['statuspasien']=='sembuh'?'selected':'' ?>>Sembuh</option><option value="rujuk" <?= $p['statuspasien']=='rujuk'?'selected':'' ?>>Rujuk</option></select></div>
<hr><label>Obat Dipakai (sistem akan balikin stok lama dulu, baru potong lagi)</label>
<div id="wrapperObat">
<?php while($d=mysqli_fetch_assoc($detail)): ?>
<div class="row mb-2 item-obat"><div class="col-7"><select name="idbarang[]" class="form-control"><option value="">-- Pilih Obat --</option><?php mysqli_data_seek($barangList,0); while($b=mysqli_fetch_assoc($barangList)): ?><option value="<?= $b['idbarang'] ?>" <?= $b['idbarang']==$d['idbarang']?'selected':'' ?>><?= $b['namabarang'] ?> (Stok: <?= $b['stok'] ?>)</option><?php endwhile; ?></select></div><div class="col-3"><input type="number" name="jumlahkeluar[]" class="form-control" value="<?= $d['jumlahkeluar'] ?>"></div><div class="col-2"><button type="button" class="btn btn-danger btn-sm btnHapus w-100"><i class="fas fa-trash"></i></button></div></div>
<?php endwhile; ?>
</div>
<button type="button" id="btnTambah" class="btn btn-success btn-xs mt-2"><i class="fas fa-plus"></i> Tambah Obat</button>
</div>
<div class="card-footer bg-light text-right"><a href="index.php?halaman=penanganan" class="btn btn-secondary">Batal</a> <button type="submit" class="btn btn-success">Update</button></div>
</div></form></div></div>
<script>
document.getElementById('btnTambah').addEventListener('click', function(){
    let first = document.querySelector('.item-obat'); if(!first) return;
    let clone = first.cloneNode(true); document.getElementById('wrapperObat').appendChild(clone);
});
document.addEventListener('click', function(e){ if(e.target.closest('.btnHapus')) e.target.closest('.item-obat').remove(); });
</script>