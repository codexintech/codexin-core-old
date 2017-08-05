/*--------------------------------------------------------------
    Activating portfolio Magnific Pop Up
    ---------------------------------------------------------------- */    
    
    $('.portfolio-img-popup').magnificPopup({
        type: 'image',
        mainClass: 'mfp-with-zoom', 
        fixedContentPos: true,
        fixedBgPos: true,   
        zoom: {
            enabled: true,
            duration: 300, 
            easing: 'ease-in-out',
            opener: function(openerElement) {
                return openerElement.is('a') ? openerElement : openerElement.find('a');
            }
        },
        callbacks: {
            open: function() {
                jQuery('body').addClass('noscroll');
                
            },
            close: function() {
                jQuery('body').removeClass('noscroll');                
            }
        }
    });