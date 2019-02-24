<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package dravet
 */

?>

	</div>

	<footer id="colophon" class="site-footer">
		<div class="grid-container">
			<div class="grid-x grid-padding-x grid-padding-y small-up-2 medium-up-4 large-up-6">
				<div class="cell">
				<?php
					wp_nav_menu( array(
						'menu_class'     => 'footer-nav menu vertical',
						'theme_location' => 'footer-1',
					) );
				?>
				</div>
				<div class="cell">
				<?php
					wp_nav_menu( array(
						'menu_class'     => 'footer-nav menu vertical',
						'theme_location' => 'footer-2',
					) );
				?>
				</div>
				<div class="cell">
				<?php
					wp_nav_menu( array(
						'menu_class'     => 'footer-nav menu vertical',
						'theme_location' => 'footer-3',
					) );
				?>
				</div>
				<div class="cell">
				<?php
					wp_nav_menu( array(
						'menu_class'     => 'footer-nav menu vertical',
						'theme_location' => 'footer-4',
					) );
				?>
				</div>
				<div class="cell">
				<?php
					wp_nav_menu( array(
						'menu_class'     => 'footer-nav menu vertical',
						'theme_location' => 'footer-5',
					) );
				?>
				</div>
				<div class="cell">
					<p class="copyright">© <?php bloginfo( 'name' ); ?> - <?php echo date('Y'); ?></p>
				</div>
			</div>
		</div>
	</footer>

<?php wp_footer(); ?>

</body>
</html>
