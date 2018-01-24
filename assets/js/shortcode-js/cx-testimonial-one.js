(function($) {
    "use strict";

    /*--------------------------------------------------------------
                    Codexin Testimonial Type-1
    ---------------------------------------------------------------- */

    var cxt_h1 = (cx_testimonial_one_params.ad_h1 == 1) ? true : false;
    var cxt_fade1 = (cx_testimonial_one_params.fd1 == 1) ? true : false;
    var cxt_arrow1 = (cx_testimonial_one_params.sh_arrow1 == 1) ? true : false;

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

})(jQuery);