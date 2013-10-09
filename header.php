<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<title><?php
	global $page, $paged;

	wp_title( '|', true, 'right' );

	bloginfo( 'name' );

	$site_description = get_bloginfo('description', 'display');
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/img/favicon.ico" type="image/x-icon" />
<?php wp_head(); ?>
</head>
<body <?php body_class(get_bloginfo('language')); ?>>

<div id="oxbody" class="<?php if( is_front_page() || is_single()) { echo "withmap"; } else { echo "withoutmap"; } ?>">
	<header id="oxmasthead">
		<div class="container">
        <div class="oxheader">
			<!--<div class="four columns">
				<div class="site-meta">-->
					<a href="<?php echo home_url('/'); ?>" title="<?php bloginfo('name'); ?>"><img class="oxpecker-ilus" src="<?php echo get_stylesheet_directory_uri(); ?>/images/oxpecker.png" alt="<?php bloginfo('name'); ?>" /></a>
					<h1>
						<a href="<?php echo home_url('/'); ?>" title="<?php bloginfo('name'); ?>">
							<?php bloginfo('name'); ?>
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png" alt="<?php bloginfo('name'); ?>" />
						</a>
					</h1>
					<!--<h2><?php //bloginfo('description'); ?></h2>
				</div>
			</div>-->
			<!--<div class="eight columns">-->
				<div id="oxmasthead-nav">
					<!--<div class="clearfix">
						<nav id="main-nav">
							<?php //wp_nav_menu(array('theme_location' => 'header_menu')); ?>
						</nav>-->
						<div style="clear:both;">
							<?php get_search_form(); ?>
						</div>
						<a href="https://twitter.com/OxCIEJ" class="twitter-follow-button" data-show-count="false" data-size="large">Follow @OxCIEJ</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
					<!--</div>-->
				</div>
			</div>
        <!--</div>-->
		</div>
	</header>