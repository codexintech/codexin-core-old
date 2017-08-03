<?php
	function cx_contact_form_shortcode( $atts, $content = null ) {
	   extract(shortcode_atts(array(
	   		'contact_title'	=> '',
	   		'show_form_id'	=> '',
	   		'contact_desc'	=> '',
	   		'class'			=> ''
	   ), $atts));

	   $master_class = apply_filters( 'kc-el-class', $atts );
	   $master_class[] = 'contact-form-wrapper reveal-contact-form';
	   $classes = array( 'contact-form' );
	   (!empty($class)) ? $classes[] = $class : '';

	   $result = '';
	 
	   ob_start(); 
	?>
		<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
			<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
				<div class="contact-intro">
					<h3><?php echo esc_html( $contact_title ); ?></h3>
					<p><?php printf( '%s', $contact_desc ); ?></p>
				</div>		
				<div class="row form-element">
						<?php echo $show_form_id; ?>
					<?php echo do_shortcode( '[contact-form-7 id="'. $show_form_id .'" title="Contact form 1"]' ); ?>

				</div> <!-- end of col -->
			</div> <!-- end of row -->
		</div> <!-- end of col -->

	<?php
		$result .= ob_get_clean();
		return $result;

 } //End cx_contact_form




/*-------------------
	Add Param Type 
	------------------*/
 
		add_action('init', 'cx_add_contact_form_param', 99 );
 		//The function add a new param-type in KC ..
		function cx_add_contact_form_param(){
		 
		    global $kc;
		    $kc->add_param_type( 'cx_form_title', 'cx_get_contact_form' );

		}//End
		 
		/**
		 * The function face the all data of created contact-form by contact-form-7 plugin
		 * develop by sazzad on 8/03/2017 
		 *
		 */  
		function cx_get_contact_form(){
			$args = array( 
				'post_type' 	 => 'wpcf7_contact_form', 
				'posts_per_page' => -1
			);
			$rs = array();
			if( $data = get_posts( $args ) ){ ?>
			<select class="kc-param">
				<?php
					echo '<option value=""> Please Select...</option>';
					foreach( $data as $v_form ){ 
						$form_title = $v_form->post_title;
						$form_id = $v_form->ID;
						echo '<option value="'.$form_id.'">'. $form_id .'</option>';
						return $form_id;
					 } 
				 ?>
			</select>
			<?php	
			}else{
				$rs['0'] = esc_html__( 'No Contact Form found', 'codexin' );
			} //End else
			
		} //End cx_get_contact_form()..

	/*-------------------
	End Param Type 
	------------------*/




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
	 						'general' => array(
		 						array(
		 							'name' 			=> 'contact_title',
		 							'label' 		=> esc_html__( 'Enter Title ', 'codexin' ),
		 							'type' 			=> 'text',
		 							'description'	=> esc_html__( 'Get In touch', 'codexin' ),
		 							'admin_label' 	=> false,
		 							),

		 						array(
		 							'name' 			=> 'show_form_id',
		 							'label' 		=> esc_html__( 'Select Form ', 'codexin' ),
		 							'type' 			=> 'cx_form_title',
		 							'description'	=> esc_html__( 'Select Your Contact Form Here', 'codexin' ),
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
		 							),

		 						array(
		 							'name' 			=> 'class',
		 							'label' 		=> esc_html__( 'Extra Class', 'codexin' ),
		 							'type' 			=> 'text',
		 							'description'	=> esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS.', 'codexin' ),
		 							'admin_label' 	=> false,
		 							),

		 					),//End general array

	 						'styling' => array(

	 							array(
	 								'name'    		=> 'codexin_css',
	 								'type'    		=> 'css',
	 								'options' 		=> array(
	 									array(
	 										"screens" => "any,1199,991,767,479",

	 										'Title' => array(
	 											array('property' => 'color', 'label' => 'Color', 'selector' => '.contact-intro h3'),
	 											array('property' => 'font-family', 'label' => 'Font family', 'selector' => '.contact-intro h3'),
	 											array('property' => 'font-size', 'label' => 'Font Size', 'selector' => '.contact-intro h3'),
	 											array('property' => 'font-weight', 'label' => 'Font Weight', 'selector' => '.contact-intro h3'),
	 											array('property' => 'line-height', 'label' => 'Line Height', 'selector' => '.contact-intro h3'),
	 											array('property' => 'padding', 'label' => 'Padding', 'selector' => '.contact-intro h3'),
	 											array('property' => 'margin', 'label' => 'Margin', 'selector' => '.contact-intro h3')
	 											),

	 										'Description' => array(
	 											array('property' => 'color', 'label' => 'Color', 'selector' => '.contact-intro p'),
	 											array('property' => 'font-family', 'label' => 'Font family', 'selector' => '.contact-intro p'),
	 											array('property' => 'font-size', 'label' => 'Font Size', 'selector' => '.contact-intro p'),
	 											array('property' => 'font-weight', 'label' => 'Font Weight', 'selector' => '.contact-intro p'),
	 											array('property' => 'line-height', 'label' => 'Line Height', 'selector' => '.contact-intro p'),
	 											array('property' => 'padding', 'label' => 'Padding', 'selector' => '.contact-intro p'),
	 											array('property' => 'margin', 'label' => 'Margin', 'selector' => '.contact-intro p')
	 											),

	 										'Fields' =>array(
	 											array('property' => 'color', 'label' => 'Color', 'selector' => '.form-element input,textarea'),
	 											array('property' => 'background-color', 'label' => 'Background Color', 'selector' => '.form-element input,textarea'),
	 											array('property' => 'border', 'label' => 'Border', 'selector' => '.form-element input,textarea'),
	 											array('property' => 'border-color', 'label' => 'Border Color Focus', 'selector' => '.form-element input,textarea:focus'),
	 											array('property' => 'padding', 'label' => 'Padding', 'selector' => '.form-element input,textarea'),
	 											array('property' => 'margin', 'label' => 'Margin', 'selector' => '.form-element input,textarea')
	 											),

	 										'Submit' => array(
	 											array('property' => 'color', 'label' => 'Color', 'selector' => '.form-element submit'),
	 											array('property' => 'background-color', 'label' => 'Background Color', 'selector' => '.form-element submit'),
	 											array('property' => 'color', 'label' => 'Hover Color', 'selector' => '.form-element submit:hover'),
	 											array('property' => 'background-color', 'label' => 'Backgroung Hover Color', 'selector' => '.form-element submit:hover'),
	 											array('property' => 'border', 'label' => 'Border', 'selector' => '.form-element submit:hover'),
	 											array('property' => 'border-color', 'label' => 'Border Hover Color', 'selector' => '.form-element submit:hover'),
	 											array('property' => 'transition', 'label' => 'Hover Transition', 'selector' => '.form-element submit:hover'),
	 											array('property' => 'font-family', 'label' => 'Font family', 'selector' => '.form-element submit'),
	 											array('property' => 'font-size', 'label' => 'Font Size', 'selector' => '.form-element submit'),
	 											array('property' => 'font-weight', 'label' => 'Font Weight', 'selector' => '.form-element submit'),
	 											array('property' => 'line-height', 'label' => 'Line Height', 'selector' => '.form-element submit'),
	 											array('property' => 'padding', 'label' => 'Padding', 'selector' => '.form-element submit'),
	 											array('property' => 'margin', 'label' => 'Margin', 'selector' => '.form-element submit')
	 											),

	 										'Box'	=> array(
	 											array('property' => 'background'),
	 											array('property' => 'border', 'label' => 'Border'),
	 											array('property' => 'border-radius', 'label' => 'Border Radius'),
	 											array('property' => 'box-shadow', 'label' => 'Box Shadow'),
	 											array('property' => 'margin', 'label' => 'Margin'),
	 											array('property' => 'padding', 'label' => 'Padding'),
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


