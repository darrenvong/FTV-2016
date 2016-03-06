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

        <?php if ($counter===0){ ?>

          <!-- The most recent video -->
          <div class="tile">
            <?php the_title(); ?>
          </div>

        <?php } else { ?>

          <!-- All other videos -->
          <div class="tile">
            <?php the_title(); ?>
            <?php echo $counter; ?>
          </div>

        <?php };

        //Iterate the counter
        $counter++;

  	} // end while
  } // end if
  ?>

</section>

<?php get_footer(); ?>
