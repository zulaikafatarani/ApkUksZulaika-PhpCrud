<?php
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$barang = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT b.*, k.namakategori FROM barang b LEFT JOIN kategori k ON b.idkategori=k.idkategori WHERE b.idbarang=$id"));
if(!$barang){ echo "<div class='container py-5 text-center'><h4>Obat tidak ditemukan</h4><a href='index.php?halaman=daftarobat' class='btn btn-success rounded-pill mt-3'>Kembali</a></div>"; return; }

// Hitung berapa kali obat ini sudah dipakai (dari detailpenanganan)
$pakai = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(jumlahkeluar) as total FROM detailpenanganan WHERE idbarang=$id"))['total'] ?? 0;
?>
<section class="py-5 bg-light">
<div class="container">
    <a href="index.php?halaman=daftarobat" class="btn btn-outline-secondary btn-sm rounded-pill mb-4"><i class="fas fa-arrow-left mr-1"></i> Kembali ke Katalog</a>
    <div class="row">
        <div class="col-md-5 mb-4">
            <div class="card border-0 shadow-sm" style="border-radius:15px; overflow:hidden;">
                <div class="bg-white p-4 text-center" style="height:350px; display:flex; align-items:center; justify-content:center;">
                    <?php $foto = !empty($barang['foto']) ? $barang['foto'] : 'default_obat.png'; ?>
                    <img src="assets/images/barang/<?= $foto ?>" style="max-height:300px; max-width:100%; object-fit:contain;" onerror="this.src='assets/images/barang/default_obat.png'">
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card border-0 shadow-sm" style="border-radius:15px;">
                <div class="card-body p-4">
                    <span class="badge badge-success mb-2"><?= htmlspecialchars($barang['namakategori']) ?></span>
                    <h2 class="font-weight-bold text-dark"><?= htmlspecialchars($barang['namabarang']) ?></h2>
                    
                    <div class="row mt-4">
                        <div class="col-6 mb-3"><small class="text-muted d-block">Sisa Stok Gratis</small><h4 class="font-weight-bold <?= $barang['stok']>0?'text-success':'text-danger' ?>"><?= $barang['stok'] ?> <?= $barang['satuan'] ?></h4></div>
                        <div class="col-6 mb-3"><small class="text-muted d-block">Tanggal Masuk</small><b><?= date('d M Y', strtotime($barang['tanggalmasuk'])) ?></b></div>
                        <div class="col-6 mb-3"><small class="text-muted d-block">Kadaluarsa</small><b class="<?= strtotime($barang['tanggalkadaluarsa']) < time() ? 'text-danger' : '' ?>"><?= date('d M Y', strtotime($barang['tanggalkadaluarsa'])) ?></b></div>
                        <div class="col-6 mb-3"><small class="text-muted d-block">Total Terpakai</small><b><?= $pakai ?> <?= $barang['satuan'] ?> (Transaksi)</b></div>
                    </div>

                    <hr>
                    <h6 class="font-weight-bold"><i class="fas fa-notes-medical text-success mr-1"></i> Aturan Pakai & Khasiat</h6>
                    <p class="text-muted small" style="line-height:1.8;">
                        <?php
                        // Karena di tabel barang laporan kamu tidak ada kolom khasiat, kita buat deskripsi otomatis sesuai kategori
                        if(stripos($barang['namakategori'],'Bebas')!==false) echo "Obat bebas untuk keluhan ringan seperti demam, pusing, batuk. Dapat diberikan langsung oleh petugas PMR setelah pemeriksaan keluhan di <code>penanganan</code>.";
                        elseif(stripos($barang['namakategori'],'Keras')!==false) echo "Obat keras - <b>Harus dengan resep/rujukan petugas</b>. Stok dipotong otomatis saat input di menu Penanganan Pasien (relasi <code>detailpenanganan</code>).";
                        else echo "Alat Kesehatan / P3K untuk tindakan pertolongan pertama di ruang UKS SMKN 1 Karang Baru.";
                        ?>
                        <br><br>
                        <b>Dosis Umum:</b> <?= htmlspecialchars($barang['namabarang']) ?> diberikan sesuai keluhan yang dicatat di tabel <code>penanganan.tindakan</code>. Pastikan cek tanggal kadaluarsa sebelum digunakan.
                    </p>

                    <div class="alert alert-success small border-0 mt-3">
                        <i class="fas fa-info-circle mr-1"></i> Obat ini GRATIS untuk siswa & guru. Tidak ada harga (sesuai revisi laporanmu). Ambil di ruang UKS Lt.1 dengan menunjukkan kartu pelajar.
                    </div>

                    <a href="index.php?halaman=cekriwayat" class="btn btn-success rounded-pill px-4 font-weight-bold mt-2"><i class="fas fa-search mr-1"></i> Cek Apakah Saya Pernah Pakai Obat Ini?</a>
                </div>
            </div>
        </div>
    </div>
</div>
</section>