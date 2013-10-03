<?php

/*
 * Oxpeckers
 * Print
 */

class Oxpeckers_Print {

	function __construct() {

		add_action('init', array($this, 'init'));

	}

	function init() {

		add_filter('query_vars', array($this, 'query_vars'));
		add_action('template_redirect', array($this, 'template_redirect'));

	}

	function query_vars($vars) {
		$vars[] = 'print';
		return $vars;
	}

	function template_redirect() {
		global $wp_query;
		if($wp_query->get('print') && is_single()) {
			wp_enqueue_style('oxpeckers-print', get_stylesheet_directory_uri() . '/inc/print/print.css');
			if(have_posts()) :
				while(have_posts()) :
					the_post();
					$this->template_header();
					?>
					<div id="oxpeckers-print">
						<h2><?php bloginfo('name'); ?></h2>
						<h1><?php the_title(); ?></h1>
						<img src="<?php echo $this->get_map_image_url(); ?>" />
						<?php
						/*
						$legend = jeo_get_map_legend($map_id);
						if($legend)
							echo '<div id="print-legend">' . $legend . '</div>';
						*/
						?>
						<?php the_content(); ?>
					</div>
					<script type="text/javascript">
						jQuery(document).ready(function($) {
							$('body').imagesLoaded(function() {
								window.print();
							});
						});
					</script>
					<?php
					$this->template_footer();
				endwhile;
			endif;
			exit;
		}
	}

	function template_header() {
		?>
		<!DOCTYPE html>
		<html <?php language_attributes(); ?>>
		<head>
		<meta charset="<?php bloginfo('charset'); ?>" />
		<title><?php
			global $page, $paged;

			wp_title( '|', true, 'right' );

			bloginfo( 'name' );

			$site_description = get_bloginfo('description', 'display');
			if ( $site_description && ( is_home() || is_front_page() ) )
				echo " | $site_description";

			/*if ( $paged >= 2 || $page >= 2 )
				echo ' | Página ' . max($paged, $page);*/

			?></title>
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/img/favicon.ico" type="image/x-icon" />
		<?php wp_head(); ?>
		</head>
		<body <?php body_class(get_bloginfo('language')); ?>>
		<?php
	}

	function template_footer() {
		wp_footer();
		?>
		</body>
		</html>
		<?php
	}

	function get_map_image_url() {

		$map_id = jeo_get_the_ID();
		$coordinates = jeo_get_marker_coordinates();

		// print image url
		$print_settings = array(
			'map_id_or_layers' => false,
			'lat' => null,
			'lon' => null,
			'zoom' => null
		);
		
		$print_settings['map_id_or_layers'] = $map_id;

		$print_settings['lat'] = $coordinates[1];
		$print_settings['lon'] = $coordinates[0];
		$print_settings['zoom'] = jeo_get_map_max_zoom();

		$image_url = jeo_get_mapbox_image($print_settings['map_id_or_layers'], 640, 400, $print_settings['lat'], $print_settings['lon'], $print_settings['zoom']);

		return $image_url;

	}

	function get_print_url($post_id = false) {

		global $post;
		$post_id = $post_id ? $post_id : $post->ID;

		return add_query_arg(array('print' => 1), get_permalink($post_id));

	}

}

$GLOBALS['oxpeckers_print'] = new Oxpeckers_Print();

function oxpeckers_get_print_url($post_id = false) {
	return $GLOBALS['oxpeckers_print']->get_print_url($post_id);
}