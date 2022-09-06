<?php

/**
 * Content template
 * 
 * @package  Aquila
 */

// prints the articles in the column

//$container_classes = !empty($args['container_classes']) ? $args['container_classes'] : 'mb-5';
$container_classes = !empty($args['container_classes']) ? $args['container_classes'] : 'mb-5';

?>


<!-- set the class based on the post id 
add the post class function to add specific functions to post
-->

<article id="post-<?php the_ID(); ?>" <?php post_class($container_classes); ?>>
    <?php

    get_template_part("template-parts/components/blog/entry-header");
    get_template_part("template-parts/components/blog/entry-meta");
    get_template_part("template-parts/components/blog/entry-content");
    get_template_part("template-parts/components/blog/entry-footer");
    ?>

</article>