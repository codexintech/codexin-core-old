<?php

add_action('init', 'codexin_shortcode', 99 );
 
function codexin_shortcode() {
 
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
						),

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
						),

						'animate' 	=> array(
							array(
								'name'    		=> 'animate',
								'type'    		=> 'animate'
							)
						),

	                )
	            ),  // End of elemnt cx_section_heading 

	            'cx_about_box' 		=> array(
	                'name' 			=> esc_html__( 'Codexin About Box', 'codexin' ),
	                'description' 	=> esc_html__('Mini About Box', 'codexin'),
	                'icon' 			=> 'kc-icon-feature-box',
	                'category' 		=> 'Codexin',
	                'params' 		=> array(
						'general' 	=> array(
		                    array(
								'name'        	=> 'image',
								'label'       	=> esc_html__(' Upload Image', 'kingcomposer'),
								'type'        	=> 'attach_image',
								'admin_label' 	=> true,
		                    ),

		                    array(
		                        'name' 			=> 'img_alt',
		                        'label' 		=> esc_html__( 'Enter Image Alt Tag', 'codexin' ),
		                        'type' 			=> 'text',
		                    ),

		                    array(
		                        'name' 			=> 'hover',
		                        'label' 		=> esc_html__( 'Text on Hover ', 'codexin' ),
		                        'type' 			=> 'text',
		                        'value'			=> 'Sample Text',
		                        'admin_label' 	=> true,
		                    ),

		                    array(
		                        'name' 			=> 'icon_toggle',
		                        'label' 		=> esc_html__( 'Enable Hover Icon? ', 'codexin' ),
		                        'type' 			=> 'toggle',
		                    ),

		                    array(
		                        'name' 			=> 'hover_icon',
		                        'label' 		=> esc_html__( 'Choose Hover Icon', 'codexin' ),
		                        'type' 			=> 'icon_picker',
								'relation' 		=> array(
								        'parent'    => 'icon_toggle',
								        'show_when' => 'yes',
								    ),
								'value'			=> 'no'
		                    ),

							array(
								'name'    		=> 'img_action',
								'label'   		=> esc_html__(' On click event', 'codexin'),
								'type'    		=> 'select',
								'options' 		=> array(
									''                 => esc_html__(' None', 'codexin'),
									'img_pop'          => esc_html__(' Open Image In Lightbox', 'codexin'),
									'open_custom_link' => esc_html__(' Open Custom Link', 'codexin')
								),
								'value'	  		=> '',
								'description' => esc_html__(' Select the click event when users click on the image.', 'codexin')
							),

							array(
								'name'     		=> 'href',
								'label'    		=> esc_html__(' Custom URL', 'codexin'),
								'type'    		=> 'link',
								'relation' 		=> array(
								        'parent'    => 'img_action',
								        'show_when' => 'open_custom_link',
								    ),
								'value'    		=> '#',
								'description' 	=> esc_html__(' The URL which this box assigned to. You can select page/post or other post type', 'codexin')
							),

							array(
								'name'			=> 'class',
								'label' 		=> __(' Extra Class', 'codexin'),
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

										'Hover Text' => array(
											array('property' => 'color', 'label' => 'Label Color', 'selector' => '.single-content p'),
											array('property' => 'font-family', 'label' => 'Font Family', 'selector' => '.single-content p'),
											array('property' => 'font-size', 'label' => 'Font Size', 'selector' => '.single-content p'),
											array('property' => 'line-height', 'label' => 'Line Height', 'selector' => '.single-content p'),
											array('property' => 'font-weight', 'label' => 'Font Weight', 'selector' => '.single-content p'),
											array('property' => 'text-align', 'label' => 'Text Align', 'selector' => '.single-content p'),
											array('property' => 'text-transform', 'label' => 'Text Transform', 'selector' => '.single-content p'),
											array('property' => 'padding', 'label' => 'Padding', 'selector' => '.single-content p'),
											array('property' => 'margin', 'label' => 'Margin', 'selector' => '.single-content p'),
										),

										'Icon' => array(
											array('property' => 'color', 'label' => 'Label Color', 'selector' => '.single-content i'),
											array('property' => 'background', 'label' => 'Label Color', 'selector' => '.single-content i'),
											array('property' => 'font-size', 'label' => 'Font Size', 'selector' => '.single-content i'),
											array('property' => 'display', 'label' => 'Display', 'selector' => '.single-content i'),
											array('property' => 'text-align', 'label' => 'Text Align', 'selector' => '.single-content i'),
											array('property' => 'width', 'label' => 'Width', 'selector' => '.single-content i'),
											array('property' => 'padding', 'label' => 'Padding', 'selector' => '.single-content i'),
											array('property' => 'margin', 'label' => 'Margin', 'selector' => '.single-content i')
										),

										'Hover Border' => array(
											array('property' => 'border-color', 'label' => 'Color', 'selector' => '.img-thumb .content-wrapper::before, .img-thumb a::before, .img-thumb .content-wrapper::after, .img-thumb a::after'),
											array('property' => 'border-width', 'label' => 'Border Width', 'selector' => '.img-thumb .content-wrapper::before, .img-thumb a::before, .img-thumb .content-wrapper::after, .img-thumb a::after'),
											array('property' => 'margin', 'label' => 'Margin', 'selector' => '.img-thumb .content-wrapper::before, .img-thumb a::before, .img-thumb .content-wrapper::after, .img-thumb a::after')
										),

										'Box'	=> array(
											array('property' => 'border', 'label' => 'Border'),
											array('property' => 'border-radius', 'label' => 'Border Radius'),
											array('property' => 'box-shadow', 'label' => 'Box Shadow', 'selector' => '+.about-box'),
											array('property' => 'box-shadow', 'label' => 'Box Shadow on Hover', 'selector' => '+.about-box:hover'),
											array('property' => 'transition', 'label' => 'Hover Transition Animation', 'selector' => '+.about-box'),
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
	            ),  // End of elemnt cx_about_box 

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
		                        'label' 		=> __( 'Input Numeric Value to Counter Up', 'codexin' ),
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
								'label' 		=> __(' Extra Class', 'codexin'),
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
	            ),  // End of elemnt cx_animated_counter  


	            'cx_service_box' 	=> array(
	                'name' 			=> esc_html__( 'Codexin Service Box', 'codexin' ),
	                'description' 	=> esc_html__('Service Box', 'codexin'),
	                'icon' 			=> 'fa-yelp',
	                'category' 		=> 'Codexin',
	                'params' 		=> array(
	                	'general'	=> array(
		                	array(
							'type'			=> 'radio_image',
							'label'			=> esc_html__( 'Select Service Box Template', 'codexin' ),
							'name'			=> 'layout',
							'options'		=> array(
								'1'	=> CODEXIN_CORE_ASSET_DIR . '/images/service-box/layout-1.png',
								// '2'	=> CODEXIN_CORE_ASSET_DIR . '/images/service-box/layout-2.png',
								// '3'	=> CODEXIN_CORE_ASSET_DIR . '/images/service-box/layout-3.png',
							),
							'value'			=> '1'
						),

	                   
	                    array(
	                        'name' 			=> 'service_title',
	                        'label' 		=> esc_html__( 'Servce Title ', 'codexin' ),
	                        'type' 			=> 'text',
	                        'description'	=> esc_html__( 'Enter Service Title', 'codexin' ),
	                        'admin_label' 	=> true,
	                    ),

	                    // array(
	                    //     'name' 			=> 'service_title_color',
	                    //     'label' 		=> esc_html__( 'Servce Title Color ', 'codexin' ),
	                    //     'type' 			=> 'color_picker',
	                    //     'description'	=> esc_html__( 'Select Service Title Color', 'codexin' ),
	                    //     'admin_label' 	=> false,
	                    // ),

	                    array(
	                        'name' 			=> 'icon_toggle',
	                        'label' 		=> esc_html__( 'Enable Service Icon? ', 'codexin' ),
	                        'type' 			=> 'toggle',
	                        'value'			=> 'no'
	                    ),

	                    array(
	                        'name' 			=> 'icon',
	                        'label' 		=> esc_html__( 'Choose Service Icon', 'codexin' ),
	                        'type' 			=> 'icon_picker',
							'relation' 		=> array(
							        'parent'    => 'icon_toggle',
							        'show_when' => 'yes',
							    ),
	                        'description'	=> esc_html__( 'Select Service Icon', 'codexin' ),
	                    ),

	          //           array(
	          //               'name' 			=> 'icon_color',
	          //               'label' 		=> esc_html__( 'Servce Icon Color ', 'codexin' ),
	          //               'type' 			=> 'color_picker',
	          //               'relation' 		=> array(
							    //     'parent'    => 'icon_toggle',
							    //     'show_when' => 'yes',
							    // ),
	          //               'description'	=> esc_html__( 'Select Service Icon Color', 'codexin' ),
	          //               'admin_label' 	=> false,
	          //           ),

	                    array(
	                        'name' 			=> 'service_desc',
	                        'label' 		=> esc_html__( 'Service Description ', 'codexin' ),
	                        'type' 			=> 'textarea',
	                        'description'	=> esc_html__( 'Enter Service Description', 'codexin' ),
	                    ),

	                    // array(
	                    //     'name' 			=> 'service_desc_color',
	                    //     'label' 		=> esc_html__( 'Servce Description Text Color ', 'codexin' ),
	                    //     'type' 			=> 'color_picker',
	                    //     'description'	=> esc_html__( 'Select Service Description Text Color', 'codexin' ),
	                    //     'admin_label' 	=> false,
	                    // ),

		                ),

	                	'styling' => array(

							array(
								'name'    		=> 'codexin_css',
								'type'    		=> 'css',
								'options' 		=> array(
									array(
										"screens" => "any,1199,991,767,479",

										'Title' => array(
											array('property' => 'color', 'label' => 'Color', 'selector' => '.single-service h4'),
											array('property' => 'font-family', 'label' => 'Font Family', 'selector' => '.single-service h4'),
											array('property' => 'font-size', 'label' => 'Font Size', 'selector' => '.single-service h4'),
											array('property' => 'line-height', 'label' => 'Line Height', 'selector' => '.single-service h4'),
											array('property' => 'font-weight', 'label' => 'Font Weight', 'selector' => '.single-service h4'),
											array('property' => 'text-align', 'label' => 'Text Align', 'selector' => '.single-service h4'),
											array('property' => 'text-transform', 'label' => 'Text Transform', 'selector' => '.single-service h4'),
											array('property' => 'padding', 'label' => 'Padding', 'selector' => '.single-service h4'),
											array('property' => 'margin', 'label' => 'Margin', 'selector' => '.single-service h4'),
										),

										'Description' => array(
											array('property' => 'color', 'label' => 'Color', 'selector' => '.single-service p'),
											array('property' => 'font-family', 'label' => 'Font Family', 'selector' => '.single-service p'),
											array('property' => 'font-size', 'label' => 'Font Size', 'selector' => '.single-service p'),
											array('property' => 'line-height', 'label' => 'Line Height', 'selector' => '.single-service p'),
											array('property' => 'font-weight', 'label' => 'Font Weight', 'selector' => '.single-service p'),
											array('property' => 'text-align', 'label' => 'Text Align', 'selector' => '.single-service p'),
											array('property' => 'text-transform', 'label' => 'Text Transform', 'selector' => '.single-service p'),
											array('property' => 'padding', 'label' => 'Padding', 'selector' => '.single-service p'),
											array('property' => 'margin', 'label' => 'Margin', 'selector' => '.single-service p'),
										),

										'Icon' => array(
											array('property' => 'color', 'label' => 'Label Color', 'selector' => '.single-service i'),
											array('property' => 'font-size', 'label' => 'Font Size', 'selector' => '.single-service i'),
											array('property' => 'padding', 'label' => 'Padding', 'selector' => '.single-service i'),
											array('property' => 'margin', 'label' => 'Margin', 'selector' => '.single-service i')
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

	                ) //End params array()..

	            ),  // End of elemnt cx_service_box


	            'cx_information_box' => array(
	                'name' => esc_html__( 'Codexin Information Box', 'codexin' ),
	                'description' => esc_html__('Information Box', 'codexin'),
	                'icon' => 'et-hazardous',
	                'category' => 'Codexin',
	                'params' => array(
	                   
	                    array(
	                        'name' 			=> 'info_title',
	                        'label' 		=> esc_html__( 'Information Title ', 'codexin' ),
	                        'type' 			=> 'text',
	                        'description'	=> esc_html__( 'Enter Information Title Here', 'codexin' ),
	                        'admin_label' 	=> false,
	                    ),

	                    array(
	                        'name' 			=> 'title_color',
	                        'label' 		=> esc_html__( 'Information Title Color ', 'codexin' ),
	                        'type' 			=> 'color_picker',
	                        'description'	=> esc_html__( 'Select Information Title Color', 'codexin' ),
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
	                        'name' 			=> 'info_button_text',
	                        'label' 		=> esc_html__( 'Information Button Text ', 'codexin' ),
	                        'type' 			=> 'text',
	                        'description'	=> esc_html__( 'Enter Button Text Here', 'codexin' ),
	                        'admin_label' 	=> false,
	                    ),

	                ) //End params array()..

	            ),  // End of elemnt cx_service_box


	            'cx_events_box' => array(
	                'name' => esc_html__( 'Codexin Events Section', 'codexin' ),
	                'description' => esc_html__('Events Section', 'codexin'),
	                'icon' => 'et-hazardous',
	                'category' => 'Codexin',
	                'params' => array(

	                    array(
	                        'name' 			=> 'event_icon_one',
	                        'label' 		=> __( 'Select First Icon', 'codexin' ),
	                        'type' 			=> 'icon_picker',
	                        'description'	=> esc_html__( 'Select Event First Icon Here', 'codexin' ),
	                        'admin_label' 	=> false,
	                    ),

	                    array(
	                        'name' 			=> 'event_icon_two',
	                        'label' 		=> __( 'Select Second Icon', 'codexin' ),
	                        'type' 			=> 'icon_picker',
	                        'description'	=> esc_html__( 'Select Event Second Icon Here', 'codexin' ),
	                        'admin_label' 	=> false,
	                    ),

	                    array(
	                        'name' 			=> 'event_icon_three',
	                        'label' 		=> __( 'Select Third Icon', 'codexin' ),
	                        'type' 			=> 'icon_picker',
	                        'description'	=> esc_html__( 'Select Event Third Icon Here', 'codexin' ),
	                        'admin_label' 	=> false,
	                    ),

	                ) //End params array()..

	            ),  // End of elemnt cx_events_box

	            'cx_team' => array(
	                'name' => esc_html__( 'Codexin Team Section', 'codexin' ),
	                'description' => esc_html__('Team Section', 'codexin'),
	                'icon' => 'et-hazardous',
	                'category' => 'Codexin',
	                'params' => array(


	                ) //End params array()..

	            ),  // End of elemnt cx_tem


	            'cx_portfolio' => array(
	                'name' => esc_html__( 'Codexin Portfolio', 'codexin' ),
	                'description' => esc_html__('Portfolio Section', 'codexin'),
	                'icon' => 'et-hazardous',
	                'category' => 'Codexin',
	                //Only load assets when using this element
	                'assets' => array(
	                	'scripts' => array(
	                		'imagesloaded-js' => CODEXIN_CORE_ASSET_DIR . '/js/imagesloaded.pkgd.min.js',
	                		'isotope-js-script' => CODEXIN_CORE_ASSET_DIR . '/js/isotope.pkgd.min.js',
	                		'portfolio-isotope-js' => CODEXIN_CORE_ASSET_DIR . '/js/shortcode-js/cx_portfolio-isotope.js',
	                	),

	                ), //End assets

	                'params' => array(


	                ) //End params array()..

	            ),  // End of elemnt cx_tem


	            'cx_client' => array(
	                'name' => esc_html__( 'Codexin Clients', 'codexin' ),
	                'description' => esc_html__('Clients Section', 'codexin'),
	                'icon' => 'et-hazardous',
	                'category' => 'Codexin',
	                //Only load assets when using this element
	                'assets' => array(
	                	'scripts' => array(
	                		'owl-carousel-js' => CODEXIN_CORE_ASSET_DIR . '/js/owl.carousel.min.js',
	                		'client-carousel-script' => CODEXIN_CORE_ASSET_DIR . '/js/shortcode-js/cx_client-carousel.js',
	                	),

	                ), //End assets
	                'params' => array(


	                ) //End params array()..

	            ),  // End of elemnt cx_client


	            'cx_testimonial' => array(
	                'name' => esc_html__( 'Codexin Testimonial', 'codexin' ),
	                'description' => esc_html__('Codexin Testimonial', 'codexin'),
	                'icon' => 'et-hazardous',
	                'category' => 'Codexin',
	                'params' => array(
	                	array(
							'type'			=> 'radio_image',
							'label'			=> esc_html__( 'Select Testimonial Template', 'codexin' ),
							'name'			=> 'layout',
							'admin_label'	=> true,
							'options'		=> array(
								'1'	=> CODEXIN_CORE_ASSET_DIR . '/images/testimonial/layout-1.png',
								'2'	=> CODEXIN_CORE_ASSET_DIR . '/images/testimonial/layout-2.png',
							),
							'value'	=> '1'
						),

	                ) //End params array()..

	            ),  // End of elemnt cx_testimonial

	            'cx_blog' => array(
	                'name' => esc_html__( 'Codexin Blog', 'codexin' ),
	                'description' => esc_html__('Codexin Blog', 'codexin'),
	                'icon' => 'et-hazardous',
	                'category' => 'Codexin',
	                'params' => array(


	                ) //End params array()..

	            ),  // End of elemnt cx_blog....


	            'cx_map' => array(
	                'name' => esc_html__( 'Codexin Google Map', 'codexin' ),
	                'description' => esc_html__('Codexin Google Map', 'codexin'),
	                'icon' => 'et-hazardous',
	                'category' => 'Codexin',
	                //Only load assets when using this element
	                'assets' => array(
	                	'scripts' => array(
	                		'google-js' => 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAKKh6e3XWgzR69Mb8cqk30ndps_hzaMls',
	                		'gmap-js'		=> CODEXIN_CORE_ASSET_DIR . '/js/gmaps.js',
	                		'cx-map-js'		=> CODEXIN_CORE_ASSET_DIR . '/js/shortcode-js/cx_map.js',
	                	),

	               ), //End assets

	                'params' => array(
	                	

	                ) //End params array()..

	            ),  // End of elemnt cx_blog....

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


	            'cx_social_media_share' => array(
	                'name' => esc_html__( 'Codexin Sopcial Media', 'codexin' ),
	                'description' => esc_html__('Codexin Social Media', 'codexin'),
	                'icon' => 'et-hazardous',
	                'category' => 'Codexin',
	                'params' => array(
	                	array(
	                        'name' 			=> 'fb',
	                        'label' 		=> esc_html__( 'Face Book Link ', 'codexin' ),
	                        'type' 			=> 'text',
	                        'description'	=> esc_html__( 'Enter Your Face-Book URL Here', 'codexin' ),
	                        'admin_label' 	=> false,
	                    ),

	                    array(
	                        'name' 			=> 'tw',
	                        'label' 		=> esc_html__( 'Twitter Link ', 'codexin' ),
	                        'type' 			=> 'text',
	                        'description'	=> esc_html__( 'Enter Your Twitter URL Here', 'codexin' ),
	                        'admin_label' 	=> false,
	                    ),

	                    array(
	                        'name' 			=> 'ld',
	                        'label' 		=> esc_html__( 'Linkedin Link ', 'codexin' ),
	                        'type' 			=> 'text',
	                        'description'	=> esc_html__( 'Enter Your Linkedin URL Here', 'codexin' ),
	                        'admin_label' 	=> false,
	                    ),

	                    array(
	                        'name' 			=> 'ig',
	                        'label' 		=> esc_html__( 'Instagram Link ', 'codexin' ),
	                        'type' 			=> 'text',
	                        'description'	=> esc_html__( 'Enter Your Instagram URL Here', 'codexin' ),
	                        'admin_label' 	=> false,
	                    ),

	                    array(
	                        'name' 			=> 'be',
	                        'label' 		=> esc_html__( 'Behance Link ', 'codexin' ),
	                        'type' 			=> 'text',
	                        'description'	=> esc_html__( 'Enter Your Behance URL Here', 'codexin' ),
	                        'admin_label' 	=> false,
	                    ),

	                    

	                ) //End params array()..

	            ),  // End of elemnt cx_social_media_share...


	        ) //End add map array().....

	    ); // End add map
	
	} // End if
 
}  
 
?>