(function($) {
	"use strict";

    $('.cx-testimonial-1').slick({
      infinite: true,
      speed: 300,
      slidesToShow: 1,
      adaptiveHeight: true,
      prevArrow: '<span class="prev"><i class="fa fa-angle-left"></i></span>',
      nextArrow: '<span class="next"><i class="fa fa-angle-right"></i></span>'

    });

	/*--------------------------------------------------------------
    client Feet Back carouel / Testiomonial
    ---------------------------------------------------------------- */

    $('.client-comment-curosel').slick({
    slidesToShow: 2,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    dots:true,
    arrows:false
  });


 })(jQuery);