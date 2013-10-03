<footer id="sidebar-footer">
	<div class="container">
    
					<aside id="sidebar-footer">
						<ul class="widgets">
							<?php dynamic_sidebar('general'); ?>
						</ul>
					</aside>

		<div class="footer-menu">
			<nav id="footer-nav">
				<?php wp_nav_menu(array('theme_location' => 'footer_menu')); ?>
			</nav>
		<!--</div>
		<div class="five columns">-->
			<div class="credits">
				<p class="credits"><?php printf(__('This website is built on <a href="%s" target="_blank" rel="external">WordPress</a> using the <a href="%s" target="_blank" rel="external">JEO Beta</a> theme', 'jeo'), 'http://wordpress.org', 'http://jeo.cardume.art.br/'); ?></p>
			</div>
		<!--</div>-->
	</div>
</footer>
</div><!-- end oxbody -->
<?php wp_footer(); ?>
</body>
</html>