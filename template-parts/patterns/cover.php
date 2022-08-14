<?php
/**
 * Cover Block  Pattern Template
 * @package aquila
 */


 ?>

 <!-- wp:cover {"url":"<?php echo (esc_url(AQUILA_BUILD_IMG_URI.'/patterns/cover-1.jpg')) ?>","id":981,"dimRatio":50,"minHeight":640,"align":"full"} -->
<div class="wp-block-cover alignfull" style="min-height:640px"><span aria-hidden="true" class="wp-block-cover__gradient-background has-background-dim"></span><img class="wp-block-cover__image-background wp-image-981" alt="" src="<?php echo (esc_url(AQUILA_BUILD_IMG_URI.'/patterns/cover-1.jpg'))?>" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:heading {"textAlign":"center","level":1} -->
<h1 class="has-text-align-center">Never let your memories be greater than your dreams</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","textColor":"cyan-bluish-gray"} -->
<p class="has-text-align-center has-cyan-bluish-gray-color has-text-color">A fool who knows he is a fool is not a big fool</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"align":"full","layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons alignfull"><!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link">Blogs</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:cover -->