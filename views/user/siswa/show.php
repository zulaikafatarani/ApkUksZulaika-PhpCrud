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
                <h1 class="m-0 font-weight-bold text-success"><i class="fas fa-file-medical mr-2"></i>Kartu Rekam Medis Murid</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="index.php?halaman=siswa" class="btn btn-outline-secondary font-weight-bold btn-sm rounded-pill px-3">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-success card-outline shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="card-title font-weight-bold mb-0 text-success"><i class="fas fa-address-card mr-1"></i> Biodata Pasien</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered mb-0">
                            <tr>
                                <th style="width: 30%;" class="bg-light">NISN / NIS</th>
                                <td class="font-weight-bold text-secondary"><?= htmlspecialchars($data['nisn']); ?></td>
                            </tr>
                            <tr>
                                <th class="bg-light">Nama Pasien</th>
                                <td class="font-weight-bold text-dark"><?= htmlspecialchars($data['namasiswa']); ?></td>
                            </tr>
                            <tr>
                                <th class="bg-light">Kelas</th>
                                <td><?= htmlspecialchars($data['kelas']); ?></td>
                            </tr>
                            <tr>
                                <th class="bg-light">Jenis Kelamin</th>
                                <td><?= $data['jk'] === 'L' ? 'Laki-Laki' : 'Perempuan'; ?></td>
                            </tr>
                            <tr>
                                <th class="bg-light">No HP Orang Tua</th>
                                <td><?= htmlspecialchars($data['hp_ortu']); ?></td>
                            </tr>
                            <tr>
                                <th class="bg-light text-danger"><i class="fas fa-exclamation-triangle mr-1"></i> Kerentanan Alergi</th>
                                <td class="font-weight-bold text-danger"><?= htmlspecialchars($data['alergi']); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
