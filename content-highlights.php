<div class="container">
<?php $highlights_query = new WP_Query(array('category_name' => 'highlights', 'posts_per_page' => 4)); ?>
	<?php if($highlights_query->have_posts()) : ?>
		<section id="highlight-content" class="highlight-content">
			<h2>Highlights</h2>
				<div class="highlights-content">
					<ul class="highlights-list">
						<?php $class = 'slider-item'; ?>
						<?php while($highlights_query->have_posts()) : $highlights_query->the_post(); ?>
							<li <?php post_class($class); ?> data-sliderid="post-<?php the_ID(); ?>">
								<article id="post-<?php the_ID(); ?>">
									<?php if(has_post_thumbnail()) : ?>
										<div class="thumb-highlights">
											<?php the_post_thumbnail('highlights-thumb'); ?>
										</div>
									<?php endif; ?>
									<div class="post-text">
										<header class="post-header">
											<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
											<!--<p class="credits">on <?php the_field('post_source'); ?> | <?php echo get_the_date(); ?></p>-->								</header>
										<section class="post-content">
											<div class="post-excerpt">
												<?php the_excerpt(); ?>
											</div>
										</section>
									</div>
									<aside class="actions">
										<a href="<?php the_permalink(); ?>" class="associated"><?php _e('Read more', 'jeo'); ?></a>
											<?php
											$data = get_field('get_the_data');
											$document = get_field('related_document');
											?>
											<?php if($data) : ?>
												<a href="<?php echo $data; ?>" class="associated"><?php _e('Download the Data', 'jeo'); ?></a>
											<?php endif; ?>
											<?php if($document) : ?>
												<a href="<?php echo $document; ?>" class="associated"><?php _e('Related Document', 'jeo'); ?></a>
											<?php endif; ?>
									</aside>
								</article>
							</li>
						<?php endwhile; ?>
					</ul>
				</div>
				<div class="slider-controllers">
						<ul>
							<?php while($highlights_query->have_posts()) : $highlights_query->the_post(); ?>
								<li class="slider-item-controller" data-sliderid="post-<?php the_ID(); ?>" title="<?php _e('Go to', 'jeo'); ?> <?php the_title(); ?>"><?php _e('Go to', 'jeo'); ?> <?php the_title(); ?></li>
							<?php endwhile; ?>
						</ul>
				</div>
		</section>
	<?php endif; ?>
<?php wp_reset_query(); ?>
</div>