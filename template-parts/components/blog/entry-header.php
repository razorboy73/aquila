<?php

/**
 * Template for entry header
 * @package aquila
 * This template is getting called within the loop
 */
$the_post_id = get_the_ID();
$has_post_thumbnail = get_the_post_thumbnail($the_post_id);
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
                "featured-large",
                [
                    'sizes' => '(max-width: 590px) 590px, 425px',
                    'class' => 'attachment-featured-large size-featured-image'
                ]
            )
        ?>
    
    
    </a>
    </div>
    <?php }
    ?>
 </header>