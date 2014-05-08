<?php get_header(); ?>
	<div class="container cf">
		<section class="search-form">
			<?php get_search_form(); ?>
		</section>

		<section class="search-result">
			<div class="map-col">
				<?php mapasdevista_view_results(); ?>
			</div>
			<div class="map-col">
				<div class="map clear"><?php Pontosdecultura::the_map(); ?></div>
			</div>
		</section>

		<section class="search-estado clearfix">
			<?php include 'map.php'; ?>
		</section>

		<section class="search-tags">
		</section>
		
		<section class="search-avancado">
		</section>
	</div><!-- /container -->
<?php get_footer(); ?>
