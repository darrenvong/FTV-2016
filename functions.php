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
