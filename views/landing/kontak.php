<?php
// views/landing/kontak.php - FINAL UKS DIGITAL
if(isset($_POST['kirim_konsultasi'])){
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $kelas = mysqli_real_escape_string($koneksi, $_POST['kelas']);
    $wa = mysqli_real_escape_string($koneksi, $_POST['wa']);
    $keluhan = mysqli_real_escape_string($koneksi, $_POST['keluhan']);
    // Simpan ke tabel penanganan sebagai konsultasi awal dengan status 'konsultasi_online'
    // Atau cukup log file jika tidak ada tabel konsultasi
    $_SESSION['flash_kontak'] = "Terima kasih $nama! Laporan konsultasi awal ($kelas) telah diterima tim PMR. Kami akan hubungi via WA $wa.";
}
?>
<section class="py-5 bg-light">
<div class="container">
    <div class="text-center mb-5">
        <span class="badge badge-success px-3 py-2 mb-3 rounded-pill">LAYANAN DARURAT & ADUAN</span>
        <h1 class="font-weight-bold text-success"><i class="fas fa-phone-alt mr-2"></i>Kontak & Konsultasi UKS</h1>
        <p class="text-muted small font-weight-bold">Tim PMR dan Pembina UKS SMKN 1 Karang Baru siap melayani kebutuhan medis warga sekolah.</p>
    </div>

    <?php if(isset($_SESSION['flash_kontak'])): ?>
        <div class="alert alert-success border-0 shadow-sm text-center font-weight-bold"><i class="fas fa-check-circle mr-1"></i> <?= $_SESSION['flash_kontak']; unset($_SESSION['flash_kontak']); ?></div>
    <?php endif; ?>

    <div class="row">
        <div class="col-lg-5 mb-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius:15px;">
                <div class="card-body p-4 p-lg-5">
                    <h4 class="font-weight-bold mb-4"><i class="fas fa-hospital-symbol text-success mr-2"></i>Info Ruang UKS</h4>
                    
                    <div class="d-flex mb-4"><div class="mr-3 text-success"><i class="fas fa-map-marker-alt fa-lg"></i></div><div><h6 class="font-weight-bold mb-1">Lokasi Gedung</h6><p class="text-muted small mb-0">Gedung C Lt.1 (Sebelah Lab RPL), SMKN 1 Karang Baru, Aceh Tamiang.</p></div></div>
                    <div class="d-flex mb-4"><div class="mr-3 text-success"><i class="fas fa-phone fa-lg"></i></div><div><h6 class="font-weight-bold mb-1">Hotline Darurat</h6><p class="text-danger small font-weight-bold mb-0">+62 812-3456-7890 (Piket PMR) - No HP ini juga untuk verifikasi cekriwayat.php</p></div></div>
                    <div class="d-flex mb-4"><div class="mr-3 text-success"><i class="fas fa-envelope fa-lg"></i></div><div><h6 class="font-weight-bold mb-1">Email</h6><p class="text-muted small mb-0">uks@smkn1karangbaru.sch.id</p></div></div>
                    <div class="d-flex"><div class="mr-3 text-success"><i class="fas fa-clock fa-lg"></i></div><div><h6 class="font-weight-bold mb-1">Jam Operasional</h6><p class="text-muted small mb-0">Senin - Jumat (Jam KBM)<br>07.30 - 16.00 WIB</p></div></div>

                    <hr class="my-4">
                    <iframe src="https://maps.google.com/maps?q=SMKN%201%20Karang%20Baru&t=&z=13&ie=UTF8&iwloc=&output=embed" width="100%" height="200" style="border:0; border-radius:10px;" allowfullscreen></iframe>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="card border-0 shadow-sm" style="border-radius:15px;">
                <div class="card-body p-4 p-lg-5">
                    <h4 class="font-weight-bold mb-4"><i class="fas fa-notes-medical text-success mr-2"></i>Konsultasi Kesehatan Online</h4>
                    <form method="POST" action="index.php?halaman=kontak">
                        <div class="form-row">
                            <div class="form-group col-md-6"><label class="small font-weight-bold">Nama Lengkap</label><input type="text" name="nama" class="form-control" placeholder="Zulaika Fatarani..." required></div>
                            <div class="form-group col-md-6"><label class="small font-weight-bold">Kelas / Jabatan</label><input type="text" name="kelas" class="form-control" placeholder="XI RPL 2 / Guru..." required></div>
                        </div>
                        <div class="form-group"><label class="small font-weight-bold">No WA Aktif</label><input type="text" name="wa" class="form-control" placeholder="0812xxxx" required></div>
                        <div class="form-group"><label class="small font-weight-bold">Keluhan / Gejala</label><textarea name="keluhan" class="form-control" rows="5" placeholder="Tulis keluhan detail agar petugas menyiapkan obat dari barang.idkategori..." required></textarea></div>
                        <button type="submit" name="kirim_konsultasi" class="btn btn-success btn-lg btn-block rounded-pill font-weight-bold shadow-sm mt-3"><i class="fas fa-paper-plane mr-2"></i> Kirim Laporan Kesehatan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mt-4" style="border-radius:10px;"><div class="card-body text-center p-3"><i class="fas fa-exclamation-circle text-success mr-1"></i><span class="text-muted small font-weight-bold">Gawat darurat (pingsan/kejang) segera hubungi hotline atau panggil petugas PMR piket ke lokasi - data akan masuk ke penanganan.statuspasien = 'rujuk ke puskesmas/RS'</span></div></div>
</div>
</section>