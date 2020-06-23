<?php

function lv2_add_bulma_input_classes( $args, $key, $value = null ) {
    // Include in functions.php
    
    /* This is not meant to be here, but it serves as a reference
    of what is possible to be changed.
    $defaults = array(
      'type'        => 'text',
      'label'      => '',
      'description'    => '',
      'placeholder'    => '',
      'maxlength'    => false,
      'required'      => false,
      'id'        => $key,
      'class'      => array(),
      'label_class'    => array(),
      'input_class'    => array(),
      'return'      => false,
      'options'      => array(),
      'custom_attributes' => array(),
      'validate'      => array(),
      'default'      => '',
    ); */
    // Start field type switch case
    switch ( $args['type'] ) {
      case "select" :  /* Targets all select input type elements, except the country and state select input types */
        $args['class'][] = 'field'; // Add a class to the field's html element wrapper - woocommerce input types (fields) are often wrapped within a <p></p> tag
        $args['input_class'] = array('input', 'input-lg'); // Add a class to the form input itself
        //$args['custom_attributes']['data-plugin'] = 'select2';
        $args['label_class'] = array('label');
        $args['custom_attributes'] = array( 'data-plugin' => 'select2', 'data-allow-clear' => 'true', 'aria-hidden' => 'true',  ); // Add custom data attributes to the form input itself
      break;
      case 'country' : /* By default WooCommerce will populate a select with the country names - $args defined for this specific input type targets only the country select element */
        $args['class'][] = 'field single-country';
        $args['label_class'] = array('label');
      break;
      case "state" : /* By default WooCommerce will populate a select with state names - $args defined for this specific input type targets only the country select element */
        $args['class'][] = 'field'; // Add class to the field's html element wrapper
        $args['input_class'] = array('input', 'input-lg'); // add class to the form input itself
        //$args['custom_attributes']['data-plugin'] = 'select2';
        $args['label_class'] = array('label');
        $args['custom_attributes'] = array( 'data-plugin' => 'select2', 'data-allow-clear' => 'true', 'aria-hidden' => 'true',  );
      break;
      case "password" :
      case "text" :
      case "email" :
      case "tel" :
      case "number" :
        $args['class'][] = 'field';
        //$args['input_class'][] = 'input input-lg'; // will return an array of classes, the same as bellow
        $args['input_class'] = array('input', 'input-lg');
        $args['label_class'] = array('label');
      break;
      case 'textarea' :
        $args['input_class'] = array('input', 'input-lg');
        $args['label_class'] = array('label');
      break;
      case 'checkbox' :
      break;
      case 'radio' :
      break;
      default :
        $args['class'][] = 'field';
        $args['input_class'] = array('input', 'input-lg');
        $args['label_class'] = array('label');
      break;
    }
    return $args;
  }
  add_filter('woocommerce_form_field_args','lv2_add_bulma_input_classes',10,3);

  
add_filter( 'woocommerce_breadcrumb_defaults', 'dravet_woocommerce_breadcrumbs' );

add_filter( 'woocommerce_show_page_title', '__return_false' );

function dravet_woocommerce_breadcrumbs() {
    return array(
            'delimiter'   => '',
            'wrap_before' => '<nav class="breadcrumb" itemprop="breadcrumb" aria-label="breadcrumbs"><ul>',
            'wrap_after'  => '</ul></nav>',
            'before'      => '<li>',
            'after'       => '</li>',
            'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
        );
}

//Reposition WooCommerce breadcrumb 
function woocommerce_remove_breadcrumb(){
  remove_action( 
      'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
  }
  add_action(
      'woocommerce_before_main_content', 'woocommerce_remove_breadcrumb'
  );
  
  function woocommerce_custom_breadcrumb(){
      woocommerce_breadcrumb();
  }
  
  add_action( 'woo_custom_breadcrumb', 'woocommerce_custom_breadcrumb' );

  

add_shortcode ('woo_cart_but', 'woo_cart_but' );
/**
 * Create Shortcode for WooCommerce Cart Menu Item
 */
function woo_cart_but() {
	ob_start();
 
        $cart_count = WC()->cart->cart_contents_count; // Set variable for cart item count
        $cart_url = wc_get_cart_url();  // Set Cart URL
  
        ?>
        <li><a class="menu-item cart-contents-" href="<?php echo $cart_url; ?>" title="<?php _e('Warenkorb', 'dravet'); ?>">
	    <?php
        if ( $cart_count > 0 ) {
       ?> 
            <?php svg_icon('cart'); ?>
            <span class="cart-contents-count"><?php echo $cart_count; ?></span>
        <?php
        } else {
          svg_icon('cart'); 
          ?>
          <span class="cart-contents-count">0</span> 
          <?php
        }
        ?>
        </a></li>
        <?php
	        
    return ob_get_clean();
 
}

add_filter( 'woocommerce_add_to_cart_fragments', 'woo_cart_but_count' );
/**
 * Add AJAX Shortcode when cart contents update
 */
function woo_cart_but_count( $fragments ) {
 
    ob_start();
    
    $cart_count = WC()->cart->cart_contents_count;
    $cart_url = wc_get_cart_url();
    
    ?>
    <a class="cart-contents menu-item" href="<?php echo $cart_url; ?>" title="<?php _e( 'View your shopping cart' ); ?>">
	<?php
    if ( $cart_count > 0 ) {
        ?>
        <span class="cart-contents-count"><?php echo $cart_count; ?></span>
        <?php            
    }
        ?></a>
    <?php
 
    $fragments['a.cart-contents'] = ob_get_clean();
     
    return $fragments;
}

add_filter( 'wp_nav_menu_items', 'woo_cart_but_icon', 10, 2 ); // Change menu to suit - example uses 'top-menu'

/**
 * Add WooCommerce Cart Menu Item Shortcode to particular menu
 */
function woo_cart_but_icon ( $items, $args ) {
   
  if( $args->theme_location === 'header' ) {

     $items .=  woo_cart_but(); // Adding the created Icon via the shortcode already created
     //$items .= 'hello';
     
  }
  
  return $items;

}


function new_orders_columns( $columns = array() ) {

  // Hide the columns
  if( isset($columns['order-total']) ) {
      // Unsets the columns which you want to hide
      //unset( $columns['order-number'] );
      //unset( $columns['order-date'] );
      unset( $columns['order-status'] );
      //unset( $columns['order-total'] );
      //unset( $columns['order-actions'] );
  }

  // Add new columns
  /* $columns['order-number'] = __( 'Reserva', 'Text Domain' );
  $columns['reservation-date'] = __( 'Para el día', 'Text Domain' );
  $columns['reservation-people'] = __( 'Seréis', 'Text Domain' );
  $columns['order-status'] = __( 'Estado de la reserva', 'Text Domain' );
  $columns['order-actions'] = __( '&nbsp;', 'Text Domain' ); */

  return $columns;
}
add_filter( 'woocommerce_account_orders_columns', 'new_orders_columns' );
