<?php
// 1. Kunci halaman: Pastikan hanya Admin yang boleh mengakses menu manajemen akun ini
batasi_akses_role(['admin']);

// 2. Tarik seluruh data akun pengurus dari database MySQL
$queryUser = mysqli_query($koneksi, "SELECT * FROM user ORDER BY iduser DESC");

// Tangkap status notifikasi sukses/gagal dari parameter URL jika ada aksi CRUD
$status = $_GET['status'] ?? '';
?>

<!-- Kepala Halaman (Content Header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 font-weight-bold text-success">
                    <i class="fas fa-users-cog mr-2"></i>Kelola Akun Sistem
                </h1>
            </div>
            <div class="col-sm-6 text-right">
                <!-- Tombol Tambah Pengurus Baru -->
                <a href="index.php?halaman=createuser" class="btn btn-success font-weight-bold shadow-sm rounded-pill px-3">
                    <i class="fas fa-user-plus mr-1"></i> Tambah Pengurus
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Konten Utama Tabel Data -->
<div class="content">
    <div class="container-fluid">

        <!-- BLOK NOTIFIKASI INFORMASI AKSI CRUD INTERAKTIF -->
        <?php if ($status === 'sukses_tambah'): ?>
            <div class="alert alert-success alert-dismissible fade show small py-2 shadow-sm" role="alert">
                <i class="fas fa-check-circle mr-1"></i> <strong>Berhasil!</strong> Akun pengurus baru telah sukses didaftarkan.
            </div>
        <?php elseif ($status === 'sukses_ubah'): ?>
            <div class="alert alert-info alert-dismissible fade show small py-2 shadow-sm" role="alert">
                <i class="fas fa-info-circle mr-1"></i> <strong>Berhasil!</strong> Perubahan data akun telah berhasil disimpan.
            </div>
        <?php elseif ($status === 'sukses_hapus'): ?>
            <div class="alert alert-warning alert-dismissible fade show small py-2 shadow-sm" role="alert">
                <i class="fas fa-trash-alt mr-1"></i> <strong>Berhasil!</strong> Akun pengurus telah dihapus dari sistem.
            </div>
        <?php elseif ($status === 'gagal'): ?>
            <div class="alert alert-danger alert-dismissible fade show small py-2 shadow-sm" role="alert">
                <i class="fas fa-times-circle mr-1"></i> <strong>Gagal!</strong> Terjadi kesalahan operasional pada query database.
            </div>
        <?php endif; ?>

        <!-- Kartu Tabel AdminLTE -->
        <div class="card card-success card-outline shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="bg-success text-white">
                            <tr>
                                <th style="width: 80px;" class="text-center">No</th>
                                <th style="width: 100px;" class="text-center">Foto</th>
                                <th>Nama Lengkap</th>
                                <th>Username</th>
                                <th style="width: 180px;" class="text-center">Hak Akses Role</th>
                                <th style="width: 200px;" class="text-center">Aksi Operasional</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            if (mysqli_num_rows($queryUser) > 0) :
                                while ($row = mysqli_fetch_assoc($queryUser)) : 
                            ?>
                                <tr class="align-middle">
                                    <td class="text-center font-weight-bold text-muted"><?= $no++; ?></td>
                                    <td class="text-center">
                                        <!-- Menampilkan foto profil pengurus, jika kosong gunakan default.png -->
                                        <img src="assets/images/user/<?= !empty($row['foto']) ? $row['foto'] : 'default.png'; ?>" 
                                             class="img-circle border" 
                                             style="width: 45px; height: 45px; object-fit: cover;" 
                                             alt="Foto Profil">
                                    </td>
                                    <td class="font-weight-bold text-dark"><?= htmlspecialchars($row['namauser']); ?></td>
                                    <td class="text-secondary">@<?= htmlspecialchars($row['username']); ?></td>
                                    <td class="text-center">
                                        <!-- Pewarnaan badge penanda hak akses agar interaktif saat diuji -->
                                        <?php if ($row['role'] === 'admin'): ?>
                                            <span class="badge badge-danger text-uppercase px-3 py-1"><i class="fas fa-user-shield mr-1"></i>Admin</span>
                                        <?php elseif ($row['role'] === 'petugas'): ?>
                                            <span class="badge badge-info text-uppercase px-3 py-1"><i class="fas fa-user-md mr-1"></i>Petugas</span>
                                        <?php else: ?>
                                            <span class="badge badge-warning text-dark text-uppercase px-3 py-1"><i class="fas fa-user-friends mr-1"></i>Anggota</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <!-- Tombol Edit Data -->
                                        <a href="index.php?halaman=edituser&id=<?= $row['iduser']; ?>" class="btn btn-info btn-sm shadow-sm" title="Edit Akun">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <!-- Tombol Hapus Data dengan konfirmasi Javascript anti-salah klik -->
                                        <a href="proses/prosesuser.php?aksi=hapus&id=<?= $row['iduser']; ?>" 
                                           class="btn btn-danger btn-sm shadow-sm" 
                                           title="Hapus Akun" 
                                           onclick="return confirm('Apakah Anda benar-benar yakin ingin menghapus akun pengurus <?= htmlspecialchars($row['namauser']); ?> ini?');">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php 
                                endwhile; 
                            else: 
                            ?>
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted font-italic">
                                        <i class="fas fa-folder-open mr-1"></i> Belum ada data akun pengurus yang tersimpan di database.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
