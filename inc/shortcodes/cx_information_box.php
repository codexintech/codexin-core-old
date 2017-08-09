<?php



	function cx_information_box_shortcode( $atts, $content = null ) {
	   extract(shortcode_atts(array(
			'info_title'	=> '',
			'info_desc' 	=> '',
			'info_image'	=> '',
			'img_alt'		=> '',
			'button_toggle'	=> '',
			'info_button_text' => '',
			'href'			=> '',
			'class'			=> ''

	   ), $atts));

	   $master_class = apply_filters( 'kc-el-class', $atts );
	   $master_class[] = 'contest-wrapper';
	   $classes = array( 'content-mask' );
	   (!empty($class)) ? $classes[] = $class : '';

	   $result = '';

	   $retrive_img_url = retrieve_img_src( $info_image, 'info-image' );

	   $retrieve_link = retrieve_url( $href );

	   ob_start(); 
		?>
			<!-- <div class="col-sm-12"> -->
				<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
					<img src="<?php echo esc_url( $retrive_img_url ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>" class="img-responsive">
					<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">	
						<h2><?php echo esc_html( $info_title, 'codexin' ); ?></h2>
						<p> <?php printf('%s', $info_desc ); ?> </p>
						<?php if( $button_toggle == 'yes') : ?>
							<a href="<?php echo esc_url($retrieve_link[0]); ?>" title="<?php echo esc_attr($retrieve_link[1]); ?>" target="<?php echo esc_attr($retrieve_link[2]); ?>"><?php echo esc_html( $info_button_text ); ?></a>
						<?php endif; ?>
					</div>
				</div>
			<!-- </div> -->
		<?php
		$result .= ob_get_clean();
		return $result;

 } //End cx_information_box


	 function cx_information_box_kc() {

	 	if (function_exists('kc_add_map')) 
	 	{ 
	 		kc_add_map(
	 			array(
	 				'cx_information_box' => array(
	 					'name' => esc_html__( 'Codexin Information Box', 'codexin' ),
	 					'description' => esc_html__('Information Box', 'codexin'),
	 					'icon' => 'et-hazardous',
	 					'category' => 'Codexin',
	 					'params' => array(

	 						'general'	=> array(

	 							array(
	 								'name' 			=> 'info_title',
	 								'label' 		=> esc_html__( 'Information Title ', 'codexin' ),
	 								'type' 			=> 'text',
	 								'description'	=> esc_html__( 'Enter Information Title Here', 'codexin' ),
	 								'admin_label' 	=> false,
	 								),

	 							array(
	 								'name' 			=> 'info_image',
	 								'label' 		=> esc_html__( 'Upload Image', 'codexin' ),
	 								'type' 			=> 'attach_image',
	 								'admin_label' 	=> false,
	 								),

	 							array(
	 								'name' 			=> 'info_desc',
	 								'label' 		=> esc_html__( 'Information Description ', 'codexin' ),
	 								'type' 			=> 'textarea',
	 								'description'	=> esc_html__( 'Enter Information Description Here', 'codexin' ),
	 								'admin_label' 	=> false,
	 								),

	 							array(
	 								'name' 			=> 'button_toggle',
	 								'label' 		=> esc_html__( 'Enable Link Button? ', 'codexin' ),
	 								'type' 			=> 'toggle',
	 								'value'			=> 'no'
	 								),

	 							array(
	 								'name' 			=> 'info_button_text',
	 								'label' 		=> esc_html__( 'Information Button Text ', 'codexin' ),
	 								'type' 			=> 'text',
	 								'relation' 		=> array(
	 									'parent'    => 'button_toggle',
	 									'show_when' => 'yes',
	 									),
	 								'description'	=> esc_html__( 'Enter Button Text Here', 'codexin' ),
	 								'admin_label' 	=> false,
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
	 								'admin_label' 	=> false,
	 								),

	 							array(
	 								'name'			=> 'class',
	 								'label' 		=> __(' Extra Class', 'codexin'),
	 								'type'			=> 'text'
	 								),

		                		), //End General array...

	 						'styling' => array(

	 							array(
	 								'name'    		=> 'codexin_css',
	 								'type'    		=> 'css',
	 								'options' 		=> array(
	 									array(
	 										"screens" => "any,1199,991,767,479",

	 										'Title' => array(
	 											array('property' => 'color', 'label' => 'Color', 'selector' => '.content-mask h2'),
	 											array('property' => 'font-family', 'label' => 'Font Family', 'selector' => '.content-mask h2'),
	 											array('property' => 'font-size', 'label' => 'Font Size', 'selector' => '.content-mask h2'),
	 											array('property' => 'line-height', 'label' => 'Line Height', 'selector' => '.content-mask h2'),
	 											array('property' => 'font-weight', 'label' => 'Font Weight', 'selector' => '.content-mask h2'),
	 											array('property' => 'text-align', 'label' => 'Text Align', 'selector' => '.content-mask h2'),
	 											array('property' => 'text-transform', 'label' => 'Text Transform', 'selector' => '.content-mask h2'),
	 											array('property' => 'padding', 'label' => 'Padding', 'selector' => '.content-mask h2'),
	 											array('property' => 'margin', 'label' => 'Margin', 'selector' => '.content-mask h2'),
	 											),

	 										'Description' => array(
	 											array('property' => 'color', 'label' => 'Color', 'selector' => '.content-mask p'),
	 											array('property' => 'font-family', 'label' => 'Font Family', 'selector' => '.content-mask p'),
	 											array('property' => 'font-size', 'label' => 'Font Size', 'selector' => '.content-mask p'),
	 											array('property' => 'line-height', 'label' => 'Line Height', 'selector' => '.content-mask p'),
	 											array('property' => 'font-weight', 'label' => 'Font Weight', 'selector' => '.content-mask p'),
	 											array('property' => 'text-align', 'label' => 'Text Align', 'selector' => '.content-mask p'),
	 											array('property' => 'text-transform', 'label' => 'Text Transform', 'selector' => '.content-mask p'),
	 											array('property' => 'padding', 'label' => 'Padding', 'selector' => '.content-mask p'),
	 											array('property' => 'margin', 'label' => 'Margin', 'selector' => '.content-mask p'),
	 											),

	 										'Button' => array(
	 											array('property' => 'color', 'label' => 'Text Color', 'selector' => '.content-mask a'),
	 											array('property' => 'background', 'label' => 'Background Color', 'selector' => '.content-mask a'),
	 											array('property' => 'color', 'label' => 'Hover Text Color', 'selector' => '.content-mask a:hover'),	                						
	 											array('property' => 'background-color', 'label' => 'Hover Background Color', 'selector' => '.content-mask a:hover'),
	 											array('property' => 'transition', 'label' => 'Hover Background Transition', 'selector' => '.content-mask a:hover'),
	 											array('property' => 'border', 'label' => 'Border', 'selector' => '.content-mask a'),
	 											array('property' => 'border-radius', 'label' => 'Border Radius', 'selector' => '.content-mask a'),
	 											array('property' => 'padding', 'label' => 'Padding', 'selector' => '.content-mask a'),
	 											array('property' => 'margin', 'label' => 'Margin', 'selector' => '.content-mask a'),
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

		            ),  // End of elemnt cx_service_box


						) //end of  array 


				    );  //end of kc_add_map....

				} //End if

		} // end of cx_section_heading_kc


