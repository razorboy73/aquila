//include this in main.js
//enqueue the function in class-assets.php

(function($){
    class LoadMoreSingle{
        constructor(){
            //we past the siteconfig using the WP localized script
            //localize function is in the asset file
            //this make the site config object available to this file

            this.ajaxUrl = siteConfig?.ajaxUrl ?? '';
            this.ajaxNonce = siteConfig?.ajax_nonce ?? '';
            //catch the load more button
            this.loadMoreBtn = $('#single-post-load-more-btn');
            //add pagination for google
            this.loadingTextEl = $('#single-loading-text');
            this.isRequestProcessing = false;
            
            //options for the intersection observer
            // this.options = {
            //     root: null,//the element that is used as the viewport for checking visibility of the target(the loadmore button.  Must be ancestor.  Null meands that it defaults to the browser view port
            //     rootMargin: '0px',//margin around root element
            //     Threshold: 1.0 //1.0 means set isintersecting to true when element comes in 100% view
            // };
            
            //initialize the function
            this.init();
        }

        init(){
            //make sure load button is not missing
            if(!this.loadMoreBtn.length){
                return;
            }

            //gets this info from the container funcing in class-loadmore-single
            this.totalPagesCount = $( "post-pagination").data('max-pages');

            //Capture button click
            this.loadMoreBtn.on('click', ()=>{
                this.handleLoadMorePosts();
            });
            
        }  
        /**
		 * Load more posts.
		 *
		 * 1.Make an ajax request, by incrementing the page no. by one on each request.
		 * 2.Append new/more posts to the existing content.
		 * 3.If it's the last page, remove the load-more button from DOM.
		 *
		 * @return null
		 */

        

        //create a function that runs every time the load more button is hit
        handleLoadMorePosts(){
        //this is where we put the ajax function for the ajax call
        //grab the admin url and nonce that gets passed by php using wp_localize
        //set the action name
        //pass in the ajaxNonce
        // get the page number from the load more button the "data-page" element
            const page = this.loadMoreBtn.data('page');
            //get single Post ID from the load more button
            const singlePostId = this.loadMoreBtn.data('single-post-id');
            //if page is false or a request is processing
            if(page ==undefined||this.isRequestProcessing){
                return null;
            }

            const nextPage = parseInt(page) +1;// increment page count by one
            this.toggleLoading(true);


            $.ajax({
                //this data is available in $_Post
                //gets the page number from the page const
                //Single post id originates in the class file and JS grabs it
                //action name is the same one as is defined in the ajax hook in the class file
                url:this.ajaxUrl,
                type:'post',
                data:{
                    page:page,
                    single_post_id:singlePostId,
                    action:'single_load_more',
                    ajax_nonce: this.ajaxNonce,
                },
                success: (response) =>{
                    //response is zero if no more posts are available
                    //remove element
                    this.loadMoreBtn.data('page',nextPage);
                    $('#single-post-load-more-content').append(response);
                    //remove the button on last page so we cant make another request
                    this.removeLoadMoreIfOnLastPage(nextPage);
                    this.toggleLoading(false)
                    //this.isRequestProcessing = false;
                    // if(0 === parseInt(response)){
                    //     this.loadMoreBtn.remove();
                
                    // }else{
                    //     //this modifies the data page by one, so the 
                    //     //we already have the number of the next page available
                    //     this.loadMoreBtn.data('page', newPage);
                    //     $('#load-more-content').append(response);
                    
                },
            error:(response) => {
                console.log(response);
                //prevent sending another request if the previous request is in place
                this.toggleLoading(false);
            },
        });
        }

        /**
		 * Remove Load more Button If on last page.
		 *
		 * @param {int} nextPage New Page.
		 */
		removeLoadMoreIfOnLastPage( nextPage ) {
            //if we exceed total page count, remove button
			if ( nextPage + 1 > this.totalPagesCount ) {
				this.loadMoreBtn.remove();
			}
        };

        /**
		 * Toggle Loading
		 *
		 * Show or hide the loading text by modifying classes
		 *
		 * @param isLoading
		 */

         toggleLoading( isLoading ) {
			this.isRequestProcessing = isLoading;
			
			if ( isLoading ) {
				this.loadingTextEl.addClass( 'block' );
				this.loadingTextEl.removeClass( 'hidden' );
			} else {
				this.loadingTextEl.addClass( 'hidden' );
				this.loadingTextEl.removeClass( 'block' );
			}
		};
    }

    new LoadMoreSingle();
})(jQuery);