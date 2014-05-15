<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Pontos de Cultura
 * @since  Pontos de Cultura 1.0
 */
?>

				
				<?php if ( ! is_home() ) : ?>
				</div><!-- .container -->
				<?php endif; ?>
			</div><!-- #content .site-content -->

			<?php if ( is_active_sidebar( 'sidebar-footer' ) ) : ?>
				<section id="tertiary" class="widget-area widget-area--footer" role="complementary">
					<div class="container">
						<?php //dynamic_sidebar( 'sidebar-footer' ); ?>
						<div class="site-supporters">
							<?php $images_url = get_template_directory_uri() . '/images/'; ?>
							<a href="#" class="supporter-link"><img src="<?php echo $images_url . 'logo-lab.png'; ?>" /></a>
							<a href="#" class="supporter-link"><img src="<?php echo $images_url . 'logo-soylocoporti.png'; ?>" /></a>
							<a href="#" class="supporter-link"><img src="<?php echo $images_url . 'logo-ufpr.png'; ?>" /></a>
							<a href="#" class="supporter-link"><img src="<?php echo $images_url . 'logo-educacao-ufpr.png'; ?>" /></a>
							<a href="#" class="supporter-link"><img src="<?php echo $images_url . 'logo-pontodecultura.png'; ?>" /></a>
							<a href="#" class="supporter-link"><img src="<?php echo $images_url . 'logo-cultura-viva.png'; ?>" /></a>
							<a href="#" class="supporter-link"><img src="<?php echo $images_url . 'logo-scdc.png'; ?>" /></a>
							<a href="#" class="supporter-link"><img src="<?php echo $images_url . 'logo-minc.png'; ?>" /></a>
							<a href="#" class="supporter-link"><img src="<?php echo $images_url . 'logo-governo-federal.png'; ?>" /></a>
						</div>
					</div><!-- .container --> 
				</section><!-- #tertiary -->
			<?php endif; ?>

			<footer id="colophon" class="site-footer site-area" role="contentinfo">
				<div class="container">
					<nav role="navigation" class="site-navigation footer-navigation clearfix">
						<?php wp_nav_menu( array( 'container' => false, 'theme_location' => 'secondary', 'depth' => 1 ) ); ?>
					</nav><!-- .site-navigation .main-navigation -->

					<div class="site-info">
						<a href="<?php echo esc_url( __( 'http://creativecommons.org', 'pontosdecultura' ) ); ?>"><?php _e( 'Creative Commons', 'pontosdecultura' ); ?></a>
						<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'pontosdecultura' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'pontosdecultura' ), 'WordPress' ); ?></a>
					</div><!-- .site-info -->
				</div><!-- .container --> 
			</footer><!-- #colophon .site-footer -->
			
		</div><!-- .site-wrapper -->

<?php wp_footer(); ?>
</body>
</html>
