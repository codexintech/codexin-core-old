(function($) {
	"use strict";


	/*--------------------------------------------------------------
    client carouel
    ---------------------------------------------------------------- */

    var cx_autoplay = (aut_play == 1) ? true : false;
    var cx_nav = (show_dot == 1) ? true : false;
    var cx_arrow = (show_arrow == 1) ? true : false;

    if(con_play == 1) {
      $('.cx-client-carousel-01').slick({
          slidesToShow: logo_slide,
          slidesToScroll: 1,
          autoplay: true,
          autoplaySpeed: 0,
          dots:false,
          speed: play_speed,
          cssEase: 'linear',
          arrows:false,
          responsive: [
              {
                breakpoint: 1024,
                settings: {
                  slidesToShow: 3,
                  slidesToScroll: 1,
                  infinite: true,
                  dots: true
                }
              },
              {
                breakpoint: 600,
                settings: {
                  slidesToShow: 2,
                  slidesToScroll: 1
                }
              },
              {
                breakpoint: 480,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1
                }
              }]

      });

    } else {

        $('.cx-client-carousel-01').slick({
            slidesToShow: logo_slide,
            slidesToScroll: 1,
            autoplay: cx_autoplay,
            autoplaySpeed: ap_speed,
            dots:cx_nav,
            arrows:cx_arrow,
            prevArrow: '<span class="prev"><i class="fa fa-angle-left"></i></span>',
            nextArrow: '<span class="next"><i class="fa fa-angle-right"></i></span>',
            responsive: [
                {
                  breakpoint: 1024,
                  settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true
                  }
                },
                {
                  breakpoint: 600,
                  settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                  }
                },
                {
                  breakpoint: 480,
                  settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                  }
                }]

        });

    }

 })(jQuery);