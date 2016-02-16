<?php

class Remocoes
{
	function __construct()
	{
		$this->_customs = get_option('remocoes_custom_fields', array());
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
				'delete_remocoes',
				'delete_private_remocoes',
				'edit_remocoes',
				'edit_remocoes',
				'edit_private_remocoes',
				'publish_remocoes',
				'read_remocoes',
				'read_private_remocoes',
				'delete_published_remocoes',
				'edit_published_remocoes',
				'edit_published_remocoes',
				'edit_others_remocoes',
				'edit_others_remocoes',
				'delete_others_remocoes',
				'delete_others_remocoes'
			)),
			'contributor' => array('Novo' => false, 'Caps' => array
			(
				'read_remocoes',
			)),
			'subscriber' => array('Novo' => false, 'Caps' => array
			(
				'read_remocoes',
			)),
			'author' => array('Novo' => false, 'Caps' => array
			(
				'read_remocoes',
			)),
			'editor' => array('Novo' => false, 'Caps' => array
			(
				'read_remocoes',
			)),
		);
		
		$this->roles_install($permissoes);
		
	}
	
	function Add_custom_Post()
	{
		$labels = array
		(
				'name' => __('Remoções','pontosdecultura'),
				'singular_name' => __('Remoção','pontosdecultura'),
				'add_new' => __('Add new','pontosdecultura'),
				'add_new_item' => __('Add new remoção','pontosdecultura'),
				'edit_item' => __('Edit remoção','pontosdecultura'),
				'new_item' => __('New remoção','pontosdecultura'),
				'view_item' => __('View remoção','pontosdecultura'),
				'search_items' => __('Search remoção','pontosdecultura'),
				'not_found' =>  __('Remoção not found','pontosdecultura'),
				'not_found_in_trash' => __('Remoção not found in the trash','pontosdecultura'),
				'parent_item_colon' => '',
				'menu_name' => __('Remoções','pontosdecultura')
	
		);
	
		$args = array
		(
				'label' => __('Remoções','pontosdecultura'),
				'labels' => $labels,
				'description' => __('Remoções','pontosdecultura'),
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
				'register_meta_box_cb' => array($this, 'pontosdecultura_remocoes_custom_meta'), // função para chamar na edição
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
	
		register_post_type("remocoes", $args);
	}
	
	function pontosdecultura_remocoes_custom_meta()
	{
		add_meta_box("remocoes_meta", __("Detalhes da remoção", 'pontosdecultura'), array($this, 'remocoes_meta'), 'remocoes', 'side', 'default');
		add_meta_box("second_image_meta", __("Imagens da remoção", 'pontosdecultura'), array($this, 'second_image_meta'), 'remocoes', 'side', 'default');
	}
	
	protected $_customs = array();
	
	function getFields()
	{
		$post = array(
			'post_title' => array(
				'slug' => 'post_title',
				'title' => __('Nome', 'pontosdecultura'),
				'tip' => '',
				'required' => true,
				'buildin' => true,
				'multiple' => false
			),
			'post_content' => array(
				'slug' => 'post_content',
				'title' => __('Descrição', 'pontosdecultura'),
				'tip' => __('Limite de 2000 caracteres', 'pontosdecultura'),
				'required' => true,
				'multiple' => false,
				//'type' => 'wp_editor',
				'type' => 'textarea',
				'rows' => 10,
				'buildin' => true
			),
		);
		
		return array_merge($post, $this->_customs);
	}
	
	function remocoes_meta()
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

		wp_nonce_field( 'remocoes_meta_inner_custom_box', 'remocoes_meta_inner_custom_box_nonce' );

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
			if (!empty($campo['multiple']))
				$dado = unserialize($dado);
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
	
	const NEW_REMOCOES_PAGE = 'nova-remocoes';
	
	function print_variables($public_query_vars) {
		$public_query_vars[] = self::NEW_REMOCOES_PAGE;
		return $public_query_vars;
	}
	
	function rewrite_rules()
	{
		add_rewrite_rule('^'.self::NEW_REMOCOES_PAGE.'(.*)', 'index.php?'.self::NEW_REMOCOES_PAGE.'=true$matches[1]', 'top');
		flush_rewrite_rules(false);
	}
	
	function form()
	{
		if(get_query_var(self::NEW_REMOCOES_PAGE) == true)
		{
			wp_enqueue_script('jquery-ui-datepicker', get_template_directory_uri().'/inc/remocoes/js/jquery.ui.datepicker.js', array('jquery'));
			wp_enqueue_script('date-scripts', get_template_directory_uri().'/inc/remocoes/js/date_scripts.js', array('jquery-ui-datepicker'));
			wp_enqueue_script('new-remocoes', get_template_directory_uri().'/inc/remocoes/js/new-remocoes.js', array( 'jquery'));
			
			get_header();
			$file_path = get_stylesheet_directory() . '/new-remocoes.php';
			if(file_exists($file_path))
			{
				include $file_path;
			}
			else
			{
				include dirname(__FILE__) . '/new-remocoes.php';;
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
	function get_default_post_to_edit( $post_type = 'remocoes', $create_in_db = false ) {
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
	 * a listagem de remocoes e retorna o template
	 * a ser usado.
	 *
	 * @param string $archiveTemplate
	 * @return string
	 */
	public function archiveTemplate($archiveTemplate)
	{
		global $post;
	
		if (get_post_type($post) == "remocoes" || is_post_type_archive('remocoes'))
		{
			if(file_exists(get_stylesheet_directory()."/archive-remocoes.php"))
			{
				$archive_template = get_stylesheet_directory()."/archive-remocoes.php";
			}
			else
			{
				$archiveTemplate = $this->themeFilePath('archive-remocoes.php');
			}
		}
	
		return $archiveTemplate;
	}
	
	/**
	 * Inclui os arquivos do tema relacionados com
	 * a página de uma remocoes e retorna o template
	 * a ser usado.
	 *
	 * @param string $singleTemplate
	 * @return string
	 */
	public function singleTemplate($singleTemplate)
	{
		global $post;
	
		if (get_post_type($post) == "remocoes" || is_post_type_archive('remocoes'))
		{
			if(file_exists(get_stylesheet_directory()."/single-remocoes.php"))
			{
				$singleTemplate = get_stylesheet_directory()."/single-remocoes.php";
			}
			else
			{
				$singleTemplate = $this->themeFilePath('single-remocoes.php');
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
		if ( ! isset( $_POST['remocoes_meta_inner_custom_box_nonce'] ) )
		{
			return $post_id;
		}
		
		$nonce = $_POST['remocoes_meta_inner_custom_box_nonce'];
		
		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $nonce, 'remocoes_meta_inner_custom_box' ) )
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
		if ( 'remocoes' == $_POST['post_type'] )
		{
			if ( ! current_user_can( 'edit_remocoes', $post_id ) )
			{
				return $post_id;
			}
		}
		else
		{
			return $post_id;
		}
	
		/* OK, its safe for us to save the data now. */
		Remocoes::save_fields($post_id);
		
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
		if( $typenow == 'remocoes' )
		{
			wp_enqueue_media();
	
			// Registers and enqueues the required javascript.
			wp_register_script( 'meta-box-image', get_template_directory_uri() . '/inc/remocoes/js/meta-box-image.js', array( 'jquery' ) );
			wp_localize_script( 'meta-box-image', 'meta_image',
			array(
			'title' => __( 'Choose or Upload an Image', 'pontosdecultura' ),
			'button' => __( 'Use this image', 'pontosdecultura' ),
			)
			);
			wp_enqueue_script( 'meta-box-image' );

			wp_enqueue_script('jquery-ui-datepicker', get_template_directory_uri().'/inc/remocoes/js/jquery.ui.datepicker.js', array('jquery'));
			wp_enqueue_script('date-scripts', get_template_directory_uri().'/inc/remocoes/js/date_scripts.js', array('jquery-ui-datepicker'));
			wp_enqueue_script('new-remocoes', get_template_directory_uri().'/inc/remocoes/js/new-remocoes.js', array( 'jquery'));
		}
	}
	
	/**
	 * Função responsável por controlar as folhas de estilo do site para práticas
	 *
	 */
	public function css()
	{
		// map.css
		wp_register_style( 'remocoes', get_template_directory_uri() . '/inc/remocoes/css/remocoes.css', array(), '1' );
		
		if( get_query_var(self::NEW_REMOCOES_PAGE) == true || get_post_type() == 'remocoes' )
		{
			wp_enqueue_style( 'remocoes' );
		}
		if( function_exists('mapasdevista_enqueue_scripts') && get_query_var(self::NEW_REMOCOES_PAGE) == true )
		{
			wp_enqueue_style('mapasdevista-admin', mapasdevista_get_baseurl('template_directory') . '/admin/admin.css');
		}
		
	}
	
	public function javascript()
	{
		if( function_exists('mapasdevista_enqueue_scripts') && get_query_var(self::NEW_REMOCOES_PAGE) == true )
		{
			mapasdevista_enqueue_scripts();
			wp_enqueue_script('metabox', mapasdevista_get_baseurl() . '/admin/metabox.js', array('jquery', 'jquery-ui-resizable', 'jquery-ui-dialog') );
			$data = array('options' => get_option('mapasdevista'));
			wp_localize_script('metabox', 'mapasdevista_options', $data);
		}
	}

	static function get_clean_request_data($id, $multiple=false)
	{
		return $multiple
			&& array_key_exists($id, $_REQUEST)
			&& is_array($_REQUEST[$id])?
			array_map('wp_strip_all_tags', $_REQUEST[$id])
			: array(empty($_REQUEST[$id])? '' : $_REQUEST[$id]);
	}
	
	static function print_field($field, $tax = false)
	{
		$purifier = new HTMLPurifier();

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
					<div class="remocoes-item remocoes-item-dropdown <?php echo $id; ?>">
						<label for="<?php echo $id ?>" class="remocoes-item-label">
							<div class="remocoes-item-title"><?php echo $label;
								if($required)
								{?>
									<span class="remocoes-item-required-asterisk">*</span><?php
								}?>
							</div>
							<div class="remocoes-item-tip-text"><?php echo $tip; ?>
						</div>
						</label><div class="remocoes-item-input-dropdown-block dropdown-<?php echo $id; ?>"><select id="<?php echo $id ?>"
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
						<div class="remocoes-item-error-message"></div>
						<div class="remocoes-item-required-message"><?php echo $required_message; ?></div>
					</div>
					<?php
									
				}break;
				case 'estadocidade':
				{
					Remocoes::dropdownEstadoCidade($field, $tax);
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
					<div class="remocoes-item remocoes-item-checkbox <?php echo $id; ?>">
						<label for="<?php echo $id ?>" class="remocoes-item-label">
							<div class="remocoes-item-title"><?php echo $label;
								if(array_key_exists( 'required', $field ) && $field['required'])
								{?>
									<span class="remocoes-item-required-asterisk">*</span><?php
								}?>
							</div>
							<div class="remocoes-item-tip-text"><?php echo $tip; ?>
						</div>
						</label> <?php Remocoes::taxonomy_checklist($taxonomy); ?>
						<div class="remocoes-item-error-message"></div>
						<div class="remocoes-item-required-message"><?php echo $required_message; ?></div>
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
			$multiple = array_key_exists('multiple', $field)?
				$field['multiple'] : false;
			$clean_data = Remocoes::get_clean_request_data($id, $multiple);
			switch ($type)
			{
				case 'wp_editor':
					?>
					<div class="remocoes-item <?php echo $id; ?>">
							<label for="<?php echo $id ?>" class="remocoes-item-label">
								<div class="remocoes-item-title"><?php echo $label; ?>
								<span class="remocoes-item-required-asterisk">*</span>
								</div>
								<div class="remocoes-item-tip-text">
								<?php echo $tip; ?>
							</div>
							</label>
							<div class="remocoes-set">
						<?php wp_editor((array_key_exists($id, $_POST) ? stripslashes($purifier->purify($_POST[$id])) : ''), $id,
								array(
								 //'textarea_name' => $multiple? "${id}[]" : $id,
								 'tinymce' => array(
											'content_css' => get_stylesheet_directory_uri() . '/inc/remocoes/css/editor-styles.css' 
									)
							)
						); ?>
						</div>
						<div class="remocoes-item-error-message"></div>
							<div class="remocoes-item-required-message">
							<?php echo $required_message; ?>
						</div>
					</div>
					<?php
				break;
				case 'dropdown-ano':
					?>
					<div class="remocoes-item remocoes-item-dropdown <?php echo $id; ?>">
						<label for="<?php echo $id ?>" class="remocoes-item-label">
							<div class="remocoes-item-title"><?php echo $label;
								if(array_key_exists( 'required', $field ) && $field['required'])
								{?>
									<span class="remocoes-item-required-asterisk">*</span><?php
								}?>
							</div>
							<div class="remocoes-item-tip-text"><?php echo $tip; ?>
						</div>
						</label>
						<?php foreach ($clean_data as $entry): ?>
							<div class="remocoes-set"><div class="remocoes-item-input-dropdown-block dropdown-<?php echo $id; ?>"><select id="<?php echo $id ?>"
								class="<?php echo $input_class ?>"
								name="<?php echo $multiple? "${id}[]" : $id; ?>">
									<option value="" <?php echo empty($entry)? '' : 'selected="selected"'; ?> ><?php echo esc_attr_x('Selecione', 'pontosdecultura' ); ?></option>
									<?php
										for($i = date('Y'); $i >= 1900; $i--)
										{
											?>
											<option value="<?php echo $i; ?>" <?php echo $entry == $i ? 'selected="selected"': ''; ?> ><?php echo $i; ?></option>
											<?php
										}
									?>
								</select>
							</div></div>
						<?php endforeach; ?>
						<?php if ($multiple): ?>
								<input type="button"
									class="remocoes-add-another"
									value="<?php _e('Adicionar outro', 'pontosdecultura'); ?>">
						<?php endif; ?>
						<div class="remocoes-item-error-message"></div>
						<div class="remocoes-item-required-message"><?php echo $required_message; ?></div>
					</div>
					<?php
				break;
				case 'dropdown-meses-anos':
					?>
					<div class="remocoes-item remocoes-item-dropdown <?php echo $id; ?>">
						<label for="<?php echo $id ?>" class="remocoes-item-label">
							<div class="remocoes-item-title"><?php echo $label;
								if(array_key_exists( 'required', $field ) && $field['required'])
								{?>
									<span class="remocoes-item-required-asterisk">*</span><?php
								}?>
							</div>
							<div class="remocoes-item-tip-text"><?php echo $tip; ?>
						</div>
						</label>
						<?php
						$meses = Remocoes::get_clean_request_data("$id-meses", $multiple);
						$anos = Remocoes::get_clean_request_data("$id-anos", $multiple);
						$clean_data = array_map(null, $meses, $anos);
						foreach ($clean_data as $entry): ?>
							<div class="remocoes-set"><div class="remocoes-item-input-dropdown-block dropdown-<?php echo $id; ?>"><select id="<?php echo "$id-meses"; ?>"
								class="<?php echo $input_class; ?>"
								name="<?php echo $multiple?
									"${id}-meses[]" : "$id-meses"; ?>">
									<option value="" <?php echo !empty($entry[0])? '' : 'selected="selected"';?> ><?php echo esc_attr_x('Meses', 'pontosdecultura' ); ?></option>
									<?php
										for($i = 1; $i < 13; $i++)
										{
											?>
											<option value="<?php echo $i; ?>" <?php echo $entry[0] == $i? 'selected="selected"': ''; ?> ><?php echo $i; ?></option>
											<?php
										}
									?>
								</select></div>
								<div class="remocoes-item-input-dropdown-block dropdown-<?php echo $id; ?>"><select id="<?php echo "$id-anos"; ?>"
								class="<?php echo $input_class; ?>"
								name="<?php echo $multiple?
									"${id}-anos[]" : "$id-anos"; ?>">
									<option value="" <?php echo !empty($entry[1])? '' : 'selected="selected"';?> ><?php echo esc_attr_x('Anos', 'pontosdecultura' ); ?></option>
									<?php
										for($i = 1; $i < 101; $i++)
										{
											?>
											<option value="<?php echo $i; ?>" <?php echo $entry[1] == $i? 'selected="selected"': ''; ?> ><?php echo $i; ?></option>
											<?php
										}
									?>
								</select>
							</div></div>
						<?php endforeach; ?>
						<?php if ($multiple): ?>
								<input type="button"
									class="remocoes-add-another"
									value="<?php _e('Adicionar outro', 'pontosdecultura'); ?>">
						<?php endif; ?>
						<div class="remocoes-item-error-message"></div>
						<div class="remocoes-item-required-message"><?php echo $required_message; ?></div>
					</div>
					<?php
				break;
				case 'dropdown-cem':
					?>
					<div class="remocoes-item remocoes-item-dropdown <?php echo $id; ?>">
						<label for="<?php echo $id ?>" class="remocoes-item-label">
							<div class="remocoes-item-title"><?php echo $label;
								if(array_key_exists( 'required', $field ) && $field['required'])
								{?>
									<span class="remocoes-item-required-asterisk">*</span><?php
								}?>
							</div>
							<div class="remocoes-item-tip-text"><?php echo $tip; ?>
						</div>
						</label>
						<?php foreach ($clean_data as $entry): ?>
							<div class="remocoes-set"><div class="remocoes-item-input-dropdown-block dropdown-<?php echo $id; ?>"><select id="<?php echo $id ?>"
								class="<?php echo $input_class ?>"
								name="<?php echo $multiple? "${id}[]" : $id; ?>">
									<option value="" selected="selected" ><?php echo esc_attr_x('Selecione', 'pontosdecultura' ); ?></option>
									<?php
										for($i = 1; $i < 100; $i++)
										{
											$label = $i == 99 ? '99+' : $i;
											?>
											<option value="<?php echo $i; ?>" <?php echo $entry == $i ? 'selected="selected"': ''; ?> ><?php echo $label; ?></option>
											<?php
										}
									?>
								</select>
							</div></div>
						<?php endforeach; ?>
						<?php if ($multiple): ?>
								<input type="button"
									class="remocoes-add-another"
									value="<?php _e('Adicionar outro', 'pontosdecultura'); ?>">
						<?php endif; ?>
						<div class="remocoes-item-error-message"></div>
						<div class="remocoes-item-required-message"><?php echo $required_message; ?></div>
					</div>
					<?php
				break;
				case 'radio':
					?>
					<div class="remocoes-item remocoes-item-radio <?php echo $id; ?>">
						<label for="<?php echo $id ?>" class="remocoes-item-label">
							<div class="remocoes-item-title"><?php echo $label;
								if(array_key_exists( 'required', $field ) && $field['required'])
								{?>
									<span class="remocoes-item-required-asterisk">*</span><?php
								}?>
							</div>
							<div class="remocoes-item-tip-text"><?php echo $tip; ?>
						</div>
						</label>
							<div class="remocoes-set"><div class="remocoes-item-input-radio-block"><?php
								$i = 0;
								foreach ($field['values'] as $value => $label_item)
								{
									echo '<input id="'.("$id-option-$i").'" type="radio" name="'.$id.'" value="'.$value.'" '.(array_key_exists($id, $_REQUEST) && wp_strip_all_tags($_REQUEST[$id]) == $value ? 'checked="checked"': '').' ><label for="'.("$id-option-$i").'" class="remocoes-item-input-radio" >'.$label_item.'</label>';
									$i++;
								}
						?></div></div>
						<div class="remocoes-item-error-message"></div>
						<div class="remocoes-item-required-message"><?php echo $required_message; ?></div>
					</div>
					<?php
				break;
				case 'dropdown':
					?>
					<div class="remocoes-item remocoes-item-dropdown<?php echo $id; ?>">
						<label for="<?php echo $id ?>" class="remocoes-item-label">
							<div class="remocoes-item-title"><?php echo $label;
								if(array_key_exists( 'required', $field ) && $field['required'])
								{?>
									<span class="remocoes-item-required-asterisk">*</span><?php
								}?>
							</div>
							<div class="remocoes-item-tip-text"><?php echo $tip; ?>
						</div>
						</label>
						<?php foreach ($clean_data as $entry): ?>
							<div class="remocoes-set remocoes-item-input-dropdown-block">
								<select
									name="<?php echo $multiple? "${id}[]" : $id; ?>"
									class="remocoes-item-input-dropdown"><?php
									$i = 0;
									foreach ($field['values'] as $value => $label_item)
									{
										echo "<option id=\"$id-option-$i\" value=\"$value\"";
										if ($entry == $value)
											echo ' selected="true"';
										echo '>';
										echo htmlspecialchars($label_item);
										echo '</option>';
										$i++;
									}
								?></select>
							</div>
						<?php endforeach; ?>
						<?php if ($multiple): ?>
								<input type="button"
									class="remocoes-add-another"
									value="<?php _e('Adicionar outro', 'pontosdecultura'); ?>">
						<?php endif; ?>
						<div class="remocoes-item-error-message"></div>
						<div class="remocoes-item-required-message"><?php echo $required_message; ?></div>
					</div>
					<?php
				break;
				case 'checkbox':
					?>
					<div class="remocoes-item remocoes-item-checkbox <?php echo $id; ?>">
						<label for="<?php echo $id ?>" class="remocoes-item-label">
							<div class="remocoes-item-title"><?php echo $label;
								if(array_key_exists( 'required', $field ) && $field['required'])
								{?>
									<span class="remocoes-item-required-asterisk">*</span><?php
								}?>
							</div>
							<div class="remocoes-item-tip-text"><?php echo $tip; ?>
						</div>
						</label>
							<div class="remocoes-item-input-checkbox-block"><?php
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
									echo '<input id="'.("$id-option-$i").'" type="checkbox" name="'.$id.'[]" value="'.$value.'" '.(in_array($value, $dado) ? 'checked="checked"': '').' ><label for="'.("$id-option-$i").'" class="remocoes-item-input-checkbox" >'.$label_item.'</label>';
									$i++;
								}
						?></div><div class="remocoes-item-error-message"></div>
						<div class="remocoes-item-required-message"><?php echo $required_message; ?></div>
					</div>
					<?php
				break;
				case 'textarea':
				?>
				<div class="remocoes-item remocoes-item-textarea <?php echo $id; ?>">
					<label for="<?php echo $id ?>" class="remocoes-item-label">
						<div class="remocoes-item-title"><?php echo $label;
							if(array_key_exists( 'required', $field ) && $field['required'])
							{?>
								<span class="remocoes-item-required-asterisk">*</span><?php
							}?>
						</div>
						<div class="remocoes-item-tip-text"><?php echo $tip; ?>
						</div>
					</label>
					<?php foreach ($clean_data as $entry): ?>
						<div class="remocoes-set">
							<textarea id="<?php echo $id ?>"
								class="remocoes-item-input-text <?php echo $input_class ?>"
								name="<?php echo $multiple? "${id}[]" : $id; ?>"
								rows="<?php echo array_key_exists('rows', $field) ? $field['rows'] : 4; ?>"
								<?php echo array_key_exists('cols', $field) ? 'cols="'.$field['cols'].'"' : ''; ?>
							><?php echo $entry; ?></textarea>
						</div>
					<?php endforeach; ?>
					<?php if ($multiple): ?>
							<input type="button"
								class="remocoes-add-another"
								value="<?php _e('Adicionar outro', 'pontosdecultura'); ?>">
					<?php endif; ?>
					<div class="remocoes-item-error-message"></div>
					<div class="remocoes-item-required-message"><?php echo $required_message; ?></div>
				</div>
				<?php
				break;
				case 'date':
				case 'number':
				default:
					?>
					<div class="remocoes-item <?php echo $type == 'text' || $type == '' ? 'remocoes-item-text' : 'remocoes-item-'.$type; ?> <?php echo $id; ?>">
						<label for="<?php echo $id ?>" class="remocoes-item-label">
							<div class="remocoes-item-title"><?php echo $label;
								if(array_key_exists( 'required', $field ) && $field['required'])
								{?>
									<span class="remocoes-item-required-asterisk">*</span><?php
								}?>
							</div>
							<div class="remocoes-item-tip-text"><?php echo $tip; ?>
						</div>
						</label>
						<?php foreach ($clean_data as $entry): ?>
							<div class="remocoes-set">
								<input
									type="<?php echo $type == 'number'? 'number' : 'text'; ?>"
									class="remocoes-item-input-text <?php echo $type == 'date'?
										'hasdatepicker' : ''; ?> <?php echo $input_class ?>"
									value="<?php echo $entry; ?>"
									name="<?php echo $multiple? "${id}[]" : $id; ?>"
									>
							</div>
						<?php endforeach; ?>
						<?php if ($multiple): ?>
								<input type="button"
									class="remocoes-add-another"
									value="<?php _e('Adicionar outro', 'pontosdecultura'); ?>">
						<?php endif; ?>
						<div class="remocoes-item-error-message"></div>
						<div class="remocoes-item-required-message"><?php echo $required_message; ?></div>
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
		<div class="remocoes-item remocoes-item-dropdown">
			<label for="<?php echo $id ?>" class="remocoes-item-label">
				<div class="remocoes-item-title"><?php echo $label;
					if(array_key_exists( 'required', $field ) && $field['required'])
					{?>
						<span class="remocoes-item-required-asterisk">*</span><?php
					}?>
				</div>
				<div class="remocoes-item-tip-text"><?php echo $tip; ?>
			</div>
			</label><?php EstadosCidades::dropdown($taxonomy, 'taxonomy_'.$taxonomy.'[]', 'taxonomy_'.$taxonomy.'[]'); ?>
			<div class="remocoes-item-error-message"></div>
			<div class="remocoes-item-required-message"><?php echo $required_message; ?></div>
		</div>
		<?php
		
	}
	
	public static function get_new_url()
	{
		return get_bloginfo( 'url' ) . '/'.self::NEW_REMOCOES_PAGE;
	}
	
	public static function save_fields($post_ID, &$message = array(), &$notice = false)
	{
		global $Remocoes_global;
	
		$remocoes = $Remocoes_global;
	
		$purifier = '';
		if(!is_admin())
		{
			$purifier = new HTMLPurifier();
		}
	
		$post = get_post($post_ID);
	
		/* Save Fields and Custom Fields */
		foreach ($remocoes->getFields() as $key => $field)
		{
			if(array_key_exists('save', $field) && $field['save'] == false ) /* do not save especial fields */
			{
				continue;
			}
			
			if( (array_key_exists('required', $field) && $field['required']) && (! array_key_exists($field['slug'], $_POST) || empty($_POST[$field['slug']]) ))
			{
				$message[] = '<span class="error-msn-pre">'.__('*O campo obrigatório').': '.'</span><div onclick="remocoes_scroll_to_anchor(\''.$field['slug'].'\');">'.$field['title'].' '.__('não foi preenchido').'</div>';
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

require_once dirname(__FILE__).'/HTMLPurifier.standalone.php';

$Remocoes_global = new Remocoes();

/**
 * Custom taxonomies.
 */
require dirname(__FILE__) . '/taxs.php';

require dirname(__FILE__) . '/../estadoscidades/EstadosCidades.php';

?>
