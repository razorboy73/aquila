<?php
/**
 * Content Page Template
 * Called within the loop
 * 
 * @package aquila
 */
?>
<!-- 
    the_id gets the current item in the loop
    post_class - Displays the classes for the post container element.
    check if the user is not on the blog front page
    if not on blog front page, show:
        entry title
        content
        pagination: uses wp_link_pages Displays page links for paginated posts
         (i.e. including the \\<--nextpage--\\> Quicktag one or more times). 
         This tag must be within The Loop.
    if on blog front page show:
        content
    then the tentry footer
-->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php
    if (!is_home()){
    ?>
    <header class="entry-header">
        <?php the_title('<h1 class="entry-title">','</h1>');?>
    </header> <!--.entry-header -->
    <?php
    }
    ?>
    <div class="entry-content">
        <?php
        the_content();
        if(! is_home()){
            wp_link_pages(
                array(
                    'before' => '<div class="page-links">'.esc_html__('Pages:','aquila'),
                    'after' => '</div>'
                )
                );  

        }
        ?>
    </div><!--.entry-content -->
    <footer class="entry-footer">
        <?php edit_post_link(esc_html__('Edit','aquila'),'<span class="edit-link">','</span>'); ?>
    </footer><!--.entry-footer -->




</article>