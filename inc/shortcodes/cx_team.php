<?php


/*
    ======================================
        CODEXIN TEAM SHORTCODE
    ======================================
*/

// Registering Team Shortcode
function cx_team_shortcode( $atts, $content = null ) {
	extract(shortcode_atts(array(
			'member_name'	=> '',
			'designation' 	=> '',
			'image'			=> '',
			'img_alt'		=> '',
			'fb' 			=> '',
			'tr' 			=> '',
			'ig' 			=> '',
			'gp' 			=> '',
			'class'			=> ''
	), $atts));

	// Assigning a master css class and hooking into KC
	$master_class = apply_filters( 'kc-el-class', $atts );
	$master_class[] = 'revel-team-wrapper';
	// Retrieving user define classes
	$classes = array( 'team-single-item' );
	(!empty($class)) ? $classes[] = $class : '';

	// Retrieving the image url
	$retrive_img_url = retrieve_img_src( $image, 'team-mini-image' );
	$ret_full_img_url = retrieve_img_src( $image, 'full' );

	$result = '';

	ob_start(); 
	?>
	<div class="revel-team-wrapper">
		<div class="team-single-item">		
			<div class="single-team">
				<img src="<?php echo $ret_full_img_url; ?>" alt="<?php echo esc_attr( $img_alt ); ?>" class="img-responsive" />
				<div class="single-team-wrapper">
					<div class="team-social">
						<?php
						if( ! empty( $fb ) ) :?>
						<a href="<?php echo esc_url( $fb ); ?>"><i class="fa fa-facebook"></i></a>
						<?php endif;
						if( ! empty( $tr ) ) : ?>
						<a href="<?php echo esc_url( $tr ); ?>"><i class="fa fa-twitter"></i></a>
						<?php endif;
						if( ! empty( $ig ) ) :?>
						<a href="<?php echo esc_url( $ig ); ?>"><i class="fa fa-instagram"></i></a>
						<?php endif;
						if( ! empty( $gp ) ) :?>
						<a href="<?php echo esc_url( $gp ); ?>"><i class="fa fa-google-plus"></i></a>
						<?php endif; ?>
					</div>
				</div>
			</div><!-- end of single-team -->
			<div class="team-description text-center">
				<p><?php echo esc_html( $member_name ); ?></p>
				<p><?php echo esc_html( $designation ); ?></p>
			</div>
		</div><!-- end of team-single-item -->
	</div><!-- end of revel-team-wrapper -->
				
	<?php
	$result .= ob_get_clean();
	return $result;

} //End cx_team


// Integrating Shortcode with King Composer
function cx_team_kc() {
	if (function_exists('kc_add_map')) { 
		kc_add_map(
			array(
				'cx_team' => array(
					'name' => esc_html__( 'Codexin Team Section', 'codexin' ),
					'description' => esc_html__('Team Section', 'codexin'),
					'icon' => 'et-hazardous',
					'category' => 'Codexin',
					'params' => array(
						//General params
						'general'	=> array(
							array(
								'name' 			=> 'member_name',
								'label' 		=> __( 'Name', 'codexin' ),
								'type' 			=> 'text',
								'description'	=> esc_html__( 'Enter Team Member Name Here', 'codexin' ),
								'admin_label' 	=> false,
							),

							array(
								'name' 			=> 'designation',
								'label' 		=> __( 'Designation', 'codexin' ),
								'type' 			=> 'text',
								'description'	=> esc_html__( 'Enter Team Member Designation Here', 'codexin' ),
								'admin_label' 	=> false,
							),

							array(
								'name' 			=> 'image',
								'label' 		=> __( 'Designation', 'codexin' ),
								'type' 			=> 'attach_image',
								'description'	=> esc_html__( 'Upload Team Member Image Here', 'codexin' ),
								'admin_label' 	=> false,
							),

							array(
								'name' 			=> 'class',
								'label' 		=> __( 'Enter Class', 'codexin' ),
								'type' 			=> 'text',
								'description'	=> esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS.', 'codexin' ),
								'admin_label' 	=> false,
							),

                		), //End general array..

						//Social params
                		'Social' => array(
                			array(
								'name' 			=> 'fb',
								'label' 		=> __( 'Facebook Hendelar', 'codexin' ),
								'type' 			=> 'text',
								'description'	=> esc_html__( 'Enter Your Facebook Profile Url Here', 'codexin' ),
								'admin_label' 	=> false,
							),

							array(
								'name' 			=> 'tr',
								'label' 		=> __( 'Twitter Hendelar', 'codexin' ),
								'type' 			=> 'text',
								'description'	=> esc_html__( 'Enter Your Twitter Profile Url Here', 'codexin' ),
								'admin_label' 	=> false,
							),

							array(
								'name' 			=> 'ig',
								'label' 		=> __( 'Instagram Hendelar', 'codexin' ),
								'type' 			=> 'text',
								'description'	=> esc_html__( 'Enter Your Instagram Profile Url Here', 'codexin' ),
								'admin_label' 	=> false,
							),

							array(
								'name' 			=> 'gp',
								'label' 		=> __( 'Google+ Hendelar', 'codexin' ),
								'type' 			=> 'text',
								'description'	=> esc_html__( 'Enter Your Google+ Profile Url Here', 'codexin' ),
								'admin_label' 	=> false,
							),

                		),

						//Styling params
						'styling' => array(
							array(
								'name'    		=> 'codexin_css',
								'type'    		=> 'css',
								'options' 		=> array(
									array(
										"screens" => "any,1199,991,767,479",

										'Name' => array(
												array( 'property' => 'color', 'label' => 'Text Color', 'selector' => '.team-description p:first-child' ),
												array( 'property' => 'font-size', 'label' => 'Font Size', 'selector' => '.team-description p:first-child' ),
												array( 'property' => 'font-weight', 'label' => 'Font Weight', 'selector' => '.team-description p:first-child' ),
												array( 'property' => 'text-transform', 'label' => 'Text Transform', 'selector' => '.team-description p:first-child' ),
												array( 'property' => 'text-align', 'label' => 'Text Align', 'selector' => '.team-description p:first-child' ),
												array( 'property' => 'padding', 'label' => 'Padding', 'selector' => '.team-description p:first-child' ),
												array( 'property' => 'margin', 'label' => 'Margin', 'selector' => '.team-description p:first-child' ),
										),

										'Designation' => array(
												array( 'property' => 'color', 'label' => 'Text Color', 'selector' => '.team-description p:last-child' ),
												array( 'property' => 'font-style', 'label' => 'Text Style', 'selector' => '.team-description p:last-child' ),
												array( 'property' => 'text-align', 'label' => 'Text Align', 'selector' => '.team-description p:last-child' ),
												array( 'property' => 'padding', 'label' => 'Padding', 'selector' => '.team-description p:last-child' ),
												array( 'property' => 'margin', 'label' => 'Margin', 'selector' => '.team-description p:last-child' ),
										),

										'Social Icon' => array(
												array( 'property' => 'color', 'label' => 'Icon Color', 'selector'=> '.team-social i' ),
												array( 'property' => 'color', 'label' => 'Icon Color Hover', 'selector'=> '.team-social i:hover' ),
												array( 'property' => 'background-color', 'label' => 'Icon Area BG Color', 'selector'=> '.team-social i' ),
												array( 'property' => 'background-color', 'label' => 'BG Color Hover', 'selector'=> '.team-social i:hover' ),

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

						//Animate param	
						'animate' => array(
							array(
								'name'    		=> 'animate',
								'type'    		=> 'animate'
							)

						),//End animate


                	) //End params array()..

            	),  // End of elemnt cx_tem...


			) //end of  array 


		);  //end of kc_add_map....

	} //End if

} // end of cx_team_kc


