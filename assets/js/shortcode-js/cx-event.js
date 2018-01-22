(function($) {
    "use strict";

    /*--------------------------------------------------------------
    carousel on events section
    ---------------------------------------------------------------- */

    var event_arrow = (cx_event_params.ev_arrow == 1) ? true : false;
    var event_dot   = (cx_event_params.ev_dot == 1) ? true : false;
    $('.events-carousel').slick({
        dots: event_dot,
        infinite: false,
        autoplay: false,
        speed: 300,
        slidesToShow: 2,
        slidesToScroll: 1,
        arrows: event_arrow,
        prevArrow:'<span class="prev"><i class="fa fa-angle-left"></i></span>',
        nextArrow:'<span class="next"><i class="fa fa-angle-right"></i></span>',
        responsive: [
            {
                breakpoint: 991,
                settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
                infinite: true,
                arrows: false,
                dots: true
                }
            },
            {
                breakpoint: 748,
                settings: {
                slidesToShow: 1,
                arrows: false,
                slidesToScroll: 1
                }
            }
        ]
    });


})(jQuery);