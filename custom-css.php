<style type="text/css">
	.search-advanced {
		<?php
			$searchbg = get_theme_mod('searchbg',
					Pontosdecultura::get_default_values('searchbg'));
		?>
		<?php if (empty($searchbg)): ?>
			background: <?php
				echo get_theme_mod('advancedsearch_bgcolor',
						Pontosdecultura::get_default_values('advancedsearch_bgcolor'));
			?>;
		<?php else: ?>
			background-image: url("<?php echo htmlspecialchars($searchbg); ?>");
		<?php endif; ?>
	}

	.search-estado {
		background: <?php
			echo get_theme_mod('statesearch_bgcolor',
					Pontosdecultura::get_default_values('statesearch_bgcolor'));
		?>;
	}

	.search-tags {
		<?php
			$tagsbg = get_theme_mod('tagsbg',
					Pontosdecultura::get_default_values('tagsbg'));
		?>
		<?php if (empty($tagsbg)): ?>
			background: <?php
				echo get_theme_mod('mostsearched_bgcolor',
						Pontosdecultura::get_default_values('mostsearched_bgcolor'));
			?>;
		<?php else: ?>
			background-image: url("<?php echo htmlspecialchars($tagsbg); ?>");
		<?php endif; ?>
	}

	.widget-area--footer {
		background: <?php
			echo get_theme_mod('footerwidget_bgcolor',
					Pontosdecultura::get_default_values('footerwidget_bgcolor'));
		?> url('images/footer-pattern.png') repeat-x bottom;
	}

	.support-area {
		background: <?php
			echo get_theme_mod('support_bgcolor',
					Pontosdecultura::get_default_values('support_bgcolor'));
		?> url('images/footer-pattern.png') repeat-x bottom;
	}

	.site-header,
	.search-intro {
		<?php
			$headerbg = get_theme_mod('headerbg',
					Pontosdecultura::get_default_values('headerbg'));
		?>
		<?php if (empty($headerbg)): ?>
			background: <?php
				echo get_theme_mod('header_bgcolor',
						Pontosdecultura::get_default_values('header_bgcolor'));
			?>;
		<?php else: ?>
			background-image: url("<?php echo htmlspecialchars($headerbg); ?>");
		<?php endif; ?>
	}

	.menu-item a:hover,
	button,
  input[type="submit"]:hover,
  input[type="button"]:hover,
  input[type="reset"]:hover {
		color: <?php
			echo get_theme_mod('button_hovercolor',
					Pontosdecultura::get_default_values('button_hovercolor'));
		?>;
	}

	.menu-item a,
	button,
  input[type="submit"],
  input[type="button"],
  input[type="reset"] {
		background: <?php
			echo get_theme_mod('button_bgcolor',
					Pontosdecultura::get_default_values('button_bgcolor'));
		?>;
		color: <?php
			echo get_theme_mod('button_textcolor',
					Pontosdecultura::get_default_values('button_textcolor'));
		?>;
	}
</style>
