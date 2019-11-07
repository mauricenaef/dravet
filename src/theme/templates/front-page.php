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
				<?php bulmastarter_get_comments(); ?>
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
                        <h3 class="title is-bold is-size-6">Wie Ihre Spende Kindern hilft</h3> 
                        <p class="is-size-7">Wir sind ein gemeinnütziger Verein, der auf Spenden angewiesen ist. Durch Ihre Unterstützung helfen SIe uns, die Lebensqualität der Betroffenen zu verbessern sowie das Alltagsleben der Beteiligten zu vereinfachen.</p>
                        <p><a href="#" class="button is-button is-primary">Spenden</a></p>
                        <hr class="is-ruler">
                        <small class="has-text-weight-light has-text-grey ">Ihre regelmässige Spende erlaubt uns, Gelder langfristig einzusetzen. Spenden können in der Schweiz von den Steuern abgezogen werden.</small>
                    </div>

                </div>
            </div>
        </aside>
	</div>
</div><!-- #primary -->
<nav class="section quick-links has-background-primary">
    <div class="glide">
        <div class="glide__track" data-glide-el="track">
            <?php
			    wp_nav_menu( array(
				    'menu_class'     => 'glide__slides',
                    'theme_location' => 'quicklinks',
                    'container'       => '',
				) );
			?>
        </div>
    </div>
</nav>
<section class="section news-section">
    <div class="container">
        <h1 class="title is-size-7">Aktuell &middot; Medienberichte</h1>
        <div class="columns">

            <div class="column is-7">
                <div class="box is-borderless is-paddingless">
                    <article class="media">
                        <div class="media-left">
                        <?php echo wp_get_attachment_image( 221,array('230', '220'), false, array( 'class' => 'hero' ) ); ?>
                        </div>
                        <div class="media-content">
                            <h3 class="title is-size-6 has-text-grey">Andrea Dietrich zu Gast bei Radio Fribourg</h3>
                            <p>Vor neun Jahren wurde Andrea Dietrichs Leben auf den Kopf gestellt. Bei ihrer Tochter Milla, die damals noch ein Baby war, wurde das Dravet-Syndrom diagnostiziert. Dabei handelt es sich um eine seltene und schwere Form von Epilepsie. <a href="" class="is-bold">&hellip; mehr</a></p>
                        </div>
                    </article>
                </div>
            </div>
            
            <div class="column is-offset-1">
                <a href="#" class="button is-primary is-small is-round">Alle News &amp; Events <?php svg_icon('chev-right', 'is-small') ?></a>
                <div class="gallery">
                    <?php echo wp_get_attachment_image( 238, array('60', '60'), false, array( 'class' => 'hero' ) ); ?>
                    <?php echo wp_get_attachment_image( 231, array('60', '60'), false, array( 'class' => 'hero' ) ); ?>
                    <?php echo wp_get_attachment_image( 232, array('60', '60'), false, array( 'class' => 'hero' ) ); ?>
                    <?php echo wp_get_attachment_image( 233, array('60', '60'), false, array( 'class' => 'hero' ) ); ?>
                    <?php echo wp_get_attachment_image( 234, array('60', '60'), false, array( 'class' => 'hero' ) ); ?>
                </div>
            </div>

        </div>
    </div>
</section>
<section class="section mixed-section has-background-light">
    <div class="container">
        <h1 class="title is-size-7">Mixed Content</h1>
    </div>
</section>
<section class="section events-section cards-section">
    <div class="container">
        <h1 class="title is-size-7">Veranstaltungen</h1>
        <div class="columns">
            <div class="column is-4">
                <div class="card has-boxshadow">
                    <div class="card-image">
                        <figure class="image ">
                            <?php echo wp_get_attachment_image( 222, 'seven-sixty', false, array( 'class' => 'hero' ) ); ?>
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="media-content">
                            <p class="title is-6">Tag der seltenen Krankheiten</p>
                            <p class="subtitle is-6"><time datetime="2016-1-1">Donnerstag, 28.02.2019</time></p>                </div>
                        <div class="content">
                            <p>Einmal jährlich lädt ProRaris alle vom Thema betroffenen Akteure ein zu einem Tag der Begegnung, des Gesprächs und des Informationsaustauschs.</p>
                        </div>
                    </div>
                    <div class="card-footer-item level-right">
                        <?php svg_icon('navigation-menu-vertical', 'level-right'); ?>
                    </div>
                </div>
            </div>
            <div class="column is-4">
                <div class="card has-boxshadow">
                    <div class="card-image">
                        <figure class="image ">
                            <?php echo wp_get_attachment_image( 200, 'seven-sixty', false, array( 'class' => 'hero' ) ); ?>
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="media-content">
                            <p class="title is-6">Nationales Jahrestreffen</p>
                            <p class="subtitle is-6"><time datetime="2016-1-1">Mittwoch, 11.05.2019</time></p>                </div>
                        <div class="content">
                            <p>Unter der Eltern-Kind Beziehung versteht man die soziale und emotionale Beziehung zwischen einem Elternteil und dem eigenen Kind.</p>
                        </div>
                    </div>
                    <div class="card-footer-item level-right">
                        <?php svg_icon('navigation-menu-vertical', 'level-right'); ?>
                    </div>
                </div>
            </div>
            <div class="column is-4">
                <div class="card has-boxshadow">
                    <div class="card-image">
                        <figure class="image ">
                            <?php echo wp_get_attachment_image( 208, 'seven-sixty', false, array( 'class' => 'hero' ) ); ?>
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="media-content">
                            <p class="title is-6">Internationaler Dravet- Syndrom Tag</p>
                            <p class="subtitle is-6"><time datetime="2016-1-1">Donnerstag, 28.02.2019</time></p>                </div>
                        <div class="content">
                            <p>Am Samstag, 9. Juni 2018 fand auf dem Landgasthof Rütihof (AG) zum dritten Mal das Schweizer Dravet Jahrestreffen statt.</p>
                        </div>
                    </div>
                    <div class="card-footer-item level-right">
                        <?php svg_icon('navigation-menu-vertical', 'level-right'); ?>
                    </div>
                </div>
            </div>
            <div class="column is-4">
                <div class="card has-boxshadow">
                    <div class="card-image">
                        <figure class="image ">
                            <?php echo wp_get_attachment_image( 207, 'seven-sixty', false, array( 'class' => 'hero' ) ); ?>
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="media-content">
                            <p class="title is-6">Regionaltreffen Deutschschweiz</p>
                            <p class="subtitle is-6"><time datetime="2016-1-1">Donnerstag, 09.03.2019</time></p>                </div>
                        <div class="content">
                            <p>Einmal jährlich lädt ProRaris alle vom Thema betroffenen Akteure ein zu einem Tag der Begegnung, des Gesprächs und des Informationsaustauschs.</p>
                        </div>
                    </div>
                    <div class="card-footer-item level-right">
                        <?php svg_icon('navigation-menu-vertical', 'level-right'); ?>
                    </div>
                </div>
            </div>
            <div class="column is-4">
                <div class="card has-boxshadow">
                    <div class="card-image">
                        <figure class="image ">
                            <?php echo wp_get_attachment_image( 158, 'seven-sixty', false, array( 'class' => 'hero' ) ); ?>
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="media-content">
                            <p class="title is-6">Run for a cure</p>
                            <p class="subtitle is-6"><time datetime="2016-1-1">Mittwoch, 05.10.2019</time></p>                </div>
                        <div class="content">
                            <p>Unter der Eltern-Kind Beziehung versteht man die soziale und emotionale Beziehung zwischen einem Elternteil und dem eigenen Kind.</p>
                        </div>
                    </div>
                    <div class="card-footer-item level-right">
                        <?php svg_icon('navigation-menu-vertical', 'level-right'); ?>
                    </div>
                </div>
            </div>
            
            
           
        </div>        
    </div>
</section>
<?php echo dravet_sponsor(); ?>
<?php get_footer(); ?>