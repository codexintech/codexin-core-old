(function($){
    "use strict";

    $( 'body' ).on( 'submit', '.mailchimp-form', function ( e ){
        e.preventDefault();
        var $mcForm = $(this),
            $button = $mcForm.find('.mailchimp-submit'),
            $error = $mcForm.find('.mailchimp-error').fadeOut(),
            $success = $mcForm.find('.mailchimp-success').fadeOut(),
            $data = $mcForm.serialize();

        $button.addClass('loading').html($button.data('loading'));
        $button.prop('disabled', true);

        $data = $data + '&action=codexin_ajax_mc';

        $.post(ajaxMailChimp.ajaxurl, $data, function(response) {
            $button.removeClass('loading').html($button.data('text'));
            $button.prop('disabled', false);

            if(response.error == '1'){
                $error.html(response.msg).fadeIn();
            }else{
                $success.fadeIn();
                $mcForm.find('input[name=firstname], input[name=lastname], [name=email]').val('');
            }
        }, 'json');
    });

})(jQuery);