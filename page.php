<?php get_header(); ?>

<div class="spacer"></div>


  <?php
  if ( have_posts() ) {
  	while ( have_posts() ) {
  		the_post();

      $featured_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
      ?>

        <section id="title">
          <div id="bg_img" style="background-image:url(<?php echo $featured_img; ?>)"></div>
          <div id="bg"></div>
          <div id="full-height">
            <h2><?php the_title(); ?></h2>
          </div>
        </section>

        <article class="page">
          <a href="http://localhost/wp"><span id="back"><I class="fa fa-arrow-circle-left"></i> Home</span></a>
          <?php the_content(); ?>
        </article>

        <?php
    } // end while
  }; // end if
  ?>


<?php
get_template_part(contact);
get_footer();
?>
