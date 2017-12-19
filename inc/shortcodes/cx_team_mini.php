<?php


/*
    ======================================
        CODEXIN MINI TEAM SHORTCODE
    ======================================
*/

// Registering Mini Team Shortcode
function cx_team_mini_shortcode( $atts, $content = null ) {
	extract(shortcode_atts(array(
			'team_member'	=> '',
			'class'			=> ''
	), $atts));

	// Assigning a master css class and hooking into KC
	$master_class = apply_filters( 'kc-el-class', $atts );
	$master_class[] = 'cx-team-wrapper';
	// Retrieving user define classes
	$classes = array( 'cx-team' );
	(!empty($class)) ? $classes[] = $class : '';

	// Extracting user selected team members
	$cx_team_m = str_replace(',', ' ', $team_member);
	$cx_team_members = explode( " ", $cx_team_m );

	$result = '';

	ob_start(); 
	?>
	<div class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
		<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
			<div class="row">
					<?php 
					//start new query..
					$args = array(
						'post_type'		 => 'team',
						'post__in'		 => ( !empty( $team_member ) ) ? $cx_team_members : '',
						'order'			 => 'DESC',
						'orderby'		 => 'post__in',
						'posts_per_page' => 4,
						'post_status'	 => 'publish'
						);

					$data = new WP_Query( $args );

					if( $data->have_posts() ) :
						//Start loop here...
						while( $data->have_posts() ) : $data->the_post();

						// Retrieving Image alt tag
						$img_alt = ( !empty( retrieve_alt_tag() ) ) ? retrieve_alt_tag() : get_the_title();

						$designation = rwmb_meta( 'reveal_team_designation','type=text' );
						$fb = rwmb_meta( 'reveal_team_facebook','type=text' );
						$tr = rwmb_meta( 'reveal_team_twitter','type=text' );
						$ig = rwmb_meta( 'reveal_team_ig','type=text' );
						$gp = rwmb_meta( 'reveal_team_gp','type=text' );
						$li = rwmb_meta( 'reveal_team_ld','type=text' );
						?>
						<div class="col-sm-3">
							<div class="team-single">
								<img src="<?php if(has_post_thumbnail()): echo esc_url( the_post_thumbnail_url( 'codexin-core-rectangle-three' ) ); else: echo '//placehold.it/480x595'; endif; ?>" alt="<?php echo esc_attr( $img_alt ); ?>" class="img-responsive" />
								<div class="team-single-wrapper">
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
										<?php endif; 
										if( ! empty( $li ) ) :?>
										<a href="<?php echo esc_url( $li ); ?>"><i class="fa fa-linkedin"></i></a>
										<?php endif; ?>
									</div>
								</div>
							</div>
							<div class="team-description">
								<p class="member-name"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php echo esc_html( get_the_title() ); ?></a></p>
								<p class="member-designation"><?php echo esc_html( $designation ); ?></p>
							</div>
						</div><!-- end of col -->

						<?php 
						endwhile;
					else:
						echo '<p class="cx-error">No Team Members were found. Please Add/Publish Team Members from the dashboard Team Menu.</p>';
					endif;
					wp_reset_postdata();
					?>
			</div><!-- end of row -->
		</div><!-- end of team-single-item -->
	</div><!-- end of revel-team-wrapper -->
				
	<?php
	$result .= ob_get_clean();
	return $result;

} //End cx_team_mini

/**
 *
 * Helper function to fetch all team members
 *
 */  
function cx_get_team_members() {

	$args = array( 
		'post_type' => 'team',
		'posts_per_page' => -1 
	);

	$team_list = get_posts( $args );

	$cx_team = array();
	if ( $team_list ) {

		$cx_team = array();

		foreach ( $team_list as $value ) {
			$cx_team[$value->ID] = ucwords( strtolower( $value->post_title ) );
		}

	} else {

		$cx_team[0] = esc_html__( 'No Team Members were found.', 'codexin' );

	}

	return $cx_team;


} //End cx_get_team_members()..


// Integrating Shortcode with King Composer
function cx_team_mini_kc() {

	$team_members = cx_get_team_members();

	if (function_exists('kc_add_map')) { 
		kc_add_map(
			array(
				'cx_team_mini' => array(
					'name' => esc_html__( 'Codexin Mini Team', 'codexin' ),
					'description' => esc_html__('Mini Team Section', 'codexin'),
					'icon' => 'et-hazardous',
					'category' => 'Codexin',
					'params' => array(
						//General params
						'general'	=> array(

	 						array(
	 							'name' 			=> 'team_member',
	 							'label' 		=> esc_html__( 'Select Team Members to Display (Select Four Members)', 'codexin' ),
	 							'type' 			=> 'checkbox',
	 							'options'		=> $team_members,
	 							'description'	=> esc_html__( 'By Default, Latest Four Members are Displayed.', 'codexin' ),
	 						),

							array(
								'name' 			=> 'class',
								'label' 		=> __( 'Enter Class', 'codexin' ),
								'type' 			=> 'text',
								'description'	=> esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS.', 'codexin' ),
								'admin_label' 	=> false,
							),

                		), //End general array..

						// Styling params
  	        			'styling' => array(

  	        				array(
  	        					'name'    		=> 'codexin_css',
  	        					'type'    		=> 'css',
  	        					'options' 		=> array(
  	        						array(
  	        							"screens" => "any,1199,991,767,479",

  	        							'Name' => array(
  	        								array('property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.team-description p:first-child a'),
  	        								array('property' => 'font-family', 'label' => esc_html__('Font Family', 'codexin'), 'selector' => '.team-description p:first-child a'),
  	        								array('property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.team-description p:first-child a'),
  	        								array('property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.team-description p:first-child a'),
  	        								array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'codexin'), 'selector' => '.team-description p:first-child a'),
  	        								array('property' => 'text-align', 'label' => esc_html__('Text Align', 'codexin'), 'selector' => '.team-description p:first-child a'),
  	        								array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'codexin'), 'selector' => '.team-description p:first-child a'),
  	        								array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.team-description p:first-child a'),
  	        								array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.team-description p:first-child a'),
        								),

  	        							'Designation' => array(
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

  	        							'Name Wrapper' => array(
  	        								array('property' => 'background', 'label' => esc_html__('Background', 'codexin'), 'selector' => '.team-description'),
  	        								array('property' => 'text-align', 'label' => esc_html__('Text Align', 'codexin'), 'selector' => '.team-description'),
  	        								array('property' => 'border', 'label' => esc_html__('Border', 'codexin'), 'selector' => '.team-description'),
  	        								array('property' => 'border-radius', 'label' => esc_html__('Border Radius', 'codexin'), 'selector' => '.team-description'),
  	        								array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.team-description'),
  	        								array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.team-description'),
        								),

  	        							'Image'	=> array(
  	        								array('property' => 'background', 'label' => esc_html__('Image Background Color on Hover', 'codexin'), 'selector' => '.team-single-wrapper'),
  	        								array('property' => 'border', 'label' => esc_html__('Border', 'codexin'), 'selector' => '.team-single-wrapper' ),
  	        								array('property' => 'box-shadow', 'label' => esc_html__('Box Shadow for Image', 'codexin'), 'selector' => '.team-single'),
  	        								array('property' => 'box-shadow', 'label' => esc_html__('Box Shadow on Hover for Image','codexin'), 'selector' => '.team-single:hover'),
  	        								array('property' => 'transition', 'label' => esc_html__('Hover Transition Animation', 'codexin'), 'selector' => '.team-single'),
  	        								array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.team-single-wrapper' ),
  	        								array('property' => 'margin', 'label' => esc_html__('Matgin', 'codexin'), 'selector' => '.team-single-wrapper' ),
        								),

  	        							'Icon' => array(
  	        								array('property' => 'color', 'label' => esc_html__('Color', 'codexin'), 'selector' => '.team-social i'),
  	        								array('property' => 'background-color', 'label' => esc_html__('Background Color', 'codexin'), 'selector' => '.team-social i'),
  	        								array('property' => 'color', 'label' => esc_html__('Color on Hover', 'codexin'), 'selector' => '.team-social i:hover'),
  	        								array('property' => 'background-color', 'label' => esc_html__('Background Color on Hover', 'codexin'), 'selector' => '.team-social i:hover'),
  	        								array('property' => 'font-size', 'label' => esc_html__('Font Size', 'codexin'), 'selector' => '.team-social i'),
  	        								array('property' => 'line-height', 'label' => esc_html__('Line Height', 'codexin'), 'selector' => '.team-social i'),
  	        								array('property' => 'width', 'label' => esc_html__('Width', 'codexin'), 'selector' => '.team-social a'),
  	        								array('property' => 'height', 'label' => esc_html__('Height', 'codexin'), 'selector' => '.team-social i'),
  	        								array('property' => 'border-radius', 'label' => esc_html__('Border Radius', 'codexin'), 'selector' => '.team-social i'),
  	        								array('property' => 'padding', 'label' => esc_html__('Padding', 'codexin'), 'selector' => '.team-social a'),
  	        								array('property' => 'margin', 'label' => esc_html__('Margin', 'codexin'), 'selector' => '.team-social a'),
  	        								
        								),
									
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

} // end of cx_team_mini_kc


