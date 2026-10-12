<?php
$keyword_identitas = trim($_POST['identitas'] ?? '');
$keyword_hp = trim($_POST['hp'] ?? '');
$keyword_alamat = trim($_POST['alamat'] ?? '');
$keyword_kelas = trim($_POST['kelas'] ?? '');
$pencarian_dilakukan = isset($_POST['cari_riwayat']);
$dataPasien = null; $riwayatMedis = []; $jenisPasien = ''; $pesanError = '';

function ambilField($row, $opsi, $default='-'){
  foreach($opsi as $k){ if(isset($row[$k]) && $row[$k] !== '' && $row[$k] !== null) return $row[$k]; }
  return $default;
}

if ($pencarian_dilakukan) {
    if ($keyword_identitas === '' || $keyword_hp === '' || $keyword_alamat === '') {
        $pesanError = "NIS/NIP, No HP dan Alamat wajib diisi!";
    } else {
        $likeAlamat = "%".$keyword_alamat."%";
        if($keyword_kelas !== ''){
            $stmt = mysqli_prepare($koneksi, "SELECT * FROM siswa WHERE nis = ? AND nohp = ? AND alamat LIKE ? AND kelas = ? LIMIT 1");
            mysqli_stmt_bind_param($stmt, "ssss", $keyword_identitas, $keyword_hp, $likeAlamat, $keyword_kelas);
        } else {
            $stmt = mysqli_prepare($koneksi, "SELECT * FROM siswa WHERE nis = ? AND nohp = ? AND alamat LIKE ? LIMIT 1");
            mysqli_stmt_bind_param($stmt, "sss", $keyword_identitas, $keyword_hp, $likeAlamat);
        }
        mysqli_stmt_execute($stmt); $result = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result) === 1) {
            $dataPasien = mysqli_fetch_assoc($result); $jenisPasien = 'siswa';
            $q = mysqli_prepare($koneksi, "SELECT p.*, u.namauser as petugas FROM penanganan p LEFT JOIN user u ON p.iduser = u.iduser WHERE p.idsiswa = ? ORDER BY p.tanggalpenanganan DESC");
            mysqli_stmt_bind_param($q, "i", $dataPasien['idsiswa']); mysqli_stmt_execute($q);
            $res = mysqli_stmt_get_result($q); while($row = mysqli_fetch_assoc($res)){ $riwayatMedis[] = $row; }
        } else {
            $stmt2 = mysqli_prepare($koneksi, "SELECT * FROM guru WHERE nip = ? AND nohp = ? AND alamat LIKE ? LIMIT 1");
            mysqli_stmt_bind_param($stmt2, "sss", $keyword_identitas, $keyword_hp, $likeAlamat);
            mysqli_stmt_execute($stmt2); $result2 = mysqli_stmt_get_result($stmt2);
            if (mysqli_num_rows($result2) === 1) {
                $dataPasien = mysqli_fetch_assoc($result2); $jenisPasien = 'guru';
                $q = mysqli_prepare($koneksi, "SELECT p.*, u.namauser as petugas FROM penanganan p LEFT JOIN user u ON p.iduser = u.iduser WHERE p.idguru = ? ORDER BY p.tanggalpenanganan DESC");
                mysqli_stmt_bind_param($q, "i", $dataPasien['idguru']); mysqli_stmt_execute($q);
                $res = mysqli_stmt_get_result($q); while($row = mysqli_fetch_assoc($res)){ $riwayatMedis[] = $row; }
            } else { $pesanError = "Data tidak ditemukan! Cek lagi 0103786196 / XI RPL 2 - Untuk Siswa wajib: NIS + HP + Alamat + Kelas. Untuk Guru: NIP + HP + Alamat"; }
        }
    }
}
function getDetailObat($koneksi, $idpenanganan){
    $stmt = mysqli_prepare($koneksi, "SELECT b.namabarang, dp.jumlahkeluar, b.satuan FROM detailpenanganan dp JOIN barang b ON dp.idbarang = b.idbarang WHERE dp.idpenanganan = ?");
    mysqli_stmt_bind_param($stmt, "i", $idpenanganan); mysqli_stmt_execute($stmt); return mysqli_stmt_get_result($stmt);
}
?>
<section class="py-5" style="background:#f8fafc">
<style>
:root{ --teal:#0f766e; --teal2:#14b8a6; --mint:#ccfbf1; --mint2:#f0fdfa; --dark:#064e3b; --radius:18px; }
.uk-card{border-radius:var(--radius); border:1px solid #e0f2f1; background:white; box-shadow:0 8px 30px rgba(15,118,110,0.07); transition:.3s}
.uk-card:hover{box-shadow:0 16px 40px rgba(15,118,110,0.12)}
.icon-box{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,var(--teal),var(--teal2));color:white}
.icon-box.mint{background:var(--mint);color:var(--teal)}
.form-control{border-radius:12px;border:1px solid #ccfbf1;padding:11px 16px}
.form-control:focus{border-color:var(--teal2);box-shadow:0 0 0 3px var(--mint2)}
.section-title{font-weight:800;color:var(--dark)}
</style>

<div class="container">
    <div class="text-center mb-4">
        <span class="badge px-4 py-2 mb-3 font-weight-bold" style="background:var(--mint);color:var(--teal);border-radius:30px;letter-spacing:1px">REKAM MEDIS MANDIRI</span>
        <h2 class="section-title">Cek Riwayat Medis</h2>
        <p class="text-muted small">Verifikasi 4 faktor: NIS/NIP + HP + Alamat + Kelas (khusus siswa) - Data Zulaika Fatarani</p>
    </div>

    <div class="row justify-content-center align-items-start">
        <!-- FORM VERIFIKASI - SELARAS KONTAK -->
        <div class="col-md-5 mb-4">
            <div class="uk-card p-4 p-lg-4">
                <div class="text-center mb-4">
                    <div class="icon-box mx-auto mb-3" style="width:64px;height:64px;border-radius:18px"><i class="fas fa-user-shield fa-lg"></i></div>
                    <h5 class="font-weight-bold" style="color:var(--dark)">Verifikasi Identitas</h5>
                    <small class="text-muted">Isi sesuai data di master siswa/guru</small>
                </div>

                <?php if($pesanError): ?><div class="alert text-white small" style="background:linear-gradient(90deg,#dc2626,#ef4444);border-radius:12px;border:none"><i class="fas fa-exclamation-triangle mr-1"></i> <?= $pesanError; ?></div><?php endif; ?>

                <form method="POST" action="index.php?halaman=cekriwayat">
                    <div class="form-group"><label class="small font-weight-bold" style="color:var(--dark)"><i class="fas fa-id-card mr-1" style="color:var(--teal)"></i> NIS Siswa / NIP Guru</label><input type="text" name="identitas" class="form-control" placeholder="0103786196" value="<?= htmlspecialchars($keyword_identitas); ?>" required></div>
                    <div class="form-group"><label class="small font-weight-bold" style="color:var(--dark)"><i class="fas fa-phone-alt mr-1" style="color:var(--teal)"></i> No HP Terdaftar</label><input type="text" name="hp" class="form-control" placeholder="+62 812-6938-9167" value="<?= htmlspecialchars($keyword_hp); ?>" required></div>
                    <div class="form-group"><label class="small font-weight-bold" style="color:var(--dark)"><i class="fas fa-school mr-1" style="color:var(--teal)"></i> Kelas <small class="text-muted font-weight-normal">(Wajib Siswa, kosongkan jika Guru)</small></label><input type="text" name="kelas" class="form-control" value="<?= htmlspecialchars($keyword_kelas); ?>" placeholder="XI RPL 2"></div>
                    <div class="form-group"><label class="small font-weight-bold" style="color:var(--dark)"><i class="fas fa-map-marker-alt mr-1" style="color:var(--teal)"></i> Alamat (ketik sebagian)</label><input type="text" name="alamat" class="form-control" placeholder="Medang Ara / Karang Baru" value="<?= htmlspecialchars($keyword_alamat); ?>" required></div>
                    <button type="submit" name="cari_riwayat" class="btn btn-block rounded-pill font-weight-bold mt-3 text-white shadow-sm" style="background:linear-gradient(90deg,var(--teal),var(--teal2));padding:12px"><i class="fas fa-search mr-2"></i> VERIFIKASI & LIHAT RIWAYAT</button>
                </form>
                <small class="text-muted d-block text-center mt-3" style="font-size:11px">*Jika guru, kosongkan kelas. Sistem otomatis deteksi guru tanpa kelas</small>
            </div>
        </div>

        <!-- HASIL PROFIL + RIWAYAT - SELARAS TENTANG -->
        <div class="col-md-7">
            <?php if($pencarian_dilakukan && $dataPasien): 
              $valGoldar = ambilField($dataPasien, ['goldar','gol_darah','golongandarah','golongan_darah','golongan_darah_siswa','gol_darah_siswa','darah','blood_type'], '-');
              $valPenyakit = ambilField($dataPasien, ['riwayatpenyakit','riwayat_penyakit','penyakit','riwayatpenyakit_siswa'],'Tidak ada');
              $valAlergi = ambilField($dataPasien, ['riwayatalergi','riwayat_alergi','alergi','riwayatalergi_siswa'],'-');
            ?>
                <div class="uk-card p-4 mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                      <h5 class="font-weight-bold mb-0" style="color:var(--dark)"><i class="fas fa-id-badge mr-2" style="color:var(--teal)"></i> Profil Pasien</h5>
                      <span class="badge px-3 py-2" style="background:var(--mint);color:var(--teal);border-radius:20px"><?= strtoupper($jenisPasien) ?> • <?= $jenisPasien=='siswa'? htmlspecialchars($dataPasien['kelas']) : 'GURU' ?></span>
                    </div>
                    <div class="row">
                        <div class="col-3 text-center"><img src="assets/images/<?= $jenisPasien=='siswa'?'siswa':'guru' ?>/<?= $dataPasien['foto'] ?? 'default.png' ?>" class="img-fluid rounded-circle" style="width:80px;height:80px;object-fit:cover;border:3px solid var(--mint)" onerror="this.src='assets/images/user/default.png'"><br><small class="badge mt-2" style="background:var(--mint2);color:var(--teal)"><?= $jenisPasien=='siswa'? $dataPasien['nis'] : $dataPasien['nip'] ?></small></div>
                        <div class="col-9">
                            <div class="row">
                                <div class="col-7 mb-3"><small class="text-muted d-block" style="font-size:11px;letter-spacing:1px">NAMA LENGKAP</small><b style="color:var(--dark);font-size:18px"><?= htmlspecialchars($jenisPasien=='siswa'?$dataPasien['namasiswa']:$dataPasien['namaguru']) ?></b><br><small class="text-muted"><i class="fas fa-map-marker-alt mr-1"></i><?= htmlspecialchars($dataPasien['alamat'] ?? '-') ?></small></div>
                                <div class="col-5 mb-3 text-center"><small class="text-muted d-block" style="font-size:11px;letter-spacing:1px">GOL DARAH</small><div class="mx-auto d-flex align-items-center justify-content-center text-white font-weight-bold" style="width:56px;height:56px;border-radius:14px;background:linear-gradient(135deg,#dc2626,#ef4444);font-size:22px"><?= htmlspecialchars($valGoldar) ?></div></div>
                                <div class="col-12"><div class="p-3" style="background:var(--mint2);border-radius:12px;border-left:4px solid var(--teal2)"><small class="text-muted d-block" style="font-size:11px;letter-spacing:1px">RIWAYAT PENYAKIT / ALERGI</small><span class="small font-weight-bold" style="color:var(--dark)"><i class="fas fa-exclamation-circle mr-1" style="color:#dc2626"></i> <?= htmlspecialchars($valPenyakit) ?> / Alergi: <?= htmlspecialchars($valAlergi) ?></span></div></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="uk-card overflow-hidden">
                    <div class="p-3 text-white d-flex justify-content-between align-items-center" style="background:linear-gradient(90deg,var(--teal),var(--teal2))"><b><i class="fas fa-history mr-2"></i> Linimasa Penanganan (<?= count($riwayatMedis) ?> kali)</b><span class="badge badge-light" style="color:var(--teal)"><?= count($riwayatMedis) ?>x berobat</span></div>
                    <div class="table-responsive"><table class="table table-hover mb-0" style="font-size:13px"><thead style="background:var(--mint2)"><tr><th style="color:var(--dark)">Tanggal</th><th style="color:var(--dark)">Keluhan</th><th style="color:var(--dark)">Tindakan + Obat</th><th style="color:var(--dark)">Status</th><th style="color:var(--dark)">Petugas</th></tr></thead><tbody><?php foreach($riwayatMedis as $m): ?><tr><td><b style="color:var(--dark)"><?= date('d M Y', strtotime($m['tanggalpenanganan'])) ?></b></td><td><?= htmlspecialchars($m['keluhan']) ?></td><td><?= htmlspecialchars($m['tindakan']) ?><br><?php $det=getDetailObat($koneksi,$m['idpenanganan']); while($o=mysqli_fetch_assoc($det)): ?><span class="badge border mt-1" style="background:var(--mint2);color:var(--teal);border-color:var(--mint) !important"><i class="fas fa-pills mr-1"></i> <?= $o['namabarang'] ?> x<?= $o['jumlahkeluar'] ?></span> <?php endwhile; ?></td><td><span class="badge px-2 py-1" style="background:#fef9c3;color:#854d0e;border-radius:20px"><?= strtoupper($m['statuspasien']) ?></span></td><td><small><?= htmlspecialchars($m['petugas'] ?? '-') ?></small></td></tr><?php endforeach; ?><?php if(empty($riwayatMedis)): ?><tr><td colspan="5" class="text-center text-muted p-4">Belum ada riwayat penanganan</td></tr><?php endif; ?></tbody></table></div>
                </div>
            <?php else: ?>
                <div class="uk-card p-5 text-center" style="min-height:420px;display:flex;align-items:center;justify-content:center;background:linear-gradient(180deg,white,var(--mint2))">
                  <div>
                    <div class="icon-box mx-auto mb-4" style="width:80px;height:80px;border-radius:20px;background:var(--mint);color:var(--teal)"><i class="fas fa-lock fa-2x"></i></div>
                    <h5 class="font-weight-bold" style="color:var(--dark)">Menunggu Verifikasi</h5>
                    <p class="small text-muted" style="max-width:320px;margin:0 auto">Isi NIS <b style="color:var(--teal)">0103786196</b> + Kelas <b style="color:var(--teal)">XI RPL 2</b> + Alamat <b style="color:var(--teal)">Karang Baru</b> + HP untuk buka data <b>Zulaika Fatarani</b> seperti di screenshot kamu. Jika Guru, kosongkan kelas.</p>
                    <div class="mt-4 p-3 small text-left" style="background:white;border-radius:12px;border:1px dashed var(--mint);max-width:320px;margin:0 auto"><b style="color:var(--dark)">Contoh Test:</b><br>NIS: 0103786196<br>HP: +62 812-6938-9167<br>Kelas: XI RPL 2<br>Alamat: Medang Ara</div>
                  </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
</section>