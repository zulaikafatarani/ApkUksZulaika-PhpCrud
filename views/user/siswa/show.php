<?php
batasi_akses_role(['admin', 'petugas', 'anggota']);
$idsiswa = (int)($_GET['id'] ?? 0);
$query = mysqli_query($koneksi, "SELECT * FROM siswa WHERE idsiswa = $idsiswa");
if (mysqli_num_rows($query) !== 1) {
    header("Location: index.php?halaman=siswa");
    exit();
}
$data = mysqli_fetch_assoc($query);

// FIX FOTO - biar gak putus kayak obat tadi
$base = __DIR__ . '/../../../assets/images/siswa/';
$baseUrl = 'assets/images/siswa/';
$foto = $baseUrl.'default.png';
if(!empty($data['foto']) && file_exists($base.$data['foto'])){
    $foto = $baseUrl.$data['foto'];
}
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"><h1 class="m-0 font-weight-bold text-success"><i class="fas fa-file-medical mr-2"></i>Kartu Rekam Medis Murid</h1></div>
            <div class="col-sm-6 text-right"><a href="index.php?halaman=siswa" class="btn btn-outline-secondary btn-sm rounded-pill px-3"><i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar</a></div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-success card-outline shadow-sm">
                    <div class="card-header bg-light"><h5 class="card-title font-weight-bold mb-0 text-success"><i class="fas fa-address-card mr-1"></i> Biodata Pasien</h5></div>
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <img src="<?= $foto ?>" style="width:120px; height:120px; object-fit:cover; border-radius:50%; border:3px solid #16a34a;" onerror="this.src='assets/images/siswa/default.png'">
                            <h5 class="mt-2 font-weight-bold"><?= htmlspecialchars($data['namasiswa'] ?? '-') ?></h5>
                            <span class="badge badge-success"><?= htmlspecialchars($data['kelas'] ?? '-') ?></span>
                        </div>

                        <table class="table table-bordered mb-0">
                            <tr>
                                <th style="width:30%;" class="bg-light">NISN / NIS</th>
                                <td class="font-weight-bold"><?= htmlspecialchars($data['nis'] ?? $data['nisn'] ?? '-') ?></td>
                            </tr>
                            <tr>
                                <th class="bg-light">Nama Pasien</th>
                                <td class="font-weight-bold text-dark"><?= htmlspecialchars($data['namasiswa'] ?? '-') ?></td>
                            </tr>
                            <tr>
                                <th class="bg-light">Kelas</th>
                                <td><?= htmlspecialchars($data['kelas'] ?? '-') ?></td>
                            </tr>
                            <tr>
                                <th class="bg-light">Jenis Kelamin</th>
                                <td><?= (strtolower($data['jeniskelamin'] ?? $data['jk'] ?? 'p')=='l'||strtolower($data['jeniskelamin'] ?? $data['jk'] ?? 'p')=='laki-laki')?'Laki-Laki':'Perempuan' ?></td>
                            </tr>
                            <tr>
                                <th class="bg-light">Golongan Darah</th>
                                <td><?= htmlspecialchars($data['golongandarah'] ?? '-') ?></td>
                            </tr>
                            <tr>
                                <th class="bg-light">No HP Orang Tua</th>
                                <td><?= htmlspecialchars($data['nohp'] ?? $data['hp_ortu'] ?? '-') ?></td>
                            </tr>
                            <tr>
                                <th class="bg-light">Alamat</th>
                                <td><?= htmlspecialchars($data['alamat'] ?? '-') ?></td>
                            </tr>
                            <tr>
                                <th class="bg-light text-danger"><i class="fas fa-exclamation-triangle mr-1"></i> Riwayat Penyakit</th>
                                <td><?= htmlspecialchars($data['riwayatpenyakit'] ?? $data['penyakit_bawaan'] ?? '-') ?></td>
                            </tr>
                            <tr>
                                <th class="bg-light text-danger"><i class="fas fa-exclamation-triangle mr-1"></i> Kerentanan Alergi</th>
                                <td class="font-weight-bold text-danger"><?= htmlspecialchars($data['riwayatalergi'] ?? $data['alergi'] ?? '-') ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-footer text-right">
                        <a href="index.php?halaman=editsiswa&id=<?= $data['idsiswa'] ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit Data</a>
                        <a href="index.php?halaman=siswa" class="btn btn-secondary btn-sm">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>