<?php
// views/user/siswa/index.php - FINAL - PAKAI CLASS USER PERSIS - GAK TAMBAH CSS
if (!isset($koneksi)) include __DIR__ . '/../../../proses/koneksi.php';
batasi_akses_role(['admin','petugas','anggota']);
$q = mysqli_query($koneksi, "SELECT * FROM siswa ORDER BY idsiswa DESC");
?>
<div class="dash">
  <!-- HEADER - SAMA PERSIS KAYAK USER: Kelola Akun Sistem -->
  <div class="content-header" style="opacity:1 !important; transform:none !important">
    <div class="container-fluid">
      <div class="row mb-2 align-items-center">
        <div class="col-sm-7">
          <h1 class="m-0 font-weight-bold" style="color:#064e3b">
            <i class="fas fa-user-graduate mr-2" style="color:#0f766e"></i> Data Pasien Siswa
          </h1>
          <small class="text-muted">
            UKS Digital - <b style="color:#0f766e">Admin / Petugas / Anggota</b> |
            <span class="badge-role badge-anggota">SISWA • PASIEN DIDIK</span> | 0103786196
          </small>
        </div>
        <div class="col-sm-5 text-right">
          <a href="index.php?halaman=createsiswa" class="btn-toska">
            <i class="fas fa-plus mr-1"></i> Tambah Siswa
          </a>
        </div>
      </div>
    </div>
  </div>

  <div class="content">
    <div class="container-fluid">
      <!-- CARD - SAMA PERSIS KAYAK USER: Daftar Pengurus UKS -->
      <div class="uk-card p-0 mb-4" style="overflow:hidden">
        <div class="p-3 d-flex justify-content-between align-items-center" style="border-bottom:1px solid #e0f2f1;background:#f0fdfa">
          <h6 class="font-weight-bold mb-0" style="color:#064e3b">
            <i class="fas fa-users mr-2" style="color:#0f766e"></i> Daftar Siswa UKS
          </h6>
          <span class="badge-mint"><?= mysqli_num_rows($q) ?> Siswa</span>
        </div>

        <div class="table-responsive">
          <table class="table table-hover table-uks mb-0">
            <thead>
              <tr>
                <th style="width:70px">No</th>
                <th style="width:90px">Foto</th>
                <th>NIS / NISN</th>
                <th>Nama Lengkap Siswa</th>
                <th>Kelas / Jurusan</th>
                <th style="width:70px">L/P</th>
                <th>No HP</th>
                <th>Riwayat Alergi</th>
                <th class="text-center" style="width:160px">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; while ($d = mysqli_fetch_assoc($q)):
                $namaFoto = $d['foto'] ?? '';
                $pathFoto = 'assets/images/siswa/' . $namaFoto;
                $foto = (!empty($namaFoto) && file_exists($pathFoto)) ? $pathFoto : 'assets/images/siswa/default.png';
                if (!file_exists($foto)) $foto = 'assets/images/user/default.png';
              ?>
              <tr>
                <td class="text-center font-weight-bold text-muted"><?= $no++ ?></td>
                <!-- INI KUNCINYA: pakai foto-user + width/height inline, SAMA KAYAK USER -->
                <td>
                  <img src="<?= $foto ?>" width="45" height="45" class="foto-user" style="width:45px !important; height:45px !important; object-fit:cover; border-radius:50%; border:2px solid #5eead4" onerror="this.src='assets/images/user/default.png'">
                </td>
                <td><b><?= htmlspecialchars($d['nis'] ?? '-') ?></b></td>
                <td><b style="color:#064e3b"><?= htmlspecialchars($d['namasiswa'] ?? '-') ?></b></td>
                <td><span class="badge-role badge-petugas"><?= htmlspecialchars($d['kelas'] ?? '-') ?></span></td>
                <td><b style="color:#dc2626"><?= htmlspecialchars($d['jeniskelamin'] ?? 'P') ?></b></td>
                <td><small class="text-muted"><?= htmlspecialchars($d['nohp'] ?? '-') ?></small></td>
                <td>
                  <?php $alergi = trim($d['riwayatalergi'] ?? '');
                  if (empty($alergi) || strtolower($alergi) == '-' || strtolower($alergi) == 'tidak ada'): ?>
                    <i class="text-muted small">- Tidak Ada -</i>
                  <?php else: ?>
                    <span class="badge-role badge-admin"><i class="fas fa-exclamation-triangle mr-1"></i><?= htmlspecialchars($alergi) ?></span>
                  <?php endif; ?>
                </td>
                <!-- TOMBOL AKSI - SAMA PERSIS KAYAK USER: pill, bukan bulat kecil -->
                <td class="text-center">
                  <a href="index.php?halaman=showsiswa&id=<?= $d['idsiswa'] ?>" class="btn-pill text-white" style="background:linear-gradient(90deg,#0f766e,#14b8a6); padding:6px 10px; font-size:12px"><i class="fas fa-eye"></i></a>
                  <a href="index.php?halaman=editsiswa&id=<?= $d['idsiswa'] ?>" class="btn-pill text-white" style="background:linear-gradient(90deg,#0369a1,#38bdf8); padding:6px 10px; font-size:12px"><i class="fas fa-edit"></i></a>
                  <a href="proses/prosespasien.php?jenis=siswa&aksi=hapus&id=<?= $d['idsiswa'] ?>" class="btn-pill" style="background:#fee2e2; color:#dc2626; border:1px solid #fecaca; padding:6px 10px; font-size:12px" onclick="return confirm('Hapus data siswa ini?')"><i class="fas fa-trash"></i></a>
                </td>
              </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>