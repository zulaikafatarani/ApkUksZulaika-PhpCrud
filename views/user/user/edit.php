<?php
// 1. Kunci halaman: Pastikan hanya Admin yang boleh mengakses halaman edit akun ini
batasi_akses_role(['admin']);

// 2. Tangkap ID user yang ingin diubah dari parameter URL
$iduser = $_GET['id'] ?? '';

// 3. Tarik data lama dari database berdasarkan ID tersebut untuk ditampilkan di form
$queryCek = mysqli_query($koneksi, "SELECT * FROM user WHERE iduser = '" . mysqli_real_escape_string($koneksi, $iduser) . "'");

// Jika ID tidak ditemukan atau tidak valid, tendang balik ke halaman utama user
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
                    <i class="fas fa-user-edit mr-2"></i>Ubah Akun Pengurus
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

<!-- Konten Utama Formulir Edit -->
<div class="content">
    <div class="container-fluid">
        <div class="card card-success card-outline shadow-sm">
            <!-- Form diarahkan ke prosesuser.php dengan parameter aksi ubah -->
            <form action="proses/prosesuser.php?aksi=ubah" method="POST" enctype="multipart/form-data">
                
                <!-- Input Hidden untuk mengirimkan ID User ke SQL -->
                <input type="hidden" name="iduser" value="<?= $data['iduser']; ?>">

                <div class="card-body">
                    <div class="row">
                        
                        <!-- Kolom Kiri: Input Biodata -->
                        <div class="col-md-8">
                            <div class="form-group mb-3">
                                <label class="font-weight-bold text-dark"><i class="fas fa-id-card text-success mr-1"></i> Nama Lengkap Pengurus</label>
                                <input type="text" name="namauser" class="form-control" value="<?= htmlspecialchars($data['namauser']); ?>" required autocomplete="off">
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold text-dark"><i class="fas fa-user text-success mr-1"></i> Username Akun</label>
                                <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($data['username']); ?>" required autocomplete="off">
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold text-dark">
                                    <i class="fas fa-key text-success mr-1"></i> Password Akun 
                                    <small class="text-muted font-weight-normal">(Ketik ulang password lama atau masukkan password baru)</small>
                                </label>
                                <input type="password" name="password" class="form-control" value="<?= htmlspecialchars($data['password']); ?>" required>
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold text-dark"><i class="fas fa-user-shield text-success mr-1"></i> Hak Akses Role</label>
                                <select name="role" class="form-control" required>
                                    <option value="admin" <?= ($data['role'] === 'admin') ? 'selected' : ''; ?>>ADMIN (Akses Penuh Manajemen)</option>
                                    <option value="petugas" <?= ($data['role'] === 'petugas') ? 'selected' : ''; ?>>PETUGAS (Pengurus Medis Ruang UKS)</option>
                                    <option value="anggota" <?= ($data['role'] === 'anggota') ? 'selected' : ''; ?>>ANGGOTA (Siswa PMR Piket Harian)</option>
                                </select>
                            </div>
                        </div>

                        <!-- Kolom Kanan: Upload & Update Foto Profil -->
                        <div class="col-md-4 border-left">
                            <div class="form-group text-center">
                                <label class="font-weight-bold text-dark d-block"><i class="fas fa-image text-success mr-1"></i> Foto Profil Saat Ini</label>
                                <div class="mb-3">
                                    <!-- Menampilkan foto lama yang tersimpan di database -->
                                    <img src="assets/images/user/<?= !empty($data['foto']) ? $data['foto'] : 'default.png'; ?>" 
                                         id="previewFoto" class="img-circle img-thumbnail shadow-sm" style="width: 150px; height: 150px; object-fit: cover;" alt="Preview Foto">
                                </div>
                                <div class="custom-file text-left">
                                    <input type="file" name="foto" class="custom-file-input" id="inputFoto" accept="image/jpeg, image/jpg, image/png" onchange="bacaGambar(this);">
                                    <label class="custom-file-label" for="inputFoto">Ganti foto profil...</label>
                                </div>
                                <small class="text-muted d-block mt-2">Biarkan kosong jika tidak ingin mengubah foto profil.</small>
                            </div>
                        </div>

                    </div>
                </div>
                
                <!-- Tombol Aksi Update -->
                <div class="card-footer bg-light text-right">
                    <a href="index.php?halaman=user" class="btn btn-default shadow-sm mr-2 font-weight-bold"><i class="fas fa-times mr-1"></i> Batal</a>
                    <button type="submit" name="update" class="btn btn-success shadow-sm font-weight-bold px-4"><i class="fas fa-save mr-1"></i> Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script Javascript untuk preview foto pengganti secara instant sebelum disimpan -->
<script>
    function bacaGambar(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('previewFoto').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
            
            var nameFile = input.files[0].name;
            var elementLabel = input.nextElementSibling;
            elementLabel.innerHTML = nameFile;
        }
    }
</script>
