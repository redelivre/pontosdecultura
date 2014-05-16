<?php get_header(); ?>
	<section class="search-intro search-area clearfix">
		<div class="container">
			<p class="intro-text content-box">
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
			<h2 class="area-title">Busca por estado</h2>
			<ul class="state-list">
				<li><?php _e( 'Sul', 'pontosdecultura' ); ?>
					<ul class="state-list--children">
						<li class="state-name"><a href="#"><?php _e( 'Paraná', 'pontosdecultura' ); ?></a></li>
						<li class="state-name"><a href="#"><?php _e( 'Santa Catarina', 'pontosdecultura' ); ?></a></li>
						<li class="state-name"><a href="#"><?php _e( 'Rio Grande do Sul', 'pontosdecultura' ); ?></a></li>
					</ul><!-- state-list--children -->
				</li>
				<li><?php _e( 'Sudeste', 'pontosdecultura' ); ?>
					<!-- mais uma <ul> -->
				</li>
			</ul><!-- .state-list -->
			<?php include dirname(__FILE__).'/inc/map.php'; ?>
		</div><!-- .container -->
	</section>

	<section class="search-advanced search-area clearfix">
		<div class="container">
			<h2 class="area-title">Busca avançada</h2>
			<form class="adv-search-form content-box" role="search">
				<input type="search" class="adv-search-title" placeholder="<?php echo esc_attr_x( 'Nome do Ponto', 'pontosdecultura' ); ?>" value="" name="adv-search-title" title="<?php echo esc_attr_x( 'Buscar somente por pontos cujo nome contenham esse termo', 'pontosdecultura' ); ?>" />
				<select name="adv-search-tipo" class="adv-search-tipo">
					<option value="" selected="selected" ><?php echo esc_attr_x('Tipo do Ponto', 'pontosdecultura' ); ?></option>
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
				<select name="adv-search-publicoalvo" class="adv-search-publicoalvo">
					<option value="" selected="selected" ><?php echo esc_attr_x('Público-alvo', 'pontosdecultura' ); ?></option>
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
					<option value="" selected="selected" ><?php echo esc_attr_x('Estado', 'pontosdecultura' ); ?></option>
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
					<option value="" selected="selected" ><?php echo esc_attr_x('Cidade', 'pontosdecultura' ); ?></option>
				</select>
				<input type="submit" class="adv-search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button' ); ?>" />
			</form><!-- .adv-search-form -->
		</div><!-- .container -->
	</section>

	<section class="search-tags search-area clearfix">
		<div class="container">
			<h2 class="area-title">+ buscados</h2>
			<?php
				$terms = array();
				$term_obj = new stdClass();
				$term_obj->term_id = 0; //5745
				$term_obj->name = "Soyloco"; //Conhecimento e Tradições Orais
				$term_obj->slug = sanitize_title($term_obj->name); //conhecimento-e-tradicoes-orais
				$term_obj->term_group = 0; //0
				$term_obj->term_taxonomy_id = 0; //5754
				$term_obj->taxonomy = "false"; //tematico
				$term_obj->description = ""; //
				$term_obj->parent = 0; //0
				$term_obj->count = 1; //128
				$terms[] = $term_obj;
				$term_obj = new stdClass();
				$term_obj->term_id = 0; //5745
				$term_obj->name = "Curitiba"; //Conhecimento e Tradições Orais
				$term_obj->slug = sanitize_title($term_obj->name); //conhecimento-e-tradicoes-orais
				$term_obj->term_group = 0; //0
				$term_obj->term_taxonomy_id = 0; //5754
				$term_obj->taxonomy = "false"; //tematico
				$term_obj->description = ""; //
				$term_obj->parent = 0; //0
				$term_obj->count = 5; //128
				$terms[] = $term_obj;
				$term_obj = new stdClass();
				$term_obj->term_id = 0; //5745
				$term_obj->name = "São Paulo"; //Conhecimento e Tradições Orais
				$term_obj->slug = sanitize_title($term_obj->name); //conhecimento-e-tradicoes-orais
				$term_obj->term_group = 0; //0
				$term_obj->term_taxonomy_id = 0; //5754
				$term_obj->taxonomy = "false"; //tematico
				$term_obj->description = ""; //
				$term_obj->parent = 0; //0
				$term_obj->count = 2; //128
				$terms[] = $term_obj;
				$term_obj = new stdClass();
				$term_obj->term_id = 0; //5745
				$term_obj->name = "Bahia"; //Conhecimento e Tradições Orais
				$term_obj->slug = sanitize_title($term_obj->name); //conhecimento-e-tradicoes-orais
				$term_obj->term_group = 0; //0
				$term_obj->term_taxonomy_id = 0; //5754
				$term_obj->taxonomy = "false"; //tematico
				$term_obj->description = ""; //
				$term_obj->parent = 0; //0
				$term_obj->count = 2; //128
				$terms[] = $term_obj;
				$term_obj = new stdClass();
				$term_obj->term_id = 0; //5745
				$term_obj->name = "Dança"; //Conhecimento e Tradições Orais
				$term_obj->slug = sanitize_title($term_obj->name); //conhecimento-e-tradicoes-orais
				$term_obj->term_group = 0; //0
				$term_obj->term_taxonomy_id = 0; //5754
				$term_obj->taxonomy = "false"; //tematico
				$term_obj->description = ""; //
				$term_obj->parent = 0; //0
				$term_obj->count = 20; //128
				$terms[] = $term_obj;
				
				foreach ( $terms as $key => $tag )
				{
					$terms[ $key ]->link = $tag->name;
					$terms[ $key ]->id = $tag->term_id;
				}
				
				update_option('pontosdecultura_home_searches', $terms); //TODO Fixo até arrumar a função que contabiliza
				
				echo wp_generate_tag_cloud(get_option('pontosdecultura_home_searches', array()), array ( 'smallest' => 1, 'largest' => 3, 'unit' => 'em' ) );
			?>
		</div><!-- .container -->
	</section>

	<section class="search-result search-area clearfix">
		<div class="container">
			<div id="search-result-list" class="search-result-list">
				<?php //mapasdevista_view_results(); ?>
			</div>
			<div class="search-result-map">
				<div class="map clear"><?php Pontosdecultura::the_map(); ?></div>
			</div>
			<div class="search-result-button">
				<?php _e('volta a pesquisa', 'pontosdecultura'); ?>
			</div>
			<div class="search-load-button">
				<?php _e('Load data', 'pontosdecultura'); ?>
			</div>
		</div>
	</section>
<?php get_footer(); ?>


