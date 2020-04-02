<?php
/**
 * News Item
 */

?>
<aricle class="media">
    <div class="media-left">
    <?php 
        if ( has_post_thumbnail() ) {
            the_post_thumbnail(array('230', '220'), false, array( 'class' => 'hero' ));
        }
        else {
            echo wp_get_attachment_image( 221,array('230', '220'), false, array( 'class' => 'hero' ) );
        }
    ?>
    </div>
    <div class="media-content">
        <h3 class="title is-size-6 has-text-grey"><?php the_title(); ?></h3>
        <?php the_excerpt(); ?>
    </div>
</article>