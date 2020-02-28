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