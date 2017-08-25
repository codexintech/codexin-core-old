
(function($) {
    "use strict";
 
    /*--------------------------------------------------------------
	validation js for contact-form Section
    ---------------------------------------------------------------- */

    function form_validation(id_or_class){
    $(id_or_class).validate({

        rules: {
            name: {
                required: true,
                minlength: 2
            },

            email: {
                required: true,
                email: true
            },

            subject: {
                required: true,
                minlength: 5
            },
            message:{
                required: true,
                minlength: 5
            }
        },

        messages: {
            author: "Please provide a valid name",
            email: "Please provide a valid email",
            comment: "Comments needs to be at least 5 characters"
        },

        errorElement: "div",
        errorPlacement: function(error, element) {
            element.after(error);
        }

    }); 
}

form_validation('.newsletter-validatation');
form_validation('.form-validatation');
form_validation('.form-rv2-row');

})(jQuery);


