<div class="mapfeat-container">
<?php query_posts(array('cat' => 2, 'posts_per_page' => 4)); ?>
	<?php if(have_posts()) : the_post(); ?>
		<section id="featured-content" class="mapfeatured-content">
			<?php //$map_id = jeo_map(null, false, true); ?>
			
				<!--<div class="eleven columns">
					<h2>Highlights</h2>-->
				<!--</div>
				<div class="four columns">-->
					<div class="featured-content">
						<ul class="featured-list">
							<?php $class = 'slider-item'; ?>
							<?php $i = 0; while(have_posts()) : the_post(); ?>
								<?php $geometry = jeo_get_element_geometry_data(); ?>
								<?php if(!$geometry) continue; ?>
								<?php $active = $i >= 1 ? '' : ' active'; ?>
								<li id="post-<?php the_ID(); ?>" <?php post_class($class . ' ' . $active); ?> <?php echo $geometry; ?> <?php //echo jeo_element_max_zoom(); ?>>
									<article id="post-<?php the_ID(); ?>">
                                    	<div class="post-text">
										<header class="post-header">
											<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
											<p class="credits">on <?php the_field('post_source'); ?> | <?php echo get_the_date(); ?></p>
										</header>
										<section class="post-content">
											<div class="post-excerpt">
												<?php the_excerpt(); ?>
											</div>
										</section>
                                        </div>
										<aside class="actions">
											<a href="<?php the_permalink(); ?>"><?php _e('Read more', 'jeo'); ?></a>
											<!--<a href="<?php the_field('get_the_data'); ?>"><?php _e('Download the Data', 'jeo'); ?></a>
											<a href="<?php the_field('related_document'); ?>"><?php _e('Related Document', 'jeo'); ?></a>-->
										</aside>
									</article>
								</li>
							<?php $i++; endwhile; ?>
						</ul>
					<!--</div>-->
					<div class="slider-controllers">
						<ul>
							<?php $i = 0; while(have_posts()) : the_post(); $i++; ?>
								<?php if(!jeo_get_element_geometry_data()) continue; ?>
								<li class="slider-item-controller" data-postid="post-<?php the_ID(); ?>" title="<?php _e('Go to', 'jeo'); ?> <?php the_title(); ?>"><?php _e('Go to', 'jeo'); ?> <?php the_title(); ?></li>
							<?php endwhile; ?>
						</ul>
				</div>
			<!----></div>
		</section>
		<script type="text/javascript">
			jeo.ui.featuredSlider('highlights-content');
//			jeo.ui.featuredSlider('highlights-content', '<?php //echo $map_id; ?>');
		</script>
	<?php endif; ?>
<?php wp_reset_query(); ?>
</div>