(function($) {
    "use strict";

    /*--------------------------------------------------------------
                    Codexin Testimonial Type-4
    ---------------------------------------------------------------- */ 

    var cxt2_autoplay = (cx_testimonial_three_params.at_p == 1) ? true : false;
    var cxt2_nav = (cx_testimonial_three_params.s_dot == 1) ? true : false;
    var cxt2_arrow = (cx_testimonial_three_params.s_arrow == 1) ? true : false;
    var cx2_fade = (cx_testimonial_three_params.fade_e == 1) ? true : false;
    var cx2_ad_h = (cx_testimonial_three_params.ad_h4 == 1) ? true : false;

    $('.cx-testimonial-4').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: cxt2_autoplay,
        autoplaySpeed: cx_testimonial_three_params.ap_spd,
        dots: cxt2_nav,
        adaptiveHeight: cx2_ad_h,
        arrows: cxt2_arrow,
        fade: cx2_fade,
        prevArrow: '<span class="prev"><i class="fa fa-angle-left"></i></span>',
        nextArrow: '<span class="next"><i class="fa fa-angle-right"></i></span>',

    });

})(jQuery);