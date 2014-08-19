<?php
/**
 * The Template for displaying the loop for the post type 'mapa'
 *
 * @package Recid
 * @since  Recid 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<!-- <h1 class="entry-title"><?php the_title(); ?></h1> -->
		<h1 class="entry-title"><?php echo get_post_meta( $post->ID, 'Tema', true ); ?></h1>
		
		<div class="entry-meta">
			<?php pontosdecultura_the_terms( 'acao' ) ; ?>/
			<?php pontosdecultura_the_terms( 'eixo' ) ; ?>/
			<?php pontosdecultura_the_terms( 'sujeito' ); ?>
			</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content clearfix">
		<div class="entry-contact-info">
			<h2>Informações</h2>
			<ul>
				<li>
					<strong>UF / Cidade:</strong>
					<?php pontosdecultura_the_terms( 'territorio' ); ?>
				</li>
				<li>
					<strong>Código:</strong>
					<?php echo get_post_meta( $post->ID, 'Código', true ); ?>
				</li>
				<li>
					<strong>Data da atividade:</strong>
					<?php echo get_post_meta( $post->ID, 'Data da atividade', true ); ?>
				</li>
				<li>
					<strong>Hora:</strong>
					<?php echo get_post_meta( $post->ID, 'Hora', true ); ?>
				</li>
				<li>
					<strong>Educador responsável:</strong>
					<?php echo get_post_meta( $post->ID, 'Educador responsável', true ); ?>
				</li>
				<!-- 
				<li>
					<strong>Tema:</strong>
					<?php //echo get_post_meta( $post->ID, 'Tema', true ); ?>
				</li>
				 -->
				<li>
					<strong>Direito violado/abordado:</strong>
					<?php echo get_post_meta( $post->ID, 'Direito violado/abordado', true ); ?>
				</li>
				<li>
					<strong>Elementos de DH:</strong>
					<?php echo get_post_meta( $post->ID, 'Elementos de DH', true ); ?>
				</li>
				<li>
					<strong>Organizações/parcerias:</strong>
					<?php echo get_post_meta( $post->ID, 'Organizações/parcerias', true ); ?>
				</li>
				<li>
					<strong>Nº de participantes:</strong>
					<?php echo get_post_meta( $post->ID, 'Nº de participantes', true ); ?>
				</li>
				<li>
					<strong>Nº de masculino:</strong>
					<?php echo get_post_meta( $post->ID, 'Nº de masculino', true ); ?>
				</li>
				<li>
					<strong>Nº de feminino:</strong>
					<?php echo get_post_meta( $post->ID, 'Nº de feminino', true ); ?>
				</li>
				<li>
					<strong>Data de chegada:</strong>
					<?php echo get_post_meta( $post->ID, 'Data de chegada', true ); ?>
				</li>
				<li>
					<strong>Sócio economico:</strong>
					<?php echo get_post_meta( $post->ID, 'Sócio economico', true ); ?>
				</li>
				<li>
					<strong>Pendência:</strong>
					<?php echo get_post_meta( $post->ID, 'Pendência', true ); ?>
				</li>
				<li>
					<strong>Data de pagamento:</strong>
					<?php echo get_post_meta( $post->ID, 'Data de pagamento', true ); ?>
				</li>
			</ul>
		</div>
		
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php edit_post_link( __( 'Edit', 'pontosdecultura' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->