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
						<?php pontosdecultura_the_terms( array( 'artescenicas', 'audiovisual', 'musica', 'artesvisuais', 'patrimoniocultural', 'humanidades' ) ); ?>
					</div><!-- .entry-meta -->
				</header><!-- .entry-header -->

				<div class="entry-content clearfix">
					<div class="entry-contact-info">
						<h2>Contatos do ponto</h2>
						<ul>
							<li>
								<strong>Endereço</strong>
								<?php echo get_post_meta( $post->ID, 'Dados da Entidade: Endereço - Entidade ', true ); ?>
								<?php pontosdecultura_the_terms( 'territorio' ); ?>
							</li>
							<li>
								<strong>Telefone</strong>
								<?php echo get_post_meta( $post->ID, 'Dados da Entidade: Telefone da Entidade ', true ); ?>
							</li>
							<li><strong>Email</strong>
							<?php echo get_post_meta( $post->ID, 'Dados da Entidade: Endereço Eletrônico da Entidade (e-mail)', true ); ?>
							</li>
						</ul>
					</div>

					<h2>Informações</h2>
					<h3>Local de atuação do ponto</h3>
					<h3>Objetivos</h3>
					<?php the_content(); ?>

					<h3>Resultados</h3>
					<?php echo get_post_meta( $post->ID, 'ATIVIDADES DESENVOLVIDAS NO PROJETO', true ); ?>
					
				</div><!-- .entry-content -->

				<footer class="entry-footer">
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