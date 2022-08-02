<?php
/**
 * Theme Functions
 * 
 * @package Aquila
 */


//Define a constant for the file directory
//get the path until the root of the theme

if(!defined ("AQUILA_DIR_PATH")){
    define("AQUILA_DIR_PATH", untrailingslashit(get_template_directory()));

}

if(!defined ("AQUILA_URI_PATH")){
    define("AQUILA_URI_PATH", untrailingslashit(get_template_directory_uri()));

}



require_once AQUILA_DIR_PATH . '/inc/helpers/autoloader.php';
require_once AQUILA_DIR_PATH . '/inc/helpers/template-tags.php';


function aquila_get_theme_instance(){
    \AQUILA_THEME\Inc\AQUILA_THEME::get_instance();
}

aquila_get_theme_instance();



