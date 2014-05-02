<?php get_header(); ?>
<div class="container cf">
	<div class="row search-form">
		<?php get_search_form(); ?>
	</div>
	<div class="row search-result">
		<div class="span map-col">
			<?php mapasdevista_view_results(); ?>
		</div>
		<div class="span map-col">
			<div class="map clear"><?php Pontosdecultura::the_map(); ?></div>
		</div>
	</div>
	<div class="row search-estado">
		<?php include 'map.php'; ?>
	</div>
	<div class="row search-tags">
	</div>
	<div class="row search-avancado">
	</div>
	<div class="row home-footer">
	</div>
</div><!-- /container -->
<?php get_footer(); ?>
