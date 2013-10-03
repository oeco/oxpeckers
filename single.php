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
		<!--<header class="single-post-header" class="clearfix">
				<div class="three columns offset-by-one">
					<div class="post-meta">
						
					</div>
				</div>
				</div>
			</div>
		</header>-->
		<section class="content emboss">
			<!--<div class="container">
				<div class="eight columns">-->
					<?php the_content(); ?>
				<!--</div>
				<div class="three columns offset-by-one">-->
				<!--</div>
			</div>-->
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