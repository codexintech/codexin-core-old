<?php


/*
    =========================================
        CODEXIN TAB SHORTCODE
    =========================================
*/

// Registering tab Shortcode
function cx_tabs_shortcode( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'title'	=> '',
		'tab_desc'	=> '',
		'display'	=> '',
		'class'		=> ''
	), $atts));

	// Assigning a master css class and hooking into KC
	$master_class = apply_filters( 'kc-el-class', $atts );
	$master_class[] = 'story';

	// Retrieving user define classes
	$classes = array( 'tab-row' );
	(!empty($class)) ? $classes[] = $class : '';		
		
	$result = '';

	ob_start(); ?>

	<div id="story" class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
		<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
			
				<div class="col-sm-4  col-sm-push-8">
					<div class="story-menu">
						<!-- Nav tabs -->
						<ul class="" role="tablist">

							<li role="presentation" class="active">
								<a href="#html_tutorial" aria-controls="html_tutorial" role="tab" data-toggle="tab"><?php echo $title; ?></a>
							</li>
							<li role="presentation">
								<a href="#js_certificate" aria-controls="js_certificate" role="tab" data-toggle="tab">JavaScript Certificate</a>
							</li>
							<li role="presentation">
								<a href="#js_tutorial" aria-controls="js_tutorial" role="tab" data-toggle="tab">JavaScript Tutorial</a>
							</li>
							<li role="presentation">
								<a href="#bstp_certificate" aria-controls="bstp_certificate" role="tab" data-toggle="tab">Bootstrap Certificate</a></li>

							<li role="presentation"><a href="#bstp_tutorial" aria-controls="bstp_tutorial" role="tab" data-toggle="tab">Bootstrap Tutorial </a></li>
						</ul>
					</div>
				</div> <!-- end of col-sm-4 -->
				<div class="col-sm-8  col-sm-pull-4">
					<div class="story-wrap">
						<div class="story-content">
							<!-- Tab panes -->
							<div class="tab-content">
								<div role="tabpanel" class="tab-pane active" id="html_tutorial">
									<p>We are creative coders, lorem undergraduate tomato soup, but do occaecat time and vitality, such as labor and obesity. Over the years, I will come, who will nostrud exercise, efforts if the school district, and.
									</p>
									<p>Pro volumus deserunt ne. Mel ut tota fierent definiebas. At eos tale debitis mediocrem. Nec velit menandri ut, id admodum similique ius.
									</p>
								</div>
								<div role="tabpanel" class="tab-pane" id="js_certificate">
									<p>We are creative coders, lorem undergraduate tomato soup, but do occaecat time and vitality, such as labor and obesity. Over the years, I will come, who will nostrud exercise, efforts if the school district, and.
									</p>
								</div>
								<div role="tabpanel" class="tab-pane" id="js_tutorial">
									<p>Pro volumus deserunt ne. Mel ut tota fierent definiebas. At eos tale debitis mediocrem. Nec velit menandri ut, id admodum similique ius.
									</p>
								</div>
								<div role="tabpanel" class="tab-pane" id="bstp_certificate">
									<p>Pro volumus deserunt ne. Mel ut tota fierent definiebas. At eos tale debitis mediocrem. Nec velit menandri ut, id admodum similique ius.
									At eos tale debitis mediocrem. Nec velit menandri ut, id admodum similique ius.
									</p>
									<p>Pro volumus deserunt ne. Mel ut tota fierent definiebas. At eos tale debitis mediocrem. Nec velit menandri ut, id admodum similique ius.
									</p>
								</div>
								<div role="tabpanel" class="tab-pane" id="bstp_tutorial">
									<p>Pro volumus deserunt ne. Mel ut tota fierent definiebas. At eos tale debitis mediocrem. Nec velit menandri ut, id admodum similique ius.
									</p><p>Pro volumus deserunt ne. Mel ut tota fierent definiebas. At eos tale debitis mediocrem. Nec velit menandri ut, id admodum similique ius.
									</p>
								</div>
							</div>
						</div>
					</div>	<!-- end of story-wrap	 -->
				</div>	<!-- end of col-sm-8 -->

		</div> <!-- end of tab-row -->
	</div> <!-- end of section -->
	<div class="clearfix"></div>

	<?php
	$result .= ob_get_clean();
	return $result;

} //End cx_social_media_share


// Integrating Shortcode with King Composer
function cx_tab_kc() {

	if (function_exists('kc_add_map')) { 
 		kc_add_map(
 			array(
 				'cx_tab' => array(
 					'name' => esc_html__( 'Codexin Tab', 'codexin' ),
 					'description' => esc_html__('Codexin Tab Item', 'codexin'),
 					'icon' => 'et-hazardous',
 					'category' => 'Codexin',
 					'is_container' => false,
 					'views' => array(
 								'type' => 'views_sections',
 								'sections' => 'cx_tabs'
 							),
 					'params' => array(
 						//general params
 						'general' => array(
 							array(
 								'name' => 'display',
 								'label' => __(' How Display', 'codexin'),
 								'type' => 'select',
 								'options' => array(
 									'horizontal_tabs' => __(' Horizontal Tabs', 'codexin'),
 									'vertical_tabs' => __(' Vertical Tabs', 'codexin'),
 									),
 								'description' => __(' Use sidebar view of your tabs as horizontal or vertical', 'codexin')
 							),
	 						array(
	 							'name' 			=> 'class',
	 							'label' 		=> esc_html__( 'Extra Class ', 'codexin' ),
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
											array('property' => 'color', 'label' => esc_html__( 'Color', 'codexin'), 'selector' => '.socials-title h4'),
											array('property' => 'font-family', 'label' => esc_html__( 'Font family', 'codexin'), 'selector' => '.socials-title h4'),
											array('property' => 'font-size', 'label' => esc_html__( 'Font Size', 'codexin'), 'selector' => '.socials-title h4'),
											array('property' => 'font-weight', 'label' => esc_html__( 'Font Weight', 'codexin'), 'selector' => '.socials-title h4'),
											array('property' => 'line-height', 'label' => esc_html__( 'Line Height', 'codexin'), 'selector' => '.socials-title h4'),
											array('property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin'), 'selector' => '.socials-title h4'),
											array('property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin'), 'selector' => '.socials-title h4')
										),

 										'Description' => array(
 											array('property' => 'color', 'label' => esc_html__( 'Color', 'codexin'), 'selector' => 'i'),
 											array('property' => 'background-color', 'label' => esc_html__( 'Background Color', 'codexin'), 'selector' => 'i'),
 											array('property' => 'color', 'label' => esc_html__( 'Color Hover', 'codexin'), 'selector' => 'i:hover'),
 											array('property' => 'background-color', 'label' => esc_html__( 'Background Color Hover', 'codexin'), 'selector' => 'i:hover'),
 											array('property' => 'font-size', 'label' => esc_html__( 'Font Size', 'codexin'), 'selector' => 'i'),
 											array('property' => 'line-height', 'label' => esc_html__( 'Line Height', 'codexin'), 'selector' => 'i'),
 											array('property' => 'text-align', 'label' => esc_html__( 'Text Align', 'codexin'), 'selector' => 'i'),
 											array('property' => 'border', 'label' => esc_html__( 'Border', 'codexin'), 'selector' => 'i'),
 											array('property' => 'border-radius', 'label' => esc_html__( 'Border Radius', 'codexin'), 'selector' => 'i'),
 											array('property' => 'transition', 'label' => esc_html__( 'Transition Hover', 'codexin'), 'selector' => 'i:hover'),
 											array('property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin'), 'selector' => 'i'),
 											array('property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin'), 'selector' => 'i')
 										),

 										'Box' => array(
 											array('property' => 'background'),
 											array('property' => 'border', 'label' => esc_html__( 'Border', 'codexin')),
 											array('property' => 'border-radius', 'label' => esc_html__( 'Border Radius', 'codexin')),
 											array('property' => 'box-shadow', 'label' => esc_html__( 'Box Shadow', 'codexin')),
 											array('property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin')),
 											array('property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin')),
 										),

									) //End inner-option array

								) //End option array

							) //End inner-styling array

	                	), //End styling array..
 						// animate param
						'animate' => array(
 							array(
 								'name'    		=> 'animate',
 								'type'    		=> 'animate'
 							)
						),//End animate	
	                ), //End params array
	            ),  // End of elemnt cx_social_media_share
			) //end of array 
		);  //end of kc_add_map

	} //End if
} // end of cx_tabs_kc




//Create map cx_tabs for sub-section of cx_tab
add_action('init', 'cx_tabs', 99 );
 
function cx_tabs() {

	if (function_exists('kc_add_map')) 
	{ 
		kc_add_map(
			array(

				'cx_tabs' => array(
					'name' => esc_html__( 'Tab', 'codexin' ),
					'category' => '',
					'title' => esc_html__( 'Tab Settings', 'codexin' ),
					'is_container' => true,
					'system_only' => false,
					'params' => array(
						'general' => array(
							array(
								'name' 			=> 'title',
								'label' 		=> esc_html__( 'Tab Title', 'codexin' ),
								'type' 			=> 'text',
								'description'	=> esc_html__( 'Enter Your Tab Title Here', 'codexin' ),
							),

							array(
								'name' 			=> 'tab_desc',
								'label' 		=> esc_html__( 'Description', 'codexin' ),
								'type' 			=> 'textarea',
								'description'	=> esc_html__( 'Enter Your Tab Description Here', 'codexin' ),
							),

							array(
								'name' 			=> 'class',
								'label' 		=> esc_html__( 'Extra Class ', 'codexin' ),
								'type' 			=> 'text',
								'description'	=> esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS.', 'codexin' ),
							),

 						),//End general array
					) //End Params
	            ),  // End of elemnt kc_icon 

			) //End array
	    ); // End add map

	} // End if

} // End cx_tabs

