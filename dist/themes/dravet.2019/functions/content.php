<?php
/**
 * Content Functions
 *
 * @package dravet
 */

if ( ! function_exists( 'bulmastarter_content_width' ) ) {
	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @global int $content_width
	 */
	function bulmastarter_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'bulmastarter_content_width', 640 );
	}
}
add_action( 'after_setup_theme', 'bulmastarter_content_width', 0 );

#------------------------------------------------------------------------------------
# Responsiv Images
#------------------------------------------------------------------------------------

add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );
 
function remove_thumbnail_dimensions( $html ) {
        $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
        return $html;
}


#------------------------------------------------------------------------------------
# Responsiv YouTube embed
#------------------------------------------------------------------------------------

add_filter( 'embed_oembed_html', 'custom_oembed_filter', 10, 4 ) ;

function custom_oembed_filter($html, $url, $attr, $post_ID) {
    $return = '<div class="responsive-embed">'.$html.'</div>';
    return $return;
}

#------------------------------------------------------------------------------------
# New Excerpt Read more
#------------------------------------------------------------------------------------
function mytheme_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'mytheme_custom_excerpt_length', 999 );
function new_excerpt_more($more) {
    return '';
}
add_filter('excerpt_more', 'new_excerpt_more', 21 );

function the_excerpt_more_link( $excerpt ){
    $post = get_post();
    $excerpt .= '<a href="'. get_permalink($post->ID) . '" class="button is-small is-link is-rounded">' . __('weiter lesen', 'dravet') . ' ' . get_svg_icon('chev-right', 'is-small') . '</a>';
    return $excerpt;
}
add_filter( 'the_excerpt', 'the_excerpt_more_link', 21 );

#------------------------------------------------------------------------------------
# Add PDF
#------------------------------------------------------------------------------------

add_filter('media_send_to_editor', 'my_filter_pdf', 20, 3);

function my_filter_pdf($html, $id) {
    $attachment = get_post($id); //fetching attachment by $id passed through

    $mime_type = $attachment->post_mime_type; //getting the mime-type
    if ($mime_type == 'application/pdf') { //checking mime-type
        $src = wp_get_attachment_url( $id );

        $html = '<a href="'.$src.'" class="any-class-for-pdf-files">File</a>';
        return $html; // return new $html    
    }
        return $html;
}