<?php
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

		$master_class = apply_filters( 'kc-el-class', $atts );
	   $master_class[] = 'socials socials-share';
	   $classes = array( 'social-content' );
	   (!empty($class)) ? $classes[] = $class : '';

		$result = '';

		ob_start(); 
		?>
		<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
			<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
				<?php if( ! empty( $social_title ) ) : ?>
					<div class="socials-title"><h4>Follow Us</h4></div>
				<?php endif; ?>
				<?php 
				if( ! empty( $fb ) ) :
					?>
				<a href="<?php echo esc_url( $fb ); ?>"><i class="fa fa-facebook"></i></a>
			<?php endif;
			if( ! empty( $tw ) ) :
				?>
			<a href="<?php echo esc_url( $tw ); ?>"><i class="fa fa-twitter"></i></a>
		<?php endif; 
		if( ! empty( $ld ) ) :
			?>
		<a href="<?php echo esc_url( $ld ); ?>"><i class="fa fa-linkedin"></i></a>
		<?php endif;
		if( $ig ) :
			?>
		<a href="<?php echo esc_url( $ig ); ?>"><i class="fa fa-instagram"></i></a>
		<?php endif;
		if( $be ) :
			?>
		<a href="<?php echo esc_url( $be ); ?>"><i class="fa fa-behance"></i></a>
		<?php endif; ?>
		</div><!--social-content -->
	</div><!--/.socials -->

	<?php
	$result .= ob_get_clean();
	return $result;

 } //End cx_social_media_share


 function cx_social_media_share_kc() {

 	if (function_exists('kc_add_map')) 
 	{ 
 		kc_add_map(
 			array(
 				'cx_social_media_share' => array(
 					'name' => esc_html__( 'Codexin Social Media', 'codexin' ),
 					'description' => esc_html__('Codexin Social Media', 'codexin'),
 					'icon' => 'et-hazardous',
 					'category' => 'Codexin',
 					'params' => array(
 						'general' => array(
	 						array(
	 							'name' 			=> 'social_title',
	 							'label' 		=> esc_html__( 'Title ', 'codexin' ),
	 							'type' 			=> 'text',
	 							'description'	=> esc_html__( 'Enter Your Title Here', 'codexin' ),
	 							'admin_label' 	=> false,
	 							),
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
	 						array(
	 							'name' 			=> 'class',
	 							'label' 		=> esc_html__( 'Extra Class ', 'codexin' ),
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
	 											array('property' => 'color', 'label' => 'Color', 'selector' => '.socials-title h4'),
	 											array('property' => 'font-family', 'label' => 'Font family', 'selector' => '.socials-title h4'),
	 											array('property' => 'font-size', 'label' => 'Font Size', 'selector' => '.socials-title h4'),
	 											array('property' => 'font-weight', 'label' => 'Font Weight', 'selector' => '.socials-title h4'),
	 											array('property' => 'line-height', 'label' => 'Line Height', 'selector' => '.socials-title h4'),
	 											array('property' => 'padding', 'label' => 'Padding', 'selector' => '.socials-title h4'),
	 											array('property' => 'margin', 'label' => 'Margin', 'selector' => '.socials-title h4')
	 											),

	 										'Icons' => array(
	 											array('property' => 'color', 'label' => 'Color', 'selector' => 'i'),
	 											array('property' => 'background-color', 'label' => 'Background Color', 'selector' => 'i'),
	 											array('property' => 'color', 'label' => 'Color Hover', 'selector' => 'i:hover'),
	 											array('property' => 'background-color', 'label' => 'Background Color Hover', 'selector' => 'i:hover'),
	 											array('property' => 'font-size', 'label' => 'Font Size', 'selector' => 'i'),
	 											array('property' => 'line-height', 'label' => 'Line Height', 'selector' => 'i'),
	 											array('property' => 'text-align', 'label' => 'Text Align', 'selector' => 'i'),
	 											array('property' => 'border', 'label' => 'Border', 'selector' => 'i'),
	 											array('property' => 'border-radius', 'label' => 'Border Radius', 'selector' => 'i'),
	 											array('property' => 'transition', 'label' => 'Transition Hover', 'selector' => 'i:hover'),
	 											array('property' => 'padding', 'label' => 'Padding', 'selector' => 'i'),
	 											array('property' => 'margin', 'label' => 'Margin', 'selector' => 'i')
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

	            ),  // End of elemnt cx_social_media_share...


			) //end of  array 


		);  //end of kc_add_map....

	} //End if

} // end of cx_team_kc


