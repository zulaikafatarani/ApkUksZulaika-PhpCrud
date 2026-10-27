<?php
if (isset($_SESSION['iduser']) && isset($_SESSION['role'])) { header("Location: index.php?halaman=dashboard".$_SESSION['role']); exit(); }
$pesan = $_GET['pesan'] ?? '';
?>
<section class="py-5 position-relative d-flex align-items-center login-rapi" style="background:#f8fafc; min-height:85vh; overflow:hidden">
<style>
:root{ --teal:#0f766e; --teal2:#14b8a6; --mint:#ccfbf1; --mint2:#f0fdfa; --dark:#064e3b; --radius:20px; }
.login-rapi .uk-card{border-radius:20px; border:1px solid #e0f2f1; background:white; box-shadow:0 18px 60px rgba(15,118,110,0.12); transition:all .55s; position:relative; z-index:5; overflow:visible}
.login-rapi .uk-card::after{content:''; position:absolute; top:0; left:-100%; width:100%; height:100%; background:linear-gradient(90deg, transparent, rgba(204,251,241,0.5), transparent); transition:0s; pointer-events:none; z-index:3}
.login-rapi .uk-card:hover::after{left:100%; transition:0.9s}
.login-rapi .uk-card:hover{transform:translateY(-6px) scale(1.01); box-shadow:0 28px 80px rgba(15,118,110,0.18); border-color:var(--teal2)}
.login-rapi .icon-box{width:72px;height:72px;border-radius:18px;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,var(--teal),var(--teal2));color:white; margin:0 auto; transition:all .6s}
.login-rapi .uk-card:hover .icon-box{transform:rotateY(180deg) scale(1.12)}
.login-rapi .form-control{border-radius:14px;border:1px solid #ccfbf1;padding:12px 18px; transition:all .3s}
.login-rapi .form-control:focus{border-color:var(--teal2);box-shadow:0 0 0 4px var(--mint2); transform:translateY(-1px)}
.login-rapi .float-orb{position:absolute; border-radius:50%; pointer-events:none !important; z-index:1}
.login-rapi .orb1{width:380px;height:380px;background:radial-gradient(circle, rgba(20,184,166,0.18), transparent 70%); animation:floatOrb 7s ease-in-out infinite}
.login-rapi .orb2{width:320px;height:320px;background:radial-gradient(circle, rgba(204,251,241,0.6), transparent 70%); animation:floatOrb 9s ease-in-out infinite reverse}
.login-rapi .orb3{width:200px;height:200px;background:radial-gradient(circle, rgba(45,212,191,0.16), transparent 70%); animation:floatOrb 6s ease-in-out infinite; animation-delay:1s}
@keyframes floatOrb{0%,100%{transform:translateY(0) scale(1)}50%{transform:translateY(-30px) scale(1.08)}}
/* FIX LURUS TENGAH: reveal di login langsung muncul, gak nunggu scroll */
.login-rapi .reveal{opacity:1 !important; transform:translateY(0) !important}
.login-rapi .badge-mint{background:var(--mint);color:var(--teal);border-radius:30px;padding:9px 18px;font-weight:800;animation:pulseBadge 2s infinite}
@keyframes pulseBadge{0%,100%{transform:scale(1)}50%{transform:scale(1.05)}}
.login-rapi .shimmer{position:relative; overflow:hidden}
.login-rapi .shimmer::before{content:''; position:absolute; top:0; left:-100%; width:60%; height:100%; background:linear-gradient(90deg, transparent, rgba(255,255,255,0.7), transparent); animation:shimmer 3s infinite; pointer-events:none; z-index:4}
@keyframes shimmer{0%{left:-100%}100%{left:200%}}
.login-rapi .dots-grid{position:absolute; inset:0; background-image:radial-gradient(#ccfbf1 1.4px, transparent 1.4px); background-size:22px 22px; opacity:0.32; pointer-events:none}
@keyframes dotsMove{0%{background-position:0 0}100%{background-position:44px 44px}}
@keyframes popUp{from{opacity:0; transform:translateY(20px) scale(0.95)}to{opacity:1; transform:translateY(0) scale(1)}}
.login-rapi .container{max-width:1140px; margin:0 auto}
.login-rapi .row{margin-left:0; margin-right:0}
</style>
<div class="float-orb orb1" style="top:5%; left:-80px"></div>
<div class="float-orb orb2" style="bottom:5%; right:-80px"></div>
<div class="float-orb orb3" style="top:45%; left:40%"></div>
<div class="dots-grid"></div>
<div class="container position-relative" style="z-index:5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="text-center mb-4 reveal">
                <span class="badge-mint mb-3"><i class="fas fa-user-shield mr-2"></i> ZONA PENGURUS TERPUSAT</span>
                <h4 class="font-weight-bold" style="color:var(--dark)">Login Pengurus UKS</h4>
                <p class="text-muted small">UKS Digital SMKN 1 Karang Baru &bull; ERD user role admin/petugas/anggota</p>
            </div>
            <div class="uk-card p-4 p-lg-5 reveal" style="animation-delay:.1s">
                <div class="float-orb" style="width:120px;height:120px;top:-20px;right:-20px;opacity:0.15;background:radial-gradient(circle, var(--teal2), transparent 70%); pointer-events:none"></div>
                <div class="text-center mb-4 position-relative" style="z-index:2">
                    <div class="icon-box shimmer mb-3" style="width:80px;height:80px;border-radius:20px; box-shadow:0 8px 25px rgba(15,118,110,0.2)"><i class="fas fa-user-shield fa-2x"></i></div>
                    <h4 class="font-weight-bold mb-1" style="color:var(--dark)">Login Pengurus UKS</h4>
                    <p class="text-muted mb-0 small">UKS Digital SMKN 1 Karang Baru &bull; Gedung C Lt.1</p>
                    <div class="mt-2"><span class="badge px-3 py-1" style="background:var(--mint2);color:var(--teal);border-radius:20px; font-size:11px"><i class="fas fa-lock mr-1"></i> Aman &bull; Session 1 jam &bull; batasi_akses_role()</span></div>
                </div>
                <?php if ($pesan === 'gagal'): ?><div class="alert small py-3 position-relative" style="background:linear-gradient(90deg,#fee2e2,#fecaca);color:#991b1b;border-radius:14px;border:1px solid #fecaca; animation:popUp .6s both; z-index:2" role="alert"><i class="fas fa-exclamation-triangle mr-2"></i> <strong>Login Gagal!</strong> Kredensial akun tidak ditemukan di <code>user.username</code> &bull; Cek lagi 0103786196</div>
                <?php elseif ($pesan === 'timeout'): ?><div class="alert small py-3 position-relative" style="background:linear-gradient(90deg,#fef9c3,#fde68a);color:#854d0e;border-radius:14px;border:1px solid #fde68a; animation:popUp .6s both; z-index:2" role="alert"><i class="fas fa-clock mr-2"></i> <strong>Sesi Berakhir!</strong> Waktu tunggu habis karena 1 jam pasif - Silakan login ulang</div>
                <?php elseif ($pesan === 'belum_login' || $pesan === 'akses_ditolak'): ?><div class="alert small py-3 position-relative" style="background:linear-gradient(90deg,#fee2e2,#fecaca);color:#991b1b;border-radius:14px;border:1px solid #fecaca; animation:popUp .6s both; z-index:2" role="alert"><i class="fas fa-ban mr-2"></i> <strong>Akses Ditolak!</strong> Silakan login untuk membuka menu <code>dashboardadmin / dashboardpetugas</code></div><?php endif; ?>
                <form action="proses/prosesloginuser.php" method="POST" class="position-relative" style="z-index:2">
                    <div class="form-group mb-3"><label class="mb-2 small font-weight-bold" style="color:var(--dark)"><i class="fas fa-user mr-1" style="color:var(--teal)"></i> Username Pengurus</label><div class="input-group" style="border-radius:14px; overflow:hidden; border:1px solid #ccfbf1; transition:.3s"><div class="input-group-prepend"><span class="input-group-text" style="background:var(--mint2);border:none;color:var(--teal)"><i class="fas fa-user"></i></span></div><input type="text" name="username" class="form-control" style="border:none" placeholder="admin / petugas / anggota" required autofocus></div></div>
                    <div class="form-group mb-4"><label class="mb-2 small font-weight-bold" style="color:var(--dark)"><i class="fas fa-lock mr-1" style="color:var(--teal)"></i> Password Sandi Rahasia</label><div class="input-group" style="border-radius:14px; overflow:hidden; border:1px solid #ccfbf1; transition:.3s"><div class="input-group-prepend"><span class="input-group-text" style="background:var(--mint2);border:none;color:var(--teal)"><i class="fas fa-lock"></i></span></div><input type="password" name="password" id="passwordUser" class="form-control" style="border:none" placeholder="Masukkan password sandi" required><div class="input-group-append"><button type="button" class="btn" id="togglePasswordUser" title="Tampilkan password" style="background:white;border:none;color:var(--teal); position:relative; z-index:20; pointer-events:auto"><i class="fas fa-eye"></i></button></div></div><small class="text-muted mt-2 d-block" style="font-size:11px"><i class="fas fa-lightbulb mr-1" style="color:#a16207"></i> Role: admin full, petugas penanganan, anggota lihat &bull; Data dari <code>user.role</code></small></div>
                    <button type="submit" name="login" class="btn btn-block rounded-pill font-weight-bold text-white shadow-lg shimmer" style="background:linear-gradient(90deg,var(--teal),var(--teal2));padding:14px; position:relative; z-index:20; pointer-events:auto; cursor:pointer"><i class="fas fa-sign-in-alt mr-2"></i> MASUK KE SISTEM UKS DIGITAL</button>
                </form>
                <div class="text-center mt-4 position-relative" style="z-index:2"><div class="uk-card d-inline-flex p-1 mb-3" style="border-radius:30px; background:var(--mint2); border:1px dashed var(--teal2); box-shadow:none"><a href="index.php?halaman=home" class="btn rounded-pill px-4 font-weight-bold" style="background:white;border:1px solid #ccfbf1;color:var(--teal); font-size:13px; position:relative; z-index:20; pointer-events:auto"><i class="fas fa-home mr-1"></i> Beranda</a><a href="index.php?halaman=cekriwayat" class="btn rounded-pill px-4 font-weight-bold ml-2" style="background:var(--teal);color:white; font-size:13px; position:relative; z-index:20; pointer-events:auto"><i class="fas fa-search mr-1"></i> Cek Riwayat 0103786196</a></div><br><a href="index.php?halaman=home" class="text-muted small font-weight-bold" style="text-decoration:none !important; position:relative; z-index:20; pointer-events:auto"><i class="fas fa-arrow-left mr-1"></i> Kembali ke Beranda Utama &bull; Portal Publik Tanpa Login</a><p class="small text-muted mt-3" style="font-size:11px"><i class="fas fa-magic mr-1" style="color:var(--teal2)"></i> Login ini sudah menari dengan 12 ornamen: float-orb, dots-grid, shimmer, reveal, pulseBadge, rotateY, popUp &bull; 100% bisa dipencet fix &bull; 0103786196 XI RPL 2</p></div>
            </div>
            <div class="row mt-4 reveal" style="animation-delay:.2s"><div class="col-4"><div class="uk-card p-3 text-center" style="box-shadow:none; background:var(--mint2); border:1px dashed #99f6e0"><i class="fas fa-crown mb-2" style="color:#a16207"></i><br><small class="font-weight-bold" style="color:var(--dark)">Admin</small><br><small style="font-size:10px" class="text-muted">Full akses user</small></div></div><div class="col-4"><div class="uk-card p-3 text-center" style="box-shadow:none; background:white"><i class="fas fa-user-tag mb-2" style="color:#0369a1"></i><br><small class="font-weight-bold" style="color:var(--dark)">Petugas</small><br><small style="font-size:10px" class="text-muted">Penanganan obat</small></div></div><div class="col-4"><div class="uk-card p-3 text-center" style="box-shadow:none; background:white"><i class="fas fa-eye mb-2" style="color:var(--teal)"></i><br><small class="font-weight-bold" style="color:var(--dark)">Anggota</small><br><small style="font-size:10px" class="text-muted">Lihat stok</small></div></div></div>
        </div>
    </div>
</div>
</section>
<script>
document.addEventListener("DOMContentLoaded", function(){
  document.querySelectorAll('.login-rapi .reveal').forEach(el=>el.classList.add('active'));
  const btn=document.getElementById('togglePasswordUser');
  if(btn){ btn.addEventListener('click', function(){ const p=document.getElementById('passwordUser'); const ic=this.querySelector('i'); if(p.type==='password'){p.type='text'; ic.classList.replace('fa-eye','fa-eye-slash');}else{p.type='password'; ic.classList.replace('fa-eye-slash','fa-eye');} }); }
});
</script>
