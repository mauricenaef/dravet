<?php
/**
 * Navigation Functions
 *
 * @package dravet
 */
// This theme uses wp_nav_menu() in one location.	
register_nav_menus( 
	array(
		'primary' => __( 'Hauptnavigation', 'dravet' ),
		'footer-1' => __( 'Fusszeile 1', 'dravet' ),
		'footer-2' => __( 'Fusszeile 2', 'dravet' ),
		'footer-3' => __( 'Fusszeile 3', 'dravet' ),
		'footer-4' => __( 'Fusszeile 4', 'dravet' ),
		'footer-5' => __( 'Fusszeile 5', 'dravet' ),
		'footer-6' => __( 'Fusszeile 6', 'dravet' ),
		'footer-7' => __( 'Fusszeile 7', 'dravet' ),
	) 
);


// dravet navigation
if ( ! function_exists( 'bulmastarter_navigation' ) ) {
	function bulmastarter_navigation()
	{
		wp_nav_menu( array(
			'theme_location'    => 'primary',
			'depth'             => 0,
			'container'         => 'div id="navigation"',
			'menu_class'        => 'navbar-end',
			'fallback_cb'       => 'bulmastarter_navwalker::fallback',
			'walker'            => new bulmastarter_navwalker()
			)
		);
	}
}
