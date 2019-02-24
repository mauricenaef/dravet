<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package dravet
 */

get_header(); ?>

	<div id="primary" class="grid-container grid-x grid-padding-y">
		<main id="main" class="site-main medium-8 medium-offset-2 cell text-center">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

			endwhile; // End of the loop.
			?>
		</main><!-- #main -->
		
	</div><!-- #primary -->
<?php
get_footer();
