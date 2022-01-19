<?php 
/**
 * Banquet Hall functions and definitions
 *
 * @package Banquet Hall
 */
 global $content_width;
 if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */ 
/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! function_exists( 'banquet_hall_setup' ) ) : 
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function banquet_hall_setup() {
	load_theme_textdomain( 'banquet-hall', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support('woocommerce');
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_post_type_support( 'page', 'excerpt' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
	add_theme_support( 'custom-logo', array(
		'height'      => 51,
		'width'       => 223,
		'flex-height' => true,
	) );	
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'banquet-hall' )			
	) );
	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff'
	) );
	add_editor_style( 'editor-style.css' );
} 
endif; // banquet_hall_setup
add_action( 'after_setup_theme', 'banquet_hall_setup' );
function banquet_hall_widgets_init() { 	
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'banquet-hall' ),
		'description'   => esc_html__( 'Appears on sidebar', 'banquet-hall' ),
		'id'            => 'sidebar-1',
		'before_widget' => '',		
		'before_title'  => '<h3 class="widget-title titleborder"><span>',
		'after_title'   => '</span></h3><aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
	) ); 	
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 1', 'banquet-hall' ),
		'description'   => esc_html__( 'Appears on page footer', 'banquet-hall' ),
		'id'            => 'fc-1',
		'before_widget' => '',		
		'before_title'  => '<h5>',
		'after_title'   => '</h5><aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 2', 'banquet-hall' ),
		'description'   => esc_html__( 'Appears on page footer', 'banquet-hall' ),
		'id'            => 'fc-2',
		'before_widget' => '',		
		'before_title'  => '<h5>',
		'after_title'   => '</h5><aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 3', 'banquet-hall' ),
		'description'   => esc_html__( 'Appears on page footer', 'banquet-hall' ),
		'id'            => 'fc-3',
		'before_widget' => '',		
		'before_title'  => '<h5>',
		'after_title'   => '</h5><aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
	) );		
		
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 4', 'banquet-hall' ),
		'description'   => esc_html__( 'Appears on page footer', 'banquet-hall' ),
		'id'            => 'fc-4',
		'before_widget' => '',		
		'before_title'  => '<h5>',
		'after_title'   => '</h5><aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
	) );	
	
}
add_action( 'widgets_init', 'banquet_hall_widgets_init' );
function banquet_hall_font_url(){
		$font_url = '';		
		/* Translators: If there are any character that are not
		* supported by Roboto Condensed, trsnalate this to off, do not
		* translate into your own language.
		*/
		$robotocondensed = _x('on','Roboto Condensed:on or off','banquet-hall');		
		/* Translators: If there has any character that are not supported 
		*  by Scada, translate this to off, do not translate
		*  into your own language.
		*/	
		$roboto = _x('on','Roboto:on or off','banquet-hall');
		$assistant = _x('on','Assistant:on or off','banquet-hall');
		$anton = _x('on','Anton:on or off','banquet-hall');
		$playfairdisplay = _x('on','Playfair Display:on or off','banquet-hall');
		$oswald = _x('on','Oswald:on or off','banquet-hall');
		$sixcaps = _x('on','Six Caps:on or off','banquet-hall');
		$merriweather = _x('on','Merriweather:on or off','banquet-hall');
		
		if('off' !== $robotocondensed ){
			$font_family = array();
			if('off' !== $robotocondensed){
				$font_family[] = 'Roboto Condensed:300,400,600,700,800,900';
			}
			if('off' !== $roboto){
				$font_family[] = 'Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i';
			}	
			if('off' !== $assistant){
				$font_family[] = 'Assistant:200,300,400,600,700,800';
			}	
 			if('off' !== $anton){
				$font_family[] = 'Anton:400';
			}	
			if('off' !== $playfairdisplay){
				$font_family[] = 'Playfair Display:400,400i,700,700i,900,900i';
			}	
			if('off' !== $oswald){
				$font_family[] = 'Oswald:200,300,400,500,600,700';
			}
			if('off' !== $sixcaps){
				$font_family[] = 'Six Caps:400';
			}	
			if('off' !== $merriweather){
				$font_family[] = 'Merriweather:300,300i,400,400i,700,700i,900,900i';
			}					
									
			$query_args = array(
				'family'	=> urlencode(implode('|',$font_family)),
			);
			$font_url = add_query_arg($query_args,'//fonts.googleapis.com/css');
		}
	return $font_url;
	}
function banquet_hall_scripts() {
	if ( !is_rtl() ) {
		wp_enqueue_style( 'banquet-hall-basic-style', get_stylesheet_uri() );
		wp_enqueue_style( 'banquet-hall-main-style', get_template_directory_uri()."/css/responsive.css" );		
	}
	if ( is_rtl() ) {
		wp_enqueue_style( 'banquet-hall-rtl', get_template_directory_uri() . "/rtl.css");
	}	
	wp_enqueue_style('banquet-hall-font', banquet_hall_font_url(), array());
	wp_enqueue_style( 'banquet-hall-editor-style', get_template_directory_uri()."/editor-style.css" );
	wp_enqueue_style( 'banquet-hall-animation-style', get_template_directory_uri()."/css/animation.css" );
	wp_enqueue_style( 'nivo-slider', get_template_directory_uri()."/css/nivo-slider.css" );
	wp_enqueue_style( 'banquet-hall-base-style', get_template_directory_uri()."/css/style_base.css" );
	wp_enqueue_script( 'jquery-nivo', get_template_directory_uri() . '/js/jquery.nivo.slider.js', array('jquery') );
	wp_enqueue_script( 'banquet-hall-custom-js', get_template_directory_uri() . '/js/custom.js' );	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'banquet_hall_scripts' );

define('BANQUET_HALL_SKTTHEMES_URL','https://www.sktthemes.org');
define('BANQUET_HALL_SKTTHEMES_PRO_THEME_URL','https://www.sktthemes.org/shop/banquet-hall-wordpress-theme');
define('BANQUET_HALL_SKTTHEMES_FREE_THEME_URL','https://www.sktthemes.org/shop/free-event-planner-wordpress-theme');
define('BANQUET_HALL_SKTTHEMES_THEME_DOC','http://sktthemesdemo.net/documentation/celebration-hall-free-documentation');
define('BANQUET_HALL_SKTTHEMES_LIVE_DEMO','https://sktperfectdemo.com/demos/celebration-hall');
define('BANQUET_HALL_SKTTHEMES_THEMES','https://www.sktthemes.org/themes');

/**
 * Custom template for about theme.
 */
require get_template_directory() . '/inc/about-themes.php';
/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';
/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';
/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
// get slug by id
function banquet_hall_get_slug_by_id($id) {
	$post_data = get_post($id, ARRAY_A);
	$slug = $post_data['post_name'];
	return $slug; 
}
if ( ! function_exists( 'banquet_hall_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 */
function banquet_hall_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;
require_once get_template_directory() . '/customize-pro/example-1/class-customize.php';
/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function banquet_hall_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", esc_html(get_bloginfo( 'pingback_url' ) ));
	}
}
add_action( 'wp_head', 'banquet_hall_pingback_header' );
add_filter( 'body_class','banquet_hall_body_class' );
function banquet_hall_body_class( $classes ) {
 	$hideslide = get_theme_mod('hide_slides', 1);
	if (!is_home() && is_front_page()) {
		if( $hideslide == '') {
			$classes[] = 'enableslide';
		}
	}
	
	if ( banquet_hall_is_woocommerce_activated() ) {
		$classes[] = 'woocommerce';
	}
	
    return $classes;
}
/**
 * Filter the except length to 21 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function banquet_hall_custom_excerpt_length( $excerpt_length ) {
    return 25;
}
add_filter( 'excerpt_length', 'banquet_hall_custom_excerpt_length', 999 );
/**
 *
 * Style For About Theme Page
 *
 */
function banquet_hall_admin_about_page_css_enqueue($hook) {
   if ( 'appearance_page_banquet_hall_guide' != $hook ) {
        return;
    }
    wp_enqueue_style( 'banquet-hall-about-page-style', get_template_directory_uri() . '/css/banquet-hall-about-page-style.css' );
}
add_action( 'admin_enqueue_scripts', 'banquet_hall_admin_about_page_css_enqueue' );

/**
 * Check if WooCommerce is activated
 */
if ( ! function_exists( 'banquet_hall_is_woocommerce_activated' ) ) {
	function banquet_hall_is_woocommerce_activated() {
		if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
	}
}

/**
 * Show notice on theme activation
 */
if ( is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) {
	add_action( 'admin_notices', 'banquet_hall_activation_notice' );
}
function banquet_hall_activation_notice(){
    ?>
    <div class="notice notice-success is-dismissible"> 
        <p class="largefont"><?php echo esc_html('Thanks for using "Banquet Hall" Theme. Kindly click here for '); ?><a href="<?php echo esc_url(BANQUET_HALL_SKTTHEMES_THEME_DOC);?>"><?php echo esc_html('Documentation');?></a><?php echo esc_html(' which contains 1-click demo import.');?></p>
    </div>
    <?php
}

function banquet_hall_wp_admin_style($hook) {
	 	if ( 'themes.php' != $hook ) {
			return;
		}
		wp_enqueue_style( 'banquet-hall-admin-style', get_template_directory_uri() . '/css/banquet-hall-admin-style.css' );
}
add_action( 'admin_enqueue_scripts', 'banquet_hall_wp_admin_style' );

// WordPress wp_body_open backward compatibility
if ( ! function_exists( 'wp_body_open' ) ) {
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
}

/**
 * Include the Plugin_Activation class.
 */

require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'banquet_hall_register_required_plugins' );
 
function banquet_hall_register_required_plugins() {
	$plugins = array(
		array(
			'name'      => 'SKT Templates',
			'slug'      => 'skt-templates',
			'required'  => false,
		) 				
	);

	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'skt-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}