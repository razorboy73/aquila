<?php

/**
 * Purpose of class: Archive Settings
 * 
 * @package Aquila
 */

namespace AQUILA_THEME\Inc;

use AQUILA_THEME\Inc\Traits\Singleton;

class  Archives_Settings
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
        //Fires after the query variable object is created, but before the actual query is run.
        add_action('pre_get_posts', [$this, 'change_archive_posts_per_page']);
    }


    public function change_archive_posts_per_page($query)
    {


        // if the query is an archive, not an admin page and is main query
        //if the query is a search, make sure the query_vars['s']isnt empty
        if ($query->is_archive && !is_admin() && $query->is_main_query()) {
            $query->set('posts_per_page', strval(AQUILA_ARCHIVE_POST_PER_PAGE));
        } else if (!empty($query->query_vars['s']) && !is_admin()) {
            //for search result page only
            $query->set('posts_per_page', strval(AQUILA_ARCHIVE_POST_PER_PAGE));
        }
        return $query;
    }
}
