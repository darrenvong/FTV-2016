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

function wp_new_excerpt($text) {
	if ($text == '') {
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
function ftv_enqueue() {
  wp_enqueue_style( 'Primary styles', get_stylesheet_uri() );
  wp_enqueue_style( 'FontAwesome', 'http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css' );

  wp_enqueue_script( 'jquery_frontend', 'https://code.jquery.com/jquery-2.2.1.min.js');  
}
add_action('wp_enqueue_scripts', 'ftv_enqueue');

//JavaScript hotfix to adjust the grid dynanically
function load_grid_adjust() {
  if ( is_page("about") ) {
    //Parameters: handle name, src, js dependencies array (pass handle names here), version num (pass false if there isn't one),
    //whether to load this in footer (should always set to true for js to speed up page load)
    wp_enqueue_script('committee_grid_adjustments', get_template_directory_uri() . "/js/grid_adjust.js", array('jquery_frontend'),
                      false, true);
  }  
}
add_action('wp_enqueue_scripts', 'load_grid_adjust');

//Wrap videos in responsive container

add_filter('embed_oembed_html', 'my_embed_oembed_html', 99, 4);
function my_embed_oembed_html($html, $url, $attr, $post_id) {
  return '<div class="video-box"><div class="video-wrapper">' . $html . '</div></div>';
}

// Picks a hero photo name at random
function displayRandom() {
    $NUM_HERO_PHOTOS = 5;
    for ($i = 1; $i <= $NUM_HERO_PHOTOS; $i++) {
      $photoAreas[] = "/hero" . $i . ".jpg";
    }
    $randomNumber = rand(0, (count($photoAreas) - 1));
    echo $photoAreas[$randomNumber];
}

// Random Text on the "related videos" section to keep it a bit more interesting
function randomText() {
    $photoAreas = array("Always more to see", "More delightful videos", "Lots left to see", "We've got lots left to show you", "Aren't you glad to see us", "Have a looksie", "Fancy seeing you here");
    $randomNumber = rand(0, (count($photoAreas) - 1));
    echo $photoAreas[$randomNumber];
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
    <meta property="og:description" content="<?= custom_get_excerpt( get_the_ID() ); ?>">
		<!-- End Open Graph Meta Tags !-->

		<!-- Twitter meta tags -->
		<meta name="twitter:card" content="summary_large_image">
		<meta name="twitter:site" content="@ForgeTV">
		<meta name="twitter:creator" content="Forge TV">
		<meta name="twitter:title" content="<?php the_title(); ?>">
		<meta name="twitter:image" content="<?php echo $fb_image[0]; ?>">
    <meta name="twitter:description" content="<?= custom_get_excerpt( get_the_ID() ); ?>">

    <?php
  }
}
add_action('wp_head', 'fbogmeta_header');



//Hide the "featured" category and others on the front-end

add_filter('get_the_terms', 'hide_categories_terms', 10, 3);
function hide_categories_terms($terms, $post_id, $taxonomy) {

    $exclude = array('upcoming-live', 'videos');

    if (!is_admin()) {
        foreach($terms as $key => $term){
            if($term->taxonomy == "category"){
                if(in_array($term->slug, $exclude)) unset($terms[$key]);
            }
        }
    }

    return $terms;
}


//Author contact info

function add_remove_contactmethods($contactmethods) {
        $contactmethods['twitter'] = 'Twitter handle (&commat; will be automatically added)';
        $contactmethods['contactEmail'] = 'Contact Email (publicly visible)';
        // this will remove existing contact fields
        return $contactmethods;
}
add_filter('user_contactmethods','add_remove_contactmethods', 10, 1);

function get_image_id_by_link($link) {
    global $wpdb;
    // strips out the size of image in file name in case link used isn't the original image
    $link = preg_replace('/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $link);

    return $wpdb->get_var("SELECT ID FROM {$wpdb->posts} WHERE BINARY guid='$link'");
}

function get_optimised_photo($url) {
  $photo_id = get_image_id_by_link($url);
  return wp_get_attachment_image_url( $photo_id, "medium" );
}

function committee_member_tile($atts) {
  // Attributes
  $atts = shortcode_atts(array(
    'name' => '',
    'role' => '',
    'office_hour' => '',
    'email' => '',
    'twitter_name' => '',
    'photo_url' => '',
    // additional classes as handles for styling/layout changes if needed
    'classes' => ''
  ), $atts, 'committee_member');
  // runs the escape filter through all attributes at once
  $atts = array_map("esc_html", $atts);

  ob_start();
  ?>
  <div class="team-tile <?= (($atts['classes'])? $atts['classes'] : "") ?>">
    <img src="<?= get_optimised_photo( $atts['photo_url'] ); ?>">
    <h4><?= $atts['name'] ?></h4>
    <p><?= $atts['role'] ?></p>
    <p class="office_hour">Office Hour: <?= $atts['office_hour'] ?></p>
    <div class="team_contact">
      <?php
      if ( $atts['name'] && !$atts['email'] ):
        $email_str = str_replace( ' ', '.', strtolower( $atts['name'] ) ) . '@forgetoday.com';
      else:
        $email_str = $atts['email'];
      endif;
      ?>
      <div class="email_address">
        <a href="mailto:<?= $email_str ?>"><i class="fa fa-envelope"></i><span><?= $email_str ?></span></a>
      </div>
      <?php
      if ( $atts['twitter_name'] ): ?>
        <div class="twitter_name">
          <a href="https://twitter.com/<?= $atts['twitter_name'] ?>">
            <i class="fa fa-twitter"></i>
            <span>@<?= $atts['twitter_name'] ?></span>
          </a>
        </div>
      <?php
      endif;
      ?>
    </div>
  </div>
  <?php
  return ob_get_clean();
}
add_shortcode( 'committee_member', 'committee_member_tile' );
