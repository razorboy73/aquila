<?php

/**
 * Entry footer
 * 
 *  To be used inside of Wordpress Loop
 * 
 * @package Aquila
 */
//Show all the categories and tags associated with a post
//below the read more
//display terms associated with this post
//get post id, taxonomies from which to retrieve terms
//wp_get_post_terms returns an object (so you need to dig into it in order to print)
//loop throw object and print them
$the_post_id = get_the_id();
$article_terms = wp_get_post_terms(
    $the_post_id,//names of the taxonomies
    ['category', 'post_tag'],



);

//when pulling an array, always check if its empty and actually an arry

if(empty($article_terms || !is_array($article_terms))){
    return;
}

 ?>


 <div class="entry-footer mt-4">
    <?php
    //checked if array was not empty already
    //want to print button with term name and link to archive
    //pull term name from the object generated by get_post_terms
    //use get_term_link()

    foreach($article_terms as $key=>$article_term){
        ?>
        <button class="btn border border-secondary mb-2 mr-2">
            <a class="entry-footer-link text-black-50" href="<?php echo esc_url(get_term_link($article_term));?>">
            <?php echo esc_html($article_term->name); ?>
            </a>
           
        </button>

    <?php }

    

    ?>
 </div>