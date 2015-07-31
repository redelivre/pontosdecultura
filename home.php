<?php get_header(); ?>
	<div id="post_overlay">
	        <a id="pontos_close_post_overlay" title="Fechar"><?php mapasdevista_image("close.png", array("alt" => "Fechar")); ?></a>
	        <div id="post_overlay_content" class="post_overlay_content" >
			</div>
	</div>
	<section class="search-intro search-area clearfix">
		<div class="container">
			<p class="intro-text content-box">
				<?php
				/* TODO: This should be a option inside the Customizer section */
				$home_url = get_bloginfo('url') . '/';
				printf( '<a href="%1$s">Práticas de Continuidade</a> é uma iniciativa de mapeamento colaborativo e articulação de pesquisas continuadas
					em Artes Cênicas e Performativas no Brasil. <a href="%2$s">Cadastre sua pesquisa</a>, navegue pelo <a href="%3$s">mapa e pelos filtros</a>,
					faça busca por palavras-chave. São diversas pesquisas e núcleos de trabalho perene em todo o Brasil.',
					$home_url . 'o-projeto',
					Praticas::get_new_url(),
					$home_url . 'mapa'
				);
				?>
			</p>
			<?php get_search_form(); ?>
		</div><!-- .container -->
	</section>
	<section class="search-estado search-area clearfix">
		<div class="container">
			<h2 class="area-title">Busca por estado</h2>
			<div class="gr gr-small">
				<ul class="state-list">
					<li><?php _e( 'Centro-Oeste', 'pontosdecultura' ); ?>
						<ul class="state-list--children state-list--co">
							<li class="state-name"><a href="javascript:map_estados_click(-15.827322694625742, -47.5434026311638, 9, 'df');"><?php _e( 'Distrito Federal' ); ?></a></li>
							<li class="state-name"><a href="javascript:map_estados_click(-16.489545110135776, -49.10255992578129, 6, 'go');"><?php _e( 'Goiás' ); ?></a></li>
							<li class="state-name"><a href="javascript:map_estados_click(-13.79899613053151, -54.66457553124998, 6, 'mt');"><?php _e( 'Mato Grosso' ); ?></a></li>
							<li class="state-name"><a href="javascript:map_estados_click(-20.49223599374924, -53.60988803124998, 6, 'ms');"><?php _e( 'Mato Grosso do Sul' ); ?></a></li>
						</ul><!-- state-list--children -->
					</li>
					<li><?php _e( 'Nordeste', 'pontosdecultura' ); ?>
						<ul class="state-list--children state-list--ne">
							<li class="state-name"><a href="javascript:map_estados_click(-9.577380852874896, -36.36940562890629, 8, 'al');"><?php _e( 'Alagoas' ); ?></a></li>
							<li class="state-name"><a href="javascript:map_estados_click(-13.93843295148234, -39.94545543359379, 6, 'ba');"><?php _e( 'Bahia' ); ?></a></li>
							<li class="state-name"><a href="javascript:map_estados_click(-5.709926219210012, -37.1228704046013, 6, 'ce');"><?php _e( 'Ceará' ); ?></a></li>
							<li class="state-name"><a href="javascript:map_estados_click(-5.014819924963368, -43.93811078515628, 6, 'ma');"><?php _e( 'Maranhão' ); ?></a></li>
							<li class="state-name"><a href="javascript:map_estados_click(-7.235434335980407, -36.50124156640629, 8, 'pb');"><?php _e( 'Paraíba' ); ?></a></li>
							<li class="state-name"><a href="javascript:map_estados_click(-8.083170249100542, -37.37280936944505, 7, 'pe');"><?php _e( 'Pernambuco' ); ?></a></li>
							<li class="state-name"><a href="javascript:map_estados_click(-6.744557263267556, -41.52111859765628, 6, 'pi');"><?php _e( 'Piauí' ); ?></a></li>
							<li class="state-name"><a href="javascript:map_estados_click(-5.338126455015082, -35.8374700139763, 7, 'rn');"><?php _e( 'Rio Grande do Norte' ); ?></a></li>
							<li class="state-name"><a href="javascript:map_estados_click(-10.536252353462848, -36.90224254296879, 8, 'se');"><?php _e( 'Sergipe' ); ?></a></li>
						</ul><!-- state-list--children -->
					</li>
					<li><?php _e( 'Norte', 'pontosdecultura' ); ?>
						<ul class="state-list--children state-list--n">
							<li class="state-name"><a href="javascript:map_estados_click(-8.981814864398771, -70.17420626171871, 7, 'ac');"><?php _e( 'Acre' ); ?></a></li>
							<li class="state-name"><a href="javascript:map_estados_click(2.042922656988901, -50.1636418889763, 6, 'ap');"><?php _e( 'Amapá' ); ?></a></li>
							<li class="state-name"><a href="javascript:map_estados_click(-2.9362446361557346, -63.189648156249966, 6, 'am');"><?php _e( 'Amazonas' ); ?></a></li>
							<li class="state-name"><a href="javascript:map_estados_click(-3.4915906071701035, -49.0430364202263, 5, 'pa');"><?php _e( 'Pará' ); ?></a></li>
							<li class="state-name"><a href="javascript:map_estados_click(-10.227506519855961, -60.967663292968716, 6, 'ro');"><?php _e( 'Rondônia' ); ?></a></li>
							<li class="state-name"><a href="javascript:map_estados_click(1.9780917659769406, -60.022839074218716, 6, 'rr');"><?php _e( 'Roraima' ); ?></a></li>
							<li class="state-name"><a href="javascript:map_estados_click(-9.3125876115149, -47.74574840234379, 6, 'to');"><?php _e( 'Tocantins' ); ?></a></li>
						</ul><!-- state-list--children -->
					</li>
					<li><?php _e( 'Sudeste', 'pontosdecultura' ); ?>
						<ul class="state-list--children state-list--se">
							<li class="state-name"><a href="javascript:map_estados_click(-17.47126983928056, -39.36318004296879, 6, 'es');"><?php _e( 'Espírito Santo' ); ?></a></li>
							<li class="state-name"><a href="javascript:map_estados_click(-18.307672760467163, -42.95021617578129, 6, 'mg');"><?php _e( 'Minas Gerais' ); ?></a></li>
							<li class="state-name"><a href="javascript:map_estados_click(-21.488927749959952, -42.14272105859379, 7, 'rj');"><?php _e( 'Rio de Janeiro' ); ?></a></li>
							<li class="state-name"><a href="javascript:map_estados_click(-22.139955704130976, -46.86428256249998, 6, 'sp');"><?php _e( 'São Paulo' ); ?></a></li>
						</ul><!-- state-list--children -->
					</li>
					<li><?php _e( 'Sul', 'pontosdecultura' ); ?>
						<ul class="state-list--children state-list--s">
							<li class="state-name"><a href="javascript:map_estados_click(-26.03328886702247, -50.29201693749998, 6, 'pr');"><?php _e( 'Paraná' ); ?></a></li>
							<li class="state-name"><a href="javascript:map_estados_click(-30.27174883870184, -50.79738803124998, 6, 'rs');"><?php _e( 'Rio Grande do Sul' ); ?></a></li>
							<li class="state-name"><a href="javascript:map_estados_click(-27.657612362418984, -50.24807162499998, 7, 'sc');"><?php _e( 'Santa Catarina' ); ?></a></li>
						</ul><!-- state-list--children -->
					</li>
				</ul><!-- .state-list -->
			</div><!-- .golden-ratio--small -->
			<div class="wrapper-map-brasil gr gr-large">
				<?php include dirname(__FILE__).'/inc/map.php'; ?>
			</div><!-- .gr-large -->
		</div><!-- .container -->
	</section>

	<section class="search-advanced search-area clearfix">
		<div class="container">
			<h2 class="area-title">Busca avançada</h2>
			<form class="adv-search-form content-box" role="search">
				<input type="search" class="adv-search-title" placeholder="<?php echo esc_attr_x( 'Nome do Núcleo ou Artista Pesquisador', 'pontosdecultura' ); ?>" value="" name="adv-search-title" title="<?php //echo esc_attr_x( 'Buscar somente por pontos cujo nome contenham esse termo', 'pontosdecultura' ); ?>" />
				<select name="adv-search-cenico-performativa" class="adv-search-cenico-performativa" autocomplete="off">
					<option value="" selected="selected" ><?php echo esc_attr_x('Área(s) da Pesquisa Cênico-Performativa', 'pontosdecultura' ); ?></option>
					<?php
						$terms = get_terms('cenico-performativa', array('orderby' => 'name', 'hide_empty' => false));
						foreach ($terms as $term)
						{
							?>
							<option value="<?php echo $term->slug; ?>" ><?php echo str_replace('#input#', '', $term->name); ?></option>
							<?php
						} 
					?>
				</select>
				<select name="adv-search-estado" class="adv-search-estado" autocomplete="off">
					<option value="" selected="selected" ><?php echo esc_attr_x('Estado', 'pontosdecultura' ); ?></option>
					<?php
						$terms = get_terms('territorio', array('parent' => 0, 'orderby' => 'name', 'hide_empty' => false));
						foreach ($terms as $term)
						{
							?>
							<option value="<?php echo $term->slug; ?>" ><?php echo str_replace('#input#', '', $term->name); ?></option>
							<?php
						} 
					?>
				</select>
				<select name="adv-search-cidade" class="adv-search-cidade" autocomplete="off">
					<option value="" selected="selected" ><?php echo esc_attr_x('Cidade', 'pontosdecultura' ); ?></option>
				</select>
				<select name="adv-search-natureza" class="adv-search-natureza" autocomplete="off">
					<option value="" selected="selected" ><?php echo esc_attr_x('Natureza', 'pontosdecultura' ); ?></option>
					<?php
						$terms = get_terms('natureza', array('orderby' => 'name', 'hide_empty' => false));
						foreach ($terms as $term)
						{
							?>
							<option value="<?php echo $term->slug; ?>" ><?php echo str_replace('#input#', '', $term->name); ?></option>
							<?php
						} 
					?>
				</select>
				<select name="adv-search-desdobramentos" class="adv-search-desdobramentos" autocomplete="off">
					<option value="" selected="selected" ><?php echo esc_attr_x('Desdobramentos', 'pontosdecultura' ); ?></option>
					<?php
						$terms = get_terms('desdobramentos', array('orderby' => 'name', 'hide_empty' => false));
						foreach ($terms as $term)
						{
							?>
							<option value="<?php echo $term->slug; ?>" ><?php echo str_replace('#input#', '', $term->name); ?></option>
							<?php
						} 
					?>
				</select>
				
				<select name="adv-search-ano-inicio" class="adv-search-ano-inicio" autocomplete="off">
					<option value="" selected="selected" ><?php echo esc_attr_x('Tempo', 'pontosdecultura' ); ?></option>
					<option value="<?php echo date('Y') - 1; ?>,<?php echo date('Y') - 3; ?>">1 a 3 anos</option>
					<option value="<?php echo date('Y') - 4; ?>,<?php echo date('Y') - 6; ?>">4 a 6 anos</option>
					<option value="<?php echo date('Y') - 7; ?>,<?php echo date('Y') - 10; ?>">7 a 10 anos</option>
					<option value="<?php echo date('Y') - 11; ?>,<?php echo date('Y') - 15; ?>">11 a 15 anos</option>
					<option value="<?php echo date('Y') - 16; ?>,<?php echo date('Y') - 20; ?>">16 a 20 anos</option>
					<option value="<?php echo date('Y') - 21; ?>,<?php echo date('Y') - 30; ?>">21 a 30 anos</option>
					<option value="<?php echo date('Y') - 31; ?>,+">Mais de 30 anos</option>
				</select>

				<select name="adv-search-numero-integrantes" class="adv-search-numero-integrantes" autocomplete="off">
					<option value="" selected="selected" ><?php echo esc_attr_x('Nº de Integrantes Estáveis', 'pontosdecultura' ); ?></option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
					<option value="11,20">11 a 20</option>
					<option value="20,+">Mais de 20</option>
				</select>
				
				<select name="adv-search-publico-alvo" class="adv-search-publico-alvo" autocomplete="off">
					<option value="" selected="selected" ><?php echo esc_attr_x('Público-alvo', 'pontosdecultura' ); ?></option>
					<?php
						$terms = get_terms('publico-alvo', array('orderby' => 'name', 'hide_empty' => false));
						foreach ($terms as $term)
						{
							?>
							<option value="<?php echo $term->slug; ?>" ><?php echo str_replace('#input#', '', $term->name); ?></option>
							<?php
						} 
					?>
				</select>
				<select name="adv-search-ressonancias" class="adv-search-ressonancias" autocomplete="off">
					<option value="" selected="selected" ><?php echo esc_attr_x('Ressonâncias', 'pontosdecultura' ); ?></option>
					<?php
						$terms = get_terms('ressonancias', array('orderby' => 'name', 'hide_empty' => false));
						foreach ($terms as $term)
						{
							?>
							<option value="<?php echo $term->slug; ?>" ><?php echo str_replace('#input#', '', $term->name); ?></option>
							<?php
						} 
					?>
				</select>
				
				<select name="adv-search-e-ponto" class="adv-search-e-ponto" autocomplete="off">
					<option value="" selected="selected" ><?php echo esc_attr_x('Ponto de Cultura?', 'pontosdecultura' ); ?></option>
					<option value="N">Não</option>
					<option value="S">É Ponto de Cultura</option>
					<option value="P">É Pontão de Cultura</option>
				</select>
				
				<select name="adv-search-vinculo" class="adv-search-vinculo" autocomplete="off">
					<option value="" selected="selected" ><?php echo esc_attr_x('Vínculo Acadêmico', 'pontosdecultura' ); ?></option>
					<option value="N">Nunca possuiram</option>
					<option value="P">Já Possuiram</option>
					<option value="S">Possuem</option>
				</select>
				
				<select name="adv-search-fotos" class="adv-search-fotos" autocomplete="off">
					<option value="" selected="selected" ><?php echo esc_attr_x('Fotos', 'pontosdecultura' ); ?></option>
					<option value="S">Que tenham fotos</option>
					<option value="N">Que não tenham fotos</option>
				</select>
				
				<select name="adv-search-links" class="adv-search-links" autocomplete="off">
					<option value="" selected="selected" ><?php echo esc_attr_x('Links para publicações', 'pontosdecultura' ); ?></option>
					<option value="S">Com links para publicações</option>
					<option value="N">Sem links para publicações</option>
				</select>
				
				<select name="adv-search-videos" class="adv-search-videos" autocomplete="off">
					<option value="" selected="selected" ><?php echo esc_attr_x('Links para Videos', 'pontosdecultura' ); ?></option>
					<option value="S">Com links para vídeos</option>
					<option value="N">Sem links para videos</option>
				</select>
				
				<select name="adv-search-facebook" class="adv-search-facebook" autocomplete="off">
					<option value="" selected="selected" ><?php echo esc_attr_x('Facebook', 'pontosdecultura' ); ?></option>
					<option value="S">Com links para o facebook</option>
					<option value="N">Sem links para o facebook</option>
				</select>
				
				<input type="submit" class="adv-search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button' ); ?>" />
			</form><!-- .adv-search-form -->
		</div><!-- .container -->
	</section>

	<section class="search-tags search-area clearfix">
		<div class="container">
			<h2 class="area-title">+ buscados</h2>
			<?php
				echo wp_generate_tag_cloud(get_option('pontosdecultura_home_searches', array()), array ( 'smallest' => 1, 'largest' => 3, 'unit' => 'em', 'number' => 30 ) );
			?>
		</div><!-- .container -->
	</section>

	<section id="search-result" class="search-result search-area clearfix">
		<div class="container">
			<a class="search-result-button">&#11014; <?php _e( 'Ocultar resultados', 'pontosdecultura' ); ?></a>
			<div id="search-result-list" class="search-result-list gr gr-small clearfix">
				<?php //mapasdevista_view_results(); ?>
				<div class="map-results-intro3">
        			<span class="map-results-total-prefix"><?php _e( 'Carregando&hellip;', 'pontosdecultura' ); ?></span>
		    	</div><!-- .map-results-intro -->
			</div>
			<div class="search-result-map gr gr-large">
				<div class="map clear"><?php Pontosdecultura::the_map(); ?></div>
			</div>
			<div class="search-load-button" style="display: none;" >
				<?php _e('Load data', 'pontosdecultura'); ?>
			</div>
			<div class="search-not-here">
				<img class="icon-capa" src="<?php echo get_template_directory_uri().'/images/icon.png'; ?>"/>
				<?php printf( __( 'Não encontrou o procurava? Participe <a href="%s">cadastre sua pesquisa</a> ou <a href="%s">entre em contato</a> conosco!', 'pontosdecultura' ),  Praticas::get_new_url(), get_bloginfo( 'url' ) . '/contato' ); ?>
			</div>
		</div>
	</section>
<?php get_footer(); ?>