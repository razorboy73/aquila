<?php

/**
 * Header Navigation Template
 * @package aquila
 * 
 */
//get menu items to integrate with existing bootstrap classes
// first get the relevant menu item

$menu_class = \AQUILA_THEME\Inc\Menus::get_instance();
$header_menu_id = $menu_class->get_menu_id('aquila-header-menu');
//get the relevant nav menu items by passing it the right menu_id
$header_menus = wp_get_nav_menu_items($header_menu_id);
//returns an arry of menu items to loop through
//by default, parent child relationships are not displayed, but are in code
//look for menu_item_parent item, if 0, parrent
// echo"<pre>";
// print_r($header_menus);
?>




<nav class="navbar navbar-expand-lg bg-light">
  <div class="container">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <?php
        if (function_exists('the_custom_logo')) {
          /**
           * Insert comments here
           */
          the_custom_logo();
        }
        ?>
      </a>



      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <?php

        //Menus
        //confirm header menus are not empty and are in the form of an array
        //check if item is parent or not - done in class-menus.php
        //if not a parent,  use nav-item class
        //if a parent, use dropdown class

        if (!empty($header_menus) && is_array($header_menus)) {


        ?>
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <?php
            //loop through header menu items
            //need to determine if there is or is not a parent item
            //if a parent, it does not have a parent, so you need to find child items
            foreach ($header_menus as $menu_item) {
              if (!$menu_item->menu_item_parent) {
                //this means we are dealin with a parent
                //now find kids associated with the instance
                //hold all of the child menu in this variable
                $child_menu_items = $menu_class->get_child_menu_items($header_menus, $menu_item->ID);
                // check for presence of children
                $has_children = !empty($child_menu_items) && is_array($child_menu_items);

                if (!$has_children) {
            ?>


                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo esc_url($menu_item->url); ?>">
                      <?php echo esc_html($menu_item->title); ?>
                    </a>
                  </li>
                <?php
                } else {
                ?>


                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="<?php echo esc_url($menu_item->url); ?>" role="button" data-bs-toggle="collapse" aria-expanded="false">
                      <?php echo esc_html($menu_item->title); ?>
                    </a>
                    <ul class="dropdown-menu">
                      <?php
                      foreach ($child_menu_items as $child_menu_item) {
                      ?>
                        <li>
                          <a class="dropdown-item" href="<?php echo esc_url($child_menu_item->url); ?>">
                            <?php echo esc_html($child_menu_item->title); ?>
                          </a>
                        </li>
                      <?php
                      }
                      ?>

                    </ul>
                  </li>


            <?php
                }
              }
            }
            ?>
          </ul>
        <?php
        }
        ?>
        <?php get_search_form(); ?>
        <!-- <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form> -->
      </div>
    </div>
  </div>
</nav>