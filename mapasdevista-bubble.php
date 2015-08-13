<?php
	$post_ID = get_the_ID();
	
	$mapinfo = get_option('mapasdevista', true);
	$pt = implode(',', array_map(array('Pontosdecultura', 'quote'), $mapinfo['post_types']));
	
	$querystr = "
	SELECT $wpdb->terms.name FROM $wpdb->posts
	INNER JOIN $wpdb->postmeta ON($wpdb->posts.ID = $wpdb->postmeta.post_id)
	INNER JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id)
	INNER JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
	INNER JOIN $wpdb->terms ON($wpdb->term_taxonomy.term_id = $wpdb->terms.term_id)
	WHERE
	$wpdb->posts.ID = $post_ID
	AND $wpdb->posts.post_type in (".$pt.")
	AND $wpdb->postmeta.meta_key = '_mpv_inmap'
	AND $wpdb->term_taxonomy.taxonomy = 'cenico-performativa'
	GROUP BY $wpdb->terms.term_id
	";
	
	$terms = $wpdb->get_results($querystr, ARRAY_N);
	
	$terms_str = "";
	$terms_sep = ' / ';
	
	foreach ($terms as $term)
	{
		if(is_array($term))
		{
			foreach ($term as $subterm)
			{
				$terms_str .= $terms_str != '' ? $terms_sep . $subterm : $subterm;
			}
		}
		else
		{
			$terms_str .= $terms_str != '' ? $terms_sep . $subterm : $subterm;
		}
	}
	
	?>

<div class="balloon-email" >
	<span class="balloon-taxs-names"><strong>E-mail: </strong><?php echo get_post_meta($post_ID, 'pratica-email', true); ?></span>
</div>
<div class="balloon-taxs" >
	
	<span class="balloon-taxs-names"><strong>Área(s) da Pesquisa Cênico-Performativa(s): </strong><?php echo $terms_str;//implode(',', $terms); ?></span>

</div>

<div class="balloon-entry-default clearfix" >

    <?php
    $balloon_excerpt = get_the_excerpt();

    if ( ! empty( $balloon_excerpt ) ) {
    	echo '<strong>Descrição da Pesquisa do Núcleo: </strong>' . $balloon_excerpt;
    }
    ?>
    
</div>