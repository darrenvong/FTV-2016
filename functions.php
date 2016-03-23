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

//Hide the "featured" category and others on the front-end

add_action('pre_get_posts', 'wpa_31553' );

function wpa_31553( $wp_query ) {

    //$wp_query is passed by reference.  we don't need to return anything. whatever changes made inside this function will automatically effect the global variable

    $excluded = array('uncategorized');  //made it an array in case you need to exclude more than one

    // only exclude on the front end
    if( !is_admin() ) {
        $wp_query->set('category__not_in', $excluded);
    }
}
