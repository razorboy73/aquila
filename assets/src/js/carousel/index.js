(function($) {
    class SlickCarousel {
       constructor(){
            this.initiateCarousel();
        }

        initiateCarousel(){
            console.log("Fuck");
            $('.posts-carousel').slick({
                autoplay: true,
                autoplay:1000,
                slidesToShow: 3,
                slidesToScroll: 1,
                responsive: [
                    {
                      breakpoint: 768,
                      settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                      }
                    },
                    {
                      breakpoint: 600,
                      settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                      }
                    },
                    {
                      breakpoint: 480,
                      settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                      }
                    }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
              ]
            });
        }
    }

new SlickCarousel();
    
})(jQuery);