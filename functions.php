<?php

/*** Oxpeckers styles ***/
function oxpeckers_scripts() {
	wp_enqueue_style( 'text', get_stylesheet_directory_uri() . '/css/text.css' );
	wp_enqueue_style( 'slider', get_stylesheet_directory_uri() . '/css/slider.css' );
	wp_enqueue_style( 'mapcontrol', get_stylesheet_directory_uri() . '/css/mapcontrol.css' );
	wp_enqueue_style( 'appearance', get_stylesheet_directory_uri() . '/css/appearance.css' );
	
	//wp_enqueue_script( 'script-name', get_template_directory_uri() . '/js/example.js', array(), '1.0.0', true );
}

add_action('wp_enqueue_scripts', 'oxpeckers_scripts', 100);

function home_page_query($query) {
	if($query->is_main_query() && (is_front_page() || is_home())) {
		$query->set('cat', 5);
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
add_image_size( 'medium', 300, 140, true );
add_image_size( 'post-thumb', 300, 140, true );
add_image_size( 'highlights-thumb', 140, 140, true );
add_image_size( 'small-thumb', 100, 100, true );

include_once(STYLESHEETPATH . '/inc/print/print.php');
include_once(STYLESHEETPATH . '/inc/rhino-crisis/rhino-crisis.php');

?>