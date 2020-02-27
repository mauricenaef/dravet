<?php

/**
 * Load jQuery from Google CDN
 *
 * @package dravet
 */

/* function use_jquery_from_google () {
	if (is_admin()) {
		return;
	}

	global $wp_scripts;
	if (isset($wp_scripts->registered['jquery']->ver)) {
		$ver = $wp_scripts->registered['jquery']->ver;
                $ver = str_replace("-wp", "", $ver);
	} else {
		$ver = '1.12.4';
	}

	wp_deregister_script('jquery');
	wp_register_script('jquery', "//ajax.googleapis.com/ajax/libs/jquery/$ver/jquery.min.js", false, $ver);
}

add_action('init', 'use_jquery_from_google'); */

/**
 * Scripts & Styles
 *
 * @package dravet
 */

if ( ! function_exists( 'bulmastarter_scripts' ) ) {
	/**
	 * Enqueue scripts and styles.
	 */
	function bulmastarter_scripts() {

		wp_enqueue_style( 'dravet-style', get_stylesheet_uri() );
		wp_enqueue_style( 'bulmapress-fontawesome', "https://use.fontawesome.com/releases/v5.2.0/css/all.css" );
		wp_enqueue_script( 'dravet-header-script', get_template_directory_uri() . '/js/header.script.min.js', array('jquery'), '20151215', false );
		wp_enqueue_script( 'dravet-footer-script', get_template_directory_uri() . '/js/footer.script.min.js', array('jquery'), '20151215', true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'bulmastarter_scripts' );

