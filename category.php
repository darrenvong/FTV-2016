<?php get_header(); ?>

<div class="spacer"></div>

<!-- Category title -->
<h2 class="category">
  <span>
  <?php
    if (is_category('committee-blog')) {
      echo 'Read';
    } else {
      echo 'Watch';
    };
  ?> // </span>
  <?php if (is_category('videos')) {
          echo 'All ';
        }
        single_cat_title();
  ?>
</h2>

<ul class="popular-cats">
  <?php
    /** Grabs the 'videos' category ID using WordPress API functions instead of hard-coding it,
     ** so that it works across all environments (i.e. in anyone's local server environment with
     WordPress installed).
     **/
    $all_vids_id = get_term_by('slug', 'videos', 'category')->term_id;
    wp_list_categories( array(
      'orderby' => 'count',
      'order' => 'DESC',
      'number' => 6,
      'title_li' => __( '' ),
      'child_of' => $all_vids_id,
      'depth' => 1
    ));
  ?>
</ul>
<?php
  //Declare counter variable
  $counter = 0;
  // The Loop
  if ( have_posts() ) {
  	while ( have_posts() ) {
  		the_post();
  //Declare variable for featured images
  $featured_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
?>

<!-- Put the 1st post on the top banner -->
<?php if ($counter==0) {?>

<section id="featured" class="live-banner">

  <div id="bg_img" style="background-image:url(<?php echo $featured_img; ?>)"></div>

  <div id="bg"></div>
  <div class="featured-info">

    <a href="http://forgetoday.com/tv"><span id="cat-back"><I class="fa fa-arrow-circle-left"></i> Home</span></a>

    <h4><?php the_category(); ?></h4>
    <h2><?php if (in_category('upcoming-live')){
      ?><i class="fa fa-rss"></i> <?php
    } ?><?php the_title(); ?></h2>
    <p><?php the_excerpt(); ?></p>
    <a href="<?php the_permalink(); ?>">
      <?php
        if(is_category('committee-blog')){
         echo '<button id="watch-now">Read now <i class="fa fa-book"></i>';
        }else{
        echo '<button id="watch-now">Watch now <i class="fa fa-play"></i>';
        };
      ?>

      </button></a>
  </div>

  <?php if (in_category('upcoming-live')) { ?>
    <div class="live-category-player">
      <script src="http:////content.jwplatform.com/players/idJNvXsO-i9raT3mC.js"></script>
    </div>
  <?php }; ?>

</section>

<section id="category">

<?php } else { ?>

  <div class="padder">
    <div class="tile">
      <div class="tile-image" style="background-image:url(<?php echo $featured_img; ?>)">
      </div>
      <div class="tile-info">
        <div class="triangle"></div>
        <h4><?php the_category(); ?></h4>
        <h2><?php if (in_category('upcoming-live')) {
          ?><i class="fa fa-rss"></i> <?php
        } ?><?php the_title(); ?></h2>
        <p><?php the_excerpt(); ?></p>
        <div class="grad"></div>
      </div>
      <a href="<?php the_permalink(); ?>">
      <div class="cover"></div>
      </a>
    </div>
  </div>

<?php } ?>



<?php

//Iterate counter
$counter++;

  } // end while
  }; // end if
?>

</section>



<!-- Pagination -->

<section id="pagination">
  <?php
    $pags = array(
      'prev_text'          => __('< Previous'),
      'next_text'          => __('Next >'),
    );
    echo paginate_links( $pags );
  ?>
</section>

<?php get_footer(); ?>
