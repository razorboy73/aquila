<?php

/**
 * Footer File
 * @package Aquila
 */

 
 /* widget process involves:
 * 1. extending the class
 * 2. register widget with register_widget(Name of Class )
 * 3. add_action('widgets_init', function)
 * 4 make sure there is a widget area called sidebar
 * 5 Remember the impact of namespaces
 */



 ?>
</div>

</div>
      <script src="" async defer></script>
    <footer>
      
    <h3>Footer</h3>
    <?php
    //checkif sidebar is active and if so call it
        if(is_active_sidebar('sidebar-2')){
        ?>
      <aside>

      
      <?php dynamic_sidebar('sidebar-2'); ?>
      </aside>

      <?php
    }
    ?>
    </footer>
    <?php wp_footer(); ?>
    </body>
 </html>