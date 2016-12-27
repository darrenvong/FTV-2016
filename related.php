<section class="related">

  <?php $orig_post = $post;
  global $post;
  $categories = get_the_category($post->ID);
  if ($categories):
    $category_ids = array();
    foreach ($categories as $individual_category) $category_ids[] = $individual_category->term_id;
    $args = array(
      'category__in' => $category_ids,
      'post__not_in' => array($post->ID),
      'posts_per_page' => 4, // Number of related posts that will be displayed.
      'caller_get_posts'=> 1,
      'orderby' => 'rand' // Randomize the posts
    );
    $my_query = new wp_query( $args );
    if ( $my_query->have_posts() ):
      while ( $my_query->have_posts() ):
        $my_query->the_post();
  ?>

        <div class="padder">
          <div class="related-tile">

            <div class="related-image" style="background-image:url(<?php echo the_post_thumbnail_url('medium'); ?>)">
            </div>
            <div class="related-content">
              <h4><?php the_date(); ?></h4>
              <h3><?php the_title(); ?></h3>
            </div>

            <a href="<?php the_permalink(); ?>"><div class="cover"></div></a>

            <div class="grad"></div>

          </div>
        </div>

  <?php
      endwhile;
    endif;
  endif;
  $post = $orig_post;
  wp_reset_query(); ?>

</section>
