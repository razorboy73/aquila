<?php

/**
 * Register Meta Boxes
 * 
 * @package Aquila
 */
namespace AQUILA_THEME\Inc;

use AQUILA_THEME\Inc\Traits\Singleton;

class Meta_Boxes {
    use Singleton;

    protected function __construct()
    {
        
        //load other classes
        $this->setup_hooks();
    }

    protected function setup_hooks(){
        //actions
        //first add the metabox - which has its own callback to render it
        add_action( 'add_meta_boxes', [$this,"add_custom_meta_box"] );
        //Save setting in the db
        add_action( 'save_post', [$this,"save_post_meta_data"] );

    }


    public function add_custom_meta_box(){
            //techically this registers the metabox
            //loops through all screens
            //use another function to display the code
            //and another to save the value into the db
            $screens = [ 'post' ];
            foreach ( $screens as $screen ) {
                add_meta_box(
                    'hide-page-title',                  // Unique ID
                    __('Hide Page Title',"aquila"),      // Box title
                    [$this, "custom_meta_box_html"],    // Content callback, must be of type callable, use $this if class
                    $screen,                            // Post type
                    'side'                              //location of box
                );
            }
        
        
    }

    public function custom_meta_box_html($post){
        //this renders the metabox
        //need to get post ID to start the process off
        //To retrieve saved user data and make use of it, 
        //you need to get it from wherever you saved it initially.
        //If it was stored in the postmeta table, you may get the data 
        //with get_post_meta().
        //you will need another function to save the field to the db
        //then access the db value from the relevant file
        $value = get_post_meta( $post->ID, '_hide_page_title', true );
        
        /**
         * Use Nonce for Verification
         * Name it with the file name for the action name, dont use defaults
         */
        
         wp_nonce_field( plugin_basename( __FILE__ ),'hide_title_meta_box_nonce_name')
        
        ?>
            <label for="aquila-field"><?php esc_html_e('Hide Page Title', 'aquila'); ?> </label>
            <select name="aquila_hide_title_field" id="aquila-field" class="postbox">
                <option value=""><?php esc_html_e('Select','aquila'); ?></option>
                <option value="yes" <?php selected($value, 'yes')?>>
                    <?php esc_html_e('Yes', 'aquila'); ?>
                </option>
                <option value="no" <?php selected($value, 'no')?>>
                    <?php esc_html_e('No', 'aquila'); ?>
                </option>
            </select>
        <?php
    }

    public function save_post_meta_data($post_id){
        //pass in the post id
        //find the value in the $_POST global variable
        //then update the key with the value for "aquila_hide_title_field' in
        //post meta field

        //check if current user can save post, if not exit
        if(! current_user_can("edit_post", $post_id)){
            return;
        }
        //validated nonce is the same as created
        //check to see if its in the $_post request
        // or that it has not been modified

        if(!isset($_POST['hide_title_meta_box_nonce_name']) ||
            ! wp_verify_nonce($_POST['hide_title_meta_box_nonce_name'],  plugin_basename( __FILE__ )))
        {
            return;
        }


        if ( array_key_exists( 'aquila_hide_title_field', $_POST ) ) {
            update_post_meta(
                $post_id,
                '_hide_page_title', //the meta key
                $_POST['aquila_hide_title_field']
            );
        }
    }
    

    }