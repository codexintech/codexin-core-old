<?php

/**
 * Shortcode -  Information Box
 *
 * @since 1.0
 */

// Do not allow directly accessing this file.
defined( 'ABSPATH' ) OR die( esc_html__( 'This script cannot be accessed directly.', 'codexin' ) );

// Registering Information Box Shortcode
function cx_information_box_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'info_title'		=> '',
		'info_desc' 		=> '',
		'image'				=> '',
		'img_alt'			=> '',
		'button_toggle'		=> '',
		'info_button_text' 	=> '',
		'href'				=> '',
		'class'				=> ''

	), $atts ) );

	$result = '';

	// Assigning a master css class and hooking into KC
	$master_class 	= apply_filters( 'kc-el-class', $atts );
	$master_class[] = 'contest-wrapper';

	// Retrieving user define classes
	$classes = array( 'content-mask' );
	( ! empty( $class ) ) ? $classes[] = $class : '';

	// Retrieving the url
	$retrieve_link 	= codexin_retrieve_url( $href );
	$title 			= ($retrieve_link[1]) ? 'title="'.esc_attr($retrieve_link[1]).'"':'';
	$target 		= ($retrieve_link[2]) ? 'target="'.esc_attr($retrieve_link[2]).'"':'';

	// Retrieving the image url
	$retrive_img_url = codexin_retrieve_img_src( $image, 'codexin-core-rectangle-one' );

	ob_start(); 

	   	echo '<div class="'. esc_attr( implode( ' ', $master_class ) ) .'">';
	   		echo '<img src="'. esc_url( $retrive_img_url ) .'" alt="'. esc_attr( $img_alt ) .'" class="img-responsive">';
		   	echo '<div class="'. esc_attr( implode( ' ', $classes ) ) .'">';
		   		echo '<div class="info-wrapper">';
		   			echo ( ! empty( $info_title ) ) ? '<h2>'. esc_html( $info_title ) .'</h2>' : '';
		   			echo ( ! empty( $info_desc ) ) ? '<p>'. $info_desc .'</p>' : '';
		   			echo ( $button_toggle ) ? '<a href="'. esc_url( $retrieve_link[0] ) .'" '.$title.' '. $target .'>'. esc_html( $info_button_text ) .'</a>' : '';
		   		echo '</div>';
	   		echo '</div> <!-- end of content-mask -->';
   		echo '</div> <!-- end of contest-wrapper -->';

	$result .= ob_get_clean();
	return $result;

} //End cx_information_box


// Integrating Shortcode with King Composer
function cx_information_box_kc() {

	if (function_exists('kc_add_map')) { 
		kc_add_map(
			array(
				'cx_information_box' 	=> array(
					'name' 				=> esc_html__( 'Codexin Information Box', 'codexin' ),
					'description' 		=> esc_html__( 'Information Box', 'codexin' ),
					'icon' 				=> 'et-hazardous',
					'category' 			=> 'Codexin',
					'params' 			=> array(
						// General Params
						'general'		=> array(
							array(
								'name' 			=> 'info_title',
								'label' 		=> esc_html__( 'Information Title ', 'codexin' ),
								'type' 			=> 'text',
								'description'	=> esc_html__( 'Enter Information Title Here', 'codexin' ),
								'admin_label' 	=> true,
							),

							array(
								'name' 			=> 'image',
								'label' 		=> esc_html__( 'Upload Image', 'codexin' ),
								'type' 			=> 'attach_image',
								'admin_label' 	=> true,
							),

	    					array(
	    						'name' 			=> 'img_alt',
	    						'label' 		=> esc_html__( 'Enter Image Alt Tag', 'codexin' ),
	    						'type' 			=> 'text',
    						),

							array(
								'name' 			=> 'info_desc',
								'label' 		=> esc_html__( 'Information Description ', 'codexin' ),
								'type' 			=> 'textarea',
								'description'	=> esc_html__( 'Enter Information Description Here', 'codexin' ),
							),

							array(
								'name' 			=> 'button_toggle',
								'label' 		=> esc_html__( 'Enable Button? ', 'codexin' ),
								'type' 			=> 'toggle',
								'value'			=> 'no'
								),

							array(
								'name' 			=> 'info_button_text',
								'label' 		=> esc_html__( 'Button Text ', 'codexin' ),
								'type' 			=> 'text',
								'relation' 		=> array(
									'parent'    => 'button_toggle',
									'show_when' => 'yes',
								),
								'value'			=> esc_html__( 'Read More', 'codexin' ),
								'description'	=> esc_html__( 'Enter Button Text Here', 'codexin' ),
							),

							array(
								'name' 			=> 'href',
								'label' 		=> esc_html__( 'Custom Link URL ', 'codexin' ),
								'type' 			=> 'link',
								'relation' 		=> array(
									'parent'    => 'button_toggle',
									'show_when' => 'yes',
								),
								'description'	=> esc_html__( 'Enter Your Custom Link Here', 'codexin' ),
							),

							array(
								'name'			=> 'class',
								'label' 		=> esc_html__(' Extra Class', 'codexin'),
								'type'			=> 'text'
							),

		        		), //End General array...

						// Styling param
						'styling' => array(
							array(
								'name'    		=> 'codexin_css',
								'type'    		=> 'css',
								'options' 		=> array(
									array(
										"screens" => "any,1199,991,767,479",

										esc_html__( 'Title', 'codexin' ) => array(
											array( 'property' => 'color', 'label' => esc_html__( 'Color', 'codexin' ),'selector' => '.content-mask h2'),
											array( 'property' => 'font-family', 'label' => esc_html__( 'Font Family', 'codexin' ),'selector' => '.content-mask h2'),
											array( 'property' => 'font-size', 'label' => esc_html__( 'Font Size', 'codexin' ),'selector' => '.content-mask h2'),
											array( 'property' => 'line-height', 'label' => esc_html__( 'Line Height', 'codexin' ),'selector' => '.content-mask h2'),
											array( 'property' => 'font-weight', 'label' => esc_html__( 'Font Weight', 'codexin' ),'selector' => '.content-mask h2'),
											array( 'property' => 'text-align', 'label' => esc_html__( 'Text Align', 'codexin' ),'selector' => '.content-mask h2'),
											array( 'property' => 'text-transform', 'label' => esc_html__( 'Text Transform', 'codexin' ),'selector' => '.content-mask h2'),
											array( 'property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin' ),'selector' => '.content-mask h2'),
											array( 'property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin' ),'selector' => '.content-mask h2'),
										),


										esc_html__( 'Divider', 'codexin' ) => array(
											array( 'property' => 'background', 'label' => esc_html__( 'Color', 'codexin' ),'selector' => '.content-mask .info-wrapper h2::after'),
											array( 'property' => 'width', 'label' => esc_html__( 'Width', 'codexin' ),'selector' => '.content-mask .info-wrapper h2::after'),
											array( 'property' => 'height', 'label' => esc_html__( 'Height', 'codexin' ),'selector' => '.content-mask .info-wrapper h2::after'),
											array( 'property' => 'display', 'label' => esc_html__( 'Display', 'codexin' ),'selector' => '.content-mask .info-wrapper h2::after'),
											array( 'property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin' ),'selector' => '.content-mask .info-wrapper h2::after'),
											array( 'property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin' ),'selector' => '.content-mask .info-wrapper h2::after'),
										),

										esc_html__( 'Description', 'codexin' ) => array(
											array( 'property' => 'color', 'label' => esc_html__( 'Color', 'codexin' ),'selector' => '.content-mask p'),
											array( 'property' => 'font-family', 'label' => esc_html__( 'Font Family', 'codexin' ),'selector' => '.content-mask p'),
											array( 'property' => 'font-size', 'label' => esc_html__( 'Font Size', 'codexin' ),'selector' => '.content-mask p'),
											array( 'property' => 'line-height', 'label' => esc_html__( 'Line Height', 'codexin' ),'selector' => '.content-mask p'),
											array( 'property' => 'font-weight', 'label' => esc_html__( 'Font Weight', 'codexin' ),'selector' => '.content-mask p'),
											array( 'property' => 'text-align', 'label' => esc_html__( 'Text Align', 'codexin' ),'selector' => '.content-mask p'),
											array( 'property' => 'text-transform', 'label' => esc_html__( 'Text Transform', 'codexin' ),'selector' => '.content-mask p'),
											array( 'property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin' ),'selector' => '.content-mask p'),
											array( 'property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin' ),'selector' => '.content-mask p'),
										),

										esc_html__( 'Button', 'codexin' ) => array(
											array( 'property' => 'color', 'label' => esc_html__( 'Color', 'codexin' ),'selector' => '.content-mask a'),
											array( 'property' => 'background', 'label' => esc_html__( 'Background Color', 'codexin' ),'selector' => '.content-mask a'),
											array( 'property' => 'color', 'label' => esc_html__( 'Color on Hover', 'codexin' ),'selector' => '.content-mask a:hover'),
											array( 'property' => 'background-color', 'label' => esc_html__( 'Background Color on Hover', 'codexin' ),'selector' => '.content-mask a:hover'),
											array( 'property' => 'border', 'label' => esc_html__( 'Border', 'codexin' ),'selector' => '.content-mask a'),
											array( 'property' => 'border-color', 'label' => esc_html__( 'Border Color on Hover', 'codexin' ),'selector' => '.content-mask a:hover'),
											array( 'property' => 'font-family', 'label' => esc_html__( 'Font Family', 'codexin' ),'selector' => '.content-mask a'),
											array( 'property' => 'font-size', 'label' => esc_html__( 'Font Size', 'codexin' ),'selector' => '.content-mask a'),
											array( 'property' => 'line-height', 'label' => esc_html__( 'Line Height', 'codexin' ),'selector' => '.content-mask a'),
											array( 'property' => 'border-radius', 'label' => esc_html__( 'Border Radius', 'codexin' ),'selector' => '.content-mask a'),
											array( 'property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin' ),'selector' => '.content-mask a'),
											array( 'property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin' ),'selector' => '.content-mask a'),
										),

										esc_html__( 'Box', 'codexin' )	=> array(
											array( 'property' => 'background', 'selector' => '.content-mask'),
											array( 'property' => 'border', 'label' => esc_html__( 'Border', 'codexin' )),
											array( 'property' => 'border-radius', 'label' => esc_html__( 'Border Radius', 'codexin' )),
											array( 'property' => 'box-shadow', 'label' => esc_html__( 'Box Shadow', 'codexin'), 'selector' => '+.cx-service-box'),
											array( 'property' => 'box-shadow', 'label' => esc_html__( 'Box Shadow on Hover', 'codexin'), 'selector' => '+.cx-service-box:hover'),
											array( 'property' => 'transition', 'label' => esc_html__( 'Hover Transition Animation','codexin'), 'selector' => '+.cx-service-box'),
											array( 'property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin')),
											array( 'property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin')),
										),
									) //End inner-option array
								) //End option array
							) //End inner-styling array
			    		), //End styling
						// Animate param
						'animate' => array(
							array(
								'name'    		=> 'animate',
								'type'    		=> 'animate'
							)
						),//End animate
		        	) //End params 
		    	),  // End of elemnt cx_service_box
			) //end of array 
		);  //end of kc_add_map
	} //End if
} // end of cx_information_box


