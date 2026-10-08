<section class="py-5 bg-light">
<div class="container">
    
    <div class="text-center mb-5">
        <span class="badge badge-success px-3 py-2 mb-3 rounded-pill text-white shadow-sm font-weight-bold">PROFIL UKS DIGITAL</span>
        <h1 class="font-weight-bold text-success"><i class="fas fa-heartbeat mr-2"></i>Tentang UKS Digital</h1>
        <p class="text-muted small font-weight-bold mb-0">SMKN 1 Karang Baru — Sistem Rekam Medis Berbasis Database Relasional</p>
        <p class="text-secondary small font-italic">Laporan Mandiri: Zulaika Fatarani - NISN 0103786196 - XI RPL 2</p>
    </div>

    <div class="row align-items-center mb-5">
        <div class="col-lg-6 mb-4 mb-lg-0">
            <div class="card border-0 shadow-sm h-100" style="border-radius:15px;">
                <div class="card-body p-4 p-lg-5">
                    <h3 class="font-weight-bold mb-3 text-success"><i class="fas fa-notes-medical mr-2"></i>Transformasi Medis Sekolah</h3>
                    <p class="text-muted small" style="line-height:1.7;">
                        UKS Digital adalah platform manajemen kesehatan berbasis web untuk memodernisasi pencatatan rekam medis di SMKN 1 Karang Baru. Dibangun sesuai ERD 7 entitas di laporan halaman 2.
                    </p>
                    <p class="text-muted small mb-0" style="line-height:1.7;">
                        Alur: Pasien <code>siswa/guru</code> didata (NIS/NIP + No HP) → <code>barang</code> dikelompokkan <code>kategori</code> → <code>penanganan</code> dicatat keluhan & tindakan → <code>detailpenanganan</code> potong stok otomatis → Laporan cetak.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="row">
                <div class="col-6 mb-4"><div class="card border-0 shadow-sm h-100 text-center" style="border-radius:10px;"><div class="card-body py-3"><i class="fas fa-user-injured fa-2x text-success mb-2"></i><h6 class="font-weight-bold">Data Pasien</h6><small class="text-muted d-block" style="font-size:0.75rem;">Siswa (nis, nohp) & Guru (nip, nohp) terstruktur.</small></div></div></div>
                <div class="col-6 mb-4"><div class="card border-0 shadow-sm h-100 text-center" style="border-radius:10px;"><div class="card-body py-3"><i class="fas fa-boxes fa-2x text-info mb-2"></i><h6 class="font-weight-bold">Lemari Obat</h6><small class="text-muted d-block" style="font-size:0.75rem;">Stok barang & satuan per kategori.</small></div></div></div>
                <div class="col-6 mb-4 mb-md-0"><div class="card border-0 shadow-sm h-100 text-center" style="border-radius:10px;"><div class="card-body py-3"><i class="fas fa-hand-holding-medical fa-2x text-warning mb-2"></i><h6 class="font-weight-bold">Penanganan</h6><small class="text-muted d-block" style="font-size:0.75rem;">keluhan, tindakan, statuspasien.</small></div></div></div>
                <div class="col-6"><div class="card border-0 shadow-sm h-100 text-center" style="border-radius:10px;"><div class="card-body py-3"><i class="fas fa-file-invoice fa-2x text-danger mb-2"></i><h6 class="font-weight-bold">Rekap Laporan</h6><small class="text-muted d-block" style="font-size:0.75rem;">Harian, bulanan, tahunan.</small></div></div></div>
            </div>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius:15px; overflow:hidden;">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-0"><h5 class="font-weight-bold text-success mb-0"><i class="fas fa-bullseye mr-2"></i>Visi & Misi</h5></div>
                <div class="card-body px-4 pt-3">
                    <p class="small text-dark"><strong>Visi:</strong> Mewujudkan warga sekolah sehat & bugar via digitalisasi rekam medis UKS.</p>
                    <hr class="my-2">
                    <p class="small text-dark font-weight-bold mb-2">Misi Operasional:</p>
                    <ul class="pl-3 small text-muted" style="line-height:1.6;">
                        <li class="mb-1">Registrasi pakai kombinasi <code>nis/nip + nohp</code> sebagai kunci verifikasi ganda di <code>cekriwayat.php</code>.</li>
                        <li class="mb-1">Kelola logistik obat darurat <code>barang.stok</code> per <code>kategori</code>.</li>
                        <li>Transparansi riwayat medis mandiri tanpa login.</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm h-100 bg-success text-white" style="border-radius:15px;">
                <div class="card-body p-4">
                    <h5 class="font-weight-bold mb-3"><i class="fas fa-sitemap mr-2"></i>Struktur Pengurus & Hak Akses</h5>
                    <pre class="text-white small mb-0 p-0 bg-transparent border-0" style="font-family:'Courier New'; line-height:1.7;">Pembina UKS (Buk Ely - admin)
├── Ketua PMR (Petugas Piket - petugas)
│   ├── Sie Obat & Alkes (kelola barang/kategori)
│   ├── Sie Penanganan (input penanganan/detail)
│   └── Sie Laporan (cetak harian/bulanan/tahunan)
└── Anggota PMR (anggota)
    └── Piket Harian & cek stok</pre>
                    <small class="d-block mt-3 opacity-75">Role dibatasi via <code>batasi_akses_role(['admin','petugas','anggota'])</code> di <code>proses/session.php</code></small>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4" style="border-radius:15px;">
        <div class="card-body p-4">
            <h5 class="font-weight-bold text-dark mb-4"><i class="fas fa-database text-success mr-2"></i>7 Entitas Inti (Sesuai ERD Laporan Hal.2 - SUDAH FIX)</h5>
            <div class="row small">
                <div class="col-md-3 mb-3"><div class="p-3 bg-light rounded h-100"><span class="badge badge-success mb-2">1. user</span><p class="text-muted mb-0" style="font-size:0.75rem;">Otentikasi<br><code>iduser, username, role, nohp, foto</code></p></div></div>
                <div class="col-md-3 mb-3"><div class="p-3 bg-light rounded h-100"><span class="badge badge-info mb-2">2. siswa & 3. guru</span><p class="text-muted mb-0" style="font-size:0.75rem;">Pasien Utama (FIX)<br><code>nis, namasiswa, nohp, riwayatpenyakit, riwayatalergi</code><br><code>nip, namaguru, nohp</code></p></div></div>
                <div class="col-md-3 mb-3"><div class="p-3 bg-light rounded h-100"><span class="badge badge-warning text-dark mb-2">4. kategori & 5. barang</span><p class="text-muted mb-0" style="font-size:0.75rem;">Logistik (FIX)<br><code>idkategori, namakategori</code><br><code>idbarang, stok, satuan, tanggalkadaluarsa, foto</code></p></div></div>
                <div class="col-md-3 mb-3"><div class="p-3 bg-light rounded h-100"><span class="badge badge-danger mb-2">6. penanganan & 7. detail</span><p class="text-muted mb-0" style="font-size:0.75rem;">Transaksi (FIX)<br><code>tanggalpenanganan, keluhan, tindakan, statuspasien</code><br><code>jumlahkeluar</code></p></div></div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius:15px;">
        <div class="card-body p-4 p-lg-5 text-center">
            <div class="row justify-content-center">
                <div class="col-md-4 mb-3 mb-md-0"><i class="fas fa-check-circle fa-2x text-success mb-2"></i><h6 class="font-weight-bold">Akses Mudah</h6><p class="text-muted small mb-0">Cek riwayat via NIS/NIP + No HP tanpa login.</p></div>
                <div class="col-md-4 mb-3 mb-md-0"><i class="fas fa-shield-alt fa-2x text-info mb-2"></i><h6 class="font-weight-bold">Terpercaya</h6><p class="text-muted small mb-0">Relasi foreign key <code>ON DELETE SET NULL</code> & <code>CASCADE</code> sesuai laporan.</p></div>
                <div class="col-md-4"><i class="fas fa-print fa-2x text-warning mb-2"></i><h6 class="font-weight-bold">Siap Cetak</h6><p class="text-muted small mb-0">Laporan harian/bulanan/tahunan siap untuk pembina.</p></div>
            </div>
            <div class="mt-4">
                <a href="index.php?halaman=cekriwayat" class="btn btn-success rounded-pill px-4 font-weight-bold mr-2"><i class="fas fa-search mr-1"></i> Coba Cek Riwayat</a>
                <a href="index.php?halaman=daftarobat" class="btn btn-outline-success rounded-pill px-4 font-weight-bold"><i class="fas fa-pills mr-1"></i> Lihat Stok Obat</a>
            </div>
        </div>
    </div>

</div>
</section>