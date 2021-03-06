<?php

/*** Oxpeckers styles ***/
function oxpeckers_scripts() {
	wp_enqueue_style( 'text', get_stylesheet_directory_uri() . '/css/text.css' );
	wp_enqueue_style( 'slider', get_stylesheet_directory_uri() . '/css/slider.css' );
	wp_enqueue_style( 'mapcontrol', get_stylesheet_directory_uri() . '/css/mapcontrol.css' );
	wp_enqueue_style( 'appearance', get_stylesheet_directory_uri() . '/css/appearance.css' );

	wp_enqueue_script('carousel', get_stylesheet_directory_uri() . '/js/carousel.js', array('jquery'));
	wp_enqueue_script('frontend', get_stylesheet_directory_uri() . '/js/frontend.js', array('jquery'));
}

add_action('wp_enqueue_scripts', 'oxpeckers_scripts', 100);

function oxpeckers_home_page_query($query) {
	if($query->is_main_query() && (is_front_page() || is_home())) {
		$query->set('category_name', 'investigations');
		$query->set('posts_per_page', 4);
	}
	return $query;
}
add_action('pre_get_posts', 'oxpeckers_home_page_query');

function oxpeckers_map_marker_query($query) {
	if(is_front_page() || is_home())
		$query = new WP_Query();

	return $query;
}
add_filter('jeo_marker_base_query', 'oxpeckers_map_marker_query');

function oxpeckers_register_sidebar() {

	register_sidebar(array(
		'name' => __('Featured links bar', 'oxpeckers'),
		'id' => 'featured_links',
		'before_widget' => '<div class="featured-link"><div class="widget-content clearfix emboss">',
		'after_widget' => '</div></div>',
		'before_title' => '<h2 style="display: none;">',
		'after_title' => '</h2>'
	));

}
add_action('widgets_init', 'oxpeckers_register_sidebar');


add_theme_support( 'post-thumbnails' );
add_image_size( 'medium-thumb', 300, 140, true );
add_image_size( 'highlights-thumb', 140, 140, true );
add_image_size( 'small-thumb', 100, 100, true );

include_once(STYLESHEETPATH . '/inc/print/print.php');
include_once(STYLESHEETPATH . '/inc/rhino-crisis/rhino-crisis.php');
include_once(STYLESHEETPATH . '/inc/geocode-box.php');
include_once(STYLESHEETPATH . '/inc/submit-story.php');

/*
 * Include related posts to post content
 */

function oxpeckers_related_posts_content($content) {

	global $post;
	$related_posts = get_field('related_posts');

	$output = '';
	if($related_posts) {
		$output .= '<h3>Related content</h3>';
		$output .= '<ul class="related-posts">';
		foreach($related_posts as $r_post) {

			$post = $r_post;
			setup_postdata($post);

			$output .= '<li>';

			$output .= '<h4><a href="' . get_permalink() . '" title="' . get_the_title() . '">' . get_the_title() . '</a></h4>';
			$output .= '<p>' . get_the_excerpt() . '</p>';

			$output .= '</li>';

			wp_reset_postdata();

		}
		$output .= '</ul>';
	}

	$content = $content . $output;

	return $content;

}
add_filter('the_content', 'oxpeckers_related_posts_content');

function oxpeckers_markerclusterer_options($options) {

	$options['maxClusterRadius'] = 20;

	return $options;
}
add_filter('jeo_markerclusterer_options', 'oxpeckers_markerclusterer_options');


function oxpeckers_disable_share_map_menu() {
	return true;
}
add_filter('jeo_disable_share_map_menu', 'oxpeckers_disable_share_map_menu');
?>