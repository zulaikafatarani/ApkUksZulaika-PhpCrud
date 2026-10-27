<?php
// views/user/penanganan/create.php - FINAL GABUNG UKS.CSS
batasi_akses_role(['admin','petugas','anggota']);
$siswa=mysqli_query($koneksi,"SELECT * FROM siswa ORDER BY namasiswa ASC");
$guru=mysqli_query($koneksi,"SELECT * FROM guru ORDER BY namaguru ASC");
$barangList=mysqli_query($koneksi,"SELECT * FROM barang WHERE stok>0 ORDER BY namabarang ASC");
?>
<div class="dash">
  <div class="content-header"><div class="container-fluid"><div class="row mb-2 align-items-center"><div class="col-sm-7"><h1 class="m-0 font-weight-bold" style="color:var(--dark)"><i class="fas fa-plus-circle mr-2" style="color:var(--teal)"></i> Input Penanganan Pasien</h1><small class="text-muted">UKS Digital - <b style="color:var(--teal)">Tangani Pasien Baru</b> | <span class="badge-mint">AUTO POTONG STOK</span></small></div><div class="col-sm-5 text-right"><a href="index.php?halaman=penanganan" class="btn-toska"><i class="fas fa-arrow-left mr-1"></i> Kembali</a></div></div></div></div>
  <div class="content"><div class="container-fluid">
    <form action="proses/prosespenanganan.php?aksi=tambah" method="POST"><div class="row">
      <div class="col-md-5"><div class="uk-card-pen"><div class="header-pen"><span class="font-weight-bold" style="color:var(--dark)">1. Identitas Pasien</span><span class="badge-mint">Siswa / Guru</span></div><div class="p-4">
        <div class="form-group"><label class="font-weight-bold">Pilih Siswa (kosongkan jika guru)</label><select name="idsiswa" class="form-control select2"><option value="">-- Bukan Siswa / Pilih Guru di bawah --</option><?php while($s=mysqli_fetch_assoc($siswa)): ?><option value="<?= $s['idsiswa'] ?>"><?= $s['nis'] ?> - <?= $s['namasiswa'] ?> (<?= $s['kelas'] ?>)</option><?php endwhile; ?></select></div>
        <div class="form-group"><label class="font-weight-bold">Atau Pilih Guru</label><select name="idguru" class="form-control"><option value="">-- Bukan Guru --</option><?php while($g=mysqli_fetch_assoc($guru)): ?><option value="<?= $g['idguru'] ?>"><?= $g['nip'] ?> - <?= $g['namaguru'] ?></option><?php endwhile; ?></select><small class="text-muted">Isi salah satu saja! Siswa ATAU Guru</small></div><hr>
        <div class="form-group"><label class="font-weight-bold">Tanggal Penanganan</label><input type="date" name="tanggalpenanganan" class="form-control" value="<?= date('Y-m-d') ?>" required></div>
        <div class="form-group"><label class="font-weight-bold">Keluhan Pasien</label><textarea name="keluhan" class="form-control" rows="2" placeholder="Contoh: Demam, pusing, mual" required></textarea></div>
        <div class="form-group"><label class="font-weight-bold">Tindakan UKS</label><textarea name="tindakan" class="form-control" rows="2" placeholder="Contoh: Istirahat, kompres, diberi obat" required></textarea></div>
        <div class="form-group"><label class="font-weight-bold">Status Akhir</label><select name="statuspasien" class="form-control" required><option value="istirahat">Istirahat di UKS</option><option value="sembuh">Sembuh - Kembali Kelas</option><option value="rujuk">Rujuk ke Puskesmas/RS</option></select></div>
      </div></div></div>
      <div class="col-md-7"><div class="uk-card-pen"><div class="header-pen"><span class="font-weight-bold" style="color:var(--dark)">2. Obat / Alkes Dipakai (Auto Potong Stok)</span><button type="button" id="btnTambah" class="btn-toska" style="padding:6px 16px; font-size:12px"><i class="fas fa-plus"></i> Tambah Baris</button></div><div class="p-4">
        <div id="wrapperObat"><div class="row mb-2 item-obat"><div class="col-7"><select name="idbarang[]" class="form-control" required><option value="">-- Pilih Obat --</option><?php mysqli_data_seek($barangList,0); while($b=mysqli_fetch_assoc($barangList)): ?><option value="<?= $b['idbarang'] ?>"><?= htmlspecialchars($b['namabarang']) ?> (Sisa: <?= $b['stok'] ?> <?= $b['satuan'] ?>)</option><?php endwhile; ?></select></div><div class="col-3"><input type="number" name="jumlahkeluar[]" class="form-control" min="1" value="1" required></div><div class="col-2"><button type="button" class="btn btn-danger btn-sm btnHapus w-100" style="border-radius:50%; width:42px; height:42px"><i class="fas fa-trash"></i></button></div></div></div>
        <small class="text-muted d-block mt-2"><i class="fas fa-info-circle"></i> Jika tidak pakai obat, hapus semua baris dengan klik tempat sampah. Kalau diisi, stok di `barang` otomatis berkurang - sesuai ERD detailpenanganan halaman 5 laporan.</small>
      </div>
      <div class="p-3 text-right" style="border-top:1px solid #e0f2f1;background:var(--mint2)"><a href="index.php?halaman=penanganan" class="btn btn-secondary" style="border-radius:30px; padding:8px 20px">Batal</a> <button type="submit" class="btn-toska"><i class="fas fa-save mr-1"></i> Simpan Penanganan</button></div>
      </div></div>
    </div></form>
  </div></div>
</div>
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