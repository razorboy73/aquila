<?php

/**
 * Main Template File
 * index.php
 *  Index page serves as blog post home if home.php is missing
 * 
 * @package Aquila
 */
get_header("");
 ?>


<!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
<div id="primary">
    <main id="main" class="site-main mt-5" role="main">
        <?php
        if(have_posts()) :
            ?>
            <div class="container">
            <?php
            //the determins if you are on the blog home page
            //The blog homepage is the page that shows the time-based blog content of the site.
            //is_front_page()- Determines whether the query is for the front page of the site.
            //This is for what is displayed at your site's main URL.
                if( is_home() && ! is_front_page() ){
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
                ?>
                <div class="row">
                    <?php
                        //set up front page grid so that there are 3 posts per div
                        $index = 0;
                        $no_of_articles = 3;
                        // start loop
                        while( have_posts()) : the_post();
                            //prints a column header for every 3 articles
                            if($index % $no_of_articles === 0){
                                ?>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                
                                <?php
                                }
                               
                              get_template_part("template-parts/content");
                        
                            $index ++;

    
                        //when index isnt zero and we hit article limit for column
                        //close the div
                        if( $index !==0  && $index%$no_of_articles === 0){
                        ?>
                            </div>
                        <?php
                        }
                        endwhile; 
                        ?>
                </div>
            </div>
        <?php
        else :
            get_template_part("template-parts/content", "none");

        endif;
        
        ?>

    </main>


</div>


<?php
get_footer();

    
   