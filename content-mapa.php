<?php
/**
 * The Template for displaying the loop for the post type 'mapa'
 *
 * @package Pontos de Cultura
 * @since  Pontos de Cultura 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>

		<div class="entry-meta">
			<?php pontosdecultura_the_terms( array('cenico-performativa', 'natureza', 'desdobramentos', 'publico-alvo', 'ressonancias' ) ); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content clearfix">
		<div class="entry-contact-info">
			<h2>Contatos do ponto</h2>
			<ul>
				<li>
					<strong>Entidade responsável:</strong>
					<?php echo get_post_meta( $post->ID, 'Dados da Entidade: Entidade Responsável pelo Projeto', true ); ?>
				<li>
					<strong>Endereço:</strong>
					<?php echo get_post_meta( $post->ID, 'Dados da Entidade: Endereço - Entidade ', true ); ?>
					<?php pontosdecultura_the_terms( 'territorio' ); ?>
				</li>
				<li>
					<strong>Telefone:</strong>
					<?php echo get_post_meta( $post->ID, 'Dados da Entidade: Telefone da Entidade ', true ); ?>
				</li>
				<li><strong>Email:</strong>
				<?php echo get_post_meta( $post->ID, 'Dados da Entidade: Endereço Eletrônico da Entidade (e-mail)', true ); ?>
				</li>
			</ul>
		</div>

		<h2>Informações</h2>

		<h3>Local de atuação do ponto</h3>
		<?php echo get_post_meta( $post->ID, 'Local de Realização das Atividades do Projeto: Município (UF)', true ); ?>

		<h3>Público-alvo</h3>
		<?php pontosdecultura_the_terms( 'publicoalvo' ); ?>
		
		<h3>Objetivos do plano de trabalho</h3>
		<?php the_content(); ?>

		<h3>Resultados</h3>
		<?php echo get_post_meta( $post->ID, 'ATIVIDADES DESENVOLVIDAS NO PROJETO', true ); ?>
		
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php edit_post_link( __( 'Edit', 'pontosdecultura' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->