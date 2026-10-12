<!-- =====================================================
     FOOTER UKS DIGITAL - VERSI DETAIL PANJANG ANIMASI
===================================================== -->
<style>
:root{ --teal:#0f766e; --teal2:#14b8a6; --mint:#ccfbf1; --mint2:#f0fdfa; --dark:#064e3b; }
.footer-uks{position:relative; background:linear-gradient(180deg, #064e3b 0%, #042f2e 100%); color:#ccfbf1; overflow:hidden; margin-top:0 !important; border-top:none !important}
.footer-uks::before{content:''; position:absolute; width:500px; height:500px; background:radial-gradient(circle, rgba(20,184,166,0.15) 0%, transparent 70%); top:-200px; left:-100px; animation:floatFooter 8s ease-in-out infinite}
.footer-uks::after{content:''; position:absolute; width:400px; height:400px; background:radial-gradient(circle, rgba(45,212,191,0.1) 0%, transparent 70%); bottom:-100px; right:-50px; animation:floatFooter 6s ease-in-out infinite reverse}
@keyframes floatFooter{0%,100%{transform:translateY(0)}50%{transform:translateY(-30px)}}
.footer-wave{position:absolute; top:-1px; left:0; width:100%; overflow:hidden; line-height:0}
.footer-wave svg{width:calc(100% + 1.3px); height:70px; display:block}
.footer-uks a{color:#99f6e0; text-decoration:none !important; transition:.3s}
.footer-uks a:hover{color:white; transform:translateX(4px)}
.footer-title{font-weight:800; color:white; letter-spacing:0.5px; margin-bottom:16px; font-size:15px}
.footer-link{display:flex; align-items:center; padding:7px 0; font-size:13px; color:#99f6e0 !important}
.footer-link i{width:22px; color:var(--teal2)}
.badge-mint-footer{background:rgba(204,251,241,0.12); color:#5eead4; border:1px solid rgba(45,184,166,0.2); border-radius:20px; padding:6px 12px; font-size:11px}
.pulse-dot{width:8px;height:8px;background:#2dd4bf;border-radius:50%;display:inline-block;animation:pulseDot 2s infinite; margin-right:6px}
@keyframes pulseDot{0%{box-shadow:0 0 0 0 rgba(45,212,191,0.7)}70%{box-shadow:0 0 0 8px rgba(45,212,191,0)}100%{box-shadow:0 0 0 0 rgba(45,212,191,0)}}
</style>

<footer class="footer-uks pt-0">
  <!-- WAVE ATAS - SELARAS HERO -->
  <div class="footer-wave"[STRIPPED 19 bytes]"0 0 1200 120" preserveAspectRatio="none" fill="#f8fafc"><path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25"></path><path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.53,57.98,63.27,97.89,69.31,35.18,5.32,69.84-10.8,100.53-26.84,30.69-16,58.8-34.13,90.92-45.13,26.26-8.93,54.93-10.67,83.19-8.2,36.62,3.21,71.15,18.55,106.17,28.82,35,10.28,73.2,13.54,109.11,7.29V0Z" opacity=".5"></path><path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z"></path></svg>
  </div>

  <div class="container position-relative" style="z-index:2; padding-top:100px; padding-bottom:30px">
    <div class="row">
      <!-- 1. IDENTITAS + ANIMASI -->
      <div class="col-lg-4 mb-5">
        <div class="d-flex align-items-center mb-3">
          <div class="d-flex align-items-center justify-content-center mr-3" style="width:48px;height:48px;border-radius:12px;background:linear-gradient(135deg,var(--teal),var(--teal2));box-shadow:0 8px 20px rgba(20,184,166,0.3)"><i class="fas fa-heartbeat text-white"></i></div>
          <div><h5 class="font-weight-bold mb-0 text-white">UKS DIGITAL</h5><small style="color:#5eead4;letter-spacing:1px">SMKN 1 KARANG BARU</small></div>
        </div>
        <p class="small" style="line-height:1.7;color:#99f6e0">Platform manajemen kesehatan berbasis web untuk memodernisasi pencatatan rekam medis. Dibangun sesuai <b style="color:white">ERD 7 entitas</b> di laporan halaman 2 - Zulaika Fatarani XI RPL 2.</p>
        <div class="d-flex flex-wrap mt-3">
          <span class="badge-mint-footer mr-2 mb-2"><span class="pulse-dot"></span>Live System</span>
          <span class="badge-mint-footer mr-2 mb-2"><i class="fas fa-database mr-1"></i>7 Entitas FIX</span>
          <span class="badge-mint-footer mb-2"><i class="fas fa-shield-alt mr-1"></i>ON DELETE CASCADE</span>
        </div>
        <div class="mt-4 p-3" style="background:rgba(255,255,255,0.06);border-radius:14px;border:1px solid rgba(204,251,241,0.1)">
          <small style="color:#5eead4;letter-spacing:1px">ALUR DATA</small><br>
          <small style="font-family:monospace;color:white;line-height:1.6">siswa/guru (nis/nip+nohp) → barang (kategori) → penanganan (keluhan) → detailpenanganan (potong stok) → Laporan</small>
        </div>
      </div>

      <!-- 2. PORTAL PUBLIK -->
      <div class="col-lg-2 col-6 mb-5">
        <div class="footer-title"><i class="fas fa-globe mr-2" style="color:var(--teal2)"></i>PORTAL PUBLIK</div>
        <a href="index.php?halaman=home" class="footer-link"><i class="fas fa-home"></i> Beranda - Grafik Tren</a>
        <a href="index.php?halaman=cekriwayat" class="footer-link"><i class="fas fa-search"></i> Cek Riwayat (NIS/NIP+HP)</a>
        <a href="index.php?halaman=daftarobat" class="footer-link"><i class="fas fa-pills"></i> Katalog Lemari Obat</a>
        <a href="index.php?halaman=daftarkategori" class="footer-link"><i class="fas fa-boxes"></i> Klasifikasi Kategori</a>
        <a href="index.php?halaman=tentang" class="footer-link"><i class="fas fa-heartbeat"></i> Profil & Struktur PMR</a>
        <a href="index.php?halaman=kontak" class="footer-link"><i class="fas fa-phone"></i> Kontak & Konsultasi</a>
        <a href="index.php?halaman=daftarisi" class="footer-link"><i class="fas fa-sitemap"></i> Daftar Isi (Sitemap)</a>
      </div>

      <!-- 3. ZONA INTERNAL -->
      <div class="col-lg-2 col-6 mb-5">
        <div class="footer-title"><i class="fas fa-lock mr-2" style="color:#fbbf24"></i>ZONA INTERNAL</div>
        <a href="index.php?halaman=loginuser" class="footer-link"><i class="fas fa-sign-in-alt"></i> Login Pengurus</a>
        <a href="index.php?halaman=dashboardadmin" class="footer-link"><i class="fas fa-tachometer-alt"></i> Dashboard Admin</a>
        <a href="index.php?halaman=siswa" class="footer-link"><i class="fas fa-user-graduate"></i> Master Siswa (nis,nohp)</a>
        <a href="index.php?halaman=guru" class="footer-link"><i class="fas fa-chalkboard-teacher"></i> Master Guru (nip,nohp)</a>
        <a href="index.php?halaman=barang" class="footer-link"><i class="fas fa-capsules"></i> Stok Obat & Alkes</a>
        <a href="index.php?halaman=penanganan" class="footer-link"><i class="fas fa-hand-holding-medical"></i> Penanganan (Potong Stok)</a>
        <a href="index.php?halaman=laporanharian" class="footer-link"><i class="fas fa-print"></i> Modul Laporan PDF</a>
      </div>

      <!-- 4. KONTAK DETAIL -->
      <div class="col-lg-4 mb-5">
        <div class="footer-title"><i class="fas fa-hospital-symbol mr-2" style="color:var(--teal2)"></i>INFO RUANG UKS</div>
        <div class="d-flex mb-3"><div class="mr-3" style="width:36px;height:36px;border-radius:10px;background:rgba(204,251,241,0.1);display:flex;align-items:center;justify-content:center;flex-shrink:0"><i class="fas fa-map-marker-alt" style="color:var(--teal2)"></i></div><div><b style="color:white">Lokasi Gedung</b><br><small style="color:#99f6e0;line-height:1.6">Gedung C Lt.1 (Sebelah Lab RPL), SMKN 1 Karang Baru, Aceh Tamiang - 24476<br>Medang Ara, Karang Baru</small></div></div>
        <div class="d-flex mb-3"><div class="mr-3" style="width:36px;height:36px;border-radius:10px;background:rgba(204,251,241,0.1);display:flex;align-items:center;justify-content:center;flex-shrink:0"><i class="fas fa-phone" style="color:var(--teal2)"></i></div><div><b style="color:white">Hotline Darurat PMR</b><br><small style="color:#5eead4;font-weight:700">+62 812-3456-7890</small><br><small style="color:#99f6e0;font-size:11px">No HP ini juga untuk verifikasi cekriwayat.php • XI RPL 2 Zulaika</small></div></div>
        <div class="d-flex mb-3"><div class="mr-3" style="width:36px;height:36px;border-radius:10px;background:rgba(204,251,241,0.1);display:flex;align-items:center;justify-content:center;flex-shrink:0"><i class="fas fa-envelope" style="color:var(--teal2)"></i></div><div><b style="color:white">Email Resmi</b><br><small style="color:#99f6e0">uks@smkn1karangbaru.sch.id</small><br><small style="color:#5eead4">buk.ely@smkn1karangbaru.sch.id (Pembina - admin)</small></div></div>
        <div class="d-flex"><div class="mr-3" style="width:36px;height:36px;border-radius:10px;background:rgba(204,251,241,0.1);display:flex;align-items:center;justify-content:center;flex-shrink:0"><i class="fas fa-clock" style="color:var(--teal2)"></i></div><div><b style="color:white">Jam Operasional Piket</b><br><small style="color:#99f6e0">Senin - Jumat (Jam KBM) 07.30 - 16.00 WIB<br>Istirahat: 12.00 - 13.00 • Sabtu: Piket Insidental</small></div></div>

        <div class="mt-4 d-flex">
          <a href="index.php?halaman=cekriwayat" class="btn rounded-pill px-4 mr-2 font-weight-bold" style="background:var(--teal2);color:white"><i class="fas fa-search mr-1"></i> Cek 0103786196</a>
          <a href="index.php?halaman=kontak" class="btn rounded-pill px-4 font-weight-bold" style="background:rgba(255,255,255,0.1);color:white;border:1px solid rgba(255,255,255,0.2)"><i class="fas fa-phone-alt mr-1"></i> Hubungi</a>
        </div>
      </div>
    </div>

    <!-- COPYRIGHT BAWAH - ANIMASI -->
    <hr style="border-color:rgba(204,251,241,0.1); margin:20px 0">
    <div class="row align-items-center">
      <div class="col-md-6 small">
        <strong>Copyright &copy; <?= date('Y'); ?> <a href="index.php?halaman=home" class="text-white font-weight-bold">UKS Digital SMKN 1 Karang Baru</a>.</strong><br>
        <span style="color:#5eead4">All rights reserved • Laporan Mandiri: Zulaika Fatarani - NISN 0103786196 - XI RPL 2 - RPL</span>
      </div>
      <div class="col-md-6 text-md-right mt-3 mt-md-0">
        <div class="d-inline-flex align-items-center px-3 py-2" style="background:rgba(255,255,255,0.06);border-radius:30px;border:1px solid rgba(204,251,241,0.1)">
          <i class="fas fa-heartbeat mr-2" style="color:var(--teal2)"></i><small class="font-weight-bold" style="color:white">Sistem Rekam Medis Sekolah v1.0 • </small><small class="ml-1" style="color:#5eead4">Toska Elegant Edition • Built with ERD 7 Entitas</small>
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- END FOOTER -->