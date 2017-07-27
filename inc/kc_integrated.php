<?php

add_action('init', 'codexin_shortcode', 99 );
 
function codexin_shortcode() {
 
	if (function_exists('kc_add_map')) 
	{ 
	    kc_add_map(
	        array(

	            'cx_section_heading' => array(
	                'name' => esc_html__( 'Codexin Section Header', 'codexin' ),
	                'description' => esc_html__('Section Header', 'codexin'),
	                'icon' => 'kc-icon-title',
	                'category' => 'Codexin',
	                'params' => array(
						'general' => array(

		                    array(
		                        'name' 			=> 'title',
		                        'label' 		=> esc_html__( 'Enter Title', 'codexin' ),
		                        'type' 			=> 'text',
		                        'admin_label' 	=> false,
		                    ),

		                    array(
		                        'name' 			=> 'subtitle',
		                        'label' 		=> esc_html__( 'Enter Subtitle', 'codexin' ),
		                        'type' 			=> 'text',
		                        'admin_label' 	=> false,
		                    ),

		                    array(
		                        'name' 			=> 'description_toggle',
		                        'label' 		=> esc_html__( 'Enable Description Field? ', 'codexin' ),
		                        'type' 			=> 'toggle',
		                        'admin_label' 	=> false,
		                    ),

		                    array(
		                        'name' 			=> 'description',
		                        'label' 		=> esc_html__( 'Enter Description', 'codexin' ),
		                        'type' 			=> 'textarea',
								'relation' 		=> array(
								        'parent'    => 'description_toggle',
								        'show_when' => 'yes',
								    ),
		                        'admin_label' 	=> false,
		                    ),

							array(
								'name'	=> 'class',
								'label' => __(' Extra Class', 'kingcomposer'),
								'type'	=> 'text'
							),
						),

						'styling' => array(
							array(
								'name'    => 'codexin_css',
								'type'    => 'css',
								'options' => array(
									array(
										"screens" => "any,1199,991,767,479",
										'Title' => array(
											array('property' => 'color', 'label' => 'Label Color', 'selector' => '.primary-title'),
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
											array('property' => 'color', 'label' => 'Label Color', 'selector' => '.secondary-title'),
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
											array('property' => 'background', 'label' => 'Label Color', 'selector' => '.secondary-title::after'),
											array('property' => 'width', 'label' => 'Width', 'selector' => '.secondary-title::after'),
											array('property' => 'height', 'label' => 'Height', 'selector' => '.secondary-title::after'),
											array('property' => 'display', 'label' => 'Display', 'selector' => '.secondary-title::after'),
											array('property' => 'margin', 'label' => 'Margin', 'selector' => '.secondary-title::after')
										),

										'Desc' => array(
											array('property' => 'color', 'label' => 'Label Color', 'selector' => '.cx-description'),
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

						'animate' => array(
							array(
								'name'    => 'animate',
								'type'    => 'animate'
							)
						),

	                )
	            ),  // End of elemnt cx_section_heading 

	            'cx_about_box' => array(
	                'name' => esc_html__( 'Codexin About Box', 'codexin' ),
	                'description' => esc_html__('Mini About Box', 'codexin'),
	                'icon' => 'kc-icon-feature-box',
	                'category' => 'Codexin',
	                'params' => array(

	                    array(
	                        'name' 			=> 'img',
	                        'label' 		=> esc_html__( 'Upload Image', 'codexin' ),
	                        'type' 			=> 'attach_image',
	                        'admin_label' 	=> false,
	                    ),

	                    array(
	                        'name' 			=> 'img_alt',
	                        'label' 		=> esc_html__( 'Enter Image Alt Tag', 'codexin' ),
	                        'type' 			=> 'text',
	                        'admin_label' 	=> false,
	                    ),

	                    array(
	                        'name' 			=> 'hover_text',
	                        'label' 		=> esc_html__( 'Hover Text ', 'codexin' ),
	                        'type' 			=> 'text',
	                        'admin_label' 	=> false,
	                    ),

	                    array(
	                        'name' 			=> 'icon_toggle',
	                        'label' 		=> esc_html__( 'Enable Hover Icon? ', 'codexin' ),
	                        'type' 			=> 'toggle',
	                        'admin_label' 	=> false,
	                    ),

	                    array(
	                        'name' 			=> 'hover_icon',
	                        'label' 		=> esc_html__( 'Choose Hover Icon', 'codexin' ),
	                        'type' 			=> 'icon_picker',
							'relation' 		=> array(
							        'parent'    => 'icon_toggle',
							        'show_when' => 'yes',
							    ),
	                        'admin_label' 	=> false,
	                    ),

						array(
							'name'     => 'href',
							'label'    => esc_html__(' Custom URL', 'codexin'),
							'type'     => 'link',
							'value'    => '#',
							'description' => esc_html__(' The URL which this box assigned to. You can select page/post or other post type', 'codexin')
						),

	                )
	            ),  // End of elemnt cx_about_box 

	            'cx_animated_counter' => array(
	                'name' => esc_html__( 'Codexin Counter Box', 'codexin' ),
	                'description' => esc_html__('Animated Single Counter', 'codexin'),
	                'icon' => 'kc-icon-counter',
	                'category' => 'Codexin',
	                // Only load assets when using this element
	                'assets' => array(
	                	'scripts' => array(
	                		'waypoints-js-script' => CODEXIN_CORE_ASSET_DIR . '/js/waypoints.min.js',
	                		'counterup-js-script' => CODEXIN_CORE_ASSET_DIR . '/js/jquery.counterup.min.js',         	            
 	            	    ),

	                ), //End assets

	                'params' => array(

	                    array(
	                        'name' 			=> 'bg_color',
	                        'label' 		=> esc_html__( 'Choose Background color', 'codexin' ),
	                        'type' 			=> 'color_picker',
	                        'value'			=> 'rgba(255,155,255,0)',
	                        'admin_label' 	=> false,
	                    ),

	                    array(
	                        'name' 			=> 'count_up',
	                        'label' 		=> __( 'Input Numeric Value to Counter Up', 'codexin' ),
	                        'type' 			=> 'text',
	                        'admin_label' 	=> false,
	                    ),

	                    array(
	                        'name' 			=> 'count_color',
	                        'label' 		=> esc_html__( 'Choose Counter Number Color', 'codexin' ),
	                        'type' 			=> 'color_picker',
	                        'admin_label' 	=> false,
	                    ),

	                    array(
	                        'name' 			=> 'txt',
	                        'label' 		=> esc_html__( 'Enter Text', 'codexin' ),
	                        'type' 			=> 'text',
	                        'admin_label' 	=> false,
	                    ),

	                    array(
	                        'name' 			=> 'txt_color',
	                        'label' 		=> esc_html__( 'Choose Text Color', 'codexin' ),
	                        'type' 			=> 'color_picker',
	                        'admin_label' 	=> false,
	                    ),

	                    array(
	                        'name' 			=> 'icon_toggle',
	                        'label' 		=> esc_html__( 'Enable Icon? ', 'codexin' ),
	                        'type' 			=> 'toggle',
	                        'admin_label' 	=> false,
	                    ),

	                    array(
	                        'name' 			=> 'icon',
	                        'label' 		=> esc_html__( 'Choose Icon', 'codexin' ),
	                        'type' 			=> 'icon_picker',
							'relation' 		=> array(
							        'parent'    => 'icon_toggle',
							        'show_when' => 'yes',
							    ),
	                        'admin_label' 	=> false,
	                    ),

	                    array(
	                        'name' 			=> 'icon_color',
	                        'label' 		=> esc_html__( 'Choose Icon Color', 'codexin' ),
	                        'type' 			=> 'color_picker',
							'relation' 		=> array(
							        'parent'    => 'icon_toggle',
							        'show_when' => 'yes',
							    ),
	                        'admin_label' 	=> false,
	                    ),

	                )
	            ),  // End of elemnt cx_animated_counter  


	            'cx_service_box' => array(
	                'name' => esc_html__( 'Codexin Service Box', 'codexin' ),
	                'description' => esc_html__('Service Box', 'codexin'),
	                'icon' => 'fa-yelp',
	                'category' => 'Codexin',
	                'params' => array(
		                	array(
							'type'			=> 'radio_image',
							'label'			=> esc_html__( 'Select Service Box Template', 'kingcomposer' ),
							'name'			=> 'layout',
							'admin_label'	=> true,
							'options'		=> array(
								'1'	=> CODEXIN_CORE_ASSET_DIR . '/images/service-box/layout-1.png',
								'2'	=> CODEXIN_CORE_ASSET_DIR . '/images/service-box/layout-2.png',
								'3'	=> CODEXIN_CORE_ASSET_DIR . '/images/service-box/layout-3.png',
								'4'	=> CODEXIN_CORE_ASSET_DIR . '/images/service-box/layout-4.png',
							),
							'value'			=> '3'
						),

	                   
	                    array(
	                        'name' 			=> 'service_title',
	                        'label' 		=> esc_html__( 'Servce Title ', 'codexin' ),
	                        'type' 			=> 'text',
	                        'description'	=> esc_html__( 'Enter Service Title Here', 'codexin' ),
	                        'admin_label' 	=> false,
	                    ),

	                    array(
	                        'name' 			=> 'service_title_color',
	                        'label' 		=> esc_html__( 'Servce Title Color ', 'codexin' ),
	                        'type' 			=> 'color_picker',
	                        'description'	=> esc_html__( 'Select Service Title Color', 'codexin' ),
	                        'admin_label' 	=> false,
	                    ),

	                    array(
	                        'name' 			=> 'icon_toggle',
	                        'label' 		=> esc_html__( 'Enable Service Icon? ', 'codexin' ),
	                        'type' 			=> 'toggle',
	                        'admin_label' 	=> false,
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
	                        'admin_label' 	=> false,
	                    ),

	                    array(
	                        'name' 			=> 'icon_color',
	                        'label' 		=> esc_html__( 'Servce Icon Color ', 'codexin' ),
	                        'type' 			=> 'color_picker',
	                        'relation' 		=> array(
							        'parent'    => 'icon_toggle',
							        'show_when' => 'yes',
							    ),
	                        'description'	=> esc_html__( 'Select Service Icon Color', 'codexin' ),
	                        'admin_label' 	=> false,
	                    ),

	                    array(
	                        'name' 			=> 'service_desc',
	                        'label' 		=> esc_html__( 'Servce Description ', 'codexin' ),
	                        'type' 			=> 'textarea',
	                        'description'	=> esc_html__( 'Enter Service Description Here', 'codexin' ),
	                        'admin_label' 	=> false,
	                    ),

	                    array(
	                        'name' 			=> 'service_desc_color',
	                        'label' 		=> esc_html__( 'Servce Description Text Color ', 'codexin' ),
	                        'type' 			=> 'color_picker',
	                        'description'	=> esc_html__( 'Select Service Description Text Color', 'codexin' ),
	                        'admin_label' 	=> false,
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


	            'cx_testimonial' => array(
	                'name' => esc_html__( 'Codexin Testimonial', 'codexin' ),
	                'description' => esc_html__('Testimonial Section', 'codexin'),
	                'icon' => 'et-hazardous',
	                'category' => 'Codexin',
	                'params' => array(
	                	

	                ) //End params array()..

	            ),  // End of elemnt cx_testimonial


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
	                'params' => array(

	                ) //End params array()..

	            ),  // End of elemnt cx_tem


	            'cx_client' => array(
	                'name' => esc_html__( 'Codexin Clients', 'codexin' ),
	                'description' => esc_html__('Clients Section', 'codexin'),
	                'icon' => 'et-hazardous',
	                'category' => 'Codexin',
	                'params' => array(


	                ) //End params array()..

	            ),  // End of elemnt cx_client


	            'cx_happy_client_testimonial' => array(
	                'name' => esc_html__( 'Codexin Clients Testimonial', 'codexin' ),
	                'description' => esc_html__('Happy Clients Testimonial', 'codexin'),
	                'icon' => 'et-hazardous',
	                'category' => 'Codexin',
	                'params' => array(


	                ) //End params array()..

	            ),  // End of elemnt cx_happy_client_testimonial

	            'cx_blog' => array(
	                'name' => esc_html__( 'Codexin Blog', 'codexin' ),
	                'description' => esc_html__('Codexin Blog', 'codexin'),
	                'icon' => 'et-hazardous',
	                'category' => 'Codexin',
	                'params' => array(


	                ) //End params array()..

	            ),  // End of elemnt cx_blog

	            'cx_map' => array(
	                'name' => esc_html__( 'Codexin Google Map', 'codexin' ),
	                'description' => esc_html__('Codexin Google Map', 'codexin'),
	                'icon' => 'et-hazardous',
	                'category' => 'Codexin',
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