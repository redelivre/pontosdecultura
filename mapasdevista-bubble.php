<div class="balloon-entry-default clearfix" >

    <?php the_excerpt(); ?>
    
</div>
<div class="balloon-taxs" >
	<?php
	$post_ID = get_the_ID(); 
	$querystr = "
	SELECT $wpdb->terms.name FROM $wpdb->posts
	INNER JOIN $wpdb->postmeta ON($wpdb->posts.ID = $wpdb->postmeta.post_id)
	INNER JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id)
	INNER JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
	INNER JOIN $wpdb->terms ON($wpdb->term_taxonomy.term_id = $wpdb->terms.term_id)
	WHERE
	$wpdb->posts.ID = $post_ID
	AND $wpdb->posts.post_type = 'mapa'
	AND $wpdb->postmeta.meta_key = '_mpv_inmap'
	AND $wpdb->term_taxonomy.taxonomy != 'territorio'
	GROUP BY $wpdb->terms.term_id
	";
	
	$terms = $wpdb->get_results($querystr, ARRAY_N);
	
	$terms_str = "";
	
	foreach ($terms as $term)
	{
		if(is_array($term))
		{
			foreach ($term as $subterm)
			{
				$terms_str .= $terms_str != '' ? ','.$subterm : $subterm;
			}
		}
		else
		{
			$terms_str .= $terms_str != '' ? ','.$subterm : $subterm;
		}
	}
	
	?>
	<span class="balloon-taxs-names"><?php echo $terms_str;//implode(',', $terms); ?></span>

</div>