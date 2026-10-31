<?php
// views/pasien/ubahpassword.php - LENGKAP
if(!isset($_SESSION['pasien'])){ header("Location: index.php?halaman=loginpasien"); exit(); }
?>
<div class="dash">
  <div class="content-header"><div class="container-fluid"><div class="row mb-2 align-items-center">
    <div class="col-sm-7"><h1 class="m-0 font-weight-bold" style="color:var(--dark)"><i class="fas fa-lock mr-2" style="color:var(--teal)"></i> Ubah Password Saya</h1><small class="text-muted">Ganti password kamu sendiri, admin tidak bisa melihat password baru kamu.</small></div>
    <div class="col-sm-5 text-right"><a href="index.php?halaman=dashboardpasien" class="btn-toska"><i class="fas fa-arrow-left mr-1"></i> Kembali</a></div>
  </div></div></div>
  <div class="content"><div class="container-fluid"><div class="row justify-content-center"><div class="col-md-6"><div class="uk-card-bar p-4">
    <?php if(isset($_GET['error'])): ?><div class="alert alert-danger">Password lama salah!</div><?php endif; ?>
    <form action="proses/prosespasien.php?aksi=ubahpassword" method="POST">
      <div class="form-group"><label class="font-weight-bold">Password Lama</label><input type="password" name="lama" class="form-control" placeholder="Password yang sekarang" required></div>
      <div class="form-group"><label class="font-weight-bold">Password Baru</label><input type="password" name="baru" class="form-control" placeholder="Password baru, minimal 6 karakter" required></div>
      <button type="submit" class="btn-toska w-100 justify-content-center"><i class="fas fa-save mr-1"></i> Simpan Password Baru</button>
    </form>
  </div></div></div></div></div>
</div>