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
					<img src="http://maps.googleapis.com/maps/api/staticmap?center=-14.850268,-40.836254&zoom=14&size=1200x200&scale=2&sensor=false" />
					<h1 class="entry-title"><?php the_title(); ?></h1>

					<div class="entry-meta">
						<em>Área cultural</em> Dança / Teatro / Eventos<br/>
						<em>Público alvo</em> Público geral, idosos, estudantes
					</div><!-- .entry-meta -->

				</header><!-- .entry-header -->

				<div class="entry-contact-info">
					<ul>
						<li>Endereço</li>
						<li>Telefone</li>
						<li>email@email.com</li>
						<li>Twitter</li>
					</ul>
				</div>

				<div class="entry-content clearfix">
					<?php the_content(); ?>
					<?php
						wp_link_pages( array(
							'before' => '<div class="page-links">' . __( 'Pages:', 'pontosdecultura' ),
							'after'  => '</div>',
						) );
					?>
				</div><!-- .entry-content -->

				<footer class="entry-footer clearfix">
					<?php
						/* translators: used between list items, there is a space after the comma */
						$category_list = get_the_category_list( __( ', ', 'pontosdecultura' ) );

						/* translators: used between list items, there is a space after the comma */
						$tag_list = get_the_tag_list( '', __( ', ', 'pontosdecultura' ) );

						if ( ! pontosdecultura_categorized_blog() ) {
							// This blog only has 1 category so we just need to worry about tags in the meta text
							if ( '' != $tag_list ) {
								$meta_text = __( 'This entry was tagged %2$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'pontosdecultura' );
							} else {
								$meta_text = __( 'Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'pontosdecultura' );
							}

						} else {
							// But this blog has loads of categories so we should probably display them here
							if ( '' != $tag_list ) {
								$meta_text = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'pontosdecultura' );
							} else {
								$meta_text = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'pontosdecultura' );
							}

						} // end check for categories on this blog

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

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>