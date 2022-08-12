<?php
/**
 * Front Page template
 * @package Aquila
 */



get_header("");
 ?>


<!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
<div id="primary">
    <main id="main" class="site-main mt-5" role="main">
        <div class="home-page-wrap">
            <?php
            if(have_posts()) :
                
                    // start loop
                    while( have_posts()) : the_post();
                        get_template_part("template-parts/content", 'page');
                    endwhile; 
                    ?>

                    <?php
                        else :
                            get_template_part("template-parts/content", "none");
                        endif;
                    ?>

        </div>
    </main>
</div>


<?php
get_footer(); ?>
