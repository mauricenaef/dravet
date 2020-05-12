<?php
/**
 * Post Thumbnails Functions
 *
 * @package dravet
 */


/**
 *
 * Enable support for Post Thumbnails on posts and pages.
 *
 * NOTE: If you edit or add new image sizes, please regenerate your thumbnails to see changes.
 *
 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
 */

// custom image sizes
if ( function_exists( 'add_theme_support' ) ) {
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 1800, 9999 );
  
    // additional image sizes
  
    add_image_size( 'teaser-square', 300, 300, true);
    //300 square pixels cropped
    
    add_image_size( 'teaser-square-medium', 600, 600, true); 
    //600 square pixels cropped
    
    add_image_size( 'teaser-square-x-large', 800, 800, true);
    //800 square pixels cropped
  
    // width-only images
    add_image_size( 'three-fourty', 340);
    add_image_size( 'four-twenty', 420);
    add_image_size( 'six-hundred', 600);
    add_image_size( 'seven-sixty', 760);
    add_image_size( 'seven-eighty', 780);
    add_image_size( 'eight-eighty', 880);
    add_image_size( 'ten-eighty', 1080);
    add_image_size( 'twelve-sixty', 1260);
    add_image_size( 'fourteen-hundred', 1400);
    add_image_size( 'hero', 1400, 350, true);
    add_image_size( 'eighteen-eighty', 1880);


    // Cards Header image
    add_image_size( 'card-header', 300, 180, true );

  }



function dravet_responsive_image($image_id,$image_size,$max_width){
	// check the image ID is not blank
	if($image_id != '') {
	
        // set the default src image size
	$image_src = wp_get_attachment_image_url( $image_id, $image_size );
	// set the srcset with various image sizes
	$image_srcset = wp_get_attachment_image_srcset( $image_id, $image_size );
	// generate the markup for the responsive image
	echo 'src="'.$image_src.'" srcset="'.$image_srcset.'" sizes="(max-width: '.$max_width.') 100vw, '.$max_width.'"';
   }
}