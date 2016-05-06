<?php get_header(); ?>

<div class="spacer"></div>

<!-- Category title -->

<?php
  function random404() {
      $photoAreas = array("404</span> Brilliance not found", "Hello!</span> Is it TV you're looking for?", "404</span> Someone unplugged our server again", "404</span> Move along, nothing to see", "404</span> There is always contention in the switch.");
      $randomNumber = rand(0, (count($photoAreas) - 1));
      echo $photoAreas[$randomNumber];
  }
?>

<section id="featured" class="not-found">

  <div id="bg_img" style="background-image:url(<?php bloginfo('template_directory'); ?>/img/404.jpg)"></div>

  <div id="bg"></div>
  <div class="featured-info">

    <h4><a href="http://forgetoday.com/tv"><span id="404-back"><I class="fa fa-arrow-circle-left"></i> Home</span></a></h4>
    <h2><span style=" color: #515294"><?php random404(); ?></h2>
    <p>We couldn't find what you're after. Could be that we lost it in a clear-out, or we just forgot to put it there in the first place.</p>
   <?php get_search_form(); ?>

  </div>
</section>

<?php get_footer(); ?>
