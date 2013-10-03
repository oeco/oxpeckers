<?php get_header(); ?>

<?php jeo_map() ?>

<?php
if(is_home() || is_front_page()) {
	get_template_part('content', 'mapfeatured');
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
		<!--<div class="twelve columns">-->
			<h2><?php _e('Latest articles', 'jeo'); ?></H2>
		<!--</div>-->
<?php get_template_part('loop'); ?>
</div>

	<aside id="sidebar">
		<ul class="widgets">
			<?php dynamic_sidebar('front_page'); ?>
		</ul>
	</aside>
    
    </div>
</div>

<?php get_footer(); ?>