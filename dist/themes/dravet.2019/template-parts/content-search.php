<?php
/**
 * Template part for displaying search
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package dravet
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('wrapper'); ?>>
	<div class="container content">
		<header class="entry-header">
			<?php bulmastarter_the_title('is-3'); ?>
			<?php if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta">
					<?php bulmastarter_posted_on(); ?>
				</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
		<footer class="entry-footer">
			<?php bulmastarter_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	</div>
</article><!-- #post-## -->
