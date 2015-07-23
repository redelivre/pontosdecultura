<?php

add_action('init', 'register_pontos_taxonomies');
function register_pontos_taxonomies()
{

	$labels = array
	(
			'name' => __('Tipo do Objeto','pontosdecultura'),
			'singular_name' => __('Tipo do Objeto', 'pontosdecultura'),
			'search_items' => __('Procurar por Tipo do Objeto','pontosdecultura'),
			'all_items' => __('Tipo do Objeto','pontosdecultura'),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __('Editar um Tipo do Objeto','pontosdecultura'),
			'update_item' => __('Atualizar um Tipo do Objeto','pontosdecultura'),
			'add_new_item' => __('Adicionar Novo Tipo do Objeto','pontosdecultura'),
			'add_new' => __('Adicionar Tipo do Objeto', 'pontosdecultura'),
			'new_item_name' => __('Novo Tipo do Objeto','pontosdecultura'),
			'view_item' => __('Visualizar Tipo do Objeto','pontosdecultura'),
			'not_found' =>  __('Nenhum Tipo do Objeto localizado','pontosdecultura'),
			'not_found_in_trash' => __('Nenhum Tipo do Objeto localizado na lixeira','pontosdecultura'),
			'menu_name' => __('Tipo do Objeto','pontosdecultura')
	);
	
	register_taxonomy( 'tipo-do-objeto',array (
			'pratica'
	),
			array( 'hierarchical' => true,
					'label' => 'Tipo do Objeto',
					'show_ui' => true,
					'query_var' => true,
					'show_admin_column' => true,
					'labels' => $labels
			)
	);
	
	/*if(!term_exists('Circo', 'cenico-performativa'))
	{
		wp_insert_term("Circo", 'cenico-performativa');
	
	}*/
	
	$labels = array
	(
			'name' => __('Área(s) da Pesquisa Cênico-Performativa','pontosdecultura'),
			'singular_name' => __('Área da Pesquisa Cênico-Performativa', 'pontosdecultura'),
			'search_items' => __('Procurar por uma área da Pesquisa cênico-performativa','pontosdecultura'),
			'all_items' => __('Todos as áreas da Pesquisa Cênico-Performativas','pontosdecultura'),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __('Editar uma Área da Pesquisa Cênico-Performativa','pontosdecultura'),
			'update_item' => __('Atualizar uma Área da Pesquisa Cênico-Performativa','pontosdecultura'),
			'add_new_item' => __('Adicionar Nova Área da Pesquisa Cênico-Performativa','pontosdecultura'),
			'add_new' => __('Adicionar Área da Pesquisa Cênico-Performativa', 'pontosdecultura'),
			'new_item_name' => __('Nova Área da Pesquisa Cênico-Performativa','pontosdecultura'),
			'view_item' => __('Visualizar Área da Pesquisa Cênico-Performativa','pontosdecultura'),
			'not_found' =>  __('Nenhuma Área da Pesquisa Cênico-Performativa localizada','pontosdecultura'),
			'not_found_in_trash' => __('Nenhuma Área da Pesquisa Cênico-Performativa localizada na lixeira','pontosdecultura'),
			'menu_name' => __('Cênico-Performativa','pontosdecultura')
	);
	
	register_taxonomy( 'cenico-performativa',array (
	'pratica'
			),
			array( 'hierarchical' => true,
			'label' => 'Área(s) da Pesquisa Cênico-Performativa',
			'show_ui' => true,
			'query_var' => true,
			'show_admin_column' => true,
			'labels' => $labels
			)
	);
	
	if(!term_exists('Circo', 'cenico-performativa'))
	{
		wp_insert_term("Circo", 'cenico-performativa');
		wp_insert_term("Contação de Histórias", 'cenico-performativa');
		wp_insert_term("Dança", 'cenico-performativa');
		wp_insert_term("Formas Animadas", 'cenico-performativa');
		wp_insert_term("Intervenção Urbana", 'cenico-performativa');
		wp_insert_term("Mímica", 'cenico-performativa');
		wp_insert_term("Ópera", 'cenico-performativa');
		wp_insert_term("Performance", 'cenico-performativa');
		wp_insert_term("Teatro", 'cenico-performativa');
		wp_insert_term("Teatro de Rua", 'cenico-performativa');
		wp_insert_term("Teatro para Infância e Juventude", 'cenico-performativa');
		
	}
	
	$labels = array
	(
			'name' => __('Natureza','pontosdecultura'),
			'singular_name' => __('Natureza', 'pontosdecultura'),
			'search_items' => __('Procurar em Naturezas','pontosdecultura'),
			'all_items' => __('Todas as Naturezas','pontosdecultura'),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __('Editar Natureza','pontosdecultura'),
			'update_item' => __('Atualizar uma Natureza','pontosdecultura'),
			'add_new_item' => __('Adicionar Nova Natureza','pontosdecultura'),
			'add_new' => __('Adicionar Natureza', 'pontosdecultura'),
			'new_item_name' => __('Nova Natureza','pontosdecultura'),
			'view_item' => __('Visualizar Natureza','pontosdecultura'),
			'not_found' =>  __('Nenhuma natureza localizada','pontosdecultura'),
			'not_found_in_trash' => __('Nenhuma natureza localizada na lixeira','pontosdecultura'),
			'menu_name' => __('Naturezas','pontosdecultura')
	);
	
	register_taxonomy( 'natureza',array (
	'pratica'
			),
			array( 'hierarchical' => true,
			'label' => 'Naturezas',
			'show_ui' => true,
			'query_var' => true,
			'show_admin_column' => true,
			'labels' => $labels
			)
	);

	if(!term_exists('Documental', 'natureza'))
	{
		wp_insert_term("Estética ou de Linguagem", 'natureza');
		wp_insert_term("Metodológica", 'natureza');
		wp_insert_term("Documental", 'natureza');
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$labels = array
	(
			'name' => __('Desdobramentos','pontosdecultura'),
			'singular_name' => __('Desdobramento', 'pontosdecultura'),
			'search_items' => __('Procurar em Desdobramentos','pontosdecultura'),
			'all_items' => __('Todos os Desdobramentos','pontosdecultura'),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __('Editar Desdobramento','pontosdecultura'),
			'update_item' => __('Atualizar um Desdobramento','pontosdecultura'),
			'add_new_item' => __('Adicionar Novo Desdobramento','pontosdecultura'),
			'add_new' => __('Adicionar Desdobramento', 'pontosdecultura'),
			'new_item_name' => __('Novo Desdobramento','pontosdecultura'),
			'view_item' => __('Visualizar Desdobramentos','pontosdecultura'),
			'not_found' =>  __('Nenhum desdobramentos localizado','pontosdecultura'),
			'not_found_in_trash' => __('Nenhum desdobramentos localizado na lixeira','pontosdecultura'),
			'menu_name' => __('Desdobramentos','pontosdecultura')
	);
	
	register_taxonomy( 'desdobramentos',array (
			'pratica'
	),
			array( 'hierarchical' => true,
					'label' => 'Desdobramentos',
					'show_ui' => true,
					'query_var' => true,
					'show_admin_column' => true,
					'labels' => $labels
			)
	);
	
	if(!term_exists('Espetáculos', 'desdobramentos'))
	{
		wp_insert_term("Espetáculos", 'desdobramentos');
		wp_insert_term("Performances", 'desdobramentos');
		wp_insert_term("Publicações Físicas", 'desdobramentos');
		wp_insert_term("Publicações Virtuais", 'desdobramentos');
		wp_insert_term("Aulas", 'desdobramentos');
		wp_insert_term("Filmes e Videos", 'desdobramentos');
	}
	
	/*$labels = array
	(
			'name' => __('Tempo','pontosdecultura'),
			'singular_name' => __('Tempo', 'pontosdecultura'),
			'search_items' => __('Procurar em Tempo','pontosdecultura'),
			'all_items' => __('Todos os Tempo','pontosdecultura'),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __('Editar Tempo','pontosdecultura'),
			'update_item' => __('Atualizar um Tempo','pontosdecultura'),
			'add_new_item' => __('Adicionar Novo Tempo','pontosdecultura'),
			'add_new' => __('Adicionar Tempo', 'pontosdecultura'),
			'new_item_name' => __('Novo Tempo','pontosdecultura'),
			'view_item' => __('Visualizar Tempo','pontosdecultura'),
			'not_found' =>  __('Nenhum tempo localizado','pontosdecultura'),
			'not_found_in_trash' => __('Nenhum tempo localizado na lixeira','pontosdecultura'),
			'menu_name' => __('Tempo','pontosdecultura')
	);
	
	register_taxonomy( 'tempo',array (
			'pratica'
	),
			array( 'hierarchical' => true,
					'label' => 'Tempo',
					'show_ui' => true,
					'query_var' => true,
					'show_admin_column' => true,
					'labels' => $labels
			)
	);
	
	if(!term_exists('Mais de 30 anos', 'tempo'))
	{
		wp_insert_term("1 a 3 anos", 'tempo');
		wp_insert_term("4 a 6 anos", 'tempo');
		wp_insert_term("7 a 10 anos", 'tempo');
		wp_insert_term("11 a 15 anos", 'tempo');
		wp_insert_term("16 a 20 anos", 'tempo');
		wp_insert_term("21 a 30 anos", 'tempo');
		wp_insert_term("Mais de 30 anos", 'tempo');
	}
	
	$labels = array
	(
			'name' => __('Integrantes Estáveis','pontosdecultura'),
			'singular_name' => __('Integrantes Estáveis', 'pontosdecultura'),
			'search_items' => __('Procurar em Integrantes','pontosdecultura'),
			'all_items' => __('Intervalos de Integrantes Estáveis','pontosdecultura'),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __('Editar Integrantes','pontosdecultura'),
			'update_item' => __('Atualizar um Integrantes','pontosdecultura'),
			'add_new_item' => __('Adicionar Novo Integrantes','pontosdecultura'),
			'add_new' => __('Adicionar Integrantes', 'pontosdecultura'),
			'new_item_name' => __('Novo Integrantes','pontosdecultura'),
			'view_item' => __('Visualizar Integrantes','pontosdecultura'),
			'not_found' =>  __('Nenhuma Integrantes localizado','pontosdecultura'),
			'not_found_in_trash' => __('Nenhuma Integrantes localizado na lixeira','pontosdecultura'),
			'menu_name' => __('Nº de Integrantes','pontosdecultura')
	);
	
	register_taxonomy( 'integrantes',array (
			'pratica'
	),
			array( 'hierarchical' => true,
					'label' => 'Nº de Integrantes',
					'show_ui' => true,
					'query_var' => true,
					'show_admin_column' => true,
					'labels' => $labels
			)
	);
	
	if(!term_exists('1', 'integrantes'))
	{
		wp_insert_term("1", 'integrantes');
		wp_insert_term("2", 'integrantes');
		wp_insert_term("3", 'integrantes');
		wp_insert_term("4", 'integrantes');
		wp_insert_term("5 a 10", 'integrantes');
		wp_insert_term("11 a 20", 'integrantes');
		wp_insert_term("Mais de 20", 'integrantes');
	}*/
	
	$labels = array
	(
			'name' => __('Público Alvo','pontosdecultura'),
			'singular_name' => __('Público Alvo', 'pontosdecultura'),
			'search_items' => __('Procurar em Público Alvo','pontosdecultura'),
			'all_items' => __('Todos os Públicos Alvos','pontosdecultura'),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __('Editar Público Alvo','pontosdecultura'),
			'update_item' => __('Atualizar um Público Alvo','pontosdecultura'),
			'add_new_item' => __('Adicionar Novo Público Alvo','pontosdecultura'),
			'add_new' => __('Adicionar Público Alvo', 'pontosdecultura'),
			'new_item_name' => __('Novo Público Alvo','pontosdecultura'),
			'view_item' => __('Visualizar Público Alvo','pontosdecultura'),
			'not_found' =>  __('Nenhum Público Alvo localizado','pontosdecultura'),
			'not_found_in_trash' => __('Nenhum Público Alvo localizado na lixeira','pontosdecultura'),
			'menu_name' => __('Público Alvo','pontosdecultura')
	);
	
	register_taxonomy( 'publico-alvo',array (
			'pratica'
	),
			array( 'hierarchical' => true,
					'label' => 'Público Alvo',
					'show_ui' => true,
					'query_var' => true,
					'show_admin_column' => true,
					'labels' => $labels
			)
	);
	
	if(!term_exists('Público em Geral', 'publico-alvo'))
	{
		wp_insert_term("Público em Geral", 'publico-alvo');
		wp_insert_term("Estudantes", 'publico-alvo');
		wp_insert_term("Comunidade LGBT", 'publico-alvo');
		wp_insert_term("Pessoas com Necessidades Especiais", 'publico-alvo');
		wp_insert_term("Pessoas em Sofrimento Psíquico", 'publico-alvo');
		wp_insert_term("Infância", 'publico-alvo');
		wp_insert_term("Juventude", 'publico-alvo');
		wp_insert_term("Idosos", 'publico-alvo');
		wp_insert_term("Mulheres", 'publico-alvo');
		wp_insert_term("Afro-Brasileiro", 'publico-alvo');
		wp_insert_term("Cigano", 'publico-alvo');
		wp_insert_term("Imigrantes	", 'publico-alvo');
		wp_insert_term("Indígenas", 'publico-alvo');
		wp_insert_term("Pescadores", 'publico-alvo');
		wp_insert_term("População em Regime Prisional", 'publico-alvo');
		wp_insert_term("Povos de Terreiro", 'publico-alvo');
		wp_insert_term("Quilombolas", 'publico-alvo');
		wp_insert_term("Ribeirinhos", 'publico-alvo');
		wp_insert_term("Outros segmentos Populares", 'publico-alvo');
	}
	
	$labels = array
	(
			'name' => __('Ressonâncias','pontosdecultura'),
			'singular_name' => __('Ressonância', 'pontosdecultura'),
			'search_items' => __('Procurar em Ressonâncias','pontosdecultura'),
			'all_items' => __('Todas as Ressonâncias','pontosdecultura'),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __('Editar Ressonância','pontosdecultura'),
			'update_item' => __('Atualizar uma Ressonância','pontosdecultura'),
			'add_new_item' => __('Adicionar Nova Ressonância','pontosdecultura'),
			'add_new' => __('Adicionar Ressonância', 'pontosdecultura'),
			'new_item_name' => __('Nova Ressonância','pontosdecultura'),
			'view_item' => __('Visualizar Ressonância','pontosdecultura'),
			'not_found' =>  __('Nenhuma Ressonância localizada','pontosdecultura'),
			'not_found_in_trash' => __('Nenhuma Ressonância localizada na lixeira','pontosdecultura'),
			'menu_name' => __('Ressonâncias','pontosdecultura')
	);
	
	register_taxonomy( 'ressonancias',array (
			'pratica'
	),
			array( 'hierarchical' => true,
					'label' => 'Ressonâncias',
					'show_ui' => true,
					'query_var' => true,
					'show_admin_column' => true,
					'labels' => $labels
			)
	);
	
	if(!term_exists('Antropologia', 'ressonancias'))
	{
		wp_insert_term("Antropologia", 'ressonancias');
		wp_insert_term("Arqueologia", 'ressonancias');
		wp_insert_term("Arquitetura-Urbanismo", 'ressonancias');
		wp_insert_term("Arquivo", 'ressonancias');
		wp_insert_term("Arte Digital", 'ressonancias');
		wp_insert_term("Artes Visuais", 'ressonancias');
		wp_insert_term("Artesanato", 'ressonancias');
		wp_insert_term("Audiovisual", 'ressonancias');
		wp_insert_term("Banda", 'ressonancias');
		wp_insert_term("Biblioteca", 'ressonancias');
		wp_insert_term("Capoeira", 'ressonancias');
		wp_insert_term("Carnaval", 'ressonancias');
		wp_insert_term("Ciência Política", 'ressonancias');
		wp_insert_term("Cinema", 'ressonancias');
		wp_insert_term("Comunicação", 'ressonancias');
		wp_insert_term("Coral", 'ressonancias');
		wp_insert_term("Cultura Cigana", 'ressonancias');
		wp_insert_term("Cultura Digital", 'ressonancias');
		wp_insert_term("Cultura Estrangeira(imigrantes)", 'ressonancias');
		wp_insert_term("Cultura Indígena", 'ressonancias');
		wp_insert_term("Cultura LGBT", 'ressonancias');
		wp_insert_term("Cultura Negra", 'ressonancias');
		wp_insert_term("Cultura Popular", 'ressonancias');
		wp_insert_term("Design", 'ressonancias');
		wp_insert_term("Direito Autoral", 'ressonancias');
		wp_insert_term("Economia Criativa", 'ressonancias');
		wp_insert_term("Educação", 'ressonancias');
		wp_insert_term("Esporte", 'ressonancias');
		wp_insert_term("Filosofia", 'ressonancias');
		wp_insert_term("Fotografia", 'ressonancias');
		wp_insert_term("Gastronomia", 'ressonancias');
		wp_insert_term("Gestão Cultural", 'ressonancias');
		wp_insert_term("Gestor Publico de Cultura", 'ressonancias');
		wp_insert_term("História", 'ressonancias');
		wp_insert_term("Jogos Eletrônicos", 'ressonancias');
		wp_insert_term("Jornalismo", 'ressonancias');
		wp_insert_term("Leitura", 'ressonancias');
		wp_insert_term("Literatura", 'ressonancias');
		wp_insert_term("Livro", 'ressonancias');
		wp_insert_term("Meio Ambiente", 'ressonancias');
		wp_insert_term("Mídias Sociais", 'ressonancias');
		wp_insert_term("Moda", 'ressonancias');
		wp_insert_term("Museu", 'ressonancias');
		wp_insert_term("Música", 'ressonancias');
		wp_insert_term("Novas Mídias", 'ressonancias');
		wp_insert_term("Orquestra", 'ressonancias');
		wp_insert_term("Patrimônio Imaterial", 'ressonancias');
		wp_insert_term("Patrimônio Material", 'ressonancias');
		wp_insert_term("Pesquisa", 'ressonancias');
		wp_insert_term("Produção Cultural", 'ressonancias');
		wp_insert_term("Rádio", 'ressonancias');
		wp_insert_term("Saúde", 'ressonancias');
		wp_insert_term("Sociologia", 'ressonancias');
		wp_insert_term("Televisão", 'ressonancias');
		wp_insert_term("Turismo", 'ressonancias');
	}
	
	
}


?>