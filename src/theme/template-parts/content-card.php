<?php
/**
 * Card Item
 */

?>
<div class="column is-4">
    <div class="card has-boxshadow">
        <div class="card-image">
            <figure class="image ">
                <?php echo wp_get_attachment_image( 222, 'card-header', false, array( 'class' => 'hero' ) ); ?>
            </figure>
        </div>
    <div class="card-content">
    <div class="media-content">
        <p class="title is-6"><?php the_title(); ?></p>
        <p class="subtitle is-6"><time datetime="2016-1-1">Donnerstag, 28.02.2019</time></p>
        
    </div>
        <div class="content">
            <?php the_excerpt(); ?>
        </div>
    </div>
    <div class="card-footer-item level-right">
        <?php svg_icon('navigation-menu-vertical', 'level-right'); ?>
    </div>
<div>
 