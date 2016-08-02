<?php include "header.php"; ?>

<div class="spacer"></div>

  <?php
    $featured_img = $page->featured_image->url;
    $category = $page->parent;
  ?>

  <meta name="twitter:description" content="<?php echo trimExcerpt($page->excerpt); ?>">

    <section id="title">
      <div id="bg_img" style="background-image:url(<?php echo $featured_img; ?>)"></div>
      <div id="bg"></div>
      <div id="full-height">
        <h2><?php echo $page->title; ?></h2>
        <h3>Published <?php echo $page->post_date; ?> | In <?php echo $category->title; ?></h3>
      </div>
    </section>

    <article>
      <a href="<?= $config->urls->root; ?>"><span id="back"><I class="fa fa-arrow-circle-left"></i> Home</span></a>
      <?= $page->content; ?>

      <?php
        // Find the next video in the same category
        $related = $pages->findOne("parent=$page->parent, id!=$page->id, sort=-post_date");
      ?>

      <div class="blog-tile">
        <h4>Watch next <i class="fa fa-play"></i></h4>
        <h3><?php echo $related->title; ?></h3>
        <a href="<?php echo $related->url; ?>">
          <div class="cover"></div>
        </a>
      </div>

      <?php
        //Disqus comments here
        // comments_template( $file, $separate_comments );
      ?>

  </article>

<!-- ################################## EDITED UP TO HERE! ################################## -->

  <h4 class="related"><?php randomText(); ?></h4>
  <section class="related">

    <!-- ### PW version: combine primary cat with secondary cats to find all cats! ### -->
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

    <div class="padder">
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
    </div>

    <?php }
    } }
    $post = $orig_post;
    wp_reset_query(); ?>

  </section>

    <a id="more" href="http://forgetoday.com/tv/videos"><span><I class="fa fa-arrow-circle-right"></i> More videos</span></a>


<?php
get_template_part(contact);
get_footer();
?>
