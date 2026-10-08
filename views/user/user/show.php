<?php
// 1. Kunci halaman: Pastikan hanya Admin yang boleh mengakses halaman detail akun ini
batasi_akses_role(['admin']);

// 2. Tangkap ID user dari URL browser
$iduser = $_GET['id'] ?? '';

// 3. Tarik data lengkap user dari database MySQL
$queryCek = mysqli_query($koneksi, "SELECT * FROM user WHERE iduser = '" . mysqli_real_escape_string($koneksi, $iduser) . "'");

// Jika ID tidak ditemukan, kembalikan ke halaman daftar utama
if (mysqli_num_rows($queryCek) !== 1) {
    header("Location: index.php?halaman=user");
    exit();
}

$data = mysqli_fetch_assoc($queryCek);
?>

<!-- Kepala Halaman (Content Header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 font-weight-bold text-success">
                    <i class="fas fa-id-card mr-2"></i>Profil Detail Pengurus
                </h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="index.php?halaman=user" class="btn btn-outline-secondary font-weight-bold shadow-sm btn-sm rounded-pill px-3">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Konten Utama Kartu Detail Profil -->
<div class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                
                <!-- Profile Image Card Standard AdminLTE -->
                <div class="card card-success card-outline shadow-sm">
                    <div class="card-body box-profile py-4">
                        <div class="text-center mb-3">
                            <img class="profile-user-img img-fluid img-circle border-success"
                                 src="assets/images/user/<?= !empty($data['foto']) ? $data['foto'] : 'default.png'; ?>"
                                 style="width: 120px; height: 120px; object-fit: cover;"
                                 alt="Foto Pengurus">
                        </div>

                        <h3 class="profile-username text-center font-weight-bold text-dark mb-1"><?= htmlspecialchars($data['namauser']); ?></h3>
                        
                        <p class="text-muted text-center mb-3">@<?= htmlspecialchars($data['username']); ?></p>

                        <ul class="list-group list-group-unbordered mb-4">
                            <li class="list-group-item d-flex justify-content-between align-items-center py-2 px-3 bg-light rounded mb-2">
                                <span class="font-weight-bold text-secondary"><i class="fas fa-key mr-2 text-success"></i>ID Pengurus</span>
                                <span class="badge badge-secondary px-3 py-1 font-weight-bold">#UKS-<?= $data['iduser']; ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center py-2 px-3 bg-light rounded mb-2">
                                <span class="font-weight-bold text-secondary"><i class="fas fa-user-shield mr-2 text-success"></i>Hak Akses Role</span>
                                <?php if ($data['role'] === 'admin'): ?>
                                    <span class="badge badge-danger text-uppercase px-3 py-1 font-weight-bold">Admin Utama</span>
                                <?php elseif ($data['role'] === 'petugas'): ?>
                                    <span class="badge badge-info text-uppercase px-3 py-1 font-weight-bold">Petugas Medis</span>
                                <?php else: ?>
                                    <span class="badge badge-warning text-dark text-uppercase px-3 py-1 font-weight-bold">Anggota PMR</span>
                                <?php endif; ?>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center py-2 px-3 bg-light rounded">
                                <span class="font-weight-bold text-secondary"><i class="fas fa-lock mr-2 text-success"></i>Sandi Enkripsi</span>
                                <span class="text-muted font-italic" style="font-size: 0.9rem;">Dilindungi Sistem Aktif</span>
                            </li>
                        </ul>

                        <div class="d-flex justify-content-between">
                            <a href="index.php?halaman=edituser&id=<?= $data['iduser']; ?>" class="btn btn-info font-weight-bold shadow-sm px-4 btn-block">
                                <i class="fas fa-edit mr-1"></i> Edit Data Akun
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
