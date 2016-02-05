<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Pontos de Cultura
 * @since  Pontos de Cultura 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<h1 class="entry-title"><?php the_title(); ?></h1>

					<div class="entry-meta">
						<?php pontosdecultura_posted_on(); ?>
					</div><!-- .entry-meta -->
				</header><!-- .entry-header -->

				<div class="entry-content">
					<?php the_content(); ?>
					<?php
						wp_link_pages( array(
							'before' => '<div class="page-links">' . __( 'Pages:', 'pontosdecultura' ),
							'after'  => '</div>',
						) );
					?>
				</div><!-- .entry-content -->

				<footer class="entry-footer">
					<?php
						/* translators: used between list items, there is a space after the comma */
						$category_list = get_the_category_list( __( ', ', 'pontosdecultura' ) );

						/* translators: used between list items, there is a space after the comma */
						$tag_list = get_the_tag_list( '', __( ', ', 'pontosdecultura' ) );

						if ( ! pontosdecultura_categorized_blog() ) {
							// This blog only has 1 category so we just need to worry about tags in the meta text
							if ( '' != $tag_list ) {
								$meta_text = __( 'Esta entrada foi etiquetada como %2$s. Guarde o <a href="%3$s" rel="bookmark">permalink</a>.', 'pontosdecultura' );
							} else {
								$meta_text = __( 'Guarde o <a href="%3$s" rel="bookmark">permalink</a>.', 'pontosdecultura' );
							}

						} else {
							// But this blog has loads of categories so we should probably display them here
							if ( '' != $tag_list ) {
								$meta_text = __( 'Esta entrada foi publicada em %1$s e etiquetada como %2$s. Guarde o <a href="%3$s" rel="bookmark">permalink</a>.', 'pontosdecultura' );
							} else {
								$meta_text = __( 'Esta entrada foi publicada em %1$s. Guarde o <a href="%3$s" rel="bookmark">permalink</a>.', 'pontosdecultura' );
							}

						} // end check for categories on this blog
					?>

					<div class="sharing">
						<p class="borda-cor-1">
							<?php _e('Compartilhe', 'pontosdecultura'); ?>
							<span><?php _e('este post nas redes sociais',
									'pontosdecultura'); ?></span>
						</p>

						<a class="share share-twitter" title="<?php
								_e('Twitter', 'pontosdecultura');
							?>" href="http://twitter.com/intent/tweet?original_referer=<?php
								the_permalink();
							?>&text=<?php
								echo $post->post_title;
							?>&url=<?php
								echo get_permalink();
							?>" rel="nofollow" target="_blank"><span><?php
								_e('Twitter', 'pontosdecultura');
							?></span></a>
						<a class="share share-facebook" title="<?php
								_e('Facebook', 'pontosdecultura');
							?>" href="https://www.facebook.com/sharer.php?u=<?php
								the_permalink();
							?>" rel="nofollow" target="_blank"><span><?php
								_e('Facebook', 'pontosdecultura');
							?></span></a>
						<a class="share share-googleplus" title="<?php
								_e('Google+', 'pontosdecultura');
							?>" href="https://plus.google.com/share?url=<?php
								the_permalink();
							?>" rel="nofollow" target="_blank"><span><?php
								_e('Google+', 'pontosdecultura');
							?></span></a>
					</div>

					<?php
						printf(
							$meta_text,
							$category_list,
							$tag_list,
							get_permalink()
						);
					?>

					<?php edit_post_link( __( 'Edit', 'pontosdecultura' ), '<span class="edit-link">', '</span>' ); ?>
				</footer><!-- .entry-footer -->
			</article><!-- #post-## -->

			<?php the_post_navigation(); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
