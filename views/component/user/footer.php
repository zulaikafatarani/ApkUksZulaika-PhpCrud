<?php // views/component/user/footer.php - FIX FINAL ?>
<footer class="main-footer bg-white border-top">
  <strong>Copyright &copy; <?= date('Y') ?> <a href="#" class="text-success">UKS DIGITAL - SMKN 1 Karang Baru</a>.</strong>
  All rights reserved.
  <div class="float-right d-none d-sm-inline-block">
    <b>Version</b> 1.0 | PMR UKS | <?= strtoupper($_SESSION['namauser'] ?? '') ?>
  </div>
</footer>