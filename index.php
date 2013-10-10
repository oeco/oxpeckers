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

		<div class="content-container <?php if( is_front_page()) { echo "latestnews emboss"; } ?>">

			<h2><?php _e('Oxpeckers Investigations', 'jeo'); ?></h2>

			<?php
			$investigation_cat = get_category_by_slug('investigations');
			$investigations = get_categories(array('child_of' => $investigation_cat->term_id, 'hide_empty' => false));
			if($investigations) :
				?>
				<div class="investigations-cats clearfix">
					<ul>
						<?php
						foreach($investigations as $investigation) : 
							$img = get_field('cat_image', 'category_' . $investigation->term_id);
							?>
								<li class="<?php echo $investigation->slug; ?> investigation">
									<?php if($img) : ?>
										<div class="investigation-thumb-container">
											<a href="<?php echo get_term_link($investigation); ?>" title="<?php echo $investigation->name; ?>"><img src="<?php echo $img['sizes']['thumbnail']; ?>" class="investigation-thumb" /></a>
										</div>
									<?php endif; ?>
									<h3><a href="<?php echo get_term_link($investigation); ?>" title="<?php echo $investigation->name; ?>"><?php echo $investigation->name; ?></a></h3>
									<p><?php echo $investigation->description; ?></p>
									<p><a href="<?php echo get_term_link($investigation); ?>"><?php _e('Read more', 'oxpeckers'); ?></a></p>
								</li>
							<?php
						endforeach;
						?>
					</ul>
				</div>
				<?php
			endif;
			?>
			<style>
				.investigations-cats ul {
					width: 100%;
					margin-top: 20px;
				}
				.investigations-cats ul li {
					text-align: center;
					margin-bottom: 20px;
					width: 50%;
					height: 370px;
					float: left;
					padding: 0 20px;
					box-sizing: border-box;
					-moz-box-sizing: border-box;
					-webkit-box-sizing: border-box;
					-khtml-box-sizing: border-box;
				}
				.investigations-cats ul li img {
					border-radius: 75px;
					margin-bottom: 20px;
				}
			</style>
			<?php get_template_part('loop'); ?>

			<!--<?php //query_posts(array('category_name' => 'reports', 'posts_per_page' => 3)); ?>
			<div class="more-stories">
				<h3><?php //_e('More stories', 'jeo'); ?></h3>
				<?php //get_template_part('loop', 'small'); ?>
			</div>
			<?php wp_reset_query(); ?>-->
		</div>


		<aside id="sidebar">
			<ul class="widgets">
				<?php dynamic_sidebar('front_page'); ?>
			</ul>
		</aside>
    
    </div>

</div>

<?php get_footer(); ?>