<?php
/**
 * Theme Customizer Functions
 *
 * @package dravet
 */

add_theme_support( 'custom-logo' );

function dravet_customize_register( $wp_customize ) {

	$wp_customize->add_setting( 'dravet_logo' ); // Add setting for logo uploader

	// Add control for logo uploader (actual uploader)

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'dravet_logo', array(

    	'label'    => __( 'Logo (Footer)', 'dravet' ),

    	'section'  => 'title_tagline',

    	'settings' => 'dravet_logo',

	) ) );

}

add_action( 'customize_register', 'dravet_customize_register' );

if ( ! function_exists( 'bulmastarter_customize_register' ) ) {
	/**
	 * Add postMessage support for site title and description for the Theme Customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	function bulmastarter_customize_register( $wp_customize ) {
		$wp_customize->remove_section("colors");
		$wp_customize->remove_section("background_image");

		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	}
}
add_action( 'customize_register', 'bulmastarter_customize_register' );

if ( ! function_exists( 'bulmastarter_customize_preview_js' ) ) {
	/**
	 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
	 */
	function bulmastarter_customize_preview_js() {
		wp_enqueue_script( 'bulmastarter_customizer', get_template_directory_uri() . '/js/admin.script.min.js', array( 'customize-preview' ), '20151215', true );
	}
}
add_action( 'customize_preview_init', 'bulmastarter_customize_preview_js' );
