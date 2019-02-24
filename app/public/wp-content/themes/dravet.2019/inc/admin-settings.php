<?php
// Carbon Copy Settings Page

use Carbon_Fields\Container;
use Carbon_Fields\Field;

// Default options page
add_action( 'carbon_fields_register_fields', 'custom_carbon_fields_settings' );
function custom_carbon_fields_settings() {

    $basic_options_container = Container::make( 'theme_options', 'Basic Options' )
        ->set_icon( 'dashicons-carrot' )
        ->set_page_menu_title( 'Front Page' )
        ->set_page_menu_position( 80 )
        ->add_fields( array(
            Field::make( 'separator', 'settings_0', 'Home Settings' ),
            Field::make( 'complex', 'home_intro', 'Complex field' )
                ->add_fields( array(
                    Field::make( 'text', 'name', 'Name' ),
                    Field::make( 'image', 'avatar', 'Bild' ),
                    Field::make( 'text', 'telefon', 'Telefon' ),
                ) ),
            
        ) );

    // Add second options page under 'Basic Options'
/*     Container::make( 'theme_options', 'Navigation' )
        ->set_page_parent( $basic_options_container ) // reference to a top level container
        ->add_fields( array(
            
        ) ); */
}