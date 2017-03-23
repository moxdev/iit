<?php
/**
 * Template part for displaying page content in page-hot-jobs.php.
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

		<ul class="posts">
			<?php query_posts('cat=6'); while (have_posts()) : the_post(); ?>
				<li><a href='<?php the_permalink() ?>'><?php the_title(); ?></a></li>
			<?php endwhile; ?>

			<?php wp_reset_query(); ?>
		</ul>



		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'mm4-you' ),
				'after'  => '</div>',
			) );
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php edit_post_link( esc_html__( 'Edit', 'mm4-you' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->