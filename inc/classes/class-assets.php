<?php

/**
 * Enqueue theme assets
 * 
 * @package Aquila
 */
namespace AQUILA_THEME\Inc;

use AQUILA_THEME\Inc\Traits\Singleton;

class Assets {
    use Singleton;

    protected function __construct()
    {
        
        //load other classes
        $this->setup_hooks();
    }

    protected function setup_hooks(){
        //actions
        add_action( 'wp_enqueue_scripts', [$this, "register_styles"]);
        add_action( 'wp_enqueue_scripts', [$this, "register_scripts"]);

    }

    public function register_styles(){

        //register styles
        wp_register_style( 'style-css', get_stylesheet_uri(),[], filemtime(AQUILA_DIR_PATH.'/style.css'), 'all' );
        wp_register_style( 'bootstrap-css', AQUILA_URI_PATH.'/assets/src/library/css/bootstrap.min.css',[], [], 'all' );
         //enqueue styles
        wp_enqueue_style("style-css");
        wp_enqueue_style("bootstrap-css");
    }

    public function register_scripts(){
        //register scripts
        wp_register_script( 'main-js', AQUILA_URI_PATH . '/assets/main.js', array(), filemtime(AQUILA_DIR_PATH.'/assets/main.js'), true );
        wp_register_script( 'popper', "https://unpkg.com/@popperjs/core@2",[],"", true );
        wp_register_script( 'bootstrap-js', AQUILA_URI_PATH.'/assets/src/library/js/bootstrap.min.js',[], filemtime(AQUILA_DIR_PATH.'/assets/src/library/js/bootstrap.min.js'), true );
    
    
        //enquie scripts
        wp_enqueue_script("main-js");
        wp_enqueue_script("popper");
        wp_enqueue_script("bootstrap-js");
        
    }


}