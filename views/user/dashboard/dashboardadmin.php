<?php
batasi_akses_role(['admin']);
function hitung($koneksi,$tabel,$where=""){ $q=mysqli_query($koneksi,"SELECT COUNT(*) as c FROM $tabel $where"); $d=mysqli_fetch_assoc($q); return $d['c']??0; }
$totSiswa = hitung($koneksi,'siswa');
$totGuru = hitung($koneksi,'guru');
$totObat = hitung($koneksi,'barang');
$totKategori = hitung($koneksi,'kategori');
$totUser = hitung($koneksi,'user');
$totPenanganan = hitung($koneksi,'penanganan');
$hariIni = hitung($koneksi,'penanganan',"WHERE DATE(tanggalpenanganan)=CURDATE()");
$bulanIni = hitung($koneksi,'penanganan',"WHERE MONTH(tanggalpenanganan)=MONTH(CURDATE()) AND YEAR(tanggalpenanganan)=YEAR(CURDATE())");
$stokKritis = mysqli_query($koneksi,"SELECT * FROM barang WHERE stok<=5 ORDER BY stok ASC LIMIT 6");
$kadaluarsa = mysqli_query($koneksi,"SELECT * FROM barang WHERE tanggalkadaluarsa < DATE_ADD(CURDATE(), INTERVAL 30 DAY) ORDER BY tanggalkadaluarsa ASC LIMIT 5");
$recent = mysqli_query($koneksi,"SELECT p.*, s.namasiswa, g.namaguru FROM penanganan p LEFT JOIN siswa s ON p.idsiswa=s.idsiswa LEFT JOIN guru g ON p.idguru=g.idguru ORDER BY p.idpenanganan DESC LIMIT 5");
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2 align-items-center">
      <div class="col-sm-7 reveal">
        <h1 class="m-0 font-weight-bold" style="color:var(--dark)"><i class="fas fa-shield-alt mr-2" style="color:var(--teal)"></i>Dashboard Admin - Full Akses</h1>
        <small class="text-muted">UKS Digital SMKN 1 Karang Baru - <b style="color:var(--teal)"><?= htmlspecialchars($_SESSION['namauser']?? '')?></b> | Role: <span class="badge-mint"><?= htmlspecialchars($_SESSION['role']?? 'ADMIN')?></span> | 13 Use Case = YA SEMUA • 0103786196</small>
      </div>
      <div class="col-sm-5 text-right reveal" style="transition-delay:.1s">
        <span class="badge p-2 px-3" style="background:linear-gradient(90deg,var(--teal),var(--teal2)); color:white; border-radius:30px; box-shadow:0 6px 18px rgba(15,118,110,0.2)"><i class="fas fa-calendar mr-1"></i> <?= date('d F Y H:i')?> • Anti Tutup Sidebar</span>
      </div>
    </div>
  </div>
</div>

<div class="content"><div class="container-fluid position-relative">

<div class="float-orb" style="width:220px;height:220px;top:-20px;right:-30px; opacity:0.7"></div>
<div class="float-orb" style="width:160px;height:160px;bottom:10%;left:-20px; animation-delay:2s"></div>

<!-- WELCOME CARD - TOSKA MENARI -->
<div class="uk-card p-4 mb-4 shimmer reveal" style="background:linear-gradient(135deg, var(--dark) 0%, var(--teal) 60%, var(--teal2) 100%); color:white; border:none">
  <div class="row align-items-center position-relative" style="z-index:2">
    <div class="col-md-9">
      <h4 class="font-weight-bold mb-2" style="color:#ccfbf1">Selamat Datang, <?= htmlspecialchars($_SESSION['namauser']);?> <span class="badge px-3 py-2 ml-2" style="background:rgba(255,255,255,0.18); color:#ccfbf1; border-radius:20px; border:1px solid rgba(255,255,255,0.25)">ADMIN - MASTER • FULL</span></h4>
      <p class="mb-2" style="color:#a7f3d0; line-height:1.6">Akses: <b style="color:white">YA semua (No.1-13 tabel kendali)</b> - Kelola Akun (Admin/Petugas/Anggota), Master Siswa/Guru/Kategori/Obat, Transaksi Penanganan, & Cetak Laporan Harian/Bulanan/Tahunan. ERD 7 Entitas FIX.</p>
      <small style="color:#99f6e0"><i class="fas fa-info-circle mr-1"></i> Hari ini <b style="color:white"><?= $hariIni?> pasien</b>, bulan ini <b style="color:white"><?= $bulanIni?> kasus</b>, total <b style="color:white"><?= $totPenanganan?> riwayat</b> • <span class="badge-mint" style="background:rgba(204,251,241,0.18); color:#ccfbf1; border-color:rgba(94,234,212,0.25)">Toska #0f766e</span></small>
    </div>
    <div class="col-md-3 text-right d-none d-md-block"><i class="fas fa-user-shield fa-5x" style="color:rgba(204,251,241,0.18); transform:rotate(-8deg)"></i></div>
  </div>
</div>

<!-- STATISTIK - 4 BOX MENARI ANTI KETUTUP -->
<div class="row">
  <div class="col-lg-3 col-6 mb-3 reveal">
    <div class="small-box-toska p-3 d-flex align-items-center justify-content-between" style="background:linear-gradient(135deg, #ecfdf5, white); border-color:#a7f3d0">
      <div><h3 class="font-weight-bold mb-1" style="color:var(--dark)"><?= $totSiswa?></h3><p class="mb-0 small font-weight-bold" style="color:var(--teal)">Total Siswa</p><small class="text-muted" style="font-size:11px">Pasien Didik • NIS</small></div>
      <div class="stat-icon" style="background:var(--mint); color:var(--teal)"><i class="fas fa-user-graduate"></i></div>
      <a href="index.php?halaman=siswa" class="stretched-link"></a>
    </div>
  </div>
  <div class="col-lg-3 col-6 mb-3 reveal" style="transition-delay:.08s">
    <div class="small-box-toska p-3 d-flex align-items-center justify-content-between" style="background:linear-gradient(135deg, #f0f9ff, white); border-color:#bae6fd">
      <div><h3 class="font-weight-bold mb-1" style="color:var(--dark)"><?= $totObat?></h3><p class="mb-0 small font-weight-bold" style="color:#0369a1"><?= $totKategori?> Kategori Obat</p><small class="text-muted" style="font-size:11px">Jenis Obat & Alkes</small></div>
      <div class="stat-icon" style="background:#e0f2fe; color:#0369a1"><i class="fas fa-pills"></i></div>
      <a href="index.php?halaman=barang" class="stretched-link"></a>
    </div>
  </div>
  <div class="col-lg-3 col-6 mb-3 reveal" style="transition-delay:.16s">
    <div class="small-box-toska p-3 d-flex align-items-center justify-content-between" style="background:linear-gradient(135deg, #fefce8, white); border-color:#fde68a">
      <div><h3 class="font-weight-bold mb-1" style="color:var(--dark)"><?= $totGuru?></h3><p class="mb-0 small font-weight-bold" style="color:#a16207">Data Guru</p><small class="text-muted" style="font-size:11px">Pasien Pendidik • NIP</small></div>
      <div class="stat-icon" style="background:#fef9c3; color:#a16207"><i class="fas fa-chalkboard-teacher"></i></div>
      <a href="index.php?halaman=guru" class="stretched-link"></a>
    </div>
  </div>
  <div class="col-lg-3 col-6 mb-3 reveal" style="transition-delay:.24s">
    <div class="small-box-toska p-3 d-flex align-items-center justify-content-between" style="background:linear-gradient(135deg, #fef2f2, white); border-color:#fecaca">
      <div><h3 class="font-weight-bold mb-1" style="color:var(--dark)"><?= $totUser?></h3><p class="mb-0 small font-weight-bold" style="color:#dc2626">User Sistem</p><small class="text-muted" style="font-size:11px">Admin/Petugas/Anggota</small></div>
      <div class="stat-icon" style="background:#fee2e2; color:#dc2626"><i class="fas fa-users"></i></div>
      <a href="index.php?halaman=user" class="stretched-link"></a>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-8">
    <!-- MENU CEPAT ADMIN - 13 USE CASE MENARI -->
    <div class="uk-card p-4 mb-4 reveal">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="font-weight-bold mb-0" style="color:var(--dark)"><i class="fas fa-bolt mr-2" style="color:var(--teal2)"></i> Menu Cepat Admin - 13 Use Case (YA Semua)</h5>
        <span class="badge-mint">Bedanya sama Petugas ada Kelola Akun</span>
      </div>
      <div class="row text-center">
        <?php $menus=[['user','fa-users-cog','Kelola Akun','danger'],['siswa','fa-user-graduate','Siswa','success'],['guru','fa-chalkboard-teacher','Guru','info'],['kategori','fa-tags','Kategori','warning'],['barang','fa-pills','Obat','teal'],['penanganan','fa-notes-medical','Penanganan','success'],['laporanharian','fa-calendar-day','Lap Harian','primary'],['laporanbulanan','fa-calendar-alt','Lap Bulanan','primary'],['laporantahunan','fa-chart-bar','Lap Tahunan','dark'],['barang','fa-exclamation-triangle','Stok Kritis','danger'],['home','fa-home','Homepage','secondary'],['logout','fa-power-off','Keluar','danger']]; foreach($menus as $i=>$mm):?>
        <div class="col-3 col-md-2 mb-3 reveal" style="transition-delay:<?= $i*0.04?>s">
          <a href="index.php?halaman=<?= $mm[0]?>" class="btn-app-toska text-decoration-none d-block">
            <i class="fas <?= $mm[1]?>" style="color:<?= $mm[3]=='teal'? 'var(--teal)' : ''?>"></i>
            <small class="font-weight-bold d-block" style="color:var(--dark); font-size:11px"><?= $mm[2]?></small>
          </a>
        </div>
        <?php endforeach;?>
      </div>
    </div>

    <!-- 5 PENANGANAN TERBARU - ANTI KETUTUP -->
    <div class="uk-card p-0 mb-4 reveal">
      <div class="p-3 d-flex justify-content-between align-items-center" style="border-bottom:1px solid #e0f2f1; background:var(--mint2)">
        <h6 class="font-weight-bold mb-0" style="color:var(--dark)"><i class="fas fa-history mr-2" style="color:var(--teal)"></i> 5 Penanganan Terbaru</h6>
        <span class="badge-mint"><?= $totPenanganan?> Total</span>
      </div>
      <div class="table-responsive">
        <table class="table table-sm mb-0" style="font-size:13px">
          <thead style="background:var(--mint2); color:var(--teal)"><tr><th class="px-3 py-2">Tgl</th><th>Pasien</th><th>Keluhan</th></tr></thead>
          <tbody>
            <?php while($r=mysqli_fetch_assoc($recent)):?>
            <tr style="transition:all.3s" onmouseover="this.style.background='var(--mint2)'" onmouseout="this.style.background='white'">
              <td class="px-3"><span class="badge" style="background:var(--mint); color:var(--teal); border-radius:20px"><?= date('d/m',strtotime($r['tanggalpenanganan']))?></span></td>
              <td><b style="color:var(--dark)"><?= htmlspecialchars($r['namasiswa']??$r['namaguru']??'-')?></b></td>
              <td><small class="text-muted"><?= htmlspecialchars(substr($r['keluhan']??'-',0,45))?></small></td>
            </tr>
            <?php endwhile;?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <!-- INFO AKUN ADMIN - MENARI -->
    <div class="uk-card p-4 text-center mb-4 reveal">
      <img src="assets/images/user/<?= htmlspecialchars($_SESSION['foto']??'default.png')?>" class="img-circle elevation-2 mb-3" width="90" height="90" style="object-fit:cover; border:3px solid #5eead4; box-shadow:0 0 0 4px var(--mint2); transition:.5s" onmouseover="this.style.transform='scale(1.08) rotate(3deg)'" onmouseout="this.style.transform='scale(1) rotate(0)'" onerror="this.src='assets/images/user/default.png'">
      <h5 class="font-weight-bold mb-1" style="color:var(--dark)"><?= htmlspecialchars($_SESSION['namauser'])?></h5>
      <span class="badge px-3 py-2 mb-3" style="background:linear-gradient(90deg,#dc2626,#ef4444); color:white; border-radius:20px; box-shadow:0 4px 12px rgba(220,38,38,0.2)">ADMIN - FULL AKSES • 13/13</span>
      <hr style="border-color:#e0f2f1">
      <p class="small mb-1">Total Penanganan: <b style="color:var(--teal)"><?= $totPenanganan?> kasus</b></p>
      <p class="small text-muted mb-3">User Sistem: <?= $totUser?> akun | Hari ini: <b><?= $hariIni?></b> | Bulan: <b><?= $bulanIni?></b></p>
      <a href="index.php?halaman=laporanharian" class="btn rounded-pill btn-block font-weight-bold text-white mb-2" style="background:linear-gradient(90deg,var(--teal),var(--teal2)); box-shadow:0 6px 18px rgba(15,118,110,0.2)"><i class="fas fa-file-medical-alt mr-1"></i> Cetak Laporan Hari Ini</a>
      <a href="proses/proseslogout.php" class="btn rounded-pill btn-block font-weight-bold" style="background:#fee2e2; color:#dc2626; border:1px solid #fecaca" onclick="return confirm('Yakin logout?')"><i class="fas fa-power-off mr-1"></i> Keluar Aplikasi</a>
    </div>

    <!-- STOK KRITIS + KADALUARSA - ANTI KETUTUP -->
    <div class="uk-card p-0 mb-4 reveal" style="border-color:#fecaca">
      <div class="p-3 d-flex justify-content-between align-items-center" style="background:linear-gradient(90deg,#fef2f2,#fee2e2); border-bottom:1px solid #fecaca">
        <h6 class="font-weight-bold mb-0" style="color:#dc2626"><i class="fas fa-exclamation-triangle mr-2"></i> Stok Kritis ≤5</h6>
        <span class="badge" style="background:#dc2626; color:white; border-radius:20px">URGENT</span>
      </div>
      <div class="table-responsive"><table class="table table-sm mb-0" style="font-size:12px"><tr style="background:#fef2f2"><th class="px-3">Obat</th><th>Sisa</th></tr><?php while($b=mysqli_fetch_assoc($stokKritis)):?><tr><td class="px-3"><small><?= htmlspecialchars($b['namabarang'])?></small></td><td class="text-danger font-weight-bold"><span class="badge" style="background:#fee2e2; color:#dc2626; border-radius:20px"><?= $b['stok']?></span></td></tr><?php endwhile;?></table></div>
    </div>

    <div class="uk-card p-0 mb-4 reveal" style="border-color:#fde68a; transition-delay:.1s">
      <div class="p-3 d-flex justify-content-between align-items-center" style="background:linear-gradient(90deg,#fefce8,#fef9c3); border-bottom:1px solid #fde68a">
        <h6 class="font-weight-bold mb-0" style="color:#a16207"><i class="fas fa-clock mr-2"></i> Akan Kadaluarsa <30 Hari</h6>
        <span class="badge" style="background:#f59e0b; color:white; border-radius:20px">CEK EXP</span>
      </div>
      <div class="table-responsive"><table class="table table-sm mb-0" style="font-size:12px"><tr style="background:#fefce8"><th class="px-3">Obat</th><th>Exp</th></tr><?php while($k=mysqli_fetch_assoc($kadaluarsa)):?><tr><td class="px-3"><small><?= htmlspecialchars($k['namabarang'])?></small></td><td><small class="badge" style="background:#fef9c3; color:#a16207; border-radius:20px"><?= $k['tanggalkadaluarsa']?></small></td></tr><?php endwhile;?></table></div>
    </div>
  </div>
</div>

</div></div>

<script>
document.addEventListener("DOMContentLoaded", function(){
  const reveals=document.querySelectorAll('.reveal');
  const obs=new IntersectionObserver(entries=>{entries.forEach(e=>{if(e.isIntersecting){e.target.classList.add('active')}})},{threshold:0.12});
  reveals.forEach(r=>obs.observe(r));
});
</script>