<?php

/**
 * Footer File
 * @package Aquila
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