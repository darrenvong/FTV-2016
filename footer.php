<footer>

  <a href="#top"><div class="up"><i class="fa fa-arrow-up"></i></div></a>

  <nav>
    <?php
      $args = array(
      'theme_location' => 'social',
      );
      wp_nav_menu( $args);
    ?>
  </nav>

  <span>© <?php bloginfo( 'title'); ?> <?php echo date('Y'); ?> </span>

  <hr>

  <p>All rights reserved. Designed by Joshua Hackett.
  Maintained by <a href="https://github.com/darrenvong" target="_blank">Darren Vong</a>.
  <br>
  Want to reuse our content? <a href="mailto:forgetv@forgetoday.com">Get in touch</a>.</p>

</footer>

<?php wp_footer(); ?>
<script src="<?php echo get_template_directory_uri() . '/js/smooth_scroll.js'?>"></script>
</body>
</html>
