//include this in main.js
//enqueue the function in class-assets.php

(function($){
    class LoadMore{
        constructor(){
            //we past the siteconfig using the WP localized script
            //this make the site config object available to this file

            this.ajaxUrl = siteConfig?.ajaxUrl ??'';
            this.ajaxNonce = siteConfig?.ajax_nonce ??'';
        };

        //create a function that runs every time the load more button is hit
        handleLoadMorePosts(){
        //this is where we put the ajax function for the ajax call
        //grab the admin url and nonce that gets passed by php using wp_localize
        //set the action name
        //pass in the ajaxNonce
        $.ajax({
            url:this.ajaxUrl,
            type:'post',
            data:{
                action:'load_more',
                ajax_nonce: this.ajaxNonce
            }
        })

        }
    }
}
)