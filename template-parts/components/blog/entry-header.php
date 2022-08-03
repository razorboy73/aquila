<?php

/**
 * Template for entry header
 * @package aquila
 * This template is getting called within the loop
 */
$the_post_id = get_the_ID();
$has_post_thumbnail = get_the_post_thumbnail($the_post_id);
$hide_title = get_post_meta($the_post_id, '_hide_page_title', true );

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
    <?php }
    ?>
 </header>