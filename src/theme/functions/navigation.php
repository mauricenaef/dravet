<?php
/**
 * Navigation Functions
 *
 * @package dravet
 */
// This theme uses wp_nav_menu() in one location.	
register_nav_menus( 
	array(
		'header' => __( 'Headernavigation', 'dravet' ),
		'primary' => __( 'Hauptnavigation', 'dravet' ),
		'footer-1' => __( 'Fusszeile 1', 'dravet' ),
		'footer-2' => __( 'Fusszeile 2', 'dravet' ),
		'footer-3' => __( 'Fusszeile 3', 'dravet' ),
		'footer-4' => __( 'Fusszeile 4', 'dravet' ),
		'footer-5' => __( 'Fusszeile 5', 'dravet' ),
		'footer-6' => __( 'Fusszeile 6', 'dravet' ),
        'footer-7' => __( 'Fusszeile 7', 'dravet' ),
        'footer-8' => __( 'Fusszeile 8 Sprachen', 'dravet' ),
		'quicklinks' => __( 'Quicklinks', 'dravet' ),
	) 
);


// dravet navigation
if ( ! function_exists( 'bulmastarter_navigation' ) ) {
	function bulmastarter_navigation()
	{
		wp_nav_menu( array(
			'theme_location'    => 'primary',
			'depth'             => 0,
			'container'         => 'div id="navigation"',
			'menu_class'        => 'navbar-start',
			'fallback_cb'       => 'bulmastarter_navwalker::fallback',
			'walker'            => new bulmastarter_navwalker()
			)
		);
	}
}


function dravet_the_post_navigation( $args = array() ) {
    $args = wp_parse_args( $args, array(
        'prev_text'          => ' Older',
        'next_text'          => 'Newer ',
        'in_same_term'       => true,
        'excluded_terms'     => '',
        'taxonomy'           => 'category',
        'screen_reader_text' => __( 'Post navigation' ),
    ) );
 
    $navigation = '';
 
    $previous = get_previous_post_link(
        '<div class="nav-previous">%link</div>',
        $args['prev_text'],
        $args['in_same_term'],
        $args['excluded_terms'],
        $args['taxonomy']
    );
 
    $next = get_next_post_link(
        '<div class="nav-next">%link</div>',
        $args['next_text'],
        $args['in_same_term'],
        $args['excluded_terms'],
        $args['taxonomy']
    );
 
    // Only add markup if there's somewhere to navigate to.
    if ( $previous || $next ) {
        $navigation = _navigation_markup( $previous . $next, 'post-navigation', $args['screen_reader_text'] );
    }
 
    return $navigation;
}