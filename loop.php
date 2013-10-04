<?php $query = new WP_Query( 'cat=5' ); ?>

<?php if( $query->have_posts()) : ?>
	<!-- <section class="posts-section emboss">
		<div class="container">-->
			<ul class="posts-list">
				<?php while($query->have_posts()) : $query->the_post(); ?>
<!--					<li id="post-<?php //the_ID(); ?>" <?php //post_class('three columns'); ?>>-->
					<li id="post-<?php the_ID(); ?>" class="post-columns">
						<article id="post-<?php the_ID(); ?>">
                        	<div class="thumb-post">
                            <?php 
								if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
								the_post_thumbnail('medium');
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
								<?php //echo jeo_find_post_on_map_button(); ?>
								<a href="<?php the_permalink(); ?>"><?php _e('Read more', 'jeo'); ?></a>
							</aside>
						</article>
					</li>
				<?php endwhile; ?>
			</ul>
		<!--</div>
	</section>-->

<?php wp_reset_postdata(); ?>

<?php endif; ?>