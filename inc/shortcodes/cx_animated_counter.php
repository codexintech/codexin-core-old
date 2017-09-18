<?php

/*
    ==========================================
        CODEXIN ANIMATED COUNTER SHORTCODE
    ==========================================
*/

// Registering Animated Counter Shortcode
function cx_animated_counter_shortcode( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'icon_toggle'     => '',
        'icon'            => '',
        'icon_pos'        => '',
        'icon-left'       => '',
		'icon-top'        => '',
        'divider'         => '',
        'div_type'        => '',
        'divider_line'    => '',
		'count_up'        => '',
		'txt' 		      => '',
		'class'		      => ''

   	), $atts));

   	$result = '';

	// Assigning a master css class and hooking into KC
	$master_class = apply_filters( 'kc-el-class', $atts );

    //Icon
    if( $icon_toggle ):
    	$master_class[] = 'cx-animated-counter with-icon';
    else:
        $master_class[] = 'cx-animated-counter';
    endif;

    // Divider
    if( $divider ):
        if( $div_type == 'dc_line' ):
            $divider_line = '<div class="cx-divider-2"></div>';
        else:
            $divider_line = '<div class="cx-divider"></div>';
        endif;
    endif;
	
	// Retrieving user define classes
    $classes = array( 'project' );
	(!empty($class)) ? $classes[] = $class : '';

   	ob_start(); 
	?>

    <div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
        <div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
            <?php if( $icon_toggle ): ?>
                <?php if( $icon_pos == 'icon-left' ): ?>
                    <div class="counter-wrapper">
                        <div class="content-left">
                            <i class="<?php echo esc_attr( $icon ); ?>"></i>
                        </div>
                        <div class="content-right">
                            <span class="counter"><?php echo esc_html( $count_up ); ?></span>
                            <p><?php echo esc_html( $txt ); ?></p>
                        </div>
                    </div>
                <?php elseif( $icon_pos == 'icon-top' ): ?>
                    <i class="<?php echo esc_attr( $icon ); ?>"></i>
                    <span class="counter"><?php echo esc_html( $count_up ); ?></span>
                    <p><?php echo esc_html( $txt ); ?></p>
                <?php endif; ?>
            <?php else: ?>
                <span class="counter"><?php echo esc_html( $count_up ); ?></span>
                <?php if( $divider ) : echo $divider_line; endif; ?>
                <p><?php echo esc_html( $txt ); ?></p>
            <?php endif; ?>
        </div><!-- end of project -->
    </div><!-- end of cx-animated-counter -->

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
                        // General Params
  	        			'general' 	=> array(

  	        				array(
  	        					'name' 			=> 'count_up',
  	        					'label' 		=> esc_html__( 'Input Numeric Value to Counter Up', 'codexin' ),
  	        					'type'          => 'text',
  	        					'admin_label' 	=> true,
        					),

  	        				array(
  	        					'name' 			=> 'txt',
  	        					'label' 		=> esc_html__( 'Enter Text', 'codexin' ),
  	        					'type' 			=> 'text',
  	        					'admin_label' 	=> true,
        					),

                            array(
                                'name'          => 'divider',
                                'label'         => esc_html__( 'Enable Divider? ', 'codexin' ),
                                'type'          => 'toggle',
                                'value'         => 'no'
                            ),

  	        				array(
  	        					'name' 			=> 'icon_toggle',
  	        					'label' 		=> esc_html__( 'Enable Icon? ', 'codexin' ),
  	        					'type' 			=> 'toggle',
                                'relation'      => array(
                                    'parent'    => 'divider',
                                    'hide_when' => 'yes',
                                ),
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
                                'name'          => 'icon_pos',
                                'label'         => esc_html__( 'Choose Icon Position', 'codexin' ),
                                'type'          => 'dropdown',
                                'options'       => array(
                                        'icon-top'   => 'Top of Text',
                                        'icon-left'  => 'Left of Text',
                                ),
                                'relation'      => array(
                                    'parent'    => 'icon_toggle',
                                    'show_when' => 'yes',
                                ),
                                'value'         => 'icon-top',
                            ),

                            array(
                                'name'          => 'div_type',
                                'label'         => esc_html__( 'Choose Divider Type', 'codexin' ),
                                'type'          => 'dropdown',
                                'options'       => array(
                                        'line'      => 'Divider 1',
                                        'dc_line'   => 'Divider 2',
                                ),
                                'relation'      => array(
                                    'parent'    => 'divider',
                                    'show_when' => 'yes',
                                ),
                            ), 

  	        				array(
  	        					'name'			=> 'class',
  	        					'label' 		=> esc_html__(' Extra Class', 'codexin'),
  	        					'type'			=> 'text'
        					),

        				), //end of general
                        // Style Params
  	        			'styling' => array(

  	        				array(
  	        					'name'    		=> 'codexin_css',
  	        					'type'    		=> 'css',
  	        					'options' 		=> array(
  	        						array(
  	        							"screens" => "any,1199,991,767,479",

  	        							'Count Number' => array(
  	        								array('property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.project .counter'),
  	        								array('property' => 'font-family', 'label' => esc_html__('Font Family', 'codexin'), 'selector' => '.project .counter'),
  	        								array('property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.project .counter'),
  	        								array('property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.project .counter'),
  	        								array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.project .counter'),
  	        								array('property' => 'text-align', 'label' => esc_html__('Text Align', 'codexin'), 'selector' => '.project .counter'),
  	        								array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.project .counter'),
  	        								array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.project .counter'),
        								),

  	        							'Count Text' => array(
  	        								array('property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.project p'),
  	        								array('property' => 'font-family', 'label' => esc_html__('Font Family', 'codexin'), 'selector' => '.project p'),
  	        								array('property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.project p'),
  	        								array('property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.project p'),
  	        								array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.project p'),
  	        								array('property' => 'text-align', 'label' => esc_html__('Text Align', 'codexin'), 'selector' => '.project p'),
  	        								array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'codexin'), 'selector' => '.project p'),
  	        								array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.project p'),
  	        								array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.project p'),
        								),

  	        							'Icon' => array(
  	        								array('property' => 'color', 'label' => esc_html__('Label Color', 'codexin'), 'selector' => '.project i'),
  	        								array('property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.project i'),
  	        								array('property' => 'display', 'label' => esc_html__('Display', 'codexin'), 'selector' => '.project i'),
  	        								array('property' => 'text-align', 'label' => esc_html__('Text Align', 'codexin'), 'selector' => '.project i'),
                                            array('property' => 'width', 'label' => esc_html__('Width', 'codexin'), 'selector' => '.project i'),
                                            array('property' => 'height', 'label' => esc_html__('Height', 'codexin'), 'selector' => '.project i'),
  	        								array('property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.project i'),
  	        								array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.project i'),
  	        								array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.project i')
        								),

                                        'Divider' => array(
                                            array('property' => 'background-color', 'label' => esc_html__( 'Color (For Divider-1)', 'codexin'), 'selector' => '.cx-divider::after' ),
                                            array('property' => 'width', 'label' => esc_html__( 'Width (For Divider-1)', 'codexin'), 'selector' => '.cx-divider::after'),
                                            array('property' => 'height', 'label' => esc_html__( 'Height (For Divider-1)', 'codexin'), 'selector' => '.cx-divider::after'),
                                            array('property' => 'display', 'label' => esc_html__( 'Display (For Divider-1)', 'codexin'), 'selector' => '.cx-divider::after'),
                                            array('property' => 'padding', 'label' => esc_html__( 'Padding (For Divider-1)', 'codexin'), 'selector' => '.cx-divider'),
                                            array('property' => 'margin', 'label' => esc_html__( 'Margin (For Divider-1)', 'codexin'), 'selector' => '.cx-divider::after'),
                                            array('property' => 'background-color', 'label' => esc_html__( 'Color of Left Line (For Divider-2)', 'codexin'), 'selector' => '.cx-divider-2::before' ),
                                            array('property' => 'background-color', 'label' => esc_html__( 'Color of Right Line (For Divider-2)', 'codexin'), 'selector' => '.cx-divider-2::after' ),
                                            array('property' => 'width', 'label' => esc_html__( 'Width of Left Line (For Divider-2)', 'codexin'), 'selector' => '.cx-divider-2::before'),
                                            array('property' => 'width', 'label' => esc_html__( 'Width of Right Line (For Divider-2)', 'codexin'), 'selector' => '.cx-divider-2::after'),
                                            array('property' => 'height', 'label' => esc_html__( 'Height (For Divider-2)', 'codexin'), 'selector' => '.cx-divider-2::before, .cx-divider-2::after'),
                                            array('property' => 'padding', 'label' => esc_html__( 'Padding (For Divider-2)', 'codexin'), 'selector' => '.cx-divider-2'),
                                        ),

  	        							'Box'	=> array(
  	        								array('property' => 'background'),
  	        								array('property' => 'border', 'label' => esc_html__('Border', 'codexin') ),
  	        								array('property' => 'box-shadow', 'label' => esc_html__('Box Shadow', 'codexin'), 'selector' => '+.cx-animated-counter'),
  	        								array('property' => 'box-shadow', 'label' => esc_html__('Box Shadow on Hover', 'codexin'), 'selector' => '+.cx-animated-counter:hover'),
  	        								array('property' => 'transition', 'label' => esc_html__('Hover Transition Animation', 'codexin'), 'selector' => '+.cx-animated-counter'),
  	        								array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin') ),
  	        								array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin') ),
        								)									
        							)
        						)
        					)
        				), //end of styling
                        // Animate Params
						'animate' => array(
							array(
								'name'    		=> 'animate',
								'type'    		=> 'animate'
							)
						), // end of animate
					)
		        ),  // End of cx_animated_counter_kc
			) //end of  array
	    );  //end of kc_add_map
	} //End if
} // end of cx_section_heading_kc


