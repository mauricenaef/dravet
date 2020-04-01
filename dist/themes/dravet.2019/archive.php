<?php
/**
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
	<main id="main" class="site-main is-8 column" role="main">
		<?php if ( have_posts() ) : ?>
			<header class="entry-header">
				<?php the_archive_title( '<h1 class="title is-1 entry-title">', '</h1>' ); ?>
				<?php the_archive_description( '<div class="subtitle archive-description is-6">', '</div>' ); ?>
			</header><!-- .entry-header -->
			<div class="archives card_wrap">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'template-parts/content', 'post' ); ?>
				<?php endwhile; ?>
			</div>
			
			<div class="section pagination">
				<div class="container is-narrow">
					<?php the_posts_navigation(); ?>
				</div>
			</div>
		<?php else : ?>
			<?php get_template_part( 'template-parts/content', 'none' ); ?>
		<?php endif; ?>
	</main><!-- #main -->
	<?php get_sidebar('blog'); ?>
	</div>
</div><!-- #primary -->
<?php get_footer();?>