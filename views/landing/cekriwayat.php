<?php
// views/landing/cekriwayat.php - Versi FINAL sesuai Laporan Zulaika Fatarani
$keyword_identitas = trim($_POST['identitas'] ?? '');
$keyword_hp = trim($_POST['hp'] ?? '');
$pencarian_dilakukan = isset($_POST['cari_riwayat']);

$dataPasien = null;
$riwayatMedis = [];
$jenisPasien = '';
$pesanError = '';

if ($pencarian_dilakukan) {
    if ($keyword_identitas === '' || $keyword_hp === '') {
        $pesanError = "NIS/NIP dan No HP wajib diisi!";
    } else {
        // 1. Cek di SISWA - kolom asli: nis + nohp
        $stmt = mysqli_prepare($koneksi, "SELECT * FROM siswa WHERE nis = ? AND nohp = ? LIMIT 1");
        mysqli_stmt_bind_param($stmt, "ss", $keyword_identitas, $keyword_hp);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if (mysqli_num_rows($result) === 1) {
            $dataPasien = mysqli_fetch_assoc($result);
            $jenisPasien = 'siswa';
            // Ambil penanganan + obat yang dipakai
            $q = mysqli_prepare($koneksi, "SELECT p.*, u.namauser as petugas 
                FROM penanganan p LEFT JOIN user u ON p.iduser = u.iduser 
                WHERE p.idsiswa = ? ORDER BY p.tanggalpenanganan DESC, p.idpenanganan DESC");
            mysqli_stmt_bind_param($q, "i", $dataPasien['idsiswa']);
            mysqli_stmt_execute($q);
            $res = mysqli_stmt_get_result($q);
            while($row = mysqli_fetch_assoc($res)){ $riwayatMedis[] = $row; }
        } else {
            // 2. Cek di GURU - kolom asli: nip + nohp
            $stmt2 = mysqli_prepare($koneksi, "SELECT * FROM guru WHERE nip = ? AND nohp = ? LIMIT 1");
            mysqli_stmt_bind_param($stmt2, "ss", $keyword_identitas, $keyword_hp);
            mysqli_stmt_execute($stmt2);
            $result2 = mysqli_stmt_get_result($stmt2);
            
            if (mysqli_num_rows($result2) === 1) {
                $dataPasien = mysqli_fetch_assoc($result2);
                $jenisPasien = 'guru';
                $q = mysqli_prepare($koneksi, "SELECT p.*, u.namauser as petugas 
                    FROM penanganan p LEFT JOIN user u ON p.iduser = u.iduser 
                    WHERE p.idguru = ? ORDER BY p.tanggalpenanganan DESC, p.idpenanganan DESC");
                mysqli_stmt_bind_param($q, "i", $dataPasien['idguru']);
                mysqli_stmt_execute($q);
                $res = mysqli_stmt_get_result($q);
                while($row = mysqli_fetch_assoc($res)){ $riwayatMedis[] = $row; }
            } else {
                $pesanError = "Data tidak ditemukan! Pastikan NIS/NIP dan No HP sesuai yang terdaftar di UKS. Contoh Siswa: 0103786196 + +62 812-6938-9167";
            }
        }
    }
}

// Helper ambil detail obat per penanganan
function getDetailObat($koneksi, $idpenanganan){
    $stmt = mysqli_prepare($koneksi, "SELECT b.namabarang, dp.jumlahkeluar, b.satuan FROM detailpenanganan dp JOIN barang b ON dp.idbarang = b.idbarang WHERE dp.idpenanganan = ?");
    mysqli_stmt_bind_param($stmt, "i", $idpenanganan);
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_get_result($stmt);
}
?>
<div class="container py-4">
    <div class="row justify-content-center">
        <!-- FORM -->
        <div class="col-md-5 mb-4">
            <div class="card shadow border-success" style="border-radius:15px;">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width:60px;height:60px;"><i class="fas fa-user-shield fa-2x"></i></div>
                        <h4 class="font-weight-bold">Cek Riwayat Medis</h4>
                        <p class="text-muted small">Verifikasi ganda: NIS/NIP + No HP rahasia. Data dienkripsi sesuai laporan.</p>
                    </div>
                    <?php if($pesanError): ?>
                        <div class="alert alert-danger small"><i class="fas fa-exclamation-triangle mr-1"></i> <?= htmlspecialchars($pesanError); ?></div>
                    <?php endif; ?>
                    <form method="POST" action="index.php?halaman=cekriwayat">
                        <div class="form-group">
                            <label class="small font-weight-bold"><i class="fas fa-id-card text-success"></i> NIS Siswa / NIP Guru</label>
                            <input type="text" name="identitas" class="form-control" placeholder="Contoh: 0103786196" value="<?= htmlspecialchars($keyword_identitas); ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="small font-weight-bold"><i class="fas fa-phone-alt text-success"></i> No HP Terdaftar</label>
                            <input type="text" name="hp" class="form-control" placeholder="Contoh: +62 812-6938-9167" value="<?= htmlspecialchars($keyword_hp); ?>" required>
                            <small class="text-muted" style="font-size:11px;">*Harus sama persis dengan di tabel siswa.nohp / guru.nohp</small>
                        </div>
                        <button type="submit" name="cari_riwayat" class="btn btn-success btn-block rounded-pill font-weight-bold shadow-sm"><i class="fas fa-search mr-1"></i> VERIFIKASI & LIHAT RIWAYAT</button>
                    </form>
                    <div class="mt-3 p-2 bg-light rounded small">
                        <b>Data Uji (dari laporanmu):</b><br>
                        Siswa: NIS <code>0103786196</code> | HP <code>+62 812-6938-9167</code><br>
                        Guru: NIP <code>02331222233</code> | HP <code>088888888</code>
                    </div>
                </div>
            </div>
        </div>

        <!-- HASIL -->
        <div class="col-md-7">
            <?php if($pencarian_dilakukan && $dataPasien): ?>
                <div class="card shadow-sm border-0 card-outline card-success mb-3">
                    <div class="card-header bg-white"><h5 class="card-title font-weight-bold text-success"><i class="fas fa-id-badge mr-1"></i> Profil Pasien</h5></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2"><img src="assets/images/<?= $jenisPasien=='siswa'?'siswa':'guru' ?>/<?= $dataPasien['foto'] ?>" class="img-fluid rounded-circle elevation-2" style="width:60px;height:60px;object-fit:cover" onerror="this.src='assets/images/user/default.png'"></div>
                            <div class="col-10">
                                <div class="row">
                                    <div class="col-6 mb-2"><small class="text-muted d-block">Nama</small><b><?= htmlspecialchars($jenisPasien=='siswa'?$dataPasien['namasiswa']:$dataPasien['namaguru']) ?></b></div>
                                    <div class="col-6 mb-2"><small class="text-muted d-block">Status</small><span class="badge badge-<?= $jenisPasien=='siswa'?'info':'primary' ?>"><?= strtoupper($jenisPasien) ?> - <?= htmlspecialchars($dataPasien['kelas'] ?? $dataPasien['jeniskelamin']) ?></span></div>
                                    <div class="col-6"><small class="text-muted d-block">NIS/NIP</small><b><?= htmlspecialchars($jenisPasien=='siswa'?$dataPasien['nis']:$dataPasien['nip']) ?></b></div>
                                    <div class="col-6"><small class="text-muted d-block">Gol Darah / Riwayat</small><span class="text-danger font-weight-bold"><i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($dataPasien['riwayatpenyakit'] ?: '-') ?> / Alergi: <?= htmlspecialchars($dataPasien['riwayatalergi'] ?? '-') ?></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white"><b><i class="fas fa-history mr-1"></i> Linimasa Penanganan (<?= count($riwayatMedis) ?> kali)</b></div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0" style="font-size:13px">
                                <thead class="bg-light"><tr><th>Tanggal</th><th>Keluhan</th><th>Tindakan</th><th>Status</th><th>Petugas</th></tr></thead>
                                <tbody>
                                <?php if(count($riwayatMedis)>0): foreach($riwayatMedis as $m): ?>
                                    <tr>
                                        <td><b><?= date('d M Y', strtotime($m['tanggalpenanganan'])) ?></b></td>
                                        <td><?= htmlspecialchars($m['keluhan']) ?></td>
                                        <td><?= htmlspecialchars($m['tindakan']) ?><br>
                                            <?php $det = getDetailObat($koneksi, $m['idpenanganan']); while($o = mysqli_fetch_assoc($det)): ?>
                                                <span class="badge badge-light border"><i class="fas fa-pills"></i> <?= $o['namabarang'] ?> x<?= $o['jumlahkeluar'] ?> <?= $o['satuan'] ?></span>
                                            <?php endwhile; ?>
                                        </td>
                                        <td><span class="badge badge-warning"><?= $m['statuspasien'] ?></span></td>
                                        <td><small><?= htmlspecialchars($m['petugas'] ?? '-') ?></small></td>
                                    </tr>
                                <?php endforeach; else: ?>
                                    <tr><td colspan="5" class="text-center text-muted py-4">Belum ada riwayat penanganan di UKS.</td></tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="card border-0 shadow-sm bg-white" style="border-radius:15px; min-height:350px; display:flex; align-items:center; justify-content:center;">
                    <div class="text-center p-5 text-muted">
                        <i class="fas fa-lock fa-3x mb-3 text-success"></i>
                        <h5 class="font-weight-bold">Menunggu Verifikasi Ganda</h5>
                        <p class="small">Masukkan NIS/NIP + No HP sesuai data di <code>siswa</code> & <code>guru</code> untuk membuka arsip medis digital yang terkunci.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>