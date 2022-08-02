<?php
/**
 * Front Page template
 * @package Aquila
 */


get_header("");
 ?>


<!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
<div class="content">
<?php esc_html_e("Front Page", "aquila"); ?>

</div>


<?php
get_footer(); ?>
