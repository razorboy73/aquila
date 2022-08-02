<?php
/**
 * No Content template part
 * 
 * @package  Aquila
 */



 ?>

 <section class="no-result not-found">

    <header class="page-header">
        <h1 class="page-title">
            <?php esc_html_e("Nothing Found", "aquila"); ?>
        </h1>
    </header>

    <div class="page-content">
        <?php
        //if the user is on the blog home page and can publish
        //posts, prompt them to post, otherwise check if search page, and if so request user
        //to redo search
            if(is_home() && current_user_can('publish_posts')){
        ?>
        <p>
            <?php
            //1. Internationalize
            //2. sanitize
            //3. format string
            //use a formatted string to print link
            //use wp_kses to limit html 
            //while using internationalization
            printf(

                wp_kses(
                    __('Ready to publish your first post? <a href="%s">Get started here</a>','aquila'),
                        [
                            'a' => [
                                'href' => []
                            ]
                        ]
                    ),
                //admin_url Retrieves the URL to the admin area for the current site.
                esc_url(admin_url('post-new.php'))
            )
            ?>
        </p>
        <?php
            }elseif(is_search()){
            ?>
            <p>
                <?php esc_html_e("Sorry, nothing matched your search item, please try again", "aquila") ?>
            </p>
            <?php  
                get_search_form();  
            }else{
                ?>
                <p>
                    <?php esc_html_e("Sorry, nothing matched your search item, please try again", "aquila") ?>
                </p>
                <?php
                    get_search_form();

            }
        ?>
    </div>
 </section>