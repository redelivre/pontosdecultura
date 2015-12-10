<?php
/**
 * The Header
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Pontos de Cultura
 * @since  Pontos de Cultura 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<link rel="profile" href="http://gmpg.org/xfn/11" />
	    <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<!--[if lt IE 9]>
		<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
		<![endif]-->
		
		<?php wp_head(); ?>
	</head>
	
	<body <?php body_class(); ?>>
		<!--[if lt IE 8]>
		<p class="browse-happy">
		 	<?php _e( 'You are using an <em>outdated</em> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.', 'pontosdecultura' ); ?>
		</p>
		<![endif]-->
	
		<div class="site-wrapper hfeed"  >
			<?php do_action( 'before' ); ?>
			<header id="masthead" class="site-header site-area clearfix" role="banner">
				<div class="container">
					<div class="site-branding">
						<?php $logo_uri = get_theme_mod('banner'); ?>
						<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
							 <img class="site-logo" src="<?php echo $logo_uri; ?>" alt="Logo <?php bloginfo ( 'name' ); ?>" />
						</a>
						<h1 class="site-title screen-reader-text"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<h2 class="site-description screen-reader-text"><?php bloginfo( 'description' ); ?></h2>
					</div><!-- .site-branding -->
					<div class="language-switcher">
						<?php Pontosdecultura::language_selector(); ?>
					</div>
					
					<nav role="navigation" class="site-navigation main-navigation">
						<?php wp_nav_menu( array( 'menu' => 'main', 'theme_location' => 'primary', 'depth' => 1 ) ); ?>
					</nav><!-- .site-navigation .main-navigation -->
				</div><!-- .container -->
			</header><!-- #masthead .site-header -->
		
			<div id="content" class="site-content site-area">
				<?php if ( ! is_home() ) : ?>
				<div class="container">
				<?php endif; ?>
			
