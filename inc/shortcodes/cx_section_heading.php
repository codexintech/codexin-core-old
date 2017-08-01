<?php


	function cx_section_heading_shortcode(  $atts, $content = null) {
		   extract(shortcode_atts(array(
		   			'title' 				=> '',
		   			'subtitle'	 			=> '',
		   			'description_toggle' 	=> '',
		   			'description'  			=> '',
		   			'class'		  			=> '',
		   ), $atts));

		   $master_class = apply_filters( 'kc-el-class', $atts );
		   $master_class[] = 'section-heading';
		   $classes = array( 'cx-section-heading' );
		   (!empty($class)) ? $classes[] = $class : '';

		   $result = '';
		   ob_start(); ?>
				<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
					<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
						<h3 class="primary-title"><?php echo esc_html( $title ); ?></h3>
						<h2 class="secondary-title"><?php echo esc_html( $subtitle ); ?></h2>
						<?php if( $description_toggle == 'yes' ): ?>
						<div class="col-md-10 col-md-offset-1 cx-description">
							<p><?php printf('%s', $description ); ?></p>		
						</div>
						<?php endif; ?>
					</div>
				</div>

			<?php
			$result .= ob_get_clean();
			return $result;

	}


	function cx_section_heading_kc() {

		if (function_exists('kc_add_map')) 
		{ 
		    kc_add_map(
	  	        array(
		            'cx_section_heading'=> array(
	                	'name' 			=> esc_html__( 'Codexin Section Header', 'codexin' ),
		                'description' 	=> esc_html__('Section Header', 'codexin'),
		                'icon' 			=> 'kc-icon-title',
		                'category' 		=> 'Codexin',
		                'params' 		=> array(

														'general' 	=> array(
						                    array(
						                        'name' 			=> 'title',
						                        'label' 		=> esc_html__( 'Enter Title', 'codexin' ),
						                        'type' 			=> 'text',
						                        'admin_label'	=> true,
						                    ),

						                    array(
						                        'name' 			=> 'subtitle',
						                        'label' 		=> esc_html__( 'Enter Subtitle', 'codexin' ),
						                        'type' 			=> 'text',
						                    ),

						                    array(
						                        'name' 			=> 'description_toggle',
						                        'label' 		=> esc_html__( 'Enable Description Field? ', 'codexin' ),
						                        'type' 			=> 'toggle',
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
																	'label' 		=> __(' Extra Class', 'codexin'),
																	'type'			=> 'text'
																),
														), // end of general


														'styling' 	=> array(
															array(
																'name'    		=> 'codexin_css',
																'type'    		=> 'css',
																'options' => array(
																	array(
																		"screens" => "any,1199,991,767,479",
																		'Title' => array(
																			array('property' => 'color', 'label' => 'Color', 'selector' => '.primary-title'),
																			array('property' => 'font-family', 'label' => 'Font Family', 'selector' => '.primary-title'),
																			array('property' => 'font-size', 'label' => 'Font Size', 'selector' => '.primary-title'),
																			array('property' => 'line-height', 'label' => 'Line Height', 'selector' => '.primary-title'),
																			array('property' => 'font-weight', 'label' => 'Font Weight', 'selector' => '.primary-title'),
																			array('property' => 'text-align', 'label' => 'Text Align', 'selector' => '.primary-title'),
																			array('property' => 'text-transform', 'label' => 'Text Transform', 'selector' => '.primary-title'),
																			array('property' => 'padding', 'label' => 'Padding', 'selector' => '.primary-title'),
																			array('property' => 'margin', 'label' => 'Margin', 'selector' => '.primary-title')
																		),

																		'Subtitle' => array(
																			array('property' => 'color', 'label' => 'Color', 'selector' => '.secondary-title'),
																			array('property' => 'font-family', 'label' => 'Font Family', 'selector' => '.secondary-title'),
																			array('property' => 'font-size', 'label' => 'Font Size', 'selector' => '.secondary-title'),
																			array('property' => 'line-height', 'label' => 'Line Height', 'selector' => '.secondary-title'),
																			array('property' => 'font-weight', 'label' => 'Font Weight', 'selector' => '.secondary-title'),
																			array('property' => 'text-align', 'label' => 'Text Align', 'selector' => '.secondary-title'),
																			array('property' => 'text-transform', 'label' => 'Text Transform', 'selector' => '.secondary-title'),
																			array('property' => 'padding', 'label' => 'Padding', 'selector' => '.secondary-title'),
																			array('property' => 'margin', 'label' => 'Margin', 'selector' => '.secondary-title'),
																		),

																		'Divider' => array(
																			array('property' => 'background', 'label' => 'Color', 'selector' => '.secondary-title::after'),
																			array('property' => 'width', 'label' => 'Width', 'selector' => '.secondary-title::after'),
																			array('property' => 'height', 'label' => 'Height', 'selector' => '.secondary-title::after'),
																			array('property' => 'display', 'label' => 'Display', 'selector' => '.secondary-title::after'),
																			array('property' => 'margin', 'label' => 'Margin', 'selector' => '.secondary-title::after')
																		),

																		'Desc' => array(
																			array('property' => 'color', 'label' => 'Color', 'selector' => '.cx-description'),
																			array('property' => 'font-family', 'label' => 'Font Family', 'selector' => '.cx-description'),
																			array('property' => 'font-size', 'label' => 'Font Size', 'selector' => '.cx-description'),
																			array('property' => 'line-height', 'label' => 'Line Height', 'selector' => '.cx-description'),
																			array('property' => 'font-weight', 'label' => 'Font Weight', 'selector' => '.cx-description'),
																			array('property' => 'text-align', 'label' => 'Text Align', 'selector' => '.cx-description'),
																			array('property' => 'text-transform', 'label' => 'Text Transform', 'selector' => '.cx-description'),
																			array('property' => 'padding', 'label' => 'Padding', 'selector' => '.cx-description'),
																			array('property' => 'margin', 'label' => 'Margin', 'selector' => '.cx-description'),
																		),

																		'Box'	=> array(
																			array('property' => 'background'),
																			array('property' => 'border', 'label' => 'Border'),
																			array('property' => 'display', 'label' => 'Display'),
																			array('property' => 'border-radius', 'label' => 'Border Radius'),
																			array('property' => 'box-shadow', 'label' => 'Box Shadow', 'selector' => '+.section-heading'),
																			array('property' => 'margin', 'label' => 'Margin'),
																			array('property' => 'padding', 'label' => 'Padding'),
																		)
																		
																	)
																)
															)
														), // end of styling


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


