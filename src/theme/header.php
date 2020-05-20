<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package dravet
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> class="is-fullheight">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="<?php bloginfo( 'description' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<meta name="author" content="MAURICE NAEF webdesign" />
	<meta name="Copyright" content="Copyright <?php echo date('Y') ?>, alle Rechte vorbehalten | Konzept, Design und Umsetzung von MAURICE NAEF webdesign, https://mauricenaef.ch" />
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@glidejs/glide" ></script>
</head>

<body <?php body_class(); ?>>
	<div id="page" class="site is-clipped">
		<?php bulmastarter_skip_link_screen_reader_text(); ?>
		<header id="header" class="site-header">
			<div class="header-top level is-hidden-mobile">
				<div class="level-left">
					<?php bulmastarter_home_link('is-hidden-mobile'); ?>					
				</div>
				<div class="level-right">
					<div class="top-nav level is-mobile">
						<?php
						$languages = pll_the_languages( array( 'raw' => 1 ) );
						$item = '';
						if($languages) {
							foreach($languages as $language) {
								$class = in_array( 'current-lang', $language['classes']) ? ' current_lang' : '';
								echo '<a href="' . $language['url'] . '" class="level-item languages'. $class .'">' . $language['slug'] . '</a>';
							}
						}												
						?>
						<?php wp_nav_menu( array( 'theme_location' => 'header', 'container' => false, 'menu_class' => 'header-menu',) ); ?>
						<?php //echo do_shortcode("[woo_cart_but]"); ?>
						<?php if (is_user_logged_in()) : ?>
							<a href="<?php echo wp_logout_url(get_permalink()); ?>"><?php svg_icon('logout'); ?> Logout</a>
						<?php else : ?>
							<a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Mitgliederbereich' ) ) ); ?>"><?php svg_icon('user'); ?> Login</a>
						<?php endif;?>
					</div>
				</div>
			</div>
			<div class="columns">
				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			</div>
		</header>
		<div id="content" class="site-content">