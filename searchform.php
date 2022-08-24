<?php

/**
 * Custom Search Form
 */
?>


<!-- <form class="d-flex" role="search">
    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success" type="submit">Search</button>
</form> -->

<form class="form-inline my-2 my-log-0" method="get" role="search" action="<?php echo esc_url(home_url('/')) ?>">
    <span class="screen-reader-text"><?php echo _x('Search for:', 'label', 'aquila'); ?></span>
    <input class="form-control mr-sm-2" type="search" placeholder="<?php esc_attr_x('Search', 'placeholder', 'aquila'); ?>" value="<?php the_search_query(); ?>" aria-label=" Search" name="s">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><?php echo esc_attr_x('Search', 'submit', 'aquila'); ?></button>
</form>