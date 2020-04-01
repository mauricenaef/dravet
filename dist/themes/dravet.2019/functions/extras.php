<?php
/**
 * Extra Functions
*
 * @package dravet
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
if ( ! function_exists( 'bulmastarter_body_classes' ) ) {
	function bulmastarter_body_classes( $classes ) {
		// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}

		// Adds a class of hfeed to non-singular pages.
		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}

		return $classes;
	}
}
add_filter( 'body_class', 'bulmastarter_body_classes' );

if ( ! function_exists( 'bulmastarter_pingback_header' ) ) {
	/**
	 * Add a pingback url auto-discovery header for singularly identifiable articles.
	 */
	function bulmastarter_pingback_header() {
		if ( is_singular() && pings_open() ) {
			echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
		}
	}
}
add_action( 'wp_head', 'bulmastarter_pingback_header' );


/**
 * Edit Archive Title
 * 
 */

add_filter( 'get_the_archive_title', function ($title) {    
    	if ( is_category() ) {    
            $title = single_cat_title( '', false );    
        } elseif ( is_tag() ) {    
            $title = single_tag_title( '', false );    
        } elseif ( is_author() ) {    
            $title = '<span class="vcard">' . get_the_author() . '</span>' ;    
        } elseif ( is_tax() ) { //for custom post types
            $title = sprintf( __( '%1$s' ), single_term_title( '', false ) );
        } else {
			$title = __('Archiv', 'dravet');
		}    
    	return $title;    
});


add_filter("gform_address_display_format", "address_format");
function address_format($format){
    return "zip_before_city";
}

add_filter("gform_address_street", "change_anschrift_strasse", 10, 2);
function change_anschrift_strasse($label, $form_id){
	return "Strasse Nr.";
}

add_filter("gform_address_zip", "change_anschrift_plz", 10, 2);
function change_anschrift_plz($label, $form_id){
	return "PLZ";
}

/**
 * Theme Setup 
 *
 */
function dravet_color_setup() {
	// Disable Custom Colors
	add_theme_support( 'disable-custom-colors' );
  
	// Editor Color Palette
	add_theme_support( 'editor-color-palette', array(
		array(
			'name'  => __( 'Lila', 'dravet' ),
			'slug'  => 'purple',
			'color'	=> '#433D72',
		),
		array(
			'name'  => __( 'Grün', 'dravet' ),
			'slug'  => 'green',
			'color' => '#90C66C',
		),
		array(
			'name'  => __( 'Grau', 'dravet' ),
			'slug'  => 'grey',
			'color' => '#838383',
		),
		array(
			'name'  => __( 'Weiss', 'dravet' ),
			'slug'  => 'white',
			'color' => '#ffffff',
		),
		array(
			'name'  => __( 'Schwarz', 'dravet' ),
			'slug'  => 'black',
			'color' => '#000000',
		),
		
	) );
}
add_action( 'after_setup_theme', 'dravet_color_setup' );