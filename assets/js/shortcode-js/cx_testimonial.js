(function($) {
    "use strict";

    /*--------------------------------------------------------------
                    Codexin Testimonial Type-1
    ---------------------------------------------------------------- */

    if($('div').hasClass('cx-testimonial-1')){
        var cxt_h1 = (ad_h1 == 1) ? true : false;
        var cxt_fade1 = (fd1 == 1) ? true : false;
        var cxt_arrow1 = (sh_arrow1 == 1) ? true : false;
        $('.cx-testimonial-1').slick({
            infinite: true,
            speed: 300,
            slidesToShow: 1,
            adaptiveHeight: cxt_h1,
            fade: cxt_fade1,
            arrows: cxt_arrow1,
            prevArrow: '<span class="prev"><i class="fa fa-angle-left"></i></span>',
            nextArrow: '<span class="next"><i class="fa fa-angle-right"></i></span>'

        });
    }

    /*--------------------------------------------------------------
                    Codexin Testimonial Type-3
    ---------------------------------------------------------------- */

    if($('div').hasClass('cx-testimonial-3')){
        var cxt_autoplay = (aut_p == 1) ? true : false;
        var cxt_nav = (sh_dot == 1) ? true : false;
        var cxt_arrow = (sh_arrow == 1) ? true : false;

        $('.cx-testimonial-3').slick({
        slidesToShow: 2,
            slidesToScroll: 1,
            autoplay: cxt_autoplay,
            autoplaySpeed: ap_sp,
            dots: cxt_nav,
            arrows: cxt_arrow,
            prevArrow: '<span class="prev"><i class="fa fa-angle-left"></i></span>',
            nextArrow: '<span class="next"><i class="fa fa-angle-right"></i></span>',
        });
    }

    /*--------------------------------------------------------------
                    Codexin Testimonial Type-4
    ---------------------------------------------------------------- */ 

    if($('div').hasClass('cx-testimonial-4')){
        var cxt2_autoplay = (at_p == 1) ? true : false;
        var cxt2_nav = (s_dot == 1) ? true : false;
        var cxt2_arrow = (s_arrow == 1) ? true : false;
        var cx2_fade = (fade_e == 1) ? true : false;
        var cx2_ad_h = (ad_h4 == 1) ? true : false;

        $('.cx-testimonial-4').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: cxt2_autoplay,
            autoplaySpeed: ap_spd,
            dots: cxt2_nav,
            adaptiveHeight: cx2_ad_h,
            arrows: cxt2_arrow,
            fade: cx2_fade,
            prevArrow: '<span class="prev"><i class="fa fa-angle-left"></i></span>',
            nextArrow: '<span class="next"><i class="fa fa-angle-right"></i></span>',

        });
    }

    /*--------------------------------------------------------------
                    Codexin Testimonial Type-5
    ---------------------------------------------------------------- */ 

    if($('div').hasClass('cx-testimonial-5')){

        var cxt3_arrow = (s_arrow5 == 1) ? true : false;
        var cxt3_nav = (s_dot5 == 1) ? true : false;
        var cxt3_autoplay = (at_p5 == 1) ? true : false;
        var cx3_fade = (fade_e5 == 1) ? true : false;
        var cx3_ad_h = (ad_h5 == 1) ? true : false;

        if( count > 3 && count <= 5 ) {
            $(".slick-slider-content").slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: cxt3_arrow,
                dots: cxt3_nav,
                fade: cx3_fade,
                adaptiveHeight: cx3_ad_h,
                autoplay: cxt3_autoplay,
                autoplaySpeed: ap_spd5,
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
        } else if( count > 5 ) {
            $(".slick-slider-content").slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: cxt3_arrow,
                fade: cx3_fade,
                dots: cxt3_nav,
                autoplay: cxt3_autoplay,
                autoplaySpeed: ap_spd5,
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
    }

})(jQuery);