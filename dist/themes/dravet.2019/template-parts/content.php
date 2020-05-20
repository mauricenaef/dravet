<?php
/**
 * Template part for displaying content
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package dravet
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="container-d">
		<header class="content">
			<?php if ( is_front_page()) :?>
			<?php elseif ( is_single() ) : ?>
				<?php bulmastarter_the_title('is-1', FALSE); ?>
			<?php elseif ( 'page' === get_post_type() ) : ?>
				<?php bulmastarter_the_title('is-1', FALSE); ?>
			<?php else : ?>
				<?php bulmastarter_the_title('is-1'); ?>
			
			<?php endif; ?>
			<?php if ( 'post' === get_post_type() ) : ?>
				<div class="subtitle is-6">
					<?php bulmastarter_posted_on(); ?>
				</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<div class="content entry-content">
			<?php the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses(
					__( 'Weiterlesen %s <span class="meta-nav">&rarr;</span>', 'dravet' ),
					array(
						'span' => array(
							'class' => array()
							)
						)
					),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
				)
			);

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Seiten:', 'dravet' ),
				'after'  => '</div>',
				) );
				?>
			</div><!-- .entry-content -->

			<footer class="card-footer-item content entry-footer">
				<?php bulmastarter_entry_footer(); ?>
			</footer><!-- .entry-footer -->
		</div>
	</article><!-- #post-## -->
