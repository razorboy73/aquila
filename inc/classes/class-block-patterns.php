<?php
/**
* Purpose of class: Block Patterns
 * 
* @package Aquila
*/
namespace AQUILA_THEME\Inc;
use AQUILA_THEME\Inc\Traits\Singleton;
class Block_Patterns {
         use Singleton;
         protected function __construct(){
                 //load other classes
                 $this->setup_hooks();
         }
         protected function setup_hooks(){
                 //actions
                 add_action('init',[$this,'register_block_patterns']);
                 add_action('init',[$this,'register_block_pattern_categories']);
                
        
            }
        public function register_block_patterns(){
                if(function_exists('register_block_pattern')){
                    //create the content by copy/past content code
                    register_block_pattern( 
                    'aquila/cover', 
                    array(
                        'title'         => __( 'Aquila Cover', 'aquila' ),
                        'description'   => __( 'Aquila Cover Block with image and text', 'Block pattern description', 'aquila' ),
                        'categories'      => ['cover'],
                        'content'       => '<!-- wp:cover {"url":"http://localhost/debate/wp-content/uploads/2022/08/cover-1.jpg","id":981,"dimRatio":50,"align":"wide"} -->
                        <div class="wp-block-cover alignwide"><span aria-hidden="true" class="wp-block-cover__gradient-background has-background-dim"></span><img class="wp-block-cover__image-background wp-image-981" alt="" src="http://localhost/debate/wp-content/uploads/2022/08/cover-1.jpg" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:heading {"textAlign":"center","level":1} -->
                        <h1 class="has-text-align-center">Never let your memories be greater than your dreams</h1>
                        <!-- /wp:heading -->
                        
                        <!-- wp:paragraph {"align":"center","textColor":"cyan-bluish-gray"} -->
                        <p class="has-text-align-center has-cyan-bluish-gray-color has-text-color">A fool who knows he is a fool is not a big fool</p>
                        <!-- /wp:paragraph -->
                        
                        <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
                        <div class="wp-block-buttons"><!-- wp:button {"className":"is-style-outline"} -->
                        <div class="wp-block-button is-style-outline"><a class="wp-block-button__link">Blogs</a></div>
                        <!-- /wp:button --></div>
                        <!-- /wp:buttons --></div></div>
                        <!-- /wp:cover -->',
                       
                        'keywords'      => []//  (optional): An array
                    ) 
                    );
                }
            }

        public function register_block_pattern_categories(){
            
            if (function_exists('register_block_pattern_category')){
              
                 //create an array for pattern catagory properties
                 /*
                * Parameters
                *   $category_name
                *   (string) (Required) Pattern category name including namespace.
                *   $category_properties
                *   (array) (Required) List of properties for the block pattern category.
                *       'label'
                *       (string) Required. A human-readable label for the pattern category.
                */
                 $pattern_categories= [
                    'cover' => __('Cover','aquila'),
                    'carousel' => __('Carousel','aquila')
                 ];
                 
                 //now check the array - make sure its not empty and is an array
                 if(!empty($pattern_categories) && is_array($pattern_categories)){
                    //loop through array
                    foreach($pattern_categories as $pattern_category => $pattern_category_label){
                        register_block_pattern_category(
                            $pattern_category,
                            //array('label' => __('Hero', 'my-plugin'))
                            array('label' => $pattern_category_label)
                        );
                    }
                }
            }
        }     
}


public function register_block_pattern_categories(){
        if (function_exists('register_block_pattern_category')){
                //create an array for pattern catagory properties
                     /*
                    * Parameters
                    *   category_name
                    *   (string) (Required) Pattern category name including namespace.
                    *   category_properties
                    *   (array) (Required) List of properties for the block pattern category.
                    *       'label'
                    *       (string) Required. A human-readable label for the pattern category.
                    */
                     pattern_categories= [
                        'cover' => __('Cover','aquila'),
                        'carousel' => __('Carousel','aquila')
                     ];
                     //now check the array - make sure its not empty and is an array
                     if(!empty(pattern_categories) && is_array(pattern_categories)){
                        //loop through array
                        foreach(pattern_categories as pattern_category => pattern_category_label){
                            register_block_pattern_category(
                                pattern_category,
                                //array('label' => __('Hero', 'my-plugin'))
                                array('label' => pattern_category_label)
                            );
                        }
                    }
                }
            }     

public function register_block_pattern_categories(){
    if (function_exists('register_block_pattern_category')){
        //create an array for pattern catagory properties
                 /*
                * Parameters
                *   $category_name
                *   (string) (Required) Pattern category name including namespace.
                *   $category_properties
                *   (array) (Required) List of properties for the block pattern category.
                *       'label'
                *       (string) Required. A human-readable label for the pattern category.
                */
                 $pattern_categories= [
                    'cover' => __('Cover','aquila'),
                    'carousel' => __('Carousel','aquila')
                 ];
                 //now check the array - make sure its not empty and is an array
                 if(!empty($pattern_categories) && is_array($pattern_categories)){
                    //loop through array
                    foreach($pattern_categories as $pattern_category => $pattern_category_label){
                        register_block_pattern_category(
                            $pattern_category,
                            //array('label' => __('Hero', 'my-plugin'))
                            array('label' => $pattern_category_label)
                        );
                }
            }
    }
}     


