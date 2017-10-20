(function($) {
    "use strict";
 
    /*--------------------------------------------------------------
	Isotope Js for Portfolio Section
    ---------------------------------------------------------------- */

    var $isocontainer = $('.portfolio-item-wrapper');

    $isocontainer.imagesLoaded(function() {
        $isocontainer.isotope({
             itemSelector: ".cx-portfolio",
             layoutMode: 'masonry',
             //percentPosition: true,
        });

    });


    $('.portfolio-filter li').not($('.view-more')).click(function(e) {
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

    $(".portfolio-title, .portfolio-readmore").click(function (e) {
        $(this).find("a.clickable").first().click();
    });

    $(".portfolio-title a.clickable, .portfolio-readmore a.clickable").click(function (e) {
        e.stopPropagation();
    });

})(jQuery);


