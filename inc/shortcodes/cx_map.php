<?php

/**
 * Shortcode -  Map
 *
 * @since 1.0
 */

// Do not allow directly accessing this file.
defined( 'ABSPATH' ) OR die( esc_html__( 'This script cannot be accessed directly.', 'codexin' ) );

// Registering Map Shortcode
function cx_map_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
			'img_alt'		 	=> '',
			'gmap_color' 	 	=> '',
			'gmap_latitude'  	=> '',
			'gmap_longitude' 	=> '',
			'gmap_zoom_level' 	=> '',
			'gmap_marker' 	 	=> '',
			'map_scroll'		=> '',
			'map_type'			=> '',
			'map_zoom'			=> '',
			'map_street_view'	=> '',
			'map_fullscreen'	=> '',
			'map_advanced'		=> '',
			'road_color'		=> '',
			'water_color'		=> '',
			'landscape_color'	=> '',
			'poi_color'			=> '',
			'label_text_color'	=> '',
	), $atts ) );

	// Retrieving the image url
	$ret_full_img_url 	= codexin_retrieve_img_src( $gmap_marker, '' );

	// Assigning a master css class and hooking into KC
	$master_class 		= apply_filters( 'kc-el-class', $atts );
	$master_class[] 	= 'map-wrapper';

	$result = '';

	ob_start(); 

	// Building variables to pass values to javascript
	// $gmap_color 		= ( $map_advanced ) ? 'custom' : '';
	if( $map_advanced ) {
		$gmap_color = 'custom';
	}

	$map_color 			= ( ! empty( $gmap_color ) ) ? $gmap_color : '';
	$lat 				= ( ! empty( $gmap_latitude ) ) ? $gmap_latitude : '';
	$long 				= ( ! empty( $gmap_longitude ) ) ? $gmap_longitude : '';
	$gmap_marker 		= ( ! empty( $ret_full_img_url ) ) ? $ret_full_img_url : '';
	$c_zoom 			= ( ! empty( $gmap_zoom_level ) ) ? $gmap_zoom_level : '';
	$gmap_scroll 		= ( $map_scroll ) ? true : false;
	$gmap_type 			= ( $map_type ) ? true : false;
	$gmap_zoom 			= ( $map_zoom ) ? true : false;
	$gmap_street_view 	= ( $map_street_view ) ? true : false;
	$gmap_fullscreen 	= ( $map_fullscreen ) ? true : false;

	$gmap_road 			= ( ! empty( $road_color ) ) ? $road_color : '';
	$gmap_water			= ( ! empty( $water_color ) ) ? $water_color : '';
	$gmap_land			= ( ! empty( $landscape_color ) ) ? $landscape_color : '';
	$gmap_poi			= ( ! empty( $poi_color ) ) ? $poi_color : '';
	$gmap_label			= ( ! empty( $label_text_color ) ) ? $label_text_color : '';

	// Registering and enqueueing some scripts and passing the values to Javascript
	wp_register_script( 'cx-map-js', CODEXIN_CORE_JS_DIR . '/cx-map.js', array ( 'jquery', 'google-js', 'gmap-js' ), 1.0, true );
    $map_localize_array = array(
        'codexin_lat' 			=> $lat,
        'codexin_long' 			=> $long,
        'codexin_marker' 		=> $gmap_marker,
        'codexin_m_zoom'		=> $c_zoom,
        'codexin_map_color'		=> $map_color,
        'codexin_scroll'		=> $gmap_scroll,
        'codexin_type' 			=> $gmap_type,
        'codexin_zoom' 			=> $gmap_zoom,
        'codexin_street_view' 	=> $gmap_street_view,
        'codexin_fullscreen' 	=> $gmap_fullscreen,
    );
	
	if( $map_advanced ) {
		$map_localize_custom = array(
			'codexin_road' 		=> $road_color,
			'codexin_water'		=> $water_color,
			'codexin_land'		=> $landscape_color,
			'codexin_poi'		=> $poi_color,
			'codexin_label'		=> $label_text_color,
		);

		$map_localize_array = array_merge( $map_localize_array, $map_localize_custom );
	}
	
    wp_localize_script( 'cx-map-js', 'cx_gmap_params', $map_localize_array );
    wp_enqueue_script( 'cx-map-js' );

	echo '<div class="'.esc_attr( implode( ' ', $master_class ) ) .'">';
		echo '<div class="gmap-wrap">';
			echo '<div id="gmap"></div>';
		echo '</div>';
	echo '</div> <!--end of map-wrapper -->';
			
	$result .= ob_get_clean();
	return $result;

} //End cx_map

// Registering new param type to show info
add_action( 'init', 'info_param', 99 );
function info_param() {
	if ( isset( $GLOBALS['kc'] ) ) {
	    global $kc;
	    $kc->add_param_type( 'cx_info', 'cx_info_cb' );
	}
}		
function cx_info_cb() {
	echo sprintf( '<p>%1$s <strong><a href="'. esc_url( admin_url().'admin.php?page=codexin-options&action=api' ) .'" target="_blank">%2$s</a></strong> %3$s.</p>', esc_html__( 'Please Fill Up The Google Map API Information In The "Google Map API" Section of', 'codexin' ), esc_html__( 'Codexin Core', 'codexin' ), esc_html__( 'if not filled up yet', 'codexin' ) );
}


// Integrating Shortcode with King Composer
function cx_map_kc() {

 	if( function_exists( 'kc_add_map' ) ) { 

	 	$get_api 	= get_option( 'codexin_options_gmap_api' )[ 'gmap_api' ];
		$cx_api 	= ( ! empty( $get_api ) ) ? $get_api : '';

 		kc_add_map(
 			array(
 				'cx_map' => array(
 					'name' 			=> esc_html__( 'Codexin Google Map', 'codexin' ),
 					'description' 	=> esc_html__('Codexin Google Map', 'codexin'),
 					'icon' 			=> 'et-hazardous',
 					'category' 		=> 'Codexin',
	                //Only load assets when using this element
 					'assets' 		=> array(
 						'scripts' 	=> array(
 							'google-js' => 'https://maps.googleapis.com/maps/api/js?key=' . $cx_api,
 							'gmap-js'	=> CODEXIN_CORE_ASSET_DIR . '/js/gmaps.js',
						),

					), //End assets

 					'params' 		=> array(
 						//General params
	    				'general' 	=> array(
	 						array(
	 							'name' 			=> 'info',
	 							'label' 		=> esc_html__( 'Google Map API', 'codexin' ),
	 							'type' 			=> 'cx_info',
	 						),
							array(
	 							'name' 			=> 'gmap_color',
	 							'label' 		=> esc_html__( 'Choose Default Color Scheme', 'codexin' ),
	 							'type' 			=> 'select',
	 							'options'		=> array(
	 									'original' 		=> esc_html__( 'Original', 'codexin' ),
										'grey' 			=> esc_html__( 'Grey', 'codexin' ),
										'retro' 		=> esc_html__( 'Retro', 'codexin' ),
										'dark'			=> esc_html__( 'Dark', 'codexin' ),
										'bw' 			=> esc_html__( 'Black & White', 'codexin' ),
										'light' 		=> esc_html__( 'Light', 'codexin' ),
										'blue' 			=> esc_html__( 'Blue', 'codexin' ),
										'DarkTurquoise' => esc_html__( 'Dark Turquoise', 'codexin' ),
								),
	 							'value'			=> 'default',
	 							'description'	=> esc_html__( 'You can select the map color here. Please note that if you enable "Advanced Map Color Customization" in the advanced tab, default color scheme will not work.', 'codexin' ),
	 							'admin_label' 	=> true,
	 						),

	 						array(
	 							'name' 			=> 'gmap_latitude',
	 							'label' 		=> esc_html__( 'Map Latitude', 'codexin' ),
	 							'type' 			=> 'text',
	 							'description'	=> sprintf( __( 'You can find the <strong>Latitude</strong> and <strong>Longitude</strong> information by placing your address <a href="%s" target="_blank">by placing your address Here</a>', 'codexin' ), esc_url( '//latlong.net/' ) ),
	 						),

	 						array(
	 							'name' 			=> 'gmap_longitude',
	 							'label' 		=> esc_html__( 'Map Longitude', 'codexin' ),
	 							'type' 			=> 'text',
	 							'description'	=> esc_html__( 'Enter your Map Longitude', 'codexin' ),
	 						),

	 						array(
	 							'name' 			=> 'gmap_zoom_level',
	 							'label' 		=> esc_html__( 'Map Zoom Level', 'codexin' ),
	 							'type' 			=> 'number_slider',
								'options' 		=> array(
									'min' 		=> 1,
									'max' 		=> 20,
									'unit' 		=> '',
									'show_input'=> true
								),
								'value'			=> 16,						
	 							'description'	=> esc_html__( 'Enter Map Zoom Level Here', 'codexin' ),
	 						),

	 						array(
	 							'name' 			=> 'gmap_marker',
	 							'label' 		=> esc_html__( 'Upload Map Marker', 'codexin' ),
	 							'type' 			=> 'attach_image',
	 							'value'			=> CODEXIN_CORE_ASSET_DIR . '/images/map-marker-1.png',
	 							'description'	=> esc_html__( 'Upload Map Marker Here. Marker Dimension should not exceed 32x32 px', 'codexin' ),
	 						)

    					),

    					//Advance params
	    				'advanced' 	=> array(
	 						array(
	 							'name' 			=> 'map_scroll',
	 							'label' 		=> esc_html__( 'Enable Mouse Wheel Scroll?', 'codexin' ),
	 							'type' 			=> 'toggle',
	 							'description'	=> esc_html__( 'Choose to enable/disable Mouse Wheel Scroll', 'codexin' ),
	 						),
	 						array(
	 							'name' 			=> 'map_type',
	 							'label' 		=> esc_html__( 'Display Map Type Control?', 'codexin' ),
	 							'type' 			=> 'toggle',
	 							'value'			=> 'yes',
	 							'description'	=> esc_html__( 'Choose to enable/disable to display Map type control', 'codexin' ),
	 						),
	 						array(
	 							'name' 			=> 'map_zoom',
	 							'label' 		=> esc_html__( 'Display Map Zoom Control?', 'codexin' ),
	 							'type' 			=> 'toggle',
	 							'value'			=> 'yes',
	 							'description'	=> esc_html__( 'Choose to enable/disable to display map zoom control', 'codexin' ),
	 						),
	 						array(
	 							'name' 			=> 'map_street_view',
	 							'label' 		=> esc_html__( 'Display Street View Control?', 'codexin' ),
	 							'type' 			=> 'toggle',
	 							'description'	=> esc_html__( 'Choose to enable/disable to display street view control', 'codexin' ),
	 						),
	 						array(
	 							'name' 			=> 'map_fullscreen',
	 							'label' 		=> esc_html__( 'Display Map Fullscreen Control?', 'codexin' ),
	 							'type' 			=> 'toggle',
	 							'description'	=> esc_html__( 'Choose to enable/disable to display map fullscreen control', 'codexin' ),
	 							'value'     => 'yes'
	 						),
	 						array(
	 							'name' 			=> 'map_advanced',
	 							'label' 		=> esc_html__( 'Advanced Map Color Customization?', 'codexin' ),
	 							'type' 			=> 'toggle',
	 							'description'	=> esc_html__( 'Do you want to enable advanced map customization?) Warning: Enabling this will override default color scheme.', 'codexin' ),
	 							'description'	=> sprintf( __( 'Do you want to enable advanced map customization? <strong style="color:#d9534f">%s</strong>', 'codexin' ), esc_html('Warning: Enabling this will override the existing color scheme setup.' ) ),
								'admin_label' 	=> true,
	 						),
	 						array(
	 							'name' 			=> 'road_color',
	 							'label' 		=> esc_html__( 'Road Color', 'codexin' ),
	 							'type' 			=> 'color_picker',
	    						'relation' 		=> array(
	    							'parent'    => 'map_advanced',
	    							'show_when' => 'yes',
	    						),
	 							'description'	=> esc_html__( 'Choose road color', 'codexin' ),
	 						),
	 						array(
	 							'name' 			=> 'water_color',
	 							'label' 		=> esc_html__( 'Water Color', 'codexin' ),
	 							'type' 			=> 'color_picker',
	    						'relation' 		=> array(
	    							'parent'    => 'map_advanced',
	    							'show_when' => 'yes',
	    						),
	 							'description'	=> esc_html__( 'Choose water color', 'codexin' ),
	 						),
	 						array(
	 							'name' 			=> 'landscape_color',
	 							'label' 		=> esc_html__( 'Landscape Color', 'codexin' ),
	 							'type' 			=> 'color_picker',
	    						'relation' 		=> array(
	    							'parent'    => 'map_advanced',
	    							'show_when' => 'yes',
	    						),
	 							'description'	=> esc_html__( 'Choose landscape color', 'codexin' ),
	 						),
	 						array(
	 							'name' 			=> 'poi_color',
	 							'label' 		=> esc_html__( 'Point of Interest Color', 'codexin' ),
	 							'type' 			=> 'color_picker',
	    						'relation' 		=> array(
	    							'parent'    => 'map_advanced',
	    							'show_when' => 'yes',
	    						),
	 							'description'	=> esc_html__( 'Choose point of interest color', 'codexin' ),
	 						),
	 						array(
	 							'name' 			=> 'label_text_color',
	 							'label' 		=> esc_html__( 'Label Text Color', 'codexin' ),
	 							'type' 			=> 'color_picker',
	    						'relation' 		=> array(
	    							'parent'    => 'map_advanced',
	    							'show_when' => 'yes',
	    						),
	 							'description'	=> esc_html__( 'Choose label text color', 'codexin' ),
	 						),
	    				), // end of advanced		

						// Style based Params
	    				'styling' => array(
	    					array(
	    						'name'    		=> 'codexin_css',
	    						'type'    		=> 'css',
	    						'options' 		=> array(
	    							array(
	    								"screens" => "any,1199,991,767,479",

	    								esc_html__( 'Box', 'codexin' )	=> array(
	    									array( 'property' => 'width', 'label' => esc_html__( 'Width', 'codexin' ), 'selector' => '#gmap' ),
	    									array( 'property' => 'height', 'label' => esc_html__( 'Height', 'codexin' ), 'selector' => '#gmap' ),
	    									array( 'property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin' ), 'selector' => '#gmap' ),
	    									array( 'property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin' ), 'selector' => '#gmap' ),
    									)
    								)
    							)
    						)
    					), // end of styling
		            ) //End params array()..
		        ),  // End of elemnt cx_blog....
			) //end of  array 
		);  //end of kc_add_map
	} //End if
} // end of cx_map_kc


