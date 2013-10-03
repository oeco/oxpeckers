<?php get_header(); ?>

<?php if(have_posts()) : the_post(); ?>

	<?php jeo_map(); ?>

			<div class="container">
				<div class="section-title emboss">
					<h1><?php the_title(); ?></h1>
						<p class="credits"><span class="lsf">&#xE137;</span> <?php _e('by', 'jeo'); ?> <?php the_author(); ?> | <span class="lsf">&#xE12b;</span> <?php the_date(); ?></p>
					<?php the_category(); ?>
				</div>
                
                <div class="main-content">
                
	<article id="content" class="single-post">

		<section class="content emboss">

					<?php the_content(); ?>

					<p class="location"><?php the_field('post_location'); ?></p>

					<a href="<?php the_field('get_the_data'); ?>" class="associated"><?php _e('Download the Data', 'jeo'); ?></a>
					<a href="<?php the_field('related_document'); ?>" class="associated"><?php _e('Related Document', 'jeo'); ?></a>

		</section>
					<aside id="sidebar">
						<ul class="widgets">
							<?php dynamic_sidebar('post'); ?>
						</ul>
					</aside>
	</article>
    
    </div>
    </div>

<?php endif; ?>

<?php get_footer(); ?>