<?php

class Praticas
{
	function __construct()
	{
		$this->_customs = array(
			'url' => array
			(
					'slug' => 'pratica-url',
					'title' => __('Site', 'pontosdecultura'),
					'tip' => __('Endereço da página na Web', 'pontosdecultura'),
			),
			'email' => array
			(
					'slug' => 'pratica-email',
					'title' => __('Email', 'pontosdecultura'),
					'tip' => __('Endereço de E-mail', 'pontosdecultura'),
					'required' => true
			),
			'telefone' => array(
					'slug' => 'pratica-telefone',
					'title' => __ ( 'Telefone', 'pontosdecultura' ),
					'tip' => __ ( 'Número do Telefone', 'pontosdecultura' ) 
			),
			'cep' => array (
					'slug' => 'pratica-cep',
					'title' => __ ( 'Cep', 'pontosdecultura' ),
					'tip' => __ ( '', 'pontosdecultura' ) 
			),
			'ano-inicio' => array (
					'slug' => '_pratica-ano-inicio',
					'title' => __ ( 'Ano de Início das atividades', 'pontosdecultura' ),
					'tip' => __ ( '', 'pontosdecultura' ),
					'type' => 'dropdown-ano'
			),
			'numero-integrantes' => array (
					'slug' => '_pratica-numero-integrantes',
					'title' => __ ( 'Nº de Integrantes estáveis', 'pontosdecultura' ),
					'tip' => __ ( '', 'pontosdecultura' ),
					'type' => 'dropdown-cem'
			),
			'espaco-fisico' => array (
					'slug' => 'pratica-espaco-fisico',
					'title' => __ ( 'Tem relação com um espaço físico de maneira estável?', 'pontosdecultura' ),
					'tip' => __ ( '', 'pontosdecultura' ),
					'type' => 'radio',
					'values' => array('S' => __('Sim', 'pontosdecultura' ), 'N' => __('Não', 'pontosdecultura' ) )
			),
			'publicacoes' => array (
					'slug' => 'pratica-publicacoes',
					'title' => __ ( 'Links para publicações', 'pontosdecultura' ),
					'tip' => __( 'separe-os por vírgulas', 'pontosdecultura' )
			),
			'videos' => array (
					'slug' => 'pratica-videos',
					'title' => __ ( 'Links para Vídeos', 'pontosdecultura' ),
					'tip' => __ ( 'separe-os por vírgulas', 'pontosdecultura' ),
			),
			'facebook' => array (
					'slug' => 'pratica-facebook',
					'title' => __ ( 'Links para Facebook', 'pontosdecultura' ),
					'tip' => __ ( 'separe-os por vírgulas', 'pontosdecultura' ),
			),
			'outras-redes' => array (
					'slug' => 'outras-redes',
					'title' => __ ( 'Links para outras redes sociais', 'pontosdecultura' ),
					'tip' => __ ( 'separe-os por vírgulas', 'pontosdecultura' ),
			),
			'e-ponto' => array (
					'slug' => 'pratica-e-ponto',
					'title' => __ ( 'É Ponto de Cultura?', 'pontosdecultura' ),
					'tip' => __ ( '', 'pontosdecultura' ),
					'type' => 'radio',
					'values' => array('N' => __('Não', 'pontosdecultura' ), 'S' => __('É Ponto de Cultura', 'pontosdecultura' ), 'P' => __('É Pontão de Cultura', 'pontosdecultura' ) )
			),
			'vinculo' => array (
					'slug' => 'pratica-vinculo',
					'title' => __ ( 'Vínculo Acadêmico', 'pontosdecultura' ),
					'tip' => __ ( '', 'pontosdecultura' ),
					'type' => 'radio',
					'values' => array('N' => __('Nunca possuiu', 'pontosdecultura' ), 'P' => __('Já Possuiu', 'pontosdecultura' ), 'S' => __('Possui', 'pontosdecultura' ) )
			),
			'suporte' => array (
					'slug' => 'pratica-suporte',
					'title' => __ ( 'A pesquisa ou núcleo recebem ou já receberam suporte governamental para uma ou mais de suas ações?', 'pontosdecultura' ),
					'tip' => __ ( 'Bolsas de pesquisa, contemplação em editais, convênios, contratos...', 'pontosdecultura' ),
					'type' => 'radio',
					'values' => array('N' => __('Nunca recebeu', 'pontosdecultura' ), 'P' => __('Já recebeu', 'pontosdecultura' ), 'S' => __('Recebe', 'pontosdecultura' ) )
			),
			'suporte-esfera' => array (
					'slug' => 'pratica-suporte-esfera',
					'title' => __ ( 'Recebeu suporte de qual esfera', 'pontosdecultura' ),
					'tip' => __ ( '', 'pontosdecultura' ),
					'type' => 'checkbox',
					'values' => array('Federal' => __('Federal', 'pontosdecultura' ), 'Estadual' => __('Estadual', 'pontosdecultura' ), 'Municipal' => __('Municipal', 'pontosdecultura' ) )
			),
			'suporte-obs' => array (
					'slug' => 'pratica-suporte-obs',
					'title' => __ ( 'Histórico do núcleo de pesquisa continuada', 'pontosdecultura' ),
					'tip' => __ ( 'até 500 caracteres', 'pontosdecultura' ),
					'type' => 'textarea',
			),
			'cpf' => array (
					'slug' => 'pratica-cpf',
					'title' => __ ( 'CPF', 'pontosdecultura' ),
					'tip' => __ ( '', 'pontosdecultura' ),
					'required' => true
			),
			'nome' => array (
					'slug' => 'pratica-nome',
					'title' => __ ( 'Nome Completo', 'pontosdecultura' ),
					'tip' => __ ( '', 'pontosdecultura' ),
					'required' => true
			),
			'nascimento' => array (
					'slug' => 'pratica-nascimento',
					'title' => __ ( 'Nascimento', 'pontosdecultura' ),
					'tip' => __ ( '', 'pontosdecultura' ),
					'required' => true
			),
			'ocupacao' => array (
					'slug' => 'pratica-ocupacao',
					'title' => __ ( 'Ocupação', 'pontosdecultura' ),
					'tip' => __ ( '', 'pontosdecultura' ),
			),
			'telefone-resp' => array (
					'slug' => 'pratica-telefone-resp',
					'title' => __ ( 'Telefone', 'pontosdecultura' ),
					'tip' => __ ( '', 'pontosdecultura' ),
			),
			'email-resp' => array (
					'slug' => 'pratica-email-resp',
					'title' => __ ( 'Email', 'pontosdecultura' ),
					'tip' => __ ( '', 'pontosdecultura' ),
					'required' => true
			),
			'facebook-resp' => array (
					'slug' => 'pratica-facebook-resp',
					'title' => __ ( 'Link para Facebook', 'pontosdecultura' ),
					'tip' => __ ( '', 'pontosdecultura' ),
			),
			'redes-resp' => array (
					'slug' => 'pratica-redes-resp',
					'title' => __ ( 'Links para outras redes sociais', 'pontosdecultura' ),
					'tip' => __ ( 'separe-os por vírgulas', 'pontosdecultura' ),
			),
			'relacao-resp' => array (
					'slug' => 'pratica-relacao-resp',
					'title' => __ ( 'Sobre a relação existente entre o responsável pelo cadastro (você) e o núcleo ou pesquisa continuada em questão', 'pontosdecultura' ),
					'tip' => __ ( 'até 500 caracteres', 'pontosdecultura' ),
					'type' => 'textarea',
					'rows' => 4,
			),
			'tem-fotos' => array (
					'slug' => '_pratica-tem-fotos',
					'title' => __ ( 'Tem Fotos', 'pontosdecultura' ),
					'tip' => __ ( '', 'pontosdecultura' ),
					'save' => false,
			),
			'tem-links' => array (
					'slug' => '_pratica-tem-links',
					'title' => __ ( 'Tem Links', 'pontosdecultura' ),
					'tip' => __ ( '', 'pontosdecultura' ),
					'save' => false,
			)
			
			//Espaço físico
			
		);
		
		add_action('init', array($this, 'init'));
		add_action('init', array($this, 'rewrite_rules'));
		add_action('template_redirect', array($this, 'form'));
		add_action('wp_ajax_resetpass', array($this, 'form'));
		add_action('wp_ajax_nopriv_resetpass', array($this, 'form'));
		add_filter('query_vars', array($this, 'print_variables'));
		//add_filter('archive_template', array($this, 'archiveTemplate'));
		//add_filter('single_template', array($this, 'singleTemplate'));
		add_action( 'save_post', array( $this, 'save' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts') );
		add_action( 'wp_enqueue_scripts', array($this, 'css'));
		add_action( 'wp_enqueue_scripts', array($this, 'javascript'));
	}

	function init()
	{
		$this->Add_custom_Post();
		
		$permissoes = array(
			'administrator' => array('Novo' => false, 'Caps' => array
			(
				'delete_praticas',
				'delete_private_praticas',
				'edit_pratica',
				'edit_praticas',
				'edit_private_praticas',
				'publish_praticas',
				'read_pratica',
				'read_private_praticas',
				'delete_published_praticas',
				'edit_published_praticas',
				'edit_published_pratica',
				'edit_others_praticas',
				'edit_others_pratica',
				'delete_others_praticas',
				'delete_others_pratica'
			)),
			'contributor' => array('Novo' => false, 'Caps' => array
			(
				'read_pratica',
			)),
			'subscriber' => array('Novo' => false, 'Caps' => array
			(
				'read_pratica',
			)),
			'author' => array('Novo' => false, 'Caps' => array
			(
				'read_pratica',
			)),
			'editor' => array('Novo' => false, 'Caps' => array
			(
				'read_pratica',
			)),
		);
		
		$this->roles_install($permissoes);
		
	}
	
	function Add_custom_Post()
	{
		$labels = array
		(
				'name' => __('Praticas','pontosdecultura'),
				'singular_name' => __('Pratica','pontosdecultura'),
				'add_new' => __('Add new','pontosdecultura'),
				'add_new_item' => __('Add new pratica','pontosdecultura'),
				'edit_item' => __('Edit pratica','pontosdecultura'),
				'new_item' => __('New Pratica','pontosdecultura'),
				'view_item' => __('View Pratica','pontosdecultura'),
				'search_items' => __('Search Pratica','pontosdecultura'),
				'not_found' =>  __('Pratica not found','pontosdecultura'),
				'not_found_in_trash' => __('Pratica not found in the trash','pontosdecultura'),
				'parent_item_colon' => '',
				'menu_name' => __('Praticas','pontosdecultura')
	
		);
	
		$args = array
		(
				'label' => __('Praticas','pontosdecultura'),
				'labels' => $labels,
				'description' => __('Praticas','pontosdecultura'),
				'public' => true,
				'publicly_queryable' => true, // public
				//'exclude_from_search' => '', // public
				'show_ui' => true, // public
				'show_in_menu' => true,
				'menu_position' => 5,
				// 'menu_icon' => '',
				'capability_type' => array('pratica','praticas'),
				'map_meta_cap' => true,
				'hierarchical' => false,
				'supports' => array('title', 'editor', 'author', 'excerpt', 'trackbacks','thumbnail', 'revisions', 'comments'),
				'register_meta_box_cb' => array($this, 'pontosdecultura_pratica_custom_meta'), // função para chamar na edição
				'taxonomies' => array('post_tag','category'), // Taxionomias já existentes relaciondas, vamos criar e registrar na sequência
				'permalink_epmask' => 'EP_PERMALINK ',
				'has_archive' => true, // Opção de arquivamento por slug
				'rewrite' => true,
				'query_var' => true,
				'can_export' => true//, // veja abaixo
				//'show_in_nav_menus' => '', // public
				//'_builtin' => '', // Core
				//'_edit_link' => '' // Core
	
		);
	
		register_post_type("pratica", $args);
	}
	
	function pontosdecultura_pratica_custom_meta()
	{
		add_meta_box("pratica_meta", __("Detalhes da Pratica", 'pontosdecultura'), array($this, 'pratica_meta'), 'pratica', 'side', 'default');
		add_meta_box("second_image_meta", __("Imagens da Pratica", 'pontosdecultura'), array($this, 'second_image_meta'), 'pratica', 'side', 'default');
	}
	
	protected $_customs = array();
	
	function getFields()
	{
		$post = array(
			'post_title' => array(
				'slug' => 'post_title',
				'title' => __('Nome do Núcleo ou Artista Pesquisador', 'pontosdecultura'),
				'tip' => '',
				'required' => true,
				'buildin' => true
			),
			'post_content' => array(
				'slug' => 'post_content',
				'title' => __('Descreva a pesquisa do seu núcleo', 'pontosdecultura'),
				'tip' => __('Maximum 2000 characters', 'pontosdecultura'),
				'required' => true,
				//'type' => 'wp_editor',
				'type' => 'textarea',
				'rows' => 10,
				'buildin' => true
			),
		);
		
		return array_merge($post, $this->_customs);
	}
	
	function pratica_meta()
	{
		global $post;
		
		$custom = get_post_custom($post->ID);
		if(!is_array($custom)) $custom = array();
		
		$disable_edicao = '';
		
		/*if (
				!($post->post_status == 'draft' ||
				$post->post_status == 'auto-draft' ||
				$post->post_status == 'pending')
		)
		{
			$disable_edicao = 'readonly="readonly"';
		}*/
		
		wp_nonce_field( 'pratica_meta_inner_custom_box', 'pratica_meta_inner_custom_box_nonce' );
		
		foreach ($this->_customs as $key => $campo )
		{
			$slug = $campo['slug'];
			$type = array_key_exists('type', $campo) ? $campo['type'] : 'input';
			$dado = array_key_exists($slug, $custom) ? array_pop($custom[$slug]) : '';
			
			/*switch ($type)
			{
				case 'dropdown-meses-anos':
					$dado = array_key_exists("$slug-anos", $custom) ? array_pop($custom["$slug-anos"]).__(" anos", 'pontosdecultura') : '';
					if(array_key_exists("$slug-meses", $custom))
					{
						if(strlen($dado) > 0 ) $dado .= __(' e ', 'pontosdecultura');
						$dado .= array_pop($custom["$slug-meses"]).__(" meses", 'pontosdecultura');
					}
				case 'input':
				case 'date':
				default:
					?>
					<p>
						<label for="<?php echo $slug; ?>" class="<?php echo 'label_'.$slug; ?>"><?php echo $campo['title'] ?>:</label>
						<input <?php echo $disable_edicao ?> id="<?php echo $slug; ?>"
							name="<?php echo $slug; ?>"
							class="<?php echo $slug.($type == 'date' ? 'hasdatepicker' : '') ; ?> "
							value="<?php echo $dado; ?>" />
					</p>
					<?php
				break;
			}*/
			if($type == 'dropdown-meses-anos')
			{
				$_REQUEST[$campo['slug'].'-anos'] = array_key_exists("$slug-anos", $custom) ? array_pop($custom["$slug-anos"]).__(" anos", 'pontosdecultura') : '';
				if(array_key_exists("$slug-meses", $custom))
				{
					$_REQUEST[$campo['slug'].'-meses'] = array_pop($custom["$slug-meses"]).__(" meses", 'pontosdecultura');
				}
			}
			$_REQUEST[$campo['slug']] = $dado;
			$this->print_field($campo);
			
			if(array_key_exists($slug, $custom)) unset($custom[$slug]);
		}
		
		foreach ($custom as $key => $value)
		{
			$input_pos = strpos($key, '_input'); 
			if( $input_pos > 0 ) // input text
			{
				$taxonomy =  substr($key, 1, strpos($key, "_", 1) - 1);
				$taxonomy_obj = get_taxonomy($taxonomy);
				
				$term_id = substr($key, strlen($taxonomy) + 2, $input_pos - (strlen($taxonomy) + 2));
			
				$term = get_term(intval( $term_id ), $taxonomy);
				
				$dado = array_pop($value);
				
				?>
				<p>
					<label for="<?php echo $term->slug; ?>" class="<?php echo 'label_'.$term->slug; ?>"><?php echo $taxonomy_obj->labels->name." - ".str_replace('#input#', '', $term->name) ?>:</label>
					<input <?php echo $disable_edicao ?> id="<?php echo $term->slug; ?>"
						name="<?php echo $term->slug; ?>"
						class="<?php echo $term->slug; ?>"
						value="<?php echo $dado; ?>" />
				</p>
				<?php
				
			}
		}
		
		
	}
	
	function second_image_meta($post)
	{
		$stored_meta = get_post_meta( $post->ID, 'thumbnail2', true)
		?>
		<p>
		    <label for="meta-image" class="pontosdecultura-second-image-meta"><?php _e( 'Segunda Imagem', 'pontosdecultura' )?></label>
		    <input type="text" name="thumbnail2" id="meta-image" value="<?php if ( isset ( $stored_meta ) ) echo $stored_meta; ?>" />
		    <input type="button" id="meta-image-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'pontosdecultura' )?>" />
		</p>
		<?php
		$stored_meta = get_post_meta( $post->ID, 'thumbnail3', true)
		?>
		<p>
		    <label for="meta-image" class="pontosdecultura-second-image-meta"><?php _e( 'Terceira Imagem', 'pontosdecultura' )?></label>
		    <input type="text" name="thumbnail3" id="meta-image" value="<?php if ( isset ( $stored_meta ) ) echo $stored_meta; ?>" />
		    <input type="button" id="meta-image-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'pontosdecultura' )?>" />
		</p>
		<?php
		$stored_meta = get_post_meta( $post->ID, 'thumbnail4', true)
		?>
		<p>
		    <label for="meta-image" class="pontosdecultura-second-image-meta"><?php _e( 'Foto do Responsável', 'pontosdecultura' )?></label>
		    <input type="text" name="thumbnail4" id="meta-image" value="<?php if ( isset ( $stored_meta ) ) echo $stored_meta; ?>" />
		    <input type="button" id="meta-image-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'pontosdecultura' )?>" />
		</p>
		<?php
		
	}
	
	const NEW_PRATICA_PAGE = 'nova-pratica';
	
	function print_variables($public_query_vars) {
		$public_query_vars[] = self::NEW_PRATICA_PAGE;
		return $public_query_vars;
	}
	
	function rewrite_rules()
	{
		add_rewrite_rule('^'.self::NEW_PRATICA_PAGE.'(.*)', 'index.php?'.self::NEW_PRATICA_PAGE.'=true$matches[1]', 'top');
		flush_rewrite_rules(false);
	}
	
	function form()
	{
		if(get_query_var(self::NEW_PRATICA_PAGE) == true)
		{
			//wp_enqueue_script('jquery-ui-datepicker-ptbr', WP_CONTENT_URL.'/themes/pontosdecultura/praticas/js/jquery.ui.datepicker-pt-BR.js', array('jquery-ui-datepicker'));
			//wp_enqueue_script('date-scripts',WP_CONTENT_URL.'/themes/pontosdecultura/praticas/js/date_scripts.js', array( 'jquery-ui-datepicker-ptbr'));
			wp_enqueue_script('new-pratica', get_template_directory_uri().'/inc/praticas/js/new-pratica.js', array( 'jquery'));
			
			get_header();
			$file_path = get_stylesheet_directory() . '/new-pratica.php';
			if(file_exists($file_path))
			{
				include $file_path;
			}
			else
			{
				include dirname(__FILE__) . '/new-pratica.php';;
			}
			get_footer();
			exit();
		}
	}
	
	/**
	 * Default post information to use when populating the "Write Post" form customized for sulution.
	 *
	 * @since 2.0.0
	 *
	 * @param string $post_type A post type string, defaults to 'post'.
	 * @return WP_Post Post object containing all the default post data as attributes
	 */
	function get_default_post_to_edit( $post_type = 'pratica', $create_in_db = false ) {
		global $wpdb;
	
		$post_title = '';
		if ( !empty( $_REQUEST['post_title'] ) )
			$post_title = esc_html( stripslashes( $_REQUEST['post_title'] ));
	
		$post_content = '';
		if ( !empty( $_REQUEST['content'] ) )
			$post_content = esc_html( stripslashes( $_REQUEST['content'] ));
	
		$post_excerpt = '';
		if ( !empty( $_REQUEST['excerpt'] ) )
			$post_excerpt = esc_html( stripslashes( $_REQUEST['excerpt'] ));
	
		if ( $create_in_db ) {
			$post_id = wp_insert_post( array( 'post_title' => __( 'Auto Draft' ), 'post_type' => $post_type, 'post_status' => 'pending' ) );
			$post = get_post( $post_id );
			if ( current_theme_supports( 'post-formats' ) && post_type_supports( $post->post_type, 'post-formats' ) && get_option( 'default_post_format' ) )
				set_post_format( $post, get_option( 'default_post_format' ) );
		} else {
			$post = new stdClass;
			$post->ID = 0;
			$post->post_author = '';
			$post->post_date = '';
			$post->post_date_gmt = '';
			$post->post_password = '';
			$post->post_type = $post_type;
			$post->post_status = 'pending';
			$post->to_ping = '';
			$post->pinged = '';
			$post->comment_status = get_option( 'default_comment_status' );
			$post->ping_status = get_option( 'default_ping_status' );
			$post->post_pingback = get_option( 'default_pingback_flag' );
			$post->post_category = get_option( 'default_category' );
			$post->page_template = 'default';
			$post->post_parent = 0;
			$post->menu_order = 0;
			$post = new WP_Post( $post );
		}
	
		$post->post_content = apply_filters( 'default_content', $post_content, $post );
		$post->post_title   = apply_filters( 'default_title',   $post_title, $post   );
		$post->post_excerpt = apply_filters( 'default_excerpt', $post_excerpt, $post );
		$post->post_name = '';
	
		return $post;
	}
	
	/**
	 * Inclui os arquivos do tema relacionados com
	 * a listagem de praticas e retorna o template
	 * a ser usado.
	 *
	 * @param string $archiveTemplate
	 * @return string
	 */
	public function archiveTemplate($archiveTemplate)
	{
		global $post;
	
		if (get_post_type($post) == "pratica" || is_post_type_archive('pratica'))
		{
			if(file_exists(get_stylesheet_directory()."/archive-pratica.php"))
			{
				$archive_template = get_stylesheet_directory()."/archive-pratica.php";
			}
			else
			{
				$archiveTemplate = $this->themeFilePath('archive-pratica.php');
			}
		}
	
		return $archiveTemplate;
	}
	
	/**
	 * Inclui os arquivos do tema relacionados com
	 * a página de uma pratica e retorna o template
	 * a ser usado.
	 *
	 * @param string $singleTemplate
	 * @return string
	 */
	public function singleTemplate($singleTemplate)
	{
		global $post;
	
		if (get_post_type($post) == "pratica" || is_post_type_archive('pratica'))
		{
			if(file_exists(get_stylesheet_directory()."/single-pratica.php"))
			{
				$singleTemplate = get_stylesheet_directory()."/single-pratica.php";
			}
			else
			{
				$singleTemplate = $this->themeFilePath('single-pratica.php');
			}
		}
	
		return $singleTemplate;
	}
	
	/**
	 * Save the meta when the post is saved.
	 *
	 * @param int $post_id The ID of the post being saved.
	 */
	public function save( $post_id )
	{
		/*
		 * We need to verify this came from the our screen and with proper authorization,
		* because save_post can be triggered at other times.
		*/
		
		// Check if our nonce is set.
		if ( ! isset( $_POST['pratica_meta_inner_custom_box_nonce'] ) )
		{
			return $post_id;
		}
		
		$nonce = $_POST['pratica_meta_inner_custom_box_nonce'];
		
		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $nonce, 'pratica_meta_inner_custom_box' ) )
		{
			return $post_id;
		}
		
		// If this is an autosave, our form has not been submitted,
		//     so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		{
			return $post_id;
		}
	
		// Check the user's permissions.
		if ( 'pratica' == $_POST['post_type'] )
		{
			if ( ! current_user_can( 'edit_pratica', $post_id ) )
			{
				return $post_id;
			}
		}
		else
		{
			return $post_id;
		}
	
		/* OK, its safe for us to save the data now. */
		foreach ($this->_customs as $field)
		{
			if(array_key_exists($field['slug'], $_POST))
			{
				// Sanitize the user input.
				$mydata = sanitize_text_field( $_POST[$field['slug']] );
			
				// Update the meta field.
				update_post_meta( $post_id, $field['slug'], $mydata );
			}
		}
		
		if(array_key_exists('thumbnail2', $_POST))
		{
			update_post_meta($post_id, 'thumbnail2', $_POST['thumbnail2']); //TODO more sec
		}
		if(array_key_exists('thumbnail3', $_POST))
		{
			update_post_meta($post_id, 'thumbnail3', $_POST['thumbnail3']); //TODO more sec
		}
		if(array_key_exists('thumbnail4', $_POST))
		{
			update_post_meta($post_id, 'thumbnail4', $_POST['thumbnail4']); //TODO more sec
		}
		
		if(function_exists('mapasdevista_save_postdata'))
		{
			mapasdevista_save_postdata($post_id);
		}
		
	}
	
	/**
	 * Loads the image management javascript
	 */
	function admin_enqueue_scripts()
	{
		global $typenow;
		if( $typenow == 'pratica' )
		{
			wp_enqueue_media();
	
			// Registers and enqueues the required javascript.
			wp_register_script( 'meta-box-image', get_template_directory_uri() . '/inc/praticas/js/meta-box-image.js', array( 'jquery' ) );
			wp_localize_script( 'meta-box-image', 'meta_image',
			array(
			'title' => __( 'Choose or Upload an Image', 'pontosdecultura' ),
			'button' => __( 'Use this image', 'pontosdecultura' ),
			)
			);
			wp_enqueue_script( 'meta-box-image' );
		}
	}
	
	/**
	 * Função responsável por controlar as folhas de estilo do site para práticas
	 *
	 */
	public function css()
	{
		// map.css
		wp_register_style( 'pratica', get_template_directory_uri() . '/inc/praticas/css/pratica.css', array(), '1' );
		wp_enqueue_style( 'pratica' );
		
		if( function_exists('mapasdevista_enqueue_scripts') && get_query_var(self::NEW_PRATICA_PAGE) == true )
		{
			wp_enqueue_style('mapasdevista-admin', mapasdevista_get_baseurl('template_directory') . '/admin/admin.css');
		}
		
	}
	
	public function javascript()
	{
		if( function_exists('mapasdevista_enqueue_scripts') && get_query_var(self::NEW_PRATICA_PAGE) == true )
		{
			mapasdevista_enqueue_scripts();
			wp_enqueue_script('metabox', mapasdevista_get_baseurl() . '/admin/metabox.js', array('jquery', 'jquery-ui-resizable', 'jquery-ui-dialog') );
			$data = array('options' => get_option('mapasdevista'));
			wp_localize_script('metabox', 'mapasdevista_options', $data);
		}
	}
	
	static function print_field($field, $tax = false)
	{
		if($tax !== false)
		{
			$type = $tax;
			$label = '';
			$tip = '';
			$id = '';
			if(is_array($tax))
			{
				$type = array_key_exists('type', $tax) ? $tax['type'] : '';
				$label = array_key_exists('label', $tax) ? $tax['label'] : '';
				$tip = array_key_exists('tip', $tax) ? $tax['tip'] : '';
				$id = array_key_exists('slug', $tax) ? $tax['id'] : '';
			}
			
			switch ($type)
			{
				
				case 'dropdown':
				{
					
				}break;
				case 'estadocidade':
				{
					Praticas::dropdownEstadoCidade($field, $tax);
				}break;
				default:
					$taxonomy = $field;
					$field = $tax;
					
					$field_default = array(
							'id' => 'taxonomy_'.$taxonomy,
							'label' => '',
							'tip' => '',
							'required_message' => '',
							'input_class' => '',
							'type' => '',
							'required' => false
					);
					
					if(!is_array($field))
					{
						$field = array();
					}
					
					$field = array_merge($field_default, $field);
					
					extract($field);
					
					?>
					<div class="pratica-item pratica-item-checkbox <?php echo $id; ?>">
						<label for="<?php echo $id ?>" class="pratica-item-label">
							<div class="pratica-item-title"><?php echo $label;
								if(array_key_exists( 'required', $field ) && $field['required'])
								{?>
									<span class="pratica-item-required-asterisk">*</span><?php
								}?>
							</div>
							<div class="pratica-item-tip-text"><?php echo $tip; ?>
						</div>
						</label> <?php Praticas::taxonomy_checklist($taxonomy); ?>
						<div class="pratica-item-error-message"></div>
						<div class="pratica-item-required-message"><?php echo $required_message; ?></div>
					</div>
					<?php
				break;
			}
		}
		else
		{
			$id = $field['slug'];
			$label = $field['title'];
			$tip = $field['tip'];
			$required_message = '';
			$input_class = '';
			$type = array_key_exists('type', $field) ? $field['type'] : '';
			switch ($type)
			{
				case 'wp_editor':
					?>
					<div class="pratica-item <?php echo $id; ?>">
							<label for="<?php echo $id ?>" class="pratica-item-label">
								<div class="pratica-item-title"><?php echo $label; ?>
								<span class="pratica-item-required-asterisk">*</span>
								</div>
								<div class="pratica-item-tip-text">
								<?php echo $tip; ?>
							</div>
							</label>
						<?php wp_editor((array_key_exists($id, $_POST) ? stripslashes($purifier->purify($_POST[$id])) : ''), $id,  array( 
					       'tinymce' => array( 
					            'content_css' => get_stylesheet_directory_uri() . '/inc/praticas/css/editor-styles.css' 
					    		)
							)
						); ?>
						<div class="pratica-item-error-message"></div>
							<div class="pratica-item-required-message">
							<?php echo $required_message; ?>
						</div>
					</div>
					<?php
				break;
				case 'dropdown-ano':
					?>
					<div class="pratica-item pratica-item-dropdown <?php echo $id; ?>">
						<label for="<?php echo $id ?>" class="pratica-item-label">
							<div class="pratica-item-title"><?php echo $label;
								if(array_key_exists( 'required', $field ) && $field['required'])
								{?>
									<span class="pratica-item-required-asterisk">*</span><?php
								}?>
							</div>
							<div class="pratica-item-tip-text"><?php echo $tip; ?>
						</div>
						</label><div class="pratica-item-input-dropdown dropdown-<?php echo $id; ?>"><select id="<?php echo $id ?>"
							class="<?php echo $input_class ?>"
							name="<?php echo $id ?>">
								<option value="" <?php echo array_key_exists($id, $_REQUEST)? '' : 'selected="selected"'; ?> ><?php echo esc_attr_x('Selecione', 'pontosdecultura' ); ?></option>
								<?php
									for($i = date('Y'); $i >= 1900; $i--)
									{
										?>
										<option value="<?php echo $i; ?>" <?php echo array_key_exists($id, $_REQUEST) && wp_strip_all_tags($_REQUEST[$id]) == $i ? 'selected="selected"': ''; ?> ><?php echo $i; ?></option>
										<?php
									} 
								?>
							</select>
						</div>
						<div class="pratica-item-error-message"></div>
						<div class="pratica-item-required-message"><?php echo $required_message; ?></div>
					</div>
					<?php
				break;
				case 'dropdown-meses-anos':
					?>
					<div class="pratica-item pratica-item-dropdown <?php echo $id; ?>">
						<label for="<?php echo $id ?>" class="pratica-item-label">
							<div class="pratica-item-title"><?php echo $label;
								if(array_key_exists( 'required', $field ) && $field['required'])
								{?>
									<span class="pratica-item-required-asterisk">*</span><?php
								}?>
							</div>
							<div class="pratica-item-tip-text"><?php echo $tip; ?>
						</div>
						</label><div class="pratica-item-input-dropdown dropdown-<?php echo $id; ?>"><select id="<?php echo "$id-meses"; ?>"
							class="<?php echo $input_class; ?>"
							name="<?php echo "$id-meses"; ?>">
								<option value="" <?php echo array_key_exists("$id-meses", $_REQUEST) ? '' : 'selected="selected"';?> ><?php echo esc_attr_x('Meses', 'pontosdecultura' ); ?></option>
								<?php
									for($i = 1; $i < 13; $i++)
									{
										?>
										<option value="<?php echo $i; ?>" <?php echo array_key_exists("$id-meses", $_REQUEST) && wp_strip_all_tags($_REQUEST["$id-meses"]) == $i ? 'selected="selected"': ''; ?> ><?php echo $i; ?></option>
										<?php
									} 
								?>
							</select></div>
							<div class="pratica-item-input-dropdown dropdown-<?php echo $id; ?>"><select id="<?php echo "$id-anos"; ?>"
							class="<?php echo $input_class; ?>"
							name="<?php echo "$id-anos"; ?>">
								<option value="" <?php echo array_key_exists("$id-anos", $_REQUEST) ? '' : 'selected="selected"';?> ><?php echo esc_attr_x('Anos', 'pontosdecultura' ); ?></option>
								<?php
									for($i = 1; $i < 101; $i++)
									{
										?>
										<option value="<?php echo $i; ?>" <?php echo array_key_exists("$id-anos", $_REQUEST) && wp_strip_all_tags($_REQUEST["$id-anos"]) == $i ? 'selected="selected"': ''; ?> ><?php echo $i; ?></option>
										<?php
									} 
								?>
							</select>
						</div>
						<div class="pratica-item-error-message"></div>
						<div class="pratica-item-required-message"><?php echo $required_message; ?></div>
					</div>
					<?php
				break;
				case 'dropdown-cem':
					?>
					<div class="pratica-item pratica-item-dropdown <?php echo $id; ?>">
						<label for="<?php echo $id ?>" class="pratica-item-label">
							<div class="pratica-item-title"><?php echo $label;
								if(array_key_exists( 'required', $field ) && $field['required'])
								{?>
									<span class="pratica-item-required-asterisk">*</span><?php
								}?>
							</div>
							<div class="pratica-item-tip-text"><?php echo $tip; ?>
						</div>
						</label><div class="pratica-item-input-dropdown dropdown-<?php echo $id; ?>"><select id="<?php echo $id ?>"
							class="<?php echo $input_class ?>"
							name="<?php echo $id ?>">
								<option value="" selected="selected" ><?php echo esc_attr_x('Selecione', 'pontosdecultura' ); ?></option>
								<?php
									for($i = 1; $i < 100; $i++)
									{
										$label = $i == 99 ? '99+' : $i;
										?>
										<option value="<?php echo $i; ?>" <?php echo array_key_exists($id, $_REQUEST) && wp_strip_all_tags($_REQUEST[$id]) == $i ? 'selected="selected"': ''; ?> ><?php echo $label; ?></option>
										<?php
									} 
								?>
							</select>
						</div>
						<div class="pratica-item-error-message"></div>
						<div class="pratica-item-required-message"><?php echo $required_message; ?></div>
					</div>
					<?php
				break;
				case 'radio':
					?>
					<div class="pratica-item pratica-item-radio <?php echo $id; ?>">
						<label for="<?php echo $id ?>" class="pratica-item-label">
							<div class="pratica-item-title"><?php echo $label;
								if(array_key_exists( 'required', $field ) && $field['required'])
								{?>
									<span class="pratica-item-required-asterisk">*</span><?php
								}?>
							</div>
							<div class="pratica-item-tip-text"><?php echo $tip; ?>
						</div>
						</label>
							<div class="pratica-item-input-radio-block"><?php
								$i = 0;
								foreach ($field['values'] as $value => $label_item)
								{
									echo '<input id="'.("$id-option-$i").'" type="radio" name="'.$id.'" value="'.$value.'" '.(array_key_exists($id, $_REQUEST) && wp_strip_all_tags($_REQUEST[$id]) == $value ? 'checked="checked"': '').' ><label for="'.("$id-option-$i").'" class="pratica-item-input-radio" >'.$label_item.'</label>';
									$i++;
								}
						?></div><div class="pratica-item-error-message"></div>
						<div class="pratica-item-required-message"><?php echo $required_message; ?></div>
					</div>
					<?php
				break;
				case 'checkbox':
					?>
					<div class="pratica-item pratica-item-checkbox <?php echo $id; ?>">
						<label for="<?php echo $id ?>" class="pratica-item-label">
							<div class="pratica-item-title"><?php echo $label;
								if(array_key_exists( 'required', $field ) && $field['required'])
								{?>
									<span class="pratica-item-required-asterisk">*</span><?php
								}?>
							</div>
							<div class="pratica-item-tip-text"><?php echo $tip; ?>
						</div>
						</label>
							<div class="pratica-item-input-checkbox-block"><?php
								$i = 0;
								$dado = array();
								if(array_key_exists($id, $_REQUEST))
								{
									if (is_array($_REQUEST[$id]))
									{
										$dado = $_REQUEST[$id];
									}
									elseif(is_string($_REQUEST[$id])) 
									{
										$dado = explode(',', $_REQUEST[$id]);
									}
								}
								foreach ($field['values'] as $value => $label_item)
								{
									echo '<input id="'.("$id-option-$i").'" type="checkbox" name="'.$id.'[]" value="'.$value.'" '.(in_array($value, $dado) ? 'checked="checked"': '').' ><label for="'.("$id-option-$i").'" class="pratica-item-input-checkbox" >'.$label_item.'</label>';
									$i++;
								}
						?></div><div class="pratica-item-error-message"></div>
						<div class="pratica-item-required-message"><?php echo $required_message; ?></div>
					</div>
					<?php
				break;
				case 'textarea':
				?>
				<div class="pratica-item pratica-item-textarea <?php echo $id; ?>">
					<label for="<?php echo $id ?>" class="pratica-item-label">
						<div class="pratica-item-title"><?php echo $label;
							if(array_key_exists( 'required', $field ) && $field['required'])
							{?>
								<span class="pratica-item-required-asterisk">*</span><?php
							}?>
						</div>
						<div class="pratica-item-tip-text"><?php echo $tip; ?>
						</div>
					</label>
					<textarea id="<?php echo $id ?>"
						class="pratica-item-input-text <?php echo $input_class ?>"
						name="<?php echo $id ?>"
						rows="<?php echo array_key_exists('rows', $field) ? $field['rows'] : 4; ?>"
						<?php echo array_key_exists('cols', $field) ? 'cols="'.$field['cols'].'"' : ''; ?>
					><?php echo array_key_exists($id, $_REQUEST) ? wp_strip_all_tags($_REQUEST[$id]) : ''; ?></textarea>
					<div class="pratica-item-error-message"></div>
					<div class="pratica-item-required-message"><?php echo $required_message; ?></div>
				</div>
				<?php
				break;
				case 'date':
				default:
					?>
					<div class="pratica-item <?php echo $type == 'date' ? 'pratica-item-date' : 'pratica-item-text'; ?> <?php echo $id; ?>">
						<label for="<?php echo $id ?>" class="pratica-item-label">
							<div class="pratica-item-title"><?php echo $label;
								if(array_key_exists( 'required', $field ) && $field['required'])
								{?>
									<span class="pratica-item-required-asterisk">*</span><?php
								}?>
							</div>
							<div class="pratica-item-tip-text"><?php echo $tip; ?>
						</div>
						</label> <input type="text" id="<?php echo $id ?>"
							class="pratica-item-input-text <?php echo $type == 'date' ? 'hasdatepicker' : ''; ?> <?php echo $input_class ?>"
							value="<?php echo array_key_exists($id, $_REQUEST) ? wp_strip_all_tags($_REQUEST[$id]) : ''; ?>"
							name="<?php echo $id ?>">
						<div class="pratica-item-error-message"></div>
						<div class="pratica-item-required-message"><?php echo $required_message; ?></div>
					</div>
					<?php
				break;
			}
		}
	}
	
	static function taxonomy_checklist($taxonomy = 'category', $parent = 0)
	{
		$args = array(
				'orderby' => 'id',
				'hide_empty'=> 0,
				'parent' => $parent,
				'hierarchical' => 0,
				'taxonomy'=>$taxonomy
	
		);
		$terms = get_terms($taxonomy, $args);
		//print_r($terms);
	
		if (!is_array($terms) || ( is_array($terms) && sizeof($terms) < 1 ) )
		{
			return;
		}
		if ($parent > 0)
		{?>
			<ul class='children'><?php
		}
		else
		{?>
			<ul class='parent'><?php
		}
		$index = 1;
		foreach ($terms as $term)
		{
			$name = $term->name;
			$input = '';
			if(strpos($name, '#input#') !== false)
			{
				$name = str_replace('#input#', '', $name);
				$value = array_key_exists($taxonomy.'_'.$term->term_id.'_input', $_REQUEST) ? $_REQUEST[$taxonomy.'_'.$term->term_id.'_input'] : ''; 
				$input = '<input type="text" class="taxonomy-checkbox-text taxonomy-'.$taxonomy.'-checkbox-text" name="'.$taxonomy.'_'.$term->term_id.'_input" id="taxonomy_'.$taxonomy.'_'.$term->slug.'_input" value="'.$value.'" />';
			}
			$checked = 
				isset($_REQUEST) &&
				array_key_exists("taxonomy_$taxonomy", $_REQUEST) &&
				((is_array($_REQUEST["taxonomy_$taxonomy"]) && array_search($term->term_id, $_REQUEST["taxonomy_$taxonomy"]) !== false ) ||
				(is_string($_REQUEST["taxonomy_$taxonomy"]) && $_REQUEST["taxonomy_$taxonomy"] == $term->term_id))
			? 'checked="checked"' : '';
			if($taxonomy == 'category' && get_query_var('cat')) // workaround for cat query var
			{
				$checked = get_query_var('cat') == $term->term_id ? 'checked="checked"' : '';
			}
			$haschildren = false;
			if($parent == 0)
			{
				$children = get_term_children($term->term_id, $taxonomy);
				$haschildren = is_array($children) && count($children) > 0 ? true : false;
			}
			?>
			<li class="taxonomy-checkbox-group-col <?php echo $taxonomy ?>-group-col <?php echo $parent == 0 ? $taxonomy.'-group-col-'.$index : ''; ?>"><?php
				if( ($parent > 0 || !$haschildren ) && $input == '')
				{?>
					<input type="checkbox" class="taxonomy-<?php echo $taxonomy ?>-checkbox" value="<?php echo $term->term_id; ?>" name="taxonomy_<?php echo $taxonomy; ?>[]" id="taxonomy_<?php echo $taxonomy; ?>_<?php echo $term->slug; ?>"
					<?php echo $checked; ?> autocomplete="off" /><?php
				}?>
				<label for="taxonomy_<?php echo $taxonomy; ?>_<?php echo $term->slug; ?>" class="taxonomy-label-group-col <?php echo empty($input) ? '' : 'taxonomy-label-group-col-input'; ?>" ><?php
					echo $name.(empty($input) ? '' : ':&nbsp;');?>
				</label><?php
				echo $input; 
				self::taxonomy_checklist($taxonomy, $term->term_id); ?>
			</li>
			<?php
			$index++;
		}
		//if ($parent > 0)
		{?>
			</ul><?php
		}
	}
	
	function roles_install($permissoes)
	{
	
		// Criação das regras
		foreach ($permissoes as $nome => $permisao)
		{
			if($permisao['Novo'] == true)
			{
				$Role = get_role($permisao['From']);
					
				if(!is_object($Role))
				{
					throw new Exception(sprintf(__('Permissão original (%s) não localizada','pontosdecultura'),$permisao['From']));
				}
					
				$cap = $Role->capabilities;
				add_role($nome, $permisao["nome"], $cap);
			}
	
			$Role = get_role($nome);
			if(!is_object($Role))
			{
				throw new Exception(sprintf(__('Permissão %s não localizada','pontosdecultura'),$nome));
			}
	
			foreach ($permisao['Caps'] as $cap)
			{
					
				$Role->add_cap($cap);
			}
		}
	
	}
	
	static function dropdownEstadoCidade($taxonomy = 'territorio', $field = array())
	{
		$field_default = array(
			'id' => 'field-'.rand(),
			'label' => '',
			'tip' => '',
			'required_message' => '',
			'input_class' => '',
			'type' => '',
			'required' => false
		);
		
		if(!is_array($field))
		{
			$field = array();
		}
		
		$field = array_merge($field_default, $field);
		
		extract($field);
		?>
		<div class="pratica-item pratica-item-dropdown">
			<label for="<?php echo $id ?>" class="pratica-item-label">
				<div class="pratica-item-title"><?php echo $label;
					if(array_key_exists( 'required', $field ) && $field['required'])
					{?>
						<span class="pratica-item-required-asterisk">*</span><?php
					}?>
				</div>
				<div class="pratica-item-tip-text"><?php echo $tip; ?>
			</div>
			</label><?php EstadosCidades::dropdown($taxonomy, 'taxonomy_'.$taxonomy.'[]', 'taxonomy_'.$taxonomy.'[]'); ?>
			<div class="pratica-item-error-message"></div>
			<div class="pratica-item-required-message"><?php echo $required_message; ?></div>
		</div>
		<?php
		
	}
	
	public static function get_new_url()
	{
		return get_bloginfo( 'url' ) . '/'.self::NEW_PRATICA_PAGE;
	}
	
}

$Pratica_global = new Praticas();

?>
