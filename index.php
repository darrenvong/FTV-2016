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

  $counter = 0;

  if ( have_posts() ) {
  	while ( have_posts() ) {
  		the_post();

        if($counter<6){

          $featured_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );



          ?>


            <div class="padder">
              <div class="tile">

                <div class="tile-image" style="background-image:url(<?php echo $featured_img; ?>)">
                </div>

                <div class="tile-info">

                  <div class="triangle"></div>

                  <h4><?php the_category(); ?></h4>
                  <h2><?php the_title(); ?></h2>
                  <p><?php the_excerpt(); ?></p>

                </div>

                <a href="<?php the_permalink(); ?>">
                <div class="cover"></div>
                </a>

              </div>
            </div>

        <?php
    };
    $counter++;
    } // end while
  } // end if
  ?>

</section>



<?php

$args = Array(
  'cat' => '38, 2',
  'posts_per_page' => '1',
);

$featured_query = new WP_Query( $args );

if ( $featured_query->have_posts() ) {
  while ( $featured_query->have_posts() ) {
    $featured_query->the_post();

        $do_not_duplicate=$post->ID;

        $featured_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
        ?>

        <section id="featured" style="background-image:url(<?php echo $featured_img; ?>)">

          <div class="featured-info">

            <h4><?php the_category(); ?></h4>
            <h2><?php the_title(); ?></h2>
            <p><?php the_excerpt(); ?></p>

            <button id="watch-now">Watch now <i class="fa fa-play"></i></button>
          </div>

          <!-- <img src="<?php bloginfo('template_directory'); ?>/img/logo.png" /> -->

          <h3>Latest live</h3>

          <a href="<?php the_permalink(); ?>">
          <div class="cover"></div>
          </a>

        </section>

      <?php
  } // end while
} // end if

wp_reset_postdata();

?>

<section id="services">
  <div class="column">
    <div class="service">
      <div class="flex-image"></div>
      <div class="flex-content">
        <h3>Get involved</h3>
        <p>There are no membership fees or applications, and absolutely no experience is needed.</p>
      </div>
    </div>
  </div>
  <div class="column">
    <div class="service">
      <div class="flex-image"></div>
      <div class="flex-content">
        <h3>Hire us</h3>
        <p>Give your event the high-definition reception it deserves</p>
      </div>
    </div>

    <?php
    $args = Array(
      'cat' => '8',
      'posts_per_page' => '1',
    );
    $featured_query = new WP_Query( $args );
    if ( $featured_query->have_posts() ) {
      while ( $featured_query->have_posts() ) {
        $featured_query->the_post();

            $featured_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
            ?>

              <div class="service">
                <div class="flex-image" style="background-image:url(<?php echo $featured_img ?>)"></div>
                <div class="flex-content">
                  <h4>Latest blog post</h4>
                  <h3><?php the_title(); ?></h3>
                  <p><?php the_excerpt(); ?></p>

                </div>
              </div>

          <?php
      } // end while
    } // end if
    wp_reset_postdata();
    ?>

  </div>
</section>

<!-- Contact bar -->
<a href="mailto:forgetv@forgetoday.com">
  <section id="contact">
    <span>Get in touch</span>
    <span>forgetv@forgetoday.com</span>
  </section>
</a>

<?php get_footer(); ?>
