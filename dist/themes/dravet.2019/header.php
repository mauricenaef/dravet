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
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="<?php bloginfo( 'description' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<meta name="author" content="MAURICE NAEF webdesign" />
	<meta name="Copyright" content="Copyright <?php echo date('Y') ?>, alle Rechte vorbehalten | Konzept, Design und Umsetzung von MAURICE NAEF webdesign, https://mauricenaef.ch" />
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
	<!-- Code snippet to speed up Google Fonts rendering: googlefonts.3perf.com -->
	<link rel="dns-prefetch" href="https://fonts.gstatic.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="anonymous">
	<link rel="preload" href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600i,800" as="fetch" crossorigin="anonymous">
	<script type="text/javascript">
	!function(e,n,t){"use strict";var o="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600i,800",r="__3perf_googleFontsStylesheet";function c(e){(n.head||n.body).appendChild(e)}function a(){var e=n.createElement("link");e.href=o,e.rel="stylesheet",c(e)}function f(e){if(!n.getElementById(r)){var t=n.createElement("style");t.id=r,c(t)}n.getElementById(r).innerHTML=e}e.FontFace&&e.FontFace.prototype.hasOwnProperty("display")?(t[r]&&f(t[r]),fetch(o).then(function(e){return e.text()}).then(function(e){return e.replace(/@font-face {/g,"@font-face{font-display:swap;")}).then(function(e){return t[r]=e}).then(f).catch(a)):a()}(window,document,localStorage);
	</script>
	<!-- End of code snippet for Google Fonts -->

</head>

<body <?php body_class('site'); ?>>

	<a class="skip-link show-for-sr" href="#content"><?php esc_html_e( 'Skip to content', 'dravet' ); ?></a>

	<header class="site-header" role="banner">
		<div class="grid-container grid-x grid-padding-x grid-padding-y align-middle">
			<div class="site-branding small-8 medium-2 cell">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo" rel="home">
					<?php the_custom_logo(); ?>
				</a>
			</div><!-- .site-branding -->
			<div class="auto cell">
				<nav id="site-navigation" class="site-nav">
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'dravet' ); ?></button>
					<?php
						wp_nav_menu( array(
							'menu_class'     => 'main-nav menu',
							'theme_location' => 'primary',
						) );
					?>
				</nav>
			</div>
		</div>
	</header>

	<div id="content" class="site-content">
