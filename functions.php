<?php

/*** Oxpeckers styles ***/
function oxpeckers_scripts() {
	wp_enqueue_style( 'text', get_stylesheet_directory_uri() . '/css/text.css' );
	wp_enqueue_style( 'slider', get_stylesheet_directory_uri() . '/css/slider.css' );
	wp_enqueue_style( 'mapcontrol', get_stylesheet_directory_uri() . '/css/mapcontrol.css' );
	wp_enqueue_style( 'appearance', get_stylesheet_directory_uri() . '/css/appearance.css' );

	wp_enqueue_script('carousel', get_stylesheet_directory_uri() . '/js/carousel.js', array('jquery'));
}

add_action('wp_enqueue_scripts', 'oxpeckers_scripts', 100);

function home_page_query($query) {
	if($query->is_main_query() && (is_front_page() || is_home())) {
		$query->set('category_name', 'oxpeckers-investigations');
		$query->set('posts_per_page', 4);
	}
	return $query;
}
add_action('pre_get_posts', 'home_page_query');

function map_marker_query($query) {
	if(is_front_page() || is_home())
		$query = new WP_Query();

	return $query;
}
add_filter('jeo_marker_base_query', 'map_marker_query');


add_theme_support( 'post-thumbnails' );
add_image_size( 'highlights-thumb', 140, 140 );
add_image_size( 'small-thumb', 100, 100 );

include_once(STYLESHEETPATH . '/inc/print/print.php');
include_once(STYLESHEETPATH . '/inc/rhino-crisis/rhino-crisis.php');
include_once(STYLESHEETPATH . '/inc/geocode-box.php');
include_once(STYLESHEETPATH . '/inc/submit-story.php');

?>