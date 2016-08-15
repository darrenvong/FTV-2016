<footer>

  <a href="#top"><div class="up"><i class="fa fa-arrow-up"></i></div></a>

  <nav>
    <?php
      display_menu($social_menu, $page);
    ?>
  </nav>

  <span>© <?=$home->title; ?> <?php echo date('Y'); ?> </span>

  <hr>

  <p>All rights reserved. Designed by <a target="blank" href="http://joshuahackett.com">Joshua Hackett</a>.
  Maintained by <a href="https://github.com/darrenvong">Darren Vong</a>.
  <br>
  Want to reuse our content? <a href="http://forgetoday.com/tv/contact">Get in touch</a>.</p>

</footer>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.2.1.min.js"></script>
<script src="<?php echo $config->urls->templates . 'FTV-2016/js/smooth_scroll.js'?>"></script>

<?php if ($page->template == "gallery" || $page->template == "single-gallery"): ?>
  <script type="text/javascript" src="<?= $config->urls->templates; ?>js/jquery.modal.min.js" charset="utf-8"></script>
  <script type="text/javascript" src="<?= $config->urls->templates; ?>js/jquery.lazyload.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.min.js"></script>

  <script>
    $(function() {
      $("img.gallery-image").show().lazyload({
        effect: "fadeIn"
      });
      $('[id*="img"]').modal({fadeDuration: 1200});
      $('[id*="img"] div.fotorama').each(function(i, e) {
        var photoDiv = $(this).fotorama();
      });

      $('a[href*="#img"]').each(function() {
        $(this).click(function() {
          var fotorama = $($(this).attr("href")+" div.fotorama").data('fotorama');
          if (fotorama) { // The slideshow has been opened before
            fotorama.show({index: 0, time: 0});
          }
        });
      });
    });
  </script>
<?php endif; ?>
<script>
  $(document).ready(function() {
    var bars = $('.bars');
    bars.click(function() {
      bars.toggleClass('open');
      console.log("Open class toggle on bars icon");
      $('#mobile').toggleClass('on');
    });
  });
</script>
</body>
</html>
