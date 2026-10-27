<?php // views/component/user/footer.php - FIX ANTI KETUTUP SIDEBAR V2 ?>
</div> <!-- END content-wrapper -->


<div class="float-orb-footer" style="width:180px;height:180px;top:-40px;left:-40px"></div>
<div class="float-orb-footer" style="width:120px;height:120px;bottom:-20px;right:-30px; animation-delay:2s"></div>

<footer class="main-footer main-footer-user">
<div class="container-fluid px-4 py-4 position-relative" style="z-index:2">
  
  <div class="row mb-4">
    <div class="col-md-4 mb-4">
      <div class="footer-card p-4 h-100 shimmer">
        <div class="d-flex align-items-start">
          <div class="icon-box mr-3"><i class="fas fa-heartbeat"></i></div>
          <div>
            <h6 class="font-weight-bold mb-1" style="color:var(--dark)">UKS DIGITAL</h6>
            <small class="text-muted" style="line-height:1.6">SMKN 1 Karang Baru<br>Gedung C Lt.1 Sebelah Lab RPL<br>Aceh Tamiang • 0103786196<br><span class="badge-mint mt-2 d-inline-block"><i class="fas fa-user mr-1"></i> XI RPL 2 Zulaika</span></small>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="footer-card p-4 h-100">
        <h6 class="font-weight-bold mb-3" style="color:var(--dark)"><i class="fas fa-link mr-2" style="color:var(--teal)"></i>Akses Cepat Publik</h6>
        <div class="d-flex flex-wrap">
          <a href="index.php?halaman=home" class="link-footer"><i class="fas fa-home mr-2"></i> Beranda</a>
          <a href="index.php?halaman=daftarkategori" class="link-footer"><i class="fas fa-boxes mr-2"></i> Kategori Obat</a>
          <a href="index.php?halaman=daftarobat" class="link-footer"><i class="fas fa-pills mr-2"></i> Katalog Obat</a>
          <a href="index.php?halaman=cekriwayat" class="link-footer" style="background:var(--mint); color:var(--teal) !important; font-weight:700"><i class="fas fa-search mr-2"></i> Cek Riwayat 4 Faktor</a>
          <a href="index.php?halaman=kontak" class="link-footer"><i class="fas fa-phone-alt mr-2"></i> Kontak UKS</a>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="footer-card p-4 h-100" style="background:linear-gradient(135deg, var(--dark), var(--teal)); color:white; border-color:var(--teal)">
        <h6 class="font-weight-bold mb-3" style="color:#5eead4"><i class="fas fa-database mr-2"></i>ERD 7 Entitas FIX</h6>
        <small style="color:#a7f3d0; line-height:1.8; font-size:12px">
          <code style="background:rgba(255,255,255,0.15); color:#ccfbf1; padding:2px 6px; border-radius:6px">user</code> <code style="background:rgba(255,255,255,0.15); color:#ccfbf1; padding:2px 6px; border-radius:6px">siswa</code> <code style="background:rgba(255,255,255,0.15); color:#ccfbf1; padding:2px 6px; border-radius:6px">guru</code>
          <code style="background:rgba(255,255,255,0.15); color:#ccfbf1; padding:2px 6px; border-radius:6px">kategori</code> <code style="background:rgba(255,255,255,0.15); color:#ccfbf1; padding:2px 6px; border-radius:6px">barang</code> <code style="background:rgba(255,255,255,0.15); color:#ccfbf1; padding:2px 6px; border-radius:6px">penanganan</code> <code style="background:rgba(255,255,255,0.15); color:#ccfbf1; padding:2px 6px; border-radius:6px">detailpenanganan</code> - Relasi 1-N<br><br>
          <span class="badge px-3 py-2" style="background:var(--mint); color:var(--teal); border-radius:20px"><i class="fas fa-pills mr-1"></i> Antalgin 500mg Stok 149 Tablet #1</span><br>
          <span class="badge px-3 py-2 mt-2" style="background:rgba(94,234,212,0.15); color:#5eead4; border:1px solid rgba(94,234,212,0.25); border-radius:20px">Anti Tutup Sidebar Fix • #0f766e</span>
        </small>
      </div>
    </div>
  </div>

  <div class="footer-card p-3 d-flex flex-column flex-md-row justify-content-between align-items-center" style="background:var(--mint2); border:1px dashed var(--teal2); box-shadow:none">
    <div class="text-center text-md-left mb-2 mb-md-0">
      <small class="font-weight-bold" style="color:var(--dark)"><i class="fas fa-copyright mr-1" style="color:var(--teal)"></i> Copyright &copy; <?= date('Y') ?> <span style="color:var(--teal)">UKS DIGITAL - SMKN 1 Karang Baru</span></small><br>
      <small class="text-muted" style="font-size:11px">Zulaika Fatarani 0103786196 XI RPL 2 • Versi 1.0 PMR UKS • <?= date('d/m/Y H:i') ?> • Anti ketutup sidebar</small>
    </div>
    <div class="text-center text-md-right">
      <span class="badge px-3 py-2" style="background:white; color:var(--teal); border:1px solid #ccfbf1; border-radius:20px; font-size:11px"><i class="fas fa-code mr-1"></i> Version 1.0 | PMR UKS | <?= strtoupper(htmlspecialchars($_SESSION['namauser'] ?? 'BUK ELY')) ?></span>
    </div>
  </div>

</div>
</footer>

</div> <!-- END wrapper -->

<script src="assets/plugins/jquery/jquery.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/adminlte.min.js"></script>
<script>
// FIX ANTI KETUTUP SIDEBAR - AUTO ADJUST MARGIN PAS SIDEBAR TOGGLE
function adjustFooter(){
  const sidebar = document.querySelector('.main-sidebar');
  const footer = document.querySelector('.main-footer-user');
  if(!sidebar || !footer) return;
  const isCollapsed = document.body.classList.contains('sidebar-collapse') || document.body.classList.contains('sidebar-closed') || window.innerWidth < 992;
  const isMini = document.body.classList.contains('sidebar-mini') && document.body.classList.contains('sidebar-collapse');
  if(isCollapsed){
    footer.style.marginLeft = '0px';
    footer.style.width = '100%';
  } else {
    footer.style.marginLeft = '250px';
    footer.style.width = 'calc(100% - 250px)';
  }
}
$(window).on('resize', adjustFooter);
$(document).on('collapsed.lte.pushmenu shown.lte.pushmenu', adjustFooter);
document.addEventListener("DOMContentLoaded", function(){
  adjustFooter();
  setTimeout(adjustFooter, 300);
  const reveals=document.querySelectorAll('.reveal');
  const obs=new IntersectionObserver(entries=>{entries.forEach(e=>{if(e.isIntersecting){e.target.classList.add('active')}})},{threshold:0.12});
  reveals.forEach(r=>obs.observe(r));
});
$(window).scroll(function(){ if($(this).scrollTop()>20){$('.navbar-user').addClass('scrolled')} else {$('.navbar-user').removeClass('scrolled')} });
</script>
</body>
</html>