<?php get_header(); ?>

<?php jeo_map() ?>

<?php
if(is_home() || is_front_page()) {
	//get_template_part('content', 'mapfeatured');
} 
?>

<div class="feature-section">
	<?php
	if(is_home() || is_front_page()) {
		$wfb = get_posts(array('post_type' => 'wp-feature-box', 'posts_per_page' => 2));
		if($wfb) {
			if(count($wfb) === 1) {
				$wfb = array_shift($wfb);
				echo get_feature_box($wfb->ID);
			} else {
				echo get_feature_box_slider(false);
			}
		} else {
			get_template_part('content', 'highlights');
		}
	}
	?>
</div>

<?php if(is_active_sidebar('featured_links')) : ?>
	<div class="featured-links clearfix">
		<?php dynamic_sidebar('featured_links'); ?>
	</div>
<?php endif; ?>

<div class="container">

	<div class="main-content">

		<div class="content-container emboss">

			<h2><?php _e('Oxpeckers Investigations', 'jeo'); ?></h2>

			<?php
			$investigation_cat = get_category_by_slug('investigations');
			$investigations = get_categories(array('child_of' => $investigation_cat->term_id, 'hide_empty' => false, 'number' => 4));
			if($investigations) :
				?>
				<div class="investigations-cats clearfix">
					<ul>
						<?php
						foreach($investigations as $investigation) : 
							$img = get_field('cat_image', 'category_' . $investigation->term_id);
							?>
								<li class="<?php echo $investigation->slug; ?> investigation row">
									<?php if($img) : ?>
										<div class="investigation-thumb-container">
											<a href="<?php echo get_term_link($investigation); ?>" title="<?php echo $investigation->name; ?>"><img src="<?php echo $img['sizes']['medium-thumb']; ?>" class="investigation-thumb" /></a>
										</div>
									<?php endif; ?>
									<h3><a href="<?php echo get_term_link($investigation); ?>" title="<?php echo $investigation->name; ?>"><?php echo $investigation->name; ?></a></h3>
									<p class="cat_description"><?php echo $investigation->description; ?></p>
									<p class="readmore"><a href="<?php echo get_term_link($investigation); ?>"><?php _e('Read more', 'oxpeckers'); ?></a></p>
								</li>
							<?php
						endforeach;
						?>
					</ul>
					<p class="view-all"><a href="<?php echo get_term_link($investigation_cat); ?>"><?php _e('View all investigations', 'oxpeckers'); ?></a></p>
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
					box-sizing: border-box;
					-moz-box-sizing: border-box;
					-webkit-box-sizing: border-box;
					-khtml-box-sizing: border-box;
				}
				.investigations-cats ul li .investigation-thumb-container {
					float: left;
					margin: 0 20px 20px 0;
				}
				.investigations-cats ul li .investigation-thumb-container img {
					max-width: 100%;
				}
			</style>

			<?php // get_template_part('loop'); ?>

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