<?php
/**
 * Theme Functions
 * 
 * @package Aquila
 */


 if (! function_exists('aquila_enqueue_scripts')){

  /**
 * Proper way to enqueue scripts and styles
 */
function aquila_enqueue_scripts() {
    //style sheet can include dependancies and version numbers(use unmodified time stamp) and media that should employ spread sheet
    wp_enqueue_style( 'style-sheet', get_stylesheet_uri(),[], filemtime(get_template_directory().'/style.css'), 'all' );
    wp_enqueue_script( 'script-name', get_template_directory_uri() . '/js/example.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'aquila_enqueue_scripts' );
 }
