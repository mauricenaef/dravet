<?php
/**
 * dravet functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package dravet
 */
$release_date = "2019/10/31";
$days_to_add = 31;


require get_template_directory() . '/functions/theme_navwalker.php';
require get_template_directory() . '/functions/theme_helpers.php';
require get_template_directory() . '/functions/theme_custom_query.php';

require get_template_directory() . '/functions/theme_custom_widget_article_navigation.php';



if ( ! function_exists( 'bulmastarter_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */

add_theme_support( 'menus' );

function bulmastarter_setup() {
	require get_template_directory() . '/functions/base.php';
	require get_template_directory() . '/functions/admin.php';
	require get_template_directory() . '/functions/dashboard.php';
	require get_template_directory() . '/functions/post-thumbnails.php';
	require get_template_directory() . '/functions/navigation.php';
	require get_template_directory() . '/functions/content.php';
	require get_template_directory() . '/functions/pagination.php';
	require get_template_directory() . '/functions/widgets.php';
	require get_template_directory() . '/functions/search.php';
	require get_template_directory() . '/functions/login.php';
	require get_template_directory() . '/functions/images.php';
	require get_template_directory() . '/functions/scripts-styles.php';

	require get_template_directory() . '/functions/admin-carbon-fields.php';
	require get_template_directory() . '/functions/admin-settings.php';
	require get_template_directory() . '/functions/admin-brands.php';
	require get_template_directory() . '/functions/admin-faq.php';

	require get_template_directory() . '/functions/admin-woocommerce.php';
}
endif;
add_action( 'after_setup_theme', 'bulmastarter_setup' );

require get_template_directory() . '/functions/template-tags.php';
require get_template_directory() . '/functions/extras.php';
require get_template_directory() . '/functions/customizer.php';
