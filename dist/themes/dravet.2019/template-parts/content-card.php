<?php
/**
 * Card Item
 */

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
				<?php
					if(is_single()) {
				?>
				<h1 class="title is-6 is-spaced"><?php the_title(); ?></h1>
				<?php		
					} else {
				?>
				<a href="<?php the_permalink(); ?>" class="title is-6 is-spaced"><?php the_title(); ?></a>
				<?php
				}
				
				
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
				<?php  the_excerpt(); ?>
            </div>
		</div>
		<div class="level">
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
				$post_categories = 'Not Assigned';
				}
				
				
				?>
			</div>
			<div class="card-footer-item level-right">
				<?php echo '<span class="tag is-small is-white-ter is-rounded">' . $post_categories . '</span>'; ?>
			</div>
		</div>
    </div>
</article>