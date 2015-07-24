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

if ( ! function_exists( 'pontosdecultura_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function pontosdecultura_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on _s, use a find and replace
	 * to change '_s' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'pontosdecultura', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Secondary Menu', 'pontosdecultura' ),
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
		'caption',
	) );
}
endif; // pontosdecultura_setup
add_action( 'after_setup_theme', 'pontosdecultura_setup' );

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

/**
 * Add a custom logo for the login screen
 * 
 */
function pontosdecultura_custom_login_logo() {
	echo '
	<style type="text/css">
		.login h1 a {
			background: url("' . get_template_directory_uri() . '/images/marca.png") top center no-repeat;
			background-size: contain;
			margin: 0 auto;
			height: 89px;
			width: 303px;
			
		}
	</style>';
}
add_action( 'login_head', 'pontosdecultura_custom_login_logo', 11 );

class Pontosdecultura {
	
	/**
	* Registra actions do wordpress
	*
	*/
	public function __construct()
	{
		add_action('wp_enqueue_scripts', array($this, 'javascript'));
		add_filter('nav_menu_css_class', array($this, 'nav_menu_css_class'));
		
		add_action('wp_enqueue_scripts', array($this, 'map_scritps'));
		add_filter('mapasdevista_filters_show_tax_title', array($this, 'mapasdevista_filters_show_tax_title'));
		
		add_action( 'wp_ajax_home_search', array($this, 'home_search_callback') );
		add_action( 'wp_ajax_nopriv_home_search', array($this, 'home_search_callback') );
		
		add_action( 'wp_ajax_home_adv_search', array($this, 'home_adv_search_callback') );
		add_action( 'wp_ajax_nopriv_home_adv_search', array($this, 'home_adv_search_callback') );
		
		add_action( 'wp_ajax_map_results', array($this, 'map_results_callback') );
		add_action( 'wp_ajax_nopriv_map_results', array($this, 'map_results_callback') );
		
		add_action( 'wp_ajax_select_cidade', array($this, 'select_cidade_callback') );
		add_action( 'wp_ajax_nopriv_select_cidade', array($this, 'select_cidade_callback') );
		
		add_action( 'wp_ajax_pontos_load_post', array($this, 'pontos_load_post_callback') );
		add_action( 'wp_ajax_nopriv_pontos_load_post', array($this, 'pontos_load_post_callback') );
		
		add_filter('mapasdevista_mapinfo_localize_script', array($this, 'mapinfo_localize_script'));
		
		add_filter('mapasdevista_load_bubbles', array($this, 'mapasdevista_load_bubbles'));
		add_filter('mapasdevista_load_style', array($this, 'mapasdevista_load_style'));
		
		add_filter('mapasdevista_create_post_overlay', array($this, 'mapasdevista_create_post_overlay'));
		
		add_action( 'wp_ajax_filter_select_cidade', array($this, 'filter_select_cidade_callback') );
		add_action( 'wp_ajax_nopriv_filter_select_cidade', array($this, 'filter_select_cidade_callback') );
		
		add_filter('mapasdevista_map_div', array($this, 'mapasdevista_map_div'));
		
		add_filter('login_redirect', array($this, 'login_redirect'), 10, 3);
		
		
		add_action('login_form', array($this, 'loginForm'));
		
	}
	
	public static function mapasdevista_create_post_overlay($load)
	{
		global $wp_query;
	
		if(is_home())
		{
			return false;
		}
		return $load;
	}
	
	public static function mapasdevista_load_bubbles($load)
	{
		global $wp_query;
		
		if(is_home() && !$wp_query->get('mapa-tpl'))
		{
			return false;
		}
		return $load;
	}
	
	public static function mapinfo_localize_script($mapinfo)
	{
		global $wp_query;
		
		if(is_home() && !$wp_query->get('mapa-tpl'))
		{
			$mapinfo['loadPosts'] = false;
		}
		return $mapinfo;
	}
	
	public static function mapasdevista_load_style($load)
	{
		return false;
	}
	
	public static function mapasdevista_map_div($mapDiv)
	{
		global $wp_query;
		if(is_home() && $wp_query->get('mapa-tpl'))
		{
			return '
				<div id="post_overlay">
			        <a id="pontos_close_post_overlay" title="Fechar">'.
			        '<img src="'.mapasdevista_get_image("close.png").'" alt="Fechar" /></a>
			        <div id="post_overlay_content" class="post_overlay_content" >
					</div>
				</div>
				<div id="map" class="map-fullscreen">
				 
				</div>
			';
		}
		return $mapDiv;
	} 
	
	/**
	* Controla os arquivos javascript do site
	*
	*/
	public function javascript(){
		$path = get_template_directory_uri() . '/js';
		global $wp_query;
		
		wp_register_script('map-functions', $path . '/map-functions.js', array('jquery'));
		wp_register_script('homescripts', $path . '/home.js', array('jquery', 'jquery-ui-core', 'jquery-ui-progressbar', 'map-functions'));
		wp_register_script('jqloader', get_template_directory_uri() . '/inc/jqloader/jqloader.debug.js', array('jquery'));
		wp_register_style('jqloader', get_template_directory_uri() . '/inc/jqloader/jqloader.debug.css');
		wp_register_script('map-page-scripts', $path . '/map-page-scripts.js', array('jquery', 'map-functions'));
		
		if(is_home() && ( !$wp_query->get('mapa-tpl') && !$wp_query->get('nova-pratica') ))
		{
			wp_enqueue_script('homescripts');
			wp_enqueue_script('jqloader');
			wp_enqueue_style('jqloader');
			
			wp_localize_script( 'homescripts', 'homescripts_object',
			array( 'ajax_url' => admin_url( 'admin-ajax.php' )) );
		}
		elseif(is_home() && $wp_query->get('mapa-tpl'))
		{
			wp_enqueue_script('map-page-scripts');
				
			/*wp_localize_script( 'mapscripts', 'mapscripts',
			array( 'ajax_url' => admin_url( 'admin-ajax.php' )) );*/
		}
		
		if(is_home()) // has map
		{
			wp_enqueue_script('map-functions');
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
		
		$mapinfo = get_option('mapasdevista', true);
		$pt = implode(',', array_map(array('Pontosdecultura', 'quote'), $mapinfo['post_types']));
		
		$querystr = "
		SELECT $wpdb->posts.ID FROM $wpdb->posts
			LEFT JOIN $wpdb->postmeta ON($wpdb->posts.ID = $wpdb->postmeta.post_id)
			LEFT JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id)
			LEFT JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
			LEFT JOIN $wpdb->terms ON($wpdb->term_taxonomy.term_id = $wpdb->terms.term_id)
		WHERE
			$wpdb->posts.post_type in (".$pt.")
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
		
		if(count($posts) > 0)
		{
			$pontosdecultura_home_searches = get_option('pontosdecultura_home_searches', array());
			if(array_key_exists(sanitize_title($s), $pontosdecultura_home_searches))
			{
				$pontosdecultura_home_searches[sanitize_title($s)]->count++;
			}
			else
			{
				$term_obj = new stdClass();
				$term_obj->term_id = 0; //5745
				$term_obj->name = $s; //Conhecimento e Tradições Orais
				$term_obj->slug = sanitize_title($term_obj->name); //conhecimento-e-tradicoes-orais
				$term_obj->term_group = 0; //0
				$term_obj->term_taxonomy_id = 0; //5754
				$term_obj->taxonomy = "false"; //tematico
				$term_obj->description = ""; //
				$term_obj->parent = 0; //0
				$term_obj->count = 1;
				$term_obj->link = $term_obj->slug;
				$term_obj->id = $term_obj->term_id;
				$pontosdecultura_home_searches[sanitize_title($term_obj->name)] = $term_obj;
			}
			update_option('pontosdecultura_home_searches', $pontosdecultura_home_searches);
		}
		
		die(); // this is required to return a proper result
	}
	
	public function home_adv_search_callback()
	{
		/* @var $wpdb wpdb */
		global $wpdb; // this is how you get access to the database
		
		$fields = $_POST['data'];
		
		$mapinfo = get_option('mapasdevista', true);
		$pt = implode(',', array_map(array('Pontosdecultura', 'quote'), $mapinfo['post_types']));
		
		$i = 0;
		
		$where = '';
		
		foreach ($fields as $key => $value)
		{
			if($value != '')
			{
				if(strlen($where) > 0 ) $where .= " AND ";
				
				if($i == 0 ) // title
				{
					$where .= "$wpdb->posts.post_title like '%$value%'";
				}
				elseif($i < 8) // tax
				{
					$where .= "$wpdb->terms.slug = '$value'";
				}
				else // custom fields
				{
					switch($key)
					{
						case '_pratica-ano-inicio':
							$vals = explode(',', $value);
							if($vals[1] != '+')
							{
								$where .= "($wpdb->postmeta.meta_key = '$key' AND ( CAST($wpdb->postmeta.meta_value AS UNSIGNED) >= $vals[1] AND CAST($wpdb->postmeta.meta_value AS UNSIGNED) <= $vals[0] ) )";
							}
							else
							{
								$where .= "($wpdb->postmeta.meta_key = '$key' AND CAST($wpdb->postmeta.meta_value AS UNSIGNED) <= $vals[0] )";
							}
						break; 
						case '_pratica-numero-integrantes':
							$vals = explode(',', $value);
							if($vals[1] != '+')
							{
								$where .= "($wpdb->postmeta.meta_key = '$key' AND ( CAST($wpdb->postmeta.meta_value AS UNSIGNED) >= $vals[0] AND CAST($wpdb->postmeta.meta_value AS UNSIGNED) <= $vals[1] ) )";
							}
							else 
							{
								$where .= "($wpdb->postmeta.meta_key = '$key' AND CAST($wpdb->postmeta.meta_value AS UNSIGNED) >= $vals[0] )";
							}
						break;
						case 'pratica-videos':
						case 'pratica-facebook':
							if($value == 'S')
							{
								$where .= "($wpdb->postmeta.meta_key = '$key' AND $wpdb->postmeta.meta_value > '' )";
							}
							else 
							{
								$where .= "($wpdb->postmeta.meta_key = '$key' AND ( $wpdb->postmeta.meta_value IS NULL OR $wpdb->postmeta.meta_value == '' ) )";
							}
						break;
						default:
							$where .= "($wpdb->postmeta.meta_key = '$key' AND $wpdb->postmeta.meta_value = '$value' )";
						break;
					}
				}
			}
			$i++;
		}
		
		/**
		 * 	$wpdb->terms.name like '%$s%'
			OR $wpdb->posts.post_title like '%$s%'
			OR $wpdb->posts.post_content like '%$s%'
			OR $wpdb->posts.post_excerpt like '%$s%'
			OR $wpdb->postmeta.meta_value like '%$s%'
		 */
		
		$querystr = "
		SELECT $wpdb->posts.ID FROM $wpdb->posts
		LEFT JOIN $wpdb->postmeta ON($wpdb->posts.ID = $wpdb->postmeta.post_id)
		LEFT JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id)
		LEFT JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
		LEFT JOIN $wpdb->terms ON($wpdb->term_taxonomy.term_id = $wpdb->terms.term_id)
		WHERE
		$wpdb->posts.post_type in (".$pt.")
		AND (
			".$where."
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
		
		echo $querystr;
		echo json_encode($posts);
		
		die(); // this is required to return a proper result
	}
	
	public static function map_results_callback()
	{
		echo '<div id="search-result-list" class="search-result-list gr gr-small">';
			mapasdevista_view_results();
		echo '</div>';
		die();
	}
	
	public static function select_cidade_callback()
	{
	?>
		<select name="adv-search-cidade" class="adv-search-cidade">
			<option value="" selected="selected" ><?php echo esc_attr_x('Cidade', 'pontosdecultura' ); ?></option>
			<?php
			if(array_key_exists('uf', $_POST) && !empty($_POST['uf']))
			{
				$parent = get_term_by('slug', $_POST['uf'], 'territorio');
				if(is_object($parent))
				{
					$terms = get_terms('territorio', array('child_of' => $parent->term_id, 'orderby' => 'name', 'hide_empty' => false));
					foreach ($terms as $term)
					{
						?>
						<option value="<?php echo $term->slug; ?>" ><?php echo $term->name; ?></option>
						<?php
					}
				}
			}
			?>
		</select>
	<?php
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
	
	public static function pontos_load_post_callback()
	{
		$p = $_POST['post_id'];
		
		if (!is_numeric($p))
			die('error');
		
		query_posts('post_type=any&p='.$p);
		?>
				<div class="single single-mapa postid-2915 single-format-standard logged-in admin-bar group-blog singular customize-support"> 
					<div class="site-wrapper hfeed">
						<div id="content" class="site-content site-area">
							<div class="container">
								<div id="primary" class="content-area">
									<main id="main" class="site-main" role="main"><?php
										if (have_posts())
										{
											while (have_posts())
											{
												the_post();
												global $post;
												include dirname(__FILE__).'/content-mapa.php';
												
												if ( comments_open() || '0' != get_comments_number() ) :
													comments_template();
												endif;
											}
										}
										else
										{
											die('error');
										}
										?>
									</main><!-- #main -->
								</div><!-- #primary -->
							</div>
						</div>
					</div>
				</div>
			<?php
		
		die();	
	}
	
	public static function quote($str)
	{
		return sprintf("'%s'", $str);
	}
	
	/**
	 * After login, redirect the user to the page to administer campaigns.
	 *
	 * @param string $redirect_to
	 * @param string $request the url the user is coming from
	 * @param Wp_Error|Wp_User $user
	 */
	function login_redirect($redirect_to, $request, $user) {
		
		if(!empty($request))
		{
			$redirect_to = $request;
		}
		else 
		{
			$redirect_to = get_bloginfo('url') . '/';
		}
	
		return $redirect_to;
	}
	
	function loginForm()
	{
		wp_enqueue_style('pontosdecultura-login', get_template_directory_uri() . '/css/login.css' );
	}
	
}

$pontosdecultura = new Pontosdecultura();

/** Lib estadocidades **/
include_once dirname(__FILE__).'/inc/estadoscidades/EstadosCidades.php';
/** Opções do Tema **/
include_once dirname(__FILE__).'/inc/options.php';
/** Taxs do Pontos **/
include_once dirname(__FILE__).'/inc/taxs.php';
/** Post type Pratica **/
include_once dirname(__FILE__).'/inc/praticas/praticas.php';

?>
