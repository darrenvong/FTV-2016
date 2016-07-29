<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page->title; ?> | <?php echo $page->excerpt; ?></title>
    <link rel="shortcut icon" href="<?php echo $config->urls->templates; ?>FTV-2016/favicon.png" />
    <link rel="stylesheet" type="text/css" href="<?php echo $config->urls->templates; ?>FTV-2016/style.css" />
    <link rel="stylesheet" type="text/css" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" />
    <script type="text/javascript" href="https://code.jquery.com/jquery-2.2.1.min.js"></script>
</head>
<body id="top">

  <script src="<?php echo $config->urls->templates . 'FTV-2016/js/smooth_scroll.js'?>"></script>



<!-- The header -->

<?php include $config->paths->templates . 'FTV-2016/float-menu.php'; ?>

<!-- ################################## EDITTED UP TO HERE! ################################## -->

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
  $(document).ready(function() {
    var bars = $('.bars');
    bars.click(function() {
      bars.toggleClass('open');
      console.log("Open class toggle on bars icon");
      $('#mobile').toggleClass('on');
    });
  });
</script>



  </nav>
</header>

<!-- Close button fix on mobile menu for view ports wider than 900px -->
<div class="bars white">
  <span></span>
  <span></span>
  <span></span>
</div>
