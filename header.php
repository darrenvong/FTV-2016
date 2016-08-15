<?php include $config->paths->templates . 'FTV-2016/funcs.php'; ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
      <?php
        $home = $pages->get("/");
        echo (($page->id !== $home->id)? "$page->title | " : "") . "$home->title | $home->tagline";
      ?>
    </title>
    <link rel="shortcut icon" href="<?php echo $config->urls->templates; ?>FTV-2016/favicon.png" />
    <link rel="stylesheet" type="text/css" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" />

    <?php if ($page->template == "gallery" || $page->template == "single-gallery"): ?>
    <link rel="stylesheet" type="text/css" href="<?= $config->urls->templates; ?>css/jquery.modal.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.min.css" />
    <?php endif; ?>
    
    <link rel="stylesheet" type="text/css" href="<?php echo $config->urls->templates; ?>FTV-2016/style.css" />


    <!-- Open Graph Meta Tags for Facebook and LinkedIn-->
    <meta property="og:title" content="<?= $page->title; ?>"/>
    <meta property="og:url" content="<?= $page->url; ?>"/>
    <meta property="og:image" content="<?= $page->featured_image->url; ?>" />
    <meta property="og:type" content="<?php
      if ($page->template->name === "video" || $page->template->name === "live" ||
          $page->template->name === "blog") {
        echo "article";
      }
      else { echo "website";} ?>" />
    <meta property="og:site_name" content="<?= $pages->get("/")->title; ?>"/>
    <!-- End Open Graph Meta Tags !-->

    <!-- Twitter meta tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@ForgeTV">
    <meta name="twitter:creator" content="Forge TV">
    <meta name="twitter:title" content="<?= $page->title ?>">
    <meta name="twitter:image" content="<?= $page->featured_image->url; ?>">

</head>
<body id="top">

<!-- The header -->

<?php include $config->paths->templates . 'FTV-2016/float-menu.php'; ?>

<header>
  <nav id="left">
    <?php
      $outlets_menu = $pages->get("/menus/outlets/");
      display_menu($outlets_menu, $page);
    ?>
  </nav>
  <nav id="social">
    <?php
      display_menu($social_menu, $page);
    ?>
  </nav>
    <nav id="right">
    <?php
      display_menu($sections_menu, $page);
    ?>

    <div class="bars">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </nav>
  
  <!-- Close button fix on mobile menu for view ports wider than 900px -->
  <div class="bars white">
    <span></span>
    <span></span>
    <span></span>
  </div>
</header>
