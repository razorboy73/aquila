<?php
/**
* Purpose of class: registering block categories
 * 
* @package Aquila
*/
namespace AQUILA_THEME\Inc;
use AQUILA_THEME\Inc\Traits\Singleton;
class Blocks{
         use Singleton;
         protected function __construct(){
                 //load other classes
                 $this->setup_hooks();
         }
         protected function setup_hooks(){
                 //actions
                 //remember to use public functions
                 //'block_categories' filter was depricated since version 5.8.0 , 
                 //so you need to use 'block_categories_all' instead
                 add_action('block_categories_all',[$this,'add_block_categories']);
                 }


      
        public function add_block_categories($categories){
             //this generates a list of block categories
            $category_slugs=wp_list_pluck($categories,'slug');
                //check if category exists,
                // if true, return categories
                //Searches for needle in haystack using loose comparison unless strict is set.
            $results= in_array('aquila', $category_slugs, $strict=true)? $categories :
               array_merge($categories,
                        [
                            [
                            'slug '=> 'aquilia',
                            'title' => __('Aquila Blocks','aquila'),
                            'icon'  => 'table-row-after'
                            ]
                        ]
                    );
                
                }
                
}