<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Recid
 * @since  Recid 1.0
 */
?>

				
				<?php if ( ! is_home() ) : ?>
				</div><!-- .container -->
				<?php endif; ?>
			</div><!-- #content .site-content -->

			<?php //if ( is_active_sidebar( 'sidebar-footer' ) ) : ?>
				<section id="tertiary" class="widget-area widget-area--footer" role="complementary">
					<div class="container">
						<?php //dynamic_sidebar( 'sidebar-footer' ); ?>
						<div class="site-supporters">
							<?php $images_url = get_template_directory_uri() . '/images/'; ?>
							<a href="http://camp.org.br" class="supporter-link" target="_blank"><img src="<?php echo $images_url . 'logo-camp.png'; ?>" /></a>
							<a href="http://www.recid.org.br" class="supporter-link" target="_blank"><img src="<?php echo $images_url . 'logo-recid-2.png'; ?>" /></a>
							<a href="http://www.sdh.gov.br" class="supporter-link" target="_blank"><img src="<?php echo $images_url . 'logo-sdh.png'; ?>" /></a>
							<a href="http://www.secretariageral.gov.br" class="supporter-link" target="_blank"><img src="<?php echo $images_url . 'logo-sgpg.png'; ?>" /></a>
							<a href="http://www.brasil.gov.br" class="supporter-link" target="_blank"><img src="<?php echo $images_url . 'logo-governo-federal.png'; ?>" /></a>
						</div>
					</div><!-- .container --> 
				</section><!-- #tertiary -->
			<?php //endif; ?>

			<footer id="colophon" class="site-footer site-area" role="contentinfo">
				<div class="container">
					<nav role="navigation" class="site-navigation footer-navigation clearfix">
						<?php wp_nav_menu( array( 'container' => false, 'theme_location' => 'secondary', 'depth' => 1 ) ); ?>
					</nav><!-- .site-navigation .main-navigation -->

					<div class="site-info">
						<a class="icon-cc" href="<?php echo esc_url( __( 'http://creativecommons.org', 'pontosdecultura' ) ); ?>" title="<?php _e( 'Creative Commons', 'pontosdecultura' ); ?>">
							<span class="screen-reader-text"><?php _e( 'Creative Commons', 'pontosdecultura' ); ?></span>
						</a>
						<a class="icon-wordpress" href="<?php echo esc_url( __( 'http://wordpress.org/', 'pontosdecultura' ) ); ?>" title="<?php printf( __( 'Proudly powered by %s', 'pontosdecultura' ), 'WordPress' ); ?>">
							<span class="screen-reader-text"><?php printf( __( 'Proudly powered by %s', 'pontosdecultura' ), 'WordPress' ); ?></span>
						</a>
						<a class="icon-github" href="<?php echo esc_url( __( 'http://github.com/redelivre/pontosdecultura', 'pontosdecultura' ) ); ?>" title="<?php _e( 'Recid on GitHub', 'pontosdecultura' ); ?>">
							<span class="screen-reader-text"><?php _e( 'GitHub', 'pontosdecultura' ); ?></span>
						</a>
					</div><!-- .site-info -->
				</div><!-- .container --> 
			</footer><!-- #colophon .site-footer -->
			
		</div><!-- .site-wrapper -->

<?php wp_footer(); ?>
</body>
</html>
