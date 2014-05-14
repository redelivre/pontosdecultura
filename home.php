<?php get_header(); ?>
	<section class="search-intro search-area clearfix">
		<div class="container">
			<p class="intro-text">
				O Mapa Cultura Viva é Livre e aberto, fruto do acúmulo de dezenas de experiências da Rede de Pontos de
				Cultura com o objetivo de dar visibilidade e articular iniciativas e ações do programa Cultura Viva.
				 Existem várias formas de utilizar a plataforma, sendo possível fazer buscas de forma aberta ou avançada, 
				 através do mapa ou pelos termos mais procurados. Participe interagindo com os pontos, por consultas 
				 públicas ou atualizando informações. 
			</p>
			<?php get_search_form(); ?>
		</div><!-- .container -->
	</section>
	<section class="search-estado search-area clearfix">
		<div class="container">
			<?php include dirname(__FILE__).'/inc/map.php'; ?>
		</div><!-- .container -->
	</section>

	<section class="search-advanced search-area clearfix">
		<div class="container">
			<h2 class="area-title">Busca avançada</h2>
			<input type="search" class="adv-search-title" placeholder="<?php echo esc_attr_x( 'Nome do ponto', 'pontosdecultura' ); ?>" value="" name="adv-search-title" title="<?php echo esc_attr_x( 'Buscar somente por pontos cujo nome contenham esse termo', 'pontosdecultura' ); ?>" />
			<select name="adv-search-tipo" class="adv-search-tipo">
				<option selected="selected" ><?php echo esc_attr_x('Tipo do ponto', 'pontosdecultura' ); ?></option>
				<?php
					$terms = get_terms('tipo');
					foreach ($terms as $term)
					{
						?>
						<option value="<?php echo $term->slug; ?>" ><?php echo $term->name; ?></option>
						<?php
					} 
				?>
			</select>
			<select name="adv-search-tipo" class="adv-search-tipo">
				<option selected="selected" ><?php echo esc_attr_x('Tipo do ponto', 'pontosdecultura' ); ?></option>
				<?php
					$terms = get_terms('tipo', array('orderby' => 'name'));
					foreach ($terms as $term)
					{
						?>
						<option value="<?php echo $term->slug; ?>" ><?php echo $term->name; ?></option>
						<?php
					} 
				?>
			</select>
			<select name="adv-search-publicoalvo" class="adv-search-publicoalvo">
				<option selected="selected" ><?php echo esc_attr_x('Público Alvo', 'pontosdecultura' ); ?></option>
				<?php
					$terms = get_terms('publicoalvo', array('orderby' => 'name'));
					foreach ($terms as $term)
					{
						?>
						<option value="<?php echo $term->slug; ?>" ><?php echo $term->name; ?></option>
						<?php
					} 
				?>
			</select>
			<select name="adv-search-estado" class="adv-search-estado">
				<option selected="selected" ><?php echo esc_attr_x('Estado', 'pontosdecultura' ); ?></option>
				<?php
					$terms = get_terms('territorio', array('parent' => 0, 'orderby' => 'name'));
					foreach ($terms as $term)
					{
						?>
						<option value="<?php echo $term->slug; ?>" ><?php echo $term->name; ?></option>
						<?php
					} 
				?>
			</select>
			<select name="adv-search-cidade" class="adv-search-cidade">
				<option selected="selected" ><?php echo esc_attr_x('cidade', 'pontosdecultura' ); ?></option>
			</select>
		</div><!-- .container -->
	</section>

	<section class="search-tags search-area clearfix">
		<div class="container">
			<h2 class="area-title">+ buscados</h2>
			<?php wp_tag_cloud( array ( 'smallest' => 1, 'largest' => 3, 'unit' => 'em' ) ); ?>
		</div><!-- .container -->
	</section>

	<div class="search-result search-area clearfix">
		<div id="search-result-list" class="search-result-list">
			<?php mapasdevista_view_results(); ?>
		</div>
		<div class="search-result-map">
			<div class="map clear"><?php Pontosdecultura::the_map(); ?></div>
		</div>
		<div class="search-result-button">
			<?php _e('voltar a pesquisa', 'pontosdecultura'); ?>
		</div>
	</div>
<?php get_footer(); ?>


