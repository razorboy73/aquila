<?php

/**
 * Author Archive Page template file.
 *
 * @package Aquila
 */

get_header();

// $author = get_queried_object(); // this is actually not needed
// global $wp_query;
// print "<pre>";
// print_r($wp_query);


?>
<div class="primary">
    <main id="id" class="site-main my-5" role="main">
        <div class="container">
            <?php get_template_part('template-parts/author/header'); ?>
            <div class="site-content">
                <?php
                //check that the auther is not empty
                if (!empty(get_the_author())) {
                    printf(
                        '<h3 class="font-size-xl h3 pb-4">%1$s %2$s</h3>',
                        __('Articles written by ', 'aquila'),
                        get_the_author()
                    );
                }
                ?>

                <div class="row">
                    <?php

                    if (have_posts()) :
                        while (have_posts()) : the_post();
                            get_template_part('template-parts/content', '', ['container_classes' => 'col-lg-4 col-md-6 col-sm-12 pb-4']);
                        endwhile;
                    else :
                        get_template_part('template-parts/content-none');
                    endif;


                    ?>

                </div>
            </div>
            <?php aquila_pagination(); ?>
        </div>
    </main>
</div>


<?php
get_footer();

?>