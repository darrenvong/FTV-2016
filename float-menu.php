<nav id="mobile">
  
  <?php
    $sections_menu = $pages->get("/sections/");    
    display_menu($sections_menu, "mobile-primary");
    
    include $config->paths->templates . "FTV-2016/searchform.php";

    $social_menu = $pages->get("/social/");
    display_menu($social_menu, "socialise");
  ?>

</nav>
