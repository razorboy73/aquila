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
        //used to enqueue block scripts and styles in both the admin editor 
        //and frontend of the site.
        add_action( 'enqueue_block_assets', [$this, "enqueue_editor_assets"]);

    }

    public function register_styles(){

        //register styles
        //make sure things are pointing to the right directory

        // to override bootstrap
        //register boostrap first
        //list bootstrap as a dependancy
        
        wp_register_style( 'bootstrap-css', AQUILA_URI_PATH.'/assets/src/library/css/bootstrap.min.css',[], [], 'all' );
        wp_register_style( 'main-css', AQUILA_BUILD_CSS_URI . '/main.css', array("bootstrap-css"), filemtime(AQUILA_BUILD_CSS_DIR_PATH.'/main.css'), 'all' );
        //because fonts are being included in the build via main.css, we dont need to include here
        //wp_enqueue_style('fonts-css', get_template_directory_uri().'/assets/src/library/fonts/fonts.css',[],false,'all');
        
        
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

    public function enqueue_editor_assets(){
        //lets get asset configs to populate the enqueue script functionality
        $asset_config_file = sprintf('%s/assets.php', AQUILA_BUILD_PATH);
       
       
        if (!file_exists($asset_config_file)){
            return;
        }
        
        $asset_config = require_once $asset_config_file;
        
        //now lets check if the editor configuration is set up
        //asset config returns an array using the js/editor.js key
        if(empty($asset_config['js/editor.js'])){
            return;
        }
        //get dependancies
        $editor_asset = $asset_config['js/editor.js'];
        $js_dependancies = (! empty($editor_asset['dependancies']))? $editor_asset['dependancies']:[];
        $version = (! empty($editor_asset['version']))? $editor_asset['version']:filemtime($asset_config_file);
      
    
        //theme gutenberg block js
        //Determine if current request is for an administrative interface page.
        if(is_admin()){
        // this will be the javascript file
        //print off the script
           wp_enqueue_script( 'aquila-block-js', AQUILA_BUILD_JS_URI.'/blocks.js', $js_dependancies, $version, true
            );
         }
        
        
         //Theme Gutenberg Blocks CSS

         $css_dependancies = [
            'wp-block-libary-theme',
            'wp-block-libary'
         ];

         wp_enqueue_style(
            'aquila-blocks-css',
            AQUILA_BUILD_CSS_URI.'/blocks.css',
            $css_dependancies,
            filemtime(AQUILA_BUILD_CSS_DIR_PATH.'/blocks.css'),
            'all'
         );
    }

}