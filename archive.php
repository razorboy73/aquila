<?php

/**
 * Archive Page Template File
 * @package Aquila
 */

get_header();


?>

<div class="primary">
    <main id="id" class="site-main my-5" role="main">
        <div class="container">
            <header class="page-header">
                <?php
                if (!empty(single_term_title('', false))) {
                    printf(
                        '<h1 class="page-title">%s</h1>',
                        single_term_title('', false)
                    );
                }
                //check if not empty, then render
                if (!empty(get_the_archive_description())) {
                    the_archive_description('<div class="archive-description">', '</div>');
                }
                ?>
            </header>
            <div class="site-content">
                <div class="row">
                    <?php
                    if (have_posts()) :
                        while (have_posts()) :  the_post();
                            get_template_part('template-parts/content', '', ['container_classes' => 'col-lg-4 col-md-6 col-sm-12 pb-4']);
                        endwhile;
                    else :
                        get_template_part('template-parts/content', 'none');
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
