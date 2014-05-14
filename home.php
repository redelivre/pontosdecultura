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
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
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
	</div>
<?php get_footer(); ?>


