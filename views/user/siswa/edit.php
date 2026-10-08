<?php
batasi_akses_role(['admin', 'petugas', 'anggota']);

$idsiswa = $_GET['id'] ?? '';
$query = mysqli_query($koneksi, "SELECT * FROM siswa WHERE idsiswa = '" . mysqli_real_escape_string($koneksi, $idsiswa) . "'");

if (mysqli_num_rows($query) !== 1) {
    header("Location: index.php?halaman=siswa");
    exit();
}
$data = mysqli_fetch_assoc($query);
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 font-weight-bold text-success"><i class="fas fa-user-edit mr-2"></i>Ubah Data Murid</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="index.php?halaman=siswa" class="btn btn-outline-secondary font-weight-bold btn-sm rounded-pill px-3">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card card-success card-outline shadow-sm">
            <form action="proses/prosespasien.php?aksi=ubahsiswa" method="POST">
                <input type="hidden" name="idsiswa" value="<?= $data['idsiswa']; ?>">
                <div class="card-body">
                    <div class="row">
                        
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="font-weight-bold text-dark">NISN / NIS Murid</label>
                                <input type="number" name="nisn" class="form-control" value="<?= htmlspecialchars($data['nisn']); ?>" required>
                            </div>
                            <div class="form-group mb-3">
                                <label class="font-weight-bold text-dark">Nama Lengkap Murid</label>
                                <input type="text" name="namasiswa" class="form-control" value="<?= htmlspecialchars($data['namasiswa']); ?>" required>
                            </div>
                            <div class="form-group mb-3">
                                <label class="font-weight-bold text-dark">Jenis Kelamin</label>
                                <select name="jk" class="form-control" required>
                                    <option value="L" <?= $data['jk'] === 'L' ? 'selected' : ''; ?>>Laki-Laki</option>
                                    <option value="P" <?= $data['jk'] === 'P' ? 'selected' : ''; ?>>Perempuan</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="font-weight-bold text-dark">Kelas & Tingkatan</label>
                                <input type="text" name="kelas" class="form-control" value="<?= htmlspecialchars($data['kelas']); ?>" required>
                            </div>
                            <div class="form-group mb-3">
                                <label class="font-weight-bold text-dark">No HP Orang Tua</label>
                                <input type="number" name="hp_ortu" class="form-control" value="<?= htmlspecialchars($data['hp_ortu']); ?>" required>
                            </div>
                            <div class="form-group mb-3">
                                <label class="font-weight-bold text-dark">Riwayat Alergi Bawaan</label>
                                <textarea name="alergi" class="form-control" rows="2" required><?= htmlspecialchars($data['alergi']); ?></textarea>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card-footer bg-light text-right">
                    <button type="submit" name="update" class="btn btn-success font-weight-bold px-4"><i class="fas fa-save mr-1"></i> Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
