(function($) {
    class SlickCarousel {
       constructor(){
            this.initiateCarousel();
        }

        initiateCarousel(){
            console.log("Fuck");
            $('.posts-carousel').slick({
             
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1
            });
        }
    }

new SlickCarousel();
    
})(jQuery);