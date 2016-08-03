<?php include "header.php"; ?>

<div class="spacer"></div>

  <?php
    $featured_img = $page->featured_img->url;
  ?>

  <section id="title">
    <div id="bg_img" style="background-image:url(<?php echo $featured_img; ?>)"></div>
    <div id="bg"></div>
    <div id="full-height">
      <h2><?= $page->title; ?></h2>
    </div>
  </section>

  <article class="page">
    <a href="<?php echo $config->urls->root; ?>"><span id="back"><I class="fa fa-arrow-circle-left"></i> Home</span></a>
    <?= $page->content; ?>
  </article>


<?php
  include_once "contact.php";
  include_once "footer.php";
?>
