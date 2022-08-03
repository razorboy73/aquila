<?php

//used within Wordpress Loop
function get_the_post_custom_thumbnail($post_id, $size = "featured-image", $additional_attributes =[]){
    //get the post id, size and additional attributes passed as an array
    $custom_thumbnail = "";
    //if there is no post id passed in
    if($post_id === null){
        $post_id = get_the_ID();
    }

    if(has_post_thumbnail($post_id)){
        $default_attributes = [
            'loading' => 'lazy'
        ];
    }
    //Merges the elements of one or more arrays together so that the values of 
    //one are appended to the end of the previous one. 
    //It returns the resulting array.
    //If the input arrays have the same string keys, then the later value for 
    //that key will overwrite the previous one. If, however, the arrays contain 
    //numeric keys, the later value will not overwrite the original value, but 
    //will be appended.
    $attributes = array_merge($additional_attributes, $default_attributes);

    $custom_thumbnail = wp_get_attachment_image(
        //get the post thumbnail id based on the post
        //may not always be a thumbnail, hence need to be explicit
        get_post_thumbnail_id($post_id),
        $size,
        false,
        $additional_attributes

    );
    return $custom_thumbnail;
}

/**
 * Renders custom thumbnail with lazy Load
 * @param int $post_id      PostID
 * @param string $size      Registered imag size
 * @param array $additional_attributes
 */

function the_post_custom_thumbnail($post_id, $size = "featured-thumbnail", $additional_attributes =[]){
    echo get_the_post_custom_thumbnail($post_id, $size, $additional_attributes);
}