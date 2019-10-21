<?php
/**
 * Base Functions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package dravet
 */

/*
 * Make theme available for translation.
 * Translations can be filed in the /languages/ directory.
 * If you're building a theme based on dravet, use a find and replace
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
    wp_localize_script( 'dravet-header-script', 'php_vars', $svglocalstorage );
}
add_action( 'wp_enqueue_scripts', 'wp_localize_icon_vars', 9999 );

function svg_icon( $icon, $class = NULL ) {

	echo '<svg class="icon icon-' . $icon . ' ' . $class . '"><use xlink:href="'. get_bloginfo('template_url') . '/images/symbol-defs.svg#' . $icon . '"></use></svg>';

}

function get_svg_icon( $icon, $class = NULL  ) {
	$svg = '<svg class="icon icon-' . $icon . ' ' . $class . '"><use xlink:href="'. get_bloginfo('template_url') . '/images/symbol-defs.svg#' . $icon . '"></use></svg>';
	return $svg;
}

