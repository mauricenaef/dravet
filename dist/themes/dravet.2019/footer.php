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
				<p>Vereinigung Dravet Syndrom<br />8000 Zürich<br /><a href="mailto:info@dravet.ch">info@dravet.ch</a></p>
				<br /><p>Spendenkonto:<br />85-599491-3<br />IBAN CH36 0900 0000 8559 9491 3</p>
			</div>
		</div>
		<div class="columns credits-container">
			<div class="column is-2">
				<?php 
				$logo_url = get_theme_mod('dravet_logo'); 
				?>
				<img src="<?php echo $logo_url; ?>">
			</div>
			<div class="column  is-marginless-mobile">
				<p class="is-small has-text-centered-mobile">© 2019 Dravet, alle Rechte vorbehalten, Angaben ohne gewähr</p>
			</div>
			<!-- <div class="columns is-10-mobile is-2-tablet is-centered" >
				<div class="column search-item level-item is-12-mobile is-marginless">
					<form >
						<div class="field">
							<p class="control has-icons-right">
								<input type="search" placeholder="Suchbegriff eingeben" class="input is-rounded is-small">
								<?php //svg_icon('search', 'icon is-small is-right'); ?>
							</p>
						</div>
					
					
					</form>
				</div>
			</div>
		</div> -->
	</div>	
</footer>
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
