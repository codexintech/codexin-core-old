(function($) {
    "use strict";
 
    /*--------------------------------------------------------------
	Isotope Js for Portfolio Section
    ---------------------------------------------------------------- */

    // cache container
    var $isocontainer = $('.portfolio-wrapper');

    // initialize isotope

    $isocontainer.imagesLoaded(function() {
        $isocontainer.isotope({
            filter: "*",
            animationOptions: {
                duration: 750,
                easing: 'linear',
                queue: false
            }
        });
    });

    $(".portfolio-filter ul li").click(function() {
        $(".portfolio-filter ul li").removeClass("active");
        $(this).addClass("active");

        var selector = $(this).attr('data-filter');
        $isocontainer.isotope({
            filter: selector,
            animationOptions: {
                duration: 750,
                easing: 'linear',
                queue: false,
            },
            isResizeBound: true
        });
        return false;
    }); //isotope finished


    /*--------------------------------------------------------------
    Targeting Portfolio a tag for click event
    ---------------------------------------------------------------- */

    $(".portfolio-title").click(function (e) {
        $(this).find("a.clickable").first().click();
    });

    $(".portfolio-title a.clickable").click(function (e) {
        e.stopPropagation();
    });

})(jQuery);


