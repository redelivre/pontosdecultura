<?php
/**
 * The Template for displaying the loop for the post type 'mapa'
 *
 * @package Pontos de Cultura
 * @since  Pontos de Cultura 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content clearfix">
		<?php the_content(); ?>
		<h2>Informações</h2>
		<?php
			global $Remocoes_global;
			global $post;
			foreach ($Remocoes_global->getFields() as $field)
			{
				if (!empty($field['buildin']) || !empty($field['hide']))
					continue;

				echo '<h3>', esc_attr($field['title']), '</h3>';

				if ($field['type'] == 'estadocidade')
				{
					echo '<p>';
					pontosdecultura_the_terms('territorio');
					echo '</p>';
				}
				else
				{
					if (!empty($field['taxonomy']))
					{
						$terms = get_the_terms($post->ID, $field['slug']);
						$meta = array();
						if ($terms !== false)
							foreach ($terms as $t)
								$meta[] = $t->slug;
					}
					else if ($field['type'] == 'dropdown-meses-anos')
					{
						$meses = array_filter(get_post_meta($post->ID,
									$field['slug'].'-meses'));
						$anos = array_filter(get_post_meta($post->ID,
									$field['slug'].'-anos'));
						$meta = array_map(null, $meses, $anos);
					}
					elseif ($field['type'] == 'event')
					{
						$raw_type = array_filter(get_post_meta($post->ID,
									$field['slug'].'-type'));
						$type = array();
						foreach ($raw_type as $t)
							$type[] = array_key_exists($t, $field['values'])?
								$field['values'][$t] : $t;

						$date = array_filter(get_post_meta($post->ID,
									$field['slug'].'-date'));
						$about = array_filter(get_post_meta($post->ID,
									$field['slug'].'-about'));
						$meta = array_map(null, $date, $type, $about);
					}
					else
						$meta = array_filter(get_post_meta($post->ID, $field['slug']));

					foreach ($meta as $k => $v)
					{
						if (is_array($v))
							$meta[$k] = implode(' - ', $v);
						elseif (array_key_exists('values', $field)
								&& array_key_exists($v, $field['values']))
							$meta[$k] = $field['values'][$v];
					}

					if (sizeof($meta) == 1)
					{
						echo '<p>', esc_attr($meta[0]), '</p>';
					}
					elseif (sizeof($meta) > 1)
					{
						echo '<ul>';
						foreach ($meta as $v)
						{
							echo '<li>', esc_attr($v), '</li>';
						}
						echo '</ul>';
					}
				}
			}
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php edit_post_link( __( 'Edit', 'pontosdecultura' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
