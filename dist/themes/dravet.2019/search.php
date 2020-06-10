<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package dravet
 */

global $wp_query;
$count =  $wp_query->post_count;

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
					<p><?php echo $count . ' ' .  __('Artikel / Seiten gefunden.', 'dravet') ?></p>
				</header><!-- .page-header -->
				<div class="card_wrap">
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'template-parts/content', 'post' ); ?>
					<?php endwhile; ?>
				</div>
			</div>
		<?php else: ?>
			<?php get_template_part( 'template-parts/content', 'none' ); ?>
		<?php endif; ?>
		</main><!-- #main -->
	</div>
</div><!-- #primary -->
<?php get_footer(); ?>
