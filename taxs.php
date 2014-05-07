<?php

add_action('init', 'register_pontos_taxonomies');
function register_pontos_taxonomies()
{

	$labels = array
	(
			'name' => __('Tipo de Ação da Iniciativa','pontosdecultura'),
			'singular_name' => __('Tipo de Ação da Iniciativa', 'pontosdecultura'),
			'search_items' => __('Procurar por um tipo','pontosdecultura'),
			'all_items' => __('Todos os tipos','pontosdecultura'),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __('Editar um Tipo','pontosdecultura'),
			'update_item' => __('Atualizar um Tipo','pontosdecultura'),
			'add_new_item' => __('Adicionar Novo Tipo','pontosdecultura'),
			'add_new' => __('Adicionar Tipo', 'pontosdecultura'),
			'new_item_name' => __('Novo Tipo','pontosdecultura'),
			'view_item' => __('Visualizar Tipo','pontosdecultura'),
			'not_found' =>  __('Nenhum tipo localizado','pontosdecultura'),
			'not_found_in_trash' => __('Nenhum Tipo localizado na lixeira','pontosdecultura'),
			'menu_name' => __('Tipos','pontosdecultura')
	);
	
	register_taxonomy( 'tipo',array (
	'mapa'
			),
			array( 'hierarchical' => true,
			'label' => 'Tipo de Ação da Iniciativa',
			'show_ui' => true,
			'query_var' => true,
			'show_admin_column' => true,
			'labels' => $labels
			)
	);
	
	wp_insert_term("Pontão de Bens", 'tipo');
	wp_insert_term("Pontão Direto", 'tipo');
	wp_insert_term("Ponto de Cultura Indígena", 'tipo');
	wp_insert_term("Ponto Direto", 'tipo');
	wp_insert_term("Rede Estadual", 'tipo');
	wp_insert_term("Rede Intermunicipal", 'tipo');
	wp_insert_term("Rede Municipal", 'tipo');
	
	$labels = array
	(
			'name' => __('Temático','pontosdecultura'),
			'singular_name' => __('Temático', 'pontosdecultura'),
			'search_items' => __('Procurar em um audiovisual','pontosdecultura'),
			'all_items' => __('Todos os audiovisuals','pontosdecultura'),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __('Editar um Temático','pontosdecultura'),
			'update_item' => __('Atualizar um Temático','pontosdecultura'),
			'add_new_item' => __('Adicionar Novo Temático','pontosdecultura'),
			'add_new' => __('Adicionar Temático', 'pontosdecultura'),
			'new_item_name' => __('Novo Temático','pontosdecultura'),
			'view_item' => __('Visualizar Temático','pontosdecultura'),
			'not_found' =>  __('Nenhum audiovisual localizado','pontosdecultura'),
			'not_found_in_trash' => __('Nenhum Temático localizado na lixeira','pontosdecultura'),
			'menu_name' => __('Temáticos','pontosdecultura')
	);
	
	register_taxonomy( 'audiovisual',array (
	'mapa'
			),
			array( 'hierarchical' => true,
			'label' => 'Temáticos',
			'show_ui' => true,
			'query_var' => true,
			'show_admin_column' => true,
			'labels' => $labels
			)
	);

	/**
	 * Temático, temos:
Escola Viva
Cultura Digital
Interações Estéticas
Mídia Livre
Cultura, Infância e Adolescência
Cultura e Terceira Idade
Cultura e Direitos Humans
Cultura e Saúde
Economia Criativa e Solidária
Leitura e Cidadania
Grupos Itinerantes
Educação Patrimonial
Conhecimento e Tradições Orais
	 */
	/*array(
	 'description'=> 'A yummy apple.',
			'slug' => 'apple',
			'parent'=> $parent_term_id
	)*/
	
	wp_insert_term("Escola Viva", 'audiovisual');
	wp_insert_term("Cultura Digital", 'audiovisual');
	wp_insert_term("Interações Estéticas", 'audiovisual');
	wp_insert_term("Mídia Livre", 'audiovisual');
	wp_insert_term("Cultura, Infância e Adolescência", 'audiovisual');
	wp_insert_term("Cultura e Terceira Idade", 'audiovisual');
	wp_insert_term("Cultura e Direitos Humans", 'audiovisual');
	wp_insert_term("Cultura e Saúde", 'audiovisual');
	wp_insert_term("Economia Criativa e Solidária", 'audiovisual');
	wp_insert_term("Leitura e Cidadania", 'audiovisual');
	wp_insert_term("Grupos Itinerantes", 'audiovisual');
	wp_insert_term("Educação Patrimonial", 'audiovisual');
	wp_insert_term("Conhecimento e Tradições Orais", 'audiovisual');
	
	
	$labels = array
	(
			'name' => __('Identitário','pontosdecultura'),
			'singular_name' => __('Identitário', 'pontosdecultura'),
			'search_items' => __('Procurar em um identitario','pontosdecultura'),
			'all_items' => __('Todos os identitarios','pontosdecultura'),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __('Editar um Identitário','pontosdecultura'),
			'update_item' => __('Atualizar um Identitário','pontosdecultura'),
			'add_new_item' => __('Adicionar Novo Identitário','pontosdecultura'),
			'add_new' => __('Adicionar Identitário', 'pontosdecultura'),
			'new_item_name' => __('Novo Identitário','pontosdecultura'),
			'view_item' => __('Visualizar Identitário','pontosdecultura'),
			'not_found' =>  __('Nenhum identitario localizado','pontosdecultura'),
			'not_found_in_trash' => __('Nenhum Identitário localizado na lixeira','pontosdecultura'),
			'menu_name' => __('Identitários','pontosdecultura')
	);
	
	register_taxonomy( 'identitario',array (
	'mapa'
			),
			array( 'hierarchical' => true,
			'label' => 'Identitários',
			'show_ui' => true,
			'query_var' => true,
			'show_admin_column' => true,
			'labels' => $labels
			)
	);
	
	/**
	 * 
Culturas Populares
Culturas Indígenas
Culturas Afrobrasileiras
Culturas Ciganas
Grupos Artísticos e Culturais Independentes
Povos e Comunidades Tradicionais
Infância e Adolescência
Juventude
Idosos
LGBT
Mulheres
Pessoas em Sofrimento Psíquico
Pessoas com Deficiência
Grupos com Vulnerabilidade Extrema
	 */

	wp_insert_term("Culturas Populares", 'identitario');
	wp_insert_term("Culturas Indígenas", 'identitario');
	wp_insert_term("Culturas Afrobrasileiras", 'identitario');
	wp_insert_term("Culturas Ciganas", 'identitario');
	wp_insert_term("Grupos Artísticos e Culturais Independentes", 'identitario');
	wp_insert_term("Povos e Comunidades Tradicionais", 'identitario');
	wp_insert_term("Infância e Adolescência", 'identitario');
	wp_insert_term("Juventude", 'identitario');
	wp_insert_term("Idosos", 'identitario');
	wp_insert_term("LGBT", 'identitario');
	wp_insert_term("Mulheres", 'identitario');
	wp_insert_term("Pessoas em Sofrimento Psíquico", 'identitario');
	wp_insert_term("Pessoas com Deficiência", 'identitario');
	wp_insert_term("Grupos com Vulnerabilidade Extrema", 'identitario');
	
	
	$labels = array
	(
			'name' => __('Público Alvo','pontosdecultura'),
			'singular_name' => __('Público Alvo', 'pontosdecultura'),
			'search_items' => __('Procurar em um publicoalvo','pontosdecultura'),
			'all_items' => __('Todos os publicoalvos','pontosdecultura'),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __('Editar um Público Alvo','pontosdecultura'),
			'update_item' => __('Atualizar um Público Alvo','pontosdecultura'),
			'add_new_item' => __('Adicionar Novo Público Alvo','pontosdecultura'),
			'add_new' => __('Adicionar Público Alvo', 'pontosdecultura'),
			'new_item_name' => __('Novo Público Alvo','pontosdecultura'),
			'view_item' => __('Visualizar Público Alvo','pontosdecultura'),
			'not_found' =>  __('Nenhum publicoalvo localizado','pontosdecultura'),
			'not_found_in_trash' => __('Nenhum Público Alvo localizado na lixeira','pontosdecultura'),
			'menu_name' => __('Público Alvo','pontosdecultura')
	);
	
	register_taxonomy( 'publicoalvo',array (
	'mapa'
			),
			array( 'hierarchical' => true,
			'label' => 'Público Alvo',
			'show_ui' => true,
			'query_var' => true,
			'show_admin_column' => true,
			'labels' => $labels
			)
	);
	
	/**
	 * 
Afro-Brasileiras
Ciganas
Estudantes
Grupos Artísticos e Culturais Independentes
Idosos
Imigrantes
Indígenas
Infância e Adolescência
Juventude
LGBT
Mulheres
Pescadores
Pessoas com deficiência
Pessoas em sofrimento psíquico
População de Rua
População em regime prisional 
Povos de Terreiro
Público em Geral
Quebradeiras de coco de Babaçu
Quilombolas
Ribeirinhos
Segmentos Populares
Outros
	 */
	
	wp_insert_term("Afro-Brasileiras", 'publicoalvo');
	wp_insert_term("Ciganas", 'publicoalvo');
	wp_insert_term("Estudantes", 'publicoalvo');
	wp_insert_term("Grupos Artísticos e Culturais Independentes", 'publicoalvo');
	wp_insert_term("Idosos", 'publicoalvo');
	wp_insert_term("Imigrantes", 'publicoalvo');
	wp_insert_term("Indígenas", 'publicoalvo');
	wp_insert_term("Infância e Adolescência", 'publicoalvo');
	wp_insert_term("Juventude", 'publicoalvo');
	wp_insert_term("LGBT", 'publicoalvo');
	wp_insert_term("Mulheres", 'publicoalvo');
	wp_insert_term("Pescadores", 'publicoalvo');
	wp_insert_term("Pessoas com deficiência", 'publicoalvo');
	wp_insert_term("Pessoas em sofrimento psíquico", 'publicoalvo');
	wp_insert_term("População de Rua", 'publicoalvo');
	wp_insert_term("População em regime prisional ", 'publicoalvo');
	wp_insert_term("Povos de Terreiro", 'publicoalvo');
	wp_insert_term("Público em Geral", 'publicoalvo');
	wp_insert_term("Quebradeiras de coco de Babaçu", 'publicoalvo');
	wp_insert_term("Quilombolas", 'publicoalvo');
	wp_insert_term("Ribeirinhos", 'publicoalvo');
	wp_insert_term("Segmentos Populares", 'publicoalvo');
	wp_insert_term("Outros", 'publicoalvo');
	
	
	$labels = array
	(
			'name' => __('Artes Cênicas','pontosdecultura'),
			'singular_name' => __('Artes Cênicas', 'pontosdecultura'),
			'search_items' => __('Procurar por uma artes cênica','pontosdecultura'),
			'all_items' => __('Todos as artes cênicas','pontosdecultura'),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __('Editar um Artes Cênicas','pontosdecultura'),
			'update_item' => __('Atualizar um Artes Cênicas','pontosdecultura'),
			'add_new_item' => __('Adicionar Nova Artes Cênicas','pontosdecultura'),
			'add_new' => __('Adicionar Artes Cênicas', 'pontosdecultura'),
			'new_item_name' => __('Nova Artes Cênicas','pontosdecultura'),
			'view_item' => __('Visualizar Artes Cênicas','pontosdecultura'),
			'not_found' =>  __('Nenhum artes cênica localizada','pontosdecultura'),
			'not_found_in_trash' => __('Nenhuma Artes Cênica localizada na lixeira','pontosdecultura'),
			'menu_name' => __('Artes Cênicas','pontosdecultura')
	);
	
	register_taxonomy( 'artescenicas',array (
	'mapa'
			),
			array( 'hierarchical' => true,
			'label' => 'Artes Cênicas',
			'show_ui' => true,
			'query_var' => true,
			'show_admin_column' => true,
			'labels' => $labels
			)
	);
	
	/**
	 * 
Circo 
Dança 
Mímica
Ópera 
Teatro 
	 */
	
	wp_insert_term("Circo", 'artescenicas');
	wp_insert_term("Dança", 'artescenicas');
	wp_insert_term("Mímica", 'artescenicas');
	wp_insert_term("Ópera", 'artescenicas');
	wp_insert_term("Teatro", 'artescenicas');
	
	$labels = array
	(
			'name' => __('Audiovisual','pontosdecultura'),
			'singular_name' => __('Audiovisual', 'pontosdecultura'),
			'search_items' => __('Procurar em um audiovisual','pontosdecultura'),
			'all_items' => __('Todos os audiovisuals','pontosdecultura'),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __('Editar um Audiovisual','pontosdecultura'),
			'update_item' => __('Atualizar um Audiovisual','pontosdecultura'),
			'add_new_item' => __('Adicionar Novo Audiovisual','pontosdecultura'),
			'add_new' => __('Adicionar Audiovisual', 'pontosdecultura'),
			'new_item_name' => __('Novo Audiovisual','pontosdecultura'),
			'view_item' => __('Visualizar Audiovisual','pontosdecultura'),
			'not_found' =>  __('Nenhum audiovisual localizado','pontosdecultura'),
			'not_found_in_trash' => __('Nenhum Audiovisual localizado na lixeira','pontosdecultura'),
			'menu_name' => __('Audiovisual','pontosdecultura')
	);
	
	register_taxonomy( 'audiovisual',array (
	'mapa'
			),
			array( 'hierarchical' => true,
			'label' => 'Audiovisual',
			'show_ui' => true,
			'query_var' => true,
			'show_admin_column' => true,
			'labels' => $labels
			)
	);
	
	/**
	 *
Difusão
Distribuição Cinematográfica
Eventos
Exibição Cinematográfica
Formação/Pesquisa/Informação
Infra-estrutura Técnica Audiovisual
Multimídia
Preservação/Restauração da Memória Cinematográfica
Produção Cinematográfica
Produção Radiofônica
Produção Televisiva
Rádios/Tvs Educativas
Videofonografia
	 */
	
	wp_insert_term("Difusão", 'audiovisual');
	wp_insert_term("Distribuição Cinematográfica", 'audiovisual');
	wp_insert_term("Eventos", 'audiovisual');
	wp_insert_term("Exibição Cinematográfica", 'audiovisual');
	wp_insert_term("Formação/Pesquisa/Informação", 'audiovisual');
	wp_insert_term("Infra-estrutura Técnica Audiovisual", 'audiovisual');
	wp_insert_term("Multimídia", 'audiovisual');
	wp_insert_term("Preservação/Restauração da Memória Cinematográfica", 'audiovisual');
	wp_insert_term("Produção Cinematográfica", 'audiovisual');
	wp_insert_term("Produção Radiofônica", 'audiovisual');
	wp_insert_term("Produção Televisiva", 'audiovisual');
	wp_insert_term("Rádios/Tvs Educativas", 'audiovisual');
	wp_insert_term("Videofonografia", 'audiovisual');
	
	
}

?>