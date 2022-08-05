<?php

/**
 * Template for entry content
 * @package aquila
 * This template is getting called within the loop
 */


 ?>


<div class="entry-content">
    
<?php
if (is_single()){
    the_content(
        sprintf(
            wp_kses(
                __("Continue reading %s <span class='meta-nav'>&rrrr</span>", 'aquila')
                ,
                [
                    'span'=> [
                        'class' =>[]
                    ]
                ]
                    ),
                    the_title('<span class="">"', '"</span>', false)
        )
    );

    wp_link_pages(
        [
            'before' => '<div class="page-links">' .esc_html__('Pages:', 'aquila'),
            'after' => '</div>',
            
        ]
        );
}else{
   aquila_the_excerpt(45);
   printf("<br>");
   echo aquila_excerpt_more();
}



?>

</div>