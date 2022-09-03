<?php

/**
 * Single Post template
 * @package Aquila
 */


get_header("");
?>


<!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
<div id="primary">
    <main id="main" class="site-main mt-5" role="main">
        <div class="container">
            <div class="row">
                <!--divide page in two - remember there are 12 columns -->
                <div class="col-lg-8 col-md-8 col-sm-12">
                    <?php
                    if (have_posts()) :
                    ?>
                        <div class="post-wrap">
                            <?php
                            //the determins if you are on the blog home page
                            //The blog homepage is the page that shows the time-based blog content of the site.
                            //is_front_page()- Determines whether the query is for the front page of the site.
                            //This is for what is displayed at your site's main URL.
                            if (is_home() && !is_front_page()) {
                            ?>
                                <header class="mb-5">
                                    <h1 class="page-title">
                                        <?php
                                        //Display or retrieve page title for post.
                                        single_post_title();
                                        ?>
                                    </h1>
                                </header>
                            <?php
                            }
                            // start loop
                            while (have_posts()) : the_post();
                                get_template_part("template-parts/content");
                            endwhile;
                            ?>
                        </div>
                    <?php
                    else :
                        get_template_part("template-parts/content", "none");

                    endif;
                    // For Single Post loadmore button, uncomment this code and comment next and prev link code below.
                    echo do_shortcode('[single_post_listings]');

                    //pagination function, found in template-tags file
                    aquila_pagination();
                    ?>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?php get_sidebar(); ?>
                </div>
            </div>
        </div>
    </main>
</div>


<?php
get_footer(); ?>