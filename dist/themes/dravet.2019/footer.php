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
</div><!-- #content -->
<footer id="colophon" class="site-footer footer">
	<div class="container">
		<div class="columns">
			<div class="column is-7">
				<div class="columns">
					<div class="column is-half">
						<?php
							wp_nav_menu( array(
								'menu_class'     => 'footer-nav menu vertical',
								'theme_location' => 'footer-1',
							) );
						?>
					</div>
					<div class="column is-half">
						<?php
							wp_nav_menu( array(
								'menu_class'     => 'footer-nav menu vertical',
								'theme_location' => 'footer-2',
							) );
						?>
					</div>
				</div><!-- end first row -->
				<div class="columns">
					<div class="column is-half">
						<?php
							wp_nav_menu( array(
								'menu_class'     => 'footer-nav menu vertical',
								'theme_location' => 'footer-3',
							) );
						?>				
					</div>
					<div class="column is-half">
						<?php
							wp_nav_menu( array(
								'menu_class'     => 'footer-nav menu vertical',
								'theme_location' => 'footer-4',
							) );
						?>
					</div>
				</div><!-- end second row -->
				<div class="columns">
					<div class="column is-half">
						<?php
							wp_nav_menu( array(
								'menu_class'     => 'footer-nav menu vertical',
								'theme_location' => 'footer-5',
							) );
						?>
					</div>
					<div class="column is-half">
						<?php
							wp_nav_menu( array(
								'menu_class'     => 'footer-nav menu vertical',
								'theme_location' => 'footer-6',
							) );
						?>
					</div>
				</div>
			</div>
			<div class="column is-4 is-offset-1">
				<?php
					wp_nav_menu( array(
						'menu_class'     => 'footer-nav menu vertical',
						'theme_location' => 'footer-7',
					) );
				?>
				<br />
				<?php
					wp_nav_menu( array(
						'menu_class'     => 'footer-nav menu vertical',
						'theme_location' => 'footer-8',
					) );
				?>
				<br />
				<?php
					$lang = pll_current_language();
					echo wpautop( carbon_get_theme_option('footer_content_' . $lang ) ); 
				?>
			</div>
		</div>
		<div class="columns credits-container">
			<div class="column is-2">
				<?php 
				$logo_url = get_theme_mod('dravet_logo'); 
				?>
				<img src="<?php echo $logo_url; ?>">
			</div>
			<div class="column  is-marginless-mobile credits">
				<p class="is-small has-text-centered-mobile"><?php echo carbon_get_theme_option('footer_content_credits_' . $lang) ?></p>
				<a href="https://mauricenaef.ch" rel="noreferrer" class="credits-logo" title="Webdesign by mauricenaef.ch" target="_blank"><img src="https://mauricenaef.ch/externaldata/logo_icon.svg" width="24" height="24" title="Web Design by MAURICE NAEF webdesign" alt="Web Design by MAURICE NAEF webdesign" /></a>
			</div>
	</div>	
</footer>
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
