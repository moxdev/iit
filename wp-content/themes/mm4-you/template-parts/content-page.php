<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package MM4 You
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if( function_exists(get_field) ) { 
		$onPageTitle = get_field('on_page_title');
		if($onPageTitle) { ?>
		<header class="entry-header">
			<h1 class="entry-title"><?php echo $onPageTitle; ?></h1>
		</header>
	<?php } else { ?>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->
	<?php } 
	} else { ?>
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header><!-- .entry-header -->
	<?php } ?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'mm4-you' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	
	<?php if( function_exists(mm4_you_contact_page_form) ) {
		mm4_you_contact_page_form();
	} ?>
	
	<?php if( function_exists(mm4_you_home_carousel_type_2_controls) ) {
		mm4_you_home_carousel_type_2_controls();
	} ?>

	<footer class="entry-footer">
		<?php edit_post_link( esc_html__( 'Edit', 'mm4-you' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->