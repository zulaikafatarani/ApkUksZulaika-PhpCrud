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
        $pesanError = "NIS/NIP, No HP dan Alamat wajib diisi! Contoh: 0103786196 / XI RPL 2 / Medang Ara";
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
            } else { $pesanError = "Data tidak ditemukan! Cek lagi 0103786196 / XI RPL 2 - Untuk Siswa wajib: NIS + HP + Alamat + Kelas. Untuk Guru: NIP + HP + Alamat (kosongkan kelas)"; }
        }
    }
}
function getDetailObat($koneksi, $idpenanganan){
    $stmt = mysqli_prepare($koneksi, "SELECT b.namabarang, dp.jumlahkeluar, b.satuan FROM detailpenanganan dp JOIN barang b ON dp.idbarang = b.idbarang WHERE dp.idpenanganan = ?");
    mysqli_stmt_bind_param($stmt, "i", $idpenanganan); mysqli_stmt_execute($stmt); return mysqli_stmt_get_result($stmt);
}
?>
<section class="py-5 position-relative" style="background:#f8fafc; overflow:hidden">

<!-- ORNAMEN MENARI -->
<div class="float-orb orb1" style="top:5%; left:-70px"></div>
<div class="float-orb orb2" style="top:40%; right:-90px"></div>
<div class="float-orb orb3" style="bottom:10%; left:25%"></div>
<div class="dots-grid"></div>

<div class="container position-relative" style="z-index:5">
    <div class="text-center mb-5 reveal">
        <span class="badge-mint mb-3"><i class="fas fa-file-medical-alt mr-2"></i> REKAM MEDIS MANDIRI</span>
        <h2 class="section-title" style="font-size:40px">Cek Riwayat Medis</h2>
        <p class="text-muted small" style="max-width:600px;margin:0 auto; line-height:1.7">Verifikasi 4 faktor: NIS/NIP + HP + Alamat + Kelas (khusus siswa) - Data <b style="color:var(--teal)">Zulaika Fatarani 0103786196 XI RPL 2</b> • ERD siswa.nis + nohp + alamat + kelas</p>
        <div class="mt-3">
          <span class="badge px-3 py-1" style="background:white;border:1px solid #ccfbf1;color:var(--teal);border-radius:20px"><i class="fas fa-shield-alt mr-1"></i> Tanpa Login • Aman</span>
          <span class="badge px-3 py-1 ml-2" style="background:var(--dark);color:#5eead4;border-radius:20px"><i class="fas fa-database mr-1"></i> 7 Entitas FIX</span>
        </div>
    </div>

    <div class="row justify-content-center align-items-start">
        <!-- FORM VERIFIKASI - MENARI -->
        <div class="col-md-5 mb-4 reveal">
            <div class="uk-card p-4 p-lg-4">
                <div class="float-orb" style="width:100px;height:100px;top:-20px;right:-20px;opacity:0.2;background:radial-gradient(circle, var(--teal2), transparent 70%); pointer-events:none"></div>
                <div class="text-center mb-4 position-relative" style="z-index:2">
                    <div class="icon-box mx-auto mb-3 shimmer" style="width:72px;height:72px;border-radius:18px"><i class="fas fa-user-shield fa-lg"></i></div>
                    <h5 class="font-weight-bold" style="color:var(--dark)">Verifikasi Identitas</h5>
                    <small class="badge px-3 py-1 mt-1" style="background:var(--mint2);color:var(--teal);border-radius:20px">Isi sesuai master siswa/guru • Bisa Dipencet</small>
                </div>

                <?php if($pesanError): ?><div class="alert text-white small position-relative" style="background:linear-gradient(90deg,#dc2626,#ef4444);border-radius:14px;border:none; animation:popUp .6s both; z-index:2"><i class="fas fa-exclamation-triangle mr-1"></i> <?= $pesanError; ?></div><?php endif; ?>

                <form method="POST" action="index.php?halaman=cekriwayat" class="position-relative" style="z-index:2">
                    <div class="form-group"><label class="small font-weight-bold" style="color:var(--dark)"><i class="fas fa-id-card mr-1" style="color:var(--teal)"></i> NIS Siswa / NIP Guru</label><input type="text" name="identitas" class="form-control" placeholder="0103786196 / 198012..." value="<?= htmlspecialchars($keyword_identitas); ?>" required></div>
                    <div class="form-group"><label class="small font-weight-bold" style="color:var(--dark)"><i class="fas fa-phone-alt mr-1" style="color:var(--teal)"></i> No HP Terdaftar (verifikasi ganda)</label><input type="text" name="hp" class="form-control" placeholder="+62 812-6938-9167" value="<?= htmlspecialchars($keyword_hp); ?>" required></div>
                    <div class="form-group"><label class="small font-weight-bold" style="color:var(--dark)"><i class="fas fa-school mr-1" style="color:var(--teal)"></i> Kelas <small class="text-muted font-weight-normal">(Wajib Siswa, kosongkan jika Guru)</small></label><input type="text" name="kelas" class="form-control" value="<?= htmlspecialchars($keyword_kelas); ?>" placeholder="XI RPL 2"></div>
                    <div class="form-group"><label class="small font-weight-bold" style="color:var(--dark)"><i class="fas fa-map-marker-alt mr-1" style="color:var(--teal)"></i> Alamat (ketik sebagian, LIKE %alamat%)</label><input type="text" name="alamat" class="form-control" placeholder="Medang Ara / Karang Baru / Aceh Tamiang" value="<?= htmlspecialchars($keyword_alamat); ?>" required></div>
                    <button type="submit" name="cari_riwayat" class="btn btn-block rounded-pill font-weight-bold mt-3 text-white shadow-lg shimmer" style="background:linear-gradient(90deg,var(--teal),var(--teal2));padding:14px; position:relative; z-index:20; pointer-events:auto; cursor:pointer"><i class="fas fa-search mr-2"></i> VERIFIKASI & LIHAT RIWAYAT</button>
                </form>
                <div class="mt-3 p-3 position-relative" style="background:var(--mint2);border-radius:12px;border:1px dashed #99f6e0; z-index:2"><small class="text-muted" style="font-size:11px; line-height:1.6"><i class="fas fa-lightbulb mr-1" style="color:#a16207"></i> <b>Jika guru, kosongkan kelas.</b> Sistem otomatis deteksi: siswa pakai nis+kelas+alamat, guru pakai nip+alamat. Query pakai LIKE %alamat% + prepared statement.</small></div>
            </div>
        </div>

        <!-- HASIL PROFIL + RIWAYAT - MENARI -->
        <div class="col-md-7 reveal" style="transition-delay:.12s">
            <?php if($pencarian_dilakukan && $dataPasien): 
              $valGoldar = ambilField($dataPasien, ['goldar','gol_darah','golongandarah','golongan_darah','golongan_darah_siswa','gol_darah_siswa','darah','blood_type'], '-');
              $valPenyakit = ambilField($dataPasien, ['riwayatpenyakit','riwayat_penyakit','penyakit','riwayatpenyakit_siswa'],'Tidak ada');
              $valAlergi = ambilField($dataPasien, ['riwayatalergi','riwayat_alergi','alergi','riwayatalergi_siswa'],'-');
            ?>
                <div class="uk-card p-4 mb-4 shimmer" style="border:2px solid var(--teal); animation:popUp .8s both">
                    <div class="d-flex justify-content-between align-items-center mb-4 position-relative" style="z-index:2">
                      <h5 class="font-weight-bold mb-0" style="color:var(--dark)"><i class="fas fa-id-badge mr-2" style="color:var(--teal)"></i> Profil Pasien Ditemukan</h5>
                      <span class="badge-mint" style="background:var(--teal);color:white; animation:pulseBadge 1.5s infinite"><i class="fas fa-check-circle mr-1"></i> <?= strtoupper($jenisPasien) ?> • <?= $jenisPasien=='siswa'? htmlspecialchars($dataPasien['kelas']) : 'GURU' ?></span>
                    </div>
                    <div class="row position-relative" style="z-index:2">
                        <div class="col-3 text-center"><img src="assets/images/<?= $jenisPasien=='siswa'?'siswa':'guru' ?>/<?= $dataPasien['foto'] ?? 'default.png' ?>" class="img-fluid rounded-circle" style="width:88px;height:88px;object-fit:cover;border:4px solid var(--mint); box-shadow:0 8px 25px rgba(15,118,110,0.15)" onerror="this.src='assets/images/user/default.png'"><br><span class="badge mt-2 px-3 py-1" style="background:var(--dark);color:#5eead4;border-radius:20px"><?= $jenisPasien=='siswa'? $dataPasien['nis'] : $dataPasien['nip'] ?></span><br><small class="text-muted" style="font-size:11px"><?= htmlspecialchars($dataPasien['nohp']) ?></small></div>
                        <div class="col-9">
                            <div class="row">
                                <div class="col-7 mb-3"><small class="text-muted d-block" style="font-size:11px;letter-spacing:1px">NAMA LENGKAP</small><b style="color:var(--dark);font-size:19px"><?= htmlspecialchars($jenisPasien=='siswa'?$dataPasien['namasiswa']:$dataPasien['namaguru']) ?></b><br><small class="text-muted"><i class="fas fa-map-marker-alt mr-1" style="color:var(--teal)"></i><?= htmlspecialchars($dataPasien['alamat'] ?? '-') ?></small><br><small class="badge mt-1 px-2 py-1" style="background:var(--mint2);color:var(--teal);border-radius:20px"><?= $jenisPasien=='siswa'? $dataPasien['kelas'] : $dataPasien['jabatan'] ?? 'Guru' ?></small></div>
                                <div class="col-5 mb-3 text-center"><small class="text-muted d-block" style="font-size:11px;letter-spacing:1px">GOL DARAH</small><div class="mx-auto d-flex align-items-center justify-content-center text-white font-weight-bold shimmer" style="width:62px;height:62px;border-radius:16px;background:linear-gradient(135deg,#dc2626,#ef4444);font-size:24px; box-shadow:0 8px 20px rgba(220,38,38,0.25)"><?= htmlspecialchars($valGoldar) ?></div></div>
                                <div class="col-12"><div class="p-3" style="background:linear-gradient(90deg,var(--mint2),white);border-radius:12px;border-left:4px solid var(--teal2)"><small class="text-muted d-block" style="font-size:11px;letter-spacing:1px">RIWAYAT PENYAKIT / ALERGI • Penting untuk penanganan</small><span class="small font-weight-bold" style="color:var(--dark)"><i class="fas fa-exclamation-circle mr-1" style="color:#dc2626"></i> <?= htmlspecialchars($valPenyakit) ?> / Alergi: <?= htmlspecialchars($valAlergi) ?></span></div></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="uk-card overflow-hidden reveal" style="animation-delay:.1s">
                    <div class="p-3 text-white d-flex justify-content-between align-items-center shimmer" style="background:linear-gradient(90deg,var(--teal),var(--teal2)); position:relative; z-index:2"><b><i class="fas fa-history mr-2"></i> Linimasa Penanganan (<?= count($riwayatMedis) ?> kali)</b><span class="badge px-3 py-1" style="background:white;color:var(--teal);border-radius:20px;animation:pulseBadge 2s infinite"><?= count($riwayatMedis) ?>x berobat • Real-time</span></div>
                    <div class="table-responsive"><table class="table table-hover mb-0" style="font-size:13px"><thead style="background:var(--mint2)"><tr><th style="color:var(--dark)">Tanggal</th><th style="color:var(--dark)">Keluhan</th><th style="color:var(--dark)">Tindakan + Obat</th><th style="color:var(--dark)">Status</th><th style="color:var(--dark)">Petugas</th></tr></thead><tbody><?php foreach($riwayatMedis as $m): ?><tr style="transition:all .3s" onmouseover="this.style.background='var(--mint2)'" onmouseout="this.style.background='transparent'"><td><b style="color:var(--dark)"><?= date('d M Y', strtotime($m['tanggalpenanganan'])) ?></b><br><small class="text-muted"><?= date('H:i', strtotime($m['tanggalpenanganan'])) ?></small></td><td><span style="font-weight:600"><?= htmlspecialchars($m['keluhan']) ?></span></td><td><?= htmlspecialchars($m['tindakan']) ?><br><?php $det=getDetailObat($koneksi,$m['idpenanganan']); while($o=mysqli_fetch_assoc($det)): ?><span class="badge border mt-1" style="background:var(--mint2);color:var(--teal);border-color:var(--mint) !important; border-radius:20px"><i class="fas fa-pills mr-1"></i> <?= $o['namabarang'] ?> x<?= $o['jumlahkeluar'] ?> <?= $o['satuan'] ?></span> <?php endwhile; ?></td><td><span class="badge px-3 py-1" style="background:<?= $m['statuspasien']=='sembuh'?'#dcfce7':($m['statuspasien']=='rujuk'?'#fee2e2':'#fef9c3') ?>;color:<?= $m['statuspasien']=='sembuh'?'#166534':($m['statuspasien']=='rujuk'?'#991b1b':'#854d0e') ?>;border-radius:20px;font-weight:700"><?= strtoupper($m['statuspasien']) ?></span></td><td><small class="font-weight-bold" style="color:var(--dark)"><?= htmlspecialchars($m['petugas'] ?? '-') ?></small></td></tr><?php endforeach; ?><?php if(empty($riwayatMedis)): ?><tr><td colspan="5" class="text-center text-muted p-5"><div class="icon-box mx-auto mb-3" style="background:#f1f5f9;color:#94a3b8"><i class="fas fa-inbox"></i></div>Belum ada riwayat penanganan • Sehat terus ya!</td></tr><?php endif; ?></tbody></table></div>
                    <div class="p-3 text-center" style="background:var(--mint2)"><a href="index.php?halaman=kontak" class="btn rounded-pill px-4 font-weight-bold" style="background:white;border:1px solid #ccfbf1;color:var(--teal); position:relative; z-index:20; pointer-events:auto"><i class="fas fa-phone-alt mr-1"></i> Butuh Konsultasi? Hubungi PMR</a></div>
                </div>
            <?php else: ?>
                <div class="uk-card p-5 text-center reveal" style="min-height:520px;display:flex;align-items:center;justify-content:center;background:linear-gradient(180deg,white,var(--mint2)); border:1px dashed var(--teal2)">
                  <div class="position-relative" style="z-index:2">
                    <div class="icon-box mx-auto mb-4 shimmer" style="width:88px;height:88px;border-radius:22px;background:linear-gradient(135deg,var(--mint),#99f6e0);color:var(--teal)"><i class="fas fa-lock fa-2x"></i></div>
                    <h5 class="font-weight-bold" style="color:var(--dark)">Menunggu Verifikasi 4 Faktor</h5>
                    <p class="small text-muted" style="max-width:360px;margin:0 auto; line-height:1.7">Isi NIS <b style="color:var(--teal)">0103786196</b> + Kelas <b style="color:var(--teal)">XI RPL 2</b> + Alamat <b style="color:var(--teal)">Karang Baru</b> + HP untuk buka data <b>Zulaika Fatarani</b> seperti di screenshot kamu. Jika Guru, kosongkan kelas.</p>
                    <div class="mt-4 p-4 small text-left" style="background:white;border-radius:14px;border:1px solid #ccfbf1;max-width:360px;margin:0 auto; box-shadow:0 8px 25px rgba(15,118,110,0.08)"><div class="d-flex justify-content-between align-items-center mb-2"><b style="color:var(--dark)"><i class="fas fa-flask mr-1" style="color:var(--teal)"></i> Contoh Test Data Kamu:</b><span class="badge px-2 py-1" style="background:var(--teal);color:white;border-radius:20px">TEST</span></div>NIS: <code>0103786196</code><br>HP: <code>081269389167</code> / <code>+62 812-6938-9167</code><br>Kelas: <code>XI RPL 2</code><br>Alamat: <code>Medang Ara</code> / <code>Karang Baru</code><br><small class="text-muted">Alamat pakai LIKE %alamat% jadi bisa sebagian</small></div>
                    <div class="mt-4"><span class="badge px-3 py-2 mr-2" style="background:white;border:1px solid #ccfbf1;color:var(--teal);border-radius:20px"><i class="fas fa-shield-alt mr-1"></i> Aman • Prepared Statement</span><span class="badge px-3 py-2" style="background:var(--dark);color:#5eead4;border-radius:20px"><i class="fas fa-database mr-1"></i> 7 Entitas FIX</span></div>
                  </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function(){
  const reveals=document.querySelectorAll('.reveal');
  const obs=new IntersectionObserver(entries=>{entries.forEach(e=>{if(e.isIntersecting){e.target.classList.add('active')}})},{threshold:0.12});
  reveals.forEach(r=>obs.observe(r));
});
</script>