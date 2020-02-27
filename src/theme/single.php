<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package dravet
 */

get_header(); ?>

<div id="primary" class="content-area container">
	<div class="columns">
		<main id="main" class="site-main is-8 column" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'template-parts/content', 'post' ); ?>
				<div class="container is-narrow">
					<?php the_post_navigation();?>
				</div>
				<?php endwhile; ?>
			</main><!-- #main -->
			<?php get_sidebar(); ?>
	</div>
</div><!-- #primary -->
<?php get_footer(); ?>
