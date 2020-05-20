<?php


/**
 * Team Shortcode
 */

 function dravet_team( $atts = array() ) {
    extract(shortcode_atts(array(
        'role'    => 'vorstand',
        'orderby' => 'user_nicename',
        'order'   => 'ASC'
    ), $atts));

    $args = array(
        'role'    => $role,
        'orderby' => 'user_nicename',
        'order'   => 'ASC'
    );

    $users = get_users( $args );
    $output = '';
    foreach($users as $user_id){

        $avatar = wp_get_attachment_image_src(get_user_meta( $user_id->ID, '_profil_bild', true), 'thumbnail', false);
        $fist_name = get_user_meta( $user_id->ID, 'first_name', true);
        $last_name = get_user_meta( $user_id->ID, 'last_name', true);
        $funktion_de = get_user_meta( $user_id->ID, '_profil_funktion_de', true);
        $bio = get_user_meta( $user_id->ID, 'description', true);

        $output .= '<div class="card_quer">';
        $output .= '<div class="media"><div class="media-left"><figure class="image is-96x96"><img src="' . $avatar[0]  . ' " class="is-rounded" /></figure></div>';
        $output .= '<div class="media-content"><div class="field">';
        $output .= '<p class="title is-5">' . $fist_name . '  ' . $last_name . '</p>';
        $output .= '<p class="subtitle is-6">' . $funktion_de. '</p>';
        $output .= '</div>';
        $output .= '<div class="content">' . $bio . '</div>';
        $output .= '</div></div></div>';

    }

    return $output;

 }

 add_shortcode('team', 'dravet_team');