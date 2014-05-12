<?php get_header(); ?>
	<section class="search-form search-area clearfix">
		<?php get_search_form(); ?>
	</section>

	<section class="search-result search-area clearfix">
		<div class="search-result-list">
			<?php mapasdevista_view_results(); ?>
		</div>
		<div class="search-result-map">
			<div class="map clear"><?php Pontosdecultura::the_map(); ?></div>
		</div>
	</section>

	<section class="search-estado search-area clearfix">
		<?php include 'map.php'; ?>
	</section>

	<section class="search-tags search-area clearfix">
		<?php wp_tag_cloud(); ?>
	</section>
	
	<section class="search-avancado search-area clearfix">
	</section>
<?php get_footer(); ?>
