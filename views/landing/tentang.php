<section class="py-5 position-relative" style="background:#f8fafc; overflow:hidden">
<style>
:root{ --teal:#0f766e; --teal2:#14b8a6; --mint:#ccfbf1; --mint2:#f0fdfa; --dark:#064e3b; --radius:20px; }
.uk-card{border-radius:var(--radius); border:1px solid #e0f2f1; background:white; box-shadow:0 10px 35px rgba(15,118,110,0.07); transition:all .5s cubic-bezier(0.4,0,0.2,1); position:relative; overflow:hidden; z-index:5}
.uk-card::after{content:''; position:absolute; top:0; left:-100%; width:100%; height:100%; background:linear-gradient(90deg, transparent, rgba(204,251,241,0.5), transparent); transition:0s; pointer-events:none}
.uk-card:hover::after{left:100%; transition:0.9s}
.uk-card:hover{transform:translateY(-8px) scale(1.02); box-shadow:0 24px 65px rgba(15,118,110,0.15); border-color:var(--teal2)}
.icon-box{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,var(--teal),var(--teal2));color:white; transition:all .5s; flex-shrink:0}
.uk-card:hover .icon-box{transform:rotateY(180deg) scale(1.12)}
.icon-box.mint{background:var(--mint);color:var(--teal); border:1px solid #99f6e0}
.section-title{font-weight:800;color:var(--dark); letter-spacing:-0.5px}
.float-orb{position:absolute; border-radius:50%; pointer-events:none !important; z-index:1}
.orb1{width:280px;height:280px;background:radial-gradient(circle, rgba(20,184,166,0.18), transparent 70%); animation:floatOrb 7s ease-in-out infinite}
.orb2{width:360px;height:360px;background:radial-gradient(circle, rgba(204,251,241,0.55), transparent 70%); animation:floatOrb 9s ease-in-out infinite reverse}
@keyframes floatOrb{0%,100%{transform:translateY(0) scale(1)}50%{transform:translateY(-32px) scale(1.08)}}
.reveal{opacity:0; transform:translateY(32px); transition:all .9s cubic-bezier(0.4,0,0.2,1)}
.reveal.active{opacity:1; transform:translateY(0)}
.shimmer{position:relative; overflow:hidden}
.shimmer::before{content:''; position:absolute; top:0; left:-100%; width:60%; height:100%; background:linear-gradient(90deg, transparent, rgba(255,255,255,0.65), transparent); animation:shimmer 3s infinite; pointer-events:none}
@keyframes shimmer{0%{left:-100%}100%{left:200%}}
.badge-mint{background:var(--mint);color:var(--teal);border-radius:30px;padding:9px 18px;font-weight:800;animation:pulseBadge 2s infinite}
@keyframes pulseBadge{0%,100%{transform:scale(1)}50%{transform:scale(1.05)}}
@keyframes popUp{from{opacity:0; transform:translateY(30px) scale(0.95)}to{opacity:1; transform:translateY(0) scale(1)}}
</style>

<!-- ORNAMEN -->
<div class="float-orb orb1" style="top:2%; left:-80px"></div>
<div class="float-orb orb2" style="top:40%; right:-100px"></div>
<div style="position:absolute; inset:0; background-image:radial-gradient(#ccfbf1 1.3px, transparent 1.3px); background-size:22px 22px; opacity:0.32; pointer-events:none"></div>

<div class="container position-relative" style="z-index:5">
    
    <!-- HEADER SELARAS HOME image_15c707.png -->
    <div class="text-center mb-5 reveal">
        <span class="badge-mint mb-3"><i class="fas fa-heartbeat mr-2"></i> PROFIL UKS DIGITAL</span>
        <h1 class="section-title" style="font-size:44px"><i class="fas fa-heartbeat mr-2" style="color:var(--teal)"></i>Tentang UKS Digital</h1>
        <p class="text-muted small font-weight-bold mb-1">SMKN 1 Karang Baru — Sistem Rekam Medis Berbasis Database Relasional • Aceh Tamiang</p>
        <p class="small" style="color:var(--teal); font-weight:700">Laporan Mandiri: Zulaika Fatarani - NIS 0103786196 - XI RPL 2 • 7 Entitas ERD FIX • Gedung C Lt.1</p>
        <div class="mt-3">
          <span class="badge px-3 py-2 mr-2" style="background:white;border:1px solid #ccfbf1;color:var(--teal);border-radius:20px"><i class="fas fa-database mr-1"></i> MySQL 7 Entitas</span>
          <span class="badge px-3 py-2 mr-2" style="background:var(--dark);color:#5eead4;border-radius:20px"><i class="fas fa-code mr-1"></i> PHP Native + Bootstrap 4</span>
          <span class="badge px-3 py-2" style="background:white;border:1px solid #ccfbf1;color:var(--teal);border-radius:20px"><i class="fas fa-shield-alt mr-1"></i> Role Admin Petugas Anggota</span>
        </div>
    </div>

    <!-- TRANSFORMASI + 4 FITUR - SELARAS STATISTIK HOME image_95ca22.png -->
    <div class="row align-items-stretch mb-5">
        <div class="col-lg-6 mb-4 reveal">
            <div class="uk-card h-100 p-4 p-lg-5">
                <div class="icon-box mb-4 shimmer"><i class="fas fa-notes-medical" style="font-size:22px"></i></div>
                <h3 class="section-title mb-3">Transformasi Medis Sekolah</h3>
                <p class="text-muted small" style="line-height:1.9">
                    UKS Digital adalah platform manajemen kesehatan berbasis web untuk memodernisasi pencatatan rekam medis di SMKN 1 Karang Baru dari manual buku ke digital real-time. Dibangun sesuai <b>ERD 7 entitas</b> di laporan halaman 2 - sudah FIX semua relasi <code>ON DELETE SET NULL</code> & <code>CASCADE</code>.
                </p>
                <div class="mt-4 p-3 position-relative" style="background:var(--mint2);border-radius:14px;border-left:4px solid var(--teal); overflow:hidden">
                  <div style="position:absolute; width:120px; height:120px; background:radial-gradient(circle, rgba(20,184,166,0.12), transparent 70%); top:-30px; right:-30px; pointer-events:none"></div>
                  <small class="text-dark position-relative" style="line-height:1.8;font-family:monospace; z-index:2"><b>Alur ERD FIX:</b><br>Pasien <b>siswa(guru)</b> → <b>barang</b> kategori → <b>penanganan</b> keluhan & tindakan → <b>detailpenanganan</b> potong stok <code>jumlahkeluar</code> → Laporan PDF harian/bulanan/tahunan</small>
                </div>
                <div class="mt-4 d-flex">
                  <a href="index.php?halaman=cekriwayat" class="btn rounded-pill px-4 font-weight-bold mr-2 text-white shimmer" style="background:var(--teal); position:relative; z-index:20; pointer-events:auto">Cek Riwayat <i class="fas fa-arrow-right ml-1"></i></a>
                  <a href="index.php?halaman=kontak" class="btn rounded-pill px-4 font-weight-bold" style="background:white;border:1px solid #ccfbf1;color:var(--teal); position:relative; z-index:20; pointer-events:auto">Hubungi PMR</a>
                </div>
            </div>
        </div>
        <div class="col-lg-6 reveal" style="transition-delay:.12s">
            <div class="row">
                <div class="col-6 mb-4"><div class="uk-card h-100 text-center p-4 shimmer"><div class="icon-box mint mx-auto mb-3" style="width:52px;height:52px"><i class="fas fa-user-injured"></i></div><h6 class="font-weight-bold" style="color:var(--dark)">Data Pasien</h6><small class="text-muted" style="font-size:12px; line-height:1.5">Siswa <code>nis, nohp</code> & Guru <code>nip, nohp</code> terstruktur + riwayat</small><span class="badge mt-2 px-2 py-1" style="background:var(--mint2);color:var(--teal);border-radius:20px;font-size:10px">2 Entitas Pasien</span></div></div>
                <div class="col-6 mb-4"><div class="uk-card h-100 text-center p-4 shimmer" style="transition-delay:.05s"><div class="icon-box mint mx-auto mb-3" style="width:52px;height:52px"><i class="fas fa-boxes"></i></div><h6 class="font-weight-bold" style="color:var(--dark)">Lemari Obat</h6><small class="text-muted" style="font-size:12px; line-height:1.5">Stok <code>barang.stok, satuan, tanggalkadaluarsa, foto</code> per kategori</small><span class="badge mt-2 px-2 py-1" style="background:var(--mint2);color:var(--teal);border-radius:20px;font-size:10px">Ready Stock</span></div></div>
                <div class="col-6 mb-4"><div class="uk-card h-100 text-center p-4 shimmer" style="transition-delay:.1s"><div class="icon-box mint mx-auto mb-3" style="width:52px;height:52px"><i class="fas fa-hand-holding-medical"></i></div><h6 class="font-weight-bold" style="color:var(--dark)">Penanganan</h6><small class="text-muted" style="font-size:12px; line-height:1.5"><code>keluhan, tindakan, statuspasien</code> + rujuk RS</small><span class="badge mt-2 px-2 py-1" style="background:#fef9c3;color:#a16207;border-radius:20px;font-size:10px">Live Hari Ini</span></div></div>
                <div class="col-6 mb-4"><div class="uk-card h-100 text-center p-4 shimmer" style="transition-delay:.15s"><div class="icon-box mint mx-auto mb-3" style="width:52px;height:52px"><i class="fas fa-file-invoice"></i></div><h6 class="font-weight-bold" style="color:var(--dark)">Rekap Laporan</h6><small class="text-muted" style="font-size:12px; line-height:1.5">Harian, bulanan, tahunan PDF 1 klik + grafik tren</small><span class="badge mt-2 px-2 py-1" style="background:var(--mint2);color:var(--teal);border-radius:20px;font-size:10px">PDF Export</span></div></div>
            </div>
        </div>
    </div>

    <!-- VISI MISI + STRUKTUR -->
    <div class="row mb-5">
        <div class="col-lg-6 mb-4 reveal">
            <div class="uk-card h-100 p-4">
                <h5 class="font-weight-bold mb-3" style="color:var(--dark)"><i class="fas fa-bullseye mr-2" style="color:var(--teal)"></i>Visi & Misi</h5>
                <p class="small"><strong style="color:var(--dark)">Visi:</strong> <span class="text-muted">Mewujudkan warga sekolah sehat & bugar via digitalisasi rekam medis UKS Digital yang terintegrasi.</span></p>
                <hr style="border-color:#e0f2f1">
                <p class="small font-weight-bold mb-3" style="color:var(--dark)"><i class="fas fa-tasks mr-1" style="color:var(--teal2)"></i> Misi Operasional:</p>
                <div class="small text-muted" style="line-height:1.9">
                  <div class="d-flex mb-3"><div style="width:28px;height:28px;border-radius:8px;background:var(--mint);color:var(--teal);display:flex;align-items:center;justify-content:center;flex-shrink:0" class="mr-2"><i class="fas fa-check" style="font-size:12px"></i></div><span>Registrasi pakai <code>nis/nip + nohp</code> sebagai kunci verifikasi ganda di <code>cekriwayat.php</code> - tanpa login</span></div>
                  <div class="d-flex mb-3"><div style="width:28px;height:28px;border-radius:8px;background:var(--mint);color:var(--teal);display:flex;align-items:center;justify-content:center;flex-shrink:0" class="mr-2"><i class="fas fa-check" style="font-size:12px"></i></div><span>Kelola logistik obat darurat <code>barang.stok</code> per <code>kategori.namakategori</code> + alert H-30 expired animasi getar glow</span></div>
                  <div class="d-flex"><div style="width:28px;height:28px;border-radius:8px;background:var(--mint);color:var(--teal);display:flex;align-items:center;justify-content:center;flex-shrink:0" class="mr-2"><i class="fas fa-check" style="font-size:12px"></i></div><span>Transparansi riwayat medis mandiri + laporan PDF harian/bulanan/tahunan</span></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4 reveal" style="transition-delay:.12s">
            <div class="uk-card h-100 p-4 text-white" style="background:linear-gradient(135deg,var(--dark),var(--teal));border:none">
                <h5 class="font-weight-bold mb-3"><i class="fas fa-sitemap mr-2" style="color:#5eead4"></i>Struktur Pengurus & Hak Akses</h5>
                <div class="p-3 position-relative" style="background:rgba(255,255,255,0.08);border-radius:14px; border:1px solid rgba(255,255,255,0.12); overflow:hidden">
                  <div style="position:absolute; width:160px; height:160px; background:radial-gradient(circle, rgba(45,212,191,0.18), transparent 70%); top:-40px; right:-40px; pointer-events:none"></div>
<pre class="text-white small mb-0 p-0 bg-transparent border-0 position-relative" style="font-family:'Courier New';line-height:1.9; z-index:2">Pembina UKS (Buk Ely - admin)
├── Ketua PMR (Petugas Piket - petugas)
│   ├── Sie Obat & Alkes (kategori, barang)
│   ├── Sie Penanganan (penanganan, detail)
│   └── Sie Laporan (PDF harian/bulanan)
└── Anggota PMR (anggota)
    └── Piket Harian & cek stok kritis</pre>
                </div>
                <small class="d-block mt-3" style="color:#99f6e0; line-height:1.6">Role dibatasi via <code style="background:rgba(0,0,0,0.2);color:#ccfbf1;padding:2px 6px;border-radius:6px">batasi_akses_role(['admin','petugas','anggota'])</code> di <code style="background:rgba(0,0,0,0.2);color:#ccfbf1;padding:2px 6px;border-radius:6px">proses/session.php</code> + session NIS/NIP</small>
                <div class="mt-3 d-flex"><span class="badge px-3 py-1 mr-2" style="background:rgba(255,255,255,0.15);color:white;border-radius:20px">admin: full akses</span><span class="badge px-3 py-1" style="background:rgba(255,255,255,0.15);color:white;border-radius:20px">petugas/anggota: terbatas</span></div>
            </div>
        </div>
    </div>

    <!-- 7 ENTITAS -->
    <div class="uk-card p-4 mb-4 reveal">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h5 class="font-weight-bold mb-0" style="color:var(--dark)"><i class="fas fa-database mr-2" style="color:var(--teal)"></i>7 Entitas Inti (Sesuai ERD Laporan Hal.2 - SUDAH FIX)</h5>
          <span class="badge-mint"><i class="fas fa-check-circle mr-1"></i> SUDAH FIX SEMUA</span>
        </div>
        <div class="row small">
            <div class="col-md-3 mb-3"><div class="p-3 h-100 uk-card" style="background:var(--mint2);border:1px solid #ccfbf1; box-shadow:none"><span class="badge px-3 py-2 mb-2 text-white" style="background:var(--teal);border-radius:20px">1. user</span><p class="text-muted mb-0" style="font-size:12px;line-height:1.7">Otentikasi & Role<br><code>iduser, username, password, role (admin/petugas/anggota), nohp, foto</code><br><small class="text-success">✔ Hash password + foto profil</small></p></div></div>
            <div class="col-md-3 mb-3"><div class="p-3 h-100 uk-card" style="background:#f0f9ff;border:1px solid #bae6fd; box-shadow:none"><span class="badge px-3 py-2 mb-2" style="background:#0284c7;color:white;border-radius:20px">2. siswa & 3. guru</span><p class="text-muted mb-0" style="font-size:12px;line-height:1.7">Pasien Utama (FIX nis/nip + nohp)<br><code>nis, namasiswa, kelas, alamat, nohp, riwayatpenyakit, riwayatalergi</code><br><code>nip, namaguru, nohp, jabatan</code><br><small class="text-success">✔ Verifikasi ganda cekriwayat.php</small></p></div></div>
            <div class="col-md-3 mb-3"><div class="p-3 h-100 uk-card" style="background:#fefce8;border:1px solid #fef08a; box-shadow:none"><span class="badge px-3 py-2 mb-2" style="background:#eab308;color:#713f12;border-radius:20px">4. kategori & 5. barang</span><p class="text-muted mb-0" style="font-size:12px;line-height:1.7">Logistik (FIX stok satuan)<br><code>idkategori, namakategori</code><br><code>idbarang, namabarang, stok, satuan, tanggalkadaluarsa, foto, tanggalmasuk</code><br><small class="text-success">✔ Alert H-30 + Ready Stock</small></p></div></div>
            <div class="col-md-3 mb-3"><div class="p-3 h-100 uk-card" style="background:#fef2f2;border:1px solid #fecaca; box-shadow:none"><span class="badge px-3 py-2 mb-2 text-white" style="background:#dc2626;border-radius:20px">6. penanganan & 7. detail</span><p class="text-muted mb-0" style="font-size:12px;line-height:1.7">Transaksi (FIX potong stok)<br><code>idpenanganan, tanggalpenanganan, keluhan, tindakan, statuspasien (sembuh/rujuk), idsiswa/idguru</code><br><code>iddetail, idbarang, jumlahkeluar</code><br><small class="text-success">✔ Trigger potong stok otomatis</small></p></div></div>
        </div>
        <div class="mt-3 p-3 text-center" style="background:var(--dark);border-radius:14px;color:white"><small style="color:#5eead4"><i class="fas fa-lightbulb mr-1" style="color:#facc15"></i> <b>Relasi FIX Laporan:</b> <code style="color:#ccfbf1">siswa/guru 1-N penanganan 1-N detailpenanganan N-1 barang N-1 kategori</code> + <code style="color:#ccfbf1">user 1-N penanganan</code> • ON DELETE SET NULL & CASCADE sudah sesuai ERD Hal.2</small></div>
    </div>

    <!-- CTA AKHIR - SELARAS PASOKAN TERBARU -->
    <div class="uk-card p-4 p-lg-5 text-center reveal shimmer" style="background:linear-gradient(180deg, white, var(--mint2))">
        <div class="row justify-content-center">
            <div class="col-md-4 mb-4 mb-md-0"><div class="icon-box mint mx-auto mb-3"><i class="fas fa-check-circle"></i></div><h6 class="font-weight-bold" style="color:var(--dark)">Akses Mudah</h6><p class="text-muted small mb-0" style="line-height:1.6">Cek riwayat via NIS/NIP + No HP tanpa login. Data terenkripsi & validasi ganda.</p><span class="badge mt-2 px-2 py-1" style="background:var(--mint);color:var(--teal);border-radius:20px;font-size:10px">Tanpa Login</span></div>
            <div class="col-md-4 mb-4 mb-md-0"><div class="icon-box mint mx-auto mb-3"><i class="fas fa-shield-alt"></i></div><h6 class="font-weight-bold" style="color:var(--dark)">Terpercaya & FIX</h6><p class="text-muted small mb-0" style="line-height:1.6">Relasi foreign key <code>ON DELETE SET NULL</code> & <code>CASCADE</code> sesuai laporan Hal.2. Sudah diuji dosen.</p><span class="badge mt-2 px-2 py-1" style="background:#dcfce7;color:var(--teal);border-radius:20px;font-size:10px">ERD Valid</span></div>
            <div class="col-md-4"><div class="icon-box mint mx-auto mb-3"><i class="fas fa-print"></i></div><h6 class="font-weight-bold" style="color:var(--dark)">Siap Cetak PDF</h6><p class="text-muted small mb-0" style="line-height:1.6">Laporan harian/bulanan/tahunan + grafik tren keluhan 30 hari + rekap stok kritis.</p><span class="badge mt-2 px-2 py-1" style="background:var(--mint);color:var(--teal);border-radius:20px;font-size:10px">1 Klik Export</span></div>
        </div>
        <div class="mt-5">
            <a href="index.php?halaman=cekriwayat" class="btn rounded-pill px-5 font-weight-bold mr-2 text-white shadow-lg shimmer" style="background:linear-gradient(90deg,var(--teal),var(--teal2));padding:12px 28px; position:relative; z-index:20; pointer-events:auto"><i class="fas fa-search mr-2"></i> Coba Cek Riwayat</a>
            <a href="index.php?halaman=daftarobat" class="btn rounded-pill px-5 font-weight-bold" style="background:white;border:1px solid #ccfbf1;color:var(--teal);padding:12px 28px; position:relative; z-index:20; pointer-events:auto"><i class="fas fa-pills mr-1"></i> Lihat Stok Obat</a>
        </div>
        <div class="mt-4"><small class="text-muted">© 2026 UKS Digital SMKN 1 Karang Baru - Zulaika Fatarani XI RPL 2 • Dibangun dengan 7 Entitas ERD FIX • Aceh Tamiang 24476</small></div>
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