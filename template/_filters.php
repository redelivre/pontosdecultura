<?php
ini_set("memory_limit", "2048M"); //TODO this stop errors, but this code need to be optimized
set_time_limit(0);

class PontosFilters
{
	public static function createTaxBox($taxonomy, $terms)
	{
		if($taxonomy != 'territorio')
		{
		?>
			<div class="filter-panel-tooglebox">
				<div class="filter-panel-tooglebox-meta-head">
					<span class="filter-panel-tooglebox-title">
						<?php echo $taxonomy; ?>
					</span>
					<span class="filter-panel-tooglebox-button"></span>
				</div>
				<span class="filter-panel-tooglebox-list">
				<?php
					foreach ($terms as $term)
					{
					?>
						<input type="checkbox" class="taxonomy-filter-checkbox" value="<?php echo $term->slug; ?>" name="filter_by_<?php echo $term->taxonomy; ?>[]" id="filter_by_<?php echo $term->taxonomy; ?>_<?php echo $term->slug; ?>" />
						<label for="filter_by_<?php echo $term->taxonomy; ?>_<?php echo $term->slug; ?>">
							<?php echo $term->name; ?>
						</label>
					<?php
					} 
				?>
				</span>
			</div>
		<?php
		}
		else 
		{
			//TODO select for territorio
		}
	}
	public static function show()
	{
		global $wpdb;
		$querystr = "
		SELECT $wpdb->term_taxonomy.taxonomy,$wpdb->terms.term_id,$wpdb->terms.name,$wpdb->terms.slug   FROM $wpdb->posts
		INNER JOIN $wpdb->postmeta ON($wpdb->posts.ID = $wpdb->postmeta.post_id)
		INNER JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id)
		INNER JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
		INNER JOIN $wpdb->terms ON($wpdb->term_taxonomy.term_id = $wpdb->terms.term_id)
		WHERE $wpdb->posts.post_type = 'mapa'
		AND $wpdb->postmeta.meta_key = '_mpv_inmap'
		GROUP BY $wpdb->terms.term_id
		";
		
		$taxs_rows = $wpdb->get_results($querystr, OBJECT);
		
		$taxs = array();
		
		foreach ($taxs_rows as $tax)
		{
			if(array_key_exists($tax->taxonomy, $taxs))
			{
				$taxs[$tax->taxonomy][] = $tax;
			}
			else
			{
				$taxs[$tax->taxonomy] = array();
				$taxs[$tax->taxonomy][] = $tax;
			}
		}
		
		?>
		<div class="filter-panel">
		        <h1><?php _e('Filtros', 'pontosdecultura');?></h1>
		        <?php
		        foreach ($taxs as $taxonomy => $terms)
		        {
		        	self::createTaxBox($taxonomy, $terms);
		        }
				?>
		</div>
		<?php
	}
}

$pf = new PontosFilters();
$pf::show();

