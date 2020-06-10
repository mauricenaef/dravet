<?php
// Carbon Copy Settings Page

use Carbon_Fields\Container;
use Carbon_Fields\Field;

// Default options page
add_action( 'carbon_fields_register_fields', 'custom_carbon_fields_settings' );
function custom_carbon_fields_settings() {

    $basic_options_container = Container::make( 'theme_options', 'Basic Options' )
        ->set_icon( 'dashicons-carrot' )
        ->set_page_menu_title( 'Seiten Settings' )
        ->set_page_menu_position( 80 )
        ->add_fields( array(
            Field::make( 'separator', 'settings_0', 'Fusszeilen Inhalte' ),
            /* Field::make( 'complex', 'home_intro', 'Complex field' )
                ->add_fields( array(
                    Field::make( 'text', 'name', 'Name' ),
                    Field::make( 'image', 'avatar', 'Bild' ),
                    Field::make( 'text', 'telefon', 'Telefon' ),
            )), */
            Field::make( 'rich_text', 'footer_content_de', 'Inhalt Rich DE' ), 
            Field::make( 'rich_text', 'footer_content_fr', 'Inhalt Rich FR' ), 
            Field::make( 'text', 'footer_content_credits_de', 'Inhalt Credits DE' ), 
            Field::make( 'text', 'footer_content_credits_fr', 'Inhalt Credits FR' ),
            
        ));
}