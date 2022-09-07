<?php

//used within Wordpress Loop
function get_the_post_custom_thumbnail($post_id, $size = "featured-image", $additional_attributes = [])
{
    //get the post id, size and additional attributes passed as an array
    $custom_thumbnail = "";
    //if there is no post id passed in
    if ($post_id === null) {
        $post_id = get_the_ID();
    }

    if (has_post_thumbnail($post_id)) {
        $default_attributes = [
            'loading' => 'lazy'
        ];
    } else {
        //prevents an error in the array merge
        $default_attributes = [];
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

function the_post_custom_thumbnail($post_id, $size = "featured-thumbnail", $additional_attributes = [])
{
    echo get_the_post_custom_thumbnail($post_id, $size, $additional_attributes);
}

function aquila_posted_on()
{
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    //check if the current time is not equal to the modified time
    //wp stores modified time in db
    //if the current time is not the same as the stored modified time, assume post has been modified
    if (get_the_time("U") !== get_the_modified_time("U")) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
    }

    //use string formatting to populate time string
    //use DATE_W3C format for Seo related dates

    $time_string = sprintf(
        $time_string,
        esc_attr(get_the_date(DATE_W3C)),
        esc_attr(get_the_date()),
        esc_attr(get_the_modified_date(DATE_W3C)),
        esc_attr(get_the_modified_date())
    );
    //now use the time string in copy

    $posted_on = sprintf(
        esc_html_x('Posted on %s', 'post date', 'aquila'),
        '<a href="' . esc_url(get_permalink()) . '" style="text-decoration:none" rel="bookmark">' . $time_string . '</a>'
    );

    echo '<span class="posted-on text-secondary">' . $posted_on . '</span>';
}

function aquila_posted_by()
{
    //get author name
    //link to the authorpage
    //need the author ID in order to do this
    //use the get_the_author_meta() with the ID parameter
    $byline = sprintf(
        esc_html_x('by %s', 'post author', "aquila"),
        "<span class='author vcard'><a href='" . esc_url(get_author_posts_url(get_the_author_meta("ID"))) . "'>" . esc_html(get_the_author()) . "</a></span>"
    );
    echo '<span class="byline text-secondary">' . $byline . '</span>';
}
// check if there is an excerpt 
// if no excerpt, generate one, else use the one that is there
function aquila_the_excerpt($trim_character_count = 0)
{

    $post_ID = get_the_ID();

    if (empty($post_ID)) {
        return null;
    }

    //check if the excerpt has been set or trimmed to zero
    //by default, this will be 55 characters
    if (!has_excerpt() || $trim_character_count === 0) {
        the_excerpt(); //uses get_the_excerpt()
        //$excerpt = substr($excerpt,0, strrpos($excerpt, " "));

        return;
    }
    //if there is an excerpt, render text up until last space
    $excerpt = wp_strip_all_tags(get_the_excerpt());
    // use substr to slice out number of characters from the start
    $excerpt = substr($excerpt, 0, $trim_character_count);
    //now cut down text to first space by reprocessing the string, using 
    //strrpos to find last space to remove the last word
    //so you do not end up with half a word
    $excerpt = substr($excerpt, 0, strrpos($excerpt, " "));
    echo $excerpt;
}

function aquila_excerpt_more($more = "")
{
    //dont show on a single page

    if (!is_single()) {
        $more = sprintf(
            '<a href="%1$s" class="aquila-read-more "><button class="mt-4 mb-3 btn btn-info text-white">%2$s</button></a>',
            get_permalink(get_the_ID()),
            __("Read More", 'aquila')
        );
    }

    return $more;
}


function  aquila_pagination()
{
    //will show the next article in loop
    //wrap pagination in a nav tag
    //use kses to strip out all but the allowed protocols
    //pass in the paginate links

    //arguments for paginate links
    $args = [
        "before_page_number" => "<span class='btn border border-secondary mr mb-2'> ",
        "after_page_number" => "</span>",
    ];
    //allowed tags
    $allowed_tags = [
        "span" => [
            "class" => []
        ],
        "a" => [
            "class" => [],
            "href" => [],
        ]

    ];
    printf(
        '<nav class="aquila-pagination clearfix">%s</nav>',
        wp_kses(
            paginate_links($args),
            $allowed_tags
        )
    );
}

/**
 * 
 */

function aquila_is_uploaded_via_wp_admin($gravatar_url)
{
    $parsed_url = wp_parse_url($gravatar_url);
    // echo "<pre>";
    // echo "<br>";
    // echo "gravatar parse";
    // print_r($parsed_url);

    $query_args = !empty($parsed_url['query']) ? $parsed_url['query'] : '';
    //if the query is empty, it means user has uploaded gravatar
    return empty($query_args);
}

/**
 * if the gravatar is uploaded, returns true
 */
function aquila_has_gravatar($user_email)
{
    $gravatar_url = get_avatar_url($user_email);

    // echo "<pre>";
    // echo "<br>";
    // echo "first Gravatar url";
    // print_r($gravatar_url);

    if (aquila_is_uploaded_via_wp_admin($gravatar_url)) {
        return true;
    }

    $gravatar_url = sprintf('%s&d=404', $gravatar_url);
    // echo "<pre>";
    // echo "<br>";
    // echo "Second Gravatar url";
    // print_r($gravatar_url);

    //make a request to $gravatar_url and get the header
    $headers = @get_headers($gravatar_url);
    // echo "<pre>";
    // echo "<br>";
    // echo "Header";
    // print_r($headers);

    //if the status is 200, it means the users has uploaded an avatar on gravatar

    return preg_match("|200|", $headers[0]);
}
