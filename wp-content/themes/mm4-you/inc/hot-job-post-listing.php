<?php
/**
 * Custom Categories for Job Listings.
 *
 * Displays the Hot Jobs and General Vacancies posts
 *
 *
 * @package MM4 You
 */



function mm4_you_hot_job_post_listing() {

    $args = array(
        'cat' => '6, 8'
    );

    // Custom query.
    $hot_job_query = new WP_Query( $args );

    // Check that we have query results.
    if ( $hot_job_query->have_posts() ) {

        ?>

        <ul class="hot-jobs-posts">

        <?php

        // Start looping over the query results.
        while ( $hot_job_query->have_posts() ) {

            $hot_job_query->the_post(); ?>

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
