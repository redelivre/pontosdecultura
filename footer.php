</section><!-- #main .site-main -->

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
			
	</div><!-- .site-wrapper .hfeed .site -->
	
	</div> <!-- Site Container for bootstrap --> 

	<?php wp_footer(); ?>
	</body>
</html>
