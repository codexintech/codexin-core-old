<?php


/*
    ======================================
        CODEXIN CONTACT FORM SHORTCODE
    ======================================
*/

// Registering Contact Form Shortcode
function cx_contact_form_shortcode( $atts, $content = null ) {
	extract(shortcode_atts(array(
   		'contact_title'	=> '',
   		'show_form_id'	=> '',
   		'contact_desc'	=> '',
   		'class'			=> ''
	), $atts));

	$result = '';

	ob_start(); 
		// Assigning a master css class and hooking into KC
		$master_class = apply_filters( 'kc-el-class', $atts );
		$master_class[] = 'cx-form-wrapper';

		// Retrieving user define classes
		$classes = array( 'contact-form' );
		(!empty($class)) ? $classes[] = $class : ''; 
	?>

		<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
			<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
				<div class="contact-intro">
					<h3><?php echo esc_html( $contact_title ); ?></h3>
					<p><?php printf( '%s', $contact_desc ); ?></p>
				</div>		
				<div class="form-element">
					<?php echo do_shortcode( '[contact-form-7 id="'. $show_form_id .'" title=""]' ); ?>
				</div> <!-- end of form-element -->
			</div> <!-- end of contact-form -->
		</div> <!-- end of contact-form-wrapper -->


	<?php
	$result .= ob_get_clean();
	return $result;

} //End cx_contact_form




/*-------------------
	Add Param Type 
	------------------*/
		 
/**
 *
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
	if ( $cf7_list ) {

		$cf7_val[] = __( 'Select Contact Form..', 'codexin' );

		foreach ( $cf7_list as $value ) {
			$cf7_val[$value->ID] = $value->post_title;
		}

	} else {

		$cf7_val[0] = __( 'No contact forms found', 'codexin' );

	}

	return $cf7_val;


} //End cx_get_contact_form()..


// Integrating Shortcode with King Composer
function cx_contact_form_kc() {

 	$contact_form = cx_get_contact_form();

 	if (function_exists('kc_add_map')) { 
 		kc_add_map(
 			array(
 				'cx_contact_form' => array(
 					'name' => esc_html__( 'Codexin Contact Form', 'codexin' ),
 					'description' => esc_html__('Codexin Contact From', 'codexin'),
 					'icon' => 'et-hazardous',
 					'category' => 'Codexin',

 					'params' => array(
 						//General params
 						'general' => array(

	 						array(
	 							'name' 			=> 'contact_title',
	 							'label' 		=> esc_html__( 'Enter Title ', 'codexin' ),
	 							'type' 			=> 'text',
	 							'relation'		=> array(
	 								'parent'	=> 'layout',
	 								'show_when'	=> '1',
	 							),
	 							'description'	=> esc_html__( 'Get In touch', 'codexin' ),
	 							'admin_label' 	=> true,
	 						),

	 						array(
	 							'name' 			=> 'show_form_id',
	 							'label' 		=> esc_html__( 'Select Form ', 'codexin' ),
	 							'type' 			=> 'select',
	 							'options'		=> $contact_form,
	 							'description'	=> esc_html__( 'Select Your Contact Form Here', 'codexin' ),
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

 										'Title' => array(
 											array('property' => 'color', 'label' => esc_html__( 'Color', 'codexin' ), 'selector' => '.contact-intro h3'),
 											array('property' => 'font-family', 'label' => esc_html__( 'Font family', 'codexin' ), 'selector' => '.contact-intro h3'),
 											array('property' => 'font-size', 'label' => esc_html__( 'Font Size', 'codexin' ), 'selector' => '.contact-intro h3'),
 											array('property' => 'font-weight', 'label' => esc_html__( 'Font Weight', 'codexin' ), 'selector' => '.contact-intro h3'),
 											array('property' => 'line-height', 'label' => esc_html__( 'Line Height', 'codexin' ), 'selector' => '.contact-intro h3'),
 											array('property' => 'text-transform', 'label' => esc_html__( 'Text Transform', 'codexin' ), 'selector' => '.contact-intro h3'),
 											array('property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin' ), 'selector' => '.contact-intro h3'),
 											array('property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin' ), 'selector' => '.contact-intro h3')
 										),

 										'Description' => array(
 											array('property' => 'color', 'label' => esc_html__( 'Color', 'codexin' ), 'selector' => '.contact-intro p'),
 											array('property' => 'font-family', 'label' => esc_html__( 'Font family', 'codexin' ), 'selector' => '.contact-intro p'),
 											array('property' => 'font-size', 'label' => esc_html__( 'Font Size', 'codexin' ), 'selector' => '.contact-intro p'),
 											array('property' => 'font-weight', 'label' => esc_html__( 'Font Weight', 'codexin' ), 'selector' => '.contact-intro p'),
 											array('property' => 'line-height', 'label' => esc_html__( 'Line Height', 'codexin' ), 'selector' => '.contact-intro p'),
 											array('property' => 'width', 'label' => esc_html__( 'Width', 'codexin' ), 'selector' => '.contact-intro p'),
 											array('property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin' ), 'selector' => '.contact-intro p'),
 											array('property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin' ), 'selector' => '.contact-intro p')
 										),

 										'Box'	=> array(
 											array('property' => 'background'),
 											array('property' => 'border', 'label' => esc_html__( 'Border', 'codexin') ),
 											array('property' => 'border-radius', 'label' => esc_html__( 'Border Radius', 'codexin')),
 											array('property' => 'box-shadow', 'label' => esc_html__( 'Box Shadow', 'codexin')),
 											array('property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin')),
 											array('property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin')),
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


