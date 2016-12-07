<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package MM4 You
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>
		
			<?php if( function_exists(get_field) ) {
				if ( is_home() && ! is_front_page() ) {
					$blogPage = get_option( 'page_for_posts' );
					$onPageTitle = get_field('on_page_title', $blogPage);
					if($onPageTitle) { ?>
						<header>
							<h1 class="page-title"><?php echo $onPageTitle; ?></h1>
						</header>
					<?php } else { ?>
					<header>
						<h1 class="page-title"><?php single_post_title(); ?></h1>
					</header>
				<?php }
				}
			} else {
				if ( is_home() && ! is_front_page() ) : ?>
					<header>
						<h1 class="page-title"><?php single_post_title(); ?></h1>
					</header>
				<?php endif;
			} ?>

			<?php if ( is_home() && ! is_front_page() ) :
				$blogPage = get_option( 'page_for_posts' );
				$contentPost = get_post($blogPage);
				$content = $contentPost->post_content;
				$content = apply_filters('the_content', $content);
				$content = str_replace(']]>', ']]&gt;', $content);
				if($content) : ?>
					<div class="entry-content" id="main-entry">
						<?php echo $content; ?>
					</div>
				<?php endif;
			endif; ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_format() );
				?>

			<?php endwhile; ?>
			
			<?php $args = array(
				'prev_text' => '&laquo; Older Posts',
				'next_text' => 'Newer Posts &raquo;'
			) ?>
			<?php the_posts_navigation($args); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
