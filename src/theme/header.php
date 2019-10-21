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
</head>

<body <?php body_class(); ?>>
	<div id="page" class="site is-clipped">
		<?php bulmastarter_skip_link_screen_reader_text(); ?>
		<header id="header" class="site-header container">
			<div class="columns is-hidden-mobile">
				<div class="column is-4 is-offset-8">
					<div class="top-nav level is-mobile">
						<a href="#" class="level-item"><strong>DE</strong></a>
						<a href="#" class="level-item">FR</a>
						<a href="#" class="level-item divider-right">IT</a>
						<a href="#" class="level-item">Mitgliederbereich</a>
						<a href="#" class="level-item">Kontakt</a>
					</div>
				</div>
			</div>
			<div class="columns">
				<nav id="site-navigation" class="navbar" role="navigation">
					<div class="navbar-brand column is-2-tablet is-3-desktop">
						<?php bulmastarter_home_link('navbar-item'); ?>
						<?php bulmastarter_menu_toggle(); ?>
					</div>
					<div class="navbar-menu">
						<?php bulmastarter_navigation(); ?>
					</div>
					<div class="navbar-search is-hidden-mobile">
						<?php svg_icon('search'); ?>
					</div>
				</nav>
			</div>
		</header>
		<div id="content" class="site-content">