<?php
/**
 * Template Name: Home Page (Option C)
 * Description: Home page template with layout "C"
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package MM4 You
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->
	<?php if( function_exists(mm4_you_highlight_boxes) ) {
		mm4_you_highlight_boxes();
	} ?>
	<?php if( function_exists(mm4_you_add_quick_contact_form) ) {
		mm4_you_add_quick_contact_form();
	} ?>

<?php get_footer(); ?>
