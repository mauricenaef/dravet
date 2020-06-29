<?php
/**
 * Template name: Archive
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package dravet
 */
?>

<?php get_header(); ?>

<div id="primary" class="content-area container">
	<div class="columns">
	<main id="main" class="site-main is-12 column" role="main">
		
			<header class="entry-header">
			<h1 class="title is-1 entry-title"><?php _e('News & Events', 'dravet') ?></h1>
				
			</header><!-- .entry-header -->
			<div class="archives card_wrap">
			<?php 
				query_posts( array( 'posts_per_page' => -1, 'post_status' => 'publish' ) );
				if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'template-parts/content', 'post' ); ?>
				<?php endwhile; ?>
			</div>
			<?php else : ?>
				<?php get_template_part( 'template-parts/content', 'none' ); ?>
			<?php endif;
			 	wp_reset_query();
			 ?>

			<div class="section pagination">
				<div class="container is-narrow">
					<?php the_posts_navigation(); ?>
				</div>
			</div>
	</main><!-- #main -->
	</div>
</div><!-- #primary -->
<?php get_footer();?>