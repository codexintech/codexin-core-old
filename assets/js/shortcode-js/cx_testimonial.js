(function($) {
    "use strict";

    /*--------------------------------------------------------------
                    Codexin Testimonial Type-1
    ---------------------------------------------------------------- */

    $('.cx-testimonial-1').slick({
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        adaptiveHeight: true,
        prevArrow: '<span class="prev"><i class="fa fa-angle-left"></i></span>',
        nextArrow: '<span class="next"><i class="fa fa-angle-right"></i></span>'

    });

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

        $('.cx-testimonial-4').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: cxt2_autoplay,
            autoplaySpeed: ap_spd,
            dots: cxt2_nav,
            arrows: cxt2_arrow,
            fade: cx2_fade,
            prevArrow: '<span class="prev"><i class="fa fa-angle-left"></i></span>',
            nextArrow: '<span class="next"><i class="fa fa-angle-right"></i></span>',

        });
    }

})(jQuery);