<?php


/*
    ======================================
        CODEXIN TEAM SHORTCODE
    ======================================
*/

// Registering Team Shortcode
function cx_team_shortcode( $atts, $content = null ) {
	extract(shortcode_atts(array(
			'img_alt'	=> '',
			'class'		=> ''
	), $atts));

	// Assigning a master css class and hooking into KC
	$master_class = apply_filters( 'kc-el-class', $atts );
	$master_class[] = 'team';

	// Retrieving user define classes
	$classes = array( 'row' );
	(!empty($class)) ? $classes[] = $class : '';

	$result = '';

	ob_start(); 
	?>
	
		<div id="team" class="<?php echo esc_attr( implode( ' ', $master_class ) ); ?>">
			<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">	
				<?php 
				//start new query..
				$args = array(
					'post_type'		 => 'team',
					'order'			 => 'DESC',
					'posts_per_page' => 4,
					);

				$data = new WP_Query( $args );
				//check post..
				if( $data->have_posts() ) :
					//Start loop here..
					while( $data->have_posts() ) :	$data->the_post();
				?>
						<div class="col-sm-3">
							<div class="single-team">
								<img src="<?php echo esc_url( the_post_thumbnail_url('team-mini-image') ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>" class="img-responsive" />
								<div class="single-team-wrapper">
									<div class="team-social">
										<?php 
											$designation = rwmb_meta( 'reveal_team_designation', 'type=text' );
											$fb = rwmb_meta( 'reveal_team_facebook', 'type=text' );
											$tr = rwmb_meta( 'reveal_team_twitter', 'type=text' );
											$ig = rwmb_meta( 'reveal_team_ig', 'type=text' );
											$gp = rwmb_meta( 'reveal_team_gp', 'type=text' );

											if( ! empty( $fb ) ) :
										 ?>
											<a href="<?php echo esc_url( $fb ); ?>"><i class="fa fa-facebook"></i></a>
										<?php endif;
											if( ! empty( $tr ) ) :
										 ?>
											<a href="<?php echo esc_url( $tr ); ?>"><i class="fa fa-twitter"></i></a>
										<?php endif;
											if( ! empty( $ig ) ) :
										 ?>
											<a href="<?php echo esc_url( $ig ); ?>"><i class="fa fa-instagram"></i></a>
										<?php endif;
											if( ! empty( $gp ) ) :
									 	?>
											<a href="<?php echo esc_url( $gp ); ?>"><i class="fa fa-google-plus"></i></a>
										<?php endif; ?>
									</div>
								</div>
							</div>
							<div class="team-description text-center">
								<p><?php echo esc_html( the_title() ); ?></p>
								<p><?php echo esc_html( $designation ); ?></p>
							</div>
						</div><!--/.col-sm-3-->

				<?php 
						endwhile;
					endif; //End check-post if()..
					wp_reset_postdata();
				 ?>
			</div><!-- end of row -->
		</div> <!-- end of team --> 
		<div class="clearfix"></div>

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
								'name' 			=> 'class',
								'label' 		=> __( 'Enter Class', 'codexin' ),
								'type' 			=> 'text',
								'description'	=> esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS.', 'codexin' ),
								'admin_label' 	=> false,
							),

                		), //End general array..

						//Styling params
						'styling' => array(
							array(
								'name'    		=> 'codexin_css',
								'type'    		=> 'css',
								'options' 		=> array(
									array(
										"screens" => "any,1199,991,767,479",

										'Title' => array(
												array( 'property' => 'color', 'label' => 'Text Color', 'selector' => '.team-description p:first-child' ),
												array( 'property' => 'font-size', 'label' => 'Font Size', 'selector' => '.team-description p:first-child' ),
												array( 'property' => 'font-weight', 'label' => 'Font Weight', 'selector' => '.team-description p:first-child' ),
												array( 'property' => 'text-transform', 'label' => 'Text Transform', 'selector' => '.team-description p:first-child' ),
												array( 'property' => 'text-align', 'label' => 'Text Align', 'selector' => '.team-description p:first-child' ),
												array( 'property' => 'padding', 'label' => 'Padding', 'selector' => '.team-description p:first-child' ),
												array( 'property' => 'margin', 'label' => 'Margin', 'selector' => '.team-description p:first-child' ),
										),

										'Description' => array(
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


