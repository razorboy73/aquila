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
            
            //options for the intersection observer
            this.options = {
                root: null,//the element that is used as the viewport for checking visibility of the target(the loadmore button.  Must be ancestor.  Null meands that it defaults to the browser view port
                rootMargin: '0px',//margin around root element
                Threshold: 1.0 //1.0 means set isintersecting to true when element comes in 100% view
            };
            
            //initialize the function
            this.init();
        };

        init(){
            //make sure load button is not missing
            if(!this.loadMoreBtn.length){
                return;
            }




            /**
             * Add the interesectionobserver api and listen to the load more intersection status
             * so that intersectionObserverCallback gets call when status goes to 1
             * 
             * @type {IntersectionObserver}
             */
             const observer = new IntersectionObserver(
                (entries) => this.intersectionObserverCallback(entries),
                this.options
                );
               
            observer.observe(this.loadMoreBtn[0]);
                
            //add event handler to call a function on click
            //hide so it works just on scroll
			//this.loadMoreBtn.on('click', () => this.handleLoadMorePosts());
        }

        /**
         * Gets called on inital render with status 'isIntersecting' as false and then
         * every element intersection status changes
         * @param {array} entries No of elements und
         */

        intersectionObserverCallback(entries){
            //array of observing elements
            //The logic is apply for each entry(in this case it is just one loadmorebutton)
        
            entries.forEach((entry)=>{
                //If load more button in view
                if(entry?.isIntersecting){
                    this.handleLoadMorePosts();
                }
            });
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