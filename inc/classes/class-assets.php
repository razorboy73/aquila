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
        //make sure things are pointing to the right directory

        // to override bootstrap
        //register boostrap first
        //list bootstrap as a dependancy
        
        wp_register_style( 'bootstrap-css', AQUILA_URI_PATH.'/assets/src/library/css/bootstrap.min.css',[], [], 'all' );
        wp_register_style( 'main-css', AQUILA_BUILD_CSS_URI . '/main.css', array("bootstrap-css"), filemtime(AQUILA_BUILD_CSS_DIR_PATH.'/main.css'), 'all' );
        wp_enqueue_style('fonts-css', get_template_directory_uri().'/assets/src/library/fonts/fonts.css',[],false,'all');
        
        
        //enqueue styles
        //order matters
        wp_enqueue_style("bootstrap-css");
        wp_enqueue_style("main-css");
       
    }

    public function register_scripts(){
        //register scripts
        wp_register_script( 'main-js', AQUILA_BUILD_JS_URI . '/main.js', array(), filemtime(AQUILA_BUILD_JS_DIR_PATH.'/main.js'), true );
        wp_register_script( 'popper', "https://unpkg.com/@popperjs/core@2",[],"", true );
        wp_register_script( 'bootstrap-js', AQUILA_URI_PATH.'/assets/src/library/js/bootstrap.min.js',[], filemtime(AQUILA_DIR_PATH.'/assets/src/library/js/bootstrap.min.js'), true );
    
    
        //enquie scripts
        wp_enqueue_script("main-js");
        wp_enqueue_script("popper");
        wp_enqueue_script("bootstrap-js");
        
    }


}