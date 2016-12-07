<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package MM4 You
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'We\'re sorry, but that page can’t be found.', 'mm4-you' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p>Please use the "back" button in your browser or <a href="<?php echo esc_url( home_url( '/' ) ); ?>">return to our home page.</a></p>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
