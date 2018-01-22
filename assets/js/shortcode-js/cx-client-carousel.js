(function($) {
    "use strict";


    /*--------------------------------------------------------------
    client carouel
    ---------------------------------------------------------------- */

    var cx_autoplay = (cx_client_params.aut_play == 1) ? true : false;
    var cx_nav      = (cx_client_params.show_dot == 1) ? true : false;
    var cx_arrow    = (cx_client_params.show_arrow == 1) ? true : false;

    if (cx_client_params.con_play == 1) {
        $('.cx-client-carousel-1').slick({
            slidesToShow: cx_client_params.logo_slide,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 0,
            dots: false,
            speed: cx_client_params.play_speed,
            cssEase: 'linear',
            arrows: false,
            responsive: [{
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2,
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
            ]

        });

    } else {

        $('.cx-client-carousel-1').slick({
            slidesToShow: cx_client_params.logo_slide,
            slidesToScroll: 1,
            autoplay: cx_autoplay,
            autoplaySpeed: cx_client_params.ap_speed,
            dots: cx_nav,
            arrows: cx_arrow,
            prevArrow: '<span class="prev"><i class="fa fa-angle-left"></i></span>',
            nextArrow: '<span class="next"><i class="fa fa-angle-right"></i></span>',
            responsive: [{
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2,
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
            ]

        });

    }

})(jQuery);