<!DOCTYPE html>
<html>
<head>

  <title><?php wp_title(); ?></title>
  <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" />
  <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-2.2.1.min.js"></script>
  <script src="http://localhost/wp/wp-content/themes/FTV%202016/js/scroll.js"></script>

</head>
<body>


<!-- The header -->

<header>
  <nav id="left">
    <?php
      $args = array(
      'theme_location' => 'left',
      );
      wp_nav_menu( $args);
    ?>
  </nav>
  <nav id="social">
    <?php
      $args = array(
      'theme_location' => 'social',
      );
      wp_nav_menu( $args);
    ?>
  </nav>
    <nav id="right">
    <?php
      $args = array(
      'theme_location' => 'right',
      );
      wp_nav_menu( $args);
    ?>
  </nav>
</header>
