<?php
batasi_akses_role(['admin', 'petugas', 'anggota']);
?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 font-weight-bold text-success"><i class="fas fa-user-plus mr-2"></i>Registrasi Pasien Terpadu</h1>
                <small class="text-muted">Siswa & Guru dalam 1 form (Sesuai ERD Laporan)</small>
            </div>
            <div class="col-sm-6 text-right">
                <a href="index.php?halaman=siswa" class="btn btn-outline-secondary btn-sm rounded-pill px-3"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
            </div>
        </div>
    </div>
</div>

<div class="content">
<div class="container-fluid">
<div class="card card-success card-outline shadow-sm">
    <div class="card-header bg-light">
        <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <label class="btn btn-success active" id="btnSiswa">
                <input type="radio" name="pilih_jenis" value="siswa" checked> <i class="fas fa-user-graduate mr-1"></i> Siswa
            </label>
            <label class="btn btn-outline-success" id="btnGuru">
                <input type="radio" name="pilih_jenis" value="guru"> <i class="fas fa-chalkboard-teacher mr-1"></i> Guru
            </label>
        </div>
    </div>

    <form id="formPasien" action="proses/prosespasien.php?aksi=tambah&jenis=siswa" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="jenis" id="inputJenis" value="siswa">
        <div class="card-body">
            <div class="row">
                <!-- KOLOM KIRI -->
                <div class="col-md-6">
                    <div class="form-group" id="field_nis">
                        <label class="font-weight-bold"><i class="fas fa-id-card text-success mr-1"></i> NIS Siswa</label>
                        <input type="text" name="nis" class="form-control" placeholder="Contoh: 0103786196">
                    </div>
                    <div class="form-group d-none" id="field_nip">
                        <label class="font-weight-bold"><i class="fas fa-id-badge text-success mr-1"></i> NIP Guru</label>
                        <input type="text" name="nip" class="form-control" placeholder="Contoh: 02331222233">
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold"><i class="fas fa-user text-success mr-1"></i> Nama Lengkap</label>
                        <input type="text" name="namasiswa" id="namaSiswa" class="form-control" placeholder="Nama siswa..." required>
                        <input type="text" name="namaguru" id="namaGuru" class="form-control d-none" placeholder="Nama guru..." required disabled>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold"><i class="fas fa-venus-mars text-success mr-1"></i> Jenis Kelamin</label>
                        <select name="jeniskelamin" class="form-control" required>
                            <option value="L">Laki-laki</option>
                            <option value="P" selected>Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group" id="field_kelas">
                        <label class="font-weight-bold"><i class="fas fa-school text-success mr-1"></i> Kelas</label>
                        <input type="text" name="kelas" class="form-control" placeholder="XII RPL 2">
                    </div>

                    <div class="form-group d-none" id="field_goldar">
                        <label class="font-weight-bold"><i class="fas fa-tint text-danger mr-1"></i> Gol Darah</label>
                        <select name="golongandarah" class="form-control">
                            <option value="Tidak Tahu" selected>Tidak Tahu</option><option value="A">A</option><option value="B">B</option><option value="AB">AB</option><option value="O">O</option>
                        </select>
                    </div>
                </div>

                <!-- KOLOM KANAN -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold"><i class="fas fa-phone text-success mr-1"></i> No HP Rahasia (Untuk Verifikasi Cek Riwayat)</label>
                        <input type="text" name="nohp" class="form-control" placeholder="+62 812-6938-9167" required>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold"><i class="fas fa-map-marker-alt text-success mr-1"></i> Alamat</label>
                        <input type="text" name="alamat" class="form-control" placeholder="Medang Ara, Karang Baru..." required>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold"><i class="fas fa-notes-medical text-success mr-1"></i> Riwayat Penyakit</label>
                        <input type="text" name="riwayatpenyakit" class="form-control" placeholder="Contoh: Tipes, Lambung, -">
                    </div>

                    <div class="form-group" id="field_alergi">
                        <label class="font-weight-bold"><i class="fas fa-exclamation-triangle text-danger mr-1"></i> Riwayat Alergi</label>
                        <textarea name="riwayatalergi" class="form-control" rows="2" placeholder="Alergi Paracetamol, Seafood, dll (isi - jika tidak ada)"></textarea>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold"><i class="fas fa-camera text-success mr-1"></i> Foto Pasien</label>
                        <input type="file" name="foto" class="form-control-file" accept="image/*">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer bg-light text-right">
            <button type="reset" class="btn btn-default"><i class="fas fa-undo mr-1"></i> Reset</button>
            <button type="submit" class="btn btn-success font-weight-bold px-4"><i class="fas fa-save mr-1"></i> Simpan Pasien</button>
        </div>
    </form>
</div>
</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const btnSiswa = document.getElementById('btnSiswa');
    const btnGuru = document.getElementById('btnGuru');
    const form = document.getElementById('formPasien');
    const inputJenis = document.getElementById('inputJenis');
    
    function setMode(jenis){
        inputJenis.value = jenis;
        form.action = "proses/prosespasien.php?aksi=tambah&jenis="+jenis;
        if(jenis === 'siswa'){
            document.getElementById('field_nis').classList.remove('d-none');
            document.getElementById('field_nip').classList.add('d-none');
            document.getElementById('field_kelas').classList.remove('d-none');
            document.getElementById('field_alergi').classList.remove('d-none');
            document.getElementById('field_goldar').classList.remove('d-none');
            document.getElementById('namaSiswa').classList.remove('d-none');
            document.getElementById('namaSiswa').disabled = false;
            document.getElementById('namaGuru').classList.add('d-none');
            document.getElementById('namaGuru').disabled = true;
            btnSiswa.classList.add('btn-success'); btnSiswa.classList.remove('btn-outline-success');
            btnGuru.classList.add('btn-outline-success'); btnGuru.classList.remove('btn-success');
        } else {
            document.getElementById('field_nis').classList.add('d-none');
            document.getElementById('field_nip').classList.remove('d-none');
            document.getElementById('field_kelas').classList.add('d-none');
            document.getElementById('field_alergi').classList.add('d-none');
            document.getElementById('field_goldar').classList.add('d-none');
            document.getElementById('namaSiswa').classList.add('d-none');
            document.getElementById('namaSiswa').disabled = true;
            document.getElementById('namaGuru').classList.remove('d-none');
            document.getElementById('namaGuru').disabled = false;
            btnGuru.classList.add('btn-success'); btnGuru.classList.remove('btn-outline-success');
            btnSiswa.classList.add('btn-outline-success'); btnSiswa.classList.remove('btn-success');
        }
    }
    document.querySelectorAll('input[name="pilih_jenis"]').forEach(el=>{
        el.addEventListener('change', (e)=> setMode(e.target.value));
    });
});
</script>