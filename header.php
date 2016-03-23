<!DOCTYPE html>
<html>
<head>
  <title><?php wp_title(); ?></title>
  <?php wp_head(); ?>
</head>
<body id="top">

  <script src="<?php echo get_template_directory_uri() . '/js/smooth_scroll.js'?>"></script>


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

    <i class="fa fa-bars"></i>

  </nav>
</header>
