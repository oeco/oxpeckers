<?php get_header(); ?>

<?php if(have_posts()) : the_post(); ?>

	<?php jeo_map(); ?>

			<div class="container">
				<div class="section-title emboss">
					<h1><?php the_title(); ?></h1>
						<p class="credits"><span class="lsf">&#xE137;</span> <?php _e('by', 'jeo'); ?> <?php the_author(); ?> | <span class="lsf">&#xE12b;</span> <?php the_date(); ?>
					<?php
					$print_url = oxpeckers_get_print_url();
					if($print_url) : ?>
						<span class="lsf">&#xE10a;</span> <a class="print" href="<?php echo $print_url; ?>"><?php _e('Print this map', 'oxpeckers'); ?></a>
					<?php endif; ?></p>
					<?php the_category(); ?>
				</div>
                
                <div class="main-content">
                
	<article id="content" class="single-post">

		<section class="content emboss">

					<p class="location"><?php the_field('post_location'); ?></p>

					<?php the_content(); ?>

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