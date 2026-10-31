<?php
// views/pasien/loginpasien.php - FINAL - Halaman Publik, Bukan Pengurus
if(isset($_SESSION['pasien'])){ header("Location: index.php?halaman=dashboardpasien"); exit(); }
?>
<div class="dash" style="min-height:70vh; display:flex; align-items:center">
  <div class="content w-100"><div class="container-fluid"><div class="row justify-content-center">
    <div class="col-md-5"><div class="uk-card-bar p-4 text-center" style="animation:popUpBar .7s both">
      <div style="font-size:48px; color:var(--teal); animation:floatBar 3s ease-in-out infinite"><i class="fas fa-user-lock"></i></div>
      <h4 class="font-weight-bold" style="color:var(--dark)">Login Pasien UKS</h4>
      <span class="badge-mint">SISWA & GURU • BUKAN PETUGAS</span>
      <p class="text-muted mt-2">Lihat riwayat medis <b style="color:var(--teal)">kamu sendiri</b> - data aman, tidak bisa diintip orang lain.</p>
      <?php if(isset($_GET['error'])): ?><div class="alert alert-danger">NIS/NIP / Password salah!</div><?php endif; ?>
      <form action="proses/prosespasien.php?aksi=loginpasien" method="POST" class="text-left">
        <div class="form-group"><label class="font-weight-bold">Saya Adalah</label><select name="jenis" class="form-control" required><option value="siswa">Siswa - Pakai NIS</option><option value="guru">Guru - Pakai NIP</option></select></div>
        <div class="form-group"><label class="font-weight-bold">NIS / NIP</label><input type="text" name="id" class="form-control" placeholder="Contoh: 0103786196" required></div>
        <div class="form-group"><label class="font-weight-bold">Password</label><input type="password" name="password" class="form-control" placeholder="Password awal = NIS/NIP kamu" required></div>
        <button type="submit" class="btn-toska w-100 justify-content-center"><i class="fas fa-sign-in-alt mr-1"></i> Masuk Sebagai Pasien</button>
      </form>
      <small class="text-muted d-block mt-3">Lupa password? Hubungi petugas UKS / Buk Ely untuk reset.<br>Password awal adalah NIS/NIP kamu.<br><a href="index.php?halaman=home" style="color:var(--teal)">← Kembali ke Beranda</a></small>
    </div></div>
  </div></div></div>
</div>