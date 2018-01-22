<?php

/**
 * Shortcode -  Contact Form
 *
 * @since 1.0
 */

// Do not allow directly accessing this file.
defined( 'ABSPATH' ) OR die( esc_html__( 'This script cannot be accessed directly.', 'codexin' ) );

// Registering Contact Form Shortcode
function cx_contact_form_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
   		'contact_title'	=> '',
   		'form_id'	=> '',
   		'contact_desc'	=> '',
   		'class'			=> ''
	), $atts ) );

	$result = '';

	// Assigning a master css class and hooking into KC
	$master_class 	= apply_filters( 'kc-el-class', $atts );
	$master_class[] = 'cx-form-wrapper';

	// Retrieving user define classes
	$classes = array( 'contact-form' );
	(!empty($class)) ? $classes[] = $class : ''; 

	ob_start(); 

	?>

		<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
			<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
				<div class="contact-intro">
					<h3><?php echo esc_html( $contact_title ); ?></h3>
					<p><?php printf( '%s', $contact_desc ); ?></p>
				</div>		
				<div class="form-element">
					<?php echo do_shortcode( '[contact-form-7 id="'. $form_id .'"]' ); ?>
				</div> <!-- end of form-element -->
			</div> <!-- end of contact-form -->
		</div> <!-- end of cx-form-wrapper -->


	<?php
	$result .= ob_get_clean();
	return $result;

} //End cx_contact_form

	 
/**
 * Helper function to fetch all the contact form data from contact form 7
 *
 */  
function cx_get_contact_form() {

	$args = array( 
		'post_type' => 'wpcf7_contact_form', 
		'posts_per_page' => -1 
	);

	$cf7_list = get_posts( $args );

	$cf7_val = array();
	if( class_exists( 'WPCF7' ) ) {
		if ( $cf7_list ) {

			$cf7_val[] = esc_html__( 'Select Contact Form..', 'codexin' );

			foreach ( $cf7_list as $value ) {
				$cf7_val[$value->ID] = $value->post_title;
			}

		} else {
			$cf7_val[0] = esc_html__( 'No Contact Forms found in Contact Form 7', 'codexin' );
		}

	} else {
		$cf7_val[0] = esc_html__( 'Please activate Contact Form 7 Plugin', 'codexin' );
	}

	return $cf7_val;

} //End cx_get_contact_form()..


// Integrating Shortcode with King Composer
function cx_contact_form_kc() {

	// Fetching the contact form 7 data
 	$contact_form = cx_get_contact_form();

 	if( function_exists( 'kc_add_map' ) ) { 
 		kc_add_map(
 			array(
 				'cx_contact_form' => array(
 					'name' 			=> esc_html__( 'Codexin Contact Form', 'codexin' ),
 					'description' 	=> esc_html__( 'Codexin Contact Form', 'codexin' ),
 					'icon' 			=> 'et-hazardous',
 					'category' 		=> 'Codexin',

 					'params' 		=> array(
 						//General params
 						'general' => array(

	 						array(
	 							'name' 			=> 'contact_title',
	 							'label' 		=> esc_html__( 'Title ', 'codexin' ),
	 							'type' 			=> 'text',
	 							'relation'		=> array(
	 								'parent'	=> 'layout',
	 								'show_when'	=> '1',
	 							),
	 							'description'	=> esc_html__( 'Enter Title', 'codexin' ),
	 							'admin_label' 	=> true,
	 						),

	 						array(
	 							'name' 			=> 'form_id',
	 							'label' 		=> esc_html__( 'Select Form (Contact Form 7) ', 'codexin' ),
	 							'type' 			=> 'select',
	 							'options'		=> $contact_form,
	 							'description'	=> esc_html__( 'Select Your Contact Form 7 from the dropdown.', 'codexin' ),
	 							'admin_label' 	=> true,
	 						),

	 						array(
	 							'name' 			=> 'description_toggle',
	 							'label' 		=> esc_html__( 'Enable Description Field? ', 'codexin' ),
	 							'relation'		=> array(
	 								'parent'	=> 'layout',
	 								'show_when'	=> '1',
	 							),
	 							'type' 			=> 'toggle',
	 						),

	 						array(
	 							'name' 			=> 'contact_desc',
	 							'label' 		=> esc_html__( 'Enter Description', 'codexin' ),
	 							'type' 			=> 'textarea',
	 							'relation' 		=> array(
	 								'parent'    => 'description_toggle',
	 								'show_when' => 'yes',
	 							),
	 						),

	 						array(
	 							'name' 			=> 'class',
	 							'label' 		=> esc_html__( 'Extra Class', 'codexin' ),
	 							'type' 			=> 'text',
	 							'description'	=> esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS.', 'codexin' ),
	 						),

	 					),//End general array

 						//Styling params
 						'styling' => array(
 							array(
 								'name'    		=> 'codexin_css',
 								'type'    		=> 'css',
 								'options' 		=> array(
 									array(
 										"screens" => "any,1199,991,767,479",

 										esc_html__( 'Title', 'codexin' ) => array(
 											array( 'property' => 'color', 'label' => esc_html__( 'Color', 'codexin' ), 'selector' => '.contact-intro h3'),
 											array( 'property' => 'font-family', 'label' => esc_html__( 'Font family', 'codexin' ), 'selector' => '.contact-intro h3'),
 											array( 'property' => 'font-size', 'label' => esc_html__( 'Font Size', 'codexin' ), 'selector' => '.contact-intro h3'),
 											array( 'property' => 'text-align', 'label' => esc_html__( 'Text Align', 'codexin' ), 'selector' => '.contact-intro h3'),
 											array( 'property' => 'font-weight', 'label' => esc_html__( 'Font Weight', 'codexin' ), 'selector' => '.contact-intro h3'),
 											array( 'property' => 'line-height', 'label' => esc_html__( 'Line Height', 'codexin' ), 'selector' => '.contact-intro h3'),
 											array( 'property' => 'text-transform', 'label' => esc_html__( 'Text Transform', 'codexin' ), 'selector' => '.contact-intro h3'),
 											array( 'property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin' ), 'selector' => '.contact-intro h3'),
 											array( 'property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin' ), 'selector' => '.contact-intro h3')
 										),

 										esc_html__( 'Description', 'codexin' ) => array(
 											array( 'property' => 'color', 'label' => esc_html__( 'Color', 'codexin' ), 'selector' => '.contact-intro p'),
 											array( 'property' => 'font-family', 'label' => esc_html__( 'Font family', 'codexin' ), 'selector' => '.contact-intro p'),
 											array( 'property' => 'font-size', 'label' => esc_html__( 'Font Size', 'codexin' ), 'selector' => '.contact-intro p'),
 											array( 'property' => 'font-weight', 'label' => esc_html__( 'Font Weight', 'codexin' ), 'selector' => '.contact-intro p'),
 											array( 'property' => 'line-height', 'label' => esc_html__( 'Line Height', 'codexin' ), 'selector' => '.contact-intro p'),
 											array( 'property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin' ), 'selector' => '.contact-intro p'),
 											array( 'property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin' ), 'selector' => '.contact-intro p')
 										),

 										esc_html__( 'Inputs', 'codexin' ) => array(
 											array( 'property' => 'background', 'label' => esc_html__( 'Background', 'codexin' ), 'selector' => 'input.wpcf7-text, .wpcf7-textarea'),
 											array( 'property' => 'color', 'label' => esc_html__( 'Placeholder Color', 'codexin' ), 'selector' => 'input.wpcf7-text::placeholder, .wpcf7-textarea::placeholder'),
 											array( 'property' => 'border', 'label' => esc_html__( 'Border', 'codexin' ), 'selector' => 'input.wpcf7-text, .wpcf7-textarea'),
 											array( 'property' => 'border-radius', 'label' => esc_html__( 'Border Radius', 'codexin' ), 'selector' => 'input.wpcf7-text, .wpcf7-textarea'),
 											array( 'property' => 'width', 'label' => esc_html__( 'Width', 'codexin' ), 'selector' => 'input.wpcf7-text, .wpcf7-textarea'),
 											array( 'property' => 'height', 'label' => esc_html__( 'Height for Inputs', 'codexin' ), 'selector' => 'input.wpcf7-text'),
 											array( 'property' => 'height', 'label' => esc_html__( 'Height for Textarea', 'codexin' ), 'selector' => '.wpcf7-textarea'),
 											array( 'property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin' ), 'selector' => 'input.wpcf7-text, .wpcf7-textarea'),
 											array( 'property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin' ), 'selector' => 'input.wpcf7-text, .wpcf7-textarea')
 										),

 										esc_html__( 'Labels', 'codexin' ) => array(
 											array( 'property' => 'color', 'label' => esc_html__( 'Color', 'codexin' ), 'selector' => 'label'),
 											array( 'property' => 'font-family', 'label' => esc_html__( 'Font family', 'codexin' ), 'selector' => 'label'),
 											array( 'property' => 'font-size', 'label' => esc_html__( 'Font Size', 'codexin' ), 'selector' => 'label'),
 											array( 'property' => 'text-align', 'label' => esc_html__( 'Text-Align', 'codexin' ), 'selector' => 'label'),
 											array( 'property' => 'font-weight', 'label' => esc_html__( 'Font Weight', 'codexin' ), 'selector' => 'label'),
 											array( 'property' => 'line-height', 'label' => esc_html__( 'Line Height', 'codexin' ), 'selector' => 'label'),
 											array( 'property' => 'text-transform', 'label' => esc_html__( 'Text Transform', 'codexin' ), 'selector' => 'label'),
 											array( 'property' => 'display', 'label' => esc_html__( 'Display', 'codexin' ), 'selector' => 'label'),
 											array( 'property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin' ), 'selector' => 'label'),
 											array( 'property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin' ), 'selector' => 'label')
 										),

 										esc_html__( 'Button', 'codexin' ) => array(
 											array( 'property' => 'color', 'label' => esc_html__( 'Color', 'codexin' ), 'selector' => '.wpcf7-submit'),
 											array( 'property' => 'color', 'label' => esc_html__( 'Color on Hover', 'codexin' ), 'selector' => '.wpcf7-submit:hover'),
 											array( 'property' => 'background-color', 'label' => esc_html__( 'Background', 'codexin' ), 'selector' => '.wpcf7-submit'),
 											array( 'property' => 'background-color', 'label' => esc_html__( 'Background on Hover', 'codexin' ), 'selector' => '.wpcf7-submit:hover'),
 											array( 'property' => 'font-family', 'label' => esc_html__( 'Font family', 'codexin' ), 'selector' => '.wpcf7-submit'),
 											array( 'property' => 'font-size', 'label' => esc_html__( 'Font Size', 'codexin' ), 'selector' => '.wpcf7-submit'),
 											array( 'property' => 'text-align', 'label' => esc_html__( 'Text-Align', 'codexin' ), 'selector' => '.wpcf7-submit'),
 											array( 'property' => 'font-weight', 'label' => esc_html__( 'Font Weight', 'codexin' ), 'selector' => '.wpcf7-submit'),
 											array( 'property' => 'line-height', 'label' => esc_html__( 'Line Height', 'codexin' ), 'selector' => '.wpcf7-submit'),
 											array( 'property' => 'text-transform', 'label' => esc_html__( 'Text Transform', 'codexin' ), 'selector' => '.wpcf7-submit'),
 											array( 'property' => 'border', 'label' => esc_html__( 'Border', 'codexin' ), 'selector' => '.wpcf7-submit'),
 											array( 'property' => 'border-color', 'label' => esc_html__( 'Border Color on Hover', 'codexin' ), 'selector' => '.wpcf7-submit:hover'),
 											array( 'property' => 'border-radius', 'label' => esc_html__( 'Border Radius', 'codexin' ), 'selector' => '.wpcf7-submit'),
 											array( 'property' => 'width', 'label' => esc_html__( 'Width', 'codexin' ), 'selector' => '.wpcf7-submit'),
 											array( 'property' => 'height', 'label' => esc_html__( 'Height', 'codexin' ), 'selector' => '.wpcf7-submit'),
 											array( 'property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin' ), 'selector' => '.wpcf7-submit'),
 											array( 'property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin' ), 'selector' => '.wpcf7-submit')
 										),

 										esc_html__( 'Box', 'codexin' ) => array(
 											array( 'property' => 'background'),
 											array( 'property' => 'width', 'label' => esc_html__( 'Width', 'codexin') ),
 											array( 'property' => 'border', 'label' => esc_html__( 'Border', 'codexin') ),
 											array( 'property' => 'border-radius', 'label' => esc_html__( 'Border Radius', 'codexin')),
 											array( 'property' => 'box-shadow', 'label' => esc_html__( 'Box Shadow', 'codexin')),
 											array( 'property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin')),
 											array( 'property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin')),
 										),

									) //End inner-option array

								) //End option array

							) //End inner-styling array

                		), //End styling array..

            		'animate' => array(
						array(
							'name'    		=> 'animate',
							'type'    		=> 'animate'
							)
						),//End animate
	                ) //End params array()..
	            ),  // End of elemnt cx_contact_form...
			) //end of  array 
		);  //end of kc_add_map....
	} //End if
} // end of cx_contact_form


