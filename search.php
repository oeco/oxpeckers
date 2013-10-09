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

		<div class="content-container emboss">
			<h2><?php printf(__('Search results for %s', 'oxpeckers'), $_GET['s']); ?></h2>
			<?php get_template_part('loop'); ?>
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
    <div class="ecolab">Ecolab</div>
    <div class="fair">Fair</div>
    <div class="hacks">HacksHackers Africa</div>
</div>

<?php get_footer(); ?>