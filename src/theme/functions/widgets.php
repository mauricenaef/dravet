<?php
/**
 * Widget Functions
 *
 * @package dravet
 */

// Add theme support for selective refresh for widgets.
add_theme_support( 'customize-selective-refresh-widgets' );

if ( ! function_exists( 'bulmastarter_widgets_init' ) ) {
	/**
	 * Register widget area.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
	 */
	function bulmastarter_widgets_init() {
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar Standard', 'dravet' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'dravet' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title is-bold">',
			'after_title'   => '</h2>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar Artikel', 'dravet' ),
			'id'            => 'sidebar-2',
			'description'   => esc_html__( 'Add widgets here.', 'dravet' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title is-bold">',
			'after_title'   => '</h2>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar Blog / Beiträge', 'dravet' ),
			'id'            => 'sidebar-3',
			'description'   => esc_html__( 'Add widgets here.', 'dravet' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title is-bold">',
			'after_title'   => '</h2>',
		) );
	}
}
add_action( 'widgets_init', 'bulmastarter_widgets_init' );


#------------------------------------------------------------------------------------
# Remove unwanted Widgets
#------------------------------------------------------------------------------------
function bulmastarter_unregister_widgets() {
	//	unregister_widget('WP_Widget_Pages');
		unregister_widget('WP_Widget_Calendar');
	//	unregister_widget('WP_Widget_Archives');
	//	unregister_widget('WP_Widget_Links');
	//	unregister_widget('WP_Widget_Meta');
	//	unregister_widget('WP_Widget_Search');
	//	unregister_widget('WP_Widget_Text');
	//	unregister_widget('WP_Widget_Categories');
		unregister_widget('WP_Widget_Recent_Comments');
		unregister_widget('WP_Widget_RSS');
		unregister_widget('WP_Widget_Tag_Cloud');
		unregister_widget('WP_Widget_Tag_Cloud');
	//	unregister_widget('WP_Nav_Menu_Widget');
	
	}
	add_action('widgets_init', 'bulmastarter_unregister_widgets');

	

/**
 * Filter Recent Widgets to link to PDF direct
 */

/* add_filter( 'widget_posts_args', function( array $args )
{
    add_filter( 'the_title', 'wpse_prepend_thumbnail', 10, 2 );
    add_action( 'loop_end',  'wpse_clean_up' );
    return $args;
} );

function wpse_prepend_thumbnail( $title, $post_id )
{
    static $instance = 0;

    // Append thumbnail every second time (odd)
    if( 1 === $instance++ % 2 && has_post_thumbnail( $post_id ) )
        $title = get_the_post_thumbnail( $post_id ) . $title;

    return $title;
} 

function wpse_clean_up( \WP_Query $q )
{
    remove_filter( current_filter(), __FUNCTION__ );
    remove_filter( 'the_title', 'wpse_add_thumnail', 10 );
}  */