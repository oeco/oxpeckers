<div class="partners">
	<h4><?php _e('Partners', 'oxpeckers'); ?></h4>
    <div class="ami">AMI</div>
    <div class="chinaafrica">China Africa Reporting Project</div>
    <div class="ecolab">Ecolab</div>
    <div class="fair">Fair</div>
    <div class="hacks">HacksHackers Africa</div>
</div>

<footer id="sidebar-footer">
	<div class="container">
    
					<aside id="sidebar-footer">
						<ul class="widgets">
							<?php dynamic_sidebar('general'); ?>
						</ul>
					</aside>
</footer>

	<div class="footer-menu">
			<nav id="footer-nav">
				<?php wp_nav_menu(array('theme_location' => 'footer_menu')); ?>
			</nav>


	<div class="clearfix">
		<div class="footer-brands">
			<h4><?php _e('Project by', 'oxpeckers'); ?></h4>
			<div class="ancir">ANCIR</div>
			<div class="anic">ANIC</div>
		</div>


		<div class="credits">
					<p class="credits"><?php printf(__('This website is built on <a href="%s" target="_blank" rel="external">WordPress</a> using the <a href="%s" target="_blank" rel="external">JEO Beta</a> theme', 'jeo'), 'http://wordpress.org', 'http://jeo.cardume.art.br/'); ?></p>
		</div>
	</div>
	
	</div>

</div><!-- end oxbody -->


<?php wp_footer(); ?>
</body>
</html>