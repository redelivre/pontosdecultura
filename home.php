<?php get_header(); ?>
	<section class="search-form clearfix">
		<?php get_search_form(); ?>
	</section>

	<section class="search-result clearfix">
		<div class="search-result-list">
			<?php mapasdevista_view_results(); ?>
		</div>
		<div class="search-result-map">
			<div class="map clear"><?php Pontosdecultura::the_map(); ?></div>
		</div>
	</section>

	<section class="search-estado clearfix">
		<?php include 'map.php'; ?>
	</section>

	<section class="search-tags clearfix">
	</section>
	
	<section class="search-avancado clearfix">
	</section>
<?php get_footer(); ?>
