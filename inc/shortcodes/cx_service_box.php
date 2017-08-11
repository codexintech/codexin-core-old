<?php

/*
    ======================================
        CODEXIN SERVICE BOX SHORTCODE
    ======================================
*/

// Registering Service Box Shortcode
function cx_service_box_shortcode( $atts, $content = null ) {
	extract(shortcode_atts(array(
			'layout'    		=> '',
			'icon'    	  		=> '',
			'icon_toggle'		=> '',
			'service_title'		=> '',
			'service_desc' 		=> '',

	), $atts));

	$result = '';

	// Assigning a master css class and hooking into KC
	$master_class = apply_filters( 'kc-el-class', $atts );
	$master_class[] = 'cx-service-box';

	// Retrieving user define classes
	$classes = array( 'single-service' );
	(!empty($class)) ? $classes[] = $class : '';

	ob_start(); 
	?>

	<?php if( $layout == 1 ): ?>
	<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
		<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
			<div class="media">
				<?php if( $icon_toggle ): ?>
				<div class="media-left">
					<i class="<?php echo esc_attr( $icon ); ?>"></i>
				</div>
				<?php endif; ?>
				<div class="media-body">
					<h4 class="media-heading"><?php echo esc_html( $service_title ); ?></h4>
					<p><?php printf( '%s', $service_desc ) ; ?></p>
				</div>
			</div><!-- end of media -->
		</div><!-- end of single-service -->
	</div><!-- end of cx-service-box -->
	<?php endif; ?>

	<?php
	$result .= ob_get_clean();
	return $result;
} //End cx_service_box


// Integrating Shortcode with King Composer
function cx_service_box_kc() {

	if (function_exists('kc_add_map')) { 
	    kc_add_map(
  	        array(
  	        	'cx_service_box' 	=> array(
  	        		'name' 			=> esc_html__( 'Codexin Service Box', 'codexin' ),
  	        		'description' 	=> esc_html__('Service Box', 'codexin'),
  	        		'icon' 			=> 'fa-yelp',
  	        		'category' 		=> 'Codexin',
  	        		'params' 		=> array(
  	        			'general'	=> array(
  	        				array(
  	        					'type'			=> 'radio_image',
  	        					'label'			=> esc_html__( 'Select Service Box Template', 'codexin' ),
  	        					'name'			=> 'layout',
  	        					'options'		=> array(
  	        						'1'	=> CODEXIN_CORE_ASSET_DIR . '/images/kc_image/service-box-1.png',
  	        						'2'	=> CODEXIN_CORE_ASSET_DIR . '/images/kc_image/service-box-2.png',
  	        						'3'	=> CODEXIN_CORE_ASSET_DIR . '/images/kc_image/service-box-3.png',
        						),
  	        					'value'			=> '1'
        					),

  	        				
  	        				array(
  	        					'name' 			=> 'service_title',
  	        					'label' 		=> esc_html__( 'Servce Title ', 'codexin' ),
  	        					'type' 			=> 'text',
  	        					'description'	=> esc_html__( 'Enter Service Title', 'codexin' ),
  	        					'admin_label' 	=> true,
        					),

  	        				array(
  	        					'name' 			=> 'icon_toggle',
  	        					'label' 		=> esc_html__( 'Enable Service Icon? ', 'codexin' ),
  	        					'type' 			=> 'toggle',
  	        					'value'			=> 'no'
        					),

  	        				array(
  	        					'name' 			=> 'icon',
  	        					'label' 		=> esc_html__( 'Choose Service Icon', 'codexin' ),
  	        					'type' 			=> 'icon_picker',
  	        					'relation' 		=> array(
  	        						'parent'    => 'icon_toggle',
  	        						'show_when' => 'yes',
        						),
  	        					'description'	=> esc_html__( 'Select Service Icon', 'codexin' ),
        					),

  	        			 array(
                      'name'      => 'service_desc',
                      'label'     => esc_html__( 'Service Description ', 'codexin' ),
                      'type'      => 'textarea',
                      'description' => esc_html__( 'Enter Service Description', 'codexin' ),
                  ),

                   array(
                    'name'      => 'class',
                    'label'     => __( 'Enter Class', 'codexin' ),
                    'type'      => 'text',
                    'description' => esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS.', 'codexin' ),
                    'admin_label'   => false,
                  ),

        				), // end of general

  	        			// Styling params
  	        			'styling' => array(

  	        				array(
  	        					'name'    		=> 'codexin_css',
  	        					'type'    		=> 'css',
  	        					'options' 		=> array(
  	        						array(
  	        							"screens" => "any,1199,991,767,479",

  	        							'Title' => array(
  	        								array('property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.single-service h4'),
  	        								array('property' => 'font-family', 'label' => esc_html__('Font Family', 'codexin'), 'selector' => '.single-service h4'),
  	        								array('property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.single-service h4'),
  	        								array('property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.single-service h4'),
  	        								array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.single-service h4'),
  	        								array('property' => 'text-align', 'label' => esc_html__('Text Align', 'codexin'), 'selector' => '.single-service h4'),
  	        								array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'codexin'), 'selector' => '.single-service h4'),
  	        								array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.single-service h4'),
  	        								array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.single-service h4'),
        								),

  	        							'Designation' => array(
  	        								array('property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.single-service p'),
  	        								array('property' => 'font-family', 'label' => esc_html__('Font Family', 'codexin'), 'selector' => '.single-service p'),
  	        								array('property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.single-service p'),
  	        								array('property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.single-service p'),
  	        								array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.single-service p'),
  	        								array('property' => 'text-align', 'label' => esc_html__('Text Align', 'codexin'), 'selector' => '.single-service p'),
  	        								array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'codexin'), 'selector' => '.single-service p'),
  	        								array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.single-service p'),
  	        								array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.single-service p'),
        								),

  	        							'Icon' => array(
  	        								array('property' => 'color', 'label' => esc_html__('Label Color', 'codexin'), 'selector' => '.single-service i'),
  	        								array('property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.single-service i'),
  	        								array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.single-service i'),
  	        								array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.single-service i')
        								),

  	        							'Box'	=> array(
  	        								array('property' => 'background'),
  	        								array('property' => 'border', 'label' => esc_html__('Border', 'codexin') ),
  	        								array('property' => 'border-radius', 'label' => esc_html__('Border Radius', 'codexin') ),
  	        								array('property' => 'box-shadow', 'label' => esc_html__('Box Shadow', 'codexin'), 'selector' => '+.cx-service-box'),
  	        								array('property' => 'box-shadow', 'label' => esc_html__('Box Shadow on Hover', 'codexin'), 'selector' => '+.cx-service-box:hover'),
  	        								array('property' => 'transition', 'label' => esc_html__('Hover Transition Animation', 'codexin'), 'selector' => '+.cx-service-box'),
  	        								array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin') ),
  	        								array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin') ),
        								)									
        							)
        						)
        					)
        				), // end of styling
  	        			// animate param
  	        			'animate' => array(
  	        				array(
  	        					'name'    		=> 'animate',
  	        					'type'    		=> 'animate'
        					)
        				), // end of animate
	                ) //End params
	            ),  // End of elemnt cx_service_box 
			) //end of array 
	    );  //end of kc_add_map
	} //End if
} // end of cx_section_heading_kc


