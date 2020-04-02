<?php
/**
 * Template name: Front Page
 *
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bulma
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
		<main id="main" class="site-main is-7 column" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
                <?php get_template_part( 'template-parts/content' ); ?>
			<?php endwhile; ?>
		</main><!-- #main -->
		<aside id="secondary" class="is-4 is-offset-1 column" role="complementary">
            <div class="card has-radius-large has-text-centered has-boxshadow">
                <div class="card-image">
                    <figure class="three-stack">
                        <?php echo wp_get_attachment_image( 233, array('80', '80'), false, array( 'class' => 'round' ) ); ?>
                        <?php echo wp_get_attachment_image( 248, array('80', '80'), false, array( 'class' => 'round' ) ); ?>
                        <?php echo wp_get_attachment_image( 202, array('80', '80'), false, array( 'class' => 'round' ) ); ?>
                    </figure>
                </div>
                <div class="card-content ">
                    <div class="content">
                        <?php 
                            $cta_title = carbon_get_the_post_meta( 'spenden_titel' );
                            $cta_content = carbon_get_the_post_meta( 'spenden_content' );
                            $cta_info = carbon_get_the_post_meta( 'spenden_info' );

                            if($cta_title) {
                                echo '<h3 class="title is-bold is-size-6">' . $cta_title . '</h3>';
                            }
                            if($cta_content) {
                                echo '<div class="is-size-7">' . wpautop($cta_content) . '</div>';
                            }
                            if($cta_info) {
                                echo '<hr class="is-ruler"><small class="has-text-weight-light has-text-grey ">' . $cta_info . '</small>';
                            }
                        ?>
                    </div>

                </div>
            </div>
        </aside>
	</div>
</div><!-- #primary -->
<nav class="section quick-links has-background-primary">
    <div class="glide glide_nav">
        <div class="glide__track" data-glide-el="track">
            <?php
			    wp_nav_menu( array(
				    'menu_class'     => 'glide__slides',
                    'theme_location' => 'quicklinks',
                    'container'       => '',
				) );
			?>
        </div>
        <div data-glide-el="controls">
            <button class="glide__arrow glide__arrow--right" data-glide-dir="<"><?php svg_icon('chev-right'); ?></button>
            <button class="glide__arrow glide__arrow--left" data-glide-dir=">"><?php svg_icon('chev-left'); ?></button>
        </div>
    </div>
</nav>

<?php
$news_category = carbon_get_the_post_meta('news_category');
$custom_cat =  $news_category[0]['id'];
$term_data = get_term_by( 'id', absint( $custom_cat ), 'category' );
$term_name = $term_data->name;
$archive_url = carbon_get_the_post_meta('news_link');
$news_gallery = carbon_get_the_post_meta('news_gallery');

//print_r($news_gallery);

?>
<section class="section news-section">
    <div class="container">
        <h1 class="title is-size-7"><?php _e('Aktuell', 'dravet'); ?> &middot; <?php echo $term_name; ?></h1>
        <div class="columns is-multiline">

            <div class="column is-7">
                <div class="box is-borderless is-paddingless">
                    <?php
                    $post_list = get_posts( array(
                        'category' => $custom_cat,
                        'posts_per_page' => 1
                    ) );
                    
                    if( $post_list ) {
                        foreach ($post_list as $post) {
                            get_template_part('template-parts/news', 'preview');
                        }
                        wp_reset_postdata();
                    }
                    ?>

                </div>
            </div>
            <div class="column is-offset-1">
                <a href="<?php echo $archive_url['url']; ?>" class="button is-primary is-small is-rounded"><?php _e('Alle', 'dravet'); ?> <?php echo $archive_url['anchor'] ?> <?php svg_icon('chev-right', 'is-small') ?></a>
                <?php
                if($news_gallery) {
                    echo '<div class="gallery">';
                    foreach ($news_gallery as $item) {
                        echo wp_get_attachment_image( $item, array('60', '60'), false, array( 'class' => 'hero' ) );
                    }
                    echo '</div>';
                }
                ?> 
            </div>

        </div>
    </div>
</section>
<section class="section mixed-section has-background-light">
    <div class="container">
        <h1 class="title is-size-7 is-hidden"><?php _e('Mixed Content', 'dravet'); ?></h1>
        <div class="columns">
            <div class="column is-6">
                <div class="card has-boxshadow">
                    <div class="card-content">
                        <?php echo wpautop(carbon_get_the_post_meta('mixed_content')); ?>
                    </div>
                    <?php dravet_faq();  ?>
                </div>
            </div>
            <div class="column is-4 is-offset-2">
                <h3 class="title is-size-6"><?php _e('Vorstand', 'dravet'); ?></h3>
                <?php 
                    $args_users = array(
                        'role'    => 'Vorstand',
                        'orderby' => 'user_nicename',
                        'order'   => 'ASC'
                    );
                    $users = get_users( $args_users );

                if($users) {
                ?>
                <!-- user slider -->
                <div class="card has-text-centered has-boxshadow card-image-peak">
                    <div class="glide glide_profile">
                        <div class="glide__track" data-glide-el="track">
                            <ul class="glide__slides">
                                <?php foreach ( $users as $user ) { 
                                    $profilbild = carbon_get_user_meta( $user->ID, 'profil_bild' );
                                    $funktion = carbon_get_user_meta( $user->ID, 'profil_funktion_' . (pll_current_language('slug')) );  
                                ?>
                                <li class="glide__slide">
                                    <div class="card-image">
                                        <?php echo wp_get_attachment_image( $profilbild, array('100', '100'), false, array( 'class' => 'round' ) ); ?>
                                    </div>
                                    <div class="card-content">
                                        <h3 class="title is-size-6"><?php echo esc_html( $user->display_name ); ?></h3>
                                        <h4 class="subtitle is-size-7"><?php echo $funktion; ?></h4>
                                        <p><a class="button is-rounded is-primary is-small"><?php _e('Profil Ansehen', 'dravet'); ?></a></p>
                                    </div>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="glide__bullets" data-glide-el="controls[nav]">
                            <?php 
                            $i = 0;
                            foreach ( $users as $user ) { 
                                echo '<button class="glide__bullet" data-glide-dir="=' . $i . '"></button>';
                                $i++;
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <!-- end user slider-->
                <br>
                <br>
                <br>
                <br>
                <br>
                <section>
                    <h3 class="title is-size-6"><?php _e('Jahresberichte', 'dravet'); ?></h3>
                    <?php
                        global $post; // required
                        $args_berichte = array('category_name' => 'Jahresberichte');
                        $custom_posts_berichte = get_posts($args_berichte);
                        if($custom_posts_berichte) {
                        echo '<ul class="download-list is-size-6">';
                        foreach($custom_posts_berichte as $post) : setup_postdata($post);
                        $pdf_url = carbon_get_the_post_meta( 'attachments' );
                        echo '<li><a href="' . wp_get_attachment_url($pdf_url[0]) . '" class="is-size-7">' . get_svg_icon('pdf-file') . ' ' . get_the_title() . '  (2.3 Mb)</a></li>';
                        endforeach;
                        echo '</ul>';
                        }
                        wp_reset_postdata();

                        $download_link = carbon_get_post_meta( get_the_ID(),  'mixed_downloads' );
                        //print_r($download_link);
                    ?>
                    <a href="<?php echo $download_link['url']; ?>" class="button is-link is-size-7 is-rounded is-small"><?php _e('zu den Downloads', 'dravet'); ?> <?php svg_icon('chev-right', 'is-small') ?></a>
                </section>

            </div>
        </div>
    </div>
</section>
<section class="section events-section cards-section">
    <div class="container">
        <h1 class="title is-size-6 is-bold"><?php _e('Zukünftige Veranstaltungen', 'dravet') ?></h1>
        <?php 
            global $post;
            $event_date = carbon_get_the_post_meta( 'crb_event_start_date' );
            $today = date('U');
				
				$args = array (
                    'post_type'             => 'post',
                    'category_name'         => 'events',
					'orderby' 				=> 'meta_value',
					'order'					=> 'asc', 
					'meta_query'            => array(
						array(
							'key'       => '_crb_event_start_date',
							'value' 	=> $today,
							'compare'   => '>=',
							'type'      => 'NUMERIC',
						),
					),
				);
				
        ?>
        <div class="card_wrap">
           <?php
           // The Query Future Events
           $query = new WP_Query( $args );
           if ( $query->have_posts() ) {
                   while ( $query->have_posts() ) {
                       $query->the_post();
                       get_template_part( 'template-parts/content', 'post' );
                   }
           } else {
               echo '<h3>Keine Auftritte</h3>';
           }
           wp_reset_postdata();
           ?>
        </div>
        <hr class="spacer" />
        <h1 class="title is-size-6 is-bold"><?php _e('Vergangene Veranstaltungen', 'dravet') ?></h1>
        <?php 
            
				
				$args2 = array (
                    'post_type'             => 'post',
                    'category_name'              => 'events',
					'orderby' 				=> 'meta_value',
					'order'					=> 'asc', 
					'meta_query'            => array(
						array(
							'key'       => '_crb_event_start_date',
							'value' 	=> $today,
							'compare'   => '<',
							'type'      => 'NUMERIC',
						),
					),
				);
				
        ?>
        <div class="card_wrap">
           <?php
           // The Query Future Events
           $query2 = new WP_Query( $args2 );
           if ( $query2->have_posts() ) {
                   while ( $query2->have_posts() ) {
                       $query2->the_post();
                       get_template_part( 'template-parts/content', 'post' );
                   }
           } else {
               echo '<h3>Keine Auftritte</h3>';
           }
           wp_reset_postdata();
           ?>
        </div>
    </div>
</section>
<?php echo dravet_sponsor(); ?>
<?php get_footer(); ?>