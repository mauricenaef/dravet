<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

// Google Maps API
add_filter( 'carbon_fields_map_field_api_key', 'crb_get_gmaps_api_key' );
function crb_get_gmaps_api_key( $current_key ) {
    return 'api';
}

// Front Page Fields
add_action( 'carbon_fields_register_fields', 'custom_carbon_fields_front_page' );
function custom_carbon_fields_front_page() {
    Container::make( 'post_meta', 'Seiten Meta' )
    ->where( 'post_id', '=', get_option( 'page_on_front' ) )
    ->add_fields( array(
        Field::make( 'text', 'home_video_url', 'Intro Video URL' ),
        Field::make( 'image', 'home_intro_icon', 'Bild / Icon' ),
        Field::make( 'media_gallery', 'home_gallery', 'Bilder Galerie' )
        ->set_type( array( 'image' ) )
        ->set_duplicates_allowed( false ),
    ));
}

// Rearange Angebote Columns
if ( ! function_exists( 'is_plugin_active' ) )
     require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
     
if ( is_plugin_active( 'carbon-admin-columns-manager/carbon-admin-columns-manager.php' ) ) {
    Carbon_Admin_Columns_Manager::modify_columns('post', array('page') )
        ->remove( array('date') )
        ->sort( array('cb', 'crb-thumbnail-column') )
        ->add( array(
            Carbon_Admin_Column::create('Bild')
            ->set_name( 'crb-thumbnail-column' )
            ->set_callback('crb_column_thumbnail')
            ->set_width( '80px' ),
            Carbon_Admin_Column::create('Package')
            ->set_callback('angebot_has_package'),
            Carbon_Admin_Column::create('Kurse')
            ->set_callback('angebot_has_kurs'),
            
    ));
}


function angebot_has_package() {
    $has_package = carbon_get_the_post_meta('angebot_packages');
    if ($has_package) {
        $has_package = '<span class="check">yes</span>';
        return $has_package;
    } 
}

function angebot_has_kurs() {
    $has_kurs = carbon_get_the_post_meta('angebot_kurs');
    if ($has_kurs) {
        $has_kurs = '<span class="check">yes</span>';
        return $has_kurs;
    } 
}

function crb_column_thumbnail( $post_id ) {
	if ( has_post_thumbnail( $post_id ) ) {
		return get_the_post_thumbnail( $post_id, 'thumbnail' );
	}
}
