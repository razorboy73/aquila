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
}else{
   aquila_the_excerpt(100);
   echo aquila_excerpt_more();
}

?>

</div>