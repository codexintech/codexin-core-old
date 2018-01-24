(function($) {
    "use strict";

    /*--------------------------------------------------------------
                    Codexin Testimonial Type-5
    ---------------------------------------------------------------- */ 

    var cxt3_arrow = (cx_testimonial_four_params.s_arrow5 == 1) ? true : false;
    var cxt3_nav = (cx_testimonial_four_params.s_dot5 == 1) ? true : false;
    var cxt3_autoplay = (cx_testimonial_four_params.at_p5 == 1) ? true : false;
    var cx3_fade = (cx_testimonial_four_params.fade_e5 == 1) ? true : false;
    var cx3_ad_h = (cx_testimonial_four_params.ad_h5 == 1) ? true : false;

    if( cx_testimonial_four_params.count > 3 && cx_testimonial_four_params.count <= 5 ) {
        $(".slick-slider-content").slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: cxt3_arrow,
            dots: cxt3_nav,
            fade: cx3_fade,
            adaptiveHeight: cx3_ad_h,
            autoplay: cxt3_autoplay,
            autoplaySpeed: cx_testimonial_four_params.ap_spd5,
            asNavFor: ".slick-slider-nav",
            prevArrow: '<span class="prev"><i class="fa fa-angle-left"></i></span>',
            nextArrow: '<span class="next"><i class="fa fa-angle-right"></i></span>',
        }), 

        $(".slick-slider-nav").slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: ".slick-slider-content",
            dots: false,
            autoplay: cxt3_autoplay,
            
            centerMode: true,
            centerPadding: "0px",
            focusOnSelect: true,
            arrows: false,
            responsive: [{
                breakpoint: 768,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            }]
        }), $(".slick-slider-nav .slick-slide").append('<div class="cx-overlay"></div>');
    } else if( cx_testimonial_four_params.count > 5 ) {
        $(".slick-slider-content").slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: cxt3_arrow,
            fade: cx3_fade,
            dots: cxt3_nav,
            autoplay: cxt3_autoplay,
            autoplaySpeed: cx_testimonial_four_params.ap_spd5,
            adaptiveHeight: cx3_ad_h,
            asNavFor: ".slick-slider-nav",
            prevArrow: '<span class="prev"><i class="fa fa-angle-left"></i></span>',
            nextArrow: '<span class="next"><i class="fa fa-angle-right"></i></span>',
        }), 

        $(".slick-slider-nav").slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            asNavFor: ".slick-slider-content",
            dots: false,
            autoplay: cxt3_autoplay,
            
            centerMode: true,
            centerPadding: "0px",
            focusOnSelect: true,
            arrows: false,
            responsive: [{
                breakpoint: 768,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            }]
        }), $(".slick-slider-nav .slick-slide").append('<div class="cx-overlay"></div>');
    } else {
        $(".cx-testimonial-5").css('display','none').after('<div class="cx-error">Minimun requirement for this testimonial layout is not met. <br />Please add more than three testimonials from dashboard or switch to other layouts.</div>');
    }

})(jQuery);