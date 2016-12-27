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
            <h2><?php the_title(); ?></h2>
            <h3>Published <?php the_date(); ?> | In <?php the_category(); ?></h3>
          </div>
        </section>

        <article>
          <a href="http://forgetoday.com/tv"><span id="back"><I class="fa fa-arrow-circle-left"></i> Home</span></a>
          <?php the_content(); ?>

          <?php

          $args3 = Array(
            'cat' => array($post->cat_ID),
            'posts_per_page' => '1',
            'post__not_in' => array($post->ID)
          );
          $blog_query = new WP_Query( $args3 );

          if ( $blog_query->have_posts() ) {
            while ( $blog_query->have_posts() ) {
              $blog_query->the_post();
              ?>

                <div class="blog-tile">
                <h4>Watch next <i class="fa fa-play"></i></h4>
                <h3><?php the_title(); ?></h3>
                <a href="<?php the_permalink(); ?>">
                  <div class="cover"></div>
                </a>
              </div>

              <?php


          } // end while
        }; // end if
        wp_reset_postdata();
          ?>

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
