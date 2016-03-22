<!DOCTYPE html>
<html>
<head>
  <title><?php wp_title(); ?></title>
  <?php wp_head(); ?>
</head>
<body>


<!-- The header -->

<header>
  <nav id="left">
    <?php
      $args = array(
      'theme_location' => 'left',
      );
      wp_nav_menu( $args);
    ?>
  </nav>
  <nav id="social">
    <?php
      $args = array(
      'theme_location' => 'social',
      );
      wp_nav_menu( $args);
    ?>
  </nav>
    <nav id="right">
    <?php
      $args = array(
      'theme_location' => 'right',
      );
      wp_nav_menu( $args);
    ?>

    <i class="fa fa-bars"></i>

  </nav>
</header>


<?php

function tile_blog_loop(){

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

		return $blog_Query;

}

?>
