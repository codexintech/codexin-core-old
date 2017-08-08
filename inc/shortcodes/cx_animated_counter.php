<?php

/*
    ==========================================
        CODEXIN ANIMATED COUNTER SHORTCODE
    ==========================================
*/

// Registering Animated Counter Shortcode
function cx_animated_counter_shortcode( $atts, $content = null ) {
   extract(shortcode_atts(array(
		'icon_toggle' => '',
		'icon'        => '',
		'count_up'    => '',
		'txt' 		  => '',
		'class'		  => ''

   	), $atts));

   	$result = '';

	// Assigning a master css class and hooking into KC
	$master_class = apply_filters( 'kc-el-class', $atts );
	$master_class[] = 'cx-animated-counter';
	
	// Retrieving user define classes
	$classes = array( 'project' );
	(!empty($class)) ? $classes[] = $class : '';

   	ob_start(); 
	?>

		<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
			<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">

				<?php if( $icon_toggle == 'yes' ): ?>
				<i class="<?php echo esc_attr( $icon ); ?>"></i>
				<?php endif; ?>

				<span class="counter"><?php echo esc_html( $count_up ); ?></span>
				<p><?php echo esc_html( $txt ); ?></p>
			</div>
		</div>

	<?php
	$result .= ob_get_clean();
	return $result;
}


// Integrating Shortcode with King Composer
function cx_animated_counter_kc() {
	if (function_exists('kc_add_map')) { 
	    kc_add_map(
  	        array(
  	        	'cx_animated_counter' 	=> array(
  	        		'name' 				=> esc_html__( 'Codexin Counter Box', 'codexin' ),
  	        		'description' 		=> esc_html__('Animated Single Counter', 'codexin'),
  	        		'icon' 				=> 'kc-icon-counter',
  	        		'category' 			=> 'Codexin',
                	// Only load assets when using this element
  	        		'assets' 			=> array(
  	        			'scripts' 		=> array(
  	        				'waypoints-js-script' 	=> CODEXIN_CORE_ASSET_DIR . '/js/waypoints.min.js',
  	        				'counterup-js-script' 	=> CODEXIN_CORE_ASSET_DIR . '/js/jquery.counterup.min.js',         	            
  	        				'counter-js-script' 	=> CODEXIN_CORE_ASSET_DIR . '/js/shortcode-js/cx_animated_counter.js',         	            
  	        				),

                	), //End assets

  	        		'params' => array(
  	        			'general' 	=> array(

  	        				array(
  	        					'name' 			=> 'count_up',
  	        					'label' 		=> esc_html__( 'Input Numeric Value to Counter Up', 'codexin' ),
  	        					'type' 			=> 'text',
  	        					'admin_label' 	=> true,
  	        					),

  	        				array(
  	        					'name' 			=> 'txt',
  	        					'label' 		=> esc_html__( 'Enter Text', 'codexin' ),
  	        					'type' 			=> 'text',
  	        					'admin_label' 	=> true,
  	        					),

  	        				array(
  	        					'name' 			=> 'icon_toggle',
  	        					'label' 		=> esc_html__( 'Enable Icon? ', 'codexin' ),
  	        					'type' 			=> 'toggle',
  	        					),

  	        				array(
  	        					'name' 			=> 'icon',
  	        					'label' 		=> esc_html__( 'Choose Icon', 'codexin' ),
  	        					'type' 			=> 'icon_picker',
  	        					'relation' 		=> array(
  	        						'parent'    => 'icon_toggle',
  	        						'show_when' => 'yes',
  	        						),
  	        					),

  	        				array(
  	        					'name'			=> 'class',
  	        					'label' 		=> esc_html__(' Extra Class', 'codexin'),
  	        					'type'			=> 'text'
  	        					),

  	        				),

  	        			'styling' => array(

  	        				array(
  	        					'name'    		=> 'codexin_css',
  	        					'type'    		=> 'css',
  	        					'options' 		=> array(
  	        						array(
  	        							"screens" => "any,1199,991,767,479",

  	        							'Count Number' => array(
  	        								array('property' => 'color', 'label' => 'Color', 'selector' => '.project .counter'),
  	        								array('property' => 'font-family', 'label' => 'Font Family', 'selector' => '.project .counter'),
  	        								array('property' => 'font-size', 'label' => 'Font Size', 'selector' => '.project .counter'),
  	        								array('property' => 'line-height', 'label' => 'Line Height', 'selector' => '.project .counter'),
  	        								array('property' => 'font-weight', 'label' => 'Font Weight', 'selector' => '.project .counter'),
  	        								array('property' => 'text-align', 'label' => 'Text Align', 'selector' => '.project .counter'),
  	        								array('property' => 'text-transform', 'label' => 'Text Transform', 'selector' => '.project .counter'),
  	        								array('property' => 'padding', 'label' => 'Padding', 'selector' => '.project .counter'),
  	        								array('property' => 'margin', 'label' => 'Margin', 'selector' => '.project .counter'),
        								),

  	        							'Count Text' => array(
  	        								array('property' => 'color', 'label' => 'Color', 'selector' => '.project p'),
  	        								array('property' => 'font-family', 'label' => 'Font Family', 'selector' => '.project p'),
  	        								array('property' => 'font-size', 'label' => 'Font Size', 'selector' => '.project p'),
  	        								array('property' => 'line-height', 'label' => 'Line Height', 'selector' => '.project p'),
  	        								array('property' => 'font-weight', 'label' => 'Font Weight', 'selector' => '.project p'),
  	        								array('property' => 'text-align', 'label' => 'Text Align', 'selector' => '.project p'),
  	        								array('property' => 'text-transform', 'label' => 'Text Transform', 'selector' => '.project p'),
  	        								array('property' => 'padding', 'label' => 'Padding', 'selector' => '.project p'),
  	        								array('property' => 'margin', 'label' => 'Margin', 'selector' => '.project p'),
        								),

  	        							'Icon' => array(
  	        								array('property' => 'color', 'label' => 'Label Color', 'selector' => '.project i'),
  	        								array('property' => 'font-size', 'label' => 'Font Size', 'selector' => '.project i'),
  	        								array('property' => 'display', 'label' => 'Display', 'selector' => '.project i'),
  	        								array('property' => 'text-align', 'label' => 'Text Align', 'selector' => '.project i'),
  	        								array('property' => 'width', 'label' => 'Width', 'selector' => '.project i'),
  	        								array('property' => 'padding', 'label' => 'Padding', 'selector' => '.project i'),
  	        								array('property' => 'margin', 'label' => 'Margin', 'selector' => '.project i')
        								),

  	        							'Box'	=> array(
  	        								array('property' => 'background'),
  	        								array('property' => 'border', 'label' => 'Border'),
  	        								array('property' => 'border-radius', 'label' => 'Border Radius'),
  	        								array('property' => 'box-shadow', 'label' => 'Box Shadow', 'selector' => '+.cx-animated-counter'),
  	        								array('property' => 'box-shadow', 'label' => 'Box Shadow on Hover', 'selector' => '+.cx-animated-counter:hover'),
  	        								array('property' => 'transition', 'label' => 'Hover Transition Animation', 'selector' => '+.cx-animated-counter'),
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

					)
		        ),  // End of cx_animated_counter_kc
			) //end of  array
	    );  //end of kc_add_map
	} //End if
} // end of cx_section_heading_kc


