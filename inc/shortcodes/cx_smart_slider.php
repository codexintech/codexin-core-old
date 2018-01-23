<?php

/**
 * Shortcode -  Smart Slider
 *
 * @since 1.0
 */

// Do not allow directly accessing this file.
defined( 'ABSPATH' ) OR die( esc_html__( 'This script cannot be accessed directly.', 'codexin' ) );

// Registering Smart Slider Shortcode
function cx_smart_slider_shortcode( $atts, $content = null ) {
   extract( shortcode_atts(array(
   		'slider_id' 	=> '',
   		'class'			=> ''
	), $atts ) );

	$result = '';

	// Assigning a master css class and hooking into KC
	$master_class 	= apply_filters( 'kc-el-class', $atts );
	$master_class[] = 'cx-smart-slider';

	// Retrieving user define classes
	$classes 		= array( 'cx-slider' );
	( ! empty( $class ) ) ? $classes[] = $class : '';

   	ob_start(); ?>

   	<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
   		<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
			<?php echo do_shortcode( '[smartslider3 slider='. $slider_id .']' ); ?>
		</div>
   	</div> <!--  end of cx-smart-slider  -->
   	<div class="clearfix"></div>

	<?php
	$result .= ob_get_clean();
	return $result;

} // end of cx_smart_slider


/**
 * Helper functions to build Smart Sliders List
 *
 */ 
function cx_get_sm_sliders() {
	$sliders = array();
	$sliders[] = esc_html__( 'Select a Slider Name', 'codexin' );
 	if ( is_plugin_active( 'nextend-smart-slider3-pro/nextend-smart-slider3-pro.php' ) ) {
      	global $wpdb; 
      	$smartsliders = $wpdb->get_results( "SELECT id, title FROM ". $wpdb->prefix ."nextend2_smartslider3_sliders" );
      	foreach( $smartsliders as $slide ) {
      		$sliders[$slide->id] = $slide->title;
      	}
  	} else {
      	$sliders[0] = esc_html__( 'No Slider Found', 'codexin' );
  	}

  	return $sliders;

}


// Integrating Shortcode with King Composer
function cx_smart_slider_kc() {

	$slider_names = cx_get_sm_sliders();

	if( function_exists( 'kc_add_map' ) ) { 
	    kc_add_map(
	    	array(
	    		'cx_smart_slider' => array(
	    			'name' 			=> esc_html__( 'Codexin Smart Slider', 'codexin' ),
	    			'description' 	=> esc_html__( 'Smart Slider', 'codexin' ),
	    			'icon' 			=> 'et-hazardous',
	    			'category' 		=> 'Codexin',
	    			'params' 		=> array(
	    				// General Params
	    				'general' 	=> array(
	    					array(
	    						'name'        	=> 'slider_id',
	    						'label'       	=> esc_html__( 'Select Slider Name', 'codexin' ),
	    						'type'        	=> 'select',
	    						'options'		=> $slider_names,
	    						'description'	=> esc_html__( 'Choose Slider Name to Show', 'codexin' ),
	    						'admin_label' 	=> true,
    						),


	    					array(
	    						'name'			=> 'class',
	    						'label' 		=> esc_html__(' Extra Class', 'codexin'),
	    						'type'			=> 'text'
    						),
    					), // end of general

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


