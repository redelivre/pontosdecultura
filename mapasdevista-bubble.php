<div class="balloon-taxs" >
	<?php
	$post_ID = get_the_ID(); 
	$querystr = "
	SELECT $wpdb->terms.name,$wpdb->term_taxonomy.taxonomy FROM $wpdb->posts
	INNER JOIN $wpdb->postmeta ON($wpdb->posts.ID = $wpdb->postmeta.post_id)
	INNER JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id)
	INNER JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
	INNER JOIN $wpdb->terms ON($wpdb->term_taxonomy.term_id = $wpdb->terms.term_id)
	WHERE
	$wpdb->posts.ID = $post_ID
	AND $wpdb->posts.post_type = 'mapa'
	AND $wpdb->postmeta.meta_key = '_mpv_inmap'
	AND $wpdb->term_taxonomy.taxonomy IN ( 'acao', 'sujeito' )
	GROUP BY $wpdb->terms.term_id
	";
	
	$terms_list = $wpdb->get_results($querystr, ARRAY_N);
	$terms = array();
	foreach ($terms_list as $term_array)
	{
		if(!array_key_exists($term_array[1], $terms))
		{
			$terms[$term_array[1]] = array();
		}
		$terms[$term_array[1]][] = $term_array[0];
	}
	
	
	foreach ($terms as $tax => $term)
	{
		$taxonomy = get_taxonomy($tax);
		?>
			<span class="balloon-taxs-names"><strong><?php echo $taxonomy->labels->name; ?></strong>&nbsp;<?php echo implode(', ', $term); ?></span>
		<?php 
	}
	
	?>
</div>

<div class="balloon-entry-default clearfix" >

    <?php
    $balloon_excerpt = get_the_excerpt();

    if ( ! empty( $balloon_excerpt ) ) {
    	echo '<strong>Elementos de DH: </strong>' . $balloon_excerpt;
    }
    ?>
    
</div>