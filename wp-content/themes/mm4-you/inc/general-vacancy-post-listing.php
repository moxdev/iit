<?php
/**
 * Custom Categories for General Vacancy Post Listings.
 *
 * Displays the General Vacancies posts on page-general-vacancies.php
 *
 *
 * @package MM4 You
 */



function mm4_you_general_vacancy_post_listing() {

    $args = array(
        'cat' => '7, 8'
    );

    $general_vacancy_query = new WP_Query( $args );

    if ( $general_vacancy_query->have_posts() ) {

        ?>

        <ul class="general-vacancies-posts">

        <?php

        while ( $general_vacancy_query->have_posts() ) {

            $general_vacancy_query->the_post(); ?>

            <li><a href='<?php the_permalink() ?>'><?php the_title(); ?></a></li>

            <?php

        }

        ?>

        </ul>

        <?php
    }

    wp_reset_postdata();

}
