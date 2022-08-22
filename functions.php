<?php

/**
 * Theme Functions
 * 
 * @package Aquila
 */


//Define a constant for the file directory
//get the path until the root of the theme
//get_template_directory() returns the absolute template path directory of the theme. 
//It generates the hosting directory of the template.
if (!defined("AQUILA_DIR_PATH")) {
    define("AQUILA_DIR_PATH", untrailingslashit(get_template_directory()));
}

//get_template_directory_uri(): retrieves the full URI of the template directory. You can
//use it to print the URL of the template directory - stylesheets/scripts 
//It retrieves the full URI including the http://

if (!defined("AQUILA_URI_PATH")) {
    define("AQUILA_URI_PATH", untrailingslashit(get_template_directory_uri()));
}

if (!defined("AQUILA_BUILD_URI")) {
    define("AQUILA_BUILD_URI", untrailingslashit(get_template_directory_uri() . '/assets/build'));
}
if (!defined("AQUILA_BUILD_PATH")) {
    define("AQUILA_BUILD_PATH", untrailingslashit(get_template_directory() . '/assets/build'));
}

if (!defined("AQUILA_BUILD_JS_URI")) {
    define("AQUILA_BUILD_JS_URI", untrailingslashit(get_template_directory_uri() . '/assets/build/js'));
}

if (!defined("AQUILA_BUILD_JS_DIR_PATH")) {
    define("AQUILA_BUILD_JS_DIR_PATH", untrailingslashit(get_template_directory() . '/assets/build/js'));
}

if (!defined("AQUILA_BUILD_IMG_URI")) {
    define("AQUILA_BUILD_IMG_URI", untrailingslashit(get_template_directory_uri() . '/assets/build/src/img'));
}

if (!defined("AQUILA_BUILD_CSS_URI")) {
    define("AQUILA_BUILD_CSS_URI", untrailingslashit(get_template_directory_uri() . '/assets/build/css'));
}

if (!defined("AQUILA_BUILD_CSS_DIR_PATH")) {
    define("AQUILA_BUILD_CSS_DIR_PATH", untrailingslashit(get_template_directory() . '/assets/build/css'));
}



require_once AQUILA_DIR_PATH . '/inc/helpers/autoloader.php';
require_once AQUILA_DIR_PATH . '/inc/helpers/template-tags.php';


function aquila_get_theme_instance()
{
    \AQUILA_THEME\Inc\AQUILA_THEME::get_instance();
}

aquila_get_theme_instance();

// $my_post = get_post(1235);
// $parsed_block = parse_blocks($my_post->post_content);

// echo '<pre>';
// print_r($parsed_block);
// wp_die();
