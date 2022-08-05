<?php

/**
 * register  theme sidebars
 * to make this acctive, need to register it in main theme file
 * Creates the area in the back end for you to add widgets to
 * In order to display sidebar
 * - need to create file sidebar.php  and then render with dynamic sidebar function
 * - load them into theme with get_sidebar function
 * @package Aquila
 */
namespace AQUILA_THEME\Inc;

use AQUILA_THEME\Inc\Traits\Singleton;

class Sidebars {
    use Singleton;

    protected function __construct()
    {
        
        //load other classes
        $this->setup_hooks();
    }

    protected function setup_hooks(){
        //actions
        //notice the similarity between the name register_sidebars and the 
        //wordpress class
        add_action('widgets_init', [$this,'register_sidebars']);
    }

   
    public function register_sidebars(){
        //use register_sidebars if you want multiple IDENTICAL sidebars/widgets
        //Creates the are in the back end for you to add widgets too
        register_sidebar( array(
            'name'          => __( 'Main Sidebar', 'aquila' ),
            'id'            => 'sidebar-1',
            'description'   => __("Main Sidebar", "aquila"),
            'before_widget' => '<div id="%1$s" class="widget widget-sidebar %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ) );

        register_sidebar( array(
            'name'          => __( 'Footer Sidebar', 'aquila' ),
            'id'            => 'sidebar-2',
            'description'   => __("Footer Sidebar", "aquila"),
            'before_widget' => '<div id="%1$s" class="widget widget-footer cell column %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ) );

    }

}