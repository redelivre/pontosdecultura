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
		?>
        <div class="wrap">
            <h2><?php _e('Configurações do Tema Pontos de Cultura', 'pontosdecultura') ?></h2>           
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'pontos_option_group' );   
                do_settings_sections( 'pontos-setting-admin' );
                submit_button(); 
            ?>
            </form>
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

        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        _e('Configurações personalizadas do Tema: Pontos de cultura', 'pontosdecultura');
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

}

if( is_admin() )
    $pontos_settings_page = new PontosSettingsPage();
