<div class="container">
<?php query_posts(array('cat' => 2, 'posts_per_page' => 4)); ?>
	<?php if(have_posts()) : the_post(); ?>
		<section id="highlight-content" class="highlight-content">
			<h2>Highlights</h2>
				<div class="highlights-content">
					<ul class="highlights-list">
						<?php $class = 'slider-item'; ?>
						<?php $i = 0; while(have_posts()) : the_post(); ?>
							<?php $active = $i >= 1 ? '' : ' active'; ?>
							<li id="post-<?php the_ID(); ?>" <?php post_class($class . ' ' . $active); ?>>
								<article id="post-<?php the_ID(); ?>">
									<div class="thumb-highlights">
										<?php 
											if (has_post_thumbnail()) { // check if the post has a Post Thumbnail assigned to it.
												the_post_thumbnail(array(140,140));
											} 
										?>
									</div>
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
										<a href="<?php the_permalink(); ?>" class="associated"><?php _e('Read more', 'jeo'); ?></a>
										<a href="<?php the_field('get_the_data'); ?>" class="associated"><?php _e('Download the Data', 'jeo'); ?></a>
										<a href="<?php the_field('related_document'); ?>" class="associated"><?php _e('Related Document', 'jeo'); ?></a>
									</aside>
								</article>
							</li>
						<?php $i++; endwhile; ?>
					</ul>
				</div>
				<div class="slider-controllers">
						<ul>
							<?php $i = 0; while(have_posts()) : the_post(); $i++; ?>
								<li class="slider-item-controller" data-postid="post-<?php the_ID(); ?>" title="<?php _e('Go to', 'jeo'); ?> <?php the_title(); ?>"><?php _e('Go to', 'jeo'); ?> <?php the_title(); ?></li>
							<?php endwhile; ?>
						</ul>
				</div>
		</section>
		<script type="text/javascript">
			//jeo.ui.featuredSlider('highlights-content');
		</script>
	<?php endif; ?>
<?php wp_reset_query(); ?>
</div>