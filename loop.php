<?php if( have_posts()) : ?>
			<ul class="posts-list">
				<?php while(have_posts()) : the_post(); ?>
					<li id="post-<?php the_ID(); ?>" class="post-columns">
						<article id="post-<?php the_ID(); ?>">
							<div class="thumb-post">
							<?php 
								if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
								the_post_thumbnail('medium-thumb');
								} 
							?>
							</div>
						
							<header class="post-header">
								<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
							</header>
							
							<section class="post-content">
								<div class="post-excerpt">
									<?php the_excerpt(); ?>
								</div>
								
							
								<p class="credits">
									by <?php the_author(); ?> | <?php echo get_the_date(); ?></span>
								</p>
							</section>
							<aside class="actions clearfix">
								<?php echo jeo_find_post_on_map_button(); ?>
								<a href="<?php the_permalink(); ?>"><?php _e('Read more', 'jeo'); ?></a>
							</aside>
						</article>
					</li>
				<?php endwhile; ?>
			</ul>

<?php wp_reset_postdata(); ?>

<?php endif; ?>