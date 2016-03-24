<?php

// Register menus

register_nav_menus( array(
	'left' => 'Left Header',
	'right' => 'Right Header',
	'bottom' => 'Footer',
	'social' => 'Social',
) );

add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);
function special_nav_class($classes, $item){
     if( in_array('current-menu-item', $classes) ){
             $classes[] = 'active ';
     }
     return $classes;
}

//Allows featured images

	 add_theme_support( 'post-thumbnails' );

function wp_new_excerpt($text)
{
	if ($text == '')
	{
		$text = get_the_content('');
		$text = strip_shortcodes( $text );
		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]>', $text);
		$text = strip_tags($text);
		$text = nl2br($text);
		$excerpt_length = apply_filters('excerpt_length', 15);
		$words = explode(' ', $text, $excerpt_length + 1);
		if (count($words) > $excerpt_length) {
			array_pop($words);
			array_push($words, '...');
			$text = implode(' ', $words);
		}
	}
	return $text;
}
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'wp_new_excerpt');


//Enqueue scripts

wp_enqueue_style( 'Primary styles', get_stylesheet_uri() );
wp_enqueue_style( 'FontAwesome', 'http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css' );
wp_enqueue_script( 'jquery_frontend', 'https://code.jquery.com/jquery-2.2.1.min.js');

//Wrap videos in responsive container

add_filter('embed_oembed_html', 'my_embed_oembed_html', 99, 4);
function my_embed_oembed_html($html, $url, $attr, $post_id) {
  return '<div class="video-box"><div class="video-wrapper">' . $html . '</div></div>';
}

//Meta tags


function custom_get_excerpt($post_id) {
    $temp = $post;
    $post = get_post( $post_id );
    setup_postdata( $post );
    $excerpt = get_the_excerpt();
    wp_reset_postdata();
    $post = $temp;
    return $excerpt;
}

function fbogmeta_header() {
  if (is_single()) {
    ?>
    <!-- Open Graph Meta Tags for Facebook and LinkedIn-->
		<meta property="og:title" content="<?php the_title(); ?>"/>
		<meta property="og:url" content="<?php the_permalink(); ?>"/>
		<?php $fb_image = wp_get_attachment_image_src(get_post_thumbnail_id( get_the_ID() ), 'large'); ?>
		<?php if ($fb_image) : ?>
			<meta property="og:image" content="<?php echo $fb_image[0]; ?>" />
			<?php endif; ?>
		<meta property="og:type" content="<?php
			if (is_single() || is_page()) { echo "article"; } else { echo "website";} ?>"/>
		<meta property="og:site_name" content="<?php bloginfo('name'); ?>"/>
		<!-- End Open Graph Meta Tags !-->

		<!-- Twitter meta tags -->
		<meta name="twitter:card" content="summary_large_image">
		<meta name="twitter:site" content="@ForgeTV">
		<meta name="twitter:creator" content="Forge TV">
		<meta name="twitter:title" content="<?php the_title(); ?>">
		<meta name="twitter:image" content="<?php echo $fb_image[0]; ?>">

    <?php
  }
}
add_action('wp_head', 'fbogmeta_header');
