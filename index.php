<?php get_header(); ?>

<section id="hero">

  <img id="logo" src="<?php bloginfo('template_directory'); ?>/img/logo.png" />
  <div class="divider"></div>
  <span id="slogan"><?php bloginfo( 'description' ); ?></span>

  <a href="#latest" class="cue"><i class="fa fa-caret-down fa-4x cue"></i></a>

</section>

<!-- Latest videos -->

<section id="latest">

  <?php
  //Declare counter variable
  $counter = 0;

  if ( have_posts() ) {
  	while ( have_posts() ) {
  		the_post();
        ?>

        <?php

          $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );

        if ($counter<4){

         if ($counter===0){ ?>
            <!-- The most recent video -->

            <div class="tile" id="first">
              <h5><?php the_category(); ?></h5>
              <h3><?php the_title(); ?></h3>
              <p><?php the_excerpt(); ?></p>
              <div class="triangle"></div>
            </div>

            <div class="tile" style="background-image: url(<?php echo $url; ?>)">
            </div>

        <?php } elseif ($counter===3) { ?>

            <!-- All other videos -->
            <div class="tile" style="background-image: url(<?php echo $url; ?>)">
            </div>

            <div class="tile" id="first">
              <h5><?php the_category(); ?></h5>
              <h3><?php the_title(); ?></h3>
              <p><?php the_excerpt(); ?></p>
              <div class="triangle-reverse"></div>
            </div>

        <?php } else { ?>

          <div class="tile" style="background-image: url(<?php echo $url; ?>)">
          </div>

        <?php } }
        //Iterate the counter
        $counter++;
  	} // end while
  } // end if
  ?>
</section>


<section id="contact">
  <h5>
    <a href="mailto:forgetv@forgetoday.com">forgetv@forgetoday.com</a>
  </h5>
</section>

<?php get_footer(); ?>
