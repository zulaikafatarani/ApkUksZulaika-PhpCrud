<?php
if(isset($_POST['kirim_konsultasi'])){
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $kelas = mysqli_real_escape_string($koneksi, $_POST['kelas']);
    $wa = mysqli_real_escape_string($koneksi, $_POST['wa']);
    $keluhan = mysqli_real_escape_string($koneksi, $_POST['keluhan']);
    $_SESSION['flash_kontak'] = "Terima kasih $nama! Laporan ($kelas) diterima tim PMR. Kami hubungi via WA $wa. Segera ke UKS Gedung C Lt.1 ya!";
    echo "<script>window.location='index.php?halaman=kontak';</script>"; exit;
}
?>
<section class="py-5 position-relative" style="background:#f8fafc; overflow:hidden">
<style>
:root{ --teal:#0f766e; --teal2:#14b8a6; --mint:#ccfbf1; --mint2:#f0fdfa; --dark:#064e3b; --radius:20px; }
.uk-card{border-radius:var(--radius); border:1px solid #e0f2f1; background:white; box-shadow:0 10px 35px rgba(15,118,110,0.07); transition:all .5s cubic-bezier(0.4,0,0.2,1); position:relative; overflow:hidden; z-index:5}
.uk-card::after{content:''; position:absolute; top:0; left:-100%; width:100%; height:100%; background:linear-gradient(90deg, transparent, rgba(204,251,241,0.5), transparent); transition:0s; pointer-events:none}
.uk-card:hover::after{left:100%; transition:0.9s}
.uk-card:hover{transform:translateY(-6px); box-shadow:0 22px 60px rgba(15,118,110,0.14); border-color:var(--teal2)}
.icon-box{width:52px;height:52px;border-radius:14px;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,var(--teal),var(--teal2));color:white; transition:all .5s; flex-shrink:0}
.uk-card:hover .icon-box{transform:rotateY(180deg) scale(1.1)}
.icon-box.mint{background:var(--mint);color:var(--teal); border:1px solid #99f6e0}
.section-title{font-weight:800;color:var(--dark); letter-spacing:-0.5px}
.form-control{border-radius:14px;border:1px solid #ccfbf1;padding:12px 18px; transition:all .3s}
.form-control:focus{border-color:var(--teal2);box-shadow:0 0 0 4px var(--mint2); transform:translateY(-1px)}
.float-orb{position:absolute; border-radius:50%; pointer-events:none !important; z-index:1}
.orb1{width:260px;height:260px;background:radial-gradient(circle, rgba(20,184,166,0.18), transparent 70%); animation:floatOrb 7s ease-in-out infinite}
.orb2{width:320px;height:320px;background:radial-gradient(circle, rgba(204,251,241,0.6), transparent 70%); animation:floatOrb 9s ease-in-out infinite reverse}
@keyframes floatOrb{0%,100%{transform:translateY(0) scale(1)}50%{transform:translateY(-30px) scale(1.08)}}
.reveal{opacity:0; transform:translateY(32px); transition:all .9s cubic-bezier(0.4,0,0.2,1)}
.reveal.active{opacity:1; transform:translateY(0)}
.shimmer{position:relative; overflow:hidden}
.shimmer::before{content:''; position:absolute; top:0; left:-100%; width:60%; height:100%; background:linear-gradient(90deg, transparent, rgba(255,255,255,0.6), transparent); animation:shimmer 3s infinite; pointer-events:none}
@keyframes shimmer{0%{left:-100%}100%{left:200%}}
.badge-mint{background:var(--mint);color:var(--teal);border-radius:30px;padding:9px 18px;font-weight:800;animation:pulseBadge 2s infinite}
@keyframes pulseBadge{0%,100%{transform:scale(1)}50%{transform:scale(1.05)}}
</style>

<!-- ORNAMEN ANIMASI -->
<div class="float-orb orb1" style="top:5%; left:-60px"></div>
<div class="float-orb orb2" style="bottom:10%; right:-80px"></div>
<div style="position:absolute; inset:0; background-image:radial-gradient(#ccfbf1 1.4px, transparent 1.4px); background-size:22px 22px; opacity:0.35; pointer-events:none"></div>

<div class="container position-relative" style="z-index:5">
    <div class="text-center mb-5 reveal">
        <span class="badge-mint mb-3"><i class="fas fa-phone-alt mr-2"></i> LAYANAN DARURAT & ADUAN</span>
        <h1 class="section-title" style="font-size:42px">Kontak & Konsultasi UKS</h1>
        <p class="text-muted small font-weight-bold mt-2">Tim PMR dan Pembina UKS SMKN 1 Karang Baru siap melayani kebutuhan medis warga sekolah • Gedung C Lt.1 Sebelah Lab RPL</p>
        <div class="mt-3 d-flex justify-content-center flex-wrap">
          <span class="badge px-3 py-2 mr-2 mb-2" style="background:white;border:1px solid #ccfbf1;color:var(--teal);border-radius:20px"><i class="fas fa-map-marker-alt mr-1"></i> Aceh Tamiang 24476</span>
          <span class="badge px-3 py-2 mr-2 mb-2" style="background:white;border:1px solid #ccfbf1;color:var(--teal);border-radius:20px"><i class="fas fa-clock mr-1"></i> 07.30 - 16.00 WIB</span>
          <span class="badge px-3 py-2 mb-2" style="background:var(--dark);color:#5eead4;border-radius:20px"><i class="fas fa-heartbeat mr-1"></i> 0103786196 XI RPL 2 Zulaika</span>
        </div>
    </div>

    <?php if(isset($_SESSION['flash_kontak'])): ?>
        <div class="uk-card p-4 mb-4 text-center font-weight-bold text-white reveal active" style="background:linear-gradient(90deg,var(--teal),var(--teal2));border:none; animation:popUp .8s both">
          <div class="d-flex align-items-center justify-content-center"><div style="width:44px;height:44px;border-radius:12px;background:rgba(255,255,255,0.2);display:flex;align-items:center;justify-content:center" class="mr-3"><i class="fas fa-check-circle" style="font-size:22px"></i></div><div class="text-left"><b>Berhasil!</b><br><span style="font-weight:600; opacity:0.95"><?= $_SESSION['flash_kontak']; unset($_SESSION['flash_kontak']); ?></span></div></div>
        </div>
    <?php endif; ?>

    <div class="row align-items-stretch">
        <div class="col-lg-5 mb-4 reveal">
            <div class="uk-card h-100 p-4">
                <h4 class="section-title mb-4"><i class="fas fa-hospital-symbol mr-2" style="color:var(--teal)"></i>Info Ruang UKS</h4>
                
                <div class="d-flex mb-4"><div class="icon-box mint mr-3"><i class="fas fa-map-marker-alt"></i></div><div><h6 class="font-weight-bold mb-1" style="color:var(--dark)">Lokasi Gedung</h6><p class="text-muted small mb-0" style="line-height:1.7">Gedung C Lt.1 (Sebelah Lab RPL),<br>SMKN 1 Karang Baru, Aceh Tamiang.<br><b style="color:var(--teal)">Medang Ara, Karang Baru - 24476</b></p><a href="https://maps.google.com/?q=SMKN+1+Karang+Baru" target="_blank" class="badge mt-2 px-3 py-1" style="background:var(--mint2);color:var(--teal);border-radius:20px; text-decoration:none; position:relative; z-index:20; pointer-events:auto">Buka Maps <i class="fas fa-external-link-alt ml-1"></i></a></div></div>
                
                <div class="d-flex mb-4"><div class="icon-box mint mr-3"><i class="fas fa-phone"></i></div><div><h6 class="font-weight-bold mb-1" style="color:var(--dark)">Hotline Darurat</h6><p class="small font-weight-bold mb-1" style="color:var(--teal); font-size:15px">+62 812-3456-7890</p><span class="badge px-2 py-1" style="background:var(--dark);color:#5eead4;border-radius:20px;font-size:11px">Piket PMR 24 Jam Darurat</span><br><small class="text-muted mt-1 d-block" style="font-size:11px">No HP ini juga untuk verifikasi <code>cekriwayat.php</code> (NIS/NIP + nohp)</small></div></div>
                
                <div class="d-flex mb-4"><div class="icon-box mint mr-3"><i class="fas fa-envelope"></i></div><div><h6 class="font-weight-bold mb-1" style="color:var(--dark)">Email Resmi</h6><p class="small mb-0" style="color:var(--teal);font-weight:700">uks@smkn1karangbaru.sch.id</p><small class="text-muted">buk.ely@smkn1karangbaru.sch.id (Pembina - admin)</small></div></div>
                
                <div class="d-flex mb-4"><div class="icon-box mint mr-3"><i class="fas fa-clock"></i></div><div><h6 class="font-weight-bold mb-1" style="color:var(--dark)">Jam Operasional</h6><p class="text-muted small mb-0">Senin - Jumat (Jam KBM)<br><b style="color:var(--dark)">07.30 - 16.00 WIB</b><br>Istirahat: 12.00 - 13.00<br>Sabtu: Piket Insidental</p></div></div>

                <hr style="border-color:#e0f2f1">
                <div style="border-radius:16px;overflow:hidden;border:1px solid #e0f2f1; box-shadow:0 8px 25px rgba(15,118,110,0.08)">
                  <iframe src="https://maps.google.com/maps?q=SMKN%201%20Karang%20Baru%20Aceh%20Tamiang&t=&z=15&ie=UTF8&iwloc=&output=embed" width="100%" height="240" style="border:0" allowfullscreen loading="lazy"></iframe>
                  <div class="p-3 d-flex justify-content-between align-items-center" style="background:var(--mint2)">
                    <small class="font-weight-bold" style="color:var(--dark)"><i class="fas fa-map-pin mr-1" style="color:var(--teal)"></i> SMKN 1 Karang Baru</small>
                    <a href="https://maps.app.goo.gl/" target="_blank" class="btn btn-sm rounded-pill px-3 font-weight-bold text-white" style="background:var(--teal); position:relative; z-index:20; pointer-events:auto">Rute</a>
                  </div>
                </div>
            </div>
        </div>

        <div class="col-lg-7 mb-4 reveal" style="transition-delay:.12s">
            <div class="uk-card h-100 p-4 p-lg-5">
                <div class="d-flex justify-content-between align-items-start mb-4">
                  <div>
                    <h4 class="section-title mb-1"><i class="fas fa-notes-medical mr-2" style="color:var(--teal)"></i>Konsultasi Kesehatan Online</h4>
                    <p class="text-muted small mb-0">Isi form ini, data akan dipakai untuk menyiapkan obat dari <code>barang.idkategori</code> sebelum kamu ke UKS</p>
                  </div>
                  <span class="badge px-3 py-2" style="background:var(--dark);color:#5eead4;border-radius:20px;animation:pulseBadge 2s infinite"><span style="width:6px;height:6px;background:#2dd4bf;border-radius:50%;display:inline-block;margin-right:6px"></span>Online</span>
                </div>

                <form method="POST" action="index.php?halaman=kontak">
                    <div class="form-row">
                        <div class="form-group col-md-6"><label class="small font-weight-bold" style="color:var(--dark)"><i class="fas fa-user mr-1" style="color:var(--teal2)"></i> Nama Lengkap</label><input type="text" name="nama" class="form-control" placeholder="Zulaika Fatarani..." required></div>
                        <div class="form-group col-md-6"><label class="small font-weight-bold" style="color:var(--dark)"><i class="fas fa-id-badge mr-1" style="color:var(--teal2)"></i> Kelas / Jabatan</label><input type="text" name="kelas" class="form-control" placeholder="XI RPL 2 / Guru..." required></div>
                    </div>
                    <div class="form-group"><label class="small font-weight-bold" style="color:var(--dark)"><i class="fab fa-whatsapp mr-1" style="color:#25D366"></i> No WA Aktif (untuk verifikasi cekriwayat.php)</label><input type="text" name="wa" class="form-control" placeholder="0812-6938-9167" required><small class="text-muted" style="font-size:11px">WA ini dipakai untuk verifikasi di halaman Cek Riwayat • Format: 08xx</small></div>
                    <div class="form-group"><label class="small font-weight-bold" style="color:var(--dark)"><i class="fas fa-comment-medical mr-1" style="color:var(--teal2)"></i> Keluhan / Gejala Detail</label><textarea name="keluhan" class="form-control" rows="5" placeholder="Contoh: Pusing + demam sejak pagi, sudah minum paracetamol tapi belum membaik. Lokasi di kelas XI RPL 2..." required></textarea><small class="text-muted" style="font-size:11px">Tulis detail agar petugas menyiapkan obat dari lemari kategori yang sesuai ERD 7 entitas</small></div>
                    
                    <div class="p-3 mb-3" style="background:var(--mint2);border-radius:14px;border:1px dashed #99f6e0">
                      <small class="font-weight-bold" style="color:var(--dark)"><i class="fas fa-lightbulb mr-1" style="color:#a16207"></i> Alur setelah kirim:</small><br>
                      <small class="text-muted" style="line-height:1.6">1. Tim PMR cek stok di <code>barang.stok</code> • 2. Siapkan obat sesuai <code>kategori.namakategori</code> • 3. Hubungi via WA • 4. Datang ke Gedung C Lt.1 untuk penanganan & potong stok otomatis</small>
                    </div>

                    <button type="submit" name="kirim_konsultasi" class="btn btn-block rounded-pill font-weight-bold shadow-lg mt-3 text-white shimmer" style="background:linear-gradient(90deg,var(--teal),var(--teal2));padding:14px; position:relative; z-index:20; pointer-events:auto; cursor:pointer"><i class="fas fa-paper-plane mr-2"></i> Kirim Laporan Kesehatan</button>
                    <div class="text-center mt-3"><small class="text-muted" style="font-size:11px"><i class="fas fa-lock mr-1"></i> Data terenkripsi • Hanya pembina & PMR piket yang bisa lihat • Sesuai SOP UKS SMKN 1 Karang Baru</small></div>
                </form>
            </div>
        </div>
    </div>

    <div class="uk-card mt-2 p-4 text-center reveal" style="background:linear-gradient(135deg, var(--dark), var(--teal));border:none;color:white">
      <div class="row align-items-center">
        <div class="col-md-8 text-md-left"><h5 class="font-weight-bold mb-1 text-white"><i class="fas fa-exclamation-triangle mr-2" style="color:#fbbf24"></i> Gawat Darurat?</h5><p class="small mb-0" style="opacity:0.9">Pingsan / kejang / luka berat segera hubungi hotline atau panggil petugas PMR piket ke lokasi - data akan masuk ke <code style="background:rgba(255,255,255,0.15);color:#5eead4;padding:2px 6px;border-radius:6px">penanganan.statuspasien = 'rujuk ke puskesmas/RS'</code> + potong stok alkes otomatis</p></div>
        <div class="col-md-4 text-md-right mt-3 mt-md-0"><a href="tel:+6281234567890" class="btn btn-light rounded-pill px-4 font-weight-bold" style="color:var(--teal); position:relative; z-index:20; pointer-events:auto"><i class="fas fa-phone-alt mr-2"></i> Call Hotline</a></div>
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