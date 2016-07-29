<nav id="mobile">
  
  <?php
    $args = array(
    'theme_location' => 'right',
    'menu_id' => 'mobile-primary',
    );
    wp_nav_menu( $args);
  ?>



  <?php get_search_form(); ?>

  <?php
    $args = array(
    'theme_location' => 'social',
    'menu_id' => 'socialise',
      );
    wp_nav_menu( $args);
  ?>

</nav>
