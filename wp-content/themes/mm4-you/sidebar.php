<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package MM4 You
 */

?>

<div id="secondary" class="widget-area" role="complementary">
	<?php  if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-global') ) :
		 endif;
	?>
	<?php if (is_single() || is_archive() || is_home()) {
		 if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-blog') ) :
		 endif;
	} ?>
	<?php if( function_exists(mm4_you_page_subnav) && is_page_template('page-subnav.php') ) {
		mm4_you_page_subnav();
	} ?>
	<?php if( function_exists(mm4_you_sidebar_wysiwyg) ) {
		mm4_you_sidebar_wysiwyg();
	} ?>
	<?php if( function_exists(mm4_you_add_quick_contact_form) ) {
		mm4_you_add_quick_contact_form();
	} ?>
	<?php if( function_exists(mm4_you_contact_page_sidebar) ) {
		mm4_you_contact_page_sidebar();
	} ?>
</div><!-- #secondary -->
