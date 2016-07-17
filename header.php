<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|','true','right'); ?><?php bloginfo('name'); ?> | <?php bloginfo('description'); ?></title>
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.png" />
    <?php wp_head(); ?>
</head>
<body id="top">

  <script src="<?php echo get_template_directory_uri() . '/js/smooth_scroll.js'?>"></script>



<!-- The header -->

<?php get_template_part('float-menu'); ?>

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

    <div id="bars">
      <span></span>
      <span></span>
      <span></span>
    </div>

<script>
  $(document).ready(function(){
  	$('#bars').click(function(){
  		$(this).toggleClass('open');
      console.log("Open class toggle on bars icon");
  		$(mobile).toggleClass('on');
  	});
  });
</script>



  </nav>
</header>
