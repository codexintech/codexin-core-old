(function($) {
	"use strict";


	/*--------------------------------------------------------------
    Activating Magnific Pop Up
    ---------------------------------------------------------------- */

    $('.img-pop-up').magnificPopup({
        type: 'image',
        gallery: {
            enabled: true
        },

        fixedContentPos: false,
        fixedBgPos: true,

        overflowY: 'auto',

        closeBtnInside: true,
        preloader: false,

        midClick: true,
        removalDelay: 300,
        mainClass: 'mfp-fade'

    });


 })(jQuery);