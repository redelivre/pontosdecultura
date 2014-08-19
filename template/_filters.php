<?php
ini_set("memory_limit", "2048M"); //TODO this stop errors, but this code need to be optimized
set_time_limit(0);

class PontosFilters
{
	public static function createTaxBox($taxonomy, $terms)
	{
		global $wp_taxonomies;
		
		if($taxonomy != 'territorio')
		{
		?>
			<div class="filter-panel-tooglebox">
				<div class="filter-panel-tooglebox-meta-head">
					<span class="filter-panel-tooglebox-title">
						<?php echo $wp_taxonomies[$taxonomy]->labels->name ?>
					</span>
					<span class="icon-down filter-panel-tooglebox-button"></span>
					<span class="filter-panel-tooglebox-counter"></span>
				</div>
				<span class="filter-panel-tooglebox-list">
				<?php
					foreach ($terms as $term)
					{
					?>
						<span class="taxonomy-filter-checkbox-wrapper">
							<input type="checkbox" class="taxonomy-filter-checkbox" value="<?php echo $term->slug; ?>" name="filter_by_<?php echo $term->taxonomy; ?>[]" id="filter_by_<?php echo $term->taxonomy; ?>_<?php echo $term->slug; ?>" />
							<label for="filter_by_<?php echo $term->taxonomy; ?>_<?php echo $term->slug; ?>">
								<?php echo $term->name; ?>
							</label>
						</span>
					<?php
					} 
				?>
				</span>
			</div>
		<?php
		}
		else 
		{
			//echo '<pre>';print_r($terms);die();
			/*$ufs = array();
			$ufs_keys = array();
			foreach ($terms as $term)
			{
				if($term->parent == 0)
				{
					if(array_key_exists($term->term_id, $ufs_keys))
					{
						$ufs_keys[$term->term_id]['term'] = $term;
					}
					else
					{
						$ufs_keys[$term->term_id] = array('terms' => array());
						$ufs_keys[$term->term_id]['term'] = $term;
					}
					$ufs[$term->name][] = $term->term_id; 
				}
				else
				{
					if(!array_key_exists($term->parent, $ufs_keys))
					{
						$ufs_keys[$term->parent] = array('terms' => array());
					}
					$ufs_keys[$term->parent]['terms'][$term->slug] = $term;
				}
			}
			ksort($ufs);
			//echo '<pre>';print_r($ufs_keys);die();
			foreach ($ufs as $uf)*/
			?>
			<div class="filter-panel-select-wrapper">
				<select name="filter-panel-estado" class="filter-panel-estado" autocomplete="off" >
				<option value="" selected="selected"><?php echo esc_attr_x('Estado', 'pontosdecultura' ); ?></option>
				<?php
					foreach ($terms as $term)
					{
						?>
						<option value="<?php echo $term->slug; ?>" ><?php echo $term->name; ?></option>
						<?php
					} 
				?>
				</select>
				
			</div>
			<div class="filter-panel-select-wrapper">
				<select name="filter-panel-cidade" class="filter-panel-cidade">
					<option value="" selected="selected" ><?php echo esc_attr_x('Cidade', 'pontosdecultura' ); ?></option>
				</select>
			</div>
			<?php
		}
	}
	public static function show()
	{
		global $wpdb;
		
		$querystr = "
		SELECT $wpdb->term_taxonomy.taxonomy,$wpdb->terms.term_id,$wpdb->terms.name,$wpdb->terms.slug FROM $wpdb->posts
		INNER JOIN $wpdb->postmeta ON($wpdb->posts.ID = $wpdb->postmeta.post_id)
		INNER JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id)
		INNER JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
		INNER JOIN $wpdb->terms ON($wpdb->term_taxonomy.term_id = $wpdb->terms.term_id)
		WHERE $wpdb->posts.post_type = 'mapa'
		AND $wpdb->postmeta.meta_key = '_mpv_inmap'
		AND $wpdb->term_taxonomy.parent = 0
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
				<?php $logo_uri = get_template_directory_uri() . '/images/logo-recid-bco.png'; ?>
				<img src="<?php echo $logo_uri; ?>" alt="Logo" />
				<h1 class="panel-title"><?php _e('Filtros', 'pontosdecultura');?></h1>
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

