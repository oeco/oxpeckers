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
			$this->template_header();
			?>
			<div id="oxpeckers-print">
				<h2><?php bloginfo('name'); ?></h2>
				<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>
			</div>
			<?php
			$this->template_footer();
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

}