<?php get_header(); ?>

<?php if(have_posts()) : the_post(); ?>
		<div class="container">
        
        <div class="main-content">
       	<section id="content" class="single-post">
		<!--<header class="single-post-header">
	
				<div class="twelve columns">-->
				<!--</div>
			</div>
		</header>-->
		<!--<div class="container">-->
			<div class="content emboss">
					<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>
			</div>
			<!--<div class="three columns offset-by-one">-->
				<aside id="sidebar">
					<ul class="widgets">
						<?php dynamic_sidebar('post'); ?>
					</ul>
				</aside>
			<!--</div>-->
	</section>
    	</div>
		</div>
<?php endif; ?>

<?php get_footer(); ?>