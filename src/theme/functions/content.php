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