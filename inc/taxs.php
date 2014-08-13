<?php

add_action('init', 'register_pontos_taxonomies');
function register_pontos_taxonomies()
{

	$labels = array
	(
			'name' => __('Ação em DH','pontosdecultura'),
			'singular_name' => __('Ação em DH', 'pontosdecultura'),
			'search_items' => __('Procurar em uma Ação em DH','pontosdecultura'),
			'all_items' => __('Todos as Ações em DH','pontosdecultura'),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __('Editar Ação em DH','pontosdecultura'),
			'update_item' => __('Atualizar uma Ação em DH','pontosdecultura'),
			'add_new_item' => __('Adicionar Nova Ação em DH','pontosdecultura'),
			'add_new' => __('Adicionar Ação em DH', 'pontosdecultura'),
			'new_item_name' => __('Nova Ação em DH','pontosdecultura'),
			'view_item' => __('Visualizar Ação em DH','pontosdecultura'),
			'not_found' =>  __('Nenhuma Ação em DH localizado','pontosdecultura'),
			'not_found_in_trash' => __('Nenhuma Ação em DH localizado na lixeira','pontosdecultura'),
			'menu_name' => __('Ações em DH','pontosdecultura')
	);
	
	register_taxonomy( 'acao',array (
	'mapa'
			),
			array( 'hierarchical' => true,
			'label' => 'Ações em DH',
			'show_ui' => true,
			'query_var' => true,
			'show_admin_column' => true,
			'labels' => $labels
			)
	);

	/**
	 * Ação em DH, temos:
Promoção
Proteção
Reparação
	 */
	/*array(
	 'description'=> 'A yummy apple.',
			'slug' => 'apple',
			'parent'=> $parent_term_id
	)*/
	
	if(!term_exists('Promoção', 'acao'))
	{
		wp_insert_term("Promoção", 'acao');
		wp_insert_term("Proteção", 'acao');
		wp_insert_term("Reparação", 'acao');
	}
	
	$labels = array
	(
			'name' => __('Eixo','pontosdecultura'),
			'singular_name' => __('Eixo', 'pontosdecultura'),
			'search_items' => __('Procurar em um identitario','pontosdecultura'),
			'all_items' => __('Todos os identitarios','pontosdecultura'),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __('Editar um Eixo','pontosdecultura'),
			'update_item' => __('Atualizar um Eixo','pontosdecultura'),
			'add_new_item' => __('Adicionar Novo Eixo','pontosdecultura'),
			'add_new' => __('Adicionar Eixo', 'pontosdecultura'),
			'new_item_name' => __('Novo Eixo','pontosdecultura'),
			'view_item' => __('Visualizar Eixo','pontosdecultura'),
			'not_found' =>  __('Nenhum identitario localizado','pontosdecultura'),
			'not_found_in_trash' => __('Nenhum Eixo localizado na lixeira','pontosdecultura'),
			'menu_name' => __('Eixos','pontosdecultura')
	);
	
	register_taxonomy( 'eixo',array (
	'mapa'
			),
			array( 'hierarchical' => true,
			'label' => 'Eixos',
			'show_ui' => true,
			'query_var' => true,
			'show_admin_column' => true,
			'labels' => $labels
			)
	);
	
	/**
	 * 
Ambiental
Civil
Cultural
Econômico
Político
Social
	 */

	if(!term_exists('Ambiental', 'eixo'))
	{
		wp_insert_term("Ambiental", 'eixo');
		wp_insert_term("Civil", 'eixo');
		wp_insert_term("Cultural", 'eixo');
		wp_insert_term("Econômico", 'eixo');
		wp_insert_term("Político", 'eixo');
		wp_insert_term("Social", 'eixo');
	}
	
	
	$labels = array
	(
			'name' => __('Sujeito de direito','pontosdecultura'),
			'singular_name' => __('Sujeito de direito', 'pontosdecultura'),
			'search_items' => __('Procurar em um Sujeito de direito','pontosdecultura'),
			'all_items' => __('Todos os Sujeitos de direito','pontosdecultura'),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __('Editar um Sujeito de direito','pontosdecultura'),
			'update_item' => __('Atualizar um Sujeito de direito','pontosdecultura'),
			'add_new_item' => __('Adicionar Novo Sujeito de direito','pontosdecultura'),
			'add_new' => __('Adicionar Sujeito de direito', 'pontosdecultura'),
			'new_item_name' => __('Novo Sujeito de direito','pontosdecultura'),
			'view_item' => __('Visualizar Sujeito de direito','pontosdecultura'),
			'not_found' =>  __('Nenhum Sujeito de direito localizado','pontosdecultura'),
			'not_found_in_trash' => __('Nenhum Sujeito de direito localizado na lixeira','pontosdecultura'),
			'menu_name' => __('Sujeito de direito','pontosdecultura')
	);
	
	register_taxonomy( 'sujeito',array (
	'mapa'
			),
			array( 'hierarchical' => true,
			'label' => 'Sujeitos de direito',
			'show_ui' => true,
			'query_var' => true,
			'show_admin_column' => true,
			'labels' => $labels
			)
	);
	
	/**
	 * 
Agricultores
Camponeses
Catadores
Crianças e adolescentes
Crianças, jovens e mulheres
Estudantes
Genérico
Gênero
Jovens
Jovens do campo
Jovens do campo e mulheres
Juventude
Juventude e mulher
Lideranças camponesas
MST
Mulheres
Mulheres e jovens
Pacientes internados
Povos indígenas
Produtores de hortaliças
Quilombolas
Trabalhadores rurais sem terra
	 */
	
	if(!term_exists('Agricultores', 'sujeito'))
	{
		wp_insert_term("Agricultores", 'sujeito');
		wp_insert_term("Camponeses", 'sujeito');
		wp_insert_term("Catadores", 'sujeito');
		wp_insert_term("Crianças e adolescentes", 'sujeito');
		wp_insert_term("Crianças, jovens e mulheres", 'sujeito');
		wp_insert_term("Estudantes", 'sujeito');
		wp_insert_term("Genérico", 'sujeito');
		wp_insert_term("Gênero", 'sujeito');
		wp_insert_term("Jovens", 'sujeito');
		wp_insert_term("Jovens do campo", 'sujeito');
		wp_insert_term("Jovens do campo e mulheres", 'sujeito');
		wp_insert_term("Juventude", 'sujeito');
		wp_insert_term("Juventude e mulher", 'sujeito');
		wp_insert_term("Lideranças camponesas", 'sujeito');
		wp_insert_term("MST", 'sujeito');
		wp_insert_term("Mulheres", 'sujeito');
		wp_insert_term("Mulheres e jovens", 'sujeito');
		wp_insert_term("Pacientes internados", 'sujeito');
		wp_insert_term("Povos indígenas", 'sujeito');
		wp_insert_term("Produtores de hortaliças", 'sujeito');
		wp_insert_term("Quilombolas", 'sujeito');
		wp_insert_term("Trabalhadores rurais sem terra", 'sujeito');
	}
	
}


?>