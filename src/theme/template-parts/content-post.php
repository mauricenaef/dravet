<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package dravet
 */

$attachment = carbon_get_the_post_meta( 'attachments' );

?>
<article id="post-<?php the_ID(); ?>" class="event-card">
    <div class="card has-boxshadow">
        <div class="card-image">
            <figure class="image">
				<?php if ( has_post_thumbnail() ): ?>
					<?php  the_post_thumbnail( 'card-header', ['class' => 'hero'] ); ?>
				<?php else : ?>
					<img src="<?php bloginfo('template_url') ?>/images/placeholder.png" class="hero" />
				<?php endif; ?>
            </figure>
        </div>
        <div class="card-content">
            <div class="media-content">
				<?php if( has_category(array('jahresberichte', 'newsletter', 'rapports-annuels', 'newsletter-fr')) && $attachment ) { ?>
				<a href="<?php echo wp_get_attachment_url($attachment[0]); ?>" class="title is-6 is-spaced"><?php the_title(); ?> <?php svg_icon('pdf-file') ?></a>
				<?php } else { ?>
				<a href="<?php the_permalink(); ?>" class="title is-6 is-spaced"><?php the_title(); ?></a>
				<?php } ?>
				<?php 
				
				
				if( in_category('events', 'evenements') ) {
					
					$event_date = carbon_get_the_post_meta( 'crb_event_start_date' );
					$fullday = carbon_get_the_post_meta( 'crb_full_day_event' );
					$map = carbon_get_the_post_meta( 'crb_company_location' );
					$gallery = carbon_get_the_post_meta( 'media_gallery' );

					$date_format = $fullday ? get_option('date_format') : 'j. F Y \u\m H:i \U\h\r';

					echo '<p class="subtitle is-7"><time datetime="' . date_i18n( 'c', $event_date ) . '"><strong>' . date_i18n($date_format, $event_date ) . '</strong></time></p>';
					
				
				} else {

					echo '<p class="subtitle is-7"><time datetime="' . get_the_date('c') . '">' . __('Publiziert am', 'dravet') . ' ' . get_the_date(get_option('date_format')) . '</time></p>';
				}
				
				
				?>                
			</div>
            <div class="content">
				<?php 
				if( is_single()) {
					the_content();
				} else {
					if($attachment) {
						$attachment_url = wp_get_attachment_url($attachment[0]);
						if( in_category('jahresberichte') || in_category('newsletter') && $attachment_url ) {
							echo '<a href="' . $attachment_url . '" class="button is-small is-link is-rounded">'. __('Download ', 'dravet') . get_svg_icon('pdf-file', 'is-small') .'</a>';
						} else {
							the_excerpt(); 
						}
					} else {
						the_excerpt(); 
					}
				}
				
				?>
            </div>
		</div>
		<div class="level card-footer">
			<div class="card-footer-item level-left">
				<?php  
				$cats = array();

					foreach (get_the_category(get_the_ID()) as $c) {
					$cat = get_category($c);
					array_push($cats, $cat->name);
					}
					
					if (sizeOf($cats) > 0) {
					$post_categories = implode(', ', $cats);
					} else {
					$post_categories = '';
					}
			
				
				
				?>
			</div>
			<div class="card-footer-item level-right">
				<?php echo ($post_categories != '') ? '<span class="tag is-small is-white-ter is-rounded">' . $post_categories . '</span>' : '<span>&nbsp;</span>'; ?>
			</div>
		</div>
    </div>
</article>