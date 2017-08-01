<?php
	function cx_contact_form_shortcode( $atts, $content = null ) {
	   extract(shortcode_atts(array(
	   		'contact_title'	=> 'Get In touch',
	   		'show_form_id'	=> '',
	   		'contact_desc'	=> ''
	   ), $atts));

	   $result = '';

	   ob_start(); 
	?>
		<!-- <section id="location" class="location contact-location"> -->
			<div class="contact-form-wrapper reveal-contact-form">
				<div class=" contact-form">
					<div class="contact-intro">
						<h3><?php echo esc_html( $contact_title ); ?></h3>
						<p><?php printf( '%s', $contact_desc ); ?></p>
					</div>		
					<div class="row">

						<?php echo do_shortcode( '[contact-form-7 id="'. $show_form_id .'" title="Contact form 1"]' ); ?>

					</div> <!-- end of col -->
				</div> <!-- end of row -->
			</div> <!-- end of col -->		
		<!-- </section> -->

	<?php
		$result .= ob_get_clean();
		return $result;

 } //End cx_contact_form


	 function cx_contact_form_kc() {

	 	if (function_exists('kc_add_map')) 
	 	{ 
	 		kc_add_map(
	 			array(
	 				'cx_contact_form' => array(
	 					'name' => esc_html__( 'Codexin Contact Form', 'codexin' ),
	 					'description' => esc_html__('Codexin Contact From', 'codexin'),
	 					'icon' => 'et-hazardous',
	 					'category' => 'Codexin',
	 					'params' => array(
	 						array(
	 							'name' 			=> 'contact_title',
	 							'label' 		=> esc_html__( 'Enter Title ', 'codexin' ),
	 							'type' 			=> 'text',
	 							'value'			=> esc_html__( 'Get In touch', 'codexin' ),
	 							'admin_label' 	=> false,
	 							),

	 						array(
	 							'name' 			=> 'show_form_id',
	 							'label' 		=> esc_html__( 'Select Form ', 'codexin' ),
	 							'type' 			=> 'select',
	 							'value'			=> esc_html__( 'Select Your Contact Form Here', 'codexin' ),
	 							'options'		=> array(
	 								'4'	=> 'Contact Form - 1',
	 								'5'	=> 'Contact Form - 2',
	 								'6'	=> 'Contact Form - 3',
	 								),
	 							'value'			=> '1',
	 							'admin_label' 	=> false,
	 							),

	 						array(
	 							'name' 			=> 'description_toggle',
	 							'label' 		=> esc_html__( 'Enable Description Field? ', 'codexin' ),
	 							'type' 			=> 'toggle',
	 							'admin_label' 	=> false,
	 							),

	 						array(
	 							'name' 			=> 'contact_desc',
	 							'label' 		=> esc_html__( 'Enter Description', 'codexin' ),
	 							'type' 			=> 'textarea',
	 							'relation' 		=> array(
	 								'parent'    => 'description_toggle',
	 								'show_when' => 'yes',
	 								),
	 							'admin_label' 	=> false,
	 							)

		                ) //End params array()..

		            ),  // End of elemnt cx_contact_form...


								) //end of  array 


							);  //end of kc_add_map....

						} //End if

					} // end of cx_team_kc


