<?php
/**
 * The Template for displaying the loop for the post type 'mapa'
 *
 * @package Recid
 * @since  Recid 1.0
 */
?>

<?php
	$custom = get_post_custom($post->ID);
	global $Iniciativa_global;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1> 
		<!-- <h1 class="entry-title"><?php echo get_post_meta( $post->ID, 'Tema', true ); ?></h1>-->
	</header><!-- .entry-header -->

	<div class="entry-content clearfix">
		<div class="entry-contact-info">
			<h2>Informações</h2>
			<ul>
				<li>
					<strong>Data da atividade:</strong>
					<?php echo $Iniciativa_global->get_custom_field( 'Data da atividade', $custom ); ?>
				</li>
				<li>
					<strong>UF / Cidade:</strong>
					<?php pontosdecultura_the_terms( 'territorio' ); ?>
				</li>
				<li>
					<strong>Educador responsável:</strong>
					<?php echo $Iniciativa_global->get_custom_field( 'Educador responsável', $custom ); ?>
				</li>
				<!-- 
				<li>
					<strong>Tema:</strong>
					<?php //echo $Iniciativa_global->get_custom_field( 'Tema', $custom ); ?>
				</li>
				 -->
				<li>
					<strong>Ação em DH:</strong>
					<?php pontosdecultura_the_terms( 'acao' ) ; ?>
				</li>
				<li>
					<strong>Eixo:</strong>
					<?php pontosdecultura_the_terms( 'eixo' ) ; ?>
				</li>
				<li>
					<strong>Direito violado/abordado:</strong>
					<?php echo $Iniciativa_global->get_custom_field( 'Direito violado/abordado', $custom ); ?>
				</li>
				<li>
					<strong>Sujeito de direito:</strong>
					<?php pontosdecultura_the_terms( 'sujeito' ) ; ?>
				</li>
				<li>
					<strong>Elementos de DH:</strong>
					<?php echo $Iniciativa_global->get_custom_field( 'Elementos de DH', $custom ); ?>
				</li>
				<li>
					<strong>Organizações/parcerias:</strong>
					<?php echo $Iniciativa_global->get_custom_field( 'Organizações/parcerias', $custom ); ?>
				</li>
				<li>
					<strong>Nº de participantes:</strong>
					<?php echo $Iniciativa_global->get_custom_field( 'Nº de participantes', $custom ); ?>
				</li>
				<li>
					<strong>Nº de masculino:</strong>
					<?php echo $Iniciativa_global->get_custom_field( 'Nº de masculino', $custom ); ?>
				</li>
				<li>
					<strong>Nº de feminino:</strong>
					<?php echo $Iniciativa_global->get_custom_field( 'Nº de feminino', $custom ); ?>
				</li>
			</ul>
		</div>
		
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php edit_post_link( __( 'Edit', 'pontosdecultura' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->