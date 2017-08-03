
	/*--------------------------------------------------------------
    Google Map Customization
    ---------------------------------------------------------------- */

        (function(){

            var map;

            map = new GMaps({
                el: '#gmap',
                lat: reveal_lat,
                lng: reveal_long,
                scrollwheel:false,
                zoom: reveal_m_zoom,
                zoomControl : true,
                panControl : false,
                streetViewControl : false,
                mapTypeControl: true,
                overviewMapControl: false,
                clickable: false
            });

            // var image = 'images/map-marker.png';
            var image = reveal_marker;
            map.addMarker({
                lat: reveal_lat,
                lng: reveal_long,
                icon: image,
                animation: google.maps.Animation.DROP,
                verticalAlign: 'bottom',
                horizontalAlign: 'center',
                backgroundColor: '#3e8bff',
            });


            var styles = [ 

            {
                "featureType": "road",
                "stylers": [
                { "color": reveal_map_color }
                ]
            },{
                "featureType": "water",
                "stylers": [
                { "color": "#d8d8d8" }
                ]
            },{
                "featureType": "landscape",
                "stylers": [
                { "color": "#f1f1f1" }
                ]
            },{
                "elementType": "labels.text.fill",
                "stylers": [
                { "color": "#000000" }
                ]
            },{
                "featureType": "poi",
                "stylers": [
                { "color": "#d9d9d9" }
                ]
            },{
                "elementType": "labels.text",
                "stylers": [
                { "saturation": 1 },
                { "weight": 0.1 },
                { "color": "#000000" }
                ]
            }

            ];

            map.addStyle({
                styledMapName:"Styled Map",
                styles: styles,
                mapTypeId: "map_style"  
            });

            map.setStyle("map_style");
        }());


