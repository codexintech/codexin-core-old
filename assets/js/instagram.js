(function($) {
    "use strict";

     /*--------------------------------------------------------------
         Activating Instagram Image Popup
        ---------------------------------------------------------------- */
    $('.cx-image-link').magnificPopup({
        type: 'image',
        gallery: {
            enabled: true
        },
        image: {
            titleSrc: 'title',
        },
        mainClass: 'instagram-zoom', 
        fixedContentPos: false,
        fixedBgPos: true,
        overflowY: 'auto',
        zoom: {
            enabled: true,
            duration: 300, 
            easing: 'ease-in-out', 
            opener: function(openerElement) {
            return openerElement.is('img') ? openerElement : openerElement.find('img');
            }
        }

    });

})(jQuery);