<nav id="mobile">
  <!-- Likely to need refactoring later... -->
  <div class="menu-container">
    <ul id="mobile-primary">
      <?php
        //menu logic
        // foreach ($page->menu as $menu) {
        //   foreach ($menu->$menu_item_group as $group) {
        //     echo "<li><a href='#'>{$group->menu_item}</a></li>";
        //   }
        // }
      ?>      
    </ul>
  </div>
  
  <?php
    $args = array(
    'theme_location' => 'right',
    'menu_id' => 'mobile-primary',
    );
    wp_nav_menu( $args);
  ?>



  <?php include $config->paths->templates . "FTV-2016/searchform.php"; ?>

  <?php
    $args = array(
    'theme_location' => 'social',
    'menu_id' => 'socialise',
      );
    wp_nav_menu( $args);
  ?>

</nav>
