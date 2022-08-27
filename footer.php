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
<footer id="site-footer" class="bg-light p-4">

  <div class="container color-gray">
    <div class="row">
      <section class="col-lg-4 col-md-6 col-sm-12">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta, quis repellat tempore, magni corporis ex quibusdam repellendus velit nostrum laboriosam explicabo, harum ea quidem! Aliquam quas tempore vitae quia tenetur.
      </section>

      <section class="col-lg-4 col-md-6 col-sm-12">

        <?php
        //checkif sidebar is active and if so call it
        if (is_active_sidebar('sidebar-2')) {
        ?>
          <aside>


            <?php dynamic_sidebar('sidebar-2'); ?>
          </aside>

        <?php
        }
        ?>
      </section>
      <section class="col-lg-4 col-md-6 col-sm-12">
        <ul class="d-flex">
          <li class="list-unstyled"><a href="https://facebook.com" title="facebook">
              <svg width="48">
                <use href="#icon-facebook"></use>
              </svg>

            </a></li>
          <li class="list-unstyled"><a href="https://twitter.com" title="twitter">
              <svg width="48">
                <use href="#icon-twitter"></use>
              </svg>

            </a></li>
          <li class="list-unstyled"><a href="https://linkedin.com" title="linkedin">
              <svg width="48">
                <use href="#icon-linkedin"></use>
              </svg>
            </a></li>
        </ul>

      </section>
    </div>
  </div>

</footer>
<?php
get_template_part('template-parts/content', 'svgs');

wp_footer(); ?>
</body>

</html>