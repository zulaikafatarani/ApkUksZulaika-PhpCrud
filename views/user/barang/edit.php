<?php batasi_akses_role(['admin','petugas','anggota']);
$id = (int)($_GET['id'] ?? 0);
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM barang WHERE idbarang=$id"));
if(!$data){ header("Location: index.php?halaman=barang"); exit(); }
$qKat = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY namakategori ASC");
?>
<div class="content-header"><div class="container-fluid"><div class="row mb-2">
    <div class="col-sm-6"><h1 class="m-0 font-weight-bold text-success"><i class="fas fa-edit mr-1"></i>Ubah Obat</h1></div>
    <div class="col-sm-6 text-right"><a href="index.php?halaman=barang" class="btn btn-outline-secondary btn-sm rounded-pill px-3">Kembali</a></div>
</div></div></div>
<div class="content"><div class="container-fluid"><div class="card card-success card-outline shadow-sm">
    <form action="proses/prosesbarang.php?aksi=ubah" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="idbarang" value="<?= $data['idbarang'] ?>">
        <input type="hidden" name="foto_lama" value="<?= $data['foto'] ?>">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group"><label>Nama</label><input type="text" name="namabarang" class="form-control" value="<?= htmlspecialchars($data['namabarang']) ?>" required></div>
                    <div class="form-group"><label>Kategori</label>
                        <select name="idkategori" class="form-control" required>
                            <?php while($k=mysqli_fetch_assoc($qKat)): ?><option value="<?= $k['idkategori'] ?>" <?= $k['idkategori']==$data['idkategori']?'selected':'' ?>><?= htmlspecialchars($k['namakategori']) ?></option><?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group"><label>Foto Lama</label><br><img src="assets/images/barang/<?= $data['foto'] ?>" style="max-height:90px" class="img-thumbnail" onerror="this.src='assets/images/barang/default_obat.png'"></div>
                </div>
                <div class="col-md-6">
                    <div class="row"><div class="col-6"><div class="form-group"><label>Stok</label><input type="number" name="stok" class="form-control" value="<?= $data['stok'] ?>" required></div></div><div class="col-6"><div class="form-group"><label>Satuan</label><input type="text" name="satuan" class="form-control" value="<?= htmlspecialchars($data['satuan']) ?>" required></div></div></div>
                    <div class="form-group"><label>Kadaluarsa</label><input type="date" name="tanggalkadaluarsa" class="form-control" value="<?= $data['tanggalkadaluarsa'] ?>" required></div>
                    <div class="form-group"><label>Tanggal Masuk</label><input type="date" name="tanggalmasuk" class="form-control" value="<?= $data['tanggalmasuk'] ?>" required></div>
                    <div class="form-group"><label>Ganti Foto (opsional)</label><input type="file" name="foto" class="form-control-file border p-1 rounded" accept="image/*"></div>
                </div>
            </div>
        </div>
        <div class="card-footer bg-light text-right"><button type="submit" name="update" class="btn btn-success font-weight-bold px-4">Simpan Perubahan</button></div>
    </form>
</div></div></div>