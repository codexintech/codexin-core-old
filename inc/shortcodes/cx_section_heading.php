<?php

/**
 * Shortcode -  Section Heading
 *
 * @since 1.0
 */

// Do not allow directly accessing this file.
defined( 'ABSPATH' ) OR die( esc_html__( 'This script cannot be accessed directly.', 'codexin' ) );

// Registering Section heading Shortcode
function cx_section_heading_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'layout'				=> '',
		'title' 				=> '',
		'subtitle'	 			=> '',
		'divider'	 			=> '',
		'div_type'	 			=> '',
		'div_pos'	 			=> '',
		'div_icon'	 			=> '',
		'div_text'	 			=> '',
		'icon'		 			=> '',
		'text'		 			=> '',
		'description_toggle' 	=> '',
		'description'  			=> '',
		'class'		  			=> '',
	), $atts ) );

	$result = '';

	// Assigning a master css class and hooking into KC
	$master_class 	= apply_filters( 'kc-el-class', $atts );
	$master_class[] = 'cx-section-heading';

	// Retrieving user define classes
	$classes = array( 'section-heading' );
	( ! empty( $class ) ) ? $classes[] = $class : ''; 

	// Divider
	if( $divider ) {
		if( $div_type == 'div_icon' ) {
			$divider_line = '<div class="cx-bg-overlay cx-color-1 cx-divider"><i class="'. esc_attr( $icon ) .'"></i></div>';
		} elseif( $div_type == 'div_text' ) {
			$divider_line = '<div class="cx-bg-overlay cx-divider"><span>' . esc_html( $text ) . '</span></div>';
		} elseif( $div_type == 'dc_line' ) {
			$divider_line = '<div class="cx-bg-overlay cx-divider-2"></div>';
		} else {
			$divider_line = '<div class="cx-bg-overlay cx-divider"></div>';
		}
	}

	ob_start();

	echo '<div class="'. esc_attr( implode( ' ', $master_class ) ) .'">';
		echo '<div class="'. esc_attr( implode( ' ', $classes ) ) .'">';
			echo ( $div_pos == 'top' ) ? $divider_line : '';
			echo ( ! empty( $subtitle ) ) ? '<h2 class="secondary-title">'. esc_html( $subtitle ) .'</h2>' : '';
			echo ( ! empty( $title ) ) ? '<h3 class="primary-title">'. esc_html( $title ) .'</h3>' : '';
			echo ( $div_pos == 'bottom' ) ? $divider_line : '';
			if( $description_toggle == 'yes' ) {
				echo '<div class="col-md-10 col-md-offset-1 cx-description">';
					echo '<p>'. sprintf( '%s', $description ) .'</p>';
				echo '</div>';
			}
		echo '</div><!-- end of cx-section-heading -->';
	echo '</div><!-- end of section-heading -->';

	$result .= ob_get_clean();
	return $result;

} 


// Integrating Shortcode with King Composer
function cx_section_heading_kc() {

	if( function_exists( 'kc_add_map' ) ) { 
	    kc_add_map(
  	        array(
	            'cx_section_heading'=> array(
                	'name' 			=> esc_html__( 'Codexin Section Header', 'codexin' ),
	                'description' 	=> esc_html__( 'Section Header', 'codexin' ),
	                'icon' 			=> 'kc-icon-title',
	                'category' 		=> 'Codexin',
	                'params' 		=> array(
	                	//General params
						'general' 	=> array(

		                    array(
		                        'name' 			=> 'subtitle',
		                        'label' 		=> esc_html__( 'Enter Subtitle', 'codexin' ),
		                        'type' 			=> 'text',
		                        'admin_label'	=> true,
		                    ),

		                    array(
		                        'name' 			=> 'title',
		                        'label' 		=> esc_html__( 'Enter Title', 'codexin' ),
		                        'type' 			=> 'text',
		                        'admin_label'	=> true,
		                    ),

		                    array(
		                        'name' 			=> 'divider',
		                        'label' 		=> esc_html__( 'Enable Divider? ', 'codexin' ),
		                        'type' 			=> 'toggle',
		                        'relation'		=> array(
		                        	'parent'	=> 'layout',
		                        	'show_when'	=> '1'
		                        ),
		                    ),

		                    array(
		                    	'name' 			=> 'div_type',
		                    	'label' 		=> esc_html__( 'Choose Divider Type', 'codexin' ),
		                    	'type' 			=> 'dropdown',
		                    	'options'		=> array(
		                    			'line'		=> esc_html__( 'Simple Divider 1', 'codexin' ),
		                    			'dc_line'	=> esc_html__( 'Simple Divider 2', 'codexin' ),
		                    			'div_icon'	=> esc_html__( 'Line with Icon', 'codexin' ),
		                    			'div_text'	=> esc_html__( 'Line with Text', 'codexin' )
		                    	),
		                    	'relation' 		=> array(
		                    		'parent'    => 'divider',
		                    		'show_when' => 'yes',
		                    	),
		                    ),

		                    array(
		                        'name' 			=> 'icon',
		                        'label' 		=> esc_html__( 'Choose Icon ', 'codexin' ),
		                        'type' 			=> 'icon_picker',
		                        'relation'		=> array(
		                        	'parent'	=> 'div_type',
		                        	'show_when'	=> 'div_icon'
		                        ),
		                    ),

		                    array(
		                        'name' 			=> 'text',
		                        'label' 		=> esc_html__( 'Enter Text ', 'codexin' ),
		                        'type' 			=> 'text',
		                        'relation'		=> array(
		                        	'parent'	=> 'div_type',
		                        	'show_when'	=> 'div_text'
		                        ),
		                        'value'			=> 'Text'
		                    ),

		                    array(
		                    	'name' 			=> 'div_pos',
		                    	'label' 		=> esc_html__( 'Divider Position', 'codexin' ),
		                    	'type' 			=> 'dropdown',
		                    	'options'		=> array(
		                    			'top'		=> esc_html__( 'Top of Title', 'codexin' ),
		                    			'bottom'	=> esc_html__( 'Bottom of Title', 'codexin' ),
		                    	),
		                    	'relation' 		=> array(
		                    		'parent'    => 'divider',
		                    		'show_when' => 'yes',
		                    	),
		                    ),

		                    array(
		                        'name' 			=> 'description_toggle',
		                        'label' 		=> esc_html__( 'Enable Description Field? ', 'codexin' ),
		                        'type' 			=> 'toggle',
		                        'relation'		=> array(
		                        	'parent'	=> 'layout',
		                        	'show_when'	=> '1'
		                        ),
		                    ),

		                    array(
		                    	'name' 			=> 'description',
		                    	'label' 		=> esc_html__( 'Enter Description', 'codexin' ),
		                    	'type' 			=> 'textarea',
		                    	'relation' 		=> array(
		                    		'parent'    => 'description_toggle',
		                    		'show_when' => 'yes',
		                    	),
		                    ),

							array(
								'name'			=> 'class',
								'label' 		=> esc_html__(' Extra Class', 'codexin'),
								'type'			=> 'text'
							),
						), // end of general

						//Styling params
						'styling' 	=> array(
							array(
								'name'    		=> 'codexin_css',
								'type'    		=> 'css',
								'options' => array(
									array(
										"screens" => "any,1199,991,767,479",
										esc_html__( 'Title', 'codexin' ) => array(
											array( 'property' => 'color', 'label' => esc_html__( 'Color', 'codexin'), 'selector' => '.primary-title'),
											array( 'property' => 'font-family', 'label' => esc_html__( 'Font Family', 'codexin'), 'selector' => '.primary-title'),
											array( 'property' => 'font-size', 'label' => esc_html__( 'Font Size', 'codexin'), 'selector' => '.primary-title'),
											array( 'property' => 'line-height', 'label' => esc_html__( 'Line Height', 'codexin'), 'selector' => '.primary-title'),
											array( 'property' => 'font-weight', 'label' => esc_html__( 'Font Weight', 'codexin'), 'selector' => '.primary-title'),
											array( 'property' => 'text-align', 'label' => esc_html__( 'Text Align', 'codexin'), 'selector' => '.primary-title'),
											array( 'property' => 'text-transform', 'label' => esc_html__( 'Text Transform', 'codexin'), 'selector' => '.primary-title'),
											array( 'property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin'), 'selector' => '.primary-title'),
											array( 'property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin'), 'selector' => '.primary-title')
										),

										esc_html__( 'Subtitle', 'codexin' ) => array(
											array( 'property' => 'color', 'label' => esc_html__( 'Color', 'codexin'), 'selector' => '.secondary-title'),
											array( 'property' => 'font-family', 'label' => esc_html__( 'Font Family', 'codexin'), 'selector' => '.secondary-title'),
											array( 'property' => 'font-size', 'label' => esc_html__( 'Font Size', 'codexin'), 'selector' => '.secondary-title'),
											array( 'property' => 'line-height', 'label' => esc_html__( 'Line Height', 'codexin'), 'selector' => '.secondary-title'),
											array( 'property' => 'font-weight', 'label' => esc_html__( 'Font Weight', 'codexin'), 'selector' => '.secondary-title'),
											array( 'property' => 'text-align', 'label' => esc_html__( 'Text Align', 'codexin'), 'selector' => '.secondary-title'),
											array( 'property' => 'text-transform', 'label' => esc_html__( 'Text Transform', 'codexin'), 'selector' => '.secondary-title'),
											array( 'property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin'), 'selector' => '.secondary-title'),
											array( 'property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin'), 'selector' => '.secondary-title'),
										),

										esc_html__( 'Divider-1', 'codexin' ) => array(
											array( 'property' => 'background', 'label' => esc_html__( 'Color', 'codexin'), 'selector' => '.cx-divider::before' ),
											array( 'property' => 'width', 'label' => esc_html__( 'Width', 'codexin'), 'selector' => '.cx-divider::before'),
											array( 'property' => 'height', 'label' => esc_html__( 'Height', 'codexin'), 'selector' => '.cx-divider::before'),
											array( 'property' => 'display', 'label' => esc_html__( 'Display', 'codexin'), 'selector' => '.cx-divider::before'),
											array( 'property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin'), 'selector' => '.cx-divider'),
											array( 'property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin'), 'selector' => '.cx-divider::before')
										),

										esc_html__( 'Divider-2', 'codexin' ) => array(
											array( 'property' => 'background-color', 'label' => esc_html__( 'Color of Left Line', 'codexin'), 'selector' => '.cx-divider-2::before' ),
											array( 'property' => 'background-color', 'label' => esc_html__( 'Color of Right Line', 'codexin'), 'selector' => '.cx-divider-2::after' ),
											array( 'property' => 'width', 'label' => esc_html__( 'Width of Left Line', 'codexin'), 'selector' => '.cx-divider-2::before'),
											array( 'property' => 'width', 'label' => esc_html__( 'Width of Right Line', 'codexin'), 'selector' => '.cx-divider-2::after'),
											array( 'property' => 'height', 'label' => esc_html__( 'Height', 'codexin'), 'selector' => '.cx-divider-2::before, .cx-divider-2::after'),
											array( 'property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin'), 'selector' => '.cx-divider-2'),
										),

										esc_html__( 'Line-Icon', 'codexin' ) => array(
											array( 'property' => 'color', 'label' => esc_html__( 'Color', 'codexin'), 'selector' => '.cx-divider i' ),
											array( 'property' => 'background', 'label' => esc_html__( 'Background', 'codexin'), 'selector' => '.cx-divider i' ),
											array( 'property' => 'font-size', 'label' => esc_html__( 'Font Size', 'codexin'), 'selector' => '.cx-divider i'),
											array( 'property' => 'line-height', 'label' => esc_html__( 'Line Height', 'codexin'), 'selector' => '.cx-divider i'),
											array( 'property' => 'font-weight', 'label' => esc_html__( 'Font Weight', 'codexin'), 'selector' => '.cx-divider i'),
											array( 'property' => 'text-align', 'label' => esc_html__( 'text-align', 'codexin'), 'selector' => '.cx-divider i'),
											array( 'property' => 'width', 'label' => esc_html__( 'Width', 'codexin'), 'selector' => '.cx-divider i'),
											array( 'property' => 'height', 'label' => esc_html__( 'Height', 'codexin'), 'selector' => '.cx-divider i'),
											array( 'property' => 'border', 'label' => esc_html__( 'Border', 'codexin'), 'selector' => '.cx-divider i'),
											array( 'property' => 'border-radius', 'label' => esc_html__( 'Border Radius', 'codexin'), 'selector' => '.cx-divider i'),
											array( 'property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin'), 'selector' => '.cx-divider i'),
											array( 'property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin'), 'selector' => '.cx-divider i')
										),

										esc_html__( 'Line-Text', 'codexin' ) => array(
											array( 'property' => 'color', 'label' => esc_html__( 'Color', 'codexin'), 'selector' => '.cx-divider span' ),
											array( 'property' => 'background', 'label' => esc_html__( 'Background', 'codexin'), 'selector' => '.cx-divider span' ),
											array( 'property' => 'font-family', 'label' => esc_html__( 'Font Family', 'codexin'), 'selector' => '.cx-divider span'),
											array( 'property' => 'font-size', 'label' => esc_html__( 'Font Size', 'codexin'), 'selector' => '.cx-divider span'),
											array( 'property' => 'line-height', 'label' => esc_html__( 'Line Height', 'codexin'), 'selector' => '.cx-divider span'),
											array( 'property' => 'font-weight', 'label' => esc_html__( 'Font Weight', 'codexin'), 'selector' => '.cx-divider span'),
											array( 'property' => 'text-align', 'label' => esc_html__( 'text Align', 'codexin'), 'selector' => '.cx-divider span'),
											array( 'property' => 'text-transform', 'label' => esc_html__( 'text Transform', 'codexin'), 'selector' => '.cx-divider span'),
											array( 'property' => 'border', 'label' => esc_html__( 'Border', 'codexin'), 'selector' => '.cx-divider span'),
											array( 'property' => 'border-radius', 'label' => esc_html__( 'Border Radius', 'codexin'), 'selector' => '.cx-divider span'),
											array( 'property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin'), 'selector' => '.cx-divider span'),
											array( 'property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin'), 'selector' => '.cx-divider span')
										),

										esc_html__( 'Desc', 'codexin' ) => array(
											array( 'property' => 'color', 'label' => esc_html__( 'Color', 'codexin'), 'selector' => '.cx-description'),
											array( 'property' => 'font-family', 'label' => esc_html__( 'Font Family', 'codexin'), 'selector' => '.cx-description'),
											array( 'property' => 'font-size', 'label' => esc_html__( 'Font Size', 'codexin'), 'selector' => '.cx-description'),
											array( 'property' => 'line-height', 'label' => esc_html__( 'Line Height', 'codexin'), 'selector' => '.cx-description'),
											array( 'property' => 'font-weight', 'label' => esc_html__( 'Font Weight', 'codexin'), 'selector' => '.cx-description'),
											array( 'property' => 'text-align', 'label' => esc_html__( 'Text Align', 'codexin'), 'selector' => '.cx-description'),
											array( 'property' => 'text-transform', 'label' => esc_html__( 'Text Transform', 'codexin'), 'selector' => '.cx-description'),
											array( 'property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin'), 'selector' => '.cx-description'),
											array( 'property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin'), 'selector' => '.cx-description'),
										),

										esc_html__( 'Box', 'codexin' )	=> array(
											array( 'property' => 'background'),
											array( 'property' => 'border', 'label' => esc_html__( 'Border', 'codexin')),
											array( 'property' => 'margin', 'label' => esc_html__( 'Margin','codexin')),
											array( 'property' => 'padding', 'label' => esc_html__( 'Padding','codexin')),
										)										
									)
								)
							)
						), // end of styling

						//Animate params
						'animate' 	=> array(
							array(
								'name'    		=> 'animate',
								'type'    		=> 'animate'
							)
						), // end of animate
          			)  //end of params
      			), // end of cx_section_heading
			) //end of  array 
		);  //end of kc_add_map
	}
} // end of cx_section_heading_kc


