<?php
// views/landing/cekriwayat.php - FINAL Goldar Detail + Alamat & Kelas
$keyword_identitas = trim($_POST['identitas'] ?? '');
$keyword_hp = trim($_POST['hp'] ?? '');
$keyword_alamat = trim($_POST['alamat'] ?? '');
$keyword_kelas = trim($_POST['kelas'] ?? '');
$pencarian_dilakukan = isset($_POST['cari_riwayat']);

$dataPasien = null;
$riwayatMedis = [];
$jenisPasien = '';
$pesanError = '';

if ($pencarian_dilakukan) {
    if ($keyword_identitas === '' || $keyword_hp === '' || $keyword_alamat === '') {
        $pesanError = "NIS/NIP, No HP dan Alamat wajib diisi!";
    } else {
        $likeAlamat = "%".$keyword_alamat."%";
        
        // 1. CEK SISWA - NIS + NoHP + Alamat + Kelas
        if($keyword_kelas !== ''){
            $stmt = mysqli_prepare($koneksi, "SELECT * FROM siswa WHERE nis = ? AND nohp = ? AND alamat LIKE ? AND kelas = ? LIMIT 1");
            mysqli_stmt_bind_param($stmt, "ssss", $keyword_identitas, $keyword_hp, $likeAlamat, $keyword_kelas);
        } else {
            $stmt = mysqli_prepare($koneksi, "SELECT * FROM siswa WHERE nis = ? AND nohp = ? AND alamat LIKE ? LIMIT 1");
            mysqli_stmt_bind_param($stmt, "sss", $keyword_identitas, $keyword_hp, $likeAlamat);
        }
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if (mysqli_num_rows($result) === 1) {
            $dataPasien = mysqli_fetch_assoc($result);
            $jenisPasien = 'siswa';
            $q = mysqli_prepare($koneksi, "SELECT p.*, u.namauser as petugas FROM penanganan p LEFT JOIN user u ON p.iduser = u.iduser WHERE p.idsiswa = ? ORDER BY p.tanggalpenanganan DESC");
            mysqli_stmt_bind_param($q, "i", $dataPasien['idsiswa']);
            mysqli_stmt_execute($q);
            $res = mysqli_stmt_get_result($q);
            while($row = mysqli_fetch_assoc($res)){ $riwayatMedis[] = $row; }
        } else {
            // 2. CEK GURU - NIP + NoHP + Alamat (TANPA KELAS)
            $stmt2 = mysqli_prepare($koneksi, "SELECT * FROM guru WHERE nip = ? AND nohp = ? AND alamat LIKE ? LIMIT 1");
            mysqli_stmt_bind_param($stmt2, "sss", $keyword_identitas, $keyword_hp, $likeAlamat);
            mysqli_stmt_execute($stmt2);
            $result2 = mysqli_stmt_get_result($stmt2);
            
            if (mysqli_num_rows($result2) === 1) {
                $dataPasien = mysqli_fetch_assoc($result2);
                $jenisPasien = 'guru';
                $q = mysqli_prepare($koneksi, "SELECT p.*, u.namauser as petugas FROM penanganan p LEFT JOIN user u ON p.iduser = u.iduser WHERE p.idguru = ? ORDER BY p.tanggalpenanganan DESC");
                mysqli_stmt_bind_param($q, "i", $dataPasien['idguru']);
                mysqli_stmt_execute($q);
                $res = mysqli_stmt_get_result($q);
                while($row = mysqli_fetch_assoc($res)){ $riwayatMedis[] = $row; }
            } else {
                $pesanError = "Data tidak ditemukan! Untuk Siswa wajib cocok: NIS + HP + Alamat + Kelas. Untuk Guru: NIP + HP + Alamat. Cek lagi 0103786196 / XI RPL 2";
            }
        }
    }
}

function getDetailObat($koneksi, $idpenanganan){
    $stmt = mysqli_prepare($koneksi, "SELECT b.namabarang, dp.jumlahkeluar, b.satuan FROM detailpenanganan dp JOIN barang b ON dp.idbarang = b.idbarang WHERE dp.idpenanganan = ?");
    mysqli_stmt_bind_param($stmt, "i", $idpenanganan);
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_get_result($stmt);
}
?>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-5 mb-4">
            <div class="card shadow border-success" style="border-radius:15px;">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width:60px;height:60px;"><i class="fas fa-user-shield fa-2x"></i></div>
                        <h4 class="font-weight-bold">Cek Riwayat Medis</h4>
                        <p class="text-muted small">Verifikasi: NIS/NIP + HP + Alamat + Kelas (khusus siswa)</p>
                    </div>
                    <?php if($pesanError): ?><div class="alert alert-danger small"><?= htmlspecialchars($pesanError); ?></div><?php endif; ?>
                    <form method="POST" action="index.php?halaman=cekriwayat">
                        <div class="form-group">
                            <label class="small font-weight-bold"><i class="fas fa-id-card text-success"></i> NIS Siswa / NIP Guru</label>
                            <input type="text" name="identitas" class="form-control" placeholder="0103786196" value="<?= htmlspecialchars($keyword_identitas); ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="small font-weight-bold"><i class="fas fa-phone-alt text-success"></i> No HP Terdaftar</label>
                            <input type="text" name="hp" class="form-control" placeholder="+62 812-6938-9167" value="<?= htmlspecialchars($keyword_hp); ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="small font-weight-bold"><i class="fas fa-school text-success"></i> Kelas (Wajib Siswa, kosongkan jika Guru)</label>
                            <input type="text" name="kelas" class="form-control" placeholder="XI RPL 2 (kosongkan jika Guru)" value="<?= htmlspecialchars($keyword_kelas); ?>">
                            <small class="text-muted" style="font-size:10px;">*Jika guru, kosongkan. Sistem otomatis deteksi guru tanpa kelas</small>
                        </div>
                        <div class="form-group">
                            <label class="small font-weight-bold"><i class="fas fa-map-marker-alt text-success"></i> Alamat (ketik sebagian)</label>
                            <input type="text" name="alamat" class="form-control" placeholder="Karang Baru / Jl. Kesehatan" value="<?= htmlspecialchars($keyword_alamat); ?>" required>
                        </div>
                        <button type="submit" name="cari_riwayat" class="btn btn-success btn-block rounded-pill font-weight-bold"><i class="fas fa-search mr-1"></i> VERIFIKASI & LIHAT RIWAYAT</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <?php if($pencarian_dilakukan && $dataPasien): ?>
                <div class="card shadow-sm border-0 mb-3">
                    <div class="card-header bg-white"><h5 class="card-title font-weight-bold text-success"><i class="fas fa-id-badge mr-1"></i> Profil Pasien</h5></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2"><img src="assets/images/<?= $jenisPasien=='siswa'?'siswa':'guru' ?>/<?= $dataPasien['foto'] ?? 'default.png' ?>" class="img-fluid rounded-circle elevation-2" style="width:60px;height:60px;object-fit:cover" onerror="this.src='assets/images/user/default.png'"></div>
                            <div class="col-10">
                                <div class="row">
                                    <div class="col-6 mb-2"><small class="text-muted d-block">Nama Lengkap</small><b><?= htmlspecialchars($jenisPasien=='siswa'?$dataPasien['namasiswa']:$dataPasien['namaguru']) ?></b><br><small class="text-muted"><?= htmlspecialchars($dataPasien['alamat'] ?? '-') ?></small></div>
                                    <div class="col-6 mb-2"><small class="text-muted d-block"><?= $jenisPasien=='siswa'?'Kelas / Status':'Status Jabatan' ?></small>
                                        <?php if($jenisPasien=='siswa'): ?>
                                            <span class="badge badge-info"><?= htmlspecialchars($dataPasien['kelas']) ?></span> <span class="badge badge-success"><?= strtoupper($jenisPasien) ?></span>
                                        <?php else: ?>
                                            <span class="badge badge-primary">GURU - <?= htmlspecialchars($dataPasien['jeniskelamin']??'GURU') ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-4"><small class="text-muted d-block">NIS/NIP</small><b><?= htmlspecialchars($jenisPasien=='siswa'?$dataPasien['nis']:$dataPasien['nip']) ?></b></div>
                                    <div class="col-2"><small class="text-muted d-block">Gol Darah</small><span class="badge badge-danger" style="font-size:16px;padding:5px 10px"><?= htmlspecialchars($dataPasien['goldar'] ?? $dataPasien['golongan_darah'] ?? '-') ?></span></div>
                                    <div class="col-6"><small class="text-muted d-block">Riwayat Penyakit / Alergi</small><span class="text-danger small font-weight-bold"><i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($dataPasien['riwayatpenyakit'] ?: 'Tidak ada') ?> / Alergi: <?= htmlspecialchars($dataPasien['riwayatalergi'] ?? '-') ?></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white"><b><i class="fas fa-history mr-1"></i> Linimasa Penanganan (<?= count($riwayatMedis) ?> kali)</b></div>
                    <div class="card-body p-0"><div class="table-responsive">
                        <table class="table table-hover mb-0" style="font-size:13px">
                            <thead class="bg-light"><tr><th>Tanggal</th><th>Keluhan</th><th>Tindakan + Obat</th><th>Status</th><th>Petugas</th></tr></thead>
                            <tbody>
                            <?php foreach($riwayatMedis as $m): ?>
                                <tr><td><b><?= date('d M Y', strtotime($m['tanggalpenanganan'])) ?></b></td><td><?= htmlspecialchars($m['keluhan']) ?></td><td><?= htmlspecialchars($m['tindakan']) ?><br><?php $det=getDetailObat($koneksi,$m['idpenanganan']); while($o=mysqli_fetch_assoc($det)): ?><span class="badge badge-light border"><i class="fas fa-pills"></i> <?= $o['namabarang'] ?> x<?= $o['jumlahkeluar'] ?></span> <?php endwhile; ?></td><td><span class="badge badge-warning"><?= strtoupper($m['statuspasien']) ?></span></td><td><small><?= htmlspecialchars($m['petugas'] ?? '-') ?></small></td></tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div></div>
                </div>
            <?php else: ?>
                <div class="card border-0 shadow-sm bg-white" style="border-radius:15px; min-height:400px; display:flex; align-items:center; justify-content:center;">
                    <div class="text-center p-5 text-muted"><i class="fas fa-lock fa-3x mb-3 text-success"></i><h5 class="font-weight-bold">Menunggu Verifikasi</h5><p class="small">Isi NIS <b>0103786196</b> + Kelas <b>XI RPL 2</b> + Alamat <b>Karang Baru</b> + HP untuk buka data <b>Zulaika Fatarani</b> seperti di screenshot kamu. Jika Guru, kosongkan kelas.</p></div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>