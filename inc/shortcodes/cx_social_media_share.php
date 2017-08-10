<?php


/*
    =========================================
        CODEXIN SOCIAL MEDIA SHARE SHORTCODE
    =========================================
*/

// Registering Social Media Share Shortcode
function cx_social_media_share_shortcode( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'social_title' => '',
		'fb'	=> '',
		'tw'	=> '',
		'ld'	=> '',
		'ig'	=> '',
		'be'	=> '',
		'class' => ''
	), $atts));

	// Assigning a master css class and hooking into KC
	$master_class = apply_filters( 'kc-el-class', $atts );
	$master_class[] = 'socials socials-share';

	// Retrieving user define classes
	$classes = array( 'social-content' );
	(!empty($class)) ? $classes[] = $class : '';

	$result = '';

	ob_start(); ?>

	<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
		<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
			<?php if( $social_title ) : ?>
				<div class="socials-title"><h4> <?php echo esc_html__( $social_title ); ?> </h4></div>
			<?php endif; ?>
			<?php if( ! empty( $fb ) ) : ?>
				<a href="<?php echo esc_url( $fb ); ?>"><i class="fa fa-facebook"></i></a>
			<?php endif;
			if( ! empty( $tw ) ) : ?>
			<a href="<?php echo esc_url( $tw ); ?>"><i class="fa fa-twitter"></i></a>
			<?php endif; 
			if( ! empty( $ld ) ) : ?>
				<a href="<?php echo esc_url( $ld ); ?>"><i class="fa fa-linkedin"></i></a>
			<?php endif;
			if( $ig ) : ?>
				<a href="<?php echo esc_url( $ig ); ?>"><i class="fa fa-instagram"></i></a>
			<?php endif;
			if( $be ) : ?>
				<a href="<?php echo esc_url( $be ); ?>"><i class="fa fa-behance"></i></a>
			<?php endif; ?>
		</div><!--end of social-content -->
	</div><!--end of socials -->

	<?php
	$result .= ob_get_clean();
	return $result;

} //End cx_social_media_share


// Integrating Shortcode with King Composer
function cx_social_media_share_kc() {

	if (function_exists('kc_add_map')) { 
 		kc_add_map(
 			array(
 				'cx_social_media_share' => array(
 					'name' => esc_html__( 'Codexin Social Media', 'codexin' ),
 					'description' => esc_html__('Codexin Social Media', 'codexin'),
 					'icon' => 'et-hazardous',
 					'category' => 'Codexin',
 					'params' => array(
 						//general params
 						'general' => array(
 							array(
 								'name' 			=> 'show_title',
 								'label' 		=> esc_html__( 'Enable Social Media Title? ', 'codexin' ),
 								'type' 			=> 'toggle',
 								'value'			=> 'no',
 								'admin_label' 	=> true

 							),

 							array(
 								'name' 			=> 'social_title',
 								'label' 		=> esc_html__( 'Title', 'codexin' ),
 								'type' 			=> 'text',
 								'relation' 		=> array(
 									'parent'    => 'show_title',
 									'show_when' => 'yes',
 								),
 								'description'	=> esc_html__( 'Enter Title Here', 'codexin' ),
 								'admin_label' 	=> true
 							),

	 						array(
	 							'name' 			=> 'fb',
	 							'label' 		=> esc_html__( 'Face Book Link ', 'codexin' ),
	 							'type' 			=> 'text',
	 							'description'	=> esc_html__( 'Enter Your Face-Book URL Here', 'codexin' ),
	 						),

	 						array(
	 							'name' 			=> 'tw',
	 							'label' 		=> esc_html__( 'Twitter Link ', 'codexin' ),
	 							'type' 			=> 'text',
	 							'description'	=> esc_html__( 'Enter Your Twitter URL Here', 'codexin' ),
	 						),

	 						array(
	 							'name' 			=> 'ld',
	 							'label' 		=> esc_html__( 'Linkedin Link ', 'codexin' ),
	 							'type' 			=> 'text',
	 							'description'	=> esc_html__( 'Enter Your Linkedin URL Here', 'codexin' ),
	 						),

	 						array(
	 							'name' 			=> 'ig',
	 							'label' 		=> esc_html__( 'Instagram Link ', 'codexin' ),
	 							'type' 			=> 'text',
	 							'description'	=> esc_html__( 'Enter Your Instagram URL Here', 'codexin' ),
	 						),

	 						array(
	 							'name' 			=> 'be',
	 							'label' 		=> esc_html__( 'Behance Link ', 'codexin' ),
	 							'type' 			=> 'text',
	 							'description'	=> esc_html__( 'Enter Your Behance URL Here', 'codexin' ),
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
											array('property' => 'color', 'label' => esc_html__( 'Color', 'copdexin'), 'selector' => '.socials-title h4'),
											array('property' => 'font-family', 'label' => esc_html__( 'Font family', 'copdexin'), 'selector' => '.socials-title h4'),
											array('property' => 'font-size', 'label' => esc_html__( 'Font Size', 'copdexin'), 'selector' => '.socials-title h4'),
											array('property' => 'font-weight', 'label' => esc_html__( 'Font Weight', 'copdexin'), 'selector' => '.socials-title h4'),
											array('property' => 'line-height', 'label' => esc_html__( 'Line Height', 'copdexin'), 'selector' => '.socials-title h4'),
											array('property' => 'padding', 'label' => esc_html__( 'Padding', 'copdexin'), 'selector' => '.socials-title h4'),
											array('property' => 'margin', 'label' => esc_html__( 'Margin', 'copdexin'), 'selector' => '.socials-title h4')
										),

 										'Icons' => array(
 											array('property' => 'color', 'label' => esc_html__( 'Color', 'copdexin'), 'selector' => 'i'),
 											array('property' => 'background-color', 'label' => esc_html__( 'Background Color', 'copdexin'), 'selector' => 'i'),
 											array('property' => 'color', 'label' => esc_html__( 'Color Hover', 'copdexin'), 'selector' => 'i:hover'),
 											array('property' => 'background-color', 'label' => esc_html__( 'Background Color Hover', 'copdexin'), 'selector' => 'i:hover'),
 											array('property' => 'font-size', 'label' => esc_html__( 'Font Size', 'copdexin'), 'selector' => 'i'),
 											array('property' => 'line-height', 'label' => esc_html__( 'Line Height', 'copdexin'), 'selector' => 'i'),
 											array('property' => 'text-align', 'label' => esc_html__( 'Text Align', 'copdexin'), 'selector' => 'i'),
 											array('property' => 'border', 'label' => esc_html__( 'Border', 'copdexin'), 'selector' => 'i'),
 											array('property' => 'border-radius', 'label' => esc_html__( 'Border Radius', 'copdexin'), 'selector' => 'i'),
 											array('property' => 'transition', 'label' => esc_html__( 'Transition Hover', 'copdexin'), 'selector' => 'i:hover'),
 											array('property' => 'padding', 'label' => esc_html__( 'Padding', 'copdexin'), 'selector' => 'i'),
 											array('property' => 'margin', 'label' => esc_html__( 'Margin', 'copdexin'), 'selector' => 'i')
 										),

 										'Box'	=> array(
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
	                ) //End params array
	            ),  // End of elemnt cx_social_media_share
			) //end of array 
		);  //end of kc_add_map
	} //End if
} // end of cx_team_kc


