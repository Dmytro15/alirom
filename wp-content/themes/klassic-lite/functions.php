<?php    
/**
 * Klassic Lite functions and definitions
 *
 * @package Klassic Lite
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */

if ( ! function_exists( 'klassic_lite_setup' ) ) : 
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function klassic_lite_setup() {
	if ( ! isset( $content_width ) )
		$content_width = 640; /* pixels */

	load_theme_textdomain( 'klassic-lite', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support('woocommerce');
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-header', array( 
		'default-text-color' => false,
		'header-text' => false,
	) );
	add_theme_support( 'custom-logo', array(
		'height'      => 150,
		'width'       => 150,
		'flex-height' => true,
	) );
	add_theme_support( 'title-tag' );
	add_image_size('klassic-lite-homepage-thumb',570,380,true);
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'klassic-lite' ),		
	) );
	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff'
	) );
	add_editor_style( 'editor-style.css' );
} 
endif; // klassic_lite_setup
add_action( 'after_setup_theme', 'klassic_lite_setup' );


function klassic_lite_widgets_init() { 	
	
	register_sidebar( array( 
		'name'          => __( 'Blog Sidebar', 'klassic-lite' ),
		'description'   => __( 'Appears on blog page sidebar', 'klassic-lite' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Header Info', 'klassic-lite' ),
		'description'   => __( 'Appears on header of site', 'klassic-lite' ),
		'id'            => 'header-1',
		'before_widget' => '<div class="headerinfo">',	
		'after_widget'  => '</div>',	
		'before_title'  => '<h3 style="display:none">',
		'after_title'   => '</h3>',		
	) );	
	
	register_sidebar( array(
		'name'          => __( 'Footer Widget 1', 'klassic-lite' ),
		'description'   => __( 'Appears on footer', 'klassic-lite' ),
		'id'            => 'footer-1',
		'before_widget' => '<aside id="%1$s" class="cols-3 widget-column-1 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5>',
		'after_title'   => '</h5>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer Widget 2', 'klassic-lite' ),
		'description'   => __( 'Appears on footer', 'klassic-lite' ),
		'id'            => 'footer-2',
		'before_widget' => '<aside id="%1$s" class="cols-3 widget-column-2 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5>',
		'after_title'   => '</h5>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer Widget 3', 'klassic-lite' ),
		'description'   => __( 'Appears on footer', 'klassic-lite' ),
		'id'            => 'footer-3',
		'before_widget' => '<aside id="%1$s" class="cols-3 widget-column-3 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5>',
		'after_title'   => '</h5>',
	) );
	
}
add_action( 'widgets_init', 'klassic_lite_widgets_init' );


function klassic_lite_font_url(){
		$font_url = '';		
		
		/* Translators: If there are any character that are not
		* supported by Montserrat, trsnalate this to off, do not
		* translate into your own language.
		*/
		$montserrat = _x('on','montserrat:on or off','klassic-lite');	
		
		if('off' !== $montserrat ){
			$font_family = array();
			
			if('off' !== $montserrat){
				$font_family[] = 'Montserrat:300,400,600,700,800,900';
			}
					
						
			$query_args = array(
				'family'	=> urlencode(implode('|',$font_family)),
			);
			
			$font_url = add_query_arg($query_args,'//fonts.googleapis.com/css');
		}
		
	return $font_url;
	}


function klassic_lite_scripts() {
	wp_enqueue_style('klassic-lite-font', klassic_lite_font_url(), array());
	wp_enqueue_style( 'klassic-lite-basic-style', get_stylesheet_uri() );
	wp_enqueue_style( 'nivo-slider', get_template_directory_uri()."/css/nivo-slider.css" );
	wp_enqueue_style( 'klassic-lite-responsive', get_template_directory_uri()."/css/responsive.css" );		
	wp_enqueue_style( 'klassic-lite-basic', get_template_directory_uri()."/css/basic.css" );
	wp_enqueue_script( 'jquery-nivo-slider', get_template_directory_uri() . '/js/jquery.nivo.slider.js', array('jquery') );
	wp_enqueue_script( 'klassic-lite-custom', get_template_directory_uri() . '/js/custom.js' );	
	wp_enqueue_style( 'font-awesome', get_template_directory_uri()."/css/font-awesome.css" );
		

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'klassic_lite_scripts' );

function klassic_lite_ie_stylesheet(){

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style('klassic-lite-ie', get_template_directory_uri().'/css/ie.css', array( 'klassic-lite-style' ), '20160928' );
	wp_style_add_data('klassic_lite-ie','conditional','lt IE 10');
	
	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'klassic-lite-ie8', get_template_directory_uri() . '/css/ie8.css', array( 'klassic-lite-style' ), '20160928' );
	wp_style_add_data( 'klassic-lite-ie8', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'klassic-lite-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'klassic-lite-style' ), '20160928' );
	wp_style_add_data( 'klassic-lite-ie7', 'conditional', 'lt IE 8' );	
	
	}
add_action('wp_enqueue_scripts','klassic_lite_ie_stylesheet');


define('klassic_lite_pro_theme_url','http://mirrorthemes.com/themes/klassic-business-wordpress-theme/','klassic-lite');
define('klassic_lite_theme_doc','http://www.mirrorthemes.com/documentation/klassic/','klassic-lite');
define('klassic_lite_live_demo','http://www.mirrorthemes.com/demo/klassic/','klassic-lite');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

// get slug by id
function klassic_lite_get_slug_by_id($id) {
	$post_data = get_post($id, ARRAY_A);
	$slug = $post_data['post_name'];
	return $slug; 
}

//custom logo function
 if ( ! function_exists( 'klassic_lite_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 * @since  klassic lite 1.2.0
 */
function klassic_lite_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;