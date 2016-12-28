<?php
/**
 * The sidebar containing the widget area for all mm4_you_posts_sidebar_wysiwyg.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package MM4 You
 */

?>

<div id="secondary" class="widget-area" role="complementary">
    <?php if( function_exists(mm4_you_posts_sidebar_wysiwyg) ) {
            mm4_you_posts_sidebar_wysiwyg();
    } ?>
</div><!-- #secondary -->