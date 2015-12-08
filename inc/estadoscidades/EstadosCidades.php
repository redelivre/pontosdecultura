<?php
// É aconselhável criar um backup do banco antes

class EstadosCidades
{

	function __construct()
	{
		add_action( 'init', array($this, 'register_locations') );
		add_action( 'wp_ajax_select_dropdown_cidade', array($this, 'select_dropdown_cidade_callback') );
		add_action( 'wp_ajax_nopriv_select_dropdown_cidade', array($this, 'select_dropdown_cidade_callback') );
		add_action( 'wp_enqueue_scripts', array($this, 'javascript'));
		
		add_action( 'wp_ajax_filter_select_cidade', array($this, 'filter_select_cidade_callback') );//TODO merge callbacks
		add_action( 'wp_ajax_nopriv_filter_select_cidade', array($this, 'filter_select_cidade_callback') );
	}
	
	public function javascript()
	{
		$path = get_template_directory_uri() . '/inc/estadoscidades/js';
		wp_register_script('EstadosCidadesScritps', $path . '/EstadosCidades.js', array( 'jquery' ));
		wp_enqueue_script('EstadosCidadesScritps');
		wp_localize_script( 'EstadosCidadesScritps', 'EstadosCidades_object',
			array( 'ajax_url' => admin_url( 'admin-ajax.php' )) );
	}
	
	// crie a taxonomia cidade na functions do tema
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
		  'emrede'
		),
		array( 'hierarchical' => true,
			'label' => 'Territórios',
			'show_ui' => true,
			'query_var' => true,
			'show_admin_column' => true,
			'labels' => $labels
			) 
		);
		
		if(!term_exists('Curitiba', 'territorio'))
		{
			ini_set("memory_limit", "2048M");
			set_time_limit(0);
			$this->create_location_terms();
		}
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
				$estado_term = wp_insert_term($estado->sigla, $taxonomy, array('description' => $estado->nome));
			}
			
			if( !is_array($estado_term) )
			{
				echo "Key:".$key.", estado:".$estado."Error:".print_r($estado_term, true);
			}
				
			$current_term_id = $estado_term['term_id'];
			foreach ($estado->cidades as $key => $cidade)
			{
				$cidade_term = term_exists($cidade, $taxonomy);
				
				if($cidade_term === null || $cidade_term === false )
				{
					$cidade_term = wp_insert_term( $cidade, $taxonomy, array( 'parent'=> $current_term_id ) );
					
					if( !is_array($cidade_term) && get_class($cidade_term) == 'WP_Error')
					{
						echo "Key:".$key.", cidade:".$cidade."Error:".print_r($cidade_term, true);
					}
					
				}
				unset($cidade_term);
				unset($estado_term);
			}
		}
	}
	// Verifique a taxonomia, deverá conter todas as cidades dentro dos respectivos estados
	
	static function dropdown($taxonomy = 'territorio', $nameEstado = 'dropdown-estado', $nameCidade = 'dropdown-cidade')
	{?>
		<div class="dropdown-estado dropdown-<?php echo $nameEstado; ?>">
			<select name="<?php echo $nameEstado; ?>" class="dropdown-estado" autocomplete="off">
				<option value="" selected="selected" ><?php echo esc_attr_x('Estado', 'pontosdecultura' ); ?></option>
				<?php
					$terms = get_terms($taxonomy, array('parent' => 0, 'orderby' => 'name', 'hide_empty' => false));
					foreach ($terms as $term)
					{
						?>
						<option value="<?php echo $term->term_id; ?>" ><?php echo $term->name; ?></option>
						<?php
					} 
				?>
			</select>
		</div>
		<div class="dropdown-cidade dropdown-<?php echo $nameCidade; ?>">
			<select name="<?php echo $nameCidade; ?>" class="dropdown-cidade">
				<option value="" selected="selected" ><?php echo esc_attr_x('Cidade', 'pontosdecultura' ); ?></option>
			</select>
		</div>
		<?php
	}
	
	public function select_dropdown_cidade_callback()
	{
		?>
			<select name="taxonomy_territorio[]" class="dropdown-cidade">
				<option value="" selected="selected" ><?php echo esc_attr_x('Cidade', 'pontosdecultura' ); ?></option>
				<?php
				if(array_key_exists('uf', $_POST) && !empty($_POST['uf']))
				{
					$parent = get_term_by('id', esc_attr($_POST['uf']), 'territorio');
					if(is_object($parent))
					{
						$terms = get_terms('territorio', array('child_of' => $parent->term_id, 'orderby' => 'name', 'hide_empty' => false));
						foreach ($terms as $term)
						{
							?>
							<option value="<?php echo $term->term_id; ?>" ><?php echo $term->name; ?></option>
							<?php
						}
					}
				}
				?>
			</select>
		<?php
		die();
	}
	
	static function check_location_terms()
	{
		$taxonomy = 'territorio';
		$feed = json_decode(file_get_contents(dirname(__FILE__).'/brazil-cities-states.json')); //este arquivo você pode pegar aqui: https://gist.github.com/brunomarks/8851491
		foreach ($feed->estados as $key => $estado)
		{
			$sigla = $estado->sigla;
				
			$estado_term = term_exists($sigla, $taxonomy);
				
			if($estado_term === null || $estado_term === false )
			{
				$estado_term = wp_insert_term($estado->sigla, $taxonomy, array('description' => $estado->nome));
			}
				
			if( !is_array($estado_term) )
			{
				echo "Error on Key:".$key.", estado:".$estado."Error:".print_r($estado_term, true);
				continue;
			}
			else 
			{
				echo "$sigla: OK<br/>";
			}
	
			$current_term_id = $estado_term['term_id'];
			foreach ($estado->cidades as $key => $cidade)
			{
				$cidade_term = term_exists($cidade, $taxonomy);
	
				if($cidade_term === null || $cidade_term === false )
				{
					$cidade_term = wp_insert_term( $cidade, $taxonomy, array( 'parent'=> $current_term_id ) );
						
					if( !is_array($cidade_term) && get_class($cidade_term) == 'WP_Error')
					{
						echo "Error Key:".$key.", cidade:".$cidade."Error:".print_r($cidade_term, true);
					}
					else 
					{
						echo "$cidade: OK<br/>";
					}
				}
				else
				{
					echo "$cidade: OK<br/>";
				}
				unset($cidade_term);
				unset($estado_term);
			}
		}
		die();
	}
	
	public static function filter_select_cidade_callback()
	{
		?>
		<select name="filter-panel-cidade" class="filter-panel-cidade">
			<option value="" selected="selected" ><?php echo esc_attr_x('Cidade', 'pontosdecultura' ); ?></option>
			<?php
			if(array_key_exists('uf', $_POST) && !empty($_POST['uf']))
			{
				$parent = get_term_by('slug', $_POST['uf'], 'territorio');
				if(is_object($parent))
				{
					$terms = get_terms('territorio', array('child_of' => $parent->term_id, 'orderby' => 'name'));
					foreach ($terms as $term)
					{
						if($term->count > 0)
						{
							?>
							<option value="<?php echo $term->slug; ?>" ><?php echo $term->name; ?></option>
							<?php
						}
					}
				}
			}
			?>
		</select>
		<?php
		die();
	}
	
}

global $EstadosCidades;
$EstadosCidades = new EstadosCidades();
