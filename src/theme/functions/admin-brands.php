<?php
#------------------------------------------------------------------------------------
# Sponsor
#------------------------------------------------------------------------------------
// Register Custom Post Type
function custom_post_type_sponsor() {

	$labels = array(
		'name'                => _x( 'Sponsor', 'Post Type General Name', 'dravet' ),
		'singular_name'       => _x( 'Sponsor', 'Post Type Singular Name', 'dravet' ),
		'menu_name'           => __( 'Partner', 'dravet' ),
		'name_admin_bar'      => __( 'Sponsor', 'dravet' ),
		'parent_item_colon'   => __( 'Sponsor:', 'dravet' ),
		'all_items'           => __( 'Alle Partner', 'dravet' ),
		'add_new_item'        => __( 'Neuer Sponsor', 'dravet' ),
		'add_new'             => __( 'Neuer Sponsor hinzufügen', 'dravet' ),
		'new_item'            => __( 'Neuer Sponsor', 'dravet' ),
		'edit_item'           => __( 'Sponsor bearbeiten', 'dravet' ),
		'update_item'         => __( 'Sponsor aktualisieren', 'dravet' ),
		'view_item'           => __( 'Sponsor ansehen', 'dravet' ),
		'search_items'        => __( 'Sponsor suchen', 'dravet' ),
		'not_found'           => __( 'Nichts gefunden', 'dravet' ),
		'not_found_in_trash'  => __( 'Im Papierkorb wurde nichts gefunden', 'dravet' ),
	);
	$args = array(
		'label'               => __( 'Partner', 'dravet' ),
		'description'         => __( 'Partner', 'dravet' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'thumbnail', 'revisions' ),
		'hierarchical'        => true,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-heart',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,		
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'sponsor', $args );

}
add_action( 'init', 'custom_post_type_sponsor', 0 );


#------------------------------------------------------------------------------------
# Sponsor Meta Data
#------------------------------------------------------------------------------------

/* add_action( 'cmb2_init', 'dravet_sponsor_metaboxes' );

function dravet_sponsor_metaboxes() {

	$prefix = '_sponsor_';

	$meta_boxes = new_cmb2_box( array(
		'id'			=> 'sponsor_metabox',
		'title'			=> 'Sponsor',
		'object_types'	=> array( 'sponsor' ),
		'contex'		=> 'normal',
		'priority'		=> 'high',
		'show_names'	=> true,
	) );

	$meta_boxes->add_field( array(
	    'name'		=> 'Link',
	    'desc' 		=> 'Gebe optional die Sponsor Webseite an',
		'id'		=> $prefix . 'url',
		'type' 		=> 'text_url',
	) );

} */

#------------------------------------------------------------------------------------
# Sponsor columns
#------------------------------------------------------------------------------------

add_filter("manage_edit-sponsor_columns", "sponsor_edit_columns");
add_action("manage_sponsor_posts_custom_column",  "sponsor_custom_columns");

function sponsor_edit_columns($columns){
  $columns = array(
    'cb' 			=> '<input type="checkbox" />',
    'thumbnail'		=> 'Image',
    'title' 		=> 'Title',
    'date'			=> 'Date',
  );
 
  return $columns;
}

function sponsor_custom_columns($column) {
  	global $post;
  	$custom = get_post_custom();
  	
     switch ($column) {
     case "thumbnail":
     	echo the_post_thumbnail();
     break;
 
     
  }
}

#------------------------------------------------------------------------------------
# Create Sponsor Grid
#------------------------------------------------------------------------------------

function dravet_sponsor() {
	?>
	<section class="section partner-section">
			<?php
			global $post; 
			$args = array(
				'post_type'			=> 'sponsor',
				'posts_per_page' 	=> -1,
				'order'				=> 'ASC',
				'orderby'			=> 'menu_order'

			);
			

			$custom_posts = get_posts($args);
			
			if ($custom_posts) {
				//echo '<small class="sponsor-claim">dravet wird unterstützt von:</small>';
				echo '<div class="container is-fluid">';
				echo '<div class="columns">';
				
				foreach($custom_posts as $post) : setup_postdata($post);

				$svg = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );

				echo '<div class="sponsor-item column is-2-desktop is-4-tablet is-4-mobile">';
				echo '<a href="' . get_post_meta( $post->ID, '__sponsor_url', true ) . '" target="_blank" class="sponsor-url ' . $post->post_name . '" >';
				echo '<img src="' . $svg[0] . '" />';
				echo '</a>';
				echo '</div>';
				
			endforeach;
			
				echo '</div>';
				echo '</div>';

			} else {
				echo '<h3>' . __('Keine Partner', 'dravet') . '</h3>';
			}
			
			?>
	</section>
	<?php


}

