<?php
// views/user/penanganan/cetaksurat.php - FINAL FIX - u.namauser bukan u.nama
batasi_akses_role(['admin','petugas','anggota']);
$id = (int)($_GET['id'] ?? 0);
$q = mysqli_query($koneksi, "SELECT p.*, s.nis, s.namasiswa as nama_pasien, s.kelas, s.golongandarah, s.foto as foto_siswa,
       g.nip, g.namaguru, g.foto as foto_guru, u.namauser as nama_petugas
       FROM penanganan p
       LEFT JOIN siswa s ON p.idsiswa=s.idsiswa
       LEFT JOIN guru g ON p.idguru=g.idguru
       LEFT JOIN user u ON p.iduser=u.iduser
       WHERE p.idpenanganan=$id LIMIT 1");
$d = mysqli_fetch_assoc($q);
if(!$d){ echo '<div class="alert alert-danger m-3">Data penanganan tidak ditemukan</div>'; return; }
$isSiswa = !empty($d['idsiswa']);
$nama = $isSiswa ? $d['nama_pasien'] : $d['namaguru'];
$identitas = $isSiswa ? $d['nis'] : $d['nip'];
$kelas = $isSiswa ? $d['kelas'] : 'Guru';
$goldar = $d['golongandarah'] ?? '-';
$obatQ = mysqli_query($koneksi, "SELECT b.namabarang, b.satuan, dp.jumlahkeluar FROM detailpenanganan dp LEFT JOIN barang b ON dp.idbarang=b.idbarang WHERE dp.idpenanganan=$id");
$tanggal = date('d F Y', strtotime($d['tanggalpenanganan']));
$jam = date('H:i', strtotime($d['tanggalpenanganan'] ?? date('Y-m-d H:i:s')));
$status = $d['statuspasien'] ?? 'istirahat';
$statusText = $status=='sembuh' ? 'Sembuh - Kembali ke Kelas' : ($status=='rujuk' ? 'Rujuk ke Puskesmas / RS' : 'Istirahat di UKS');
?>
<div class="dash">
  <div class="content-header"><div class="container-fluid"><div class="row mb-2 align-items-center">
    <div class="col-sm-7"><h1 class="m-0 font-weight-bold" style="color:var(--dark)"><i class="fas fa-file-medical mr-2" style="color:var(--teal)"></i> Surat Izin / Rujukan UKS</h1><small class="text-muted">UKS Digital - <b style="color:var(--teal)"><?= htmlspecialchars($nama) ?></b> • <?= $tanggal ?></small></div>
    <div class="col-sm-5 text-right no-print"><a href="index.php?halaman=showpenanganan&id=<?= $id ?>" class="btn-outline-bar"><i class="fas fa-arrow-left mr-1"></i> Kembali</a> <button onclick="window.print()" class="btn-toska"><i class="fas fa-print mr-1"></i> Cetak Surat</button></div>
  </div></div></div>
  <div class="content"><div class="container-fluid"><div class="row justify-content-center"><div class="col-md-8">
    <div class="uk-card-pen" style="border-radius:20px; overflow:hidden">
      <div class="p-4" style="border-bottom:3px solid var(--teal); background:linear-gradient(135deg,#f0fdfa,#ccfbf1)">
        <div class="d-flex justify-content-between align-items-center">
          <div class="d-flex align-items-center">
            <img src="assets/images/logouks.jpg" style="width:56px;height:56px;object-fit:cover;border-radius:12px;border:2px solid var(--teal)" onerror="this.src='assets/images/user/default.png'">
            <div class="ml-3"><h4 class="mb-0 font-weight-bold" style="color:var(--dark)">UKS DIGITAL</h4><small style="color:var(--teal); font-weight:700">SMKN 1 KARANG BARU • ACEH TAMIANG</small><br><small class="text-muted">Jl. Pendidikan No.1 Karang Baru | Email: uks@smkn1karangbaru.sch.id</small></div>
          </div>
          <div class="text-right"><span class="badge-mint" style="font-size:12px">SURAT KETERANGAN UKS</span><br><small class="text-muted">No: UKS/<?= date('m/Y') ?>/<?= str_pad($id,4,'0',STR_PAD_LEFT) ?></small></div>
        </div>
      </div>
      <div class="p-4">
        <div class="text-center mb-4"><h5 class="font-weight-bold" style="color:var(--dark); text-decoration:underline">SURAT KETERANGAN BEROBAT / IZIN ISTIRAHAT</h5></div>
        <div class="row mb-4">
          <div class="col-md-7">
            <table class="table table-borderless mb-0" style="font-size:14px">
              <tr><td style="width:35%" class="text-muted">Nama Pasien</td><td class="font-weight-bold">: <?= htmlspecialchars($nama) ?></td></tr>
              <tr><td class="text-muted"><?= $isSiswa?'NIS':'NIP' ?></td><td>: <b><?= htmlspecialchars($identitas) ?></b></td></tr>
              <tr><td class="text-muted">Kelas / Jabatan</td><td>: <?= htmlspecialchars($kelas) ?></td></tr>
              <tr><td class="text-muted">Gol. Darah</td><td>: <?= htmlspecialchars($goldar) ?></td></tr>
              <tr><td class="text-muted">Tanggal Berobat</td><td>: <?= $tanggal ?> jam <?= $jam ?> WIB</td></tr>
            </table>
          </div>
          <div class="col-md-5 text-center">
            <div class="qr-box mx-auto" style="width:110px; background:white; border-radius:12px; padding:8px; border:1px solid #ccfbf1"><img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=<?= urlencode($identitas.'-'.$id) ?>" style="width:100%"><small>Verifikasi: <?= htmlspecialchars($identitas) ?></small></div>
          </div>
        </div>
        <hr style="border-top:1px dashed #ccfbf1">
        <div style="font-size:14px; line-height:1.7">
          <p>Yang bersangkutan telah berobat / mendapatkan penanganan di Unit Kesehatan Sekolah (UKS) SMKN 1 Karang Baru dengan keterangan sebagai berikut:</p>
          <table class="table table-bordered" style="font-size:14px; border-radius:12px; overflow:hidden">
            <tr><th style="width:30%; background:#f0fdfa">Keluhan</th><td class="font-weight-bold"><?= htmlspecialchars($d['keluhan']) ?></td></tr>
            <tr><th style="background:#f0fdfa">Tindakan UKS</th><td><?= htmlspecialchars($d['tindakan']) ?></td></tr>
            <tr><th style="background:#f0fdfa">Obat / Alkes</th><td><?php if(mysqli_num_rows($obatQ)==0): ?>- Tidak ada obat / hanya istirahat<?php else: ?><ul class="mb-0 pl-3"><?php while($o=mysqli_fetch_assoc($obatQ)): ?><li><?= htmlspecialchars($o['namabarang']) ?> (<?= $o['jumlahkeluar'] ?> <?= htmlspecialchars($o['satuan']) ?>)</li><?php endwhile; ?></ul><?php endif; ?></td></tr>
            <tr><th style="background:#f0fdfa">Status Akhir</th><td><span class="badge-mint"><?= $statusText ?></span></td></tr>
          </table>
          <p class="mt-3"><?php if($status=='istirahat'): ?>Pasien dianjurkan untuk <b>istirahat di UKS / pulang</b> dan tidak mengikuti KBM sampai kondisi membaik.<?php elseif($status=='rujuk'): ?>Pasien dianjurkan untuk <b>dirujuk ke Puskesmas / Rumah Sakit</b> untuk pemeriksaan lebih lanjut.<?php else: ?>Pasien telah <b>sembuh</b> dan diperbolehkan kembali mengikuti KBM.<?php endif; ?></p>
        </div>
        <div class="row mt-5"><div class="col-6 text-center"></div><div class="col-6 text-center"><p style="font-size:13px">Karang Baru, <?= $tanggal ?><br>Petugas UKS,</p><br><br><br><p class="font-weight-bold" style="color:var(--dark)"><?= htmlspecialchars($d['nama_petugas'] ?? 'Buk Ely') ?><br><small class="text-muted" style="font-weight:400">NIP. -</small></p></div></div>
        <div class="mt-4 p-3" style="background:var(--mint2); border-radius:12px; border:1px solid #99f6e0"><small class="text-muted"><i class="fas fa-shield-alt mr-1" style="color:var(--teal)"></i> Surat ini dicetak otomatis dari sistem UKS DIGITAL SMKN 1 Karang Baru. Scan QR di atas untuk verifikasi keaslian surat. Data penanganan ID #<?= $id ?>.</small></div>
      </div>
    </div>
    <div class="text-center mt-3 no-print"><button onclick="window.print()" class="btn-toska"><i class="fas fa-print mr-1"></i> Cetak Surat</button> <a href="index.php?halaman=penanganan" class="btn-outline-bar">Kembali ke Penanganan</a></div>
  </div></div></div></div>
</div>
<style>@media print {.no-print, .main-header, .main-sidebar, .main-footer, .topbar-uks, .navbar-uks { display:none !important; } .content-wrapper { margin:0 !important; padding:0 !important; } .dash { padding:0 !important; } body { background:white !important; }}</style>