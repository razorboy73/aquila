<?php

/**
 * Post Carousel
 * 
 * @package Aquila
 */
//Want to build a carousel with images and titles from articles
//use assigned image, but if no 

//Initiate a WP query to populate carosel
//Could have just used the Loop
//Default post type is post

// arguments

$args = [
    'posts_per_page' => 5,
    'post_type'     => 'post',
    'update_post_meta_cache' => false,
    'update_post_term_cache' => false
];
//this gives us the loop
$post_query = new WP_Query($args);


?>

<div class="posts-carousel px-5">

    <?php
    //have_posts return true
    if ($post_query->have_posts()) :
        while ($post_query->have_posts()) :
            $post_query->the_post();
            //in here you put the code you want to loop through
    ?>
            <div class="card">
                <!-- Apply the card class-->
                <?php
                //check if there is a thumbnail and if so, use it or else
                //have a default as a back up
                if (has_post_thumbnail()) {
                    // * Renders custom thumbnail with lazy Load
                    the_post_custom_thumbnail(
                        //* Retrieve the ID of the current item in the WordPress Loop.
                        // Get the name of the image size
                        // set additional attributes
                        get_the_ID(),
                        'featured-thumbnail',
                        [
                            'sizes' => '(max-width: 350px) 350px, 233px',
                            'class' => 'w-100'
                        ]
                    );
                } else {
                ?>
                    <img src="https://via.placeholder.com/510x340" class="w-100" alt="">
                <?php
                }

                ?>
                <div class="card-body">
                    <?php
                    //Displays or retrieves the current post title with optional markup.
                    the_title(
                        '<h3 class="card-title">',
                        '</h3>'
                    );

                    aquila_the_excerpt()
                    ?>
                    <!-- Now Render Link -->
                    <a href="<?php echo esc_url(get_the_permalink()); ?>" class="btn btn-primary">
                        <?php esc_html_e('View More', 'aquila'); ?>

                    </a>
                </div>
            </div>
    <?php

        endwhile;
    endif;

    /**
     * After looping through a separate query, this function restores
     * the $post global to the current post in the main query.
     *
     * @since 3.0.0
     *
     * @global WP_Query $wp_query WordPress Query object.
     */
    wp_reset_postdata();

    ?>




</div>