<?php
// views/user/siswa/cetakkartu.php - FINAL - BADGE OTOMATIS SISWA / ANGGOTA
batasi_akses_role(['admin','petugas','anggota']);
$id = (int)($_GET['id'] ?? 0);
$d = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM siswa WHERE idsiswa=$id LIMIT 1"));
if(!$d){ echo '<div class="alert alert-danger m-3">Siswa tidak ditemukan</div>'; return; }

// Cek apakah siswa ini anggota UKS
$isAnggotaUKS = false;
$roleUKS = 'ANGGOTA';
$cekUser = @mysqli_query($koneksi, "SELECT role FROM user WHERE namauser LIKE '%".mysqli_real_escape_string($koneksi, $d['namasiswa'])."%' LIMIT 1");
if($cekUser && mysqli_num_rows($cekUser)>0){ $isAnggotaUKS=true; $u=mysqli_fetch_assoc($cekUser); $roleUKS=strtoupper($u['role']); }

$badgeText = $isAnggotaUKS ? $roleUKS.' UKS • AKTIF' : 'SISWA • TERDAFTAR';
$badgeStyle = $isAnggotaUKS ? 'background:#ccfbf1; color:#0f766e; border:1px solid #99f6e0' : 'background:rgba(255,255,255,0.2); color:white; border:1px solid rgba(255,255,255,0.3)';

$fotoPath = 'assets/images/siswa/'.($d['foto'] ?? 'default.png');
if(!file_exists($fotoPath)) $fotoPath='assets/images/user/default.png';
?>
<div class="dash">
  <div class="content-header"><div class="container-fluid"><div class="row mb-2 align-items-center"><div class="col-sm-7"><h1 class="m-0 font-weight-bold" style="color:var(--dark)"><i class="fas fa-id-card mr-2" style="color:var(--teal)"></i> Cetak Kartu UKS - Siswa</h1><small class="text-muted">UKS Digital - <b style="color:var(--teal)"><?= htmlspecialchars($d['namasiswa']) ?></b> • NIS <?= htmlspecialchars($d['nis']) ?></small></div><div class="col-sm-5 text-right"><a href="index.php?halaman=siswa" class="btn-outline-bar"><i class="fas fa-arrow-left"></i> Kembali</a> <button onclick="window.print()" class="btn-toska"><i class="fas fa-print"></i> Cetak</button></div></div></div></div>
  <div class="content"><div class="container-fluid"><div class="row justify-content-center"><div class="col-md-7">
    <div class="kartu-uks" style="background:linear-gradient(135deg, #064e3b, #0f766e 50%, #14b8a6); border-radius:20px; overflow:hidden; color:white; box-shadow:0 12px 40px rgba(15,118,110,0.25)">
      <div style="padding:16px 20px; border-bottom:1px solid rgba(255,255,255,0.2); display:flex; justify-content:space-between; font-weight:800"><div><i class="fas fa-heartbeat mr-2"></i> KARTU UKS DIGITAL</div><span style="font-size:11px">SMKN 1 KARANG BARU</span></div>
      <div style="padding:20px; display:flex; justify-content:space-between; align-items:center">
        <div class="d-flex align-items-center"><img src="<?= $fotoPath ?>" style="width:70px;height:70px;object-fit:cover;border-radius:50%;border:3px solid white;margin-right:14px" onerror="this.src='assets/images/user/default.png'"><div><h4 style="margin:0 0 6px; font-weight:800; font-size:20px"><?= htmlspecialchars($d['namasiswa']) ?></h4><div style="font-size:13px; line-height:1.5">NIS/NIP: <b><?= htmlspecialchars($d['nis']) ?></b><br>Kelas: <?= htmlspecialchars($d['kelas']) ?><br>Goldar: <b><?= htmlspecialchars($d['golongandarah'] ?? '-') ?></b></div><div style="margin-top:10px"><span class="badge" style="<?= $badgeStyle ?>; border-radius:20px; padding:6px 14px; font-size:11px; font-weight:700"><?= $badgeText ?></span></div></div></div>
        <div style="background:white; border-radius:16px; padding:10px; text-align:center"><img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=<?= urlencode($d['nis']) ?>" style="width:90px;height:90px"><br><small style="color:#064e3b; font-weight:700; font-size:10px">SCAN DI UKS</small></div>
      </div>
      <div class="p-3 text-center" style="border-top:1px solid rgba(255,255,255,0.2); font-size:11px; opacity:0.85">Berlaku selama menjadi siswa SMKN 1 Karang Baru • Jika hilang hubungi petugas UKS</div>
    </div>
    <div class="text-center mt-3"><button onclick="window.print()" class="btn-toska"><i class="fas fa-print"></i> Cetak Kartu</button> <a href="index.php?halaman=siswa" class="btn-outline-bar">Kembali</a></div>
  </div></div></div></div>
</div>