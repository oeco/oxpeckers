<?php get_header(); ?>

<?php jeo_map() ?>

<?php
if(is_home() || is_front_page()) {
	//get_template_part('content', 'mapfeatured');
} 
?>

<?php
if(is_home() || is_front_page()) {
	get_template_part('content', 'highlights');
}
?>

<div class="container">

	<div class="main-content">

		<div class="<?php if( is_front_page()) { echo "latestnews emboss"; } ?>">
			<h2><?php _e('Oxpeckers Investigations', 'jeo'); ?></h2>
			<?php get_template_part('loop'); ?>

			<?php query_posts(array('cat' => 3)); ?>
			<div class="more-stories">
				<h3><?php _e('More stories', 'jeo'); ?></h3>
				<?php get_template_part('loop', 'small'); ?>
			</div>
			<?php wp_reset_query(); ?>
		</div>


		<aside id="sidebar">
			<ul class="widgets">
				<?php dynamic_sidebar('front_page'); ?>
			</ul>
		</aside>
    
    </div>

</div>

<div class="partners">
    <div class="ami">AMI</div>
    <div class="chinaafrica">China Africa Reporting Project</div>
    <div class="fair">Fair</div>
    <div class="hacks">HacksHackers Africa</div>
</div>

<?php get_footer(); ?>