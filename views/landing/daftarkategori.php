<?php
/*
|--------------------------------------------------------------------------
| QUERY AMBIL DATA KATEGORI & HITUNG JUMLAH SEDIAAN OBAT (UKS VERSION)
|--------------------------------------------------------------------------
*/
$query = "SELECT kategori.*, COUNT(barang.idbarang) AS jumlahobat
          FROM kategori
          LEFT JOIN barang ON barang.idkategori = kategori.idkategori
          GROUP BY kategori.idkategori
          ORDER BY kategori.idkategori DESC";

$result = mysqli_query($koneksi, $query);
?>

<section class="py-5 bg-light">
    <div class="container">

        <!-- Kepala Halaman Penelusuran Kategori Lemari Obat -->
        <div class="text-center mb-5">
            <h1 class="font-weight-bold text-success">
                <i class="fas fa-boxes mr-2"></i>Klasifikasi Kategori Obat
            </h1>
            <p class="text-muted mb-0">
                Jelajahi sediaan logistik medis dan pertolongan pertama berdasarkan fungsi klinis obat.
            </p>
        </div>

        <div class="row">
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($kategori = mysqli_fetch_assoc($result)): ?>
                    
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100 border-0 shadow-sm" style="border-radius: 10px;">
                            <div class="card-body text-center p-4">

                                <!-- Mengubah ikon menjadi warna hijau kesuksesan medis (UKS) -->
                                <div class="mb-3 text-success">
                                    <i class="fas fa-prescription-bottle-alt fa-3x"></i>
                                </div>

                                <h4 class="font-weight-bold text-dark">
                                    <?= htmlspecialchars($kategori['namakategori']); ?>
                                </h4>

                                <!-- Mengubah teks "produk" menjadi "jenis obat" agar sesuai rekam medis -->
                                <p class="text-muted mb-4 small font-weight-bold">
                                    <i class="fas fa-pills mr-1 text-secondary"></i>
                                    <?= (int) $kategori['jumlahobat']; ?> jenis sediaan obat terdaftar
                                </p>

                                <!-- Menghubungkan link tujuan filter sesuai variabel rute index Anda -->
                                <a href="index.php?halaman=daftarkategori&idkategori=<?= $kategori['idkategori']; ?>"
                                   class="btn btn-success btn-block font-weight-bold shadow-sm rounded-pill text-white">
                                    <i class="fas fa-notes-medical mr-1"></i>
                                    Buka Katalog Obat
                                </a>

                            </div>
                        </div>
                    </div>

                <?php endwhile; ?>
            <?php else: ?>

                <!-- Tampilan Jika Data Lemari Obat Masih Kosong -->
                <div class="col-12">
                    <div class="alert alert-light border text-center py-4 text-muted font-italic shadow-sm">
                        <i class="fas fa-info-circle mr-1 text-success"></i>
                        Belum ada pengelompokan kategori obat yang dimasukkan oleh pengurus UKS.
                    </div>
                </div>

            <?php endif; ?>
        </div>

    </div>
</section>
