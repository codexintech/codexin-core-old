<?php


/*
    ===========================================
        CODEXIN TAB MENU ITEM SHORTCODE
    ===========================================
*/

// Registering Tab Menu Item Shortcode
function cx_tab_menu_shortcode( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'tab_one_title'		=> '',
		'tab_two_title'		=> '',
		'tab_three_title'	=> '',
		'tab_four_title'	=> '',
		'tab_five_title'	=> '',
		'tab_one_info'		=> '',
		'tab_two_info'		=> '',
		'tab_three_info'	=> '',
		'tab_four_info'		=> '',
		'tab_five_info'		=> '',
		'class'				=> '',
	), $atts));

	// Assigning a master css class and hooking into KC
	$master_class = apply_filters( 'kc-el-class', $atts );
	$master_class[] = 'story mrg-50';

	// Retrieving user define classes
	$classes = array( 'rv2-tab-container' );
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
							<a href="#html_tutorial" aria-controls="html_tutorial" role="tab" data-toggle="tab">
								<?php echo esc_html__( $tab_one_title ); ?></a>
							</li>
							<li role="presentation">
								<a href="#js_certificate" aria-controls="js_certificate" role="tab" data-toggle="tab">
									<?php echo esc_html__( $tab_two_title ); ?></a>
								</li>
								<li role="presentation">
									<a href="#js_tutorial" aria-controls="js_tutorial" role="tab" data-toggle="tab">
										<?php echo esc_html__( $tab_three_title ); ?>
									</a>
								</li>
								<li role="presentation">
									<a href="#bstp_certificate" aria-controls="bstp_certificate" role="tab" data-toggle="tab">
										<?php echo esc_html__( $tab_four_title ); ?>
									</a></li>

									<li role="presentation"><a href="#bstp_tutorial" aria-controls="bstp_tutorial" role="tab" data-toggle="tab"><?php echo esc_html__( $tab_five_title ); ?></a></li>
								</ul>
							</div>
						</div> <!-- end of col-sm-4 -->
						<div class="col-sm-8  col-sm-pull-4">
							<div class="story-wrap">
								<div class="story-content">
									<!-- Tab panes -->
									<div class="tab-content">
										<div role="tabpanel" class="tab-pane active" id="html_tutorial">
											<p> <?php echo esc_html__( $tab_one_info ); ?> </p>
										</div>
										<div role="tabpanel" class="tab-pane" id="js_certificate">
											<p><?php echo esc_html__( $tab_two_info ); ?></p>
										</div>
										<div role="tabpanel" class="tab-pane" id="js_tutorial">
											<p><?php echo esc_html__( $tab_three_info ); ?></p>
										</div>
										<div role="tabpanel" class="tab-pane" id="bstp_certificate">
											<p><?php echo esc_html__( $tab_four_info ); ?></p>
										</div>
										<div role="tabpanel" class="tab-pane" id="bstp_tutorial">
											<p><?php echo esc_html__( $tab_five_info ); ?></p>
										</div>
									</div>
								</div>
							</div>	<!-- end of story-wrap	 -->
						</div>	<!-- end of col-sm-8 -->

					</div> <!-- end of row -->
				</div> <!-- end of rv2-tab-container -->
			</div> <!-- end of section -->
			<div class="clearfix"></div>
				
	<?php
	$result .= ob_get_clean();
	return $result;

} //End cx_events_accordion

// Integrating Shortcode with King Composer
function cx_tab_menu_kc() {

	if (function_exists('kc_add_map')) { 
 		kc_add_map(
 			array(
 				'cx_tab_menu' => array(
 					'name' => esc_html__( 'Codexin Tab Menu Item', 'codexin' ),
 					'description' => esc_html__('Tab Menu Item', 'codexin'),
 					'icon' => 'et-hazardous',
 					'category' => 'Codexin',
 					'params' => array(
 						//Tab One params
 						'TAB ONE'	=> array(
 							array(
 								'name' 			=> 'tab_one_title',
 								'label' 		=> esc_html__( 'Tab-One Title', 'codexin' ),
 								'type' 			=> 'text',
 								'description'	=> esc_html__( 'Enter Tab-One Title/Menu Item Here', 'codexin' ),
 							),

 							array(
 								'name' 			=> 'tab_one_info',
 								'label' 		=> esc_html__( 'Tab-One Descscription', 'codexin' ),
 								'type' 			=> 'textarea',
 								'description'	=> esc_html__( 'Enter Tab-One Descscription Here', 'codexin' ),
 							),

 							array(
 								'name' 			=> 'class',
 								'label' 		=> esc_html__( 'Enter Class', 'codexin' ),
 								'type' 			=> 'text',
 								'description'	=> esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS.', 'codexin' ),
 							),

					    ), //End tab-one array

					    'TAB TWO'	=> array(
 							array(
 								'name' 			=> 'tab_two_title',
 								'label' 		=> esc_html__( 'Tab-Two Title', 'codexin' ),
 								'type' 			=> 'text',
 								'description'	=> esc_html__( 'Enter Tab-Two Title/Menu Item Here', 'codexin' ),
 							),

 							array(
 								'name' 			=> 'tab_two_info',
 								'label' 		=> esc_html__( 'Tab-Two Descscription', 'codexin' ),
 								'type' 			=> 'textarea',
 								'description'	=> esc_html__( 'Enter Tab-Two Descscription Here', 'codexin' ),
 							),

 							array(
 								'name' 			=> 'class',
 								'label' 		=> esc_html__( 'Enter Class', 'codexin' ),
 								'type' 			=> 'text',
 								'description'	=> esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS.', 'codexin' ),
 							),

					    ), //End tab-two array

					    'TAB THREE'	=> array(
 							array(
 								'name' 			=> 'tab_three_title',
 								'label' 		=> esc_html__( 'Tab-Three Title', 'codexin' ),
 								'type' 			=> 'text',
 								'description'	=> esc_html__( 'Enter Tab-Three Title/Menu Item Here', 'codexin' ),
 							),

 							array(
 								'name' 			=> 'tab_three_info',
 								'label' 		=> esc_html__( 'Tab-Three Descscription', 'codexin' ),
 								'type' 			=> 'textarea',
 								'description'	=> esc_html__( 'Enter Tab-Three Descscription Here', 'codexin' ),
 							),

 							array(
 								'name' 			=> 'class',
 								'label' 		=> esc_html__( 'Enter Class', 'codexin' ),
 								'type' 			=> 'text',
 								'description'	=> esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS.', 'codexin' ),
 							),

					    ), //End tab-three array

					    'TAB FOUR'	=> array(
 							array(
 								'name' 			=> 'tab_four_title',
 								'label' 		=> esc_html__( 'Tab-Four Title', 'codexin' ),
 								'type' 			=> 'text',
 								'description'	=> esc_html__( 'Enter Tab-Four Title/Menu Item Here', 'codexin' ),
 							),

 							array(
 								'name' 			=> 'tab_four_info',
 								'label' 		=> esc_html__( 'Tab-Four Descscription', 'codexin' ),
 								'type' 			=> 'textarea',
 								'description'	=> esc_html__( 'Enter Tab-Four Descscription Here', 'codexin' ),
 							),

 							array(
 								'name' 			=> 'class',
 								'label' 		=> esc_html__( 'Enter Class', 'codexin' ),
 								'type' 			=> 'text',
 								'description'	=> esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS.', 'codexin' ),
 							),

					    ), //End tab-four array

					    'TAB FIVE'	=> array(
 							array(
 								'name' 			=> 'tab_five_title',
 								'label' 		=> esc_html__( 'Tab-Five Title', 'codexin' ),
 								'type' 			=> 'text',
 								'description'	=> esc_html__( 'Enter Tab-Five Title/Menu Item Here', 'codexin' ),
 							),

 							array(
 								'name' 			=> 'tab_five_info',
 								'label' 		=> esc_html__( 'Tab-Five Descscription', 'codexin' ),
 								'type' 			=> 'textarea',
 								'description'	=> esc_html__( 'Enter Tab-Five Descscription Here', 'codexin' ),
 							),

 							array(
 								'name' 			=> 'class',
 								'label' 		=> esc_html__( 'Enter Class', 'codexin' ),
 								'type' 			=> 'text',
 								'description'	=> esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS.', 'codexin' ),
 							),

					    ), //End tab-three array

 						//Styling params
 						'styling' => array(

 							array(
 								'name'    		=> 'codexin_css',
 								'type'    		=> 'css',
 								'options' 		=> array(
 									array(
 										"screens" => "any,1199,991,767,479",

 										'Icon' => array(
 											array('property' => 'color', 'label' => esc_html__( 'Color', 'codexin'), 'selector' => '.panel-title i'),
 											array('property' => 'font-size', 'label' => esc_html__( 'Font Size', 'codexin'), 'selector' => '.panel-title i'),
 											array('property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin'), 'selector' => '.panel-title i'),
 											array('property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin'), 'selector' => '.panel-title i')
 										),

 										'Box'	=> array(
 											array('property' => 'background'),
 											array('property' => 'border', 'label' => esc_html__( 'Border', 'codexin')),
 											array('property' => 'border-radius', 'label' => esc_html__( 'Border Radius', 'codexin')),
 											array('property' => 'box-shadow', 'label' => esc_html__( 'Box Shadow', 'codexin')),
 											array('property' => 'box-shadow', 'label' => esc_html__( 'Box Shadow on Hover', 'codexin')),
 											array('property' => 'transition', 'label' => esc_html__( 'Hover Transition Animation', 'codexin')),
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
	                ) //End params
	            ),  // End of elemnt cx_events_accordion
			) //end of  array 
		);  //end of kc_add_map
	} //End if
} // end of cx_events_accordion_shortcode_kc


