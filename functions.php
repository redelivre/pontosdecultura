<?php

class Pontosdecultura {
	
	/**
	* Registra actions do wordpress
	*
	*/
	public function __construct(){
		
		add_action('wp_enqueue_scripts', array($this, 'css'));		
		add_action('wp_enqueue_scripts', array($this, 'javascript'));
		add_filter('nav_menu_css_class', array($this, 'nav_menu_css_class'));
		add_action('widgets_init', array($this, 'register_sidebars'));
		
		add_action('wp_enqueue_scripts', array($this, 'map_scritps'));
		add_filter('mapasdevista_filters_show_tax_title', array($this, 'mapasdevista_filters_show_tax_title'));
		
		add_action( 'wp_ajax_home_search', array($this, 'home_search_callback') );
		add_action( 'wp_ajax_nopriv_home_search', array($this, 'home_search_callback') );
	}
	
	/**
	* Função responsável por controlar as folhas de estilo do site
	*
	*/
	public function css(){
		$path = get_template_directory_uri() . '/css';
		wp_register_style('bootstrap-responsive', $path . '/bootstrap-responsive.min.css');
		wp_register_style('bootstrap', $path . '/bootstrap.min.css');		
		wp_register_style('geral', get_stylesheet_directory_uri() . '/style.css', array('bootstrap'));
		
		wp_enqueue_style('bootstrap');
		wp_enqueue_style('bootstrap-responsive');
		wp_enqueue_style('geral');		
	}
	
	/**
	* Controla os arquivos javascript do site
	*
	*/
	public function javascript(){
		$path = get_template_directory_uri() . '/js';
		wp_register_script('bootstrap', $path . '/bootstrap.min.js');
		wp_register_script('pontosdecultura_language_selector', $path . '/language_selector.js');
		wp_register_script('homescripts', $path . '/home.js', array('jquery'));
		
		wp_enqueue_script('jquery');
		wp_enqueue_script('bootstrap');
		wp_enqueue_script('pontosdecultura_language_selector');
		if(is_home())
		{
			wp_enqueue_script('homescripts');
			
			wp_localize_script( 'homescripts', 'homescripts_object',
			array( 'ajax_url' => admin_url( 'admin-ajax.php' )) );
		}
	}
	
	public static function language_selector()
	{
		if(function_exists('icl_get_languages'))
		{
	    	$languages = icl_get_languages('skip_missing=0&orderby=code');
		    if(!empty($languages))
		    {
		    	echo '<div id="pontosdecultura_language_selector" onclick="pontosdecultura_language_selector_swapper();">';
		    	$l = array();
		        foreach($languages as $language)
		        {
		        	if(count($l) == 0)
		        	{
		        		$l = $language;
		        		$f = $l['url'];
		        		continue;
		        	}
		            /*if(!$l['active']) echo '<a href="'.$l['url'].'">';
		            echo '<img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" />';
		            if(!$l['active']) echo '</a>';*/
		        	echo '<a href="'.$language['url'].'"><span '.($l['active'] ? '' : 'style="display:none"').'>'.$l['translated_name'].'</span></a>';
		        	$l = $language;
	        	}
	        	if(count($l) > 0) echo '<a href="'.$f.'"><span '.($l['active'] ? '' : 'style="display:none"').'>'.$l['translated_name'].'</span></a>';
	        	echo '</div>';
	    	}
		}
	}
	
	public function nav_menu_css_class($classes)
	{
		$classes[] = 'span';
		return $classes;
	}
	
	public function register_sidebars()
	{
		/*$args = array(
				'name'          => 'Solution Sidebar',
				'id'            => "solution-sidebar",
				'description'   => '',
				'class'         => '',
				'before_widget' => '<li id="%1$s" class="widget %2$s">',
				'after_widget'  => "</li>\n",
				'before_title'  => '<h2 class="widgettitle">',
				'after_title'   => "</h2>\n",
		);
		
		register_sidebar( $args );*/
	}
	
	/**
	 * Display the map
	 *
	 * @since pontosdecultura 1.0
	 */
	public static function the_map() {
	
		if(function_exists('mapasdevista_view'))
		{
			mapasdevista_view();
		}
	
	}
	
	/**
	 * Display the map filters on home
	 *
	 * @since pontosdecultura 1.0
	 *
	 */
	public static function the_map_filters() {
	
		if(function_exists('mapasdevista_view'))
		{
			?>
			<div id="map-filters">
				<div id="filter-cycle-prev" class="filter-cycle-prev cycle-prev filter-cycle-button" ></div>
			<?php
				mapasdevista_view_filters('categoria-mapa');
			?>
				<div id="filter-cycle-next" class="filter-cycle-next cycle-next filter-cycle-button" ></div>
				<div id="filter-link-to-map" class="filter-link-to-map" ><a href="<?php echo get_bloginfo('url').'/mapa'; ?>">
					<img src="<?php echo get_template_directory_uri().'/images/expand.png'; ?>" alt="<?php _e('Veja o mapa completo', 'pontosdecultura'); ?>" title="<?php _e('Veja o mapa completo', 'pontosdecultura'); ?>" />
				</a></div>
			</div>
			<?php
		}
	}
	
	public static function map_scritps()
	{
		if(function_exists('mapasdevista_view') && !get_query_var('mapa-tpl') && get_theme_mod('pontosdecultura_display_home_map_filters') == 1)
		{
			wp_enqueue_script('jquery-cycle2', get_template_directory_uri() . '/js/jquery.cycle2.min.js', array('jquery'));
			wp_enqueue_script('jquery-cycle2-carousel', get_template_directory_uri() . '/js/jquery.cycle2.carousel.min.js', array('jquery-cycle2'));
			wp_enqueue_script('jquery-cycle2-swipe', get_template_directory_uri() . '/js/jquery.cycle2.swipe.min.js', array('jquery-cycle2'));
			wp_enqueue_script('map_filters_scroller', get_template_directory_uri() . '/js/map_filters_scroller.js', array('jquery-cycle2'));
		}
	}
	//add_action('wp_enqueue_scripts', 'pontosdecultura_map_scritps');
	
	public static function mapasdevista_filters_show_tax_title($show)
	{
		return false;
	}
	//add_filter('mapasdevista_filters_show_tax_title', 'pontosdecultura_mapasdevista_filters_show_tax_title');
	
	function home_search_callback()
	{
		global $wpdb; // this is how you get access to the database
	
		$s = sanitize_text_field( $_POST['s'] );
		
		$post_type = 'mapa';
		
		$args = array(
			'post_type' => $post_type,
			's' => $s,
		);
		
		$the_query = new WP_Query($args);
		echo '<div id="results" class="clearfix">';
		if ( $the_query->have_posts() )
		{
			echo '<ul>';
			while ( $the_query->have_posts() )
			{
				$the_query->the_post();
				echo '<li>' . get_the_title() . '</li>';
			}
			echo '</ul>';
		}
		else
		{
				echo 'no posts found';
		}
		echo '</div>';
		die(); // this is required to return a proper result
	}
	
}

$pontosdecultura = new Pontosdecultura();

include_once dirname(__FILE__).'/lib/estadoscidades/taxs.php';
include_once dirname(__FILE__).'/options.php';


?>