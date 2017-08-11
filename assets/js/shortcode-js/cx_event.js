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


})(jQuery);