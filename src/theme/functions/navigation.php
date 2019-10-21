<?php
/**
 * Navigation Functions
 *
 * @package dravet
 */

// This theme uses wp_nav_menu() in one location.
if ( ! function_exists( 'register_nav_menus' ) ) {
	
	register_nav_menus( 
		array(
			'primary' => esc_html__( 'Hauptnavigation', 'dravet' ),
			'footer-1' => esc_html__( 'Fusszeile 1', 'dravet' ),
			'footer-2' => esc_html__( 'Fusszeile 2', 'dravet' ),
			'footer-3' => esc_html__( 'Fusszeile 3', 'dravet' ),
			'footer-4' => esc_html__( 'Fusszeile 4', 'dravet' ),
			'footer-5' => esc_html__( 'Fusszeile 5', 'dravet' ),
			'footer-6' => esc_html__( 'Fusszeile 6', 'dravet' ),
			'footer-7' => esc_html__( 'Fusszeile 7', 'dravet' ),
		) 
	);
}

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
