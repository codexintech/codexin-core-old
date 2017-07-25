<?php

add_action('init', 'codexin_shortcode', 99 );
 
function codexin_shortcode() {
 
	if (function_exists('kc_add_map')) 
	{ 
	    kc_add_map(
	        array(

	            'cx_section_heading' => array(
	                'name' => __( 'Codexin Section Header', 'codexin' ),
	                'description' => __('Section Header', 'codexin'),
	                'icon' => 'kc-icon-title',
	                'category' => 'Codexin',
	                'params' => array(

	                    array(
	                        'name' 			=> 'title',
	                        'label' 		=> __( 'Enter Primary Title', 'codexin' ),
	                        'type' 			=> 'text',
	                        'admin_label' 	=> false,
	                    ),

	                    array(
	                        'name' 			=> 'subtitle',
	                        'label' 		=> __( 'Enter Secondary Title', 'codexin' ),
	                        'type' 			=> 'text',
	                        'admin_label' 	=> false,
	                    ),

	                    array(
	                        'name' 			=> 'description_toggle',
	                        'label' 		=> __( 'Enable Description Field? ', 'codexin' ),
	                        'type' 			=> 'toggle',
	                        'admin_label' 	=> false,
	                    ),

	                    array(
	                        'name' 			=> 'description',
	                        'label' 		=> __( 'Enter Description', 'codexin' ),
	                        'type' 			=> 'textarea',
							'relation' 		=> array(
							        'parent'    => 'description_toggle',
							        'show_when' => 'yes',
							    ),
	                        'admin_label' 	=> false,
	                    )

	                )
	            ),  // End of elemnt cx_section_heading 

	            'cx_about_box' => array(
	                'name' => __( 'Codexin About Box', 'codexin' ),
	                'description' => __('Mini About Box', 'codexin'),
	                'icon' => 'kc-icon-feature-box',
	                'category' => 'Codexin',
	                'params' => array(

	                    array(
	                        'name' 			=> 'img',
	                        'label' 		=> __( 'Upload Image', 'codexin' ),
	                        'type' 			=> 'attach_image',
	                        'admin_label' 	=> false,
	                    ),

	                    array(
	                        'name' 			=> 'img_alt',
	                        'label' 		=> __( 'Enter Image Alt Tag', 'codexin' ),
	                        'type' 			=> 'text',
	                        'admin_label' 	=> false,
	                    ),

	                    array(
	                        'name' 			=> 'hover_text',
	                        'label' 		=> __( 'Hover Text ', 'codexin' ),
	                        'type' 			=> 'text',
	                        'admin_label' 	=> false,
	                    ),

	                    array(
	                        'name' 			=> 'icon_toggle',
	                        'label' 		=> __( 'Enable Hover Icon? ', 'codexin' ),
	                        'type' 			=> 'toggle',
	                        'admin_label' 	=> false,
	                    ),

	                    array(
	                        'name' 			=> 'hover_icon',
	                        'label' 		=> __( 'Choose Hover Icon', 'codexin' ),
	                        'type' 			=> 'icon_picker',
							'relation' 		=> array(
							        'parent'    => 'icon_toggle',
							        'show_when' => 'yes',
							    ),
	                        'admin_label' 	=> false,
	                    ),

						array(
							'name'     => 'href',
							'label'    => __(' Custom URL', 'codexin'),
							'type'     => 'link',
							'value'    => '#',
							'description' => __(' The URL which this box assigned to. You can select page/post or other post type', 'codexin')
						),

	                )
	            ),  // End of elemnt cx_about_box 

	            'cx_animated_counter' => array(
	                'name' => __( 'Codexin Counter Box', 'codexin' ),
	                'description' => __('Animated Single Counter', 'codexin'),
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
	                        'label' 		=> __( 'Choose Background color', 'codexin' ),
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
	                        'label' 		=> __( 'Choose Counter Number Color', 'codexin' ),
	                        'type' 			=> 'color_picker',
	                        'admin_label' 	=> false,
	                    ),

	                    array(
	                        'name' 			=> 'txt',
	                        'label' 		=> __( 'Enter Text', 'codexin' ),
	                        'type' 			=> 'text',
	                        'admin_label' 	=> false,
	                    ),

	                    array(
	                        'name' 			=> 'txt_color',
	                        'label' 		=> __( 'Choose Text Color', 'codexin' ),
	                        'type' 			=> 'color_picker',
	                        'admin_label' 	=> false,
	                    ),

	                    array(
	                        'name' 			=> 'icon_toggle',
	                        'label' 		=> __( 'Enable Icon? ', 'codexin' ),
	                        'type' 			=> 'toggle',
	                        'admin_label' 	=> false,
	                    ),

	                    array(
	                        'name' 			=> 'icon',
	                        'label' 		=> __( 'Choose Icon', 'codexin' ),
	                        'type' 			=> 'icon_picker',
							'relation' 		=> array(
							        'parent'    => 'icon_toggle',
							        'show_when' => 'yes',
							    ),
	                        'admin_label' 	=> false,
	                    ),

	                    array(
	                        'name' 			=> 'icon_color',
	                        'label' 		=> __( 'Choose Icon Color', 'codexin' ),
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
	                'name' => __( 'Codexin Service Box', 'codexin' ),
	                'description' => __('Service Box', 'codexin'),
	                'icon' => 'fa-yelp',
	                'category' => 'Codexin',
	                'params' => array(
		                	array(
							'type'			=> 'radio_image',
							'label'			=> __( 'Select Service Box Template', 'kingcomposer' ),
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
	                        'label' 		=> __( 'Servce Title ', 'codexin' ),
	                        'type' 			=> 'text',
	                        'description'	=> __( 'Enter Service Title Here', 'codexin' ),
	                        'admin_label' 	=> false,
	                    ),

	                    array(
	                        'name' 			=> 'service_title_color',
	                        'label' 		=> __( 'Servce Title Color ', 'codexin' ),
	                        'type' 			=> 'color_picker',
	                        'description'	=> __( 'Select Service Title Color', 'codexin' ),
	                        'admin_label' 	=> false,
	                    ),

	                    array(
	                        'name' 			=> 'icon_toggle',
	                        'label' 		=> __( 'Enable Service Icon? ', 'codexin' ),
	                        'type' 			=> 'toggle',
	                        'admin_label' 	=> false,
	                    ),

	                    array(
	                        'name' 			=> 'icon',
	                        'label' 		=> __( 'Choose Service Icon', 'codexin' ),
	                        'type' 			=> 'icon_picker',
							'relation' 		=> array(
							        'parent'    => 'icon_toggle',
							        'show_when' => 'yes',
							    ),
	                        'description'	=> __( 'Select Service Icon', 'codexin' ),
	                        'admin_label' 	=> false,
	                    ),

	                    array(
	                        'name' 			=> 'icon_color',
	                        'label' 		=> __( 'Servce Icon Color ', 'codexin' ),
	                        'type' 			=> 'color_picker',
	                        'relation' 		=> array(
							        'parent'    => 'icon_toggle',
							        'show_when' => 'yes',
							    ),
	                        'description'	=> __( 'Select Service Icon Color', 'codexin' ),
	                        'admin_label' 	=> false,
	                    ),

	                    array(
	                        'name' 			=> 'service_desc',
	                        'label' 		=> __( 'Servce Description ', 'codexin' ),
	                        'type' 			=> 'textarea',
	                        'description'	=> __( 'Enter Service Description Here', 'codexin' ),
	                        'admin_label' 	=> false,
	                    ),

	                    array(
	                        'name' 			=> 'service_desc_color',
	                        'label' 		=> __( 'Servce Description Text Color ', 'codexin' ),
	                        'type' 			=> 'color_picker',
	                        'description'	=> __( 'Select Service Description Text Color', 'codexin' ),
	                        'admin_label' 	=> false,
	                    ),

	                ) //End params array()..

	            ),  // End of elemnt cx_service_box


	            'cx_information_box' => array(
	                'name' => __( 'Codexin Information Box', 'codexin' ),
	                'description' => __('Information Box', 'codexin'),
	                'icon' => 'et-hazardous',
	                'category' => 'Codexin',
	                'params' => array(
	                   
	                    array(
	                        'name' 			=> 'info_title',
	                        'label' 		=> __( 'Information Title ', 'codexin' ),
	                        'type' 			=> 'text',
	                        'description'	=> __( 'Enter Information Title Here', 'codexin' ),
	                        'admin_label' 	=> false,
	                    ),

	                    array(
	                        'name' 			=> 'title_color',
	                        'label' 		=> __( 'Information Title Color ', 'codexin' ),
	                        'type' 			=> 'color_picker',
	                        'description'	=> __( 'Select Information Title Color', 'codexin' ),
	                        'admin_label' 	=> false,
	                    ),

	                    array(
	                        'name' 			=> 'info_image',
	                        'label' 		=> __( 'Upload Image', 'codexin' ),
	                        'type' 			=> 'attach_image',
	                        'admin_label' 	=> false,
	                    ),

	                    array(
	                        'name' 			=> 'info_desc',
	                        'label' 		=> __( 'Information Description ', 'codexin' ),
	                        'type' 			=> 'textarea',
	                        'description'	=> __( 'Enter Information Description Here', 'codexin' ),
	                        'admin_label' 	=> false,
	                    ),

	                    array(
	                        'name' 			=> 'info_button_text',
	                        'label' 		=> __( 'Information Button Text ', 'codexin' ),
	                        'type' 			=> 'text',
	                        'description'	=> __( 'Enter Button Text Here', 'codexin' ),
	                        'admin_label' 	=> false,
	                    ),

	                ) //End params array()..

	            ),  // End of elemnt cx_service_box


	            'cx_events_box' => array(
	                'name' => __( 'Codexin Events Section', 'codexin' ),
	                'description' => __('Events Section', 'codexin'),
	                'icon' => 'et-hazardous',
	                'category' => 'Codexin',
	                'params' => array(
	                   
	                    array(
	                        'name' 			=> 'event_title',
	                        'label' 		=> __( 'Event Title ', 'codexin' ),
	                        'type' 			=> 'text',
	                        'description'	=> __( 'Enter Event Title Here', 'codexin' ),
	                        'admin_label' 	=> false,
	                    ),

	                    array(
	                        'name' 			=> 'title_color',
	                        'label' 		=> __( 'Event Title Color ', 'codexin' ),
	                        'type' 			=> 'color_picker',
	                        'description'	=> __( 'Select Event Title Color', 'codexin' ),
	                        'admin_label' 	=> false,
	                    ),

	                    array(
	                        'name' 			=> 'event_icon',
	                        'label' 		=> __( 'Select Icon', 'codexin' ),
	                        'type' 			=> 'icon_picker',
	                        'description'	=> __( 'Select Event Icon Here', 'codexin' ),
	                        'admin_label' 	=> false,
	                    ),

	                    array(
	                        'name' 			=> 'icon_color',
	                        'label' 		=> __( 'Event Icon Color ', 'codexin' ),
	                        'type' 			=> 'color_picker',
	                        'description'	=> __( 'Select Icon Color Here', 'codexin' ),
	                        'admin_label' 	=> false,
	                    ),

	                    array(
	                        'name' 			=> 'event_desc',
	                        'label' 		=> __( 'Event Description ', 'codexin' ),
	                        'type' 			=> 'textarea',
	                        'description'	=> __( 'Enter Event Description Here', 'codexin' ),
	                        'admin_label' 	=> false,
	                    ),


	                ) //End params array()..

	            ),  // End of elemnt cx_events_box



	        ) //End add map array().....

	    ); // End add map
	
	} // End if
 
}  
 
?>