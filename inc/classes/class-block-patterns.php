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
                    //store content in another template
                    //buffer but not echo via ob_start

                    /**
                     * Cover Pattern
                     */
                  
                    $cover_content = $this->get_pattern_content('template-parts/patterns/cover');
                    register_block_pattern( 
                    'aquila/cover', 
                    array(
                        'title'         => __( 'Aquila Cover', 'aquila' ),
                        'description'   => __( 'Aquila Cover Block with image and text', 'Block pattern description', 'aquila' ),
                        'categories'      => ['cover'],
                        'content'       => $cover_content,
                       
                        'keywords'      => []//  (optional): An array
                    ) 
                    );
                     /**
                     * 2 column pattern
                     */
                  
                    $two_column_content = $this->get_pattern_content('template-parts/patterns/two-columns');
                    register_block_pattern( 
                    'aquila/two-columns', 
                    array(
                        'title'         => __( 'Aquila Two Column Pattern', 'aquila' ),
                        'description'   => __( 'Aquila two columnns with heading and text', 'Block pattern description', 'aquila' ),
                        'categories'      => ['columns'],
                        'content'       => $two_column_content,
            
                        'keywords'      => []//  (optional): An array
                    ) 
                    );
                }
            }
            
        public function get_pattern_content($template_path){
            /**
             * Gets content from a specific path
             * Can be reused for numerus block patterns
             */
                ob_start();
                get_template_part($template_path);
                $pattern_content = ob_get_contents();
                ob_end_clean();
                return $pattern_content;

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
                    'columns' => __('Columns','aquila')
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