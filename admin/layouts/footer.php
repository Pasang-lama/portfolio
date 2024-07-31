  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span><?= $_SESSION['auth']->name; ?></span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      Designed by <a href="https://pasang-lama.com.np/"><?= $_SESSION['auth']->name; ?></a>
    </div>
  </footer><!-- End Footer -->
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <script src="<?= url('public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  <script src="<?= url('public/assets/js/jquery-3.7.1.min.js') ?>"></script>
  <script src="<?= url('public/assets/ckeditor/ckeditor.js'); ?>"></script>
  <script src=" <?= url('public/assets/js/custome.js') ?>"></script>
  <script src=" <?= url('public/assets/js/main.js') ?>"></script>
  </body>
  </html>