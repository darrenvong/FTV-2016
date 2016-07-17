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

  <p>All rights reserved. Designed by <a target="blank" href="http://joshuahackett.com">Joshua Hackett</a>.
  Maintained by <a href="https://github.com/darrenvong">Darren Vong</a>.
  <br>
  Want to reuse our content? <a href="http://forgetoday.com/tv/contact">Get in touch</a>.</p>

</footer>

<?php wp_footer(); ?>
</body>
</html>
