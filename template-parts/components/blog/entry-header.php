<?php

/**
 * Template for entry header
 * @package aquila
 * This template is getting called within the loop
 */
$the_post_id = get_the_ID();
$has_post_thumbnail = get_the_post_thumbnail($the_post_id);
$hide_title = get_post_meta($the_post_id, '_hide_page_title', true );
//To hide the title
//check $hide_title variable to make sure it is not empty and says yes to hide
//then add class
$heading_class = !empty($hide_title) && 'yes' == $hide_title ?'hide': '';


 ?>

 <header class="entry-header">
    <?php
    //Feature image
    //Check if post has thumbnail, which is really featured image
    if($has_post_thumbnail){?>
    <div class="entry-image mb-3">
        <!-- make image clickable -->
        <a href="<?php echo esc_url(get_permalink()); ?>">
        <?php
            the_post_custom_thumbnail(
                //pass in post id
                $the_post_id,
                "featured-thumbnail",
                [
                    'sizes' => '(max-width: 416px) 416px, 225px',
                    'class' => 'attachment-featured-large size-featured-image'
                ]
            )
        ?>
    
    
    </a>
    </div>
    <?php 
    }
    //Title
    //Check if on single page
    //if on single post page or on regular page, render as h1 with no link
    //otherwise, render with link and h2
    if(is_single() || is_page()){
        printf(
            '<h1 class="page-title text-dark %1$s">%2$s</h1>',
            esc_attr($heading_class),
            wp_kses_post(get_the_title())
        );
    }else{
        printf(
            '<h2 class="entry-title mb-3"><a class="text-dark" href="%1$s" style="text-decoration:none">%2$s</a></h2>',
            esc_url(get_the_permalink()),
            wp_kses_post(get_the_title())
        );

    }

 




    ?>

 </header>