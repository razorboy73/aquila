<?php
/**
 * Template for entry meta
 * 
 * @package Aquila
 * 
 */

 ?>

 <div class="entry-meta mb-3">
 
 <?php esc_html(aquila_posted_on()); ?>
 <?php esc_html(aquila_posted_by()); ?>
 <?php esc_html(wp_trim_excerpt()); ?>

 </div>