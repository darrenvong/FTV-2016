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
            <h3>Published <?php the_date(); ?> | In <?php the_category(); ?></h3>
          </div>

        </section>

        <article>

          <a href="http://localhost/wp"><span id="back"><I class="fa fa-arrow-circle-left"></i> Home</span></a>

          <!-- <div class="back button"><i class="fa fa-left-arrow"></i></div> -->

          <?php the_content(); ?>

        <?php
    } // end while
  } // end if
  ?>


  <?php
  $args3 = Array(
    'cat' => '2',
    'posts_per_page' => '1',
  );
  $blog_query = new WP_Query( $args3 );
  if ( $blog_query->have_posts() ) {
    while ( $blog_query->have_posts() ) {
      $blog_query->the_post();

        echo	'<div class="blog-tile">';
        echo	'<h4>Latest blog post</h4>';
        echo	'<h3>';
        the_title();
        echo	'</h3>';
        echo	'<a href="';
        the_permalink();
        echo  '">';
        echo	'<div class="cover"></div></a></div>';

  } // end while
} // end if
wp_reset_postdata();
  ?>


  </article>


  <h4 class="related">More to see</h4>
  <section class="related">

    <?php $orig_post = $post;
    global $post;
    $categories = get_the_category($post->ID);
    if ($categories) {
    $category_ids = array();
    foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
    $args=array(
    'category__in' => $category_ids,
    'post__not_in' => array($post->ID),
    'posts_per_page'=> 4, // Number of related posts that will be displayed.
    'caller_get_posts'=>1,
    'orderby'=>'rand' // Randomize the posts
    );
    $my_query = new wp_query( $args );
    if( $my_query->have_posts() ) {
    while( $my_query->have_posts() ) {
    $my_query->the_post();

    $featured_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
    ?>

    <div class="related-tile">

      <div class="related-image" style="background-image:url(<?php echo $featured_img; ?>)">
      </div>
      <div class="related-content">
        <h4><?php the_date(); ?></h4>
        <h3><?php the_title(); ?></h3>
      </div>

      <a href="<?php the_permalink(); ?>"><div class="cover"></div></a>

      <div class="grad"></div>

    </div>


    <? }
    } }
    $post = $orig_post;
    wp_reset_query(); ?>

  </section>

    <a id="more" href="http://localhost/wp"><span><I class="fa fa-arrow-circle-right"></i> More videos</span></a>



      <!-- Contact bar -->
      <a href="mailto:forgetv@forgetoday.com">
        <section id="contact">

          <div id="bg_img" style="background-image:url(<?php bloginfo('template_directory'); ?>/img/contact.jpg")></div>

          <div id="grad"></div>
          <h3>Get in touch</h4>
          <h4>forgetv@forgetoday.com</h2>

        </section>
      </a>

<?php get_footer(); ?>
