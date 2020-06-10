<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package dravet
 */
?>

<section class="no-results not-found">
	<div class="container content">
		<header class="page-header">
			<h1 class="page-title"><?php esc_html_e( 'Nichts gefunden', 'dravet' ); ?></h1>
		</header><!-- .page-header -->
		<div class="content page-content">
			<?php
			if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			

		<?php elseif ( is_search() ) : ?>

			<p><?php esc_html_e( '
Entschuldigung, aber nichts stimmte mit Ihren Suchbegriffen überein. Bitte versuchen Sie es erneut mit verschiedenen Schlüsselwörtern.', 'dravet' ); ?></p>
			<?php
			get_search_form();

			else : ?>

			<p><?php esc_html_e( '
Anscheinend können wir nicht finden, wonach Sie suchen. Vielleicht kann die Suche helfen.', 'dravet' ); ?></p>
			<?php
			get_search_form();

			endif; ?>
		</div><!-- .page-content -->
	</div>
</section><!-- .no-results -->
