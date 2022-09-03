<?php

/**
 * Purpose of class: Loadmore_single
 * Uses the ajax function of loading more
 * 
 * @package Aquila
 */

namespace AQUILA_THEME\Inc;

use AQUILA_THEME\Inc\Traits\Singleton;
use \WP_Query;

class Loadmore_Single
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
                add_action('wp_ajax_nonpriv_single_load_more', [$this, 'ajax_script_single_post_load_more']);
                add_action('wp_ajax_single_load_more', [$this, 'ajax_script_single_post_load_more']);

                /**
                 * Create a short code
                 * Use echo do_shortcode('[single_post_listings]');
                 *https://developer.wordpress.org/reference/functions/add_shortcode/#parameters
                 * this shortcode get using on single.php and calls
                 * the single_post_load_more_container
                 */
                add_shortcode('single_post_listings', [$this, 'single_post_load_more_container']);
        }

        public function ajax_script_single_post_load_more($initial_request = false)
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
                        echo ("this failed");
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
                //if the post variable has a value for "single_post_id, return it
                $single_post_id = !empty($_POST['single_post_id']) ? $_POST['single_post_id'] : 0;
                $query = $this->get_single_load_more_query($page_no, $single_post_id);
                if ($query->have_posts()) :
                        // Loop Posts.
                        while ($query->have_posts()) : $query->the_post();
                                get_template_part('template-parts/content');
                        endwhile;
                else :
                        // Return response as zero, when no post found.
                        wp_die('0');
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

        public function single_post_load_more_container()
        {
                //find out the post ID
                //load a single additional post using a custom query
                //figure out if there are next pages, if there are no more pages,
                // exit
                //figure out the total number of posts
                $single_post_id = get_the_ID();
                //now we need to get a single post
                $load_more_query = $this->get_single_load_more_query(1, $single_post_id);
                //inspect the query to see if there are more posts
                $has_next_page = !empty($load_more_query->posts);
                // figure out total number of pages
                $total_pages = $load_more_query->max_num_pages;

                //if there are no posts, return null

                if (empty($has_next_page)) {
                        return null;
                }

                //create the container
                //for each post add in the single post id and the max pages
                //this gets rendered by the short code
?>
                <div class="single-post-loadmore-wrap">
                        <div id="single-post-load-more-content" class="single-post-loadmore">
                                <?php //This is where more posts will be added 
                                ?>
                        </div>

                        <div class="text-center mb-5 mt-5">
                                <!--when this button is clicked, we will do an ajax call to bet more posts 
                                Total pages count gets passed to the loadmore-single.js file-->
                                <button id="single-post-load-more-btn" data-page="0" data-single-post-id="<?php echo esc_attr($single_post_id); ?>" class="btn btn-info" data-max-pages="<?php echo esc_attr($total_pages); ?>">
                                        <span><?php esc_html_e("Load more stories", 'Aquila'); ?></span>
                                </button>
                                <span id="single-loading-text" class="mt-1 hidden">
                                        <?php esc_html_e("loading....", "Aquila"); ?>
                                </span>
                        </div>
                </div>
<?php
        }


        public function get_single_load_more_query($page_no, $single_post_id)
        {
                //set up a custom WPquery object

                $args = [
                        'post_status' => 'publish',
                        'posts_per_page' => 1, //this is number of posts returned
                        'paged' =>  $page_no, //number of page. Show the posts that would normally show up just on page X when using the “Older Entries” link.
                        'starting_post_id' => intval($single_post_id) //start query from next available post.  This is a custom parameter

                ];

                return new WP_Query($args);
        }
}
