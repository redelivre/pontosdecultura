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
		// This page will be under "Settings"
		add_options_page(
		__('Configurações do Tema', 'pontosdecultura'),
		__('Configurações do Tema', 'pontosdecultura'),
		'manage_options',
		'pontos-setting-admin',
		array( $this, 'create_admin_page' )
		);
	}

	/**
	 * Options page callback
	 */
	public function create_admin_page()
	{
		// Set class property
		$this->options = get_option( 'pontos_theme_options', array() );
		$this->ImportPins();
		?>
        <div class="wrap">
            <h2><?php _e('Configurações do Tema Recid', 'pontosdecultura') ?></h2>           
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'pontos_option_group' );   
                do_settings_sections( 'pontos-setting-admin' );
                submit_button("Importar Csv", 'secundary', 'importcsv' );
                submit_button(); 
            ?>
            </form>
            <div id="result">
            </div>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {        
        register_setting(
            'pontos_option_group', // Option group
            'pontos_theme_options', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_estatos_cidades', // ID
            __('Configurações personalizadas', 'pontosdecultura'), // Title
            array( $this, 'print_section_info' ), // Callback
            'pontos-setting-admin' // Page
        );  

        add_settings_field(
            'criar_estatos_cidades', // ID
            'Criar Estatos e Cidades?', // Title 
            array( $this, 'criar_estatos_cidades_callback' ), // Callback
            'pontos-setting-admin', // Page
            'setting_estatos_cidades' // Section           
        );
        add_settings_field(
        'pins_imported', // ID
        '', // Title
        array( $this, 'pins_imported_callback' ), // Callback
        'pontos-setting-admin', // Page
        'setting_estatos_cidades' // Section
        );
        
        update_option('setting_estatos_cidades', 'N');
        
		if(array_key_exists('page', $_REQUEST) && $_REQUEST['page'] == 'pontos-setting-admin')
		{
			$path = get_template_directory_uri() . '/js';
			wp_register_script('pontos_options_scripts', $path . '/pontos_options_scripts.js', array('jquery'));
			
			wp_enqueue_script('pontos_options_scripts');
					
			wp_localize_script( 'pontos_options_scripts', 'pontos_options_scripts_object',
			array( 'ajax_url' => admin_url( 'admin-ajax.php' )) );
		}
		add_action( 'wp_ajax_ImportarCsv', array($this, 'ImportarCsv_callback') );
		add_action( 'wp_ajax_nopriv_ImportarCsv', array($this, 'ImportarCsv_callback') );
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
        }
        
		if($new_input['criar_estatos_cidades'] == 'S')
		{
			if(!is_array($this->options))
        		$this->options = get_option( 'pontos_theme_options', array() );
			
        	if( !array_key_exists('criar_estatos_cidades', $this->options) || $this->options['criar_estatos_cidades'] != 'S')
        	{
        		ini_set("memory_limit", "2048M");
        		set_time_limit(0);
        		create_location_terms();
        	}
		}
		
		if( array_key_exists('pins_imported', $input ) && is_bool( (bool)$input['pins_imported']) )
		{
			$new_input['pins_imported'] = $input['pins_imported'];
		}

        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        _e('Configurações personalizadas do Tema: Recid', 'pontosdecultura');
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function criar_estatos_cidades_callback()
    {
    	$checked = isset( $this->options['criar_estatos_cidades'] ) && $this->options['criar_estatos_cidades'] == 'S' ? 'checked="checked"' : '';
    	?>
            <input type="checkbox" id="criar_estatos_cidades" name="pontos_theme_options[criar_estatos_cidades]" value="S" <?php echo $checked; ?> /><?php _e('Criar', 'pontosdecultura'); ?>
        <?php 
    }
    
    /**
     * Get the settings option array and print one of its values
     */
    public function pins_imported_callback()
    {
    	$checked = isset( $this->options['pins_imported'] ) && $this->options['pins_imported'] == 'S' ? 'checked="checked"' : '';
    	?>
        	<input type="hidden" id="pins_imported" name="pontos_theme_options[pins_imported]" value="<?php echo isset( $this->options['pins_imported'] ) && $this->options['pins_imported'] ? 'true' : 'false' ;?>" />
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
    	if(!array_key_exists('pins_imported', $this->options) || $this->options['pins_imported'] === false )
    	{
	    	if ($handle = opendir(WP_CONTENT_DIR . '/themes/recid/images/pins'))
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
							    	
	    				$ret = $this->process_attachment( $newatt, get_template_directory_uri().'/images/pins/'.$entry);
	    				if(is_object($ret) && get_class($ret) == 'WP_Error')
	    				{
	    					
	    					wp_die(print_r($ret, true)." URL:".get_template_directory_uri().'/images/pins/'.$entry);
	    				}
	    	
	    			}
	    		}
	    		closedir($handle);
	    		$this->options['pins_imported'] = true;
	    		update_option('pontos_theme_options', $this->options);
	    	}
    	}
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
    	PontosSettingsPage::newLog();
    	
    	echo '<div id="result">';
    	
    	if(function_exists('mapasdevista_get_coords') )
    	{
    		include_once dirname(__FILE__).'/Tratar.php';
    		
    		$debug = true;
    		$getLocation = false;
    		$begin = 0;
    		$ids = array();
    		
    		$pins_args = array (
	    		'post_type' => 'attachment',
				'meta_key' => '_pin_anchor',
        		'posts_per_page' => '-1'
	    	);
			$pinsTodos = get_posts($pins_args);
			
			$pins = array();
			
			foreach ($pinsTodos as $pin)
			{
				PontosSettingsPage::log($pin->post_name);
				switch ($pin->post_name)
				{
					case 'ambiental-png':
						$pins['ambiental'] = $pin->ID;
					break;
					case 'civil-png':
						$pins['civil'] = $pin->ID;
					break;
					case 'cultura-png':
						$pins['cultural'] = $pin->ID;
					break;
					case 'economico-png':
						$pins['economico'] = $pin->ID;
					break;
					case 'politico-png':
						$pins['politico'] = $pin->ID;
					break;
					case 'social-png':
							$pins['social'] = $pin->ID;
					break;						
				}
			}
			PontosSettingsPage::log(print_r($pins,true));
			
	    	ini_set("memory_limit", "2048M");
	    	set_time_limit(0);
	    
	    	$names = array();
	    	
	    	$file = fopen ( '/tmp/import.csv', 'r');
	    	
	    	$coords = array();
	    	
	    	if(file_exists('/tmp/coords.csv')) // load coords from other file
	    	{
	    		$coords_file = fopen ( '/tmp/coords.csv', 'r');
	    		$coords_row = fgetcsv( $coords_file, 0, ';');
	    		
	    		while ($coords_row !== false) // locate next valid id
	    		{
	    			$coords[$coords_row[0]] = array('lat' => $coords_row[1], 'lon' => $coords_row[2]);
	    			$coords_row = fgetcsv( $coords_file, 0, ';');
	    		}
	    		
	    	}
	    	//cabeçalho da planilha
	    	for ($i = 0; $i < 1; $i++) // first 4 lines has header
	    	{
	    		$row = fgetcsv( $file, 0, ';');
	    		$names[$i] = $row;
	    	}
	    	
	    	for ($i = 0; $i < $begin; $i++) // move pointer to begin of data
	    	{
	    		$row = fgetcsv( $file, 0, ';');
	    	}
	    	
	    	PontosSettingsPage::log('<pre>');
	    
	    	$row = fgetcsv( $file, 0, ';');
	    	$i = 0;
	    	do
	    	{
	    		if(count($ids) > 0) // have ids limit
	    		{
	    			while ($row !== false && !in_array($row[3], $ids)) // locate next valid id 
	    			{
	    				$row = fgetcsv( $file, 0, ';');
	    			}
	    			if($row === false) break;
	    		}
	    		// definir titulo e descrição
	    		$post = array(
	    				'post_author'    => 1, //The user ID number of the author.
	    				'post_content'   => $row[11],
	    				'post_title'     => $row[6], //The title of your post.
	    				'post_type'      => 'mapa',
	    				'post_status'	 => 'publish'
	    		);
	    
				$post_id = 0;
	    		if(!$debug) $post_id = wp_insert_post($post);
	    		//colunas que eu não quero importar como texto livre (custom fields)
	    		$no_import = array(7, 8, 10);

	    		$location = false;
	    		
	    		if(count($coords) > 0)
	    		{
	    			$location = $coords[$row[1]];
	    		}
	    		
	    		if($getLocation && $location === false)
	    		{ //setar coluna do municipio
		    		$location = mapasdevista_get_coords($row[4].'-'.$row[0]); // Município e estado
	    		}
	    		
	    		if($debug)
	    		{
	    			PontosSettingsPage::log($post, true);
	    			
	    			if($location !== false) PontosSettingsPage::log("{$row[1]};{$location['lat']};{$location['lon']}");
	    			else PontosSettingsPage::log("$row[1] -> ponto não encontrado");
	    			
	    			PontosSettingsPage::log('<br/>');
	    		}
	    		else
	    		{
	    			if($location !== false)
	    			{ //setar coluna id 
	    				PontosSettingsPage::log("{$row[6]};{$location['lat']};{$location['lon']}"); // exportar lat e lon
	    				PontosSettingsPage::log('<br/>');
	    				update_post_meta($post_id, '_mpv_location', $location);
	    			}
	    			else 
	    			{
	    				PontosSettingsPage::log("$row[1] -> ponto não encontrado");
	    				PontosSettingsPage::log('<br/>');
	    			}
	    		}
	    		
    			if(!$debug && is_int($post_id) )
    			{
    				update_post_meta($post_id, '_mpv_pin', $pins[Tratar::FormatText($row[8])]);
    					
    				delete_post_meta($post_id, '_mpv_inmap');
    				delete_post_meta($post_id, '_mpv_in_img_map');
    				add_post_meta($post_id, "_mpv_inmap", 1);
    			}
    			else
    			{
    				PontosSettingsPage::log("Pin: {$pins[Tratar::FormatText($row[8])]}");
    				PontosSettingsPage::log('<br/>');
    			}
    			
    			foreach ($row as $key => $custom_field)
    			{
    				if(in_array($key, array(7,8,10))) // stop on column with tax
    				{
    					continue;
    				}
    				if($key > 20)
    				{
    					break;
    				}
    				
    				if(!in_array($key, $no_import))
    				{
 					
    					if($debug)
    					{
    						PontosSettingsPage::log("update_post_meta($post_id, {$names[0][$key]}, $custom_field);<br/>");
    					}
    					else 
    					{
    						update_post_meta($post_id, $names[0][$key], $custom_field);
    					}
    				}
    			}
    			
    			
    			/**
				 * Taxonomies
    			 */
    			Tratar::insert($post_id, 'acao', $row[7]);
    			Tratar::insert($post_id, 'eixo', $row[8]);
    			Tratar::insert($post_id, 'sujeito', $row[10]);
    			Tratar::territorio($post_id, 'territorio', $row[4], $row[0]);
    			
	    		$row = fgetcsv( $file, 0, ';');
	    		$i++;
	    	} while ($row !== false);// && $i < 10);
	    	PontosSettingsPage::log('</pre>');
	    	fclose ( $file );
    	}
    	echo '</div>';
    	die();
    }

}

if( is_admin() )
    $pontos_settings_page = new PontosSettingsPage();
