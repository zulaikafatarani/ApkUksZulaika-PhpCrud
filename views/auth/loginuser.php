<?php
// Proteksi ganda: jika pengurus sudah memegang sesi login aktif, langsung lempar ke dashboardnya
if (isset($_SESSION['iduser']) && isset($_SESSION['role'])) {
    header("Location: index.php?halaman=dashboard" . $_SESSION['role']);
    exit();
}

// Menangkap sinyal alert pesan kesalahan dari parameter URL browser
$pesan = $_GET['pesan'] ?? '';
?>

<div class="d-flex justify-content-center py-5">
    <div class="card shadow-sm" style="width:100%;max-width:420px;border:1px solid #7e7e7e;border-radius:10px;">
        <div class="card-body p-4">
            
            <!-- Kepala Panel Login (Nuansa Medis Asri Hijau Sukses) -->
            <div class="text-center mb-4">
                <div class="mb-2">
                    <span class="d-inline-flex align-items-center justify-content-center bg-success text-white rounded-circle" style="width:60px;height:60px;">
                        <i class="fas fa-user-shield fa-2x"></i>
                    </span>
                </div>
                <h4 class="font-weight-bold mb-1">Login Pengurus UKS</h4>
                <p class="text-muted mb-0 small">UKS Digital SMKN 1 Karang Baru</p>
            </div>

            <!-- BLOK KENDALI PEMBERITAHUAN ERROR INTERAKTIF -->
            <?php if ($pesan === 'gagal'): ?>
                <div class="alert alert-danger alert-dismissible fade show small py-2" role="alert">
                    <i class="fas fa-exclamation-triangle mr-1"></i> <strong>Login Gagal!</strong> Kredensial akun tidak ditemukan.
                </div>
            <?php elseif ($pesan === 'timeout'): ?>
                <div class="alert alert-warning alert-dismissible fade show small py-2" role="alert">
                    <i class="fas fa-clock mr-1"></i> <strong>Sesi Berakhir!</strong> Waktu tunggu habis karena 1 jam pasif.
                </div>
            <?php elseif ($pesan === 'belum_login' || $pesan === 'akses_ditolak'): ?>
                <div class="alert alert-danger alert-dismissible fade show small py-2" role="alert">
                    <i class="fas fa-ban mr-1"></i> <strong>Akses Ditolak!</strong> Silakan login untuk membuka menu ini.
                </div>
            <?php endif; ?>

            <!-- Formulir Pengiriman Data Otentikasi (Diarahkan ke berkas login khusus) -->
            <form action="proses/prosesloginuser.php" method="POST">
                
                <!-- Blok Input Kunci Kredensial Username -->
                <div class="form-group mb-3">
                    <label class="mb-1 text-dark small font-weight-bold">
                        <i class="fas fa-user mr-1 text-success"></i> Username
                    </label>
                    <input type="text" name="username" class="form-control" placeholder="Masukkan username pengurus" required autofocus>
                </div>
                
                <!-- Blok Input Sandi Rahasia + Modul Fitur Intuitif Pengintip Mata Guru -->
                <div class="form-group mb-4">
                    <label class="mb-1 text-dark small font-weight-bold">
                        <i class="fas fa-lock mr-1 text-success"></i> Password
                    </label>
                    <div class="input-group">
                        <input type="password" name="password" id="passwordUser" class="form-control" placeholder="Masukkan password sandi" required>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-outline-secondary" id="togglePasswordUser" title="Tampilkan password">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Tombol Konfirmasi Validasi Data -->
                <button type="submit" name="login" class="btn btn-success btn-block font-weight-bold text-white shadow-sm">
                    <i class="fas fa-sign-in-alt mr-1"></i> MASUK KE SISTEM
                </button>
            </form>
            
            <!-- Akses Jalur Pintas Kembali ke Antarmuka Publik -->
            <div class="text-center mt-4">
                <a href="index.php?halaman=home" class="text-muted small font-weight-bold">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali ke Beranda Utama
                </a>
            </div>

        </div>
    </div>
</div>

<!-- Mengadopsi Penuh Script Aksi Interaktif Tombol Mata Guru -->
<script>
    document.getElementById('togglePasswordUser').addEventListener('click', function() {
        const password = document.getElementById('passwordUser');
        const icon = this.querySelector('i');
        if (password.type === 'password') {
            password.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
            this.title = 'Sembunyikan password';
        } else {
            password.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
            this.title = 'Tampilkan password';
        }
    });
</script>
