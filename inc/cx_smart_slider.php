<?php


/*
    ======================================
        CODEXIN SMART SLIDER SHORTCODE
    ======================================
*/

// Registering Smart Slider Shortcode
function cx_smart_slider_shortcode(  $atts, $content = null) {
   extract(shortcode_atts(array(
   			'slider_id' => '',
   			'class'			=> ''
	), $atts));



	$result = '';

	// Assigning a master css class and hooking into KC
	$master_class = apply_filters( 'kc-el-class', $atts );
	$master_class[] = 'cx-smart-slider';

	// Retrieving user define classes
	$classes = array( 'cx-slider' );
	(!empty($class)) ? $classes[] = $class : '';

   	ob_start(); ?>

   	<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
   			<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
				
					<?php //echo do_shortcode('[smartslider3 slider='. $slider_id .']'); ?>

   			</div>
   	</div><!--  end of cta-wrapper-rv2  -->
   	<div class="clearfix"></div>

	<?php
	$result .= ob_get_clean();
	return $result;

} // end of cx_about_box


// function cx_get_slider_name() {

// 	$sliders = array();

//   if ( is_plugin_active( 'nextend-smart-slider3-pro/nextend-smart-slider3-pro.php' ) ):
//       global $wpdb; 
//       $a = array();
//       $b = array();
//       $smartsliders = $wpdb->get_results("SELECT id, title FROM ".$wpdb->prefix."nextend2_smartslider3_sliders");
//       foreach ($smartsliders as $slide) {
//           $a[] = $slide->id;
//           $b[] = $slide->title;
//       }
//       $sliders = array_combine($a, $b);

//   else: 
//       $sliders = array();
//   endif;

//   return $sliders;
//   print_r($sliders);
// }

// Integrating Shortcode with King Composer
function cx_smart_slider_kc() {

 	//$cx_smart_slider_name = cx_get_slider_name();

	if (function_exists('kc_add_map')) { 
	    kc_add_map(
	    	array(
	    		'cx_smart_slider' => array(
	    			'name' 			=> esc_html__( 'Codexin Smart Slider', 'codexin' ),
	    			'description' 	=> esc_html__('Smart Slider', 'codexin'),
	    			'icon' 			=> 'et-hazardous',
	    			'category' 		=> 'Codexin',
	    			'params' 		=> array(
	    				// General Params
	    				// 'general' 	=> array(
	    				// 	array(
	    				// 		'name'        => 'slider_id',
	    				// 		'label'       => esc_html__('Select Slider Name', 'codexin'),
	    				// 		'type'        	=> 'select',
	    				// 		'options'		=> $cx_smart_slider_name,
	    				// 		'description'	=> esc_html__( 'Choose Slider Name to Show', 'codexin' ),
	    				// 		'admin_label' 	=> true,
    					// 	),


	    				// 	array(
	    				// 		'name'			=> 'class',
	    				// 		'label' 		=> esc_html__(' Extra Class', 'codexin'),
	    				// 		'type'			=> 'text'
    					// 	),
    					// ), // end of general


	    				// Animate param
	    				'animate' => array(
	    					array(
	    						'name'    		=> 'animate',
	    						'type'    		=> 'animate'
    						)
    					), // end of animate
    				)
	            ),  // End of cx_smart_slider_array
			) //end of array
	    );  //end of kc_add_map
	} //End if
} // end of cx_smart_slider_kc


