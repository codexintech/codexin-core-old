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

  /*-----------------------------------------------------
    Client Feedback - 4
  -------------------------------------------------------*/  
  $('.client-comment-curosel-rv3').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: false,
    autoplaySpeed: 2000,
    dots:false,
    arrows:true,
    prevArrow:'<button type="button" class="slick-prev"><i class="fa fa-angle-left"></i></button>',
      nextArrow:'<button type="button" class="slick-next"><i class="fa fa-angle-right"></i></button>',

  });  

 })(jQuery);