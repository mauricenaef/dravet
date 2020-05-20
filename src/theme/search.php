<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package dravet
 */
get_header(); ?>

<div id="primary" class="content-area container">
	<div class="columns">
		<main id="main" class="site-main column" role="main">
		<?php if ( have_posts() ) : ?>
			<div class="container">
				<header class="page-header content wrapper">
					<h1 class="title is-2 page-title">
						<?php printf( esc_html__( 'Suchergebnisse für %s', 'dravet' ), '<span class="">' . get_search_query() . '</span>' ); ?>
					</h1>
				</header><!-- .page-header -->
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'template-parts/content', 'post' ); ?>
				<?php endwhile; ?>
				<?php the_posts_navigation(); ?>
			</div>
		<?php else: ?>
			<?php get_template_part( 'template-parts/content', 'none' ); ?>
		<?php endif; ?>
		</main><!-- #main -->
	</div>
</div><!-- #primary -->
<?php get_footer(); ?>
