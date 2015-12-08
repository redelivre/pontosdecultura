<?php

class EmRede
{
	function __construct()
	{
		$this->_customs = array(
				/*'Nome do projeto' => array
				(
						'slug' => 'Nome do projeto',
						'title' => __('Nome do projeto', 'pontosdecultura'),
						'tip' => __('', 'pontosdecultura'),
				),*/
				'Fórum' => array
				(
						'slug' => 'forum',
						'title' => __('Fórum', 'pontosdecultura'),
						'tip' => __('', 'pontosdecultura'),
				),
				'Domínios' => array
				(
						'slug' => 'dominios',
						'title' => __('Domínios', 'pontosdecultura'),
						'tip' => __('', 'pontosdecultura'),
				),
				'Responsável pelo preenchimento' => array
				(
						'slug' => '_responsavel-pelo-preenchimento',
						'title' => __('Responsável pelo preenchimento', 'pontosdecultura'),
						'tip' => __('', 'pontosdecultura'),
				),
				'Situação' => array
				(
						'slug' => 'situacao',
						'title' => __('Situação', 'pontosdecultura'),
						'tip' => __('', 'pontosdecultura'),
						'type' => 'radio',
						'values' => array('Ativo' => __('Ativo', 'pontosdecultura' ), 'Em desenvolvimento' => __('Em desenvolvimento', 'pontosdecultura' ) )
				),
				'Carta de apoio' => array
				(
						'slug' => 'carta-de-apoio',
						'title' => __('Carta de apoio', 'pontosdecultura'),
						'tip' => __('', 'pontosdecultura'),
				),
				/*'Descrição' => array
				(
						'slug' => 'Descrição',
						'title' => __('Descrição', 'pontosdecultura'),
						'tip' => __('', 'pontosdecultura'),
				),*/
				'Número de Postagens' => array
				(
						'slug' => 'numero-de-postagens',
						'title' => __('Número de Postagens', 'pontosdecultura'),
						'tip' => __('', 'pontosdecultura'),
				),
				'Número de Páginas' => array
				(
						'slug' => 'numero-de-paginas',
						'title' => __('Número de Páginas', 'pontosdecultura'),
						'tip' => __('', 'pontosdecultura'),
				),
				'Número de Comentários' => array
				(
						'slug' => 'numero-de-comentarios',
						'title' => __('Número de Comentários', 'pontosdecultura'),
						'tip' => __('', 'pontosdecultura'),
				),
				'Participa de alguma rede, qual? ' => array
				(
						'slug' => 'participa-de-alguma-rede',
						'title' => __('Participa de alguma rede, qual? ', 'pontosdecultura'),
						'tip' => __('', 'pontosdecultura'),
				),
				/*tax: 'Público alvo' => array
				(
						'slug' => 'Público alvo',
						'title' => __('Público alvo', 'pontosdecultura'),
						'tip' => __('', 'pontosdecultura'),
				),*/
				'Número de Pessoas Atingidas' => array
				(
						'slug' => 'numero-de-pessoas-atingidas',
						'title' => __('Número de Pessoas Atingidas', 'pontosdecultura'),
						'tip' => __('', 'pontosdecultura'),
				),
				'Imagem' => array
				(
						'slug' => 'imagem',
						'title' => __('Imagem', 'pontosdecultura'),
						'tip' => __('', 'pontosdecultura'),
						'type' => 'image',
				),
				/*tax: 'Categoria' => array
				(
						'slug' => 'Categoria',
						'title' => __('Categoria', 'pontosdecultura'),
						'tip' => __('', 'pontosdecultura'),
				),*/
				'É ponto de cultura? (Sim ou não)' => array
				(
						'slug' => 'e-ponto-de-cultura',
						'title' => __('É ponto de cultura?', 'pontosdecultura'),
						'tip' => __('', 'pontosdecultura'),
						'type' => 'radio',
						'values' => array('S' => __('Sim', 'pontosdecultura' ), 'N' => __('Não', 'pontosdecultura' ) )
				),
				'Email' => array
				(
						'slug' => 'email',
						'title' => __('Email', 'pontosdecultura'),
						'tip' => __('', 'pontosdecultura'),
				),
				'Telefone' => array
				(
						'slug' => 'telefone',
						'title' => __('Telefone', 'pontosdecultura'),
						'tip' => __('', 'pontosdecultura'),
				),
				'Facebook' => array
				(
						'slug' => 'facebook',
						'title' => __('Facebook', 'pontosdecultura'),
						'tip' => __('', 'pontosdecultura'),
				),
				/*'Cidade' => array
				(
						'slug' => 'Cidade',
						'title' => __('Cidade', 'pontosdecultura'),
						'tip' => __('', 'pontosdecultura'),
				),
				'Estado' => array
				(
						'slug' => 'Estado',
						'title' => __('Estado', 'pontosdecultura'),
						'tip' => __('', 'pontosdecultura'),
				),*/
				'País' => array
				(
						'slug' => 'pais',
						'title' => __('País', 'pontosdecultura'),
						'tip' => __('', 'pontosdecultura'),
				),
				'Endereço' => array
				(
						'slug' => 'endereco',
						'title' => __('Endereço', 'pontosdecultura'),
						'tip' => __('', 'pontosdecultura'),
				),
				'Data de Criação' => array
				(
						'slug' => 'data-de-criacao',
						'title' => __('Data de Criação', 'pontosdecultura'),
						'tip' => __('', 'pontosdecultura'),
						'type' => 'date',
				),
				/*'location' => array
				(
						'slug' => 'location',
						'title' => __('location', 'pontosdecultura'),
						'tip' => __('', 'pontosdecultura'),
				),*/
				'user_id' => array
				(
						'slug' => '_user_id',
						'title' => __('user_id', 'pontosdecultura'),
						'tip' => __('', 'pontosdecultura'),
				),
				'plan_id' => array
				(
						'slug' => '_plan_id',
						'title' => __('plan_id', 'pontosdecultura'),
						'tip' => __('', 'pontosdecultura'),
				),
				'blog_id' => array
				(
						'slug' => '_blog_id',
						'title' => __('blog_id', 'pontosdecultura'),
						'tip' => __('', 'pontosdecultura'),
				),
				'own_domain' => array
				(
						'slug' => 'own_domain',
						'title' => __('own_domain', 'pontosdecultura'),
						'tip' => __('', 'pontosdecultura'),
				),
				'template' => array
				(
						'slug' => '_template',
						'title' => __('template', 'pontosdecultura'),
						'tip' => __('', 'pontosdecultura'),
				),
				'styleshee' => array
				(
						'slug' => '_stylesheet',
						'title' => __('stylesheet', 'pontosdecultura'),
						'tip' => __('', 'pontosdecultura'),
				),
				'current_theme' => array
				(
						'slug' => '_current_theme',
						'title' => __('current_theme', 'pontosdecultura'),
						'tip' => __('', 'pontosdecultura'),
				),
				'user_email' => array
				(
						'slug' => 'user_email',
						'title' => __('E-mail do usuário', 'pontosdecultura'),
						'tip' => __('', 'pontosdecultura'),
				),
				'display_name' => array
				(
						'slug' => 'display_name',
						'title' => __('Nome do usuário', 'pontosdecultura'),
						'tip' => __('', 'pontosdecultura'),
				),
				'user_url' => array
				(
						'slug' => 'user_url',
						'title' => __('Site do usuário', 'pontosdecultura'),
						'tip' => __('', 'pontosdecultura'),
				),
				'mídias' => array
				(
						'slug' => '_midias',
						'title' => __('mídias', 'pontosdecultura'),
						'tip' => __('', 'pontosdecultura'),
				),
				'eventos' => array
				(
						'slug' => '_eventos',
						'title' => __('eventos', 'pontosdecultura'),
						'tip' => __('', 'pontosdecultura'),
				),
				'newletters' => array
				(
						'slug' => '_newletters',
						'title' => __('newletters', 'pontosdecultura'),
						'tip' => __('', 'pontosdecultura'),
				),
				'outros post types' => array
				(
						'slug' => '_outros-post-types',
						'title' => __('outros post types', 'pontosdecultura'),
						'tip' => __('', 'pontosdecultura'),
				),
				'Contribuição contínua(anual)' => array
				(
						'slug' => 'contribuicao-continua',
						'title' => __('Contribuição contínua(anual)', 'pontosdecultura'),
						'tip' => __('', 'pontosdecultura'),
				),
				'Contribuição em projeto' => array
				(
						'slug' => 'contribuicao-em-projeto',
						'title' => __('Contribuição em projeto', 'pontosdecultura'),
						'tip' => __('', 'pontosdecultura'),
				),
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
				'delete_emrede',
				'delete_private_emrede',
				'edit_emrede',
				'edit_emrede',
				'edit_private_emrede',
				'publish_emrede',
				'read_emrede',
				'read_private_emrede',
				'delete_published_emrede',
				'edit_published_emrede',
				'edit_published_emrede',
				'edit_others_emrede',
				'edit_others_emrede',
				'delete_others_emrede',
				'delete_others_emrede'
			)),
			'contributor' => array('Novo' => false, 'Caps' => array
			(
				'read_emrede',
			)),
			'subscriber' => array('Novo' => false, 'Caps' => array
			(
				'read_emrede',
			)),
			'author' => array('Novo' => false, 'Caps' => array
			(
				'read_emrede',
			)),
			'editor' => array('Novo' => false, 'Caps' => array
			(
				'read_emrede',
			)),
		);
		
		$this->roles_install($permissoes);
		
	}
	
	function Add_custom_Post()
	{
		$labels = array
		(
				'name' => __('em Rede','pontosdecultura'),
				'singular_name' => __('em Rede','pontosdecultura'),
				'add_new' => __('Add new','pontosdecultura'),
				'add_new_item' => __('Add new em Rede','pontosdecultura'),
				'edit_item' => __('Edit em Rede','pontosdecultura'),
				'new_item' => __('New em Rede','pontosdecultura'),
				'view_item' => __('View em Rede','pontosdecultura'),
				'search_items' => __('Search em Rede','pontosdecultura'),
				'not_found' =>  __('em Rede not found','pontosdecultura'),
				'not_found_in_trash' => __('em Rede not found in the trash','pontosdecultura'),
				'parent_item_colon' => '',
				'menu_name' => __('em Rede','pontosdecultura')
	
		);
	
		$args = array
		(
				'label' => __('em Rede','pontosdecultura'),
				'labels' => $labels,
				'description' => __('em Rede','pontosdecultura'),
				'public' => true,
				'publicly_queryable' => true, // public
				//'exclude_from_search' => '', // public
				'show_ui' => true, // public
				'show_in_menu' => true,
				'menu_position' => 5,
				// 'menu_icon' => '',
				'capability_type' => 'post',
				'map_meta_cap' => true,
				'hierarchical' => false,
				'supports' => array('title', 'editor', 'author', 'excerpt', 'trackbacks','thumbnail', 'revisions', 'comments'),
				'register_meta_box_cb' => array($this, 'pontos_emrede_custom_meta'), // função para chamar na edição
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
	
		register_post_type("emrede", $args);
	}
	
	function pontos_emrede_custom_meta()
	{
		add_meta_box("emrede_meta", __("Detalhes do ponto em Rede", 'pontosdecultura'), array($this, 'emrede_meta'), 'emrede', 'side', 'default');
		add_meta_box("second_image_meta", __("Imagens do ponto em Rede", 'pontosdecultura'), array($this, 'second_image_meta'), 'emrede', 'side', 'default');
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
	
	function emrede_meta()
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
		
		wp_nonce_field( 'emrede_meta_inner_custom_box', 'emrede_meta_inner_custom_box_nonce' );
		
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
		    <label for="meta-image" class="pontos-second-image-meta"><?php _e( 'Segunda Imagem', 'pontosdecultura' )?></label>
		    <input type="text" name="thumbnail2" id="meta-image" value="<?php if ( isset ( $stored_meta ) ) echo $stored_meta; ?>" />
		    <input type="button" id="meta-image-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'pontosdecultura' )?>" />
		</p>
		<?php
		$stored_meta = get_post_meta( $post->ID, 'thumbnail3', true)
		?>
		<p>
		    <label for="meta-image" class="pontos-second-image-meta"><?php _e( 'Terceira Imagem', 'pontosdecultura' )?></label>
		    <input type="text" name="thumbnail3" id="meta-image" value="<?php if ( isset ( $stored_meta ) ) echo $stored_meta; ?>" />
		    <input type="button" id="meta-image-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'pontosdecultura' )?>" />
		</p>
		<?php
		$stored_meta = get_post_meta( $post->ID, 'thumbnail4', true)
		?>
		<p>
		    <label for="meta-image" class="pontos-second-image-meta"><?php _e( 'Foto do Responsável', 'pontosdecultura' )?></label>
		    <input type="text" name="thumbnail4" id="meta-image" value="<?php if ( isset ( $stored_meta ) ) echo $stored_meta; ?>" />
		    <input type="button" id="meta-image-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'pontosdecultura' )?>" />
		</p>
		<?php
		
	}
	
	const NEW_EMREDE_PAGE = 'nova-emrede';
	
	function print_variables($public_query_vars) {
		$public_query_vars[] = self::NEW_EMREDE_PAGE;
		return $public_query_vars;
	}
	
	function rewrite_rules()
	{
		add_rewrite_rule('^'.self::NEW_EMREDE_PAGE.'(.*)', 'index.php?'.self::NEW_EMREDE_PAGE.'=true$matches[1]', 'top');
		flush_rewrite_rules(false);
	}
	
	function form()
	{
		if(get_query_var(self::NEW_EMREDE_PAGE) == true)
		{
			//wp_enqueue_script('jquery-ui-datepicker-ptbr', WP_CONTENT_URL.'/themes/fluxo/emrede/js/jquery.ui.datepicker-pt-BR.js', array('jquery-ui-datepicker'));
			//wp_enqueue_script('date-scripts',WP_CONTENT_URL.'/themes/fluxo/emrede/js/date_scripts.js', array( 'jquery-ui-datepicker-ptbr'));
			wp_enqueue_script('new-emrede', get_template_directory_uri().'/inc/emrede/js/new-emrede.js', array( 'jquery'));
			
			get_header();
			$file_path = get_stylesheet_directory() . '/new-emrede.php';
			if(file_exists($file_path))
			{
				include $file_path;
			}
			else
			{
				include dirname(__FILE__) . '/new-emrede.php';;
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
	function get_default_post_to_edit( $post_type = 'emrede', $create_in_db = false ) {
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
	 * a listagem de emrede e retorna o template
	 * a ser usado.
	 *
	 * @param string $archiveTemplate
	 * @return string
	 */
	public function archiveTemplate($archiveTemplate)
	{
		global $post;
	
		if (get_post_type($post) == "emrede" || is_post_type_archive('emrede'))
		{
			if(file_exists(get_stylesheet_directory()."/archive-emrede.php"))
			{
				$archive_template = get_stylesheet_directory()."/archive-emrede.php";
			}
			else
			{
				$archiveTemplate = $this->themeFilePath('archive-emrede.php');
			}
		}
	
		return $archiveTemplate;
	}
	
	/**
	 * Inclui os arquivos do tema relacionados com
	 * a página de uma emrede e retorna o template
	 * a ser usado.
	 *
	 * @param string $singleTemplate
	 * @return string
	 */
	public function singleTemplate($singleTemplate)
	{
		global $post;
	
		if (get_post_type($post) == "emrede" || is_post_type_archive('emrede'))
		{
			if(file_exists(get_stylesheet_directory()."/single-emrede.php"))
			{
				$singleTemplate = get_stylesheet_directory()."/single-emrede.php";
			}
			else
			{
				$singleTemplate = $this->themeFilePath('single-emrede.php');
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
		if ( ! isset( $_POST['emrede_meta_inner_custom_box_nonce'] ) )
		{
			return $post_id;
		}
		
		$nonce = $_POST['emrede_meta_inner_custom_box_nonce'];
		
		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $nonce, 'emrede_meta_inner_custom_box' ) )
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
		if ( 'emrede' == $_POST['post_type'] )
		{
			if ( ! current_user_can( 'edit_emrede', $post_id ) )
			{
				return $post_id;
			}
		}
		else
		{
			return $post_id;
		}
	
		/* OK, its safe for us to save the data now. */
		EmRede::save_fields($post_id);
		
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
		if( $typenow == 'emrede' )
		{
			wp_enqueue_media();
	
			// Registers and enqueues the required javascript.
			wp_register_script( 'meta-box-image', get_template_directory_uri() . '/inc/emrede/js/meta-box-image.js', array( 'jquery' ) );
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
		wp_register_style( 'emrede', get_template_directory_uri() . '/inc/emrede/css/emrede.css', array(), '1' );
		
		if( get_query_var(self::NEW_EMREDE_PAGE) == true || get_post_type() == 'emrede' )
		{
			wp_enqueue_style( 'emrede' );
		}
		if( function_exists('mapasdevista_enqueue_scripts') && get_query_var(self::NEW_EMREDE_PAGE) == true )
		{
			wp_enqueue_style('mapasdevista-admin', mapasdevista_get_baseurl('template_directory') . '/admin/admin.css');
		}
		
	}
	
	public function javascript()
	{
		if( function_exists('mapasdevista_enqueue_scripts') && get_query_var(self::NEW_EMREDE_PAGE) == true )
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
					?>
					<div class="emrede-item emrede-item-dropdown <?php echo $id; ?>">
						<label for="<?php echo $id ?>" class="emrede-item-label">
							<div class="emrede-item-title"><?php echo $label;
								if($required)
								{?>
									<span class="emrede-item-required-asterisk">*</span><?php
								}?>
							</div>
							<div class="emrede-item-tip-text"><?php echo $tip; ?>
						</div>
						</label><div class="emrede-item-input-dropdown dropdown-<?php echo $id; ?>"><select id="<?php echo $id ?>"
							class="<?php echo $input_class ?>"
							name="<?php echo $id ?>">
								<option value="" selected="selected" ><?php echo esc_attr_x('Selecione', 'pontosdecultura' ); ?></option>
								<?php
									$args = array(
											'orderby' => 'name',
											'hide_empty'=> 0,
											'hierarchical' => 0,
									
									);
									$terms = get_terms($field, $args);
									
									foreach ($terms as $term)
									{
										?>
										<option value="<?php echo $term->slug; ?>" ><?php echo $term->name; ?></option>
										<?php
									}
								?>
							</select>
						</div>
						<div class="emrede-item-error-message"></div>
						<div class="emrede-item-required-message"><?php echo $required_message; ?></div>
					</div>
					<?php
									
				}break;
				case 'estadocidade':
				{
					EmRede::dropdownEstadoCidade($field, $tax);
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
					<div class="emrede-item emrede-item-checkbox <?php echo $id; ?>">
						<label for="<?php echo $id ?>" class="emrede-item-label">
							<div class="emrede-item-title"><?php echo $label;
								if(array_key_exists( 'required', $field ) && $field['required'])
								{?>
									<span class="emrede-item-required-asterisk">*</span><?php
								}?>
							</div>
							<div class="emrede-item-tip-text"><?php echo $tip; ?>
						</div>
						</label> <?php EmRede::taxonomy_checklist($taxonomy); ?>
						<div class="emrede-item-error-message"></div>
						<div class="emrede-item-required-message"><?php echo $required_message; ?></div>
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
					<div class="emrede-item <?php echo $id; ?>">
							<label for="<?php echo $id ?>" class="emrede-item-label">
								<div class="emrede-item-title"><?php echo $label; ?>
								<span class="emrede-item-required-asterisk">*</span>
								</div>
								<div class="emrede-item-tip-text">
								<?php echo $tip; ?>
							</div>
							</label>
						<?php wp_editor((array_key_exists($id, $_POST) ? stripslashes($purifier->purify($_POST[$id])) : ''), $id,  array( 
					       'tinymce' => array( 
					            'content_css' => get_stylesheet_directory_uri() . '/inc/emrede/css/editor-styles.css' 
					    		)
							)
						); ?>
						<div class="emrede-item-error-message"></div>
							<div class="emrede-item-required-message">
							<?php echo $required_message; ?>
						</div>
					</div>
					<?php
				break;
				case 'dropdown-ano':
					?>
					<div class="emrede-item emrede-item-dropdown <?php echo $id; ?>">
						<label for="<?php echo $id ?>" class="emrede-item-label">
							<div class="emrede-item-title"><?php echo $label;
								if(array_key_exists( 'required', $field ) && $field['required'])
								{?>
									<span class="emrede-item-required-asterisk">*</span><?php
								}?>
							</div>
							<div class="emrede-item-tip-text"><?php echo $tip; ?>
						</div>
						</label><div class="emrede-item-input-dropdown dropdown-<?php echo $id; ?>"><select id="<?php echo $id ?>"
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
						<div class="emrede-item-error-message"></div>
						<div class="emrede-item-required-message"><?php echo $required_message; ?></div>
					</div>
					<?php
				break;
				case 'dropdown-meses-anos':
					?>
					<div class="emrede-item emrede-item-dropdown <?php echo $id; ?>">
						<label for="<?php echo $id ?>" class="emrede-item-label">
							<div class="emrede-item-title"><?php echo $label;
								if(array_key_exists( 'required', $field ) && $field['required'])
								{?>
									<span class="emrede-item-required-asterisk">*</span><?php
								}?>
							</div>
							<div class="emrede-item-tip-text"><?php echo $tip; ?>
						</div>
						</label><div class="emrede-item-input-dropdown dropdown-<?php echo $id; ?>"><select id="<?php echo "$id-meses"; ?>"
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
							<div class="emrede-item-input-dropdown dropdown-<?php echo $id; ?>"><select id="<?php echo "$id-anos"; ?>"
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
						<div class="emrede-item-error-message"></div>
						<div class="emrede-item-required-message"><?php echo $required_message; ?></div>
					</div>
					<?php
				break;
				case 'dropdown-cem':
					?>
					<div class="emrede-item emrede-item-dropdown <?php echo $id; ?>">
						<label for="<?php echo $id ?>" class="emrede-item-label">
							<div class="emrede-item-title"><?php echo $label;
								if(array_key_exists( 'required', $field ) && $field['required'])
								{?>
									<span class="emrede-item-required-asterisk">*</span><?php
								}?>
							</div>
							<div class="emrede-item-tip-text"><?php echo $tip; ?>
						</div>
						</label><div class="emrede-item-input-dropdown dropdown-<?php echo $id; ?>"><select id="<?php echo $id ?>"
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
						<div class="emrede-item-error-message"></div>
						<div class="emrede-item-required-message"><?php echo $required_message; ?></div>
					</div>
					<?php
				break;
				case 'radio':
					?>
					<div class="emrede-item emrede-item-radio <?php echo $id; ?>">
						<label for="<?php echo $id ?>" class="emrede-item-label">
							<div class="emrede-item-title"><?php echo $label;
								if(array_key_exists( 'required', $field ) && $field['required'])
								{?>
									<span class="emrede-item-required-asterisk">*</span><?php
								}?>
							</div>
							<div class="emrede-item-tip-text"><?php echo $tip; ?>
						</div>
						</label>
							<div class="emrede-item-input-radio-block"><?php
								$i = 0;
								foreach ($field['values'] as $value => $label_item)
								{
									echo '<input id="'.("$id-option-$i").'" type="radio" name="'.$id.'" value="'.$value.'" '.(array_key_exists($id, $_REQUEST) && wp_strip_all_tags($_REQUEST[$id]) == $value ? 'checked="checked"': '').' ><label for="'.("$id-option-$i").'" class="emrede-item-input-radio" >'.$label_item.'</label>';
									$i++;
								}
						?></div><div class="emrede-item-error-message"></div>
						<div class="emrede-item-required-message"><?php echo $required_message; ?></div>
					</div>
					<?php
				break;
				case 'checkbox':
					?>
					<div class="emrede-item emrede-item-checkbox <?php echo $id; ?>">
						<label for="<?php echo $id ?>" class="emrede-item-label">
							<div class="emrede-item-title"><?php echo $label;
								if(array_key_exists( 'required', $field ) && $field['required'])
								{?>
									<span class="emrede-item-required-asterisk">*</span><?php
								}?>
							</div>
							<div class="emrede-item-tip-text"><?php echo $tip; ?>
						</div>
						</label>
							<div class="emrede-item-input-checkbox-block"><?php
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
									echo '<input id="'.("$id-option-$i").'" type="checkbox" name="'.$id.'[]" value="'.$value.'" '.(in_array($value, $dado) ? 'checked="checked"': '').' ><label for="'.("$id-option-$i").'" class="emrede-item-input-checkbox" >'.$label_item.'</label>';
									$i++;
								}
						?></div><div class="emrede-item-error-message"></div>
						<div class="emrede-item-required-message"><?php echo $required_message; ?></div>
					</div>
					<?php
				break;
				case 'textarea':
				?>
				<div class="emrede-item emrede-item-textarea <?php echo $id; ?>">
					<label for="<?php echo $id ?>" class="emrede-item-label">
						<div class="emrede-item-title"><?php echo $label;
							if(array_key_exists( 'required', $field ) && $field['required'])
							{?>
								<span class="emrede-item-required-asterisk">*</span><?php
							}?>
						</div>
						<div class="emrede-item-tip-text"><?php echo $tip; ?>
						</div>
					</label>
					<textarea id="<?php echo $id ?>"
						class="emrede-item-input-text <?php echo $input_class ?>"
						name="<?php echo $id ?>"
						rows="<?php echo array_key_exists('rows', $field) ? $field['rows'] : 4; ?>"
						<?php echo array_key_exists('cols', $field) ? 'cols="'.$field['cols'].'"' : ''; ?>
					><?php echo array_key_exists($id, $_REQUEST) ? wp_strip_all_tags($_REQUEST[$id]) : ''; ?></textarea>
					<div class="emrede-item-error-message"></div>
					<div class="emrede-item-required-message"><?php echo $required_message; ?></div>
				</div>
				<?php
				break;
				case 'date':
				case 'number':
				default:
					?>
					<div class="emrede-item <?php echo $type == 'text' || $type == '' ? 'emrede-item-text' : 'emrede-item-'.$type; ?> <?php echo $id; ?>">
						<label for="<?php echo $id ?>" class="emrede-item-label">
							<div class="emrede-item-title"><?php echo $label;
								if(array_key_exists( 'required', $field ) && $field['required'])
								{?>
									<span class="emrede-item-required-asterisk">*</span><?php
								}?>
							</div>
							<div class="emrede-item-tip-text"><?php echo $tip; ?>
						</div>
						</label> <input type="<?php echo $type == 'number' ? 'number' : 'text' ?>" id="<?php echo $id ?>"
							class="emrede-item-input-text <?php echo $type == 'date' ? 'hasdatepicker' : ''; ?> <?php echo $input_class ?>"
							value="<?php echo array_key_exists($id, $_REQUEST) ? wp_strip_all_tags($_REQUEST[$id]) : ''; ?>"
							name="<?php echo $id ?>">
						<div class="emrede-item-error-message"></div>
						<div class="emrede-item-required-message"><?php echo $required_message; ?></div>
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
		<div class="emrede-item emrede-item-dropdown">
			<label for="<?php echo $id ?>" class="emrede-item-label">
				<div class="emrede-item-title"><?php echo $label;
					if(array_key_exists( 'required', $field ) && $field['required'])
					{?>
						<span class="emrede-item-required-asterisk">*</span><?php
					}?>
				</div>
				<div class="emrede-item-tip-text"><?php echo $tip; ?>
			</div>
			</label><?php EstadosCidades::dropdown($taxonomy, 'taxonomy_'.$taxonomy.'[]', 'taxonomy_'.$taxonomy.'[]'); ?>
			<div class="emrede-item-error-message"></div>
			<div class="emrede-item-required-message"><?php echo $required_message; ?></div>
		</div>
		<?php
		
	}
	
	public static function get_new_url()
	{
		return get_bloginfo( 'url' ) . '/'.self::NEW_EMREDE_PAGE;
	}
	
	public static function save_fields($post_ID, &$message = array(), &$notice = false)
	{
		global $EmRede_global;
	
		$emrede = $EmRede_global;
	
		$purifier = '';
		if(!is_admin())
		{
			$purifier = new HTMLPurifier();
		}
	
		$post = get_post($post_ID);
	
		/* Save Fields and Custom Fields */
		foreach ($emrede->getFields() as $key => $field)
		{
			if(array_key_exists('save', $field) && $field['save'] == false ) /* do not save especial fields */
			{
				continue;
			}
			
			if( (array_key_exists('required', $field) && $field['required']) && (! array_key_exists($field['slug'], $_POST) || empty($_POST[$field['slug']]) ))
			{
				$message[] = '<span class="error-msn-pre">'.__('*O campo obrigatório').': '.'</span><div onclick="emrede_scroll_to_anchor(\''.$field['slug'].'\');">'.$field['title'].' '.__('não foi preenchido').'</div>';
				$notice = true;
			}
			else 
			{
				
				if(array_key_exists('buildin', $field) && $field['buildin'] == true)
				{
					if(!is_admin())
					{
						if(array_key_exists('type', $field) && $field['type'] == 'wp_editor')
						{
							$post->{$field['slug']} = $purifier->purify(stripslashes($_POST[$field['slug']]));
						}
						else 
						{
							$post->{$field['slug']} = wp_strip_all_tags($_POST[$field['slug']]);
						}
					}
				}
				else 
				{
					if( array_key_exists($field['slug'], $_POST) )
					{
						if(array_key_exists('type', $field) && $field['type'] == 'checkbox' && is_array($_POST[$field['slug']]))
						{
							update_post_meta($post_ID, $field['slug'], implode(',', $_POST[$field['slug']]));
						}
						else
						{
							update_post_meta($post_ID, $field['slug'], $_POST[$field['slug']]);
						}
					}
					elseif(array_key_exists('type', $field) && $field['type'] == 'dropdown-meses-anos')
					{
						if( array_key_exists($field['slug'].'-anos', $_POST) )
						{
							update_post_meta($post_ID, $field['slug'].'-anos', $_POST[$field['slug'].'-anos']);
						}
						if( array_key_exists($field['slug'].'-meses', $_POST) )
						{
							update_post_meta($post_ID, $field['slug'].'-meses', $_POST[$field['slug'].'-meses']);
						}
					}
				}
			}
		}
	}
	
}

$EmRede_global = new EmRede();

/**
 * Custom taxonomies.
 */
require dirname(__FILE__) . '/taxs.php';

require dirname(__FILE__) . '/../estadoscidades/EstadosCidades.php';

?>
