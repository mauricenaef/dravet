<?php 

add_filter( 'woocommerce_product_single_add_to_cart_text', 'woo_custom_cart_button_text' );    // 2.1 +
 
function woo_custom_cart_button_text() {
 
        return __( 'Kaufen', 'kulturkoller' );
 
}


#------------------------------------------------------------------------------------
# Global
#------------------------------------------------------------------------------------

// Remove Count and Sorting
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );


// Remove Wrappers
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

// Remove Breadcrumbs
//remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

// Remove Sidebar
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );


#------------------------------------------------------------------------------------
# Single Product View
#------------------------------------------------------------------------------------

// Add Subtitle
//add_action( 'woocommerce_single_product_summary', 'kulturkoller_subtitle', 6 );

// Add Event Date
//add_action( 'woocommerce_single_product_summary', 'kulturkoller_event_date', 1);

// Move Price and Form to own section
/* remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price',  10);
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart',  30);
add_action( 'kulturkoller_single_product_price', 'woocommerce_template_single_price',  10);
add_action( 'kulturkoller_single_product_price', 'woocommerce_template_single_add_to_cart',  20); */

// Move Variation Price
//remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20 ); 
//add_action( 'kulturkoller_single_action', 'woocommerce_single_variation_add_to_cart_button', 10 ); 

// Remove Single Price
//remove_action( 'kulturkoller_single_product_price', 'woocommerce_template_single_price', 10);

// Remove Tabs
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );

// Add Event Details
//add_action( 'woocommerce_after_single_product_summary', 'kulturkoller_event_details', 60 );

// Remove Variable Price on Single
//add_filter( 'woocommerce_variable_sale_price_html', 'kulturkoller_remove_variation_price', 10, 2 );
//add_filter( 'woocommerce_variable_price_html', 'kulturkoller_remove_variation_price', 10, 2 );

// Remove Article Number
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

// remove images from under featured image
//remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );

// add them back under short description 
//add_action( 'woocommerce_after_single_product_summary', 'woocommerce_show_product_thumbnails', 50 );

// remove similar products
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );


#------------------------------------------------------------------------------------
# Checkout Page
#------------------------------------------------------------------------------------

// Remove Coupon
// hide coupon field on checkout page
function hide_coupon_field_on_checkout( $enabled ) {
	if ( is_checkout() ) {
		$enabled = false;
	}
	return $enabled;
}
add_filter( 'woocommerce_coupons_enabled', 'hide_coupon_field_on_checkout' );



#------------------------------------------------------------------------------------
# Edit Address Fields
#------------------------------------------------------------------------------------

// Custom Checkout Fields
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );


// Our hooked in function - $fields is passed via the filter!
function custom_override_checkout_fields( $fields ) {

	// Billing
	$fields['billing']['billing_first_name']['placeholder'] = 'Vorname';
	$fields['billing']['billing_last_name']['placeholder'] = 'Nachname';	
	$fields['billing']['billing_address_1']['label'] = 'Strasse Nr.';
	$fields['billing']['billing_email']['placeholder'] = 'E-mail';
	$fields['billing']['billing_phone']['placeholder'] = 'Telefon';
	$fields['billing']['billing_postcode']['placeholder'] = 'PLZ';
	$fields['billing']['billing_city']['placeholder'] = 'Ort';

	$fields['billing']['billing_first_name']['class'] = array('control is-half');
	$fields['billing']['billing_last_name']['class'] = array('control is-half');
	$fields['billing']['billing_postcode']['class'] = array('control');
	$fields['billing']['billing_city']['class'] = array('control');
	$fields['billing']['billing_email']['class'] = array('control');
	$fields['billing']['billing_phone']['class'] = array('control');


	unset($fields['billing']['billing_company']);

	return $fields;
}

function change_woocommerce_field_markup( $field, $key, $args, $value ) {

    //  Remove the .form-row class from the current field wrapper

    $field = str_replace('form-row', 'field', $field);

    //  Wrap the field (and its wrapper) in a new custom div, adding .form-row so the reshuffling works as expected, and adding the field priority

    $field = '<div class="control field" data-priority="' . $args['priority'] . '">' . $field . '</div>';

    return $field;
}

add_filter( 'woocommerce_form_field', 'change_woocommerce_field_markup', 10, 4 );


