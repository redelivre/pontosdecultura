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

			<footer id="colophon" class="site-footer" role="contentinfo">
				<?php if ( is_active_sidebar( 'sidebar-footer' ) ) : ?>
					<section id="tertiary" class="widget-area widget-area--footer" role="complementary">
							<?php dynamic_sidebar( 'sidebar-footer' ); ?>
					</section><!-- #tertiary -->
				<?php endif; ?>
				<div class="site-info">
					<a href="<?php echo esc_url( __( 'http://wordpress.org/', '_s' ) ); ?>"><?php printf( __( 'Proudly powered by %s', '_s' ), 'WordPress' ); ?></a>
				</div><!-- .site-info -->
			</footer><!-- #colophon .site-footer -->
			
		</div><!-- .site-wrapper -->
	</div><!-- .container --> 

<?php wp_footer(); ?>
</body>
</html>
