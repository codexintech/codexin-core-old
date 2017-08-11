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
	<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
		<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">		
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
				<p class="member-name"><?php echo esc_html( $member_name ); ?></p>
				<p class="member-designation"><?php echo esc_html( $designation ); ?></p>
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
								'admin_label' 	=> true,
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
                		'Social Icon' => array(
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

						// Styling params
  	        			'styling' => array(

  	        				array(
  	        					'name'    		=> 'codexin_css',
  	        					'type'    		=> 'css',
  	        					'options' 		=> array(
  	        						array(
  	        							"screens" => "any,1199,991,767,479",

  	        							'Name' => array(
  	        								array('property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.team-description p:first-child'),
  	        								array('property' => 'font-family', 'label' => esc_html__('Font Family', 'codexin'), 'selector' => '.team-description p:first-child'),
  	        								array('property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.team-description p:first-child'),
  	        								array('property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.team-description p:first-child'),
  	        								array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.team-description p:first-child'),
  	        								array('property' => 'text-align', 'label' => esc_html__('Text Align', 'codexin'), 'selector' => '.team-description p:first-child'),
  	        								array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'codexin'), 'selector' => '.team-description p:first-child'),
  	        								array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.team-description p:first-child'),
  	        								array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.team-description p:first-child'),
        								),

  	        							'Description' => array(
  	        								array('property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.team-description p:last-child'),
  	        								array('property' => 'font-family', 'label' => esc_html__('Font Family', 'codexin'), 'selector' => '.team-description p:last-child'),
  	        								array('property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.team-description p:last-child'),
  	        								array('property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.team-description p:last-child'),
  	        								array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.team-description p:last-child'),
  	        								array('property' => 'text-align', 'label' => esc_html__('Text Align', 'codexin'), 'selector' => '.team-description p:last-child'),
  	        								array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'codexin'), 'selector' => '.team-description p:last-child'),
  	        								array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.team-description p:last-child'),
  	        								array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.team-description p:last-child'),
        								),

  	        							'Icon' => array(
  	        								array('property' => 'color', 'label' => esc_html__('Text Color', 'codexin'), 'selector' => '.team-social i'),
  	        								array('property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.team-social i'),
  	        								array('property' => 'color', 'label' => esc_html__('Text Color Hover', 'codexin'), 'selector' => '.team-social i:hover'),
  	        								array('property' => 'background-color', 'label' => esc_html__('BG Color Hover', 'codexin'), 'selector' => '.team-social i:hover'),
  	        								array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.team-social i'),
  	        								array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.team-social i')
        								),

  	        							'Box'	=> array(
  	        								array('property' => 'background'),
  	        								array('property' => 'border', 'label' => esc_html__('Border', 'codexin') ),
  	        								array('property' => 'border-radius', 'label' => esc_html__('Border Radius', 'codexin') ),
  	        								array('property' => 'box-shadow', 'label' => esc_html__('Box Shadow', 'codexin')),
  	        								array('property' => 'box-shadow', 'label' => esc_html__('Box Shadow on Hover','codexin')),
  	        								array('property' => 'transition', 'label' => esc_html__('Hover Transition Animation', 'codexin')),
  	        								array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin') ),
  	        								array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin') ),
        								)									
        							)
        						)
        					)
        				), // end of styling

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


