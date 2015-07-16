<div class="balloon-taxs" >
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
	AND $wpdb->term_taxonomy.taxonomy NOT IN ( 'territorio', 'tipo', 'publicoalvo', 'tematico', 'identitario' )
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
	<span class="balloon-taxs-names"><strong>Áreas culturais: </strong><?php echo $terms_str;//implode(',', $terms); ?></span>

</div>

<div class="balloon-entry-default clearfix" >

    <?php
    $balloon_excerpt = get_the_excerpt();

    if ( ! empty( $balloon_excerpt ) ) {
    	echo '<strong>Objetivos: </strong>' . $balloon_excerpt;
    }
    ?>
    
</div>