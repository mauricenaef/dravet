<?php
/**
 * Template part for displaying page content
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package dravet
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="content">
		<header class="entry-header">
			<?php the_title( '<h1 class="title is-1 entry-title">', '</h1>' ); ?>
		</header><!-- .entry-header -->

		<div class="content entry-content">
			<?php the_content();?>

			<?php
			$pdf_attachment = get_post_meta( get_the_ID(), '_attachments', true);
			
			if($pdf_attachment) {
				echo 'download';
				print_r($pdf_attachment);
			}
			?>
			
			<?php wp_link_pages( array(
				'before' => '<div class="page-links level">' . esc_html__( 'Pages:', 'dravet' ),
				'after'  => '</div>',
				) ); ?>

			</div><!-- .entry-content -->

			<?php if ( get_edit_post_link() ) : ?>
				<footer class="entry-footer">
					<?php
					edit_post_link(
						sprintf(
							/* translators: %s: Name of current post */
							esc_html__( 'Edit %s', 'dravet' ),
							the_title( '<span class="screen-reader-text">"', '"</span>', false )
							),
						'<span class="edit-link">',
						'</span>'
						);
						?>
					</footer><!-- .entry-footer -->
				<?php endif; ?>
			</div>
		</article><!-- #post-## -->
