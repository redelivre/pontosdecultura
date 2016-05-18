<?php

class PontosSettingsPage
{
	/**
	 * Holds the values to be used in the fields callbacks
	 */
	private $options;

	/**
	 * Start up
	 */
	public function __construct()
	{
		add_action( 'admin_menu', array( $this, 'add_theme_page' ) );
		add_action( 'admin_init', array( $this, 'page_init' ) );
	}

	/**
	 * Add options page
	 */
	public function add_theme_page()
	{
		// These will be under "Tools"
		add_management_page(
			__('Importar/Exportar remoções do arquivo','pontosdecultura'),
			__('Importar/Exportar remoções do arquivo','pontosdecultura'),
			'import',
			'pontos-import-file',
			array(&$this, 'create_admin_page')
		);
		add_management_page(
			__('Configurar campos das remoções','pontosdecultura'),
			__('Configurar campos das remoções','pontosdecultura'),
			'edit_theme_options',
			'pontos-edit-fields',
			array(&$this, 'create_edit_page')
		);
	}

	private function updateCustomFields($new)
	{
		$typeData = self::getTypeData();
		$fields = array();
		$used = array();
		foreach ($new as $field)
		{
			$data = array();
			$extraData = $typeData[$field['type']]['extra_data'];

			if (!empty($typeData[$field['type']]['unique']))
			{
				if (in_array($field['type'], $used))
					continue;
				$used[] = $field['type'];
			}

			$data['type'] = $field['type'];
			$data = $this->forceField($data);

			if (!array_key_exists('slug', $data))
				$data['slug'] = sanitize_title($field['title']);
			if (!array_key_exists('title', $data))
				$data['title'] = trim($field['title']);
			if (!array_key_exists('tip', $data))
				$data['tip'] = array_key_exists('tip', $field)?
					trim($field['tip']) : '';
			if (!array_key_exists('download', $data))
				$data['download'] = $field['download'];
			if (!array_key_exists('hide', $data))
				$data['hide'] = array_key_exists('hide', $field) && $field['hide'];
			if (!array_key_exists('required', $data))
				$data['required'] = array_key_exists('required', $field)
					&& $field['required'];
			if (!array_key_exists('advanced', $data))
				$data['advanced'] = array_key_exists('advanced', $field)
					&& $field['advanced'];
			if (!array_key_exists('multiple', $data))
				$data['multiple'] = array_key_exists('multiple', $field)
					&& $field['multiple'];
			if (!array_key_exists('taxonomy', $data))
				$data['taxonomy'] = array_key_exists('taxonomy', $field)
					&& $field['taxonomy']
					&& !empty($typeData[$field['type']]['can_be_tax']);

			if (in_array('values', $extraData, true))
			{
				$data['values'] = array();
				$j = 0;
				foreach ($field['values'] as $v)
				{
					$data['values'][$data['slug'].'_'.sanitize_title($v)."_$j"]=trim($v);
					$j++;
				}
			}

			if (in_array('rows', $extraData, true))
			{
				$data['rows'] = (int) $field['rows'];
			}

			if (in_array('cols', $extraData, true))
			{
				$data['cols'] = (int) $field['cols'];
			}

			$fields[$data['slug']] = $data;
		}

		update_option('remocoes_custom_fields', $fields);
	}

	private function forceField($field)
	{
		$typeData = self::getTypeData();

		$forced = array_key_exists('forced', $typeData[$field['type']])?
			$typeData[$field['type']]['forced'] : array();
		foreach ($forced as $k => $v)
			$field[$k] = $v;
		return $field;
	}

	private function handleEditPost()
	{
		/* Die silently if the form is not filled properly,
			 error messages are handled by the frontend */
		if (!array_key_exists('remocoes-custom', $_POST)
				|| !$this->validateFields($_POST['remocoes-custom']))
			return;

		$this->updateCustomFields($_POST['remocoes-custom']);
	}

	private function validateValuesArray($values)
	{
		foreach ($values as $v)
		{
			if (empty($v))
				return false;
		}

		return true;
	}

	private function validateSingleField($field)
	{
		$typeData = self::getTypeData();

		if (!is_array($field))
			return false;

		if (!array_key_exists('type', $field)
				|| !array_key_exists($field['type'], $typeData))
			return false;
		$field = $this->forceField($field);
		$extraData = $typeData[$field['type']]['extra_data'];

		if (empty($field['title']) || is_array($field['title']))
			return false;

		if (!array_key_exists('download', $field)
				|| !in_array($field['download'], array('admin', 'everyone'), true))
			return false;

		if (in_array('values', $extraData, true) &&
			(!array_key_exists('values', $field)
			 || !is_array($field['values'])
			 || !$this->validateValuesArray($field['values'])))
			return false;

		if (in_array('rows', $extraData, true) &&
			(empty($field['rows'])
			 || !is_numeric($field['rows'])
			 || (int) $field['rows'] <= 0))
			return false;

		if (in_array('cols', $extraData, true) &&
			(empty($field['cols'])
			 || !is_numeric($field['cols'])
			 || (int) $field['cols'] <= 0))
			return false;

		return true;
	}

	private function validateFields($fields)
	{
		if (!is_array($fields))
			return false;

		$slugs = array();
		foreach ($fields as $field)
		{
			if (!$this->validateSingleField($field))
				return false;

			$data = $this->forceField(array('type' => $field['type']));
			$slug = array_key_exists('slug', $data)?
				$data['slug'] : sanitize_title($field['title']);
			if (in_array($slug, $slugs))
				return false;
			$slugs[] = $slug;
		}

		return true;
	}

	private function importFields()
	{
		if (!array_key_exists('remocoes-import-file', $_FILES)
				|| !array_key_exists('tmp_name', $_FILES['remocoes-import-file'])
				|| $_FILES['remocoes-import-file']['error'])
			return;

		$json = json_decode(file_get_contents(
					$_FILES["remocoes-import-file"]["tmp_name"]), true);

		if (!$this->validateFields($json))
			return;

		$this->updateCustomFields($json);
	}

	private function updateBuiltinNames()
	{
		if (!empty($_POST['remocoes-post-title']))
			update_option('remocoes_post_title', $_POST['remocoes-post-title']);
		if (!empty($_POST['remocoes-post-content']))
			update_option('remocoes_post_content', $_POST['remocoes-post-content']);
		if (!empty($_POST['remocoes-map-title']))
			update_option('remocoes_map_title', $_POST['remocoes-map-title']);
		update_option('remocoes_default_pin_only',
				!empty($_POST['remocoes-default-pin-only']));
		update_option('remocoes_no_captcha', empty($_POST['remocoes-captcha']));
		if (!empty($_POST['remocoes-auto-publish']))
			update_option('remocoes_auto_publish', $_POST['remocoes-auto-publish']);
	}

	public function create_edit_page()
	{
		if (array_key_exists('remocoes-import', $_POST))
			$this->importFields();
		elseif (array_key_exists('remocoes-builtin-names', $_POST))
			$this->updateBuiltinNames();
		else
			$this->handleEditPost();
		$current = get_option('remocoes_custom_fields', array());
		wp_enqueue_script('remocoes-edit',
				get_template_directory_uri() . '/inc/remocoes/js/edit.js');
		echo '<div class="wrap">';
		require dirname(__FILE__ ) . '/remocoes/edit.php';
		echo '</div>';
	}

	/**
	 * Options page callback
	 */
	public function create_admin_page()
	{
		// Set class property
		$this->options = get_option( 'pontosdecultura_theme_options', array() );
		?>
			<div class="wrap">
					<h2><?php _e('Import File Tool', 'pontosdecultura') ?></h2>
					<form method="post" action="options.php">
					<?php
							// This prints out all hidden setting fields
							settings_fields( 'pontosdecultura_option_group' );
							do_settings_sections( 'pontos-import-file' );
							submit_button("Check Estado/Cidades", 'secundary', 'check-estado-cidade' );
							echo '<b>'.__('Arquivo a importar:', 'pontosdecultura').'</b>';
							echo '<input id="remocoes-import-csv" '
								. 'name="remocoes-import-csv" type="file">';
							submit_button("Importar Csv", 'secundary', 'importcsv' );
							submit_button("Exportar Csv", 'secundary', 'remocoes-exportcsv');
							submit_button("Importar Pins", 'secundary', 'importpins' );
							submit_button();
					?>
					</form>
					<div id="result">
					</div>
			</div>
		<?php
	}

	public static function getTypeData()
	{
		return array(
				'input' => array(
					'label' => __('Linha de texto', 'pontosdecultura'),
					'extra_data' => array(),
				),
				'date' => array(
					'label' => __('Data', 'pontosdecultura'),
					'extra_data' => array(),
				),
				'dropdown' => array(
					'label' => __('Dropdown', 'pontosdecultura'),
					'extra_data' => array('values'),
					'can_be_tax' => true,
				),
				'estadocidade' => array(
					'label' => __('Estado e cidade', 'pontosdecultura'),
					'extra_data' => array(),
					'unique' => true,
					'forced' => array(
						'taxonomy' => true,
						'title' => __('Território', 'pontosdecultura'),
						'slug' => 'territorio',
						'required' => true,
						'download' => 'everyone',
						'hide' => false,
						'advanced' => true,
					),
				),
				'wp_editor' => array(
					'label' => __('Editor Wordpress', 'pontosdecultura'),
					'extra_data' => array('rows', 'cols'),
				),
				'dropdown-ano' => array(
					'label' => __('Dropdown ano', 'pontosdecultura'),
					'extra_data' => array(),
				),
				'dropdown-meses-anos' => array(
					'label' => __('Dropdown meses anos', 'pontosdecultura'),
					'extra_data' => array(),
				),
				'dropdown-cem' => array(
					'label' => __('Dropdown cem', 'pontosdecultura'),
					'extra_data' => array(),
				),
				'radio' => array(
					'label' => __('Radio', 'pontosdecultura'),
					'extra_data' => array('values'),
				),
				'checkbox' => array(
					'label' => __('Checkbox', 'pontosdecultura'),
					'extra_data' => array('values'),
				),
				'textarea' => array(
					'label' => __('Texto multilinha', 'pontosdecultura'),
					'extra_data' => array('rows', 'cols'),
				),
				'number' => array(
					'label' => __('Número', 'pontosdecultura'),
					'extra_data' => array(),
				),
				'event' => array(
					'label' => __('Evento', 'pontosdecultura'),
					'extra_data' => array('values'),
				),
		);
	}

	private function exportFieldsJson()
	{
		header('Content-disposition: attachment; filename=fields.json');
		header('Content-type: application/json');
		$current = get_option('remocoes_custom_fields', array());
		echo json_encode($current);
		die;
	}

	private function exportPostsCsv()
	{
		global $Remocoes_global;
		$fields = $Remocoes_global->getFields();
		$fields['_mpv_location'] = array('slug' => '_mpv_location',
				'type' => null);
		$fields['_mpv_inmap'] = array('slug' => '_mpv_inmap', 'type' => null);
		$posts = get_posts(array('post_type' => 'remocoes',
					'posts_per_page' => '-1'));

		$metas = array();
		$terms = array();
		foreach ($posts as $p)
		{
			$metas[$p->ID] = get_post_meta($p->ID);
			$metas[$p->ID]['post_title'] = array($p->post_title);
			$metas[$p->ID]['post_content'] = array($p->post_content);
			foreach ($fields as $f)
				if (!empty($f['taxonomy']))
					$terms[$p->ID][$f['slug']] = wp_get_post_terms($p->ID, $f['slug']);
		}

		$metaKeys = array();
		foreach ($fields as $f)
		{
			if (!empty($f['taxonomy']))
				continue;

			switch ($f['type'])
			{
				case 'event':
					$metaKeys[] = $f['slug'] . '-type';
					$metaKeys[] = $f['slug'] . '-date';
					$metaKeys[] = $f['slug'] . '-about';
					break;

				case 'dropdown-meses-anos':
					$metaKeys[] = $f['slug'] . '-meses';
					$metaKeys[] = $f['slug'] . '-anos';
					break;

				default:
					$metaKeys[] = $f['slug'];
					break;
			}
		}

		$taxKeys = array();
		foreach ($fields as $f)
		{
			if (empty($f['taxonomy']))
				continue;

			$taxKeys[] = $f['slug'];
		}

		$keys = array();
		$positions = array();

		foreach (array_merge($metaKeys, $taxKeys) as $s) {
			$positions[$s] = array(sizeof($keys));
			$keys[] = $s;
		}

		foreach ($posts as $p)
		{
			foreach (array_merge($metaKeys, $taxKeys) as $s)
			{
				if (array_key_exists($s, $metas[$p->ID]))
					$numNew = max(0,
							sizeof($metas[$p->ID][$s]) - sizeof($positions[$s]));
				elseif (array_key_exists($s, $terms[$p->ID]))
					$numNew = max(0,
							sizeof($terms[$p->ID][$s]) - sizeof($positions[$s]));
				else
					continue;

				for ($i = 0; $i < $numNew; $i++)
				{
					$positions[$s][] = sizeof($keys);
					$keys[] = $s;
				}
			}
		}

		header('Content-disposition: attachment; filename=posts.csv');
		header('Content-type: text/csv');

		$out = fopen('php://output', 'w');
		fputcsv($out, $keys);

		foreach ($posts as $p)
		{
			$line = array();
			for ($i = 0; $i < sizeof($keys); $i++)
				$line[] = "";

			foreach (array_merge($metaKeys, $taxKeys) as $s)
			{
				if (array_key_exists($s, $metas[$p->ID]))
					$values = $metas[$p->ID][$s];
				elseif (array_key_exists($s, $terms[$p->ID]))
				{
					$values = array();
					foreach ($terms[$p->ID][$s] as $v)
						$values[] = $v->slug;
				}
				else
					continue;

				for ($i = 0; $i < sizeof($values); $i++)
				{
					$line[$positions[$s][$i]] = $values[$i];
				}
			}

			fputcsv($out, $line);
		}

		die;
	}

	/**
	 * Register and add settings
	 */
	public function page_init()
	{
		if (array_key_exists('remocoes-export', $_POST))
		{
			$this->exportFieldsJson();
		}
		if (array_key_exists('remocoes-exportcsv', $_POST))
		{
			$this->exportPostsCsv();
		}

		register_setting(
			'pontosdecultura_option_group', // Option group
			'pontosdecultura_theme_options', // Option name
			array( $this, 'sanitize' ) // Sanitize
		);

		add_settings_section(
			'setting_estatos_cidades', // ID
			__('Importações personalizadas', 'pontosdecultura'), // Title
			array( $this, 'print_section_info' ), // Callback
			'pontos-import-file' // Page
		);

		add_settings_field(
			'criar_estatos_cidades', // ID
			'Criar Estatos e Cidades?', // Title
			array( $this, 'criar_estatos_cidades_callback' ), // Callback
			'pontos-import-file', // Page
			'setting_estatos_cidades' // Section
		);

		update_option('setting_estatos_cidades', 'N');

		if(array_key_exists('page', $_REQUEST) && $_REQUEST['page'] == 'pontos-import-file')
		{
			wp_register_script('pontos_options_scripts', get_template_directory_uri() . '/js/pontos_options_scripts.js', array('jquery'));

			wp_enqueue_script('pontos_options_scripts');

			wp_localize_script( 'pontos_options_scripts', 'pontos_options_scripts_object',
			array( 'ajax_url' => admin_url( 'admin-ajax.php' )) );
		}
		add_action( 'wp_ajax_ImportarCsv', array($this, 'ImportarCsv_callback') );
		add_action( 'wp_ajax_ImportPins', array($this, 'ImportPins') );
		add_action( 'wp_ajax_CheckEstadoCidade', array('EstadosCidades', 'check_location_terms') );

	}

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();
        if( array_key_exists('criar_estatos_cidades', $input ))
        {
			$new_input['criar_estatos_cidades'] = $input['criar_estatos_cidades'] == 'S'? 'S' : 'N';
        
			if($new_input['criar_estatos_cidades'] == 'S')
			{
				if(!is_array($this->options))
	        		$this->options = get_option( 'pontosdecultura_theme_options', array() );
				
	        	if( !array_key_exists('criar_estatos_cidades', $this->options) || $this->options['criar_estatos_cidades'] != 'S')
	        	{
	        		ini_set("memory_limit", "2048M");
	        		set_time_limit(0);
	        		global $EstadosCidades;
        			$EstadosCidades->create_location_terms();
	        	}
			}
        }
        
        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        _e('Importações especiais do Tema:', 'pontosdecultura');
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function criar_estatos_cidades_callback()
    {
    	$checked = isset( $this->options['criar_estatos_cidades'] ) && $this->options['criar_estatos_cidades'] == 'S' ? 'checked="checked"' : '';
    	?>
            <input type="checkbox" id="criar_estatos_cidades" name="pontosdecultura_theme_options[criar_estatos_cidades]" value="S" <?php echo $checked; ?> /><?php _e('Criar', 'pontosdecultura'); ?>
        <?php 
    }
    
    public function fetch_remote_file( $url, $post ) {
    
    	global $url_remap;
    
    	// extract the file name and extension from the url
    	$file_name = basename( $url );
    
    	// get placeholder file in the upload dir with a unique, sanitized filename
    	$upload = wp_upload_bits( $file_name, 0, '',
    			array_key_exists('upload_date', $post) ? $post['upload_date'] : null );
    	if ( $upload['error'] )
    		return new WP_Error( 'upload_dir_error', $upload['error'] );
    
    	// fetch the remote url and write it to the placeholder file
    	$headers = wp_get_http( $url, $upload['file'] );
    
    	// request failed
    	if ( ! $headers ) {
    		@unlink( $upload['file'] );
    		return new WP_Error( 'import_file_error', __('Remote server did not respond', 'wordpress-importer') );
    	}
    
    	// make sure the fetch was successful
    	if ( $headers['response'] != '200' ) {
    		@unlink( $upload['file'] );
    		return new WP_Error( 'import_file_error', sprintf( __('Remote server returned error response %1$d %2$s', 'wordpress-importer'), esc_html($headers['response']), get_status_header_desc($headers['response']) ) );
    	}
    
    	$filesize = filesize( $upload['file'] );
    
    	if ( isset( $headers['content-length'] ) && $filesize != $headers['content-length'] ) {
    		@unlink( $upload['file'] );
    		return new WP_Error( 'import_file_error', __('Remote file is incorrect size', 'wordpress-importer') );
    	}
    
    	if ( 0 == $filesize ) {
    		@unlink( $upload['file'] );
    		return new WP_Error( 'import_file_error', __('Zero size file downloaded', 'wordpress-importer') );
    	}
    
    
    	// keep track of the old and new urls so we can substitute them later
    	$url_remap[$url] = $upload['url'];
    
    
    	return $upload;
    }
    
    public function process_attachment( $post, $url )
    {
    	
	    // if the URL is absolute, but does not contain address, then upload it assuming base_site_url
	    //if ( preg_match( '|^/[\w\W]+$|', $url ) )
	    //	$url = rtrim( $this->base_url, '/' ) . $url;
	    
	    global $url_remap;
	    
	    $upload = $this->fetch_remote_file( $url, $post );
	    if ( is_wp_error( $upload ) )
	        return $upload;
	
	    if ( $info = wp_check_filetype( $upload['file'] ) )
	        $post['post_mime_type'] = $info['type'];
	    else
	        return new WP_Error( 'attachment_processing_error', __('Invalid file type', 'wordpress-importer') );
	
	    $post['guid'] = $upload['url'];
	
	    // as per wp-admin/includes/upload.php
	    $post_id = wp_insert_attachment( $post, $upload['file'] );
	    wp_update_attachment_metadata( $post_id, wp_generate_attachment_metadata( $post_id, $upload['file'] ) );
	
	    update_post_meta($post_id, '_pin_anchor', array('x' => 0, 'y' => 30 ));
	
	    return $post_id;
	}
    
    public function ImportPins()
    {
    	if ($handle = opendir(get_stylesheet_directory() . '/assets/images/pins'))
		{
    		while (false !== ($entry = readdir($handle)))
			{
    			if (substr($entry, -3) == "png")
				{
    				$newatt = array
					(
    					'post_title' => $entry,
    					'post_status' => 'publish',
    					'post_parent' => 0,
    					'post_type' => 'attachment'
    				);
						    	
    				$ret = $this->process_attachment( $newatt, get_template_directory_uri().'/assets/images/pins/'.$entry);
    				if(is_object($ret) && get_class($ret) == 'WP_Error')
    				{
    					
    					wp_die(print_r($ret, true)." URL:".get_template_directory_uri().'/assets/images/pins/'.$entry);
    				}
    	
    			}
    		}
    		closedir($handle);
    	}
    	die();//ajax callback
    }
    
    protected $logfilename = 'csv_import.log';
    
    public static function log($msn, $print_r = false)
    {
    	if($print_r)
    	{
    		print_r($msn);
    		file_put_contents(dirname(__FILE__)."/csv_import.log", print_r($msn, true), FILE_APPEND);
    	}
    	else
    	{
	    	echo $msn;
	    	$msn = str_replace("<br/>", "\n", $msn);
	    	$msn = str_replace("<br>", "\n", $msn);
	    	file_put_contents(dirname(__FILE__)."/csv_import.log", $msn, FILE_APPEND);
    	}
    }
    
    public static function newLog()
    {
    	file_put_contents(dirname(__FILE__)."/csv_import.log", date('Y-m-d').'\n');
    }
    
    public function ImportarCsv_callback()
    {
			if (!array_key_exists('file', $_FILES)
					|| !array_key_exists('tmp_name', $_FILES['file'])
					|| $_FILES['file']['error'])
			{
				_e('CSV inválido', 'pontosdecultura');
				die;
			}

			$in = fopen($_FILES['file']['tmp_name'], 'r');

			$keys = fgetcsv($in);
			if ($keys === false)
			{
				_e('CSV inválido', 'pontosdecultura');
				die;
			}

			global $Remocoes_global;
			$fields = $Remocoes_global->getFields();

			$taxNames = array('_mpv_location' => null, '_mpv_inmap' => null);
			foreach ($fields as $f)
			{
				$name = empty($f['taxonomy'])? null : $f['slug'];

				switch ($f['type'])
				{
					case 'dropdown-meses-anos':
						$taxNames[$f['slug'].'-meses'] = $name;
						$taxNames[$f['slug'].'-anos'] = $name;
						break;

					case 'event':
						$taxNames[$f['slug'].'-date'] = $name;
						$taxNames[$f['slug'].'-type'] = $name;
						$taxNames[$f['slug'].'-about'] = $name;
						break;

					default:
						$taxNames[$f['slug']] = $name;
						break;
				}
			}

			foreach ($keys as $k)
			{
				if (!array_key_exists($k, $taxNames))
				{
					printf(__('Chave %s desconhecida', 'pontosdecultura'), $k);
					die;
				}
			}

			$line = 1;
			$ok = 0;
			$bad = 0;
			while ($entry = fgetcsv($in))
			{
				$line++;

				if (sizeof($entry) != sizeof($keys))
				{
					printf(__('Erro linha %d: quantidade inválida de elementos<br>',
								'pontosdecultura'), $line);
					$bad++;
					continue;
				}

				$post = $Remocoes_global->get_default_post_to_edit('remocoes', true);

				for ($i = 0; $i < sizeof($entry); $i++)
				{
					$k = $keys[$i];
					$v = $entry[$i];

					if (empty($entry[$i]))
						continue;

					if ($k === 'post_title')
					{
						$post->post_title = $v;
						$post->post_name = sanitize_title($v);
					}
					elseif ($k === 'post_content')
					{
						$post->post_content = $v;
					}
					else if ($taxNames[$k] === null)
					{
						if ($k === '_mpv_location')
						{
							$v = unserialize($v);
							if ($v === false)
								printf(__('Aviso linha %d: Falha ao desserealizar coordenadas',
											'pontosdecultura'), $line);
						}
						add_post_meta($post->ID, $k, $v);
					}
					else
					{
						$t = get_terms($taxNames[$k],
								array('hide_empty' => 0, 'slug' => $v, 'number' => 1));
						if (sizeof($t))
							wp_set_post_terms($post->ID, array($t[0]->term_id),
									$taxNames[$k], true);
						else
							printf(
									__('Aviso linha %d: termo %s da taxonomia %s não encontrado',
										'pontosdecultura'), $line, $v, $taxNames[$k]);
					}
				}

				wp_update_post($post);
				wp_publish_post($post->ID);

				$ok++;
			}

			printf(__('%d posts adicionados<br>%d falharam', 'pontosdecultura'),
					$ok, $bad);
			die;
    }

}

if( is_admin() )
    $pontosdecultura_settings_page = new PontosSettingsPage();
