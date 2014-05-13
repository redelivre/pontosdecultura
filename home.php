<?php get_header(); ?>
	<section class="search-intro container search-area clearfix">
		<div class="container">
			<p class="search-text">
				O Mapa Cultura Viva é Livre e aberto, fruto do acúmulo de dezenas de experiências da Rede de Pontos de
				Cultura com o objetivo de dar visibilidade e articular iniciativas e ações do programa Cultura Viva.
				 Existem várias formas de utilizar a plataforma, sendo possível fazer buscas de forma aberta ou avançada, 
				 através do mapa ou pelos termos mais procurados. Participe interagindo com os pontos, por consultas 
				 públicas ou atualizando informações. 
			</p>
			<?php get_search_form(); ?>
		</div><!-- .container -->
	</section>

	<section class="search-result search-area clearfix">
		<div class="container">
			<div class="search-result-list">
				<?php //mapasdevista_view_results(); ?>
			</div>
			<div class="search-result-map">
				<div class="map clear"><?php //Pontosdecultura::the_map(); ?></div>
			</div>
		</div><!-- .container -->
	</section>

	<section class="search-estado search-area clearfix">
		<div class="container">
			<?php include 'map.php'; ?>
		</div><!-- .container -->
	</section>

	<section class="search-advanced search-area clearfix">
		<div class="container">
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
			<?php wp_tag_cloud(); ?>
		</div><!-- .container -->
	</section>
	
<?php get_footer(); ?>
