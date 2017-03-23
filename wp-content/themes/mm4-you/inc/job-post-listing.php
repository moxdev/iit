<?php
/**
 * Custom Categories for Job Listings.
 *
 * Displays the Hot Jobs and General Vacancies posts
 *
 *
 * @package MM4 You
 */



function mm4_you_job_post_listing() {

    $args = array(
        'category_name' => 'hot_job'
    );

    // Custom query.
    $query = new WP_Query( $args );

    // Check that we have query results.
    if ( $query->have_posts() ) {

        ?>

        <ul class="posts">

        <?php

        // Start looping over the query results.
        while ( $query->have_posts() ) {

            $query->the_post(); ?>

            <li><a href='<?php the_permalink() ?>'><?php the_title(); ?></a></li>

            <?php

        }

        ?>
        </ul>
        <?php
    }

    // Restore original post data.
    wp_reset_postdata();

}
