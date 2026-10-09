<?php batasi_akses_role(['admin','petugas','anggota']);
$siswa=mysqli_query($koneksi,"SELECT * FROM siswa ORDER BY namasiswa ASC");
$guru=mysqli_query($koneksi,"SELECT * FROM guru ORDER BY namaguru ASC");
$barangList=mysqli_query($koneksi,"SELECT * FROM barang WHERE stok>0 ORDER BY namabarang ASC");
?>
<div class="content-header"><div class="container-fluid"><h1 class="m-0 text-success font-weight-bold"><i class="fas fa-plus-circle mr-1"></i> Input Penanganan Pasien</h1></div></div>
<div class="content"><div class="container-fluid">
<form action="proses/prosespenanganan.php?aksi=tambah" method="POST">
<div class="row">
<!-- KIRI: PASIEN -->
<div class="col-md-5"><div class="card card-success card-outline shadow-sm"><div class="card-header bg-light font-weight-bold">1. Identitas Pasien</div><div class="card-body">
<div class="form-group"><label>Pilih Siswa (kosongkan jika guru)</label><select name="idsiswa" class="form-control select2"><option value="">-- Bukan Siswa / Pilih Guru di bawah --</option><?php while($s=mysqli_fetch_assoc($siswa)): ?><option value="<?= $s['idsiswa'] ?>"><?= $s['nis'] ?> - <?= $s['namasiswa'] ?> (<?= $s['kelas'] ?>)</option><?php endwhile; ?></select></div>
<div class="form-group"><label>Atau Pilih Guru</label><select name="idguru" class="form-control"><option value="">-- Bukan Guru --</option><?php while($g=mysqli_fetch_assoc($guru)): ?><option value="<?= $g['idguru'] ?>"><?= $g['nip'] ?> - <?= $g['namaguru'] ?></option><?php endwhile; ?></select><small class="text-muted">Isi salah satu saja! Siswa ATAU Guru</small></div>
<hr>
<div class="form-group"><label>Tanggal Penanganan</label><input type="date" name="tanggalpenanganan" class="form-control" value="<?= date('Y-m-d') ?>" required></div>
<div class="form-group"><label>Keluhan Pasien</label><textarea name="keluhan" class="form-control" rows="2" placeholder="Contoh: Demam, pusing, mual" required></textarea></div>
<div class="form-group"><label>Tindakan UKS</label><textarea name="tindakan" class="form-control" rows="2" placeholder="Contoh: Istirahat, kompres, diberi obat" required></textarea></div>
<div class="form-group"><label>Status Akhir</label><select name="statuspasien" class="form-control" required><option value="istirahat">Istirahat di UKS</option><option value="sembuh">Sembuh - Kembali Kelas</option><option value="rujuk">Rujuk ke Puskesmas/RS</option></select></div>
</div></div></div>

<!-- KANAN: OBAT -->
<div class="col-md-7"><div class="card card-success card-outline shadow-sm"><div class="card-header bg-light d-flex justify-content-between align-items-center"><span class="font-weight-bold">2. Obat / Alkes Dipakai (Auto Potong Stok)</span> <button type="button" id="btnTambah" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Tambah Baris</button></div>
<div class="card-body">
<div id="wrapperObat">
<div class="row mb-2 item-obat"><div class="col-7"><select name="idbarang[]" class="form-control" required><option value="">-- Pilih Obat --</option><?php mysqli_data_seek($barangList,0); while($b=mysqli_fetch_assoc($barangList)): ?><option value="<?= $b['idbarang'] ?>"><?= htmlspecialchars($b['namabarang']) ?> (Sisa: <?= $b['stok'] ?> <?= $b['satuan'] ?>)</option><?php endwhile; ?></select></div><div class="col-3"><input type="number" name="jumlahkeluar[]" class="form-control" min="1" value="1" required></div><div class="col-2"><button type="button" class="btn btn-danger btn-sm btnHapus w-100"><i class="fas fa-trash"></i></button></div></div>
</div>
<small class="text-muted d-block mt-2"><i class="fas fa-info-circle"></i> Jika tidak pakai obat, hapus semua baris dengan klik tempat sampah. Kalau diisi, stok di `barang` otomatis berkurang - sesuai ERD detailpenanganan halaman 5 laporan.</small>
</div>
<div class="card-footer bg-light text-right"><a href="index.php?halaman=penanganan" class="btn btn-secondary">Batal</a> <button type="submit" class="btn btn-success font-weight-bold px-4"><i class="fas fa-save"></i> Simpan Penanganan</button></div>
</div></div>
</div>
</form></div></div>

<script>
document.getElementById('btnTambah').addEventListener('click', function(){
    let first = document.querySelector('.item-obat');
    let clone = first.cloneNode(true);
    clone.querySelectorAll('input').forEach(i=>i.value=1);
    clone.querySelector('select').selectedIndex=0;
    document.getElementById('wrapperObat').appendChild(clone);
});
document.addEventListener('click', function(e){
    if(e.target.closest('.btnHapus')){
        let all = document.querySelectorAll('.item-obat');
        if(all.length>1){ e.target.closest('.item-obat').remove(); }
        else { alert('Minimal 1 baris, kosongkan pilihan obat jika tidak pakai obat'); }
    }
});
</script>