<?php // views/component/user/footer.php - RINGKAS TOSKA RESPONSIVE ?>
</div> <!-- END content-wrapper -->

<footer class="main-footer main-footer-user" style="background:rgba(255,255,255,0.96); border-top:1px solid #ccfbf1; margin-left:250px; transition:all .3s; padding:0; position:relative; overflow:hidden">
  <div class="float-orb-footer" style="width:120px;height:120px;top:-30px;left:-20px; position:absolute; pointer-events:none; opacity:0.5"></div>
  
  <div class="d-flex flex-column flex-md-row justify-content-between align-items-center px-4 py-3" style="position:relative; z-index:2">
    <div class="mb-2 mb-md-0 text-center text-md-left">
      <small class="font-weight-bold" style="color:var(--dark)"><i class="fas fa-heartbeat mr-1" style="color:var(--teal)"></i> UKS DIGITAL SMKN 1 Karang Baru</small>
      <small class="text-muted d-block" style="font-size:11px">© <?= date('Y') ?> Zulaika Fatarani 0103786196 XI RPL 2 • ERD 7 Entitas</small>
    </div>
    <div class="text-center text-md-right">
      <span class="badge-mint" style="font-size:11px"><i class="fas fa-code mr-1"></i> v1.0</span>
      <span class="badge" style="background:#f0fdfa; color:var(--teal); border:1px solid #ccfbf1; border-radius:20px; padding:6px 12px; font-size:11px; font-weight:700"><i class="fas fa-user-shield mr-1"></i> <?= strtoupper(htmlspecialchars($_SESSION['role'] ?? 'ADMIN')) ?> • <?= htmlspecialchars($_SESSION['namauser'] ?? 'BUK ELY') ?></span>
    </div>
  </div>
</footer>

</div> <!-- END wrapper -->

<script src="assets/plugins/jquery/jquery.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/adminlte.min.js"></script>
<script>
// FOOTER & HAMBURGER FIX FINAL
function adjustFooter(){
  const footer = document.querySelector('.main-footer-user');
  if(!footer) return;
  if(window.innerWidth < 992 || document.body.classList.contains('sidebar-collapse') || document.body.classList.contains('sidebar-closed')){
    footer.style.marginLeft='0';
    footer.style.width='100%';
  } else {
    footer.style.marginLeft='250px';
    footer.style.width='calc(100% - 250px)';
  }
}
$(window).on('resize', adjustFooter);
$(document).on('collapsed.lte.pushmenu shown.lte.pushmenu', adjustFooter);
document.addEventListener('DOMContentLoaded', function(){
  adjustFooter();
  setTimeout(adjustFooter, 300);
  
  // HAMBURGER FIX - biar bisa di klik
  var btn = document.getElementById('btnHamburger');
  if(btn){
    btn.addEventListener('click', function(e){
      e.preventDefault();
      document.body.classList.toggle('sidebar-collapse');
      if(window.innerWidth < 992){
        document.body.classList.toggle('sidebar-open');
      }
      setTimeout(adjustFooter, 100);
    });
  }
});
</script>
</body>
</html>