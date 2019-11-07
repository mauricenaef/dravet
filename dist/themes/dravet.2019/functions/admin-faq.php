<?php
// Register Custom Post Type
function custom_post_type_faq() {

	$labels = array(
		'name'                  => _x( 'FAQs', 'Post Type General Name', 'dravet' ),
		'singular_name'         => _x( 'FAQ', 'Post Type Singular Name', 'dravet' ),
		'menu_name'             => __( 'FAQ', 'dravet' ),
		'name_admin_bar'        => __( 'FAQ', 'dravet' ),
		'archives'              => __( 'Element Archiv', 'dravet' ),
		'attributes'            => __( 'Element Attribute', 'dravet' ),
		'parent_item_colon'     => __( 'Eltern Element:', 'dravet' ),
		'all_items'             => __( 'Alle Elemente', 'dravet' ),
		'add_new_item'          => __( 'Neues Element', 'dravet' ),
		'add_new'               => __( 'Hinzufügen', 'dravet' ),
		'new_item'              => __( 'Neues Element', 'dravet' ),
		'edit_item'             => __( 'Bearbeiten', 'dravet' ),
		'update_item'           => __( 'Aktualisieren', 'dravet' ),
		'view_item'             => __( 'Anschauen', 'dravet' ),
		'view_items'            => __( 'Elemente Anschauen', 'dravet' ),
		'search_items'          => __( 'Suchen', 'dravet' ),
		'not_found'             => __( 'Nichts gefunden', 'dravet' ),
		'not_found_in_trash'    => __( 'Im Abfall Eimer nichts gefunden', 'dravet' ),
		'featured_image'        => __( 'Beitragsbild', 'dravet' ),
		'set_featured_image'    => __( 'Beitragsbild setzen', 'dravet' ),
		'remove_featured_image' => __( 'Beitragsbild entfernen', 'dravet' ),
		'use_featured_image'    => __( 'Als Beitragsbild benutzen', 'dravet' ),
		'insert_into_item'      => __( 'Einfügen', 'dravet' ),
		'uploaded_to_this_item' => __( 'Zum element hochladen', 'dravet' ),
		'items_list'            => __( 'Elemente Liste', 'dravet' ),
		'items_list_navigation' => __( 'Elemente Liste in Navigation', 'dravet' ),
		'filter_items_list'     => __( 'Elemente Filtern', 'dravet' ),
	);
	$args = array(
		'label'                 => __( 'FAQ', 'dravet' ),
		'description'           => __( 'Frequently Asked Questions', 'dravet' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'revisions' ),
		'taxonomies'            => array( 'faq_kategorie' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-format-status',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'faq', $args );

}
add_action( 'init', 'custom_post_type_faq', 0 );



// Register Custom Taxonomy
function custom_taxonomy_faq_kategorie() {

	$labels = array(
		'name'                       => _x( 'FAQ Kategorien', 'Taxonomy General Name', 'dravet' ),
		'singular_name'              => _x( 'FAQ Kategorie', 'Taxonomy Singular Name', 'dravet' ),
		'menu_name'                  => __( 'Kategorie', 'dravet' ),
		'all_items'                  => __( 'Alle Kategorien', 'dravet' ),
		'parent_item'                => __( 'Eltern Kategorie', 'dravet' ),
		'parent_item_colon'          => __( 'Eltern Element:', 'dravet' ),
		'new_item_name'              => __( 'Neue Kategorie', 'dravet' ),
		'add_new_item'               => __( 'Kategorie hinzufügen', 'dravet' ),
		'edit_item'                  => __( 'Kategorie bearbeiten', 'dravet' ),
		'update_item'                => __( 'Kategorie aktualisieren', 'dravet' ),
		'view_item'                  => __( 'Kategorie anschauen', 'dravet' ),
		'separate_items_with_commas' => __( 'Mit Kommas trennen', 'dravet' ),
		'add_or_remove_items'        => __( 'Hinzufügen oder entfernen', 'dravet' ),
		'choose_from_most_used'      => __( 'Wähle von den meistbenutzten Kategorien aus', 'dravet' ),
		'popular_items'              => __( 'Oft benutzte', 'dravet' ),
		'search_items'               => __( 'Suchen', 'dravet' ),
		'not_found'                  => __( 'Nichts gefunden', 'dravet' ),
		'no_terms'                   => __( 'Keine Elemente', 'dravet' ),
		'items_list'                 => __( 'Elemente Liste', 'dravet' ),
		'items_list_navigation'      => __( 'Elemente Liste Navigation', 'dravet' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'faq_kategorie', array( 'faq' ), $args );

}
add_action( 'init', 'custom_taxonomy_faq_kategorie', 0 );


// Ajax load

add_action('wp_ajax_dravet_faq_ajax', 'dravet_faq_ajax');
add_action('wp_ajax_nopriv_dravet_faq_ajax', 'dravet_faq_ajax');

function dravet_faq_ajax() {
	$term_id = $_POST[ 'term' ];
    $args = array (
		'term' => $term_id,
		'post_type' => 'faq',
        'posts_per_page' => -1,
        'order' => 'DESC',
        'tax_query' => array(
            array(
                'taxonomy' => 'faq_kategorie',
                'field'    => 'id',
            	'terms'    => $term_id,
                'operator' => 'IN'
                )
            )
        );

    global $post;
    $custom_posts = get_posts( $args );
	ob_start (); 
	if($custom_posts) {
	foreach($custom_posts as $post) : setup_postdata($post);
	the_title('<h6 class="accordion-toggle">','</h6>');
	echo "<div class='accordion-content'>";
	the_content();
	echo "</div>";
	endforeach;
	}

	wp_reset_postdata(); 
    $response = ob_get_contents();
	
	ob_end_clean();
	
	echo $response;
	
    die(1);
}

function dravet_faq( $datahash = null ) {
    global $post;

	$args = array(
		'post_type' 	=> array( 'faq' ),
		'numberposts'	=> -1,
		'order'			=> 'ASC',
		'orderby'		=> 'menu_order'
    );
    
    $feedback = get_posts($args);
	
	if ($feedback) {
    ?>
    <div data-hash="<?php echo $datahash; ?>">
    <section class="testimonial-section bg-lighter section-padding">
        <div class="grid-container">
            <div class="grid-x align-justify align-middle small-align-center-middle">
                <div class="cell small-6 medium-3 medium-offset-1">
                    <img src="<?php bloginfo( 'template_url' ) ?>/images/icon/icon-faq.svg" class="section-icon faq-section-icon" alt="Testimonial">
                </div>
                <div class="cell small-10 medium-5 large-4 medium-offset-pull-1">
                    <div class="card testimonial-card faq-card shadow">
                        <div class="card-header text-center">
                            <h2 class="card-header-title"><?php echo carbon_get_theme_option('home_faq_title'); ?></h2>
                            <?php echo apply_filters( 'the_content', carbon_get_theme_option('home_faq_content') ); ?>
                        </div>
                        <div class="card-content shadow">
							<?php 
							// Create and display the dropdown menu.
							wp_dropdown_categories(
								array(
									'orderby'         => 'NAME', // Order the items in the dropdown menu by their name.
									'taxonomy'        => 'faq_kategorie', // Only include posts with the taxonomy of 'tools'.
									'name'            => 'select-faq', // Change this to the
									//'show_option_all' => 'Wähle eine FAQ Kategorie', // Text the dropdown will display when none of the options have been selected.
									//'selected'        => km_get_selected_taxonomy_dropdown_term(), // Set which option in the dropdown menu is the currently selected one.
								) );
							?>
							<div id="card-container"  class="card-container">
								<div id="loading-faq" class="loading-container">
									<img src="<?php bloginfo( 'template_url' ) ?>/images/loading-dark.svg">
									<p class="element-padding text-center"><small>FAQ werden geladen ...</small></p>
								</div>
								<div id="card-content"></div>
							</div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>
    <?php
    }
}