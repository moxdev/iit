<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package MM4 You
 */

?>

		</div><!-- .wrapper -->
		<?php if( function_exists('mm4_you_highlight_boxes') ) {
			mm4_you_highlight_boxes();
		} ?>
			
		<?php if( is_page_template('frontpage-a.php') || is_page_template('frontpage-b.php') ) {
			if( function_exists('mm4_you_add_quick_contact_form') ) {
				mm4_you_add_quick_contact_form();
			} 
		} ?>
	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="wrapper">
			<?php if( is_page_template('frontpage-b.php') ) {
				$ph = get_theme_mod('setting_phone');
				$fb = get_theme_mod('setting_facebook');
				$tw = get_theme_mod('setting_twitter');
				$goo = get_theme_mod('setting_google');
				$li = get_theme_mod('setting_linked_in');
				$yt = get_theme_mod('setting_you_tube');
				if($fb || $tw || $goo || $li || $yt) { ?>
				<ul class="social-media">
					<?php if($fb): ?><li><a href="<?php echo $fb; ?>" id="social-link-fb" target="_blank">Find Us on Facebook</a></li><?php endif; ?>
					<?php if($tw): ?><li><a href="<?php echo $tw; ?>" id="social-link-tw" target="_blank">Follow Us on Twitter</a></li><?php endif; ?>
					<?php if($goo): ?><li><a href="<?php echo $goo; ?>" id="social-link-goo" target="_blank">Visit Us on Google+</a></li><?php endif; ?>
					<?php if($li): ?><li><a href="<?php echo $li; ?>" id="social-link-linked" target="_blank">Visit Us on LinkedIn</a></li><?php endif; ?>
					<?php if($yt): ?><li><a href="<?php echo $yt; ?>" id="social-link-yt" target="_blank">View Our You Tube Channel</a></li><?php endif; ?>
				</ul>
				<?php }
			} ?>
			<?php if ( has_nav_menu( 'footer' ) ) : ?>
				<nav id="colophon-navigation" class="footer-navigation" role="navigation">
					<?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_id' => 'footer-menu', 'container' => '' ) ); ?>
				</nav>
			<?php endif; ?>
			<div class="site-info">
				<div>
					<?php $add = get_theme_mod('setting_address');
					$city = get_theme_mod('setting_city');
					$state = get_theme_mod('setting_state');
					$zip = get_theme_mod('setting_zip');
					if($add): ?><span class="ftr-contact ftr-address"><?php echo $add; if($add2): echo ', ' . $add2; endif; ?></span><?php endif; if($city || $state || $zip): ?><span class="comma">, </span><?php endif;
					if ($city): ?><span class="ftr-contact"><?php echo $city; ?></span><?php echo ', ' ; endif;
					if ($state): ?><span class="ftr-contact"><?php echo $state; ?></span><?php echo ' '; endif;
					if($zip): ?><span class="ftr-contact"><?php echo $zip; ?></span><?php endif; echo "\n"; ?>
				</div>
				<?php $ph = get_theme_mod('setting_phone');
				if($ph): ?><span id="ph-1"><a class="tel" href="tel:<?php echo $ph; ?>"><?php echo $ph; ?></a></span><?php endif; ?>
			</div><!-- .site-info -->
		</div><!-- .wrapper -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
