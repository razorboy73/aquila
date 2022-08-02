<?php
/**
 * Content template
 * 
 * @package  Aquila
 */

// prints the articles in the column

?>
<!-- set the class based on the post id 
add the post class function to add specific functions to post
-->

<article class="post-<?php the_ID(); ?>" <?php post_class('mb-5');?>>
<?php

    get_template_part("template-parts/components/blog/entry-header");
    get_template_part("template-parts/components/blog/entry-meta");
    get_template_part("template-parts/components/blog/entry-content");
    get_template_part("template-parts/components/blog/entry-footer");
?>

</article>