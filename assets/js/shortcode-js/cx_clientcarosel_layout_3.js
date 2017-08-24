
(function($) {
	"use strict";


	/*--------------------------------------------------------------
    client carouel v2 layout-3
    ---------------------------------------------------------------- */

   $("#client-carousel-rv2").owlCarousel({

		autoPlay: true, //Set AutoPlay to 3 seconds
		navigation: false,
		pagination: false,
		margin:180,
		items : 5,
		responsive:{
		    0:{
		        items:2,
		        margin:80

		    },
		    600:{
		        items:4,
		        margin:100
		    },
		    1000:{
		        items:5,
		        margin:100
		    }
		}

	});

	$(".client-comment-curosel").owlCarousel({
		loop:true,
		nav:false,
		autoplay:true,
		responsive:{
		    0:{
		        items:1
		    },
		    600:{
		        items:2
		    },
		    1000:{
		        items:2
		    }
		}

	});


 })(jQuery);

	