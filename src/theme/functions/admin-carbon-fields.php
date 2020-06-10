<?php

//namespace App\Blocks;
use Carbon_Fields\Container;
use Carbon_Fields\Field;
use Carbon_Fields\Block;

//use function carbon_get_post_meta;

// Google Maps API
add_filter( 'carbon_fields_map_field_api_key', 'crb_get_gmaps_api_key' );
function crb_get_gmaps_api_key( $current_key ) {
    return 'AIzaSyA00G0NzDtOzdQRcQc6QRdo5u7lyj7Yz7I';
    //return '';
}

// Front Page Fields
add_action( 'carbon_fields_register_fields', 'custom_carbon_fields_front_page' );
function custom_carbon_fields_front_page() {
    
    /*
    * Front Page
    */
    Container::make( 'post_meta', 'Front Call to Action' )
    ->where( 'post_template', '=', 'templates/front-page.php' )
    ->add_fields( array( 
        Field::make( 'media_gallery', 'spenden_bilder', 'Spenden Bilder' )
        ->set_type( array( 'image' ) )
        ->set_duplicates_allowed( false ),
        Field::make( 'text', 'spenden_titel', 'Spenden Titel' ),
        Field::make( 'textarea', 'spenden_content', 'Spenden Inhalt' ),
        Field::make( 'textarea', 'spenden_info', 'Spenden Info' ),
    ) );

    Container::make( 'post_meta', 'Front News Sektion' )
    ->where( 'post_template', '=', 'templates/front-page.php' )
    ->add_fields( array( 
        Field::make( 'association', 'news_category', 'Kategorie Links' )
        ->set_types( array(
            array(
                'type' => 'term',
                'taxonomy' => 'category',
            )
        ) )
        ->set_max( 1 ),
        Field::make( 'urlpicker', 'news_link', 'Link Archive' ),
        Field::make( 'media_gallery', 'news_gallery', 'Bilder Galerie' )
        ->set_type( array( 'image' ) )
        ->set_duplicates_allowed( false ),
        
    ) );

    Container::make( 'post_meta', 'Front Mixed Content' )
    ->where( 'post_template', '=', 'templates/front-page.php' )
    ->add_fields( array( 
        Field::make( 'rich_text', 'mixed_content', 'Inhalt Container' ),
        Field::make( 'urlpicker', 'mixed_downloads', 'Link Downloads' ),
    ) );


    /*
    * Event Post Meta
    */

    Container::make( 'post_meta', 'Event Infos' )
    //->set_context( 'side' )
    ->where( 'post_type', '=', 'post' )
    ->add_fields( array(
        Field::make( 'date_time', 'crb_event_start_date', __( 'Event Datum' ) )
        ->set_attribute( 'placeholder', 'Datum und Uhrzeit Event Start' )
        ->set_storage_format( 'U' )
        ->set_input_format( 'j. F Y G:i', 'j. F Y G:i' ),
        Field::make('checkbox', 'crb_full_day_event', __('Ganztages Anlass') )
        ->set_help_text( __( 'Setze das Häcken wenn es ein Ganztages Anlass ist' ) ),
        Field::make( 'map', 'crb_company_location', __( 'Location' ) )
        ->set_help_text( __( 'drag and drop the pin on the map to select location' ) )
        ->set_position( 47.376888, 8.541694, 12 ),
        Field::make( 'media_gallery', 'gallery', 'Bilder Galerie' )
        ->set_type( array( 'image' ) )
        ->set_duplicates_allowed( false ),
        
    ));

    /*
    * Attachments Post Meta
    */

    Container::make( 'post_meta', 'Attachments' )
    ->set_context( 'side' )
    ->where( 'post_type', '=', 'post' )
    ->add_fields( array(
        Field::make( 'media_gallery', 'attachments', 'Attachments' )
        ->set_type( array( 'application/pdf' ) )
        ->set_duplicates_allowed( false ),
    ));



    /*
    * User Meta
    */

    Container::make( 'user_meta', 'Profil Daten' )
    ->add_fields( array(
        Field::make( 'image', 'profil_bild', 'Profil BIld' ),
        Field::make( 'text', 'profil_funktion_de', 'Funktion (Deutsch)' ),
        Field::make( 'text', 'profil_funktion_fr', 'Funktion (Französisch)' ),
        //->set_attribute( 'placeholder', '(***) ***-****' )

    ));

    function awb_remove_user_profile_fields_with_css() {
        //Hide unwanted fields in the user profile
        $fieldsToHide = [
            'rich-editing',
            //'admin-color',
            'comment-shortcuts',
            'admin-bar-front',
            'user-login',
            //'role',
            //'super-admin',
            //'first-name', 
            //'last-name', 
            'nickname', 
            'display-name', 
            //'email',
            //'description', 
            //'pass1', 
            //'pass2', 
            'sessions', 
            'capabilities',
            'syntax-highlighting',
            'url'
        
            ];
        
            //add the CSS
            foreach ($fieldsToHide as $fieldToHide) {
                echo '<style>tr.user-'.$fieldToHide.'-wrap{ display: none; }</style>';
            }
        
            //fields that don't follow the wrapper naming convention
            echo '<style>tr.user-profile-picture{ display: none; }</style>';
        
            //all subheadings
            echo '<style>#your-profile h2{ display: none; }</style>';
        }
        add_action( 'admin_head-user-edit.php', 'awb_remove_user_profile_fields_with_css' );
        add_action( 'admin_head-profile.php',   'awb_remove_user_profile_fields_with_css' );




    
    /*
    * Card Block
    */

    $card_labels = array(
        'plural_name' => 'Cards',
        'singular_name' => 'Card',
    );
    Block::make( __( 'Card Element' ) )
    ->add_fields( array(
        Field::make( 'complex', 'crb_slider', __( 'Card Element' ) )
        ->setup_labels( $card_labels )
        ->set_collapsed(true)
        ->add_fields( array(
            Field::make( 'text', 'title', __( 'Element Titel' ) ),
            Field::make( 'text', 'subtitle', __( 'Element Subtitel Titel (optional)' ) ),
            Field::make( 'checkbox', 'layout', __( 'Layout Quer' ) ),
            Field::make( 'checkbox', 'media_type', __( 'Medien Element' ) ),
            Field::make( 'image', 'photo', __( 'Element Bild / Logo' ) ),
            Field::make( 'urlpicker', 'url_link', 'Verlinkung' )
            ->set_help_text( "Verlinkung des Cards" ),
            Field::make( 'rich_text', 'content', __( 'Inhalt' ) ),
        ) )
        ->set_header_template( '
        <% if (title) { %>
            <%- title %> <%- title ? "" : "" %>
        <% } %>
    ' )
    ) )
    ->set_icon( 'schedule' )
    ->set_category( 'dravet-category', __( 'Dravet Blöcke' ) )
    ->set_preview_mode( false )
    //->set_description( __( 'A simple block consisting of a heading, an image and a text content.' ) )
    ->set_render_callback( function ( $fields ) {

        ?>
        <?php
        if($fields['crb_slider'][0]['layout'] != '') {

            $image_class = $fields['crb_slider'][0]['media_type'] == true ? 'no-icon' : 'is-rounded' ;
            ?>
            <div class="card_quer">
            <?php foreach ($fields['crb_slider'] as $block): ?>
                <div class="media">
                    <?php if($block['photo']) { ?>
                    <div class="media-left">
                        <figure class="image is-96x96">
                            <?php if($block['url_link']['url'] ) { ?>
                            <a href="<?php echo esc_html( $block['url_link']['url'] ); ?>" <?php echo ( $block['url_link']['blank'] ? ' target="_blank"' : '') ?>>
                            <?php echo wp_get_attachment_image( $block['photo'], 'teaser-square', false, array( 'class' => $image_class ) ); ?>
                            </a>
                            <?php } else { ?>
                            <?php echo wp_get_attachment_image( $block['photo'], 'teaser-square', false, array( 'class' => $image_class ) ); ?>
                            <?php } ?>
                        </figure>
                    </div>
                    <?php } ?>
                    <div class="media-content">
                        <div class="field">
                            <?php if($block['url_link']['url'] ) { ?>
                            <a href="<?php echo esc_html( $block['url_link']['url'] ); ?>"  <?php echo ( $block['url_link']['blank'] ? ' target="_blank"' : '') ?> class="title is-spaced is-5"><?php  echo esc_html( $block['title'] ); ?></a>
                            <?php } else { ?>
                            <p class="title is-5"><?php  echo esc_html( $block['title'] ); ?></p>
                            <?php } ?>
                            
                            <?php
                                
                                if ( $block['subtitle'] ) {
                                    ?>
                                    <p class="subtitle is-6"><?php echo esc_html( $block['subtitle'] ); ?></p>
                                    <?php
                                } 
                                /* elseif ( $block['date'] == true ) {
                                    ?>
                                    <p class="subtitle is-6"><time><?php echo esc_html( $block['date'] ); ?><time></p>
                                    <?php
                                }  */
                            ?>
                            
                        </div>
                    <div class="content">
                        <?php echo apply_filters( 'the_content', $block['content'] ); ?>
                    </div>
                    </div>
                    <div class="card-footer-item level-right">
                        <?php //svg_icon('navigation-menu-vertical', 'level-right'); ?>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <?php
        } else {
        ?>
        <div class="card_wrap">
        <?php foreach ($fields['crb_slider'] as $block): ?>
            <div class="card has-boxshadow">
                <?php if($block['photo']) { ?>
                <div class="card-image">
                    <figure class="image">
                        <?php if($block['url_link']['url'] ) { ?>
                        <a href="<?php echo esc_html( $block['url_link']['url'] ); ?>" <?php echo ( $block['url_link']['blank'] ? ' target="_blank"' : '') ?>>
                            <?php echo wp_get_attachment_image( $block['photo'], 'card-header', false, array( 'class' => 'hero' ) ); ?>
                        </a>
                        <?php } else { ?>
                            <?php echo wp_get_attachment_image( $block['photo'], 'card-header', false, array( 'class' => 'hero' ) ); ?>
                        <?php } ?>
                    </figure>
                </div>
                <?php } ?>
                <div class="card-content">
                    <div class="media-content">
                        <?php if($block['url_link']['url'] ) { ?>
                            <a href="<?php echo esc_html( $block['url_link']['url'] ); ?>" <?php echo ( $block['url_link']['blank'] ? ' target="_blank"' : '') ?> class="title is-spaced is-6"><?php  echo esc_html( $block['title'] ); ?></a>
                        <?php } else { ?>
                            <p class="title is-6"><?php  echo esc_html( $block['title'] ); ?></p>
                        <?php } ?>
                        
                        <?php
                            
                            if ( $block['subtitle'] ) {
                                ?>
                                <p class="subtitle is-6"><?php echo esc_html( $block['subtitle'] ); ?></p>
                                <?php
                            } 
                            /* elseif ( $block['date'] == true ) {
                                ?>
                                <p class="subtitle is-6"><time><?php echo esc_html( $block['date'] ); ?><time></p>
                                <?php
                            }  */
                        ?>
                        
                    </div>
                <div class="content">
                    <?php echo apply_filters( 'the_content', $block['content'] ); ?>
                </div>
                </div>
                <div class="card-footer-item level-right">
                    <?php //svg_icon('navigation-menu-vertical', 'level-right'); ?>
                    <br>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
        <?php
        }

    } );



    /*
    * FAQ Block
    */

/*     Block::make( __( 'My Shiny Gutenberg Block' ) )
    ->add_fields( array(
        Field::make( 'text', 'heading', __( 'Block Heading' ) ),
        Field::make( 'image', 'image', __( 'Block Image' ) ),
        Field::make( 'rich_text', 'content', __( 'Block Content' ) ),
    ) )
    ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
        ?>

        <div class="block">
            <div class="block__heading">
                <h1><?php echo esc_html( $fields['heading'] ); ?></h1>
            </div><!-- /.block__heading -->

            <div class="block__image">
                <?php echo wp_get_attachment_image( $fields['image'], 'full' ); ?>
            </div><!-- /.block__image -->

            <div class="block__content">
                <?php echo apply_filters( 'the_content', $fields['content'] ); ?>
            </div><!-- /.block__content -->
        </div><!-- /.block -->

        <?php
    } ); */

    /*
    * FAQ Block
    */

    $faq_labels = array(
        'plural_name' => 'FAQs',
        'singular_name' => 'FAQ',
    );

    Block::make( __( 'FAQ Element' ) )
    ->add_fields( array(
        Field::make( 'complex', 'crb_slider', __( 'FAQ Element' ) )
        ->setup_labels( $faq_labels )
        ->add_fields( array(
            Field::make( 'text', 'title', __( 'Frage' ) ),
            Field::make( 'rich_text', 'content', __( 'Antwort' ) ),
        ) )
        ->set_header_template( '
        <% if (title) { %>
            <%- title %> <%- title ? "" : "" %>
        <% } %>
    ' )
    ) )
    ->set_icon( 'testimonial' )
    ->set_category( 'dravet-category', __( 'Dravet Blöcke' ) )
    ->set_preview_mode( false )
    //->set_description( __( 'A simple block consisting of a heading, an image and a text content.' ) )
    ->set_render_callback( function ( $block ) {
        ?>
        <div id="card-content" class="block">
        <?php
        foreach ($block['crb_slider'] as $item): 
        ?>        
            <h1 class="is-size-5 has-text-secondary accordion-toggle"><?php echo esc_html( $item['title'] ); ?></h1>
            <div class="block__content accordion-content">
                <?php echo apply_filters( 'the_content', $item['content'] ); ?>
            </div><!-- /.block__content -->
        <?php
        endforeach;
        ?>
        </div><!-- /.block -->
        <?php
    } );
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


// Sponsor Fields
add_action( 'carbon_fields_register_fields', 'custom_carbon_fields_sponsor' );
function custom_carbon_fields_sponsor() {
    Container::make( 'post_meta', 'Partner Daten' )
    ->where( 'post_type', '=', 'sponsor' )
    ->add_fields( array(
    
        Field::make( 'text', '_sponsor_url', 'Partner URL' )
        ->set_help_text( 'Gebe optional die Partner Webseite an' ),
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
