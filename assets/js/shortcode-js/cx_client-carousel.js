(function($) {
	"use strict";


	/*--------------------------------------------------------------
    client carouel
    ---------------------------------------------------------------- */

    $(".owl-carousel").owlCarousel({

        autoPlay: 3000, //Set AutoPlay to 3 seconds
        navigation: false,
        pagination: false,
        items: logo_slide.slide,
        itemsDesktop: [1199, 6],
        itemsDesktopSmall: [991, 5],
        itemsTablet: [767, 5],
        itemsTabletSmall: [599, 4],
        itemsMobile: [420, 3]

    });


 })(jQuery);