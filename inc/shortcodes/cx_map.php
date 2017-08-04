<?php
	function cx_map_shortcode( $atts, $content = null ) {
	   extract(shortcode_atts(array(
	   		'img_alt'	=> '',
	   		'map_color' => '',
	   		'class'		=> ''
	   ), $atts));

	   $master_class = apply_filters( 'kc-el-class', $atts );
	   $master_class[] = 'map-wrapper';
	   $classes = array( 'reveal-map-wrapper' );
	   (!empty($class)) ? $classes[] = $class : '';

	   $result = '';

	   ob_start(); 

	   if(!empty(reveal_option('reveal-google-map-latitude'))):
	   	$latitude = reveal_option('reveal-google-map-latitude');
	   endif;

	   if(!empty(reveal_option('reveal-google-map-longitude'))):
	   	$longtitude = reveal_option('reveal-google-map-longitude');
	   endif;

	   if(!empty(reveal_option('reveal-google-map-zoom'))):
	   	$c_zoom = reveal_option('reveal-google-map-zoom');
	   endif;

	   if(!empty(reveal_option('reveal-google-map-marker'))):
	   	$gmap_marker = reveal_option('reveal-google-map-marker');
	   endif;

	   $codeopt = '';
	   $codeopt .= '
	   <script type="text/javascript">
	   	var reveal_lat = "'. $latitude .'"; 
	   	var reveal_long = "'. $longtitude .'"; 
	   	var reveal_marker = "'. $gmap_marker['url'] .'"; 
	   	var reveal_m_zoom = Number ("'. $c_zoom .'"); 
	   	var reveal_map_color = "' . $map_color . '";
	   </script>

	   ';

	   echo $codeopt;

	   ?>
		
		<div id="map" class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
			<div id="gmap-wrap" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
				<div id="gmap"> 				
				</div>	 			
			</div>
		</div><!--/#map-->
				

		<?php
		$result .= ob_get_clean();
		return $result;

 } //End cx_map




	 function cx_map_kc() {

	 	if (function_exists('kc_add_map')) 
	 	{ 

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
	 						array(
	 							'name' 			=> 'gmap_apikey',
	 							'label' 		=> esc_html__( 'Google Map Api Key', 'codexin' ),
	 							'type' 			=> 'text',
	 							'description'	=> esc_html__( 'Enter Google Map Api Key Here', 'codexin' ),
	 							'admin_label' 	=> false,
	 							),

	 						array(
	 							'name' 			=> 'class',
	 							'label' 		=> esc_html__( 'Extra Class', 'codexin' ),
	 							'type' 			=> 'text',
	 							'description'	=> esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS.', 'codexin' ),
	 							'admin_label' 	=> false,
	 							),

	 						array(
	 							'name' 			=> 'map_color',
	 							'label' 		=> esc_html__( 'Choose Color Scheme', 'codexin' ),
	 							'type' 			=> 'select',
	 							'options'		=> array(
	 													'#b4b4b4' => 'Gray Color',
	 													'#' => 'Gray-light Color',
	 													'#' => 'Gray-dark Color',
	 												),
	 							'value'			=> '#b4b4b4',
	 							'description'	=> esc_html__( 'You can select the map color here', 'codexin' ),
	 							'admin_label' 	=> false,
	 							),

		                ) //End params array()..

		            ),  // End of elemnt cx_blog....


							) //end of  array 


						);  //end of kc_add_map....

					} //End if

				} // end of cx_map_kc


