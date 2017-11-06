<?php


/*
    =========================================
        CODEXIN SOCIAL MEDIA SHARE SHORTCODE
    =========================================
*/

// Registering Social Media Share Shortcode
function cx_social_media_shortcode( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'social_title' 	=> '',
		'show_fb'		=> '',
		'show_tw'		=> '',
		'show_in'		=> '',
		'show_pin'		=> '',
		'show_be'		=> '',
		'show_gp'		=> '',
		'show_yt'		=> '',
		'show_sk'		=> '',
		'show_li'		=> '',

		'cx_facebook'	=> '',
		'cx_twitter'	=> '',
		'cx_instagram'	=> '',
		'cx_pinterest'	=> '',
		'cx_behance'	=> '',
		'cx_gplus'		=> '',
		'cx_youtube'	=> '',
		'cx_skype'		=> '',
		'cx_linkedin'	=> '',
		'class'			=> ''
	), $atts));

	// Assigning a master css class and hooking into KC
	$master_class = apply_filters( 'kc-el-class', $atts );
	$master_class[] = 'cx-social-media';

	// Retrieving user define classes
	$classes = array( 'social-content' );
	(!empty($class)) ? $classes[] = $class : '';		
		
	$result = '';

	ob_start(); ?>

	<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
		<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
			<?php if( $social_title ) : ?>
				<div class="socials-title"><h4> <?php echo esc_html( $social_title ); ?> </h4></div>
			<?php endif; ?>
			
			<div class="cx-socials-wrapper cx-color-0 cx-primary-btn">
				<?php if( !empty( $cx_facebook ) && ( $show_fb ) ) : ?>
					<a href="<?php echo esc_url($cx_facebook); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
				<?php elseif( empty( $cx_facebook ) && ( $show_fb) ): echo '<i class="fa fa-exclamation-triangle" title="'. esc_html__('No Valid URL Found', 'codexin') .'"></i>'; ?>
				<?php endif; ?>
				<?php if( !empty( $cx_twitter ) && ( $show_tw ) ) : ?>
					<a href="<?php echo esc_url($cx_twitter); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
				<?php elseif( empty( $cx_twitter ) && ( $show_tw ) ): echo '<i class="fa fa-exclamation-triangle" title="'. esc_html__('No Valid URL Found', 'codexin') .'"></i>'; ?>
				<?php endif; ?>
				<?php if( !empty( $cx_instagram ) && ( $show_in ) ) : ?>
					<a href="<?php echo esc_url($cx_instagram); ?>" target="_blank"><i class="fa fa-instagram"></i></a>
				<?php elseif( empty( $cx_instagram ) && ( $show_in ) ): echo '<i class="fa fa-exclamation-triangle" title="'. esc_html__('No Valid URL Found', 'codexin') .'"></i>'; ?>
				<?php endif; ?>
				<?php if( !empty( $cx_pinterest ) && ( $show_pin ) ) : ?>
					<a href="<?php echo esc_url($cx_pinterest); ?>" target="_blank"><i class="fa fa-pinterest"></i></a>
				<?php elseif( empty( $cx_pinterest ) && ( $show_pin ) ): echo '<i class="fa fa-exclamation-triangle" title="'. esc_html__('No Valid URL Found', 'codexin') .'"></i>'; ?>
				<?php endif; ?>
				<?php if( !empty( $cx_behance ) && ( $show_be ) ) : ?>
					<a href="<?php echo esc_url($cx_behance); ?>" target="_blank"><i class="fa fa-behance"></i></a>
				<?php elseif( empty( $cx_behance ) && ( $show_be ) ): echo '<i class="fa fa-exclamation-triangle" title="'. esc_html__('No Valid URL Found', 'codexin') .'"></i>'; ?>
				<?php endif; ?>
				<?php if( !empty( $cx_gplus ) && ( $show_gp ) ) : ?>
					<a href="<?php echo esc_url($cx_gplus); ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
				<?php elseif( empty( $cx_gplus ) && ( $show_gp ) ): echo '<i class="fa fa-exclamation-triangle" title="'. esc_html__('No Valid URL Found', 'codexin') .'"></i>'; ?>
				<?php endif; ?>
				<?php if( !empty( $cx_youtube ) && ( $show_yt ) ) : ?>
					<a href="<?php echo esc_url($cx_youtube); ?>" target="_blank"><i class="fa fa-youtube-play"></i></a>
				<?php elseif( empty( $cx_youtube ) && ( $show_yt ) ): echo '<i class="fa fa-exclamation-triangle" title="'. esc_html__('No Valid URL Found', 'codexin') .'"></i>'; ?>
				<?php endif; ?>
				<?php if( !empty( $cx_skype ) && ( $show_sk ) ) : ?>
					<a href="<?php echo esc_url($cx_skype); ?>" target="_blank"><i class="fa fa-skype"></i></a>
				<?php elseif( empty( $cx_skype ) && ( $show_sk ) ): echo '<i class="fa fa-exclamation-triangle" title="'. esc_html__('No Valid URL Found', 'codexin') .'"></i>'; ?>
				<?php endif; ?>
				<?php if( !empty( $cx_linkedin ) && ( $show_li ) ) : ?>
					<a href="<?php echo esc_url($cx_linkedin); ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
				<?php elseif( empty( $cx_linkedin ) && ( $show_li ) ): echo '<i class="fa fa-exclamation-triangle" title="'. esc_html__('No Valid URL Found', 'codexin') .'"></i>'; ?>
				<?php endif; ?>
			</div>

		</div><!--end of social-content -->
	</div><!--end of socials -->

	<?php
	$result .= ob_get_clean();
	return $result;

} //End cx_social_media_share


// Registering new param type to show info
add_action('init', 'social_info_param', 99 );
function social_info_param() {
	if ( isset( $GLOBALS['kc'] ) ) {
	    global $kc;
	    $kc->add_param_type( 'cx_social_info', 'cx_social_info_cb' );
	}
}		
function cx_social_info_cb() {
	echo '<p>'. esc_html__('In Order To Use This Widget Please Fill Up The Social Profile Information In The "Social Media" Section of ', 'codexin') . '<strong><a href="'. esc_url(admin_url().'admin.php?page=codexin-options&action=social') .'" target="_blank">'. esc_html('Codexin Core.', 'codexin') .'</a></strong></p>';
}

// Integrating Shortcode with King Composer
function cx_social_media_kc() {

	if (function_exists('kc_add_map')) { 
 		kc_add_map(
 			array(
 				'cx_social_media' => array(
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
 								'name' 			=> 'show_fb',
 								'label' 		=> esc_html__( 'Enable Facebook? ', 'codexin' ),
 								'type' 			=> 'toggle',
 								'value'			=> 'no',
 							),

 							array(
 								'name' 			=> 'cx_facebook',
 								'label' 		=> esc_html__( 'Facebook URL', 'codexin' ),
 								'type' 			=> 'text',
 								'relation' 		=> array(
 									'parent'    => 'show_fb',
 									'show_when' => 'yes',
 								),
 								'description'	=> esc_html__( 'Please Insert Your Facebook Profile URL', 'codexin' ),
 							),

 							array(
 								'name' 			=> 'show_tw',
 								'label' 		=> esc_html__( 'Enable Twitter? ', 'codexin' ),
 								'type' 			=> 'toggle',
 								'value'			=> 'no',
 							),
 							array(
 								'name' 			=> 'cx_twitter',
 								'label' 		=> esc_html__( 'Twitter URL', 'codexin' ),
 								'type' 			=> 'text',
 								'relation' 		=> array(
 									'parent'    => 'show_tw',
 									'show_when' => 'yes',
 								),
 								'description'	=> esc_html__( 'Please Insert Your Twitter Profile URL', 'codexin' ),
 							),

 							array(
 								'name' 			=> 'show_in',
 								'label' 		=> esc_html__( 'Enable Instagram? ', 'codexin' ),
 								'type' 			=> 'toggle',
 								'value'			=> 'no',
 							),
 							array(
 								'name' 			=> 'cx_instagram',
 								'label' 		=> esc_html__( 'Instagram URL', 'codexin' ),
 								'type' 			=> 'text',
 								'relation' 		=> array(
 									'parent'    => 'show_in',
 									'show_when' => 'yes',
 								),
 								'description'	=> esc_html__( 'Please Insert Your Instagram Profile URL', 'codexin' ),
 							),

 							array(
 								'name' 			=> 'show_pin',
 								'label' 		=> esc_html__( 'Enable Pinterest? ', 'codexin' ),
 								'type' 			=> 'toggle',
 								'value'			=> 'no',
 							),
 							array(
 								'name' 			=> 'cx_pinterest',
 								'label' 		=> esc_html__( 'Pinterest URL', 'codexin' ),
 								'type' 			=> 'text',
 								'relation' 		=> array(
 									'parent'    => 'show_pin',
 									'show_when' => 'yes',
 								),
 								'description'	=> esc_html__( 'Please Insert Your Pinterest Profile URL', 'codexin' ),
 							),

 							array(
 								'name' 			=> 'show_be',
 								'label' 		=> esc_html__( 'Enable Behance? ', 'codexin' ),
 								'type' 			=> 'toggle',
 								'value'			=> 'no',
 							),
 							array(
 								'name' 			=> 'cx_behance',
 								'label' 		=> esc_html__( 'Behance URL', 'codexin' ),
 								'type' 			=> 'text',
 								'relation' 		=> array(
 									'parent'    => 'show_be',
 									'show_when' => 'yes',
 								),
 								'description'	=> esc_html__( 'Please Insert Your Behance Profile URL', 'codexin' ),
 							),

 							array(
 								'name' 			=> 'show_gp',
 								'label' 		=> esc_html__( 'Enable Google+? ', 'codexin' ),
 								'type' 			=> 'toggle',
 								'value'			=> 'no',
 							),
 							array(
 								'name' 			=> 'cx_gplus',
 								'label' 		=> esc_html__( 'Google+ URL', 'codexin' ),
 								'type' 			=> 'text',
 								'relation' 		=> array(
 									'parent'    => 'show_gp',
 									'show_when' => 'yes',
 								),
 								'description'	=> esc_html__( 'Please Insert Your Google+ Profile URL', 'codexin' ),
 							),

 							array(
 								'name' 			=> 'show_yt',
 								'label' 		=> esc_html__( 'Enable Youtube? ', 'codexin' ),
 								'type' 			=> 'toggle',
 								'value'			=> 'no',
 							),
 							array(
 								'name' 			=> 'cx_youtube',
 								'label' 		=> esc_html__( 'Youtube URL', 'codexin' ),
 								'type' 			=> 'text',
 								'relation' 		=> array(
 									'parent'    => 'show_yt',
 									'show_when' => 'yes',
 								),
 								'description'	=> esc_html__( 'Please Insert Your Youtube Profile URL', 'codexin' ),
 							),

 							array(
 								'name' 			=> 'show_sk',
 								'label' 		=> esc_html__( 'Enable Skype? ', 'codexin' ),
 								'type' 			=> 'toggle',
 								'value'			=> 'no',
 							),
 							array(
 								'name' 			=> 'cx_skype',
 								'label' 		=> esc_html__( 'Skype URL', 'codexin' ),
 								'type' 			=> 'text',
 								'relation' 		=> array(
 									'parent'    => 'show_sk',
 									'show_when' => 'yes',
 								),
 								'description'	=> esc_html__( 'Please Insert Your Skype Profile URL', 'codexin' ),
 							),

 							array(
 								'name' 			=> 'show_li',
 								'label' 		=> esc_html__( 'Enable Linkedin? ', 'codexin' ),
 								'type' 			=> 'toggle',
 								'value'			=> 'no',
 							),
 							array(
 								'name' 			=> 'cx_linkedin',
 								'label' 		=> esc_html__( 'Linkedin URL', 'codexin' ),
 								'type' 			=> 'text',
 								'relation' 		=> array(
 									'parent'    => 'show_li',
 									'show_when' => 'yes',
 								),
 								'description'	=> esc_html__( 'Please Insert Your Linkedin Profile URL', 'codexin' ),
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
											array('property' => 'font-style', 'label' => esc_html__( 'Font Style', 'codexin'), 'selector' => '.socials-title h4'),
											array('property' => 'text-transform', 'label' => esc_html__( 'Text Transform', 'codexin'), 'selector' => '.socials-title h4'),
											array('property' => 'line-height', 'label' => esc_html__( 'Line Height', 'codexin'), 'selector' => '.socials-title h4'),
											array('property' => 'width', 'label' => esc_html__( 'Width', 'codexin'), 'selector' => '.socials-title h4'),
											array('property' => 'display', 'label' => esc_html__( 'Display', 'codexin'), 'selector' => '.socials-title h4'),
											array('property' => 'float', 'label' => esc_html__( 'Float', 'codexin'), 'selector' => '.socials-title h4'),
											array('property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin'), 'selector' => '.socials-title h4'),
											array('property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin'), 'selector' => '.socials-title h4')
										),

										'Icon Wrapper' => array(
											array('property' => 'background', 'label' => esc_html__( 'Background', 'codexin'), 'selector' => '.cx-socials-wrapper'),
											array('property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin'), 'selector' => '.cx-socials-wrapper'),
											array('property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin'), 'selector' => '.cx-socials-wrapper')
										),

 										'Icons' => array(
 											array('property' => 'color', 'label' => esc_html__( 'Color', 'codexin'), 'selector' => 'i'),
 											array('property' => 'background-color', 'label' => esc_html__( 'Background Color', 'codexin'), 'selector' => 'i'),
 											array('property' => 'color', 'label' => esc_html__( 'Color Hover', 'codexin'), 'selector' => 'i:hover'),
 											array('property' => 'background-color', 'label' => esc_html__( 'Background Color Hover', 'codexin'), 'selector' => 'i:hover'),
 											array('property' => 'font-size', 'label' => esc_html__( 'Font Size', 'codexin'), 'selector' => 'i'),
 											array('property' => 'line-height', 'label' => esc_html__( 'Line Height', 'codexin'), 'selector' => 'i'),
 											array('property' => 'text-align', 'label' => esc_html__( 'Text Align', 'codexin'), 'selector' => 'i'),
 											array('property' => 'border', 'label' => esc_html__( 'Border', 'codexin'), 'selector' => 'i'),
 											array('property' => 'border', 'label' => esc_html__( 'Border on Hover', 'codexin'), 'selector' => 'i:hover'),
 											array('property' => 'border-radius', 'label' => esc_html__( 'Border Radius', 'codexin'), 'selector' => 'i'),
 											array('property' => 'transition', 'label' => esc_html__( 'Transition Hover', 'codexin'), 'selector' => 'i:hover'),
 											array('property' => 'width', 'label' => esc_html__( 'Width', 'codexin'), 'selector' => 'i'),
 											array('property' => 'height', 'label' => esc_html__( 'Height', 'codexin'), 'selector' => 'i'),
 											array('property' => 'padding', 'label' => esc_html__( 'Padding', 'codexin'), 'selector' => 'i'),
 											array('property' => 'margin', 'label' => esc_html__( 'Margin', 'codexin'), 'selector' => 'i')
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


