# Get list of Cats

```php
<ul class="posts">
    <?php query_posts('cat=6'); while (have_posts()) : the_post(); ?>
        <li><a href='<?php the_permalink() ?>'><?php the_title(); ?></a></li>
    <?php endwhile; ?>

    <?php wp_reset_query(); ?>
</ul>
```

```php
<?php if (get_category('17')->category_count > 0) echo get_category('17')->cat_name; ?>

<?php foreach (get_categories() as $category){
if ($category->count > 0){
echo $category->cat_name;
}
} ?>

<?php if (get_category('17')->category_count > 0) echo "<a href=\"".get_bloginfo('home')."/category/news/\">Blog</a>"; ?>
```

Hot Jobs
- only show on Hot Jobs

General V
- only show on General

Both
- show on both pages

## Loop

```php
<?php

$args = array(
    // Arguments for your query.
);

// Custom query.
$query = new WP_Query( $args );

// Check that we have query results.
if ( $query->have_posts() ) {

    // Start looping over the query results.
    while ( $query->have_posts() ) {

        $query->the_post();

        // Contents of the queried post results go here.

    }

}

// Restore original post data.
wp_reset_postdata();

?>
```

## Args

```php
$args = array(
    'parameter1' => 'value',
    'parameter2' => 'value',
    'parameter3' => 'value'
);
```

## The category_name Parameter
 - The category_name parameter uses the category slug, not the name (confusing, I know!). Again you can use it with a single category or with a string of categories to find posts that are in any of the categories.

```php
/* To query posts in a single category you add: */

$args = array(
    'category_name' => 'my-slug'
);

/* And to find posts in one or more of a number of categories, use this: */

$args = array(
    'category_name' => 'my-slug, your-slug, another-slug'
);

```
