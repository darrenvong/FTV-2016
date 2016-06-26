<?php get_header(); ?>

  <script>
    function parallax(){
        var scrolled = $(window).scrollTop();
        $('#bg_img').css('top', (scrolled * 0.3) + 'px');
    }
    if (/Android|BlackBerry|iPhone|iPad|iPod|webOS/i.test(navigator.userAgent) === false) {
      $(window).scroll(function(e){
            parallax(); //Run parallax() not a mobile device
      });
  };
  </script>

<section id="hero">

    <?php
      function displayRandom() {
          $photoAreas = array("/hero1.jpg", "/hero2.jpg", "/hero3.jpg", "/hero4.jpg");
          $randomNumber = rand(0, (count($photoAreas) - 1));
          echo $photoAreas[$randomNumber];
      }
    ?>



  <div id="bg_img" style="background-image: url(<?php bloginfo('template_directory'); ?>/img<?php displayRandom(); ?>)"></div>
  <div id="bg"></div>

  <img id="logo" src="<?php bloginfo('template_directory'); ?>/img/logo.png" />
  <div class="divider"></div>
  <span id="slogan"><?php bloginfo( 'description' ); ?></span>

  <a href="#latest" class="cue"><i class="fa fa-arrow-down fa-3x cue"></i></a>

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
                  <h2><?php if (in_category(23)){
                    ?> <i class="fa fa-rss"></i> <?php
                  } ?><?php the_title(); ?></h2>
                  <p><?php the_excerpt(); ?></p>
                  <div class="grad"></div>
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

$args1 = Array(
  'category_name' => 'features',
  'posts_per_page' => '1',
);

$featured_query = new WP_Query( $args1 );

if ( $featured_query->have_posts() ) {
  while ( $featured_query->have_posts() ) {
    $featured_query->the_post();

        $do_not_duplicate=$post->ID;

        $featured_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
        ?>

        <section id="featured">

          <div id="bg_img" style="background-image:url(<?php echo $featured_img; ?>)"></div>

          <div id="bg"></div>
          <div class="featured-info">
            <h4><?php the_category(); ?></h4>
            <h2><?php if (in_category("upcoming-live")){
              ?><i class="fa fa-rss"></i> <?php
            } ?><?php the_title(); ?></h2>
            <p><?php the_excerpt(); ?></p>
            <a href="<?php the_permalink(); ?>"><button id="watch-now">Watch now <i class="fa fa-play"></i></button></a>
          </div>
        </section>

      <?php
  } // end while
} // end if

wp_reset_postdata();
?>

<section id="services">
  <div class="column">
    <div class="service">
      <div class="flex-image" style="background-image:url(<?php bloginfo('template_directory'); ?>/img/get_involved.jpg)"></div>
      <div class="flex-content">
        <h4>Get involved</h4>
        <h3>Join our team</h3>
        <p>There are no membership fees or applications, and absolutely no experience is needed.</p>
        <a href="tv/get-involved"><button>Find out how</button></a>
      </div>
    </div>
  </div>
  <div class="column">
    <div class="service hover">
      <div class="flex-image" style="background-image:url(<?php bloginfo('template_directory'); ?>/img/hire_us.jpg)"></div>
      <div class="flex-content">
        <h4>Services</h4>
        <h3>Hire us</h3>
        <p>Give your event the high-definition reception it deserves.</p>
      </div>
      <a href="/tv/hire">
        <div class="cover"></div>
      </a>
    </div>

    <?php
    $args2 = Array(
      'category_name' => 'committee-blog',
      'posts_per_page' => '1',
    );
    $featured_query = new WP_Query( $args2 );
    if ( $featured_query->have_posts() ) {
      while ( $featured_query->have_posts() ) {
        $featured_query->the_post();

            $featured_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
            ?>

              <div class="service hover">
                <div class="flex-image" style="background-image:url(<?php echo $featured_img ?>)"></div>
                <div class="flex-content">
                  <h4>Latest blog post</h4>
                  <h3><?php the_title(); ?></h3>
                  <p><?php the_excerpt(); ?></p>
                </div>

                <a href="<?php the_permalink(); ?>">
                  <div class="cover"></div>
                </a>

              </div>

          <?php
      } // end while
    } // end if
    wp_reset_postdata();
    ?>

  </div>
</section>

<?php
get_template_part(contact);
get_footer();
?>
