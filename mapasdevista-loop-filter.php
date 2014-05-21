<?php
/**
 * The Template for displaying list of results on maps
 *
 * @package Pontos de Cultura
 * @since  Pontos de Cultura 1.0
 */
?>
<?php 
global $wp_query;
if(is_home() && !$wp_query->get('mapa-tpl'))
{
	$posts = mapasdevista_get_posts(1, $mapinfo); ?>
	<div id="results" class="map-results scrollbox clearfix">
	    <div class="map-results-intro">
	        <span class="map-results-total-prefix"><?php _e('A busca encontrou ', 'pontosdecultura'); ?></span><span id="filter_total" class="map-results-total-number"><?php echo $posts->post_count; ?></span><span class="map-results-total-sufix"><?php _e(' resultados', 'pontosdecultura'); ?></span>
	    </div><!-- .map-results-intro -->
	    <?php while($posts->have_posts()): $posts->the_post(); ?>
	        <div id="result_<?php the_ID(); ?>" class="result clearfix">
	            <div class="map-result-pin"><?php the_pin(); ?></div>
	            <div class="map-result-content">
	                <!-- <p class="metadata date bottom"><?php the_time(get_option('date_format')); ?></p> -->
	                <!-- the permalink to the post must have the js-link-to-post class. With this, mapasdevista will open the post over the map. 
	                It also have to have an id attribute with the ID of th target post. the id can be anything as long as the post ID is the only numeric part of it. -->
	                <h3 class="map-result-title"><a class="js-link-to-bubble" id="post-link-<?php the_ID(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	                <?php
	                	$uf = false;
	                	$cidade = false;
	                	$territorios = wp_get_post_terms(get_the_ID(), 'territorio');
	                	foreach ($territorios as $territorio)
	                	{
	                		if($territorio->parent == 0) // Estado
	                		{
	                			$uf = $territorio->name;
	                		}
	                		else
	                		{
	                			$cidade = $territorio->name;
	                		}
	                	}
	                	if($cidade)
	                	{
	                	?>
	                		<span class="map-result-city"><?php echo $cidade; ?></span>
	                	<?php
	                	}
	                	if($uf)
	                	{
	                	?>
	                		<span class="map-result-sep">&ndash;</span> <span class="map-result-uf"><?php echo $uf; ?></span>
	                	<?php
	                	} 
	                	?>
	            </div>
	        </div>
	    <?php endwhile; ?>
	</div>
<?php
} 
?>
