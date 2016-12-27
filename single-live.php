<?php get_header(); ?>

<div class="spacer"></div>

  <?php
  if ( have_posts() ) {
  	while ( have_posts() ) {
  		the_post();
  ?>

      <section id="title">
        <div id="bg_img" style="background-image:url(<?php echo the_post_thumbnail_url('large'); ?>)"></div>
        <div id="bg"></div>
        <div id="full-height">
          <h2>Live: <?php the_title(); ?></h2>
          <h3>Published <?php the_date(); ?> | In <?php the_category(); ?></h3>
        </div>
      </section>

      <article>
        <a href="http://forgetoday.com/tv"><span id="back"><I class="fa fa-arrow-circle-left"></i> Home</span></a>

      <section class="live-container">
        <div class="autosizer">
          <?php the_content(); ?>
        </div>

        <a class="twitter-timeline" href="https://twitter.com/ForgeTV" data-widget-id="713860130178265088" data-chrome="transparent noheader nofooter">Tweets by @ForgeTV</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
      </section>

      <div style="margin-bottom:20px;"></div>

      <?php comments_template( $file, $separate_comments ); ?>

      <?php
    } // end while
  }; // end if
  ?>


  </article>

  <h4 class="related"><?php randomText(); ?></h4>
  <?php get_template_part('related'); ?>

  <a id="more" href="http://forgetoday.com/tv/videos"><span><I class="fa fa-arrow-circle-right"></i> More videos</span></a>


<?php
get_template_part(contact);
get_footer();
?>
