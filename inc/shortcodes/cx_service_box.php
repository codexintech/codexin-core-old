<?php

	function cx_service_box_shortcode( $atts, $content = null ) {
	   extract(shortcode_atts(array(
	   		'layout'    		=> '',
	   		'icon'    	  		=> '',
	   		'icon_toggle'		=> '',
			'service_title'		=> '',
			'service_desc' 		=> '',

	   	), $atts));

	   	$result = '';

		$master_class = apply_filters( 'kc-el-class', $atts );
		$master_class[] = 'cx-service-box';
		
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
				</div>
			</div>
		</div>
		<?php endif; ?>

		<?php
		$result .= ob_get_clean();
		return $result;
} //End cx_service_box


	function cx_service_box_kc() {

		if (function_exists('kc_add_map')) 
		{ 
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
	  	        					'name' 			=> 'service_desc',
	  	        					'label' 		=> esc_html__( 'Service Description ', 'codexin' ),
	  	        					'type' 			=> 'textarea',
	  	        					'description'	=> esc_html__( 'Enter Service Description', 'codexin' ),
	  	        					),
	  	        				),

	  	        			'styling' => array(

	  	        				array(
	  	        					'name'    		=> 'codexin_css',
	  	        					'type'    		=> 'css',
	  	        					'options' 		=> array(
	  	        						array(
	  	        							"screens" => "any,1199,991,767,479",

	  	        							'Title' => array(
	  	        								array('property' => 'color', 'label' => 'Color', 'selector' => '.single-service h4'),
	  	        								array('property' => 'font-family', 'label' => 'Font Family', 'selector' => '.single-service h4'),
	  	        								array('property' => 'font-size', 'label' => 'Font Size', 'selector' => '.single-service h4'),
	  	        								array('property' => 'line-height', 'label' => 'Line Height', 'selector' => '.single-service h4'),
	  	        								array('property' => 'font-weight', 'label' => 'Font Weight', 'selector' => '.single-service h4'),
	  	        								array('property' => 'text-align', 'label' => 'Text Align', 'selector' => '.single-service h4'),
	  	        								array('property' => 'text-transform', 'label' => 'Text Transform', 'selector' => '.single-service h4'),
	  	        								array('property' => 'padding', 'label' => 'Padding', 'selector' => '.single-service h4'),
	  	        								array('property' => 'margin', 'label' => 'Margin', 'selector' => '.single-service h4'),
	  	        								),

	  	        							'Description' => array(
	  	        								array('property' => 'color', 'label' => 'Color', 'selector' => '.single-service p'),
	  	        								array('property' => 'font-family', 'label' => 'Font Family', 'selector' => '.single-service p'),
	  	        								array('property' => 'font-size', 'label' => 'Font Size', 'selector' => '.single-service p'),
	  	        								array('property' => 'line-height', 'label' => 'Line Height', 'selector' => '.single-service p'),
	  	        								array('property' => 'font-weight', 'label' => 'Font Weight', 'selector' => '.single-service p'),
	  	        								array('property' => 'text-align', 'label' => 'Text Align', 'selector' => '.single-service p'),
	  	        								array('property' => 'text-transform', 'label' => 'Text Transform', 'selector' => '.single-service p'),
	  	        								array('property' => 'padding', 'label' => 'Padding', 'selector' => '.single-service p'),
	  	        								array('property' => 'margin', 'label' => 'Margin', 'selector' => '.single-service p'),
	  	        								),

	  	        							'Icon' => array(
	  	        								array('property' => 'color', 'label' => 'Label Color', 'selector' => '.single-service i'),
	  	        								array('property' => 'font-size', 'label' => 'Font Size', 'selector' => '.single-service i'),
	  	        								array('property' => 'padding', 'label' => 'Padding', 'selector' => '.single-service i'),
	  	        								array('property' => 'margin', 'label' => 'Margin', 'selector' => '.single-service i')
	  	        								),

	  	        							'Box'	=> array(
	  	        								array('property' => 'background'),
	  	        								array('property' => 'border', 'label' => 'Border'),
	  	        								array('property' => 'border-radius', 'label' => 'Border Radius'),
	  	        								array('property' => 'box-shadow', 'label' => 'Box Shadow', 'selector' => '+.cx-service-box'),
	  	        								array('property' => 'box-shadow', 'label' => 'Box Shadow on Hover', 'selector' => '+.cx-service-box:hover'),
	  	        								array('property' => 'transition', 'label' => 'Hover Transition Animation', 'selector' => '+.cx-service-box'),
	  	        								array('property' => 'margin', 'label' => 'Margin'),
	  	        								array('property' => 'padding', 'label' => 'Padding'),
	  	        								)									
	  	        							)
	  	        						)
	  	        					)
	  	        				),

	  	        			'animate' => array(
	  	        				array(
	  	        					'name'    		=> 'animate',
	  	        					'type'    		=> 'animate'
	  	        					)
	  	        				),

	                ) //End params array()..

	            ),  // End of elemnt cx_service_box 
		            

					) //end of  array 


			    );  //end of kc_add_map....

			} //End if

	} // end of cx_section_heading_kc


