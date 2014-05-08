<?php
/**
 * Pontos de Cultura functions and definitions
 *
 * @package Pontos de Cultura
 * @since  Pontos de Cultura 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function pontosdecultura_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'pontosdecultura' ),
		'id'            => 'sidebar-main',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Widget Area', 'pontosdecultura' ),
		'id'            => 'sidebar-footer',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'pontosdecultura_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function pontosdecultura_scripts() {

	// Normalize.css
    wp_register_style( 'pontosdecultura-normalize', get_template_directory_uri() . '/css/normalize.css', array(), '3.0.1' );
    wp_enqueue_style( 'pontosdecultura-normalize' );

	// General style
	wp_enqueue_style( 'pontosdecultura-style', get_stylesheet_uri() );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'pontosdecultura_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

class Pontosdecultura {
	
	/**
	* Registra actions do wordpress
	*
	*/
	public function __construct(){
		
		add_action('wp_enqueue_scripts', array($this, 'javascript'));
		add_filter('nav_menu_css_class', array($this, 'nav_menu_css_class'));
		
		add_action('wp_enqueue_scripts', array($this, 'map_scritps'));
		add_filter('mapasdevista_filters_show_tax_title', array($this, 'mapasdevista_filters_show_tax_title'));
		
		add_action( 'wp_ajax_home_search', array($this, 'home_search_callback') );
		add_action( 'wp_ajax_nopriv_home_search', array($this, 'home_search_callback') );
	}
	
	/**
	* Controla os arquivos javascript do site
	*
	*/
	public function javascript(){
		$path = get_template_directory_uri() . '/js';
		wp_register_script('homescripts', $path . '/home.js', array('jquery'));
		
		wp_enqueue_script('jquery');
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
		/* @var $wpdb wpdb */
		global $wpdb; // this is how you get access to the database
	
		$s = sanitize_text_field( $_POST['s'] );
		
		$post_type = 'mapa';
		
		$querystr = "
		SELECT $wpdb->posts.ID FROM $wpdb->posts
			LEFT JOIN $wpdb->postmeta ON($wpdb->posts.ID = $wpdb->postmeta.post_id)
			LEFT JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id)
			LEFT JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
			LEFT JOIN $wpdb->terms ON($wpdb->term_taxonomy.term_id = $wpdb->terms.term_id)
		WHERE
			$wpdb->posts.post_type = 'mapa'
			AND (
				$wpdb->terms.name like '%$s%'
				OR $wpdb->posts.post_title like '%$s%'
				OR $wpdb->posts.post_content like '%$s%'
				OR $wpdb->posts.post_excerpt like '%$s%'
				OR $wpdb->postmeta.meta_value like '%$s%'
			)
		GROUP BY $wpdb->posts.ID
		ORDER BY $wpdb->posts.ID asc
		";
		
		$posts = $wpdb->get_results($querystr, ARRAY_N);
		/*echo '<div id="results" class="clearfix">';
		echo '<pre>';
			//echo $querystr;
			print_r($posts);
		echo '</pre>';
		echo '</div>';*/
		
		echo json_encode($posts);
		
		
		die(); // this is required to return a proper result
	}
	
}

$pontosdecultura = new Pontosdecultura();

/** Lib estadocidades **/
include_once dirname(__FILE__).'/lib/estadoscidades/taxs.php';
/** Opções do Tema **/
include_once dirname(__FILE__).'/inc/options.php';
/** Taxs do Pontos **/
include_once dirname(__FILE__).'/inc/taxs.php';

?>