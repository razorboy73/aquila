<?php

/**
 * Register menus
 * 
 * @package Aquila
 */
namespace AQUILA_THEME\Inc;

use AQUILA_THEME\Inc\Traits\Singleton;

class Menus {
    use Singleton;

    protected function __construct()
    {
        //load other classes
        $this->setup_hooks();
    }

    protected function setup_hooks(){
        //actions
        add_action("init", [$this, "register_menus"]);
    }

    public function register_menus( ){
        register_nav_menus(
            array(
              'aquila-header-menu' => esc_html__( 'Header Menu', "aquila" ),
              'aquila-footer-menu' => esc_html__( 'Footer Menu', "aquila" )
             )
           );
         }
    //in order to make a custom menu, need to beable to change structure of menu
    // so cant use wp_nav_menu and we need to get in the form of an array
    //need to get menu ID with the help of the menu location - which is really the name
    // to do this
    //get menu locations and their associated ids

    public function get_menu_id($location){
        //this gets an array of locations and IDs
        $locations = get_nav_menu_locations();
        //get object ID by location
        $menu_id = $locations[$location];
        //return either the menu id from this function or nothing
        return !empty($menu_id) ? $menu_id : " ";
    }

    //get child menu items
    public function get_child_menu_items($menu_array, $parent_id){
        //store relevant child menu ids in an array
        $child_menus = [];
        //check if parameter is a non-empty array
        if(!empty($menu_array) && is_array($menu_array)){
            foreach($menu_array as $menu){
                //dig in to each array and find parent menu item, check if there is a match
                if(intval($menu->menu_item_parent)===$parent_id){
                    //add it to the array
                    array_push($child_menus, $menu);
                }
            }
        }
        return $child_menus;
    }


    }
