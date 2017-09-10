(function($) {
    "use strict";
 
    /*--------------------------------------------------------------
	Isotope Js for Portfolio Section
    ---------------------------------------------------------------- */

    // // cache container
    // var $isocontainer = $('.portfolio-wrapper');

    // // initialize isotope

    // $isocontainer.imagesLoaded(function() {
    //     $isocontainer.isotope({
    //         filter: "*",
    //         animationOptions: {
    //             duration: 750,
    //             easing: 'linear',
    //             queue: false
    //         }
    //     });
    // });

    // $(".portfolio-filter ul li").click(function() {
    //     $(".portfolio-filter ul li").removeClass("active");
    //     $(this).addClass("active");

    //     var selector = $(this).attr('data-filter');
    //     $isocontainer.isotope({
    //         filter: selector,
    //         animationOptions: {
    //             duration: 750,
    //             easing: 'linear',
    //             queue: false,
    //         },
    //         isResizeBound: true
    //     });
    //     return false;
    // }); //isotope finished

    var $isocontainer = $('.portfolio-wrapper');

    $isocontainer.imagesLoaded(function() {
        $isocontainer.isotope({
             itemSelector: ".cx-portfolio",
             layoutMode: 'masonry',
        });

    });


    $('.portfolio-filter li').click(function(e) {
         var $this = $(this);
         var $filter = $this.attr('data-filter');

        $isocontainer.isotope({
            filter: $filter,
        });

        $('.portfolio-filter li').removeClass('active');
        $this.addClass('active');
    });











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


