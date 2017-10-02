(function($) {
    "use strict";

    /*--------------------------------------------------------------
	accordian on events section
    ---------------------------------------------------------------- */

    $('.accordion-toggle').on('click', function() {
        $(this).closest('.panel-group').children().each(function() {
            $(this).find('>.panel-heading').removeClass('active');
        });

        $(this).closest('.panel-heading').toggleClass('active');
    });


    $('.events-carousel').slick({
        dots: true,
        infinite: false,
        speed: 300,
        slidesToShow: 2,
        slidesToScroll: 1,
        arrows: true,
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