//include this in main.js
//enqueue the function in class-assets.php

(function($){
    class LoadMore{
        constructor(){
            //we past the siteconfig using the WP localized script
            //this make the site config object available to this file

            this.ajaxUrl = siteConfig?.ajaxUrl ?? '';
            this.ajaxNonce = siteConfig?.ajax_nonce ?? '';
            //catch the load more buttong
            this.loadMoreBtn = $('#load-more');
            //initialize the function

            this.init();
        };

        init(){
            //make sure load button is not missing
            if(!this.loadMoreBtn.length){
                return;
            }

            //add event handler to call a function on click
			this.loadMoreBtn.on('click', () => this.handleLoadMorePosts());
        }

        //create a function that runs every time the load more button is hit
        handleLoadMorePosts(){
        //this is where we put the ajax function for the ajax call
        //grab the admin url and nonce that gets passed by php using wp_localize
        //set the action name
        //pass in the ajaxNonce
        // get the page number from the load more button the "data-page" element
            const page = this.loadMoreBtn.data('page');
            if(!page){
                return null;
            }
            const newPage = parseInt(page) +1;// increment page count by one

            $.ajax({
                //this data is available in $_Post
                url:this.ajaxUrl,
                type:'post',
                data:{
                    page:page,
                    action:'load_more',
                    ajax_nonce: this.ajaxNonce,
                },
                success: (response) =>{
                    //response is zero if no more posts are available
                    //remove element
                    if(0 === parseInt(response)){
                        this.loadMoreBtn.remove();
                
                    }else{
                        //this modifies the data page by one, so the 
                        //we already have the number of the next page available
                        this.loadMoreBtn.data('page', newPage);
                        $('#load-more-content').append(response);
                    }
                },
            error:(response) => {
                //console.log(response)
            },
            });
            }
    }
new LoadMore();
})(jQuery);