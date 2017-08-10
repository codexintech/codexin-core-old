<?php


/*
    ======================================
        CODEXIN MAP SHORTCODE
    ======================================
*/

// Registering Map Shortcode
function cx_map_shortcode( $atts, $content = null ) {
	extract(shortcode_atts(array(
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
	), $atts));

	// Retrieving the image url
	$ret_full_img_url = retrieve_img_src( $gmap_marker, '' );

	// Assigning a master css class and hooking into KC
	$master_class = apply_filters( 'kc-el-class', $atts );
	$master_class[] = 'map-wrapper';

	$result = '';

	ob_start(); 

	// Passing values to javascript
	if( $map_advanced ):
		$gmap_color = 'custom';
	endif;
	(!empty( $gmap_color )) ? $map_color = $gmap_color : '';
	(!empty( $gmap_latitude )) ? $lat = $gmap_latitude : '';
	(!empty( $gmap_longitude )) ? $long = $gmap_longitude : '';
	(!empty( $ret_full_img_url )) ? $gmap_marker = $ret_full_img_url : '';
	(!empty( $gmap_zoom_level )) ? $c_zoom = $gmap_zoom_level : '';
	(!empty( $map_scroll )) ? $gmap_scroll = true : $gmap_scroll = false;
	(!empty( $map_type )) ? $gmap_type = true : $gmap_type = false;
	(!empty( $map_zoom )) ? $gmap_zoom = true : $gmap_zoom = false;
	(!empty( $map_street_view )) ? $gmap_street_view = true : $gmap_street_view = false;
	(!empty( $map_fullscreen )) ? $gmap_fullscreen = true : $gmap_fullscreen = false;

	(!empty( $road_color )) ? $gmap_road = $road_color : '';
	(!empty( $water_color )) ? $gmap_water = $water_color : '';
	(!empty( $landscape_color )) ? $gmap_land = $landscape_color : '';
	(!empty( $poi_color )) ? $gmap_poi = $poi_color : '';
	(!empty( $label_text_color )) ? $gmap_label = $label_text_color : '';

	$codeopt = '';
	$codeopt .= '
	<script type="text/javascript">
		var codexin_lat = "'. $lat .'"; 
		var codexin_long = "'. $long .'"; 
		var codexin_marker = "'. $gmap_marker .'"; 
		var codexin_m_zoom = Number ("'. $c_zoom .'"); 
		var codexin_map_color =  "'. $map_color . '";
		var codexin_scroll =  "'. $gmap_scroll . '";
		var codexin_type =  "'. $gmap_type . '";
		var codexin_zoom =  "'. $gmap_zoom . '";
		var codexin_street_view =  "'. $gmap_street_view . '";
		var codexin_fullscreen =  "'. $gmap_fullscreen . '";
	</script>';

	if( $map_advanced ):
	$codeopt .= '
	<script type="text/javascript">
		var codexin_road =  "'. $road_color . '";
		var codexin_water =  "'. $water_color . '";
		var codexin_land =  "'. $landscape_color . '";
		var codexin_poi =  "'. $poi_color . '";
		var codexin_label =  "'. $label_text_color . '";
	</script>';
	endif;
	echo $codeopt; ?>

	<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
		<div class="gmap-wrap">
			<div id="gmap"></div>	 			
		</div>
	</div><!--end of map-wrapper -->
			
	<?php
	$result .= ob_get_clean();
	return $result;

} //End cx_map

// Registering new param type to show info
add_action('init', 'info_param', 99 );
function info_param() {
    global $kc;
    $kc->add_param_type( 'cx_info', 'cx_info_cb' );
}		
function cx_info_cb() {
	echo '<p>'. esc_html__('Please Fill Up The Google Map API Information In The "Google Map API" Section of ', 'codexin') .'<strong><a href="'. esc_url(admin_url().'admin.php?page=codexin-options&action=api') .'" target="_blank">'. esc_html('Codexin Core.', 'codexin') .'</a></strong></p>';
}	

// Integrating Shortcode with King Composer
function cx_map_kc() {

 	if (function_exists('kc_add_map')) { 

	 	$get_api = get_option( 'codexin_options_gmap_api' )[ 'gmap_api' ];
		$cx_api = ( !empty( $get_api ) ) ? $get_api : '';

 		kc_add_map(
 			array(
 				'cx_map' => array(
 					'name' => esc_html__( 'Codexin Google Map', 'codexin' ),
 					'description' => esc_html__('Codexin Google Map', 'codexin'),
 					'icon' => 'et-hazardous',
 					'category' => 'Codexin',
	                //Only load assets when using this element
 					'assets' => array(
 						'scripts' => array(
 							'google-js' => 'https://maps.googleapis.com/maps/api/js?key=' . $cx_api,
 							'gmap-js'		=> CODEXIN_CORE_ASSET_DIR . '/js/gmaps.js',
 							'cx-map-js'		=> CODEXIN_CORE_ASSET_DIR . '/js/shortcode-js/cx_map.js',
						),

					), //End assets

 					'params' => array(
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
										'grey' 	=> 'Grey',
										'retro' => 'Retro',
										'dark'	=> 'Dark',
										'bw' 	=> 'Black & White',
										'light' => 'Light',
										'blue' 	=> 'Blue',
								),
	 							'value'			=> '1',
	 							'description'	=> esc_html__( 'You can select the map color here. Please note that if you enable "Advanced Map Color Customization" in the advanced tab, default color scheme will not work.', 'codexin' ),
	 							'admin_label' 	=> true,
	 						),

	 						array(
	 							'name' 			=> 'gmap_latitude',
	 							'label' 		=> esc_html__( 'Map Latitude', 'codexin' ),
	 							'type' 			=> 'text',
	 							'description'	=> sprintf(__('You can find the <strong>Latitude</strong> and <strong>Longitude</strong> information by placing your address <a href="%s" target="_blank">by placing your address Here</a>', 'codexin'), esc_url('//latlong.net/')),
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
	 							'type' 			=> 'number_slider',  // USAGE RADIO TYPE
								'options' 		=> array(    // REQUIRED
										'min' 		=> 8,
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
	 						),
	 						array(
	 							'name' 			=> 'map_advanced',
	 							'label' 		=> esc_html__( 'Advanced Map Color Customization?', 'codexin' ),
	 							'type' 			=> 'toggle',
	 							'description'	=> esc_html__( 'Do you want to enable advanced map customization? Warning: Enabling this will override default color scheme.', 'codexin' ),
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
	    				) // end of advanced					
	                ) //End params array()..
	            ),  // End of elemnt cx_blog....
			) //end of  array 
		);  //end of kc_add_map
	} //End if
} // end of cx_map_kc


