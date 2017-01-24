<nav id="mobile">
  
  <?php
    $sections_menu = $pages->get("/menus/sections/");    
    display_menu($sections_menu, $page, "mobile-primary");
    
    include $config->paths->templates . "FTV-2016/searchform.php";

    $social_menu = $pages->get("/menus/social/");
    display_menu($social_menu, $page, "socialise");
  ?>

</nav>
