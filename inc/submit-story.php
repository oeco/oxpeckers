<?php

/*
 * Submit story
 */

function oxpeckers_submit_scripts() {
	wp_enqueue_style('oxpeckers-submit-story', get_stylesheet_directory_uri() . '/css/submit-story.css');
	wp_enqueue_script('oxpeckers-submit-story', get_stylesheet_directory_uri() . '/js/submit-story.js', array('jquery','geocode-box'));

	wp_localize_script('oxpeckers-submit-story', 'infoamazonia_submit', array(
		'ajaxurl' => admin_url('admin-ajax.php'),
		'success_label' => __('Success! Thank you, your story will be reviewed by one of our editors and soon will be online.', 'oxpeckers'),
		'redirect_label' => __('You\'re being redirect to the home page in 4 seconds.', 'oxpeckers'),
		'home' => home_url('/'),
		'error_label' => __('Oops, please try again in a few minutes.', 'oxpeckers')
	));
}
add_action('wp_enqueue_scripts', 'oxpeckers_submit_scripts');

add_action('wp_footer', 'oxpeckers_submit');
function oxpeckers_submit() {
	?>
	<div id="submit-story">
		<div class="submit-container">
			<div class="submit-area">
				<a href="#" class="close-submit-story" title="<?php _e('Close', 'oxpeckers'); ?>">×</a>
				<h2><?php _e('Submit a story', 'oxpeckers'); ?></h2>
				<p class="description"><?php _e('Do you have news to share? Contribute to this map by submitting your story.', 'oxpeckers'); ?></p>
				<div class="submit-content">
					<div class="error"></div>
					<div class="choice">
						<div class="story-type">
							<a href="#" data-choice="submit-story-url" class="button"><?php _e('Submit a url', 'oxpeckers'); ?></a>
							<a href="#" data-choice="submit-story-full" class="button"><?php _e('Submit full story', 'oxpeckers'); ?></a>
						</div>
					</div>
					<form id="submit-story-full" class="submit-choice-content">
						<input type="hidden" name="action" value="oxpeckers_submit" />
						<p>
							<label for="story_author_full_name"><?php _e('Your full name', 'oxpeckers'); ?> <span class="required">*</span></label>
							<input type="text" name="story[meta][author_name]" id="story_author_full_name" size="30" />
						</p>
						<p>
							<label for="story_author_email"><?php _e('E-mail', 'oxpeckers'); ?> <span class="required">*</span></label>
							<input type="text" name="story[meta][author_email]" id="story_author_email" size="35" />
						</p>
						<p>
							<label for="story_title"><?php _e('Story title', 'oxpeckers'); ?> <span class="required">*</span></label>
							<input type="text" name="story[post][post_title]" id="story_title" size="30" />
						</p>
						<p>
							<label for="story_content"><?php _e('Story text', 'oxpeckers'); ?></label>
							<textarea name="story[post][post_content]" id="story_content" rows="7" cols="50"></textarea>
						</p>
						<p>
							<label for="story_url"><?php _e('Story url', 'oxpeckers'); ?></label>
							<input type="text" name="story[meta][url]" id="story_url" size="60" />
						</p>
						<p>
							<label for="story_picture"><?php _e('Lead picture', 'oxpeckers'); ?></label>
							<input type="text" name="story[meta][picture]" id="story_picture" size="60" />
						</p>
						<div class="geocode">
							<p>
								<label for="story_location"><?php _e('Story location', 'oxpeckers'); ?></label>
								<input type="text" name="story[meta][geocode_address]" id="story_location" class="geocoded-address" size="40" />
								<a class="button open-geocode-box" href="#"><?php _e('Find location on map', 'oxpeckers'); ?></a>
								<div class="geocode-result" style="display:none;">
									<input type="hidden" name="story[meta][geocode_latitude]" class="geocoded-latitude" />
									<input type="hidden" name="story[meta][geocode_longitude]" class="geocoded-longitude" />
									<p>
										<?php _e('Latitude:', 'oxpeckers'); ?> <span class="geocoded-latitude"></span><br/>
										<?php _e('Longitude:', 'oxpeckers'); ?> <span class="geocoded-longitude"></span>
									</p>
								</div>
								<script type="text/javascript">
									jQuery(document).ready(function($) { $('#submit-story .geocode').oxpeckersGeocodeBox(); });
								</script>
							</p>
						</div>
						<p>
							<label for="story_date"><?php _e('Publishing date', 'oxpeckers'); ?></label>
							<input type="text" name="story[meta][publish_date]" id="story_date" size="20" />
						</p>
						<p>
							<label for="story_notes"><?php _e('Notes to the oxpeckers editor', 'oxpeckers'); ?></label>
							<textarea name="story[meta][notes]" id="story_notes" rows="7" cols="50"></textarea>
						</p>
						<input class="button" type="submit" value="<?php _e('Send story', 'oxpeckers'); ?>" />
					</form>
					<form id="submit-story-url" class="submit-choice-content">
						<input type="hidden" name="action" value="oxpeckers_submit" />
						<p>
							<label for="story_full_name"><?php _e('Your full name', 'oxpeckers'); ?> <span class="required">*</span></label>
							<input type="text" name="story[meta][author_name]" id="story_full_name" size="30" />
						</p>
						<p>
							<label for="story_email"><?php _e('E-mail', 'oxpeckers'); ?> <span class="required">*</span></label>
							<input type="text" name="story[meta][author_email]" id="story_email" size="35" />
						</p>
						<p>
							<label for="story_url"><?php _e('Story url', 'oxpeckers'); ?></label>
							<input type="text" name="story[meta][url]" id="story_url" size="60" />
						</p>
						<div class="geocode">
							<p>
								<label for="story_location"><?php _e('Story location', 'oxpeckers'); ?></label>
								<input type="text" name="story[meta][geocode_address]" id="story_location" class="geocoded-address" size="40" />
								<a class="button open-geocode-box" href="#"><?php _e('Find location on map', 'oxpeckers'); ?></a>
								<div class="geocode-result" style="display:none;">
									<input type="hidden" name="story[meta][geocode_latitude]" class="geocoded-latitude" />
									<input type="hidden" name="story[meta][geocode_longitude]" class="geocoded-longitude" />
									<p>
										<?php _e('Latitude:', 'oxpeckers'); ?> <span class="geocoded-latitude"></span><br/>
										<?php _e('Longitude:', 'oxpeckers'); ?> <span class="geocoded-longitude"></span>
									</p>
								</div>
								<script type="text/javascript">
									jQuery(document).ready(function($) { $('#submit-story .geocode').oxpeckersGeocodeBox(); });
								</script>
							</p>
						</div>
						<input class="button" type="submit" value="<?php _e('Send story', 'oxpeckers'); ?>" />
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php
}

add_action('wp_ajax_nopriv_oxpeckers_submit', 'oxpeckers_submit_post');
add_action('wp_ajax_oxpeckers_submit', 'oxpeckers_submit_post');
function oxpeckers_submit_post() {
	$story = $_GET['story'];
	$return = array();

	$post = $story['post'];
	$post['post_status'] = 'pending';
	if(!isset($post['post_title']))
		$post['post_title'] = 'Submission by ' . $story['meta']['author_name'];

	if(!$story['meta']['author_name'] || !$story['meta']['author_email'])
		return json_death(array('error' => __('Missing information. Please fill all the required fields!', 'oxpeckers')));

	$post_id = wp_insert_post($post);
	if($post_id) {
		foreach($story['meta'] as $meta => $value) {
			update_post_meta($post_id, $meta, $value);
		}
		$return['post_id'] = $post_id;
	} else {
		$return['error'] = __('Could not save submission', 'oxpeckers');
	}

	header('Content Type: application/json');
	echo json_encode($return);
	exit;
}

function json_death($o) {
	header('Content Type: application/json');
	echo json_encode($o);
	exit;
}