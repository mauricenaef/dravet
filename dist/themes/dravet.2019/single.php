<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package dravet
 */

 // get the featured image by defining some variables to print below.
$featured_image = get_post_thumbnail_id();
$featured_image_size = 'hero'; // Set to custom size set in functions.php
$featured_image_alt = get_post_meta($featured_image, '_wp_attachment_image_alt', true);



get_header(); ?>
<?php if( !empty($featured_image) ): ?>
		<figure <?php post_class('featured-image');?>>
			<img <?php dravet_responsive_image($featured_image, $featured_image_size,'1260px'); ?><?php echo 'alt="' . $featured_image_alt . '"';?> />
		</figure>
<?php endif; ?>
<div id="primary" class="content-area container">
	<div class="columns">
		<main id="main" class="site-main is-8 column" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
				<?php
				
				get_template_part( 'template-parts/content', 'page' ); 
				
				?>
				<div class="container is-narrow">
					<?php dravet_the_post_navigation();?>
				</div>
				<?php endwhile; ?>
			</main><!-- #main -->
			<?php get_sidebar(); ?>
	</div>
</div><!-- #primary -->
<?php get_footer(); ?>
