(function($) {
	"use strict";


	/*--------------------------------------------------------------
    client carouel
    ---------------------------------------------------------------- */

    if(con_play == true) {
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
            autoplay: aut_play,
            autoplaySpeed: ap_speed,
            dots:false,
            // speed: 2500,
            // cssEase: 'linear',
            arrows:show_arrow,
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