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

				
			</div><!-- #content .site-content -->

			<footer id="colophon" class="site-footer site-area" role="contentinfo">
				<div class="container">
					<?php if ( is_active_sidebar( 'sidebar-footer' ) ) : ?>
						<section id="tertiary" class="widget-area widget-area--footer" role="complementary">
								<?php dynamic_sidebar( 'sidebar-footer' ); ?>
						</section><!-- #tertiary -->
					<?php endif; ?>
					<div class="site-info">
						<a href="<?php echo esc_url( __( 'http://wordpress.org/', '_s' ) ); ?>"><?php printf( __( 'Proudly powered by %s', '_s' ), 'WordPress' ); ?></a>
					</div><!-- .site-info -->

					<nav role="navigation" class="site-navigation secondary-navigation">
						<?php wp_nav_menu( array( 'theme_location' => 'secondary' ) ); ?>
					</nav><!-- .site-navigation .main-navigation -->
				</div><!-- .container --> 
			</footer><!-- #colophon .site-footer -->
			
		</div><!-- .site-wrapper -->

<?php wp_footer(); ?>
</body>
</html>
