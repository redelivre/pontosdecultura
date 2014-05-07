<?php get_header(); ?>
	<div class="container cf">
		<section class="row search-form">
			<?php get_search_form(); ?>
		</section>

		<section class="row search-result">
			<div class="span map-col">
				<?php mapasdevista_view_results(); ?>
			</div>
			<div class="span map-col">
				<div class="map clear"><?php Pontosdecultura::the_map(); ?></div>
			</div>
		</section>

		<section class="row search-estado">
			<?php include 'map.php'; ?>
		</section>

		<section class="row search-tags">
		</section>
		
		<section class="row search-avancado">
		</section>
	</div><!-- /container -->
<?php get_footer(); ?>
