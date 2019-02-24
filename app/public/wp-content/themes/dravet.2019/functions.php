<?php
// Support area YYYY/MM/DD
$release_date = "2018/11/31";
$days_to_add = 31;

#------------------------------------------------------------------------------------
# Clean Up and General functions
#------------------------------------------------------------------------------------

// Remove Menu Container Div
function gutenberg_wp_nav_menu_args( $args = '' ) {
	$args['container'] = false;
	return $args;
}
add_filter( 'wp_nav_menu_args', 'gutenberg_wp_nav_menu_args' );

// add home to Menu
function home_page_menu_item( $args ) {  
    $args['show_home'] = true;  
    return $args;  
}  
add_filter( 'wp_page_menu_args', 'home_page_menu_item' ); 

/**
 * Fritz Blanke functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package dravet
 */

if ( ! function_exists( 'gutenberg_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function gutenberg_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Fritz Blanke, use a find and replace
		 * to change 'dravet' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'dravet', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( 
			array(
				'primary' => esc_html__( 'Hauptnavigation', 'dravet' ),
				'footer-1' => esc_html__( 'Fusszeile 1', 'dravet' ),
				'footer-2' => esc_html__( 'Fusszeile 2', 'dravet' ),
				'footer-3' => esc_html__( 'Fusszeile 3', 'dravet' ),
				'footer-4' => esc_html__( 'Fusszeile 4', 'dravet' ),
				'footer-5' => esc_html__( 'Fusszeile 5', 'dravet' ),
			) 
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'gutenberg_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		// Adding support for core block visual styles.
		add_theme_support( 'wp-block-styles' );
		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );
		// Add support for custom color scheme.
		add_theme_support( 'editor-color-palette', array(
			array(
				'name'  => __( 'Strong Blue', 'dravet' ),
				'slug'  => 'strong-blue',
				'color' => '#0073aa',
			),
			array(
				'name'  => __( 'Lighter Blue', 'dravet' ),
				'slug'  => 'lighter-blue',
				'color' => '#229fd8',
			),
			array(
				'name'  => __( 'Very Light Gray', 'dravet' ),
				'slug'  => 'very-light-gray',
				'color' => '#eee',
			),
			array(
				'name'  => __( 'Very Dark Gray', 'dravet' ),
				'slug'  => 'very-dark-gray',
				'color' => '#444',
			),
		) );
		// Adds support for editor font sizes.
		add_theme_support( 'editor-font-sizes', array(
			array(
				'name'      => __( 'small', 'dravet' ),
				'shortName' => __( 'S', 'dravet' ),
				'size'      => 12,
				'slug'      => 'small'
			),
			array(
				'name'      => __( 'regular', 'dravet' ),
				'shortName' => __( 'M', 'dravet' ),
				'size'      => 16,
				'slug'      => 'regular'
			),
			array(
				'name'      => __( 'large', 'dravet' ),
				'shortName' => __( 'L', 'dravet' ),
				'size'      => 20,
				'slug'      => 'large'
			),
			array(
				'name'      => __( 'larger', 'dravet' ),
				'shortName' => __( 'XL', 'dravet' ),
				'size'      => 24,
				'slug'      => 'larger'
			)
		) );
		// Add support for responsive embeds.
		add_theme_support( 'responsive-embeds' );

		remove_action('wp_head', 'rsd_link');
		remove_action('wp_head', 'wp_generator');
		remove_action('wp_head', 'feed_links', 2);
		remove_action('wp_head', 'index_rel_link');
		remove_action('wp_head', 'qtrans_header');
		remove_action('wp_head', 'wlwmanifest_link');
		remove_action('wp_head', 'feed_links_extra', 3);
		remove_action('wp_head', 'start_post_rel_link', 10, 0);
		remove_action('wp_head', 'parent_post_rel_link', 10, 0);
		remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
		remove_action('wp_head', 'print_emoji_detection_script', 7 );
		remove_action('wp_print_styles', 'print_emoji_styles');
	}
endif;
add_action( 'after_setup_theme', 'gutenberg_setup' );



/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function gutenberg_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'dravet' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'dravet' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'gutenberg_widgets_init' );



#------------------------------------------------------------------------------------
# SCRIPTS & ENQUEUEING
#------------------------------------------------------------------------------------

// remove WP version from RSS
function gutenberg_rss_version() { return ''; }

// remove WP version from scripts
function gutenberg_remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}

// remove injected CSS for recent comments widget
function gutenberg_remove_wp_widget_recent_comments_style() {
   if ( has_filter('wp_head', 'wp_widget_recent_comments_style') ) {
      remove_filter('wp_head', 'wp_widget_recent_comments_style' );
   }
}

// remove injected CSS from recent comments widget
function gutenberg_remove_recent_comments_style() {
  global $wp_widget_factory;
  if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
  }
}

// remove injected CSS from gallery
function gutenberg_gallery_style($css) {
  return preg_replace("!<style type='text/css'>(.*?)</style>!s", '', $css);
}

/**
 * Enqueue scripts and styles.
 */

// loading modernizr and jquery, and reply script
function gutenberg_scripts_and_styles() {
  global $wp_styles; // call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way
  if (!is_admin()) {
	// remove dravet styles cause we add rhem ourselfs
	//wp_dequeue_style( 'wp-block-library' );
	wp_deregister_script( 'wp-embed' );

	wp_enqueue_style('style', get_stylesheet_uri());
	wp_enqueue_script('header_js', get_template_directory_uri() . '/js/header-bundle.js', null, 1.0, false);
	wp_enqueue_script('footer_js', get_template_directory_uri() . '/js/footer-bundle.js', null, 1.0, true);


    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    	wp_enqueue_script( 'comment-reply' );
    }
      
  }
 
}
add_action( 'wp_enqueue_scripts', 'gutenberg_scripts_and_styles' );

#------------------------------------------------------------------------------------
# Custom Icons
#------------------------------------------------------------------------------------

function wp_localize_icon_vars(){
    $svg_url = get_bloginfo('template_url') . '/images/symbol-defs.svg';
    $svglocalstorage = array(
    	'url'			=> get_bloginfo('template_url'),
    	'svg_url' 		=> $svg_url,
    	'timestamp'		=> filemtime( TEMPLATEPATH . '/images/symbol-defs.svg' )
    );
    wp_localize_script( 'header_js', 'php_vars', $svglocalstorage );
}
add_action( 'wp_enqueue_scripts', 'wp_localize_icon_vars', 9999 );

function svg_icon( $icon, $class = NULL ) {

	echo '<svg class="icon icon-' . $icon . ' ' . $class . '"><use xlink:href="'. get_bloginfo('template_url') . '/images/symbol-defs.svg#' . $icon . '"></use></svg>';

}

function get_svg_icon( $icon, $class = NULL  ) {
	$svg = '<svg class="icon icon-' . $icon . ' ' . $class . '"><use xlink:href="'. get_bloginfo('template_url') . '/images/symbol-defs.svg#' . $icon . '"></use></svg>';
	return $svg;
}

#------------------------------------------------------------------------------------
# Responsiv Images
#------------------------------------------------------------------------------------

add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );
 
function remove_thumbnail_dimensions( $html ) {
        $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
        return $html;
}


#------------------------------------------------------------------------------------
# Responsiv YouTube embed
#------------------------------------------------------------------------------------

add_filter( 'embed_oembed_html', 'custom_oembed_filter', 10, 4 ) ;

function custom_oembed_filter($html, $url, $attr, $post_ID) {
    $return = '<div class="responsive-embed">'.$html.'</div>';
    return $return;
}

#------------------------------------------------------------------------------------
# PHP Inculdes
#------------------------------------------------------------------------------------
/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/admin-template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/admin-template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/admin-customizer.php';

/**
 * Settings Page additions.
 */
require get_template_directory() . '/inc/admin-settings.php';

require get_template_directory() .  '/inc/admin-admin.php';
require get_template_directory() .  '/inc/admin-login.php';
require get_template_directory() .  '/inc/admin-dashboard.php';
require get_template_directory() .  '/inc/admin-widgets.php';
require get_template_directory() .  '/inc/admin-images.php';
require get_template_directory() .  '/inc/admin-menu.php';
require get_template_directory() .  '/inc/admin-carbon-fields.php';


