<?php

/**
 * Purpose of class: Loadmore Posts
 * 
 * @package Aquila
 */

namespace AQUILA_THEME\Inc;

use AQUILA_THEME\Inc\Traits\Singleton;
use WP_Query;

class Loadmore_Posts
{
    use Singleton;
    protected function __construct()
    {
        //load other classes
        $this->setup_hooks();
    }
    protected function setup_hooks()
    {
        //actions
        //remember to use public functions
        add_action('wp_ajax_nopriv_load_more', [$this, 'ajax_script_post_load_more']);
        add_action('wp_ajax_load_more', [$this, 'ajax_script_post_load_more']);


        /**
         * Create a short code
         * 
         * Usage echo do_shortcode('[post_listings');
         */

        add_shortcode('post_listings', [$this, 'post_script_load_more']);
    }


    public function ajax_script_post_load_more($initial_request = false)
    //seting this to false lets us reuse our initial post
    {
        //because we are passing in 5 to 10 posts first, and then if user clicks load more, we load more, this allows use this function for the initial request without the ajax call
        //check the nonce
        //if initial request_is set to true, this is considred a non ajax request
        //Nothing gets done related to ajax
        if (!$initial_request && !check_ajax_referer('loadmore_post_nonce', 'ajax_nonce', false)) {
            //this name is the same as the name used to initially creat the nonce
            wp_send_json_error(__('invalid security token sent', 'aquila'));
            //Send a JSON response back to an Ajax request, indicating failure.
            wp_die('0', 400);
        }
        //check if its an ajax call and that its not empty
        $is_ajax_request = !empty($_SERVER['HTTP_X_REQUEST_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUEST_WITH']) === 'xmlhttprequest';

        /**
         * Page number
         * if get_query_var('paged') is 2 or more, it is a number pagination query.
         *  - get_query_var('paged') retrieves the value of a query variable in the WP_Query class.
         *  - paged (int) – number of page. Show the posts that would normally show 
         * -  up just on page X when using the “Older Entries” link.
         * if $_POST['page'] has a value which means it is a loadmore request, which will take precedence
         * The FILTER_VALIDATE_INT filter is used to validate value as integer.
         * FILTER_VALIDATE_INT also allows us to specify a range for the integer variable.
         */

        $page_no = get_query_var('paged') ? get_query_var('paged') : 1;
        //$_POST
        $page_no = !empty($_POST['page']) ? filter_var($_POST['page'], FILTER_VALIDATE_INT) + 1 : $page_no;

        //
        $args = [
            'post_type'      => 'post',
            'post_status'    =>  "publish",
            'posts_per_page' => 6,
            "paged"          => $page_no
        ];

        $query = new WP_Query($args);

        if ($query->have_posts()) :
            //Loop Posts
            //runs for non ajax and ajax post
            while ($query->have_posts()) :
                $query->the_post();
                get_template_part('template-parts/components/post-card');
            endwhile;
            //pagination for google
            if (!$is_ajax_request) :
                $total_pages = $query->max_num_pages;
                //https://developer.wordpress.org/reference/functions/get_template_part/
                get_template_part('template-parts/common/pagination', null, [
                    'total_pages'  => $total_pages,
                    'current_page' => $page_no,
                ]);
            endif;
        else :
            //Return response as a zero, when no post found
            wp_die();
        endif;

        wp_reset_postdata();



        /**
         * Check if its an ajax call, and not initial request
         *
         * @see https://wordpress.stackexchange.com/questions/116759/why-does-wordpress-add-0-zero-to-an-ajax-response
         */

        if ($is_ajax_request && !$initial_request) {
            wp_die();
        }
    }
    /**
     * Initial posts display
     */

    public function post_script_load_more()
    {

        // Initial Post Load.
?>
        <div class="load-more-content-wrap">
            <div id="load-more-content" class="row">
                <?php
                $this->ajax_script_post_load_more(true);
                //This sets up a situation where the fucntion considers it a non ajax request

                // If user is not in editor and on page one, show the load more.
                ?>
            </div>
            <button id="load-more" data-page="1" class="load-more-btn my-4 d-flex flex-column mx-auto px-4 py-2 border-0 bg-transparent">
                <span><?php esc_html_e('Loading...', 'aquila'); ?></span>
                <?php get_template_part('template-parts/svgs/loading'); ?>
            </button>
        </div>
<?php
    }
}
