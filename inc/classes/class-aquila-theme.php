<?php

/**
 * Bootstraps the theme
 * 
 * @package Aquila
 */

namespace AQUILA_THEME\Inc;

use AQUILA_THEME\Inc\Traits\Singleton;

class AQUILA_THEME {
    //if an instance of the class has been instantiated,
    //it should not be instantiated again
    //this is the reason for the trait-singleton
    //we use the trait becuase we want to use the method
    //of the the singleton in numerous classes

    use Singleton;
    //this added the relevant name space automatically
    //use a protected construct function so no other classes can access
    // the construct method
    //this means we dont need use the new keyword, just use the get_instance()
    //get_instance() will check if an instance of this call exists and returns it
    //or creates a new one

    protected function __construct()
    {
       
        Assets::get_instance();
        Menus::get_instance();
        Meta_Boxes::get_instance();
        //load other classes
        $this->setup_hooks();
    }

    protected function setup_hooks(){
        //actions
    
        add_action("after_setup_theme",[$this, "setup_theme"]);

    }

    public function setup_theme(){

        add_theme_support("title-tag");
        add_theme_support( 'custom-logo', array(
            'height'      => 100,
            'width'       => 400,
            'flex-height' => true,
            'flex-width'  => true,
            'header-text' => array( 'site-title', 'site-description' ),
        ) );
        add_theme_support("custom-background",
        [
            "default-color" => "#fff",
            "default-image"=> "",
            "default-repeat" => "no-repeat"
        ]);
        //gets rendered on front end with a separate functions
        add_theme_support("post-thumbnails");

        /**
         * Register new image sizes
         * give the image size a name to identify it
         * remember to regenerate images
         */

        add_image_size("featured-thumbnail",416, 225, true);

        add_theme_support( 'customize-selective-refresh-widgets' );
        
        //This feature enables Automatic Feed Links for post and comment in the head. This should be used in place of the deprecated automatic_feed_links() function.
        add_theme_support( 'automatic-feed-links' );
        //this switches the default core mark up to output valid html5
        add_theme_support( 'html5', array( 
            'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' 
            ) );
        
        //Works for TinyMCE editor only
        //This function automatically adds another stylesheet with -rtl prefix, e.g. editor-style-rtl.css. 
        //If that file doesn’t exist, it is removed before adding the stylesheet(s) to TinyMCE
        add_editor_style( $stylesheet = 'editor-style.css' );
        
        add_theme_support( 'wp-block-styles' );

        //add wide-width and full width to the gutenburg components
        add_theme_support( 'align-wide' );
        //now set the maximum with for any content added to the post
        
        global $content_width;
        if ( ! isset( $content_width ) ) {
            $content_width = 1240;
        }

    }   




 }