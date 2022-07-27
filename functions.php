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


function aquila_get_theme_instance(){
    \AQUILA_THEME\Inc\AQUILA_THEME::get_instance();
}

aquila_get_theme_instance();


 if (! function_exists('aquila_enqueue_scripts')){

  /**
 * Proper way to enqueue scripts and styles
 */
function aquila_enqueue_scripts() {
    //style sheet can include dependancies and version numbers(use unmodified time stamp) and media that should employ spread sheet
    //wp_enqueue_style( 'style-css', get_stylesheet_uri(),[], filemtime(get_template_directory().'/style.css'), 'all' );
    //wp_enqueue_script( 'main-js', get_template_directory_uri() . '/assets/main.js', array(), filemtime(get_template_directory().'/assets/main.js'), true );
    //could also use wp_register_style() and then the enqueue_style method if we want to use a style
    //or script conditionally

    
  

}
add_action( 'wp_enqueue_scripts', 'aquila_enqueue_scripts' );
 }
