<?php

/**
 * Header File
 * @package Aquila
 */

 ?>

<!DOCTYPE html>
 <!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
 <!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
 <!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
 <!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
 <html lang="<?php language_attributes(); ?>">
    <head>
        <meta charset="<?php bloginfo( "charset" )?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Wordpress Theme</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
        <?php wp_head();?>
    </head>
    <body <?php body_class()?>>
    <?php
    if (function_exists('wp_body_open')){
    /**
    * Check to allow for backwards compatability
    */
        wp_body_open();
        
    }
    ?>

    <div id="page" class="site">
        <header id="masthead" class="site-header" role="banner">
            <!--leave off the php -->
            <?php get_template_part("template-parts/header/nav"); ?>
            <!--if you have specific pages, use the page name as a second variable -->
            <?php get_template_part("template-parts/content","post"); ?>

        </header>
        <div id="content" class="site-content">

  
    