<?php
// Pastikan hanya Admin yang boleh mengakses halaman input akun baru ini
batasi_akses_role(['admin']);
?>

<!-- Kepala Halaman (Content Header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 font-weight-bold text-success">
                    <i class="fas fa-user-plus mr-2"></i>Tambah Akun Pengurus
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

<!-- Konten Utama Formulir Input -->
<div class="content">
    <div class="container-fluid">
        <div class="card card-success card-outline shadow-sm">
            <!-- Form menggunakan enctype="multipart/form-data" karena ada proses upload file foto -->
            <form action="proses/prosesuser.php?aksi=tambah" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row">
                        
                        <!-- Kolom Kiri: Input Biodata -->
                        <div class="col-md-8">
                            <div class="form-group mb-3">
                                <label class="font-weight-bold text-dark"><i class="fas fa-id-card text-success mr-1"></i> Nama Lengkap Pengurus</label>
                                <input type="text" name="namauser" class="form-control" placeholder="Masukkan nama lengkap beserta gelar..." required autocomplete="off">
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold text-dark"><i class="fas fa-user text-success mr-1"></i> Username Akun</label>
                                <input type="text" name="username" class="form-control" placeholder="Contoh: petugasmedis123 (Tanpa spasi)" required autocomplete="off">
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold text-dark"><i class="fas fa-key text-success mr-1"></i> Password Akun</label>
                                <input type="password" name="password" class="form-control" placeholder="Masukkan password sandi rahasia..." required>
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold text-dark"><i class="fas fa-user-shield text-success mr-1"></i> Hak Akses Role</label>
                                <select name="role" class="form-control customs-select" required>
                                    <option value="" disabled selected>-- Pilih Hak Akses Sistem --</option>
                                    <option value="admin">ADMIN (Akses Penuh Manajemen)</option>
                                    <option value="petugas">PETUGAS (Pengurus Medis Ruang UKS)</option>
                                    <option value="anggota">ANGGOTA (Siswa PMR Piket Harian)</option>
                                </select>
                            </div>
                        </div>

                        <!-- Kolom Kanan: Upload Foto Profil -->
                        <div class="col-md-4 border-left">
                            <div class="form-group text-center">
                                <label class="font-weight-bold text-dark d-block"><i class="fas fa-image text-success mr-1"></i> Foto Profil</label>
                                <div class="mb-3">
                                    <!-- Preview gambar default sebelum di-upload -->
                                    <img src="assets/images/user/default.png" id="previewFoto" class="img-circle img-thumbnail shadow-sm" style="width: 150px; height: 150px; object-fit: cover;" alt="Preview Foto">
                                </div>
                                <div class="custom-file text-left">
                                    <input type="file" name="foto" class="custom-file-input" id="inputFoto" accept="image/jpeg, image/jpg, image/png" onchange="bacaGambar(this);">
                                    <label class="custom-file-label" for="inputFoto">Pilih file foto...</label>
                                </div>
                                <small class="text-muted d-block mt-2">Format: JPG/JPEG/PNG. Maksimal 2MB.</small>
                            </div>
                        </div>

                    </div>
                </div>
                
                <!-- Tombol Aksi Simpan -->
                <div class="card-footer bg-light text-right">
                    <button type="reset" class="btn btn-default shadow-sm mr-2 font-weight-bold"><i class="fas fa-undo mr-1"></i> Reset</button>
                    <button type="submit" name="simpan" class="btn btn-success shadow-sm font-weight-bold px-4"><i class="fas fa-save mr-1"></i> Simpan Data Akun</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script Javascript untuk preview foto secara instant sebelum disimpan -->
<script>
    function bacaGambar(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('previewFoto').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
            
            // Memasukkan nama file ke label custom bootstrap
            var nameFile = input.files[0].name;
            var elementLabel = input.nextElementSibling;
            elementLabel.innerHTML = nameFile;
        }
    }
</script>
