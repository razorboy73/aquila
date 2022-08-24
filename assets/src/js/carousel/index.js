(function($) {
    class SlickCarousel {
       constructor(){
            this.initiateCarousel();
        }

        initiateCarousel(){
            console.log("Fuck");
            $('.posts-carousel').slick({
                autoplay: true,
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1
            });
        }
    }

new SlickCarousel();
    
})(jQuery);