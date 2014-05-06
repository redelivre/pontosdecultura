<?php
// É aconselhável criar um backup do banco antes

// crie a taxonomia cidade na functions do tema
add_action('init', 'register_locations');
function register_locations()
{
	
	$labels = array
	(
			'name' => __('Território','pontosdecultura'),
			'singular_name' => __('Território', 'pontosdecultura'),
			'search_items' => __('Procurar em um território','pontosdecultura'),
			'all_items' => __('Todos os territórios','pontosdecultura'),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __('Editar um Território','pontosdecultura'),
			'update_item' => __('Atualizar um Território','pontosdecultura'),
			'add_new_item' => __('Adicionar Novo Território','pontosdecultura'),
			'add_new' => __('Adicionar Território', 'pontosdecultura'),
			'new_item_name' => __('Novo Território','pontosdecultura'),
			'view_item' => __('Visualizar Território','pontosdecultura'),
			'not_found' =>  __('Nenhum território localizado','pontosdecultura'),
			'not_found_in_trash' => __('Nenhum Território localizado na lixeira','pontosdecultura'),
			'menu_name' => __('Territórios','pontosdecultura')
	);
	
	register_taxonomy( 'territorio',array (
	  'mapa'
	),
	array( 'hierarchical' => true,
		'label' => 'Territórios',
		'show_ui' => true,
		'query_var' => true,
		'show_admin_column' => true,
		'labels' => $labels
		) 
	); 
}


// coloque essa função na functions do seu tema, coloque a chamada em alguma página e acesse pelo browser uma única vez
function create_location_terms()
{
	$taxonomy = 'territorio';
	$feed = json_decode(file_get_contents(dirname(__FILE__).'/brazil-cities-states.json')); //este arquivo você pode pegar aqui: https://gist.github.com/brunomarks/8851491
	foreach ($feed->estados as $key => $estado)
	{
		$sigla = $estado->sigla;
		
		$estado_term = term_exists($sigla, $taxonomy);
		
		if($estado_term === null || $estado_term === false )
		{
			$estado_term = wp_insert_term($estado->sigla, $taxonomy);
		}
		
		if( !is_array($estado_term) )
		{
			wp_die("Key:".$key.", estado:".$estado."Error:".print_r($estado_term, true));
		}
			
		$current_term_id = $estado_term['term_id'];
		foreach ($estado->cidades as $key => $cidade)
		{
			$cidade_term = term_exists($cidade, $taxonomy);
			
			if($cidade_term === null || $cidade_term === false )
			{
				$cidade_term = wp_insert_term( $cidade, $taxonomy, array( 'parent'=> $current_term_id ) );
			}
			
			if( get_class($cidade_term) == 'WP_Error')
			{
				wp_die("Key:".$key.", cidade:".$cidade."Error:".print_r($cidade_term, true));
			}
		}
	}
}
// Verifique a taxonomia, deverá conter todas as cidades dentro dos respectivos estados

