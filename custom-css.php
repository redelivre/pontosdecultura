<style type="text/css">
	/* Advanced Search */
	.search-advanced {
		background: <?php
			echo get_theme_mod('advancedsearch_bgcolor',
					Pontosdecultura::get_default_values('advancedsearch_bgcolor'));
		?>;
	}

	.search-estado {
		background: <?php
			echo get_theme_mod('statesearch_bgcolor',
					Pontosdecultura::get_default_values('statesearch_bgcolor'));
		?>;
	}

	.search-intro {
		background: <?php
			echo get_theme_mod('introsearch_bgcolor',
					Pontosdecultura::get_default_values('introsearch_bgcolor'));
		?>;
	}

	.search-tags {
		background: <?php
			echo get_theme_mod('mostsearched_bgcolor',
					Pontosdecultura::get_default_values('mostsearched_bgcolor'));
		?>;
	}

	.widget-area--footer {
		background: <?php
			echo get_theme_mod('footerwidget_bgcolor',
					Pontosdecultura::get_default_values('footerwidget_bgcolor'));
		?> url('images/footer-pattern.png') repeat-x bottom;
	}

	.site-header {
		background: <?php
			echo get_theme_mod('header_bgcolor',
					Pontosdecultura::get_default_values('header_bgcolor'));
		?>;
	}

	.main-navigation .menu-item a {
		background: <?php
			echo get_theme_mod('menu_bgcolor',
					Pontosdecultura::get_default_values('menu_bgcolor'));
		?>;
	}
</style>
