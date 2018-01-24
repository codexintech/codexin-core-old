(function($) {
    "use strict";

    /*--------------------------------------------------------------
                    Codexin Testimonial Type-3
    ---------------------------------------------------------------- */

    var cxt_autoplay = (cx_testimonial_two_params.aut_p == 1) ? true : false;
    var cxt_nav = (cx_testimonial_two_params.sh_dot == 1) ? true : false;
    var cxt_arrow = (cx_testimonial_two_params.sh_arrow == 1) ? true : false;

    $('.cx-testimonial-3').slick({
    slidesToShow: 2,
        slidesToScroll: 1,
        autoplay: cxt_autoplay,
        autoplaySpeed: cx_testimonial_two_params.ap_sp,
        dots: cxt_nav,
        arrows: cxt_arrow,
        prevArrow: '<span class="prev"><i class="fa fa-angle-left"></i></span>',
        nextArrow: '<span class="next"><i class="fa fa-angle-right"></i></span>',
    });

})(jQuery);