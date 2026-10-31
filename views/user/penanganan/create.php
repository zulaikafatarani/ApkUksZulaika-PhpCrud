<?php
// views/user/penanganan/create.php - FINAL - SCAN PASTI JALAN
batasi_akses_role(['admin','petugas','anggota']);
$siswa = mysqli_query($koneksi, "SELECT * FROM siswa ORDER BY namasiswa ASC");
$guru = mysqli_query($koneksi, "SELECT * FROM guru ORDER BY namaguru ASC");
$barangList = mysqli_query($koneksi, "SELECT * FROM barang WHERE stok>0 ORDER BY namabarang ASC");
?>
<div class="dash">
  <div class="content-header"><div class="container-fluid"><div class="row mb-2 align-items-center"><div class="col-sm-7"><h1 class="m-0 font-weight-bold" style="color:var(--dark)"><i class="fas fa-plus-circle mr-2" style="color:var(--teal)"></i> Input Penanganan Pasien</h1><small class="text-muted">UKS Digital - <b style="color:var(--teal)">Tangani Pasien Baru</b> | <span class="badge-mint">SCAN QR • AUTO POTONG STOK</span></small></div><div class="col-sm-5 text-right"><a href="index.php?halaman=penanganan" class="btn-toska"><i class="fas fa-arrow-left mr-1"></i> Kembali</a></div></div></div></div>
  <div class="content"><div class="container-fluid">
    <div class="uk-card-pen p-4 mb-3">
      <div class="form-group mb-0">
        <label class="font-weight-bold"><i class="fas fa-qrcode mr-1" style="color:var(--teal)"></i> Scan Kartu Pasien</label><br>
        <div class="d-flex flex-wrap gap-2">
          <button type="button" class="btn-toska" onclick="startScan()"><i class="fas fa-qrcode mr-1"></i> Scan QR Kartu UKS</button>
          <button type="button" class="btn-outline-bar ml-2" onclick="stopScan()" style="display:none" id="btnStop"><i class="fas fa-stop mr-1"></i> Stop Kamera</button>
          <label class="btn-outline-bar ml-2 mb-0" style="cursor:pointer"><i class="fas fa-upload mr-1"></i> Upload Foto QR <input type="file" id="qrFile" accept="image/*" style="display:none" onchange="scanFile(this)"></label>
        </div>
        <div id="reader" class="scan-box" style="display:none; margin-top:12px; width:100%"></div>
        <small class="text-muted d-block mt-2">Tips: Cetak kartu agak besar, arahkan QR pas di tengah kotak. Kalau kamera laptop susah, pakai Upload Foto QR (foto QR dari HP).</small>
        <div id="infoPasien" class="mt-3" style="display:none"><div class="alert" style="background:var(--mint2); border:1px solid #99f6e0; border-radius:12px"><b id="namaScan"></b> • <span id="kelasScan"></span> • Goldar: <b id="goldarScan"></b><br><small id="riwayatScan"></small><br><small class="text-success">✓ NIS <b id="nisScan"></b> berhasil terbaca!</small></div></div>
      </div>
    </div>
    <form action="proses/prosespenanganan.php?aksi=tambah" method="POST"><div class="row">
      <div class="col-md-5"><div class="uk-card-pen"><div class="header-pen"><span class="font-weight-bold" style="color:var(--dark)">1. Identitas Pasien</span><span class="badge-mint">Siswa / Guru</span></div><div class="p-4">
        <div class="form-group"><label class="font-weight-bold">Pilih Siswa</label><select id="selectSiswa" name="idsiswa" class="form-control"><option value="">-- Pilih Siswa --</option><?php while($s=mysqli_fetch_assoc($siswa)): ?><option value="<?= $s['idsiswa'] ?>" data-nis="<?= $s['nis'] ?>"><?= $s['nis'] ?> - <?= $s['namasiswa'] ?> (<?= $s['kelas'] ?>)</option><?php endwhile; ?></select></div>
        <div class="form-group"><label class="font-weight-bold">Atau Pilih Guru</label><select id="selectGuru" name="idguru" class="form-control"><option value="">-- Bukan Guru --</option><?php while($g=mysqli_fetch_assoc($guru)): ?><option value="<?= $g['idguru'] ?>" data-nis="<?= $g['nip'] ?>"><?= $g['nip'] ?> - <?= $g['namaguru'] ?></option><?php endwhile; ?></select><small class="text-muted">Isi salah satu saja! Bisa juga ketik NIS manual kalau scan gagal.</small></div>
        <div class="form-group"><label class="font-weight-bold">Atau Ketik NIS Manual</label><input type="text" id="inputNisManual" class="form-control" placeholder="Contoh: 0103786196" onkeyup="cariManual(this.value)"><small class="text-muted">Kalau kamera susah, ketik NIS di sini, nama otomatis muncul.</small></div><hr>
        <div class="form-group"><label class="font-weight-bold">Tanggal Penanganan</label><input type="date" name="tanggalpenanganan" class="form-control" value="<?= date('Y-m-d') ?>" required></div>
        <div class="form-group"><label class="font-weight-bold">Keluhan Pasien</label><textarea name="keluhan" class="form-control" rows="2" placeholder="Contoh: Demam, pusing, mual" required></textarea></div>
        <div class="form-group"><label class="font-weight-bold">Tindakan UKS</label><textarea name="tindakan" class="form-control" rows="2" placeholder="Contoh: Istirahat, kompres, diberi obat" required></textarea></div>
        <div class="form-group"><label class="font-weight-bold">Status Akhir</label><select name="statuspasien" class="form-control" required><option value="istirahat">Istirahat di UKS</option><option value="sembuh">Sembuh - Kembali Kelas</option><option value="rujuk">Rujuk ke Puskesmas/RS</option></select></div>
      </div></div></div>
      <div class="col-md-7"><div class="uk-card-pen"><div class="header-pen"><span class="font-weight-bold" style="color:var(--dark)">2. Obat / Alkes (Auto Potong Stok)</span><button type="button" id="btnTambah" class="btn-toska" style="padding:6px 16px; font-size:12px"><i class="fas fa-plus"></i> Tambah Baris</button></div><div class="p-4">
        <div id="wrapperObat"><div class="row mb-2 item-obat"><div class="col-7"><select name="idbarang[]" class="form-control"><option value="">-- Tidak Pakai Obat --</option><?php mysqli_data_seek($barangList,0); while($b=mysqli_fetch_assoc($barangList)): ?><option value="<?= $b['idbarang'] ?>"><?= htmlspecialchars($b['namabarang']) ?> (Sisa: <?= $b['stok'] ?> <?= $b['satuan'] ?>)</option><?php endwhile; ?></select></div><div class="col-3"><input type="number" name="jumlahkeluar[]" class="form-control" min="1" value="1"></div><div class="col-2"><button type="button" class="btn btn-danger btn-sm btnHapus w-100" style="border-radius:50%"><i class="fas fa-trash"></i></button></div></div></div>
      </div><div class="p-3 text-right" style="border-top:1px solid #e0f2f1;background:var(--mint2)"><a href="index.php?halaman=penanganan" class="btn btn-secondary" style="border-radius:30px; padding:8px 20px">Batal</a> <button type="submit" class="btn-toska"><i class="fas fa-save mr-1"></i> Simpan Penanganan</button></div></div></div>
    </div></form>
  </div></div>
</div>

<script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
<script>
let html5QrCode;
let isScanning = false;

function startScan(){
  if(isScanning) return;
  document.getElementById('reader').style.display='block';
  document.getElementById('reader').innerHTML='';
  document.getElementById('btnStop').style.display='inline-flex';
  html5QrCode = new Html5Qrcode("reader");
  isScanning = true;
  html5QrCode.start(
    { facingMode: "environment" },
    { fps: 10, qrbox: function(viewfinderWidth, viewfinderHeight){ return {width: Math.floor(viewfinderWidth*0.7), height: Math.floor(viewfinderWidth*0.7)}; } },
    (decodedText) => {
      console.log("Scan berhasil:", decodedText);
      handleScan(decodedText);
      stopScan();
    },
    (errorMessage) => {}
  ).catch(err=>{ 
    // Kalau environment gagal, coba kamera depan
    html5QrCode.start({ facingMode: "user" }, { fps: 10, qrbox: 250 },
      (txt)=>{ handleScan(txt); stopScan(); }, ()=>{}
    ).catch(e=>{ alert("Kamera tidak bisa diakses: "+e+"\nCoba pakai Upload Foto QR atau ketik NIS manual."); document.getElementById('reader').style.display='none'; isScanning=false; });
  });
}

function stopScan(){
  if(html5QrCode && isScanning){
    html5QrCode.stop().then(()=>{ document.getElementById('reader').style.display='none'; document.getElementById('btnStop').style.display='none'; isScanning=false; }).catch(()=>{ isScanning=false; });
  } else {
    document.getElementById('reader').style.display='none'; document.getElementById('btnStop').style.display='none'; isScanning=false;
  }
}

function handleScan(nis){
  nis = nis.trim();
  document.getElementById('inputNisManual').value = nis;
  let selS = document.getElementById('selectSiswa');
  let selG = document.getElementById('selectGuru');
  let found = false;
  [...selS.options].forEach(o=>{ if(o.dataset.nis==nis){ selS.value=o.value; found=true; } });
  if(!found){ [...selG.options].forEach(o=>{ if(o.dataset.nis==nis){ selG.value=o.value; found=true; } }); }
  fetch('proses/prosespasien.php?aksi=cari&nis='+encodeURIComponent(nis))
    .then(r=>r.json()).then(d=>{
      if(d && d.nama){
        document.getElementById('infoPasien').style.display='block';
        document.getElementById('namaScan').innerText=d.nama;
        document.getElementById('kelasScan').innerText=d.kelas||'-';
        document.getElementById('goldarScan').innerText=d.goldar||'-';
        document.getElementById('riwayatScan').innerText=d.riwayat ? 'Riwayat: '+d.riwayat : '';
        document.getElementById('nisScan').innerText=nis;
      } else { alert("NIS "+nis+" tidak ditemukan di data siswa/guru!"); }
    });
}

function scanFile(input){
  if(input.files.length==0) return;
  const file = input.files[0];
  if(!html5QrCode) html5QrCode = new Html5Qrcode("reader");
  html5QrCode.scanFile(file, true).then(decodedText=>{ handleScan(decodedText); }).catch(err=>{ alert("QR tidak terbaca dari foto: "+err+"\nCoba foto lebih dekat & jelas."); });
}

function cariManual(nis){
  if(nis.length<4) return;
  handleScan(nis);
}

document.getElementById('btnTambah').addEventListener('click', function(){
  let f=document.querySelector('.item-obat'); let c=f.cloneNode(true);
  c.querySelectorAll('input').forEach(i=>i.value=1); c.querySelector('select').selectedIndex=0;
  document.getElementById('wrapperObat').appendChild(c);
});
document.addEventListener('click', function(e){
  if(e.target.closest('.btnHapus')){
    let all=document.querySelectorAll('.item-obat');    if(all.length>1) e.target.closest('.item-obat').remove();
  }
});
</script>