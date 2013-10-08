<?php

/*
 * Geocode box
 */

function oxpeckers_geocode_box_scripts() {
	wp_enqueue_script('geocode-box', get_stylesheet_directory_uri() . '/js/geocode-box.js', array('jquery', 'jeo.geocode.box'), '0.0.3');
}
add_action('wp_enqueue_scripts', 'oxpeckers_geocode_box_scripts');

add_action('wp_footer', 'oxpeckers_geocode_box');
function oxpeckers_geocode_box() {
	?>
	<div id="geocode-box">
		<div class="geocode-box-container">
			<a href="#" class="close-geocode" title="<?php _e('Close', 'oxpeckers'); ?>">×</a>
			<?php jeo_geocode_box(); ?>
			<p><a class="button finish-geocode-box" href="#"><?php _e('Finish geocoding', 'oxpeckers'); ?></a></p>
		</div>
	</div>
	<?php
}