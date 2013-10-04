<?php

/*** Oxpeckers styles ***/
function oxpeckers_scripts() {
	wp_enqueue_style( 'text', get_stylesheet_directory_uri() . '/css/text.css' );
	wp_enqueue_style( 'slider', get_stylesheet_directory_uri() . '/css/slider.css' );
	wp_enqueue_style( 'mapcontrol', get_stylesheet_directory_uri() . '/css/mapcontrol.css' );
	wp_enqueue_style( 'appearance', get_stylesheet_directory_uri() . '/css/appearance.css' );
	
	//wp_enqueue_script( 'script-name', get_template_directory_uri() . '/js/example.js', array(), '1.0.0', true );
}

add_action( 'wp_enqueue_scripts', 'oxpeckers_scripts' );

add_theme_support( 'post-thumbnails' );

include_once(STYLESHEETPATH . '/inc/print/print.php');
include_once(STYLESHEETPATH . '/inc/rhino-data/data.php');

?>